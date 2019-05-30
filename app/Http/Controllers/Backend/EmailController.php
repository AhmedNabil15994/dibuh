<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\UserProfile as Profile;
use App\Models\UserAddress as Address;
use App\Models\UserBankAccount as BankAccount;
use App\Models\UserBankDataType ;
use App\Models\Role;
use App\Models\Permission;
use App\Models\userRole;
use App\Models\UserSetting;
use App\Models\UserSettingType;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceItem;
use App\Models\Installment;
use App\Models\Contact;
use DB;
use Hash;
use Config;
use Carbon;
use Auth;
use Validator;
use Input;
use Response;


class EmailController extends Controller
{
	
    public function index(Request $request) {
        $data =  \DB::table('email_templates')->get();
        return view(Config::get('back_theme') . '.email.index', compact('data'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(Request $request) {
        
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required|unique:email_templates',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()){
            return Response::json([
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $name = $request->name;
        \DB::table('email_templates')->insert(['name' => $name]);

        return 1;
    }

    public function show(Request $request, $id) {
        $data = \DB::table('email_templates')->where('id','=',$id)->first();
        return view(Config::get('back_theme') . '.email.show', compact('data'));
    }

    public function edit(Request $request){

        $rules = [
            'name' => 'required',
            'subject' => 'required',
            'content' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()){
            return Response::json([
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $data = \DB::table('email_templates')->where('id','=',$request->id)->update([
                'name'  => $request->name,
                'subject' => $request->subject,
                'content' => $request->content,
        ]);
        return 1;
    }

    public function destroy(Request $request, $id) {
        $data = \DB::table('email_templates')->where('id','=',$id)->delete();
        return Response::json($data);
    }
}
