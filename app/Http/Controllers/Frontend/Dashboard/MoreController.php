<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class MoreController extends DashboardBaseController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        
        if(!Session::has('PreviousRoute')){
            Session::put('CurrentRoute', \Request::route()->getName());
        }

    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
     public function main() {
 
    }
    
    public function index() {
 
    }
    
 



}
