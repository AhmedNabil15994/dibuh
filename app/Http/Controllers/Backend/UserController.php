<?php

namespace App\Http\Controllers\Backend;
//namespace App\Http\Controllers\Frontend\Dashboard\User;

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
use App\Models\Feedback;
use App\Models\Helping;
use App\Models\HelpingReplay;
use DB;
use Hash;
use Config;
use Carbon;
use Auth;


use Illuminate\Contracts\Encryption\DecryptException;


class UserController extends Controller {

    public function __construct()
    {
        $this->middleware('permission:user-list',   ['only' => ['show', 'index']]);
        $this->middleware('permission:user-create', ['only' => ['create']]);
        $this->middleware('permission:user-edit',   ['only' => ['edit']]);
        $this->middleware('permission:user-delete',   ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view(Config::get('back_theme') . '.users.index', compact('data'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $roles = Role::pluck('display_name', 'id');
        return view(Config::get('back_theme') . '.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
           // 'name' => 'required|alpha_dash|unique:users,name' ,
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);



        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        // create user profile on the fly
        $expireDate = Carbon::today()->addWeeks(1)->toDateString();
        $profile = new Profile(array(
            'user_status_id' => 1, 'user_status_id' => 1, // active
            'expire_date' => $expireDate,
        ));

        $user->profile()->save($profile);


        return redirect()->route('admin::users.index')
                        ->with('success', 'User created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $user = User::find($id);
        $roles = Role::pluck('display_name', 'id');
        $userRole = $user->roles->pluck('id', 'id')->toArray();

        return view(Config::get('back_theme') . '.users.edit', compact('user', 'roles', 'userRole'));
    }

    /* Update the specified resource in storage.*/
    public function update(Request $request, $id) {
        $this->validate($request, [
          //  'name' => 'required|alpha_dash|unique:users,name,'.$id ,
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required'
        ]);

        $input = $request->all();
        // only update password when password ,confirm-password are not empty
        if (!empty($input['password']) && !empty($input['confirm-password'])) {
            $this->validate($request, [
                'password' => 'same:confirm-password'
            ]);
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));    // dont update password if we did not change password input & confirm-password
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('role_user')->where('user_id', $id)->delete();


        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        return redirect()->route('admin::users.show',$id)
                        ->with('success', 'User updated successfully');
    }

    /* Update User Status  .*/
    public function userStatusUpdate(Request $request, $id) {
        $this->validate($request, [
            'user_status_id' => 'required'
        ]);

        $input = \Request::only('user_status_id');
        $profile = Profile::where('user_id',$id);
        $profile->update($input);

        return redirect()->route('admin::users.show', $id)
                        ->with('success', 'User Status updated successfully');
    }

    /*** Display the specified resource.
    ****@param  int  $id */
    public function show($id) {
       // $user = User::find($id);
        $this->data['user'] = User::find($id);
        $this->data['user_status']= DB::table('user_statuses')->pluck('name', 'id');
        $this->data['roles']  = Role::pluck('display_name', 'id');
        $this->data['userRole'] =  $this->data['user']->roles->pluck('id', 'id')->toArray();


        return view(Config::get('back_theme') . '.users.show', $this->data);
    }



    /* Edit user basic profile form
      $id => user_id
    */

    public function basicEdit($id) {
       // $user = Profile::where('user_id', $id)->first();
        $this->data['user']= Profile::where('user_id', $id)->first();
        $this->data['user_status']= DB::table('user_statuses')->pluck('name', 'id');
        return view(Config::get('back_theme') . '.users.user_profile_basic_edit',$this->data);
    }

    /** Update the specified resource in storage.*/
    public function basicUpdate(Request $request, $id) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required'
        ]);

        $input = $request->all();

        $profile = Profile::where('user_id', $id)->first();
        $profile->update($input);

        return redirect()->route('admin::users.show', $profile->user_id)
                        ->with('success', 'User updated successfully');
    }


    /*** Remove the specified resource from storage.
    **** @param  int  $id */
    public function destroy($id) {
        User::find($id)->delete();
        return redirect()->route('admin::users.index')
                        ->with('success', 'User deleted successfully');
    }


    // User Addresss Methods
    //***************************************
   // create address form
    public function addressCreate($id) {
        $this->data['page_title'] = 'Profile Address Create';

        $this->data['user_id'] = $id;
        //$this->data['countries']= DB::table('countries')->lists('name', 'id');
        $this->data['countries']=Country::all()->pluck('name', 'id')->all();;

        return view(Config::get('back_theme') . '.users.user_profile_address_create', $this->data);
    }

