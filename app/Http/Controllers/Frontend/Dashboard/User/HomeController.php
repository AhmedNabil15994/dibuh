<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use View;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cost;
use App\Models\Feedback;
use Lava;
//use Carbon;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends DashboardBaseController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $userType = 'user';

    public function __construct() {
        parent::__construct();
        View::share ( 'userType', $this->userType );

    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index() {

        $this->data['invoices']=SalesInvoice::take(5)->where('invoice_status_id','3')->where('status','=',0)->get();
        $this->data['user']= 'user id:' .Auth::user()->id . ' user :' .Auth::user()->name .'<hr><br/>'.Auth::user()->roles;
        $this->data['page_title']=$this->userType.' Dashboard';

        $this->data['date_now']=\Carbon\Carbon::now();
        //line chart for sales invoice and costs
       $temperatures = Lava::DataTable();
       $temperatures->addDateColumn('Date')
               ->addNumberColumn(trans('Sales_invoice'))
               ->addNumberColumn(trans('cost'));
      $sales_invoices=SalesInvoice::where('user_id',Auth::user()->id)->get(['total_amount as total_sales','invoice_date']);
      $costs=Cost::where('user_id',Auth::user()->id)->get(['total_amount as total_cost','invoice_date']);
      $salesinvoice_costs=$sales_invoices->concat($costs)->groupBy('invoice_date')->sortKeys();
      $costs=0;
      $sales=0;
     foreach( $salesinvoice_costs as $key=>$item)
      {
      $sales+=$item->sum('total_sales');
      $costs+=$item->sum('total_cost');
      $temperatures->addRow([$key,$sales  , $costs]);
       }
      Lava::AreaChart('Temps', $temperatures, [
      'title' => 'AreaChart for Sales Invoices And Costs'
      // 'legend' => [ 'position' => 'in']


     ]);
     //endlinechar
     return $this->view($this->userType.'.dashboard',$this->data);
    }


      public function accountManager() {

        $this->data['user']= 'user id:' .Auth::user()->id . ' user :' .Auth::user()->name .'<hr><br/>'.Auth::user()->roles;
        $this->data['page_title']='salesman Dashboard';
        return $this->view('salesman.account_manager.index',$this->data);
    }
    public function updateLastLoginFront(){
        $user_id=Auth::user()->id;
        User::where('id',$user_id)->update(['last_login_front'=>\Carbon\Carbon::now()]);


    }
    public function store_feedback( Request $request)
    {
      $user_id=Auth::user()->id;
      $this->validate($request,[
        'subject'=>'required|max:300'
      ]);
    //  dd(strlen($request->subject));
      $feedback=new Feedback();
      $feedback->user_id=$user_id;
      $feedback->feedback=$request->subject;
      $feedback->save();
  //  return redirect()->route('dashboard.index');
  return back();

    }


}
