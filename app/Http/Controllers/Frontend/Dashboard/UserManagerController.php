<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class UserManagerController extends DashboardBaseController {

    protected $userType='';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index() {
        
    }

    public function basicIndex() {
        
    }

    public function basicEdit() {
        
    }

    public function basicUpdate(Request $request, $id) {
        
    }

    public function addressIndex() {
        
    }

    public function addressCreate() {
        
    }

    public function addressStore() {
        
    }

    public function addressEdit($id) {
        
    }

    public function addressUpdate(Request $request, $id) {
        
    }
    
    public function destroy($id)
    {

    }
    
    //methods for create users by Salesman,Advertiser
    //show user created by
    public function usersIndex(){
        
    }
    
    //display form for create by users
    public function usersCreate(){
        
    }    

    //Store users created by    
    public function usersStore(){
        
    }    
    
 // User Bank Account Methods
    //***************************************
    //display my bank accounts
    public function bankAccountIndex() {
 
    }    
   // create Bank Account form
    public function bankAccountCreate() {
 
    }

    public function bankAccountStore(Request $request) {
 
    }

    /* Edit bankAccountEdit form 
     */
    public function bankAccountEdit($id) {
 
    }

    /*** Update the bankAccount  in storage. */
    public function bankAccountUpdate(Request $request ) {
 
    }
    
    // detete bank account
    public function bankAccountDestroy( ) {
 
    }
//**********************************************************************************************************//       
    public function editUserMang(Request $request){
        
    }   
}
