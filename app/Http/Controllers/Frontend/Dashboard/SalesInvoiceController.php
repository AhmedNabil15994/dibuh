<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
use App\Models\Account;
use App\Models\AccountType;
use Config;
use Carbon;
use Illuminate\Contracts\Encryption\DecryptException;

class SalesInvoiceController extends DashboardBaseController {



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
    public function getContactData(){

    }

    public function getContactEmail(Request $request){
        
    }

    public function getContactAddress(){

    }

    public function getProductData(){

    }
    public function getContactPhones(){

    }


    public function getAccountData(){

    }

    public function getRefN(){

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
    public function show() {
        //
    }
    public function download_pdf() {
   //
    }
    public function export_pdf() {
   //
    }
    public function export_excel() {
   //
    }
    public function export_csv() {
   //
    }
    public function export_html() {
   //
    }


     public function test($id){

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

    public function LoadAjaxFilterStatus(Request $request,$status) {
        //
    }


    public function getContactsJson(Request $request,$status) {
        //
    }
    public function getproductsJson(Request $request) {
        //
    }
    public function getAccountsJson(Request $request) {
        //
    }
    public function getOneContactAddress(Request $request){
        //
    }
    public function getContactAddressByID($id){
       //
    }
    public function store_installement() {
       //
   }
   public function delete_installement() {
      //
  }
   public function getFinancesJson(Request $request) {
   //
  }

    public function filter()
    {
        //
    }
    public function getTaxFieldsView($requests){
       //
    }
    public function store_draft(Request $request)
    {
        //
    }
    public function store_customer(Request $request)
    {
        //
    }
    public function store_product(Request $request)
    {
        //
    }
    public function invoice_validation(Request $request)
    {
        //
    }
    public function draft_to_invoice()
    {

    }
    public function checkDueDateState()
    {
     //
    }
	public function sendEmail(Request $request){
		
	}	
}