    public function addressStore(Request $request, $id) {
        $this->validate($request, [

            'country_id' => 'required',
            'city' => 'required',
            'house_no' => 'required',
            'street' => 'required',
            'postal_code' => 'required'
        ]);

        $input = $request->all();
        $input['user_id'] = $id;
        $input['address_type_id'] = 1;
        $input['user_type'] = 'user';
        Address::create($input);

        return redirect()->route('admin::users.show', $id)
                        ->with('success', 'Address created successfully');
    }



    /* Edit user basic profile form
      $id => user_id
     */
    public function addressEdit($id) {

        $this->data['user']= Address::where('id', $id)->first();
        $this->data['countries']=Country::all()->pluck('name', 'id')->all();
        return view(Config::get('back_theme') . '.users.user_profile_address_edit',  $this->data);
    }

    /*** Update the specified resource in storage. */
    public function addressUpdate(Request $request, $id) {
        $this->validate($request, [
            'country_id' => 'required',
            'city' => 'required',
            'house_no' => 'required'
        ]);

        $input = $request->all();

//dd($id);
        $address = Address::where('id', $id)->first();
        $address->update($input);

        return redirect()->route('admin::users.show', $address->user_id)
                        ->with('success', 'User updated successfully');
    }

    public function addresDestroy($id) {
        $address = Address::find($id);
        $address->delete(); // delete address entry
        return redirect()->route('admin::users.show', $address->user_id)
                        ->with('success', 'Address deleted successfully');
    }




    // User Bank Account Methods
    //***************************************
   // create Bank Account form
    public function bankAccountCreate($id) {
        $this->data['page_title'] = 'Bank Account Create';

        $this->data['user_id'] = $id;

        $this->data['bank_data_types']=  \App\Models\BankDataType::all()->pluck('name', 'id')->all();
        return view(Config::get('back_theme') . '.users.user_bank_account_create', $this->data);
    }

    public function bankAccountStore(Request $request, $id) {
        $this->validate($request, [

            'bank_data_type_id' => 'required',
            'bank_name' => 'required',
            'id_number' => 'required',
            'owner_name' => 'required'
        ]);



        $input = $request->all();
        $input['user_id'] = $id;
        BankAccount::create($input);

        return redirect()->route('admin::users.show', $id)
                        ->with('success', 'Bank account created successfully');
    }



    /* Edit bankAccountEdit form
     */
    public function bankAccountEdit($id) {
        $this->data['user_id'] = $id;
        $this->data['user']= BankAccount::where('id', $id)->first();
        $this->data['bank_data_types']=  \App\Models\BankDataType::all()->pluck('name', 'id')->all();
        return view(Config::get('back_theme') . '.users.user_bank_account_edit',  $this->data);
    }

    /*** Update the bankAccount  in storage. */
    public function bankAccountUpdate(Request $request, $id) {
        $this->validate($request, [
            'bank_data_type_id' => 'required',
            'bank_name' => 'required',
            'id_number' => 'required',
            'owner_name' => 'required',
        ]);

        $input = $request->all();


        $address = BankAccount::where('id', $id)->first();
        $address->update($input);

        return redirect()->route('admin::users.show', $address->user_id)
                        ->with('success', 'User updated successfully');
    }

