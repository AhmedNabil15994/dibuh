<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;
//namespace App\Http\Controllers;
use App\Models\ContactsToContactType;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\Setting;
//use App\Models\UserSetting;
use Illuminate\Http\Request;
use App\Models\Category;
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
use App\Models\Finance_bank;
use App\Models\Finance_treasury;
use App\Models\Finance_credit;
use App\Models\currency_table;
use App\Models\InvoiceStatus;
use App\Models\Installment;
//use App\Models\Category;
use Config;
use Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use View;
use PDF;
use Excel;
use App\Models\TaxSalesInvoiceItem;
use Illuminate\Contracts\Encryption\DecryptException;

class SalesInvoiceController extends DashboardBaseController {

    protected $userType = 'user';
    protected $module = 'sales_invoice';

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
      //dd("hello index");
        $this->checkDueDateState();
        $user_id = Auth::user()->id;

        $this->data['data'] = SalesInvoice::where('user_id' , $user_id)->where('status','=',0)->orderBy('invoice_number', 'DESC')->get();
        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadInvoicesWithStatus', $this->data)->render();
        }

        $this->data['page_title'] = trans('frontend/sales_invoice.title');
        $this->data['user_type'] = Auth::user()->roles;
        return $this->view($this->userType . '.' . $this->module . '.' . 'index', $this->data)
                        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function show($id) {
      //get finance bank and treasury
            $user_id = Auth::user()->id;
              $this->data['governorates'] = Governorate::all()->pluck('name', 'id')->all();
             $currency = currency_table::all()->pluck('name', 'id')->all();
            $this->data['currency']=$currency;
              $finance_banks = Finance_bank::where('user_id' , $user_id)
                  ->get(['id','account_owner as owner_name','serial_number' , 'bank_balance as balance' , 'currency_id']);
              $finance_treasury = Finance_treasury::where('user_id' , $user_id)
                  ->get(['id','treasury_name as owner_name','serial_number' , 'start_balance as balance','currency_id']);

              $bank_row_serial_number = Finance_bank::whereRaw("serial_number = (select max(serial_number) from finance_banks where user_id = $user_id )")->get(['serial_number']);
              $bank_serial_number_start=0;
              if(!count($bank_row_serial_number) > 0){
                  $bank_serial_number_start = Setting::where('key' , 'finance_banks_start')->get(['value'])->pluck('value')->all();
              }
              $bank_serial_number = count($bank_row_serial_number) > 0 ? $bank_row_serial_number[0]->serial_number : $bank_serial_number_start[0];
              $this->data['bank_serial_number'] = count($bank_row_serial_number) > 0 ? ++$bank_serial_number : $bank_serial_number;
              $treasury_row_serial_number = Finance_treasury::whereRaw("serial_number = (select max(serial_number) from finance_treasury where user_id = $user_id )")->get(['serial_number']);
              $treasury_serial_number_start = 0;
              if(!count($treasury_row_serial_number) > 0){
                  $treasury_serial_number_start = Setting::where('key' , 'finance_treasury_start')->get(['value'])->pluck('value')->all();
              }
              $treasury_serial_number = count($treasury_row_serial_number) > 0 ? $treasury_row_serial_number[0]->serial_number : $treasury_serial_number_start[0];

              $this->data['treasury_serial_number'] = count($treasury_row_serial_number) > 0 ? ++$treasury_serial_number : $treasury_serial_number;
              $credit_row_serial_number = Finance_credit::whereRaw("serial_number = (select max(serial_number) from finance_credit where user_id = $user_id )")->get(['serial_number']);
              $credit_serial_number_start = 0;

              if(!count($credit_row_serial_number) > 0 ){
                  $credit_serial_number_start = Setting::where('key' , 'finance_credit_start')->get(['value'])->pluck('value')->all();
              }
              $credit_serial_number = count($credit_row_serial_number) > 0 ? $credit_row_serial_number[0]->serial_number : $credit_serial_number_start[0];
              $this->data['credit_serial_number'] = count($credit_row_serial_number) > 0 ? ++$credit_serial_number : $credit_serial_number;
            //  $arr=[];
                // $this->data['finances'] = $finance_treasury;
          //      Request $r=new Request();
    //    $this->data['finances'] = $this::getFinancesJson( );

        //
        $this->data['page_title'] = trans('frontend/sales_invoice.create_edit');
        $this->data['sales_invoice'] = SalesInvoice::find($id);
        $this->data['data']=User::find(Auth::user()->id)->profile;
        $this->data['bank_data'] = \DB::table('user_bank_accounts')->where('user_id','=',Auth::user()->id)->first();

    //   dd(  $this->date);

//dd($this->data);
        return $this->view($this->userType . '.' . $this->module . '.' . 'show',$this->data);
    }
      public function draft_to_invoice($id=0) {
        $user_id = Auth::user()->id;

       $invoice_no_from_db= SalesInvoice::where('user_id',$user_id)->orderBy('invoice_number','desc')->get();

        $invoice_number_start=0;
        if(!count($invoice_no_from_db) > 0){
            $invoice_number_start = Setting::where('key' , 'sales_invoice_start')->get(['value'])->pluck('value')->all();
        }

        $invoice_number= count($invoice_no_from_db) > 0 ?$invoice_no_from_db[0]->invoice_number:$invoice_number_start[0];
        $invoice_number_ = count($invoice_no_from_db) > 0 ? ++$invoice_number: $invoice_number;
       if($id==0)
       {
        // Request $request;
         $this_invoice=SalesInvoice::find($_GET["id"]);
       }
       else
        $this_invoice=SalesInvoice::find($id);
        $this_invoice->invoice_number=$invoice_number_;
         $this_invoice->invoice_status_id=3;
        $this_invoice->save();


        return 1;

      }
    public function download_pdf($id) {

          $path='frontend.u_bold.dashboard.user.'. $this->module . '.' . 'pdf';
          $this->data['page_title'] = trans('frontend/sales_invoice.create_edit');
          $this_invoice=SalesInvoice::find($id);
          $this->data['user_id'] = Auth::user()->id;
          $this->data['sales_invoice'] =SalesInvoice::find($id);
          $this->data['bank_data'] = \DB::table('user_bank_accounts')->where('user_id','=',Auth::user()->id)->first();
          if($this_invoice->invoice_status_id==1){
            $this->draft_to_invoice($id);
          }
          $this->data['data']=User::find(Auth::user()->id)->profile;

          $pdf = PDF::loadView($path, $this->data,[], [
                    'format' => 'A4-M'
                  ]);

         return $pdf->download($this_invoice->contact_name ." ". $this_invoice->invoice_number .'.pdf');
    }
    public function downloadprices($id) {

          $path='frontend.u_bold.dashboard.user.'. $this->module . '.' . 'prices';
          $this->data['page_title'] = trans('frontend/sales_invoice.create_edit');
          $this_invoice=SalesInvoice::find($id);
          $this->data['sales_invoice'] =SalesInvoice::find($id);
          $this->data['bank_data'] = \DB::table('user_bank_accounts')->where('user_id','=',Auth::user()->id)->first();
          $this->data['data']=User::find(Auth::user()->id)->profile;

          $pdf = PDF::loadView($path, $this->data,[], [
                    'format' => 'A4-M'
                  ]);

         return $pdf->download($this_invoice->contact_name ." ". $this_invoice->invoice_number .'.pdf');
    }
          public function export_pdf() {
            $user_id = Auth::user()->id;
            $this->data['page_title'] = trans('frontend/sales_invoice.title');
            $data = SalesInvoice::where('user_id' , $user_id)->orderBy('invoice_number', 'DESC')->get(['invoice_status_id','invoice_number','contact_name','invoice_date','delivery_date','total_discount','total_amount']);

            $dataArray[] = [trans('frontend/sales_invoice.status'), trans('frontend/sales_invoice.invoice_number'),trans('frontend/sales_invoice.customer')
                          ,trans('frontend/sales_invoice.date'),trans('frontend/sales_invoice.received_date'),trans('frontend/sales_invoice.discount'),trans('frontend/sales_invoice.final_cost')];
     
            foreach ($data as $d) {
              $dataArray[] = $d->toArray();
            }
            Excel::create('Laravel Excel', function($excel) use($dataArray) {
                $excel->setTitle('Invoices');
                $excel->sheet('Excel sheet', function($sheet) use($dataArray) {
                  $sheet->fromArray($dataArray, null, 'A1', false, false);
                  $sheet->setOrientation('landscape');
                });

            })->export('pdf');


          }
      public function export_excel() {

          $user_id = Auth::user()->id;
          $this->data['page_title'] = trans('frontend/sales_invoice.title');
          $data = SalesInvoice::where('user_id' , $user_id)->orderBy('invoice_number', 'DESC')->get(['invoice_status_id','invoice_number','contact_name','invoice_date','delivery_date','total_discount','total_amount']);

        $dataArray[] = [trans('frontend/sales_invoice.status'), trans('frontend/sales_invoice.invoice_number'),trans('frontend/sales_invoice.customer')
                       ,trans('frontend/sales_invoice.date'),trans('frontend/sales_invoice.received_date'),trans('frontend/sales_invoice.discount'),trans('frontend/sales_invoice.final_cost')];
  // $status=trans('frontend/sales_invoice.status');
      $dataArray[] = ['الحاله ',' رقم الفاتوره ',' العميل ',' التاريخ ',' تاريخ الاستلام ',' الخصم ','المبلغ الصافى '];

        foreach ($data as $d) {
             $dataArray[] = $d->toArray();
             }
        Excel::create('Laravel Excel', function($excel) use($dataArray) {
              $excel->setTitle('Invoices');

            $excel->sheet('Excel sheet', function($sheet) use($dataArray) {
              $sheet->fromArray($dataArray, null, 'A1', false, false);


            $sheet->setOrientation('landscape');

          });

        })->export('xls');
        // $path='frontend.u_bold.dashboard.user.'. $this->module . '.' . 'index';
        // $this->data['page_title'] = trans('frontend/sales_invoice.create_edit');
        // $this->data['data'] = SalesInvoice::where('user_id' , $user_id)->orderBy('invoice_number', 'DESC')->get();
        // Excel::create('New file', function($excel) {
        //
        //        $excel->sheet('New sheet', function($sheet) {
        //
        //         $sheet->loadView('frontend.u_bold.dashboard.user.'. $this->module . '.' . 'index',$this->data);
        //
        //                            });
        //
        //       });


    }
    public function export_csv() {
              //  $path='frontend.u_bold.dashboard.user.'. $this->module . '.' . 'pdf';

               $user_id = Auth::user()->id;

              $data = SalesInvoice::where('user_id' , $user_id)->orderBy('invoice_number', 'DESC')->get(['invoice_status_id','invoice_number','contact_name','invoice_date','delivery_date','total_discount','total_amount']);
              $dataArray[] = ['الحاله ',' رقم الفاتوره ',' العميل ',' التاريخ ',' تاريخ الاستلام ',' الخصم ','المبلغ الصافى '];
            foreach ($data as $d) {
                 $dataArray[] = $d->toArray();
                 }
            Excel::create('Laravel Excel', function($excel) use($dataArray) {
                  $excel->setTitle('Invoices');
                  $excel->sheet('Excel sheet', function($sheet) use($dataArray) {
                  $sheet->fromArray($dataArray, null, 'A1', false, false);
                    $sheet->setOrientation('landscape');

           });

         })->download('csv');

              }
      public function export_html() {


                            $user_id = Auth::user()->id;

                           $data = SalesInvoice::where('user_id' , $user_id)->orderBy('invoice_number', 'DESC')->get(['invoice_status_id','invoice_number','contact_name','invoice_date','delivery_date','total_discount','total_amount']);
                           $dataArray[] = [trans('frontend/sales_invoice.status'), trans('frontend/sales_invoice.invoice_number'),trans('frontend/sales_invoice.customer')
                                       ,trans('frontend/sales_invoice.date'),trans('frontend/sales_invoice.received_date'),trans('frontend/sales_invoice.discount'),trans('frontend/sales_invoice.final_cost')];

                         foreach ($data as $d) {
                              $dataArray[] = $d->toArray();
                              }
                         Excel::create('Laravel Excel', function($excel) use($dataArray) {
                               $excel->setTitle('Invoices');
                               $excel->sheet('Excel sheet', function($sheet) use($dataArray) {
                               $sheet->fromArray($dataArray, null, 'A1', false, false);
                                 $sheet->setOrientation('landscape');

                        });

                      })->download('html');


                        }




    public function LoadAjaxFilterStatus(Request $request, $status) {
        $this->checkDueDateState();
        if ($status == 0) {
            $data = SalesInvoice::where('status','=',0)->orderBy('id', 'DESC')->get();
        } else {
            $InvoiceStatus = InvoiceStatus::find($status);
            $data = $InvoiceStatus->salesInvoices()->where('status','=',0)->get();
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
         return "$address->name\n$address->street/$address->house_no {$address->country->name}\n$address->city\n$address->postal_code\n";
 //return"test" ;
    }

    public function getProductData(Request $request) {
        $products = Product::where('id', '=', "$request->id")->where('user_id','=',Auth::user()->id)->where('time_no','=',0)->get();
        return Response::json($products);
    }

    public function getAccountData(Request $request) {
        $accounts = Account::where('id', '=', $request->id)->get();
//                dd($accounts);
        return Response::json($accounts);

    }


    public function getContactPhones(Request $request){
        $contact_phones=Contact::find($request->id)->phones()->where('user_id','=',Auth::user()->id)->first()->phone_number;
        $data='';
        if(isset($contact_phones)){
          $data = $contact_phones;
        }
         return Response::json($data);
    }

    public function getContactEmail(Request $request){
        $con=Contact::where('user_id','=',Auth::user()->id)->find($request->id);
        $email = $con->email;
        $data='';
        if(!empty($email)){
          $data = $email;
        }
        return Response::json($data);
    }

    public function getContactsJson(Request $request) {
        //$contacts = Contact::all();
        $contacts = \DB::table('contacts')->join('contacts_to_contact_types','contacts.id','=','contacts_to_contact_types.contact_id')->where('contacts.user_id' , '=' ,Auth::user()->id)->where('contacts_to_contact_types.contact_type_id' , '=' ,1)->where('first_name', 'like', "%$request->text%")->get(['contacts.first_name','contacts.last_name' ,'contacts.id']);
        //Contact::where('first_name', 'like', "%$request->text%")->get(['first_name', 'id','last_name']);
        return Response::json($contacts);
    }
    public function getFinancesJson() {
      $user_id = Auth::user()->id;
        $financArr = [];
        $financArr1 = [];
        $financArr2 = [];
        $financArr3 = [];
        $finance_banks = Finance_bank::where('user_id' , $user_id)
                 ->get(['id','account_owner as owner_name']);
        $finance_treasury = Finance_treasury::where('user_id' , $user_id)
             ->get(['id','treasury_name as owner_name']);
            $finance_credit = Finance_credit::where('user_id' , $user_id)
                ->get(['id','credit_owner as owner_name']);

        $arr=[];
        $default=[];
        foreach ($finance_banks as $bank){


            $financArr[$bank->id .'|1'] = $bank->owner_name.'['.trans('frontend/sales_invoice.bank_type').']';
            $financArr1[$bank->id .'|1'] = $bank->owner_name.'['.trans('frontend/sales_invoice.bank_type').']';
        }
        foreach ($finance_treasury as $treasury){

            $financArr[$treasury->id .'|2'] = $treasury->owner_name.'['.trans('frontend/sales_invoice.treasury_type').']';
            $financArr2[$treasury->id .'|2'] = $treasury->owner_name.'['.trans('frontend/sales_invoice.treasury_type').']';
        }

            foreach ($finance_credit as $credit){

                $financArr[$credit->id .'|3'] = $credit->owner_name.'['.trans('frontend/sales_invoice.credit_type').']';
                $financArr3[$credit->id .'|3'] = $credit->owner_name.'['.trans('frontend/sales_invoice.credit_type').']';
            }

     $count=count($financArr);
     $count1=count($financArr1);
     $count2=count($financArr2);
     $count3=count($financArr3);
      return Response::json(array('financArr'=>$financArr,'financArr1'=>$financArr1,'financArr2'=>$financArr2,'financArr3'=>$financArr3,'count'=>$count,'count1'=>$count1,'count2'=>$count2,'count3'=>$count3 ));

    }

    public function getproductsJson(Request $request) {
        $products = Product::where('name', 'like', "%$request->text%")->where('user_id','=',Auth::user()->id)->where('time_no','=',0)->get(['name', 'id']);
        return Response::json($products);
    }

    public function getAccountsJson(Request $request) {
        $accounts = Account::where('name', 'like', "%$request->text%")->get(['name', 'id']);
        return Response::json($accounts);
    }

    public function getTaxFieldsView(Request $request) {

        $accounts = Account::find( $request->id);
        $rowNum = $request->num ;
        $tax_types = TaxType::orderBy('id','ASC')->get();
        $this->data =  compact('accounts','rowNum','tax_types');
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
        $user_id = Auth::user()->id;
          //  dd($user_id);
        $this->data['page_title'] = trans('frontend/sales_invoice.create_new');

        $this->data['contacts'] = \DB::table('contacts')->join('contacts_to_contact_types','contacts.id','=','contacts_to_contact_types.contact_id')->where('contacts_to_contact_types.contact_type_id' , '=' ,1)->get();
        //Contact::where('contact_type_id', 1)->get()->pluck('full_name', 'id')->all(); //\ 1 customer
   //new code
    //$dt=Product::all();

        $this->data['invoice_status'] = InvoiceStatus::all()->pluck('name', 'id')->all(); //
        $this->data['products'] = Product::all()->where('time_no','0')->pluck('name', 'id')->all(); //
        $this->data['tax_types'] = TaxType::get()->pluck('name', 'id')->all(); //
        $this->data['unit'] = Unit::all()->pluck('name', 'id')->all(['name', 'id']);
        $this->data['user_id'] = $user_id;

      // old code  $invoice_no_from_db = SalesInvoice::whereRaw('invoice_number = (select max(invoice_number) from sales_invoices)')->get(['invoice_number']);

       $invoice_no_from_db= SalesInvoice::where('user_id',$user_id)->orderBy('invoice_number','desc')->get();

        $invoice_number_start=0;
        if(!count($invoice_no_from_db) > 0){
            $invoice_number_start = Setting::where('key' , 'sales_invoice_start')->get(['value'])->pluck('value')->all();
        }


        $invoice_number= count($invoice_no_from_db) > 0 ?$invoice_no_from_db[0]->invoice_number:$invoice_number_start[0];
        $this->data['invoice_number'] = count($invoice_no_from_db) > 0 ? ++$invoice_number: $invoice_number;
        $this->data['countries'] = Country::all()->pluck('name', 'id')->all();
        $this->data['governorates'] = Governorate::all()->pluck('name', 'id')->all();

        $display_id = ContactsToContactType::whereRaw("display_id = (select max(display_id) from contacts_to_contact_types where contact_type_id = 1 AND user_id = $user_id )")->get(['display_id']);
        $contacts_customer_start = 0;
        if(!count($display_id) > 0){
            $contacts_customer_start = Setting::where('key' , 'contacts_customer_start')->get(['value'])->pluck('value')->all();
        }
        //  dd(   $invoice_number_start);
        $customer_number=count($display_id) > 0 ? $display_id[0]->display_id : $contacts_customer_start[0];
        $this->data['customer_number'] = count($display_id) > 0 ? ++$customer_number : $customer_number;
        $this->data['unit'] = Unit::all()->pluck('name', 'id')->all();
	  	  $this->data['accounts'] = Account::orderBy('lineage', 'ASC')->get()->pluck('full_desc','id')->all();
        $this->data['accounts_major'] = Account::where('is_major',1)->get()->pluck('id')->toArray();
        $this->data['tax_type'] = TaxType::get()->pluck('name', 'id')->all();
		    $this->data['category'] = Category::orderBy('id','DESC')->get();
        $this->data['product_type'] = ProductType::all()->pluck('name', 'id')->all();

        $this->data['user']=User::find(Auth::user()->id)->profile;
//  dd($this->data);
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
    //  dd($request->all());

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
                        'governorate_id' => $value['governorate'],
                        'postal_code'=>$value['postal_code']
                    ]);
                }
            }

            foreach ($request->phones as $key => $value) {
                if(! empty($value['phone_number'])){
                    $contact->phones()->create([
                        'phone_number' => $value['phone_number'],
                        'user_id'      => $user_id
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
    // store installment
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
      $thesale_invoice=SalesInvoice::find($request->input('invoice_id'));

    if($request->input('paid')>$thesale_invoice->rest){
      return Response::json(array(
          'fail' => true,
          'errors' => ['The money paid must be less  or equal than the rest of the invoice']

      ));

    }

      DB::beginTransaction();
      try {
             $fincIdType = explode('|', $request->get('finance_id'));
             $fincId     = $fincIdType[0];
             $fincType   = $fincIdType[1];
             $newRest=$thesale_invoice->rest-$request->input('paid');
             $thesale_invoice->rest=$newRest;
          if($newRest==0)
             $thesale_invoice->invoice_status_id=4;
          else
             $thesale_invoice->invoice_status_id=5;
             $thesale_invoice->save();
             $stallement=new Installment();
             $stallement->sales_invoice_id=$request->input('invoice_id');
             $stallement->paid_date=$request->input('paid_date');
             $stallement->paid=$request->input('paid');
             $stallement->finance_id= $fincId;
             $stallement->finance_type=$fincType;
             $stallement->finance_notes=$request->input('finance_notes');
             $stallement->user_id = Auth::user()->id;
             $stallement->save();
     //adding the pain in finances
             if($fincType==1)
             {
               $theFinance=Finance_bank::find($fincId);
               $theFinance->bank_balance=$theFinance->bank_balance+$request->input('paid');
               $theFinance->save();

               $account_code = $theFinance->serial_number;
               $invoice_number = SalesInvoice::where('id','=',$request->input('invoice_id'))->first();
               \DB::table('account_reports')->insert([
                        'account_code'  => $account_code,
                        'name'          => $theFinance->account_owner,
                        'invoice_number'   => $invoice_number->invoice_number,
                        'invoice_type'  => 1,
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
               $theFinance->start_balance=$theFinance->start_balance+$request->input('paid');
               $theFinance->save();

               $account_code = $theFinance->serial_number;
               $invoice_number = SalesInvoice::where('id','=',$request->input('invoice_id'))->first();
               \DB::table('account_reports')->insert([
                        'account_code'  => $account_code,
                        'name'          => $theFinance->treasury_name,
                        'invoice_number'   => $invoice_number->invoice_number,
                        'invoice_type'  => 1,
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
               $theFinance->credit_balance=$theFinance->credit_balance+$request->input('paid');
               $theFinance->save();

               $account_code = $theFinance->serial_number;
               $invoice_number = SalesInvoice::where('id','=',$request->input('invoice_id'))->first();
               \DB::table('account_reports')->insert([
                        'account_code'  => $account_code,
                        'name'          => $theFinance->credit_owner,
                        'invoice_number'   => $invoice_number->invoice_number,
                        'invoice_type'  => 1,
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

       return 2;

    }
    //===delete installment
    public function delete_installement(Request $r,$id=0) {

      if($id==0)
        $id=$r->input('id');


      $theInstallment=Installment::find($id);
      $thesale_invoice=SalesInvoice::find($theInstallment->sales_invoice_id);
      DB::beginTransaction();
      try {

             $newRest=$thesale_invoice->rest+$theInstallment->paid;
             $thesale_invoice->rest=$newRest;
          if($newRest==$thesale_invoice->total_invoice)
             $thesale_invoice->invoice_status_id=3;
          else
             $thesale_invoice->invoice_status_id=5;
             $thesale_invoice->save();

             if($theInstallment->finance_type==1)
             {
               $theFinance=Finance_bank::find($theInstallment->finance_id);
               $theFinance->bank_balance=$theFinance->bank_balance-$theInstallment->paid;
               $theFinance->save();

             }elseif($theInstallment->finance_type==2){
               $theFinance=Finance_treasury::find($theInstallment->finance_id);
               $theFinance->start_balance=$theFinance->start_balance-$theInstallment->paid;
               $theFinance->save();
             }elseif($theInstallment->finance_type==3)
             {
               $theFinance=Finance_credit::find($theInstallment->finance_id);
               $theFinance->credit_balance=$theFinance->credit_balance-$theInstallment->paid;
               $theFinance->save();
             }
            $theInstallment->delete();
            // dd("after delete");

          DB::commit();
      //    dd("after delete");
      } catch (\Exception $e) {
          DB::rollback();
          $arr[]=$e->getMessage();
          return Response::json(array('fail' => true,'errors' => $arr));
      }

       return 2;

    }
    //end delete installments

    public function store_product(Request $request)
    {
        $masterRules =[
            'product_code' => 'required|unique:products,user_id',
            'name' => 'required',
            'price' => 'required',
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
            if($request->time_no){
                  $input['time_no']=1;
            }else{
              $input['time_no']=0;
            }

            $tax_id = $input['tax_id'];
            $tax_rate = $input['tax_rate'];
            $taxType_id = $input['taxType_id'];
            $data = new Product;
            $data->product_code = $request->product_code;
            $data->name = $request->name;
            $data->time_no = $input['time_no'];
            $data->price = $request->price;
            $data->account_id = $request->account_id;
            $data->description = $request->description;
            $data->comment = $request->comment;
            $data->product_type_id = $request->product_type_id;
            $data->unit_id = $request->unit_id;
            $data->user_id = $request->user_id;
            $data->save();
            $insertedId = $data->product_code;
            for ($i=0 ; $i < count($taxType_id) ; $i++ ) {


                \DB::table('products_to_taxtypes')->insert(
                    ['product_code' => $insertedId , 'tax_type_id' => $taxType_id[$i]]
                );

            }
            for ($i=0 ; $i < count($tax_id) ; $i++ ) {


                \DB::table('products_to_taxes')->insert(
                    ['product_code' => $insertedId , 'tax_id' => $tax_id[$i]]
                );

            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr[]=$e->getMessage();
            return Response::json(array('fail' => true,'errors' => $arr));
        }

        return $data->id;
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
                // $inv->invoice_number = $request->invoice_number;
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
                $inv->rest         = $request->total_invoice;
                $inv->total_invoice = $request->total_invoice;
                $inv->save();
                $insertedId = $inv->id;



                foreach($request->details as $product) {
                    if(isset($product['product_id'])){
                        $acount_id = Product::find($product['product_id']);//$acount_id->account_id
                        $inv->invoiceItems()->create([
                            //'sales_invoice_id' => $insertedId,
                            'product_id'    => $product['product_id'],
                            'product_name'  => $product['product_name'],
                            'quantity'      => $product['quantity'],
                            'unit_id'       => $product['unit_id'],
                            'price'         => $product['price'],
                            'discount'      => $product['discount'],
                            'amount'        => $product['amount'],
                            'account_id'    => $acount_id->account_id // not dynamic for now
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

            //    $inv->invoiceItems()->delete(); why delete them?

                foreach($request->details as $product) {
                    if(isset($product['product_id'])){
                        $acount_id = Product::find($product['product_id']);//$acount_id->account_id
                        $inv->invoiceItems()->create([
                            //'sales_invoice_id' => $insertedId,
                            'product_id'    => $product['product_id'],
                            'product_name'  => $product['product_name'],
                            'quantity'      => $product['quantity'],
                            'unit_id'       => $product['unit_id'],
                            'price'         => $product['price'],
                            'discount'      => $product['discount'],
                            'amount'        => $product['amount'],
                            'account_id'    => $acount_id->account_id // not dynamic for now
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


        if($request->method() == 'PATCH' && (!isset($request->invoice_id) || empty($request->invoice_id))){
            return [
                'errors' => ['Invoice Id Must be Not Empty']
            ];
        }
        //dd($request->invoice_id);

        if( $request->method() == 'PATCH'){

            $rules = [
                'invoice_number' => 'required|integer|unique:sales_invoices,invoice_number,'.$request->invoice_id ,
                'contact_id' => 'required|integer',
                'details.*.product_id' => 'required|integer',
            ];
        }elseif ($request->method() == 'POST'){

          //|unique:sales_invoices
            $rules = [
                'invoice_number' => 'required|integer|unique:sales_invoices,user_id',
                'contact_id' => 'required|integer',
                'details.*.product_id' => 'required|integer',
            ];
        }


        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()){
            return Response::json([
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        return 1;
    }

    public function store(Request $request) {


        $user_id = Auth::user()->id;
        //|unique:sales_invoices,invoice_number,1
        $rules = [
            'invoice_number' => 'required|integer|unique:sales_invoices,user_id',
            'contact_id' => 'required|integer',
            'details.*.product_id' => 'required|integer',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()){
            return Response::json([
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        //ddd($request->details);

        DB::beginTransaction();
        try {

            $contact_name = Contact::find($request->contact_id);
            $address = ContactAddress::where('contact_id', $request->contact_id)->first();
            $contact_type = ContactsToContactType::where('contact_id',$request->contact_id)->first();

            $inv = new SalesInvoice;
            $inv->invoice_number = $request->invoice_number;
            $inv->invoice_date = $request->invoice_date;
            $inv->contact_id = $request->contact_id;
            $inv->contact_name = $contact_name->first_name . ' ' . $contact_name->last_name;
            $inv->address = "TEST";
            $inv->header_text = $request->header_text;
            $inv->footer_text = $request->footer_text;
            $inv->due_date = $request->due_date;
            $inv->delivery_date = $request->delivery_date;
            $inv->reference_number = $request->reference_number;
            $inv->invoice_status_id = 2;
            $inv->user_id = $user_id;
            $inv->total_discount = $request->total_discount;
            $inv->total_amount =$request->total_amount;
            $inv->rest         = $request->total_invoice;
            $inv->total_invoice = $request->total_invoice;
            $inv->status        = 1;
            $inv->save();
            $insertedId = $inv->id;


            \DB::table('account_reports')->insert([
                        'account_code'  => $contact_type->display_id,
                        'name'          => $inv->contact_name,
                        'invoice_number'   => $inv->invoice_number,
                        'invoice_type'  => 1,
                        'deal_type'     => trans('frontend/reports.addinv'),
                        'amount'        => $inv->total_invoice,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'user_id'       => Auth::user()->id
                    ]);

            foreach($request->details as $product) {
                if(isset($product['product_id'])){
                    $acount_id = Product::find($product['product_id']);//$acount_id->account_id
                    $inv->invoiceItems()->create([
                        //'sales_invoice_id' => $insertedId,
                        'product_id'    => $product['product_id'],
                        'product_name'  => $product['product_name'],
                        'quantity'      => $product['quantity'],
                        'unit_id'       => $product['unit_id'],
                        'price'         => $product['price'],
                        'discount'      => $product['discount'],
                        'amount'        => $product['amount'],
                        'account_id'    => $acount_id->account_id // not dynamic for now
                    ]);

                    $account = Account::find($acount_id->account_id);

                    \DB::table('account_reports')->insert([
                        'account_code'  => $account->account_code,
                        'name'          => $account->name,
                        'invoice_number'   => $inv->invoice_number,
                        'invoice_type'  => 1,
                        'deal_type'     => trans('frontend/reports.addinv'),
                        'amount'        => $inv->total_invoice,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'user_id'       => Auth::user()->id
                    ]);
                    
              }
            // for(int)
          }

                    $input = $request->all();
                    $account_taxes = $input['account_taxes'];
                    $tax_id        = $input['tax_id'];
                    $tax_name  = $input['tax_name'];
                    $tax_sign  = $input['tax_sign'];
                    $tax_rate      = $input['tax_rate'];

                    for ($i=1 ; $i < count($request->details)+1 ; $i++ ) {
                      for ($x=1; $x < count($tax_id)+1; $x++) { 
                        $acount_id = Product::find($input['details'][$i]['product_id']);
                        if(isset($tax_id[$i][$x])){
                          \DB::table('taxes_to_sales_invoice_items')->insert([
                           'sales_invoice_item_id' => $insertedId ,
                           'tax_id' => $tax_id[$i][$x],
                           'tax_rate' => $tax_rate[$i][$x],
                           'tax_name' => $tax_name[$i][$x],
                           'tax_sign' => $tax_sign[$i][$x],
                           'invoice_type' =>'1',
                           'invoice_number' => $request->invoice_number,
                           'account_id'    => $acount_id->account_id,
                           'user_id' => Auth::user()->id,
                           'created_at' => Carbon::now(),
                           'updated_at' => Carbon::now(),
                         ]);
                        }else{
                          
                        }
                      }
                    }

                   
               

            //ADD
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return ['errors' => [$e->getMessage()]];
        }
        return Response::json($insertedId);
    }

    public function edit($id) {
    //dd(" haaa edit");
        $user_id = Auth::user()->id;
        $this->data['page_title'] = trans('frontend/sales_invoice.create_edit');
        $this->data['unit'] = Unit::all()->pluck('name', 'id')->all();
        $this->data['tax_types'] = TaxType::get()->pluck('name', 'id')->all(); //
        $this->data['governorates'] = Governorate::all()->pluck('name', 'id')->all();
        $this->data['countries'] = Country::all()->pluck('name', 'id')->all();
        $data = SalesInvoice::find($id);
        $this->data['data'] = $data;
        $this->data['data_details'] = SalesInvoiceItem::where('sales_invoice_id', $id)->get();

        $this->data['user']=User::find(Auth::user()->id)->profile;
        $this->data['accounts'] = User::find( Auth::user()->id)->accounts()->orderBy('lineage', 'ASC')->get()->pluck('full_desc','id')->all();
        $this->data['accounts_major'] = User::find(Auth::user()->id)->accounts()->where('is_major',1)->get()->pluck('id')->toArray();
        $this->data['product_type'] = ProductType::all()->pluck('name', 'id')->all();

        $invoice_no_from_db = SalesInvoice::whereRaw('invoice_number = (select max(invoice_number) from sales_invoices)')->get(['invoice_number']);
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
        $user_id = Auth::user()->id;

        if(!isset($request->invoice_id) || empty($request->invoice_id)){
            return [
                'errors' => ['Invoice Id Must be Not Empty']
            ];
        }
        $rules = [
            'invoice_number' => 'required|integer|unique:sales_invoices,invoice_number,' . $id ,
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

            $inv = SalesInvoice::find($id);

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

            $inv->invoiceItems()->delete();

            foreach($request->details as $product) {
                if(isset($product['product_id'])){
                    $acount_id = Product::find($product['product_id']);//$acount_id->account_id
                    $inv->invoiceItems()->create([
                        //'sales_invoice_id' => $insertedId,
                        'product_id'    => $product['product_id'],
                        'product_name'  => $product['product_name'],
                        'quantity'      => $product['quantity'],
                        'unit_id'       => $product['unit_id'],
                        'price'         => $product['price'],
                        'discount'      => $product['discount'],
                        'amount'        => $product['amount'],
                        'account_id'    => $acount_id->account_id // not dynamic for now**
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return ['errors' => [$e->getMessage()]];
        }
        return $id;
    }


    public function checkDueDateState()
    {
        $user_id = Auth::user()->id;
        $invoices = SalesInvoice::where('user_id' , $user_id)
            ->where('invoice_status_id' ,'=', 2)
            ->whereDate('due_date' ,'<=', date('Y-m-d'))
            ->orderBy('invoice_number', 'DESC')
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
    //    $invoice_date=Carbon::createFromFormat('dd-mm-yyyy', $invoice_date);

        if ($invoiceNumber != -1){
            $invoices = SalesInvoice::where('invoice_number','=', "$invoiceNumber")
                ->orderBy('id', 'desc')->get();
        }elseif($customer != -1 ){
            if($invoice_date !=-1 && $payment_day != -1) {
                $invoices = SalesInvoice::where('contact_id', '=', "$customer")
                    ->orwhere('invoice_date', '=', "$invoice_date")
                    ->orwhere('delivery_date', '=', "$payment_day")
                    ->orderBy('id', 'desc')->get();
            }elseif($invoice_date !=-1){
                $invoices = SalesInvoice::where('contact_id', '=', "$customer")
                    ->orwhere('invoice_date', '=', "$invoice_date")
                    ->orderBy('id', 'desc')->get();
            }elseif($payment_day != -1){
                $invoices = SalesInvoice::where('contact_id', '=', "$customer")
                    ->orwhere('delivery_date', '=', "$payment_day")
                    ->orderBy('id', 'desc')->get();
            }else{
                $invoices = SalesInvoice::where('contact_id', '=', "$customer")
                    ->orderBy('id', 'desc')->get();
            }
        }elseif($payment_day != -1 || $invoice_date !=-1){
            if($invoice_date !=-1 && $payment_day != -1) {
                $invoices = SalesInvoice::where('invoice_date', '=', "$invoice_date")
                    ->orwhere('delivery_date', '=', "$payment_day")
                    ->orderBy('id', 'desc')->get();
            }elseif($invoice_date !=-1){
                $invoices = SalesInvoice::where('invoice_date', '=', "$invoice_date")
                    ->orderBy('id', 'desc')->get();
            }elseif($payment_day != -1){
                $invoices = SalesInvoice::where('delivery_date', '=', "$payment_day")
                    ->orderBy('id', 'desc')->get();
            }
        }else{
          $invoices=SalesInvoice::all();
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

	public function sendEmail(Request $request){
      $rules = [
            'id' => 'required',
            'email' => 'required|email',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()){
            return Response::json([
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

      $contact = Contact::find($request->id);
      $email = $request->email;
      if(empty($contact->email)){
        $contact->email =  $email;
        $contact->save();
      }
      $contact_name = $contact->first_name ." " . $contact->last_name;
      $contact_company = $contact->company;
      $content  = $request->message;
      $subject  = $request->subject;

      $address = ContactAddress::where('contact_id', $request->id)->first();
      $address1 = "$address->street $address->house_no";
      $address2 = "$address->postal_code -- $address->city";
      $address3 = "{$address->country->name}";
      $phone = Contact::find($request->id)->phones()->first()->phone_number;
      $sender = Auth::user()->email;
      $sales_number = $request->sales_number;
      $invoice = SalesInvoice::where('invoice_number','=',$sales_number)->where('user_id','=',Auth::user()->id)->first();
      $invoice->status = 0;
      $invoice->updated_at = $invoice->created_at;
      $invoice->save();
      $sales_invoice_id = $invoice->id;

      $rest = $invoice->rest;
      $type = 1;  
      $email12 = \DB::table('email_templates')->where('id','=',$type)->first();
      $old = ["[INVOICE_NUMBER]"];
      $new   = [$sales_number];
      $phrase = $email12->subject;
      $newPhrase = str_replace($old, $new, $phrase);

      $data = [
            'no-reply' => 'admin@dibuh.com',
            'name'     => 'Dibuh',
            'Fname'    => $contact_name,
            'Email'    => $email,
            'Company'  => $contact_company,
            'message'    => $content,
            'sales_invoice_rest' => $request->rest,
            'sales_invoice_number' => $request->sales_number,
            'sent_company' => $request->company,
            'address1'     => $address1,
            'address2'     => $address2,
            'address3'     => $address3,
            'phone'       => $phone,
            'sender'      => $sender,
            'sales_invoice_id' => $sales_invoice_id,
            'subject'    => $newPhrase
        ];
      
        \Mail::send('emails.mail2', ['data' => $data,'type'=>$type],
            function ($message) use ($data)
            {
                $message
                    ->from($data['no-reply'],$data['name'])
                    ->to($data['Email'])->subject($data['subject']);
            });
      return Response::json(1);
    }
}
