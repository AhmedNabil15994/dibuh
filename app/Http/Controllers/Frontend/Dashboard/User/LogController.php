<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use Config;
use Carbon;
use View;
use App\Models\SalesInvoice;
use App\Models\AbstractInvoice;
use App\Models\Cost;
use App\Models\CostOther;
use App\Models\OtherIncomeInvoice;
use App\Models\Salary;
use App\Models\SalesInvoiceReturn;
use App\Models\Contact;
use App\Models\ContactsToContactType;
use App\Models\ContactAddress;
use App\Models\Contact_phone;
use App\Models\TaxSalesInvoiceItem;
use Illuminate\Contracts\Encryption\DecryptException;

class LogController extends DashboardBaseController {

    protected $userType = 'user';
    protected $module = 'report';    
    public function __construct() {
        parent::__construct();
        View::share('userType', $this->userType);
        View::share('module', $this->module);        
    }    
    public function main(Request $request) {
 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $this->data['page_title'] = trans('frontend/sales_invoice.log') ;
        $this->data['sales_invoice_install'] = \DB::table('installement_invoices')->where('user_id','=',Auth::user()->id)->orderBy('paid_date','DESC')->get();
        $this->data['amounts'] = \DB::table('amounts')->orderBy('added_date','DESC')->get();
        $this->data['banks'] = \DB::table('finance_banks')->where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
        $this->data['treasury'] = \DB::table('finance_treasury')->where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
        $this->data['credits'] = \DB::table('finance_credit')->where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
        $this->data['closed'] = \DB::table('closed')->where('user_id','=',Auth::user()->id)->orderBy('closed_date','=','DESC')->get();
        $this->data['user_id'] = Auth::user()->id;
        return $this->view($this->userType . '.'.$this->module.'.'.'finance_log', $this->data);

    }
    public function income(Request $request) {
        $this->data['page_title'] = trans('frontend/sales_invoice.log') ;

        $add_data=[];
        $edit_data=[];

        $sales_invoices = SalesInvoice::where('user_id','=',Auth::user()->id)->where('status','=',0)->orderBy('created_at','DESC')->get();
        $abstracts = AbstractInvoice::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
        $other_incomes = OtherIncomeInvoice::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
        $costs = Cost::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
        $costs_other = CostOther::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
        $salary = Salary::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
        $sales_invoice_return = SalesInvoiceReturn::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();

        foreach ($sales_invoices as $key => $value) {
            $seconds = 60;
            $chanSt = date("Y-m-d H:i:s", (strtotime(date($value->created_at)) + $seconds));

            if($value->created_at != $value->updated_at && $value->updated_at >= $chanSt){
                $edit_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'updated_at'     => Carbon::parse($value->updated_at)->format('Y-m-d'),
                    'invoice_type'   => trans('frontend/dashboard.invoices')
                ];

            }
            $add_data[] = [
                'invoice_number' => $value->invoice_number,
                'created_at'     => $value->invoice_date,
                'invoice_type'   => trans('frontend/dashboard.invoices')
            ];
        }
        foreach ($abstracts as $key => $value) {
            if($value->created_at != $value->updated_at){
                $edit_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'updated_at'     => Carbon::parse($value->updated_at)->format('Y-m-d'),
                    'invoice_type'   => trans('frontend/dashboard.abstracts')
                ];

            }
            $add_data[] = [
                'invoice_number' => $value->invoice_number,
                'created_at'     => $value->invoice_date,
                'invoice_type'   => trans('frontend/dashboard.abstracts')
            ];
        }
        foreach ($other_incomes as $key => $value) {
            if($value->created_at != $value->updated_at){
                $edit_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'updated_at'     => Carbon::parse($value->updated_at)->format('Y-m-d'),
                    'invoice_type'   => trans('frontend/dashboard.revenue_other')
                ];

            }
            $add_data[] = [
                'invoice_number' => $value->invoice_number,
                'created_at'     => $value->invoice_date,
                'invoice_type'   => trans('frontend/dashboard.revenue_other')
            ];
        }
        foreach ($costs as $key => $value) {
            if($value->created_at != $value->updated_at){
                $edit_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'updated_at'     => Carbon::parse($value->updated_at)->format('Y-m-d'),
                    'invoice_type'   => trans('frontend/sales_invoice.purchase')
                ];

            }
            $add_data[] = [
                'invoice_number' => $value->invoice_number,
                'created_at'     => $value->invoice_date,
                'invoice_type'   => trans('frontend/sales_invoice.purchase')
            ];
        }
        foreach ($costs_other as $key => $value) {
            if($value->created_at != $value->updated_at){
                $edit_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'updated_at'     => Carbon::parse($value->updated_at)->format('Y-m-d'),
                    'invoice_type'   => trans('frontend/sales_invoice.expenses')
                ];

            }
            $add_data[] = [
                'invoice_number' => $value->invoice_number,
                'created_at'     => $value->invoice_date,
                'invoice_type'   => trans('frontend/sales_invoice.expenses')
            ];
        }
        foreach ($salary as $key => $value) {
            if($value->created_at != $value->updated_at){
                $edit_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'updated_at'     => Carbon::parse($value->updated_at)->format('Y-m-d'),
                    'invoice_type'   => trans('frontend/sales_invoice.salaries')
                ];

            }
            $add_data[] = [
                'invoice_number' => $value->invoice_number,
                'created_at'     => $value->invoice_date,
                'invoice_type'   => trans('frontend/sales_invoice.salaries')
            ];
        }
        foreach ($sales_invoice_return as $key => $value) {
            if($value->created_at != $value->updated_at){
                $edit_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'updated_at'     => Carbon::parse($value->updated_at)->format('Y-m-d'),
                    'invoice_type'   => trans('frontend/sales_invoice.bills_return')
                ];

            }
            $add_data[] = [
                'invoice_number' => $value->invoice_number,
                'created_at'     => $value->invoice_date,
                'invoice_type'   => trans('frontend/sales_invoice.bills_return')
            ];
        }

        $this->data['add_data'] = $add_data;
        $this->data['edit_data'] = $edit_data;


        $this->data['user_id'] = Auth::user()->id;
        return $this->view($this->userType . '.'.$this->module.'.'.'invoices_log', $this->data);

    }
    
    public function contact() {
        //
        $this->data['page_title'] = trans('frontend/sales_invoice.log') ;

        $add_data=[];
        $edit_data=[];

        $contacts  = Contact::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();

        $addresses = ContactAddress::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get(); 

        $phones    = Contact_Phone::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get(); 

        foreach ($contacts as $key => $value) {

            if($value->created_at != $value->updated_at){
                $edit_data[] =[
                    'contact_id' => $value->id,
                    'created_at' => Carbon::parse($value->updated_at)->format('Y-m-d'),
                    'type'  =>' المعلومات الشخصيبة ل'
                ];
            }
            $add_data[] =[
                'contact_id' => $value->id,
                'created_at' => Carbon::parse($value->created_at)->format('Y-m-d')
            ];
        }
        foreach ($addresses as $key => $value) {

            $edit_data[] =[
                'contact_id' => $value->contact_id,
                'created_at' => Carbon::parse($value->updated_at)->format('Y-m-d'),
                'type'  =>' عنوان '
            ];
        }
        foreach ($phones as $key => $value) {

            $edit_data[] =[
                'contact_id' => $value->contact_id,
                'created_at' => Carbon::parse($value->updated_at)->format('Y-m-d'),
                'type'  =>' تليفون '
            ];
        }



        $this->data['add_data'] = $add_data;
        $this->data['edit_data'] = $edit_data;
        $this->data['user_id'] = Auth::user()->id;
        return $this->view($this->userType . '.'.$this->module.'.'.'contacts_log', $this->data);
    }


    public function tax(){
        $add_data=[];

        $all_taxes = TaxSalesInvoiceItem::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();

        foreach ($all_taxes as $key => $value) {
            $type='';            
            if($value->invoice_type == 1){
                $type=trans('frontend/dashboard.invoices');
            }elseif($value->invoice_type == 2) {
                $type=trans('frontend/dashboard.abstracts');
            }elseif($value->invoice_type == 3) {
                $type=trans('frontend/dashboard.revenue_other');
            }elseif($value->invoice_type == 4) {
                $type=trans('frontend/sales_invoice.purchase');
            }elseif($value->invoice_type == 5) {
                $type=trans('frontend/sales_invoice.expenses');
            }elseif($value->invoice_type == 6) {
                $type=trans('frontend/sales_invoice.bills_return');
            }elseif($value->invoice_type == 7) {
                $type=trans('frontend/sales_invoice.salaries');
            }   

            $add_data[] =[
                'tax_name' => $value->tax_name,
                'invoice_number' => $value->invoice_number,
                'type'  => $type,
                'created' => Carbon::parse($value->created_at)->format('Y-m-d'),
            ];
        }

        $this->data['page_title'] = trans('frontend/sales_invoice.log') ;
        $this->data['add_data'] = $add_data;
        $this->data['user_id'] = Auth::user()->id;


        return $this->view($this->userType . '.'.$this->module.'.'.'taxes_log', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //

    }



}