    // detete bank account
    public function bankAccountDestroy($id) {
        $bankAccount = BankAccount::find($id);
        $bankAccount->delete(); // delete user_bank_account entry
        return redirect()->route('admin::users.show', $bankAccount->user_id)
                        ->with('success', 'Bank Account deleted successfully');
    }
    //delete data from tables
     // public function accountDestroyTables(Request $request)
     // {
     //  // ddd($request->all());
     //   $this->validate($request,[
     //     // 'email'=>'required',
     //     'contact_name'=>'required',
     //     'tables'=>'required'
     //   ]);
     //
     //   $contact_id=$request->contact_name;
     //   $user_id=$request->user_id;
     //
     //   foreach($request->tables as $table)
     //   {
     //
     //     if($table=='sales_invoice_tables')
     //         UserController::removeSalesInvoice($user_id,$contact_id);
     //      elseif($table=='contacts_customer_tables')
     //             UserController::removeContactsCustomer($user_id,$contact_id);
     //      elseif($table=='finance_banks_tables')
     //             UserController::removeFinanceBanks($user_id,$contact_id);
     //      elseif($table=='finance_treasury_tables')
     //             UserController::removeFinanceTreasures($user_id,$contact_id);
     //     elseif($table=='finance_credit_tables')
     //               UserController::removeFinanceCredits($user_id,$contact_id);
     //
     //
     //
     //
     //   }
     //
     //   return response()->json(['success'=>'Tables Deleted successfully']);
     //
     //
     // }
     public function removeSalesInvoice($user_id,$contact_id)
     {
       //delete in sale invoice-installment -salesinvoiceitems
           $sales_invoices=SalesInvoice::where('user_id',$user_id)->get();
           //dd(count($sales_invoices));
           foreach($sales_invoices as $sale_invoice)
           {
             $sales_invoice_items=$sale_invoice->invoiceItems;
             $installments=Installment::where('sales_invoice_id',$sale_invoice->id)->get();

             foreach($sales_invoice_items as $sales_invoice_item)
                {
               $sales_invoice_item->delete();

               }
             foreach($installments as $installment)
             {
                  $installment->delete();

             }
           $sale_invoice->delete();
           }

           return 1;
     }
/********************************New Functions ***********************************************************/

