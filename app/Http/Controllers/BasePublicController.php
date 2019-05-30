<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Auth;

class BasePublicController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $basePublic ="Var Base BasePublicController";
    protected $data=[];
    protected $currentRoute;
    
    public $userId='';
    
    public function __construct() {
       $this->getPreviousRoute();
       if (Auth::check())// user is logged
        $this->userId=Auth::user()->id;
    }
    
    public function getPreviousRoute(){
        
        if(!Session::has('PreviousRoute')){
            Session::put('PreviousRoute', \Request::route()->getName());
        }
        return Session::put('PreviousRoute', \Request::route()->getName());;

    }

}
