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

class ExportFilesController extends DashboardBaseController {



    public function main(Request $request) {

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
    public function cost_export_pdf(){
         //
      }
    public function cost_export_excel(){
        //
      }
    public function cost_export_csv() {
      //
    }
    public function finance_export_pdf(){
      //
    }
    public function finance_array()
    {
      //
    }
    public function finance_export_csv() {
      //
    }
    public function contact_export_pdf(){
      //
    }
    public function contact_export_excel(){
        //
      }
    public function contact_export_csv() {
           //
         }
    protected function GetDataQuery(){
             //
         }



}
