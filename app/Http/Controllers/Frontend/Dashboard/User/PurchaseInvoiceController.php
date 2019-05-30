<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use App\Models\ContactsToContactType;
use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Http\Request;
//use Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceItem;
use App\Models\Account;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\TaxType;
use App\Models\Contact;
use App\Models\ContactAddress;
use App\Models\Unit;
use App\Models\InvoiceStatus;
use Config;
use Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use View;
use Illuminate\Contracts\Encryption\DecryptException;

class PurchaseInvoiceController extends DashboardBaseController {

    protected $userType = 'user';
    protected $module = 'purchase_invoice';

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
        $this->checkDueDateState();
        $user_id = Auth::user()->id;

        $this->data['data'] = SalesInvoice::where('user_id' , $user_id)->orderBy('id', 'DESC')->paginate(10);
        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadInvoicesWithStatus', $this->data)->render();
        }

        $this->data['page_title'] = trans('frontend/sales_invoice.title');
        $this->data['user_type'] = Auth::user()->roles;
        return $this->view($this->userType . '.' . $this->module . '.' . 'index', $this->data)
                        ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    public function LoadAjaxFilterStatus(Request $request, $status) {
        $this->checkDueDateState();
        if ($status == 0) {
            $data = SalesInvoice::orderBy('id', 'DESC')->paginate(10);
        } else {
            $InvoiceStatus = InvoiceStatus::find($status);
            $data = $InvoiceStatus->salesInvoices()->paginate(10);
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
        $address = ContactAddress::where('contact_id', $id)->first();
        return "$address->name\n$address->street/$address->house_no {$address->country->name}\n$address->city\n$address->postal_code\n";
    }

    public function getContactAddressByID($id) {
        $address = ContactAddress::where('id', $id)->first();
        return "$address->name\n$address->street/$address->house_no {$address->country->name}\n$address->city\n$address->postal_code\n";
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
        $contacts = Contact::where('first_name', 'like', "%$request->text%")->get(['first_name', 'id']);
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
        $this->data['contacts'] = Contact::where('contact_type_id', 1)->get()->pluck('full_name', 'id')->all(); //\ 1 customer       
        $this->data['invoice_status'] = InvoiceStatus::all()->pluck('name', 'id')->all(); //
        $this->data['products'] = Product::all()->pluck('name', 'id')->all(); //        
        $this->data['tax_types'] = TaxType::get()->pluck('name', 'id')->all(); //            
        $this->data['unit'] = Unit::all()->pluck('name', 'id')->all(['name', 'id']);
        $this->data['user_id'] = Auth::user()->id;

        $invoice_no_from_db = SalesInvoice::whereRaw('invoice_number = (select max(invoice_number) from sales_invoices)')->get(['invoice_number']);
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
            return 'Contact Must be Not Empty Please Choose Contact Name';
        }

        if ($request->input('old_draft_id') == -1){
            DB::beginTransaction();
            try {
                //get current user id for created by user:

                $contact_name = Contact::find($request->contact_id);

                $inv = new SalesInvoice;
//                $inv->invoice_number = $request->invoice_number;
                $inv->invoice_date = $request->invoice_date;
                $inv->contact_id = $request->contact_id;
                $inv->contact_name = $contact_name->first_name . ' ' . $contact_name->last_name;
                $inv->address = $request->address;
                $inv->header_text = $request->header_text;
                $inv->footer_text = $request->footer_text;
                $inv->due_date = $request->due_date;
                $inv->delivery_date = $request->delivery_date;
                $inv->reference_number = $request->reference_number;
                $inv->invoice_status_id = 1;
                $inv->user_id = $user_id;
                $inv->total_discount = $request->total_discount;
                $inv->total_amount = $request->total_amount;
                $inv->total_invoice = $request->total_invoice;
                $inv->save();
                $insertedId = $inv->id;



                foreach($request->details as $product) {
                    if(isset($product['product_id'])){
                        $inv->invoiceItems()->create([
                            //'sales_invoice_id' => $insertedId,
                            'product_id'    => $product['product_id'],
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
                return $e->getMessage();
            }
            return $insertedId;
        }else{
            DB::beginTransaction();
            try {
                $contact_name = Contact::find($request->contact_id);

                $inv = SalesInvoice::find($request->input('old_draft_id'));

//              $inv->invoice_number = $request->invoice_number;
                $inv->invoice_date = $request->invoice_date;
                $inv->contact_id = $request->contact_id;
                $inv->contact_name = $contact_name->first_name . ' ' . $contact_name->last_name;
                $inv->address = $request->address;
                $inv->header_text = $request->header_text;
                $inv->footer_text = $request->footer_text;
                $inv->due_date = $request->due_date;
                $inv->delivery_date = $request->delivery_date;
                $inv->reference_number = $request->reference_number;
                $inv->invoice_status_id = 1;
                $inv->user_id = $user_id;
                $inv->total_discount = $request->total_discount;
                $inv->total_amount = $request->total_amount;
                $inv->total_invoice = $request->total_invoice;
                $inv->save();

                $inv->invoiceItems()->delete();

                foreach($request->details as $product) {
                    if(isset($product['product_id'])){
                        $inv->invoiceItems()->create([
                            //'sales_invoice_id' => $insertedId,
                            'product_id'    => $product['product_id'],
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
            'invoice_number' => 'required|integer|unique:sales_invoices',
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
            'invoice_number' => 'required|integer|unique:sales_invoices',
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

                $inv = new SalesInvoice;
                $inv->invoice_number = $request->invoice_number;
                $inv->invoice_date = $request->invoice_date;
                $inv->contact_id = $request->contact_id;
                $inv->contact_name = $contact_name->first_name . ' ' . $contact_name->last_name;
                $inv->address = $request->address;
                $inv->header_text = $request->header_text;
                $inv->footer_text = $request->footer_text;
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
                        $inv->invoiceItems()->create([
                            //'sales_invoice_id' => $insertedId,
                            'product_id'    => $product['product_id'],
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
        $this->data['page_title'] = trans('frontend/sales_invoice.create_edit');
        $this->data['contacts'] = Contact::where('contact_type_id', 1)->get()->pluck('full_name', 'id')->all(); //\ 1 customer       
        $this->data['invoice_status'] = InvoiceStatus::all()->pluck('name', 'id')->all(); //            
        $this->data['products'] = Product::all()->pluck('name', 'id')->all(); //        
        $this->data['unit'] = Unit::all()->pluck('name', 'id')->all();
        $this->data['user_id'] = Auth::user()->id;
        $data = SalesInvoice::find($id);
        $this->data['data'] = $data;
        //details form data
        $this->data['data_details'] = SalesInvoiceItem::where('sales_invoice_id', $id)->get();
        $this->data['details_count'] = $data->details_count;



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
            'invoice_number' => 'required|unique:sales_invoices,invoice_number,' . SalesInvoice::find($id)->id,
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

        $inv = SalesInvoice::find($id);
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
        SalesInvoiceItem::where('sales_invoice_id', $id)->delete();

        if ($insertedId) {
            for ($i = 1; $i <= $itemsCount; $i++) {
                echo $itemsCount;

                SalesInvoiceItem::create([
                    'sales_invoice_id' => $insertedId,
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

        return redirect()->route('sales_invoice.index')
                        ->with('success', 'Sales Invoice  updated successfully');
    }


    public function checkDueDateState()
    {
        $user_id = Auth::user()->id;
        $invoices = SalesInvoice::where('user_id' , $user_id)
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
        SalesInvoice::find($id)->delete();
        return redirect()->route('sales_invoice.index')
                        ->with('success', 'Sales Invoice  deleted successfully');
    }

    public function filter(Request $request,$invoiceNumber = null,$customer = null,$invoice_date=null ,$payment_day = null , $pages=10){
        $this->checkDueDateState();
        if ($invoiceNumber != -1){
            $invoices = SalesInvoice::where('invoice_number','=', "$invoiceNumber")
                ->orderBy('id', 'desc')->paginate($pages);
        }elseif($customer != -1 ){
            if($invoice_date !=-1 && $payment_day != -1) {
                $invoices = SalesInvoice::where('contact_id', '=', "$customer")
                    ->orwhere('invoice_date', '=', "$invoice_date")
                    ->orwhere('payment_day', '=', "$payment_day")
                    ->orderBy('id', 'desc')->paginate($pages);
            }elseif($invoice_date !=-1){
                $invoices = SalesInvoice::where('contact_id', '=', "$customer")
                    ->orwhere('invoice_date', '=', "$invoice_date")
                    ->orderBy('id', 'desc')->paginate($pages);
            }elseif($payment_day != -1){
                $invoices = SalesInvoice::where('contact_id', '=', "$customer")
                    ->orwhere('payment_day', '=', "$payment_day")
                    ->orderBy('id', 'desc')->paginate($pages);
            }else{
                $invoices = SalesInvoice::where('contact_id', '=', "$customer")
                    ->orderBy('id', 'desc')->paginate($pages);
            }
        }elseif($payment_day != -1 || $invoice_date !=-1){
            if($invoice_date !=-1 && $payment_day != -1) {
                $invoices = SalesInvoice::where('invoice_date', '=', "$invoice_date")
                    ->orwhere('payment_day', '=', "$payment_day")
                    ->orderBy('id', 'desc')->paginate($pages);
            }elseif($invoice_date !=-1){
                $invoices = SalesInvoice::where('invoice_date', '=', "$invoice_date")
                    ->orderBy('id', 'desc')->paginate($pages);
            }elseif($payment_day != -1){
                $invoices = SalesInvoice::where('payment_day', '=', "$payment_day")
                    ->orderBy('id', 'desc')->paginate($pages);
            }
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
