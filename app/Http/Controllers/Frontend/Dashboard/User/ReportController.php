<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
use App\Models\InvoiceStatus;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceItem;
use App\Models\TaxSalesInvoiceItem;
use App\Models\AbstractInvoice;
use App\Models\AbstractInvoiceItem;
use App\Models\OtherIncomeInvoice;
use App\Models\OtherIncomeInvoiceItem;
use App\Models\Cost;
use App\Models\CostItem;
use App\Models\CostOther;
use App\Models\CostOtherItem;
use App\Models\Salary;
use App\Models\SalaryItem;
use App\Models\SalesInvoiceReturn;
use App\Models\SalesInvoiceReturnItem;
use App\Models\Contact;
use App\Models\Account;
use App\Models\UserFile;
use Config;
use Carbon;
use View;
use PDF;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;

class ReportController extends DashboardBaseController {
    protected $userType = 'user';
    protected $module = 'report';    
    
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
        $this->data['page_title'] = trans('frontend/sales_invoice.reports') ;
        
        return $this->view($this->userType . '.'.$this->module.'.'.'main', $this->data);
     
    }
    
    public function invoice(Request $request){
        $this->data['page_title'] = trans('frontend/sales_invoice.reports') ;
        $this->data['data'] = SalesInvoice::where('status','=',0)->where('user_id','=',Auth::user()->id)->whereIn('invoice_status_id',array(2,3,5))->orderBy('id','DESC')->get();
        $this->data['test'] =   DB::table('contacts')->join('sales_invoices','sales_invoices.contact_id','=','contacts.id')
            ->whereIn('sales_invoices.invoice_status_id',array(2,3,5))->where('sales_invoices.status','=',0)->where('sales_invoices.user_id','=',Auth::user()->id)->groupBy('company')->get();

        return $this->view($this->userType . '.'.$this->module.'.'.'invoice', $this->data);
    }

    public function invoice2(Request $request){
        $this->data['page_title'] = "trans('frontend/sales_invoice.reports')" ;
        $this->data['data'] = Cost::orderBy('id','DESC')->where('user_id','=',Auth::user()->id)->whereIn('invoice_status_id',array(2,3,5))->get();
        $this->data['test'] =   DB::table('contacts')->join('costs','costs.contact_id','=','contacts.id')
            ->whereIn('costs.invoice_status_id',array(2,3,5))->where('costs.user_id','=',Auth::user()->id)->groupBy('company')->get();
        return $this->view($this->userType . '.'.$this->module.'.'.'invoice2', $this->data);
    }
    public function log(Request $request) {
        $this->data['page_title'] = trans('frontend/sales_invoice.log') ;
        $this->data['sales_invoice_install'] = \DB::table('installement_invoices')->where('user_id','=',Auth::user()->id)->orderBy('paid_date','DESC')->get();
        $this->data['amounts'] = \DB::table('amounts')->orderBy('added_date','DESC')->get();
        /*$this->data['abstract_install'] = \DB::table('installement_invoices')->where('invoice_type','=',1)->get();
        $this->data['other_income_install'] = \DB::table('installement_invoices')->where('invoice_type','=',2)->get();
        $this->data['cost_install'] = \DB::table('installement_invoices')->where('invoice_type','=',3)->get();
        $this->data['cost_other_install'] = \DB::table('installement_invoices')->where('invoice_type','=',4)->get();
        $this->data['sales_invoice_return_install'] = \DB::table('installement_invoices')->where('invoice_type','=',5)->get();
        $this->data['salary_install'] = \DB::table('installement_invoices')->where('invoice_type','=',6)->get();*/
        $this->data['user_id'] = Auth::user()->id;
        return $this->view($this->userType . '.'.$this->module.'.'.'log', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //
        $this->data['page_title'] =   trans('frontend/cost.title') ;
        $this->data['user_type'] = Auth::user()->roles;
        $this->data['data'] = Cost::orderBy('id', 'DESC')->paginate(10);
        return $this->view($this->userType . '.'.$this->module.'.'.'index', $this->data)
                        ->with('i', ($request->input('page', 1) - 1) * 10);
 
    }
    
    //ajax request
    public function getContactData(Request $request){
        $contactId=$request->contactID;
        $responce= Contact::where('id', $contactId)->get();

        return $responce;
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $this->data['page_title'] =   trans('frontend/cost.create_new') ;
        $this->data['contacts'] = Contact::where('contact_type_id',2)->get()->pluck('full_name','id')->all(); //\ 2 Supplier              
        $this->data['invoice_status'] = InvoiceStatus::all()->pluck('name', 'id')->all(); //          
        $this->data['accounts'] = Account::all()->pluck('name', 'id')->all();        

        $this->data['user_id'] = Auth::user()->id;        



        return $this->view($this->userType . '.'.$this->module.'.'.'create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
 
        $this->validate($request, [
            'receipt_number' => 'required',
            'price' => 'required',
            'description' => 'required',
            'contact_id' => 'required',
            'contact_name' => 'required',            

        ]);
        $input = $request->all();

        //get current user id for created by user:
        $input['user_id'] = Auth::user()->id; //this is only for frontend method
        //user_file_id
        $userFileInputs['file']=$input['user_file_id'];
        $userFileInputs['user_id']=$input['user_id'];
        $userFileInputs['file_name']='test';        
        $userFile=UserFile::create($userFileInputs);
        
        if($userFile){
            $input['user_file_id']=$userFile->id;
            Cost::create($input);
        }
       // dd(  $input['created_by']);
        

        return redirect()->route('cost.index')
                        ->with('success', 'Cost created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $this->data['page_title'] =   trans('frontend/cost.edit') ;
        $this->data['data'] = Cost::find($id);
        
        $this->data['contacts'] = Contact::where('contact_type_id',2)->get()->pluck('full_name','id')->all(); //\ 2 Supplier
        $this->data['invoice_status'] = InvoiceStatus::all()->pluck('name', 'id')->all(); //             
        $this->data['accounts'] = Account::all()->pluck('name', 'id')->all();        
        //$this->data['status'] = Unit::all()->pluck('name', 'id')->all();
        $this->data['user_id'] = Auth::user()->id;       
 
        return  $this->view($this->userType . '.'.$this->module.'.'.'edit', $this->data);

        
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
        $this->validate($request, [
            'receipt_number' => 'required',
            'price' => 'required',
            'description' => 'required',
            'contact_id' => 'required',
            'contact_name' => 'required',            

        ]);

        $input = $request->all();


        $model = Cost::find($id);
        $model->update($input);


        return redirect()->route('cost.index')
                        ->with('success', 'Cost updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //

        Cost::find($id)->delete();
        return redirect()->route('cost.index')
                        ->with('success', 'Cost deleted successfully');
    }




    public function acc_overview(Request $request) {
        $this->data['page_title'] =   trans('frontend/reports.title') ;
        $user_id = Auth::user()->id ;
        $this->data['user_id'] = $user_id;        
        $this->data['data']= \DB::table('account_reports')->where('user_id','=',$user_id)->orderBy('created_at','DESC')->get();
        $this->data['reports']= \DB::table('account_reports')->where('user_id','=',$user_id)->orderBy('created_at','DESC')->groupBy('account_code')->get();

        return $this->view($this->userType . '.'.$this->module.'.'.'acc_overview', $this->data);
    }

    public function getAccounts(Request $request){
        $user_id = Auth::user()->id;
        $accounts = DB::table("account_reports")->where('user_id','=',$user_id)
                                        ->where('account_code','LIKE','%'.$request->text.'%')
                                        ->orwhere('receiver_code','LIKE','%'.$request->text.'%')
                                        ->orWhere('name','LIKE','%'.$request->text.'%')
                                        ->get();                                           
        return Response::json($accounts);        
    }

    public function filter(Request $request, $code, $from, $to) {
        //$this->checkDueDateState();
        $data = \DB::table('account_reports')->where('account_code','=',$code)
                                             ->whereBetween('created_at', array($from,$to))
                                             ->get();

        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadAccountReports', ['data' => $data])->render();
        }
    }

    public function export_pdf(Request $request) {
            $user_id = Auth::user()->id;
            $this->data['page_title'] = trans('frontend/reports.title');
            $path = $this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadAccountReports';
            $data = \DB::table('account_reports')->where('user_id' , $user_id)->orderBy('created_at', 'DESC')->get();
            $this->data['data'] = $data;
            $pdf = PDF::loadView($path, $this->data,[], [
                        'format' => 'A4-M'
                      ]);

            return $pdf->download(trans('frontend/reports.title').'.pdf');
    }

    public function export_excel(Request $request) {
            $user_id = Auth::user()->id;
            $this->data['page_title'] = trans('frontend/reports.title');
            $path = $this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadAccountReports';
            $data = \DB::table('account_reports')->where('user_id' , $user_id)->orderBy('created_at', 'DESC')->get();
            $this->data['data'] = $data;
            $this->data['path'] = $path;
            Excel::create(trans('frontend/reports.title'), function($excel) {
                $excel->setTitle(trans('frontend/reports.title'));
                $excel->sheet(trans('frontend/reports.title'), function($sheet) {
                    $sheet->loadView($this->data['path'], $this->data,[], [
                        'format' => 'A1-M'
                      ]);
                    $sheet->setOrientation('landscape');
                });
            })->download('xls');
    }

    public function export_csv(Request $request) {
            $user_id = Auth::user()->id;
            $this->data['page_title'] = trans('frontend/reports.title');
            $path = $this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadAccountReports';
            $data = \DB::table('account_reports')->where('user_id' , $user_id)->orderBy('created_at', 'DESC')->get();
            $this->data['data'] = $data;
            $this->data['path'] = $path;
            Excel::create(trans('frontend/reports.title'), function($excel) {
                $excel->setTitle(trans('frontend/reports.title'));
                $excel->sheet(trans('frontend/reports.title'), function($sheet) {
                    $sheet->loadView($this->data['path'], $this->data,[], [
                        'format' => 'A1-M'
                      ]);
                    $sheet->setOrientation('landscape');
                });
            })->download('csv');
    }


    public function prof_loss(Request $request){
        $this->data['page_title'] =   trans('frontend/reports.title2') ;
        $user_id = Auth::user()->id ;
        $this->data['user_id'] = $user_id;        
        $add_data=[];

        $sales_invoices = SalesInvoice::where('user_id','=',Auth::user()->id)->where('status','=',0)->where('invoice_status_id','!=','1')->orderBy('created_at','DESC')->get();
        $abstracts = AbstractInvoice::where('user_id','=',Auth::user()->id)->where('invoice_status_id','!=','1')->orderBy('created_at','DESC')->get();
        $other_incomes = OtherIncomeInvoice::where('user_id','=',Auth::user()->id)->where('invoice_status_id','!=','1')->orderBy('created_at','DESC')->get();
        $costs = Cost::where('user_id','=',Auth::user()->id)->where('invoice_status_id','!=','1')->orderBy('created_at','DESC')->get();
        $costs_other = CostOther::where('user_id','=',Auth::user()->id)->where('invoice_status_id','!=','1')->orderBy('created_at','DESC')->get();
        $salary = Salary::where('user_id','=',Auth::user()->id)->where('invoice_status_id','!=','1')->orderBy('created_at','DESC')->get();
        $sales_invoice_return = SalesInvoiceReturn::where('user_id','=',Auth::user()->id)->where('invoice_status_id','!=','1')->orderBy('created_at','DESC')->get();

        foreach ($sales_invoices as $key => $value) {
            $items = SalesInvoiceItem::where('sales_invoice_id','=',$value->id)->get();
            
            for ($i=0; $i <count($items) ; $i++) { 
                $taxes = TaxSalesInvoiceItem::where('sales_invoice_item_id','=',$value->id)->where('user_id','=',Auth::user()->id)->where('invoice_type','=','1')->where('account_id','=',$items[$i]['account_id'])->get();
                
                $account = Account::where('id','=',$items[$i]['account_id'])->first();    
                $add_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'created_at'     => $value->invoice_date,
                    'invoice_id'     => $value->id,
                    'price'          => $value->total_amount,
                    'discount'       => $value->total_discount,
                    'account_id'     => $items[$i]['account_id'],
                    'account_code'   => $account->account_code,
                    'account_name'   => $account->name,
                    'invoice_type'   => trans('frontend/dashboard.invoices'), 
                    'taxes'       => $taxes,
                ];
            }
        }

        foreach ($abstracts as $key => $value) {
            $items = AbstractInvoiceItem::where('abstract_invoice_id','=',$value->id)->get();
            
            for ($i=0; $i <count($items) ; $i++) { 
                $taxes = TaxSalesInvoiceItem::where('sales_invoice_item_id','=',$value->id)->where('user_id','=',Auth::user()->id)->where('invoice_type','=','2')->where('account_id','=',$items[$i]['account_id'])->get();
                
                $account = Account::where('id','=',$items[$i]['account_id'])->first();    
                $add_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'created_at'     => $value->invoice_date,
                    'invoice_id'     => $value->id,
                    'price'          => $value->total_amount,
                    'discount'       => $value->total_discount,
                    'account_id'     => $items[$i]['account_id'],
                    'account_code'   => $account->account_code,
                    'account_name'   => $account->name,
                    'invoice_type'   => trans('frontend/dashboard.abstracts'), 
                    'taxes'       => $taxes,
                ];
            }
        }
        foreach ($other_incomes as $key => $value) {
            $items = OtherIncomeInvoiceItem::where('other_income_invoice_id','=',$value->id)->get();
            
            for ($i=0; $i <count($items) ; $i++) { 
                $taxes = TaxSalesInvoiceItem::where('sales_invoice_item_id','=',$value->id)->where('user_id','=',Auth::user()->id)->where('invoice_type','=','3')->where('account_id','=',$items[$i]['account_id'])->get();
                
                $account = Account::where('id','=',$items[$i]['account_id'])->first();    
                $add_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'created_at'     => $value->invoice_date,
                    'invoice_id'     => $value->id,
                    'price'          => $value->total_amount,
                    'discount'       => $value->total_discount,
                    'account_id'     => $items[$i]['account_id'],
                    'account_code'   => $account->account_code,
                    'account_name'   => $account->name,
                    'invoice_type'   => trans('frontend/dashboard.revenue_other'), 
                    'taxes'       => $taxes,
                ];
            }
        }
        foreach ($costs as $key => $value) {
            $items = CostItem::where('cost_id','=',$value->id)->get();
            
            for ($i=0; $i <count($items) ; $i++) { 
                $taxes = TaxSalesInvoiceItem::where('sales_invoice_item_id','=',$value->id)->where('user_id','=',Auth::user()->id)->where('invoice_type','=','4')->where('account_id','=',$items[$i]['account_id'])->get();
                
                $account = Account::where('id','=',$items[$i]['account_id'])->first();    
                $add_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'created_at'     => $value->invoice_date,
                    'invoice_id'     => $value->id,
                    'price'          => $value->total_amount,
                    'discount'       => $value->total_discount,
                    'account_id'     => $items[$i]['account_id'],
                    'account_code'   => $account->account_code,
                    'account_name'   => $account->name,
                    'invoice_type'   => trans('frontend/sales_invoice.purchase'), 
                    'taxes'       => $taxes,
                ];
            }
        }
        foreach ($costs_other as $key => $value) {
            $items = CostOtherItem::where('cost_other_id','=',$value->id)->get();
            
            for ($i=0; $i <count($items) ; $i++) { 
                $taxes = TaxSalesInvoiceItem::where('sales_invoice_item_id','=',$value->id)->where('user_id','=',Auth::user()->id)->where('invoice_type','=','5')->where('account_id','=',$items[$i]['account_id'])->get();
                
                $account = Account::where('id','=',$items[$i]['account_id'])->first();    
                $add_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'created_at'     => $value->invoice_date,
                    'invoice_id'     => $value->id,
                    'price'          => $value->total_amount,
                    'discount'       => $value->total_discount,
                    'account_id'     => $items[$i]['account_id'],
                    'account_code'   => $account->account_code,
                    'account_name'   => $account->name,
                    'invoice_type'   => trans('frontend/sales_invoice.expenses'), 
                    'taxes'       => $taxes,
                ];
            }
        }
        foreach ($salary as $key => $value) {
            $items = SalaryItem::where('salary_id','=',$value->id)->get();
            
            for ($i=0; $i <count($items) ; $i++) { 
                $taxes = TaxSalesInvoiceItem::where('sales_invoice_item_id','=',$value->id)->where('user_id','=',Auth::user()->id)->where('invoice_type','=','7')->where('account_id','=',$items[$i]['account_id'])->get();
                
                $account = Account::where('id','=',$items[$i]['account_id'])->first();    
                $add_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'created_at'     => $value->invoice_date,
                    'invoice_id'     => $value->id,
                    'price'          => $value->total_amount,
                    'discount'       => $value->total_discount,
                    'account_id'     => $items[$i]['account_id'],
                    'account_code'   => $account->account_code,
                    'account_name'   => $account->name,
                    'invoice_type'   => trans('frontend/sales_invoice.salaries'), 
                    'taxes'       => $taxes,
                ];
            }
        }
        foreach ($sales_invoice_return as $key => $value) {
            $items = SalaryItem::where('sales_invoice_return_id','=',$value->id)->get();
            
            for ($i=0; $i <count($items) ; $i++) { 
                $taxes = TaxSalesInvoiceItem::where('sales_invoice_item_id','=',$value->id)->where('user_id','=',Auth::user()->id)->where('invoice_type','=','6')->where('account_id','=',$items[$i]['account_id'])->get();
                
                $account = Account::where('id','=',$items[$i]['account_id'])->first();    
                $add_data[] = [
                    'invoice_number' => $value->invoice_number,
                    'created_at'     => $value->invoice_date,
                    'invoice_id'     => $value->id,
                    'price'          => $value->total_amount,
                    'discount'       => $value->total_discount,
                    'account_id'     => $items[$i]['account_id'],
                    'account_code'   => $account->account_code,
                    'account_name'   => $account->name,
                    'invoice_type'   => trans('frontend/sales_invoice.bills_return'), 
                    'taxes'       => $taxes,
                ];
            }
        }
       
        $this->data['data'] = $add_data;
        return $this->view($this->userType . '.'.$this->module.'.'.'prof_loss', $this->data);
    }

}