    public function user_index(Request $request) {
        $data = User::orderBy('id', 'ASC')->get();
        $roles = Role::orderBy('id','ASC')->get();
        $profile = Profile::orderBy('id','ASC')->get();
        $this->data['data']= $data;
        $this->data['roles']= $roles;
        $this->data['profile']= $profile;
        if ($request->ajax()) {
            return view(Config::get('back_theme') . '.users.Ajax.LoadAllUsers', $this->data)->render();
        }
        return view(Config::get('back_theme') . '.users.users', compact('data','roles','profile'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function roles_index(Request $request) {
        $roles = Role::orderBy('id','ASC')->get();
        $permission = Permission::orderBy('id','ASC')->get();
        return view(Config::get('back_theme') . '.users.users_roles', compact('roles','permission'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function user_setting_index(Request $request) {
        $data = UserSetting::orderBy('id', 'ASC')->paginate(10);
        $types = UserSettingType::orderBy('id','ASC')->paginate(10);
        $users = User::orderBy('id', 'ASC')->get();
        return view(Config::get('back_theme') . '.users.users_settings', compact('data','types','users'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }



    public function searchEmail(Request $request){

             if($request->ajax()){

                $output = '';
                $emails = DB::table("users")->where('Email','LIKE','%'.$request->search.'%')
                                                 ->get();
                }
                if($emails){
                    $i = 0;
                    foreach ($emails as $key => $value) {
                        $user_id = $value->id;
                        $roles    = \DB::table('role_user')->where('user_id','=',$user_id)->get();
                        $user_roles = [];
                        foreach ($roles as $key => $value4) {
                            $names = Role::where('id', '=' , $value4->role_id)->get();
                            foreach ($names as $key => $role_name) {
                                array_push($user_roles, $role_name->display_name);
                            }
                        }



                        $output .=  "<tr class='tab-row'>".
                                        "<td>".++$i."</td>".
                                        "<td>";


                            for ($x=0; $x < count($user_roles); $x++) {
                                $output .="<h5>".$user_roles[$x]."</h5>";

                            }

                            $output .="</td>"."<td>".
                                "<label class='labels' val='".$value->id."'>".$value->email."</label>".
                                "</td>"."<td>".
                                    "<button type='button' name='delete' class='btn btn-danger btn-xs  delete' alt='". trans('button.delete')."' disabled>"."<i class='fa fa-trash'></i> ". trans('button.delete') ."</button>".
                                    "</td>".
                                "</tr>".
                            "</form>";


                   }
                return Response($output);
                }else{
                    $msg = 'No result are found';
                    return Response("<div class='row' style='margin:0;padding:0;'>".$msg."</div>");
                }
    }

    public function addUser(Request $request){



        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['is_activated']=1;

        $user = User::create($input);
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        // create user profile on the fly
        $expireDate = Carbon::today()->addWeeks(1)->toDateString();
        $profile = new Profile(array(
            'user_status_id' => 1, 'user_status_id' => 1, // active
            'expire_date' => $expireDate,
        ));

        $user->profile()->save($profile);
        return response ()->json ();
    }

    public function removeUser(Request $request){


        Feedback::where('user_id',$request->id)->delete();
        $helps=Helping::where('user_id',$request->id)->get();
        foreach($helps as $help)
        {
        $replays=HelpingReplay::where('helping_id',$help->id)->get();
         foreach($replays as $replay)
                $replay->delete();
         $help->delete();
       }

         User::find($request->id)->delete();
        return response ()->json ();

    }

    public function editUser(Request $req){


        $data = User::where('id' , '=' , $req->user_id)->get();
        $user_id=$req->user_id;
        $roles = Role::orderBy('id','ASC')->get();
        $tables=array('sales_invoice_tables'=>'sales_invoice_tables','abstract_invoice_tables'=>'abstract_invoice_tables',
                      'sales_invoice_return'=>'sales_invoice_return','other_income'=>'other_income','finance_banks_tables'=>'finance_banks_tables','finance_treasury_tables'=>'finance_treasury_tables',
                     'finance_credit_tables'=>'finance_credit_tables','cost'=>'cost','cost_other'=>'cost_other','salary'=>'salary');

        $contact_names=Contact::where('user_id',$user_id)->get(['first_name','last_name','id'])->pluck('full_name','id');
        return view(Config::get('back_theme') . '.users.edituser', compact('data','roles','tables','contact_names','user_id'));

    }

    public function editUserAcc(Request $request){
        /*$this->validate($request, [
            'email' => 'required|email|unique:users,email,',
            'roles' => 'required'
        ]);*/

        $input = $request->all();
        if (!empty($request->password) && !empty($request->confirm_password)) {
            $this->validate($request, [
                'password' => 'same:confirm_password'
            ]);
            $input['password'] = Hash::make($request->password);
        } else {
            $input = array_except($input, array('password'));
        }
        $user = User::find($request->id);
        $user->update($input);
        DB::table('role_user')->where('user_id', $request->id)->delete();

        $roles = $request->roles;
        for ($i=0 ; $i < count($roles) ; $i++ ) {
             \DB::table('role_user')->insert(
                    ['user_id' => $request->id , 'role_id' => $roles[$i]]
                );
        }
        return response ()->json ();
    }

    public function editUserProfile(Request $request) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required'
        ]);

        $input = $request->all();
        $status = $request->user_status_id;
        $profile = Profile::where('user_id', $request->id)->first();
        $profile->update($input);

        $user = User::where('id', '=' , $request->id)->first();
        $user->is_activated = $status;
        $user->save();

        return response ()->json ();
    }

    public function addUserAddress(Request $request) {
        $this->validate($request, [

            'country_id' => 'required',
            'city' => 'required',
            'house_no' => 'required',
            'street' => 'required',
            'postal_code' => 'required'
        ]);

        $input = $request->all();
        $input['user_id'] = $request->user_id;
        $input['address_type_id'] = 1;
        $input['user_type'] = 'user';
        Address::create($input);

        return response ()->json ();
    }

    public function removeUserAddress(Request $request) {
        $address = Address::find($request->id);
        $address->delete(); // delete address entry
        return response ()->json ();
    }

    public function editUserAddress(Request $request) {
        $this->validate($request, [
            'country_id' => 'required',
            'city' => 'required',
            'house_no' => 'required'
        ]);

        $input = $request->all();

        $address = Address::where('id', $request->id)->first();
        $address->update($input);

        return response ()->json ();
    }


    public function addUserBankAccount(Request $request) {
        $this->validate($request, [

            'bank_data_type_id' => 'required',
            'bank_name' => 'required',
            'id_number' => 'required',
            'owner_name' => 'required'
        ]);

        $input = $request->all();
        $input['user_id'] = $request->user_id;
        BankAccount::create($input);

        return response ()->json ();
    }

    public function removeUserBankAccount(Request $request) {

        $bankAccount = BankAccount::find($request->id);
        $bankAccount->delete(); // delete user_bank_account entry

        return response ()->json ();
    }

    public function editUserBankAccount(Request $request) {
        $this->validate($request, [
            'bank_data_type_id' => 'required',
            'bank_name' => 'required',
            'id_number' => 'required',
            'owner_name' => 'required',
        ]);

        $input = $request->all();


        $address = BankAccount::where('id', $request->id)->first();
        $address->update($input);

        return response ()->json ();
    }

/********************************New Functions ***********************************************************/


/****************************************************************************************/

    public function inactivate_users_index(Request $request){
        $data = User::where('is_admin','=',0)->where('is_activated','=',0)->orderBy('id', 'ASC')->get();
        $this->data['data'] = $data;
        if ($request->ajax()) {
            return view(Config::get('back_theme') . '.users.Ajax.LoadInactivatedUsers', $this->data)->render();
        }

    }

    public function users_plan_index(Request $request){
        $data = [];
        $users = User::where('is_admin','=',0)->where('is_activated','=',1)->orderBy('id', 'ASC')->get();
        foreach ($users as $key => $value) {
            $user_id = $value->id;
            $profile = Profile::where('user_id','=',$user_id)->first();
            if($profile['price_plan_id'] == 0){

            }else{
                $price_plan = \DB::table('price_plans')->where('id','=',$profile['price_plan_id'])->first();
                $data[] =[
                    'id'    => $value->id,
                    'email' => $value->email,
                    'created_at' => $value->created_at,
                    'name'  => $price_plan->name,
                    'period'=> $price_plan->period,
                    'period_id' => $price_plan->period_id,
                ];
            }
        }
        $this->data['data'] = $data;
        if ($request->ajax()) {
            return view(Config::get('back_theme') . '.users.Ajax.LoadUsersPlans', $this->data)->render();
        }

    }

    public function expire_plan_index(Request $request){
        $data = [];
        $end_date ='';
        $end_date1='';
        $users = User::where('is_admin','=',0)->where('is_activated','=',1)->orderBy('id', 'ASC')->get();
        foreach ($users as $key => $value) {
            $user_id = $value->id;
            $profile = Profile::where('user_id','=',$user_id)->first();
            if($profile['price_plan_id'] == 0){

            }else{
                $price_plan = \DB::table('price_plans')->where('id','=',$profile['price_plan_id'])->first();
                $start_date = Carbon::parse($profile['created_at']);
                $now = Carbon::now()->format('Y-m');
                $period_id = $price_plan->period_id;

                if($period_id ==1){
                    $end_date1 = $start_date->addMonth(1);
                    $end_date = Carbon::parse($end_date1)->format('Y-m');
                }elseif ($period_id ==2) {
                    $end_date1 = $start_date->addMonth(3);
                    $end_date = Carbon::parse($end_date1)->format('Y-m');
                }elseif ($period_id == 3) {
                    $end_date1 = $start_date->addYear(1);
                    $end_date = Carbon::parse($end_date1)->format('Y-m');
                }

                if($end_date == $now){
                    $data[] =[
                    'id'    => $value->id,
                    'email' => $value->email,
                    'created_at' => $profile['created_at'],
                    'name'  => $price_plan->name,
                    'period'=> $price_plan->period,
                    'period_id' => $price_plan->period_id,
                    'expired_at' => $end_date1,
                ];
                }


            }
        }
        $this->data['data'] = $data;
        if ($request->ajax()) {
            return view(Config::get('back_theme') . '.users.Ajax.LoadExpireUsers', $this->data)->render();
        }

    }


    public function new(Request $request){
        $dateS = Carbon::now()->startOfMonth();
        $dateE = Carbon::now()->endOfMonth();
        $data = User::whereBetween('created_at',[$dateS,$dateE])->orderBy('id', 'ASC')->get();
        $this->data['data'] = $data;
        if ($request->ajax()) {
            return view(Config::get('back_theme') . '.users.Ajax.LoadNewUsers', $this->data)->render();
        }

    }

    public function pend(Request $request){

        $data =[];
        $user = Profile::where('user_status_id','=',3)->get();
        foreach ($user as $key => $value) {
            $data[] = User::where('id','=',$value->user_id)->where('is_admin','=',0)->first();
        }

        $this->data['data'] = $data;
        if ($request->ajax()) {
            return view(Config::get('back_theme') . '.users.Ajax.LoadPendingUsers', $this->data)->render();
        }

    }

    public function susp(Request $request){

        $data =[];
        $user = Profile::where('user_status_id','=',4)->get();
        foreach ($user as $key => $value) {
            $data[] = User::where('id','=',$value->user_id)->where('is_admin','=',0)->first();
        }

        $this->data['data'] = $data;
        if ($request->ajax()) {
            return view(Config::get('back_theme') . '.users.Ajax.LoadSuspendedUsers', $this->data)->render();
        }

    }

    public function rolesUser(Request $request){
        $data = Role::orderBy('id','ASC')->get();


        $this->data['data'] = $data;
        if ($request->ajax()) {
            return view(Config::get('back_theme') . '.users.Ajax.LoadRoleUsers', $this->data)->render();
        }
    }

}
