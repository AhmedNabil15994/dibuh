<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use App\Models\ContactsToContactType;
use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\Setting;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceItem;
use App\Models\Salary;
use App\Models\SalaryItem;
use App\Models\Account;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\TaxType;
use App\Models\Tax;
use App\Models\Contact;
use App\Models\ContactAddress;
use App\Models\Unit;
use App\Models\InvoiceStatus;
use App\Models\AccountCategory;
use App\Models\Installment;
use App\Models\Finance_bank;
use App\Models\Finance_treasury;
use App\Models\Finance_credit;
use App\Models\currency_table;
use Config;
use Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use View;
use Illuminate\Contracts\Encryption\DecryptException;

class SalaryController extends DashboardBaseController {

    protected $userType = 'user';
    protected $module = 'salary';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        View::share('userType', $this->userType);
        View::share('module', $this->module);
    }

    public function main(Request $request) {
        //
        $this->data['page_title'] = trans('frontend/sales_invoice.title');

        return $this->view($this->userType . '.' . $this->module . '.' . 'main', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request) {
        //$this->checkDueDateState();
        $user_id = Auth::user()->id;

        $this->data['data'] = Salary::where('user_id' , $user_id)->orderByRaw("FIELD(invoice_status_id , '2', '3', '5' ,'4') ASC")->get();
        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadInvoicesWithStatus', $this->data)->render();
        }

        $this->data['page_title'] = trans('frontend/sales_invoice.title');
        $this->data['user_type'] = Auth::user()->roles;
        return $this->view($this->userType . '.' . $this->module . '.' . 'index', $this->data)
                        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function show(Request $request, $id){
        //
        $user_id = Auth::user()->id;
        $this->data['page_title'] = trans('frontend/sales_invoice.create_edit');
        $this->data['unit'] = Unit::all()->pluck('name', 'id')->all();
        $this->data['tax_types'] = TaxType::get()->pluck('name', 'id')->all(); //
        $this->data['governorates'] = Governorate::all()->pluck('name', 'id')->all();
        $this->data['countries'] = Country::all()->pluck('name', 'id')->all();
        $data = Salary::find($id);
        $this->data['data'] = $data;
        $this->data['data_details'] = SalaryItem::where('salary_id', $id)->get();
        $this->data['id'] = $id;
        $this->data['user']=User::find(Auth::user()->id)->profile;
        $this->data['accounts'] = User::find( Auth::user()->id)->accounts()->orderBy('lineage', 'ASC')->get()->pluck('full_desc','id')->all();
        $this->data['accounts_major'] = User::find(Auth::user()->id)->accounts()->where('is_major',1)->get()->pluck('id')->toArray();
        $this->data['product_type'] = ProductType::all()->pluck('name', 'id')->all();

        $invoice_no_from_db = Salary::whereRaw('invoice_number = (select max(invoice_number) from salaries)')->get(['invoice_number']);
        $invoice_number_start=0;
        if(!count($invoice_no_from_db) > 0){
            $invoice_number_start = Setting::where('key' , 'sales_invoice_start')->get(['value'])->pluck('value')->all();
        }
        $invoice_number= count($invoice_no_from_db) > 0 ?$invoice_no_from_db[0]->invoice_number:$invoice_number_start[0];
        $this->data['invoice_number'] = count($invoice_no_from_db) > 0 ? ++$invoice_number: $invoice_number;

        $display_id = ContactsToContactType::whereRaw("display_id = (select max(display_id) from contacts_to_contact_types where contact_type_id = 1 AND user_id = $user_id )")->get(['display_id']);
        $contacts_customer_start = 0;
        if(!count($display_id) > 0){
            $contacts_customer_start = Setting::where('key' , 'contacts_customer_start')->get(['value'])->pluck('value')->all();
        }
        $this->data['taxes'] = Tax::orderBy('id','ASC')->get();
        $this->data['category'] = AccountCategory::orderBy('id','ASC')->get();
        $customer_number=count($display_id) > 0 ? $display_id[0]->display_id : $contacts_customer_start[0];
        $this->data['customer_number'] = count($display_id) > 0 ? ++$customer_number : $customer_number;

        return $this->view($this->userType . '.' . $this->module . '.' . 'show', $this->data);
    }

    public function store_installement(Request $request) {

      $masterRules =[
          'paid' => 'required',
          'paid_date' => 'required',
          'finance_id' => 'required',
          'finance_notes' => 'required',
      ];
      $validator = Validator::make(Input::all(), $masterRules);
      if ($validator->fails()){
          // If validation fails redirect back to login.
          return Response::json(array(
              'fail' => true,
              'errors' => $validator->getMessageBag()->toArray()
          ));
      }
      $thesale_invoice= Salary::find($request->input('invoice_id'));
      $balance ='';

      $fincIdType = explode('|', $request->get('finance_id'));
      $fincId     = $fincIdType[0];
      $fincType   = $fincIdType[1];

      if($fincType == 1){
        $finance = Finance_bank::where('id','=',$fincId)->first();
        $balance = $finance->start_balance;
      }elseif($fincType == 2){
        $finance = Finance_treasury::where('id','=',$fincId)->first();
        $balance = $finance->start_balance;
      }elseif($fincType == 3){
        $finance = Finance_credit::where('id','=',$fincId)->first();
        $balance = $finance->start_balance;
      }

        if($request->input('paid') > $thesale_invoice->rest){
          return Response::json(array(
              'fail' => true,
              'errors' => ['The money paid must be less  or equal than the rest of the invoice']

          ));

        }elseif ($request->input('paid') > $balance ) {
          return Response::json(array(
              'fail' => true,
              'errors' => ['The money paid must be less  or equal than the balance of finance']

          ));
        }

          DB::beginTransaction();
          try {
                 $fincIdType = explode('|', $request->get('finance_id'));
                 $fincId     = $fincIdType[0];
                 $fincType   = $fincIdType[1];
                 $newRest=$thesale_invoice->rest-$request->input('paid');
                 $thesale_invoice->rest=$newRest;
              if($newRest==0){
                 $thesale_invoice->invoice_status_id=4;
                 $thesale_invoice->save();
              }else{
                 $thesale_invoice->invoice_status_id=5;
                 $thesale_invoice->save();
                 }
                 $stallement=new Installment();
                 $stallement->sales_invoice_id=$request->input('invoice_id');
                 $stallement->paid_date=$request->input('paid_date');
                 $stallement->paid=$request->input('paid');
                 $stallement->finance_id= $fincId;
                 $stallement->finance_type=$fincType;
                 $stallement->finance_notes=$request->input('finance_notes');
                 $stallement->invoice_type = 6;
                 $stallement->save();
                 if($fincType==1)
                 {
                   $theFinance=Finance_bank::find($fincId);
                   $theFinance->bank_balance=$theFinance->bank_balance-$request->input('paid');
                   $theFinance->save();

                   $account_code = $theFinance->serial_number;
                   $invoice_number = Salary::where('id','=',$request->input('invoice_id'))->first();
                   \DB::table('account_reports')->insert([
                            'account_code'  => $account_code,
                            'name'          => $theFinance->account_owner,
                            'invoice_number'   => $invoice_number->invoice_number,
                            'invoice_type'  => 7,
                            'finance_id'    => $theFinance->id,
                            'finance_type'  => $fincType,
                            'deal_type'     => trans('frontend/reports.addpay'),
                            'amount'        => $request->input('paid'),
                            'debtor'        => "----",
                            'creditor'      => "----",
                            'user_id'       => Auth::user()->id
                        ]);

                 }elseif($fincType==2){
                   $theFinance=Finance_treasury::find($fincId);
                   $theFinance->start_balance=$theFinance->start_balance-$request->input('paid');
                   $theFinance->save();

                   $account_code = $theFinance->serial_number;
                   $invoice_number = Salary::where('id','=',$request->input('invoice_id'))->first();
                   \DB::table('account_reports')->insert([
                            'account_code'  => $account_code,
                            'name'          => $theFinance->treasury_name,
                            'invoice_number'   => $invoice_number->invoice_number,
                            'invoice_type'  => 7,
                            'finance_id'    => $theFinance->id,
                            'finance_type'  => $fincType,
                            'deal_type'     => trans('frontend/reports.addpay'),
                            'amount'        => $request->input('paid'),
                            'debtor'        => "----",
                            'creditor'      => "----",
                            'user_id'       => Auth::user()->id
                        ]);

                 }elseif($fincType==3)
                 {
                   $theFinance=Finance_credit::find($fincId);
                   $theFinance->credit_balance=$theFinance->credit_balance-$request->input('paid');
                   $theFinance->save();

                   $account_code = $theFinance->serial_number;
                   $invoice_number = Salary::where('id','=',$request->input('invoice_id'))->first();
                   \DB::table('account_reports')->insert([
                            'account_code'  => $account_code,
                            'name'          => $theFinance->credit_owner,
                            'invoice_number'   => $invoice_number->invoice_number,
                            'invoice_type'  => 7,
                            'finance_id'    => $theFinance->id,
                            'finance_type'  => $fincType,
                            'deal_type'     => trans('frontend/reports.addpay'),
                            'amount'        => $request->input('paid'),
                            'debtor'        => "----",
                            'creditor'      => "----",
                            'user_id'       => Auth::user()->id
                        ]);
                 }
              DB::commit();
          } catch (\Exception $e) {
              DB::rollback();
              $arr[]=$e->getMessage();
              return Response::json(array('fail' => true,'errors' => $arr));
          }

           return ;

    }


    public function LoadAjaxFilterStatus(Request $request, $status) {
        //$this->checkDueDateState();
        if ($status == 0) {
            $data = Salary::orderBy('id', 'DESC')->get();
        } else {
            $InvoiceStatus = InvoiceStatus::find($status);
            $data = Salary::where('invoice_status_id' , '=' , $status)->get();

        }

        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadInvoicesWithStatus', ['data' => $data])->render();
        }

        $page_title = trans('frontend/sales_invoice.title');
        $user_type = Auth::user()->roles;
        return $this->view($this->userType . '.' . $this->module . '.' . 'index', compact('page_title', 'user_type', 'data'))
                        ->with('i', ($request->input('page', 1) - 1) * 10);

//        return Redirect()->route('sales_invoice.index');
//        return view($this->dashboardPath  . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadInvoicesWithStatus' , compact('data'));
    }

    //ajax request
    public function getContactData(Request $request) {
        $contactId = $request->contactID;
        $responce = Contact::where('id', $contactId)->get();

        return $responce;
    }

    public function getContactAddress(Request $request, $id) { // Request $request){
        $addresses = ContactAddress::where('contact_id', $id)->get();
        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.get_address', ['addresses' => $addresses]);
        }
    }

    public function getOneContactAddress($id) {
        $address = ContactAddress::where('contact_id', $id)->where('user_id','=',Auth::user()->id)->first();
        $contact = Contact::where('id',$id)->first();
        return "$contact->company\n$address->street $address->house_no\n$address->postal_code $address->city\n{$address->governorate->name} {$address->country->name}";
    }

    public function getContactAddressByID($id) {
        $address = ContactAddress::where('id', $id)->first();
        return " $address->name\n$address->street/$address->house_no {$address->country->name}\n$address->city\n$address->postal_code\n";
    }

    public function getProductData(Request $request) {
        $products = Product::where('id', '=', "$request->id")->get();
        return Response::json($products);
    }

    public function getAccountData(Request $request) {
        $accounts = Account::where('id', '=', $request->id)->get();
//                dd($accounts);
        return Response::json($accounts);

    }

    public function getContactsJson(Request $request) {
        $contacts = \DB::table('contacts')->join('contacts_to_contact_types','contacts.id','=','contacts_to_contact_types.contact_id')->where('contacts.user_id' , '=' ,Auth::user()->id)->where('contacts_to_contact_types.contact_type_id' , '=' ,2)->where('first_name', 'like', "%$request->text%")->get(['contacts.first_name','contacts.last_name' ,'contacts.id']);
         //Contact::where('first_name', 'like', "%$request->text%")->get(['first_name', 'id']);
        return Response::json($contacts);
    }

    public function getproductsJson(Request $request) {
        $products = Product::where('name', 'like', "%$request->text%")->get(['name', 'id']);
        return Response::json($products);
    }

    public function getAccountsJson(Request $request) {
        $accounts = Account::where('name', 'like', "%$request->text%")->get(['name', 'id']);
        return Response::json($accounts);
    }

    public function getTaxFieldsView(Request $request) {

        $accounts = Account::find( $request->id);
        $rowNum = $request->num ;
        $this->data =  compact('accounts','rowNum');
        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.get_tax_fields', $this->data)->render();
        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $this->data['page_title'] = trans('frontend/sales_invoice.create_new');
        $this->data['contacts'] = \DB::table('contacts')->join('contacts_to_contact_types','contacts.id','=','contacts_to_contact_types.contact_id')->where('contacts_to_contact_types.contact_type_id' , '=' ,2)->get();
        //Contact::where('contact_type_id', 1)->get()->pluck('full_name', 'id')->all(); //\ 1 customer
        $this->data['invoice_status'] = InvoiceStatus::all()->pluck('name', 'id')->all(); //
        $this->data['products'] = Product::all()->pluck('name', 'id')->all(); //
        $this->data['tax_types'] = TaxType::get()->pluck('name', 'id')->all(); //
        $this->data['unit'] = Unit::all()->pluck('name', 'id')->all(['name', 'id']);
        $this->data['user_id'] = Auth::user()->id;

        $invoice_no_from_db = Salary::whereRaw('invoice_number = (select max(invoice_number) from salaries)')->get(['invoice_number']);
        $invoice_number= count($invoice_no_from_db) > 0 ?$invoice_no_from_db[0]->invoice_number:0;
        $invoice_number++;
        $this->data['invoice_number'] = $invoice_number;

        $user_id = Auth::user()->id;
        $this->data['countries'] = Country::all()->pluck('name', 'id')->all();
        $this->data['governorates'] = Governorate::all()->pluck('name', 'id')->all();
        $display_id = ContactsToContactType::whereRaw("display_id = (select max(display_id) from contacts_to_contact_types where contact_type_id = 1 AND user_id = $user_id )")->get(['display_id']);
        $customer_number=count($display_id) > 0 ? $display_id[0]->display_id++ : 999;
        $this->data['customer_number'] = ++$customer_number;

        $this->data['unit'] = Unit::all()->pluck('name', 'id')->all();
        $this->data['accounts'] = User::find( Auth::user()->id)->accounts()->orderBy('lineage', 'ASC')->get()->pluck('full_desc','id')->all();
        $this->data['accounts_major'] = User::find(Auth::user()->id)->accounts()->where('is_major',1)->get()->pluck('id')->toArray();
        $this->data['tax_type'] = TaxType::get()->pluck('name', 'id')->all();
        $this->data['product_type'] = ProductType::all()->pluck('name', 'id')->all();
        $this->data['category'] = AccountCategory::orderBy('id','ASC')->get();
        $this->data['taxes'] = Tax::orderBy('id','ASC')->get();
        $this->data['data']=User::find(Auth::user()->id)->profile;

        return $this->view($this->userType . '.' . $this->module . '.' . 'create', $this->data);
    }

    public function store_customer(Request $request)
    {
        $error_customer = 'customer code your entered is already exist';

        $user_id = Auth::user()->id;
        $masterRules = [
            'first_name' => 'required|max:25',
            'last_name' => 'required|max:25',
            'job' => 'max:20',
            'company' => 'required|max:25',
            'IBAN' => 'max:14',
            'bic' => 'max:14',
            'bank_name' => 'max:25',
            'bank_number' => 'max:20',
//            'adresse.*.address_number' => 'required',
            'phones.*.phone_number' => 'max:11',
            'customer_code' => "required",
            'customer_reference_code' => "max:14",
        ];
        $rowsCustomerExist = ContactsToContactType::where('contact_type_id', 1)->where('display_id', $request->customer_code)->where('user_id', $user_id)->count();

        $err=[];
        isset($rowsCustomerExist) && $rowsCustomerExist > 0 ? $err[]=$error_customer : '';

        if (isset($rowsCustomerExist) && $rowsCustomerExist > 0 )
        {
            //return Redirect()->back()->withInput()->withErrors($err);
            return Response::json(array(
                'fail' => true,
                'errors' => $err
            ));
        }
        $validator = Validator::make(Input::all(), $masterRules);
        if ($validator->fails()){
            // If validation fails redirect back to login.
            return Response::json(array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }

        DB::beginTransaction();
        try {

            $contact = new Contact();
            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->job = $request->job;
            $contact->company = $request->company;
            $contact->iban = $request->IBAN;
            $contact->bic = $request->BIC;
            $contact->notes = $request->header_text;
            $contact->bank_name = $request->bank_name;
            $contact->bank_number = $request->bank_number;
            $contact->user_id = $user_id;
            $contact->save();


            $contact->contact_type()->create([
                'contact_type_id' => '1',
                'display_id' => $request->customer_code,
                'reference_id' => $request->customer_reference_code,
                'user_id' => $user_id
            ]);

            foreach ($request->adresse as $key => $value) {
                if (! empty($value['address_number'])){
                    $contact->addresses()->create([
                        'user_id' => $user_id,
                        'address_type_id' => 1,
                        'house_no' => $value['address_number'],
                        'postal_code' => $value['code_tax'],
                        'city' => $value['region'],
                        'country_id' => $value['country'],
                        'governorate_id' => $value['governorate']
                    ]);
                }
            }

            foreach ($request->phones as $key => $value) {
                if(! empty($value['phone_number'])){
                    $contact->phones()->create([
                        'phone_number' => $value['phone_number']
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr[]=$e->getMessage();
            return Response::json(array('fail' => true,'errors' => $arr));
        }

        return $contact->id;
    }

    public function store_product(Request $request)
    {
        $masterRules =[
            'product_code' => 'required|unique:products',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'product_type_id' => 'required',
        ];
        $validator = Validator::make(Input::all(), $masterRules);
        if ($validator->fails()){
            // If validation fails redirect back to login.
            return Response::json(array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }


        DB::beginTransaction();
        try {

            $input = $request->all();

            $input['user_id'] = Auth::user()->id; //this is only for frontend method
            // dd(  $input['created_by']);
            $product = Product::create($input);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr[]=$e->getMessage();
            return Response::json(array('fail' => true,'errors' => $arr));
        }

        return $product->id;
//
//        $input = $request->all();
//        dd($input);
    }
    public function store_draft(Request $request)
    {
        $user_id = Auth::user()->id;

        if(!isset($request->contact_id)){
            return 'Contact Must Not be Empty Please Choose Contact Name';
        }elseif (!isset($request->invoice_number) || $request->invoice_number==0) {
          return 'Invoice Number Must Not be Empty Please Enter Invoice Number';
        }elseif (Salary::where('invoice_number', '=', $request->invoice_number)->where('user_id','=',Auth::user()->id)->count() > 0) {
          return 'Invoice Number is already taken';
        }

        if ($request->input('old_draft_id') == -1){
            DB::beginTransaction();
            try {
                //get current user id for created by user:

                $contact_name = Contact::find($request->contact_id);
                $contact_type = ContactsToContactType::where('contact_id',$request->contact_id)->first();

                $inv = new Salary;
                $inv->invoice_number = $request->invoice_number;
                $inv->invoice_date = $request->invoice_date;
                $inv->contact_id = $request->contact_id;
                $inv->contact_name = $contact_name->first_name . ' ' . $contact_name->last_name;
                $inv->address = $request->address;
                $inv->due_date = $request->due_date;
                $status ;
                if($request->due_date ==  date('Y-m-d')){
                  $status = 3;
                }else{
                  $status = 2;
                }
                $inv->delivery_date = $request->delivery_date;
                $inv->reference_number = $request->reference_number;
                $inv->invoice_status_id = $status;
                $inv->user_id = $user_id;
                $inv->total_discount = $request->total_discount;
                $inv->total_amount = $request->total_amount;
                $inv->rest = $request->total_invoice;
                $inv->total_invoice = $request->total_invoice;
                $inv->save();
                $insertedId = $inv->id;

                \DB::table('account_reports')->insert([
                        'account_code'  => $contact_type->display_id,
                        'name'          => $inv->contact_name,
                        'invoice_number'   => $inv->invoice_number,
                        'invoice_type'  => 7,
                        'deal_type'     => trans('frontend/reports.addinv'),
                        'amount'        => $inv->total_invoice,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'user_id'       => Auth::user()->id
                    ]);

                foreach($request->details as $product) {
                        $inv->salaryItems()->create([
                            'salary_id' => $insertedId,
                            'product_name'  => $product['product_name'],
                            'quantity'      => $product['quantity'],
                            'unit_id'       => $product['unit_id'],
                            'price'         => $product['price'],
                            'discount'      => $product['discount'],
                            'amount'        => $product['amount'],
                            'account_id'    => $product['account_id']
                        ]);

                        $account = Account::find($product['account_id']);

                        \DB::table('account_reports')->insert([
                            'account_code'  => $account->account_code,
                            'name'          => $account->name,
                            'invoice_number'   => $inv->invoice_number,
                            'invoice_type'  => 7,
                            'deal_type'     => trans('frontend/reports.addinv'),
                            'amount'        => $inv->total_invoice,
                            'debtor'        => "----",
                            'creditor'      => "----",
                            'user_id'       => Auth::user()->id
                        ]);
                }
                    for ($i=1 ; $i < count($request->details)+1 ; $i++ ) {
                      for ($x=1; $x < count($tax_id)+1; $x++) { 
                        if(isset($tax_id[$i][$x])){
                          \DB::table('taxes_to_sales_invoice_items')->insert([
                           'sales_invoice_item_id' => $insertedId ,
                           'tax_id' => $tax_id[$i][$x],
                           'tax_rate' => $tax_rate[$i][$x],
                           'tax_name' => $tax_name[$i][$x],
                           'tax_sign' => $tax_sign[$i][$x],
                           'invoice_type' =>'7',
                           'invoice_number' => $request->invoice_number,
                           'account_id'    => $input['details'][$i]['account_id'],
                           'user_id' => Auth::user()->id,
                           'created_at' => Carbon::now(),
                           'updated_at' => Carbon::now(),
                         ]);
                        }else{
                          
                        }
                      }
                    }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return $e->getMessage();
            }
            return $insertedId;
        }else{
            DB::beginTransaction();
            try {
                $contact_name = Contact::find($request->contact_id);

                $inv = Salary::find($request->input('old_draft_id'));

               $inv->invoice_number = $request->invoice_number;
                $inv->invoice_date = $request->invoice_date;
                $inv->contact_id = $request->contact_id;
                $inv->contact_name = $contact_name->first_name . ' ' . $contact_name->last_name;
                $inv->address = $request->address;
                $inv->due_date = $request->due_date;
                $status ;
                if($request->due_date ==  date('Y-m-d')){
                  $status = 3;
                }else{
                  $status = 2;
                }
                $inv->delivery_date = $request->delivery_date;
                $inv->reference_number = $request->reference_number;
                $inv->invoice_status_id = $status;
                $inv->user_id = $user_id;
                $inv->total_discount = $request->total_discount;
                $inv->total_amount = $request->total_amount;
                $inv->rest = $request->total_invoice;
                $inv->total_invoice = $request->total_invoice;
                $inv->save();

                $inv->salaryItems()->delete();

                foreach($request->details as $product) {
                        $inv->salaryItems()->create([
                            'salary_id' => $insertedId,
                            'product_name'  => $product['product_name'],
                            'quantity'      => $product['quantity'],
                            'unit_id'       => $product['unit_id'],
                            'price'         => $product['price'],
                            'discount'      => $product['discount'],
                            'amount'        => $product['amount'],
                            'account_id'    => $product['account_id']
                        ]);
                }


                DB::commit();
            }catch (\Exception $e) {
                DB::rollback();
                return $e->getMessage();
            }
            return $request->input('old_draft_id');
        }

    }

    public function invoice_validation(Request $request)
    {


//        if(!isset($request->contact_id)){
//            return [
//                'errors' => ['Contact Must be Not Empty Please Choose Contact Name']
//            ];
//        }

        $rules = [
            'invoice_number' => 'required|integer|unique:salaries',
            'contact_id' => 'required|integer',
            'details.*.product_id' => 'required|integer',
        ];

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()){
            return Response::json([
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }


        return 1;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

//        return 0;
        $user_id = Auth::user()->id;
        $rules = [
            'invoice_number' => 'required|integer|unique:salaries',
            'contact_id' => 'required|integer',
            'details.*.product_id' => 'required|integer',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()){
            return Response::json([
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }


            DB::beginTransaction();
            try {
                $contact_name = Contact::find($request->contact_id);

                $inv = new Salary;
                $inv->invoice_number = $request->invoice_number;
                $inv->invoice_date = $request->invoice_date;
                $inv->contact_id = $request->contact_id;
                $inv->contact_name = $contact_name->first_name . ' ' . $contact_name->last_name;
                $inv->address = $request->address;
                $inv->due_date = $request->due_date;
                $inv->delivery_date = $request->delivery_date;
                $inv->reference_number = $request->reference_number;
                $inv->invoice_status_id = 2;
                $inv->user_id = $user_id;
                $inv->total_discount = $request->total_discount;
                $inv->total_amount = $request->total_amount;
                $inv->total_invoice = $request->total_invoice;
                $inv->save();
                $insertedId = $inv->id;



                foreach($request->details as $product) {
                    if(isset($product['product_id'])){
                        $inv->salaryItems()->create([
                            'salary_id' => $insertedId,
                            'product_name'  => $product['product_name'],
                            'quantity'      => $product['quantity'],
                            'unit_id'       => $product['unit_id'],
                            'price'         => $product['price'],
                            'discount'      => $product['discount'],
                            'amount'        => $product['amount'],
                            'account_id'    => 129 // not dynamic for now
                        ]);
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return ['errors' => [$e->getMessage()]];
            }
            return $insertedId;



//        $itemsCount = $request->items_count; // items count of sales invoice items
//        //$masterRules = [];
//        $masterRules = [
//            'invoice_number' => 'required|unique:sales_invoices',
//            'contact_id' => 'required',
//        ];
//        $detailsRules = [];
//        for ($i = 1; $i <= $itemsCount; $i++) {
//            $detailsRules['details.' . $i . '.product_id'] = 'required';
//         //   $detailsRules['details.' . $i . '.product_name'] = 'required';
////            $detailsRules['details.' . $i . '.product_name'] = 'required';
//        }
//
//        $rules = array_merge($masterRules, $detailsRules); // merge master input form with master details form rules
//        $this->validate($request, $rules);
//
//
//        //$input = $request->all();
//
//        DB::beginTransaction();
//        try {
//            //get current user id for created by user:
//            $user_id = Auth::user()->id; //this is only for frontend method
//            $contact_name = Contact::find($request->contact_id);
//
//            $inv = new SalesInvoice;
//            $inv->invoice_number = $request->invoice_number;
//            $inv->invoice_date = $request->invoice_date;
//            $inv->contact_id = $request->contact_id;
//            $inv->contact_name = $contact_name->first_name . ' ' . $contact_name->last_name;
//            $inv->address = $request->address;
//            $inv->header_text = $request->header_text;
//            $inv->footer_text = $request->footer_text;
//            $inv->due_date = $request->due_date;
//            $inv->delivery_date = $request->delivery_date;
//            $inv->reference_number = $request->reference_number;
//            $inv->invoice_status_id = 1;
//            $inv->user_id = $user_id;
//            $inv->total_discount = $request->total_discount;
//            $inv->total_amount = $request->total_amount;
//            $inv->total_invoice = $request->total_invoice;
//            $inv->save();
//            $insertedId = $inv->id;
//
//            for ($i = 1; $i <= $itemsCount; $i++) {
//                $inv->invoiceItems()->create([
//                    //'sales_invoice_id' => $insertedId,
//                    'product_id' => $request->details[$i]['product_id'],
//                    //'product_name' => $request->details[$i]['product_name'],
//                    'quantity' => $request->details[$i]['quantity'],
//                    'unit_id' => $request->details[$i]['unit_id'],
//                    'price' => $request->details[$i]['price'],
//                  //  'tax' => $request->details[$i]['tax'],
//                    'discount' => $request->details[$i]['discount'],
//                    'amount' => $request->details[$i]['amount'],
//                ]);
//            }
//            DB::commit();
//        } catch (\Exception $e) {
//            DB::rollback();
//            return Redirect()->back()->withInput()->with('success', $e->getMessage());
//        }
//
//        //  die('CREATED INVOICE NO:'.$insertedId);
//        return redirect()->route('sales_invoice.index')
//                        ->with('success', 'Sales Invoice  created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $user_id = Auth::user()->id;
        $this->data['page_title'] = trans('frontend/sales_invoice.create_edit');
        $this->data['unit'] = Unit::all()->pluck('name', 'id')->all();
        $this->data['tax_types'] = TaxType::get()->pluck('name', 'id')->all(); //
        $this->data['governorates'] = Governorate::all()->pluck('name', 'id')->all();
        $this->data['countries'] = Country::all()->pluck('name', 'id')->all();
        $data = Salary::find($id);
        $this->data['data'] = $data;
        $this->data['data_details'] = SalaryItem::where('salary_id', $id)->get();

        $this->data['user']=User::find(Auth::user()->id)->profile;
        $this->data['accounts'] = User::find( Auth::user()->id)->accounts()->orderBy('lineage', 'ASC')->get()->pluck('full_desc','id')->all();
        $this->data['accounts_major'] = User::find(Auth::user()->id)->accounts()->where('is_major',1)->get()->pluck('id')->toArray();
        $this->data['product_type'] = ProductType::all()->pluck('name', 'id')->all();

        $invoice_no_from_db = Salary::whereRaw('invoice_number = (select max(invoice_number) from salaries)')->get(['invoice_number']);
        $invoice_number_start=0;
        if(!count($invoice_no_from_db) > 0){
            $invoice_number_start = Setting::where('key' , 'sales_invoice_start')->get(['value'])->pluck('value')->all();
        }
        $invoice_number= count($invoice_no_from_db) > 0 ?$invoice_no_from_db[0]->invoice_number:$invoice_number_start[0];
        $this->data['invoice_number'] = count($invoice_no_from_db) > 0 ? ++$invoice_number: $invoice_number;

        $display_id = ContactsToContactType::whereRaw("display_id = (select max(display_id) from contacts_to_contact_types where contact_type_id = 1 AND user_id = $user_id )")->get(['display_id']);
        $contacts_customer_start = 0;
        if(!count($display_id) > 0){
            $contacts_customer_start = Setting::where('key' , 'contacts_customer_start')->get(['value'])->pluck('value')->all();
        }
        $this->data['taxes'] = Tax::orderBy('id','ASC')->get();
        $this->data['category'] = AccountCategory::orderBy('id','ASC')->get();
        $customer_number=count($display_id) > 0 ? $display_id[0]->display_id : $contacts_customer_start[0];
        $this->data['customer_number'] = count($display_id) > 0 ? ++$customer_number : $customer_number;

        return $this->view($this->userType . '.' . $this->module . '.' . 'edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //



        $itemsCount = $request['items_count']; // items count of sales invoice items

        $masterRules = [];
        $masterRules = [
            'invoice_number' => 'required|unique:salaries,invoice_number,' . Salary::find($id)->id,
            'contact_id' => 'required',
        ];
        $detailsRules = [];
        for ($i = 1; $i <= $itemsCount; $i++) {
            $detailsRules['details.' . $i . '.product_id'] = 'required';
            $detailsRules['details.' . $i . '.product_name'] = 'required';
            $detailsRules['details.' . $i . '.product_name'] = 'required';
        }

        $rules = array_merge($masterRules, $detailsRules); // merge master input form with master details form rules
        $this->validate($request, $rules);


        $input = $request->all();

        //get current user id for created by user:
        $input['user_id'] = Auth::user()->id; //this is only for frontend method

        $inv = Salary::find($id);
        ;
        $inv->invoice_number = $input['invoice_number'];
        $inv->invoice_date = $input['invoice_date'];
        $inv->contact_id = $input['contact_id'];
        $inv->contact_name = $input['contact_name'];
        $inv->address = $input['address'];
        $inv->header_text = $input['header_text'];
        $inv->footer_text = $input['footer_text'];
        $inv->payment_day = $input['payment_day'];
        $inv->delivery_date = $input['delivery_date'];
        $inv->reference_number = $input['reference_number'];
        $inv->invoice_status_id = $input['invoice_status_id'];
        $inv->user_id = $input['user_id'];
        $inv->discount = $input['total_discount'];
        $inv->net_amount = $input['net_amount'];
        $inv->save();
        $insertedId = $inv->id;

        // delete old values before insert the updated values in view
        SalaryItem::where('salary_id', $id)->delete();

        if ($insertedId) {
            for ($i = 1; $i <= $itemsCount; $i++) {
                echo $itemsCount;

                SalaryItem::create([
                    'salary_id' => $insertedId,
                    'product_id' => $input['details'][$i]['product_id'],
                    'product_name' => $input['details'][$i]['product_name'],
                    'quantity' => $input['details'][$i]['quantity'],
                    'unit_id' => $input['details'][$i]['unit_id'],
                    'price' => $input['details'][$i]['price'],
              //      'tax' => $input['details'][$i]['tax'],
                    'discount' => $input['details'][$i]['discount'],
                    'amount' => $input['details'][$i]['amount'],
                ]);
            }
        }

        return redirect()->route('salary.index')
                        ->with('success', 'Salary  updated successfully');
    }


    public function checkDueDateState()
    {
        $user_id = Auth::user()->id;
        $invoices = Salary::where('user_id' , $user_id)
            ->where('invoice_status_id' ,'=', 2)
            ->whereDate('due_date' ,'<=', date('Y-m-d'))
            ->orderBy('id', 'DESC')
            ->get();
        foreach($invoices as $invoice){
            $invoice->invoice_status_id = 3;
            $invoice->save();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        Salary::find($id)->delete();
        return redirect()->route('salary.index')
                        ->with('success', 'Salary  deleted successfully');
    }

    public function filter(Request $request,$invoiceNumber = null,$customer = null,$invoice_date=null ,$payment_day = null , $pages=10){
        //$this->checkDueDateState();
        if ($invoiceNumber != -1){
            $invoices = Salary::where('invoice_number','=', "$invoiceNumber")
                ->orderBy('id', 'desc')->get();
        }elseif($customer != -1 ){
            if($invoice_date !=-1 && $payment_day != -1) {
                $invoices = Salary::where('contact_id', '=', "$customer")
                    ->orwhere('invoice_date', '=', "$invoice_date")
                    ->orwhere('delivery_date', '=', "$payment_day")
                    ->orderBy('id', 'desc')->get();
            }elseif($invoice_date !=-1){
                $invoices = Salary::where('contact_id', '=', "$customer")
                    ->orwhere('invoice_date', '=', "$invoice_date")
                    ->orderBy('id', 'desc')->get();
            }elseif($payment_day != -1){
                $invoices = Salary::where('contact_id', '=', "$customer")
                    ->orwhere('delivery_date', '=', "$payment_day")
                    ->orderBy('id', 'desc')->get();
            }else{
                $invoices = Salary::where('contact_id', '=', "$customer")
                    ->orderBy('id', 'desc')->get();
            }
        }elseif($payment_day != -1 || $invoice_date !=-1){
            if($invoice_date !=-1 && $payment_day != -1) {
                $invoices = Salary::where('invoice_date', '=', "$invoice_date")
                    ->orwhere('delivery_date', '=', "$payment_day")
                    ->orderBy('id', 'desc')->get();
            }elseif($invoice_date !=-1){
                $invoices = Salary::where('invoice_date', '=', "$invoice_date")
                    ->orderBy('id', 'desc')->get();
            }elseif($payment_day != -1){
                $invoices = Salary::where('delivery_date', '=', "$payment_day")
                    ->orderBy('id', 'desc')->get();
            }
        }else{
                  $invoices = Salary::all();
        }

//        $invoices = SalesInvoice::where('invoice_number','=', "$request->filterInvoiceNumber")
//            ->orwhere('contact_id','=',"$request->filterCustomer")
//            ->orwhere('invoice_date','=',"$request->filterInvoice_date")
//            ->orwhere('payment_day','=',"$request->filterPayment_day")
//            ->orderBy('id', 'desc')->paginate($pages);

        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadInvoicesWithStatus', ['data' => $invoices])->render();
        }

//        return View('DepartmentsManager.index',compact('governorates','regions','departments','govern','regon'));
    }

    //=========================================================
    //Helper methods
    //=========================================================
}
