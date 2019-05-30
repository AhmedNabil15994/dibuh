<?php

namespace App\Http\Controllers\Frontend\Dashboard\Advertiser;

use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use View;
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
    protected $userType = 'advertiser';
    
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
        
        $this->data['user']= 'user id:' .Auth::user()->id . ' user :' .Auth::user()->name .'<hr><br/>'.Auth::user()->roles;
        $this->data['page_title']=$this->userType.' Dashboard';
     return $this->view($this->userType.'.dashboard',$this->data);
    }
    
    
      public function accountManager() {
        
        $this->data['user']= 'user id:' .Auth::user()->id . ' user :' .Auth::user()->name .'<hr><br/>'.Auth::user()->roles;
        $this->data['page_title']='salesman Dashboard';
     return $this->view('salesman.account_manager.index',$this->data);
    }


}

