<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
use App\Models\Account;
use App\Models\AccountType;
use Config;
use Carbon;
use Illuminate\Contracts\Encryption\DecryptException;

class ContactController extends DashboardBaseController {

    
    
    public function main(Request $request) {
 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //

 
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
    
    
    
  //**********************************************************************************************************//    
    // Contact Address  Methods
    //***************************************    
    public function addressIndex() {

    }

    public function addressCreate() {

    }

    public function addressStore(Request $request) {

    }

    public function addressEdit($id) {

    }

    public function addressUpdate(Request $request, $id) {

    }

    public function addressDestroy($id) {

    }


    public function LoadAjaxFilterType()
    {
        
    }
    public function filter(Request $request,$accountingNumber = null,$firstName = null,$companyName=null ,$phoneNumber = null , $pages=10)
    {

    }


    protected function GetDataQuery(){

    }

}
