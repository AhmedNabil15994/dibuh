<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\BasePublicController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Auth;

class ApiController extends BasePublicController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $baseApi = "Var Base Api";
    protected $userType;

    public function __construct() {

$users = array("user", "advertiser");
if (in_array("user", $users)) {
    $this->userType='user';
}


    }

    public function getTaxDropDownData(Request $request) {
        $cat_id = $request->cat_id;
     return   $subcategories = \App\Models\Tax::where('tax_type_id', '=', $cat_id)
                ->orderBy('id', 'asc')
                ->get();
                //->pluck('name', 'id')->all();

    //    return Response::json($subcategories);
    }



    public function getTaxProductData(Request $request) {
        $cat_id = $request->cat_id;
        //make this comment now
       $accountTax =Account::where('id', $cat_id)->first();
         if($accountTax!=null)
         $accountTax=$accountTax->taxes;
         else
         $accountTax=null;
  //dd($accountTax->name);
        return view(\Config::get('front_theme') . '.dashboard.' . '.' . $this->userType . '.' .  'product.ajax.load_taxes' , ['accountTax'=>$accountTax])->render();


//     return   $subcategories = \App\Models\AccountTax::where('account_id', '=', $cat_id)
//                ->orderBy('id', 'asc')
//                ->get();
                //->pluck('name', 'id')->all();

    //    return Response::json($subcategories);
    }

/**
	* Save all used accounts for a user.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
  	public function saveAccountsToUser(Request $request)
	{
		$response = array();
		$response["status"] = "ok";
		$response["message"] = trans('account.accounts_saved');
		return \Response::json($response);
	}
}
