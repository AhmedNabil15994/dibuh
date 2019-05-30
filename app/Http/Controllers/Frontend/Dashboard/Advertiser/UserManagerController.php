<?php

namespace App\Http\Controllers\Frontend\Dashboard\Advertiser;

use Illuminate\Session\TokenMismatchException;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Country;
use App\Models\UserProfile as Profile;
use App\Models\UserAddress as Address;
use Illuminate\Support\Collection;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Carbon;
use View;
use DB;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class UserManagerController extends DashboardBaseController {

    protected $userType = 'advertiser';
    protected $module = 'user_manager';        

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        View::share('userType', $this->userType);
        View::share('module', $this->module);                        
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index() {


        $this->data['page_title'] = 'User Profile';
        $this->data['user'] = 'user id:' . Auth::user()->id . ' user :' . Auth::user()->name . '<hr><br/>' . Auth::user()->roles;
        $this->data['user_name'] = Auth::user()->name;


        $this->data['user_type'] = Auth::user()->roles;
        return $this->view($this->userType .'.' . $this->module . '.index', $this->data);
    }

    public function basicIndex() {

        $this->data['page_title'] = 'Profile Basic Data';

        $user = Auth::user()->profile;
        $user = User::with('profile', 'address')->where('id', Auth::user()->id)->get();
        // dd($user);
        $this->data['data'] = $user;

        return $this->view($this->userType .'.' . $this->module . '.profile_basic_index', $this->data);
    }

    public function basicEdit() {

        $this->data['page_title'] = 'Profile Basic Edit';

        $user = Auth::user()->profile;
        // $user=User::with('profile', 'address')->where('id',Auth::user()->id)->get();
        // dd($user);
        $this->data['data'] = $user;

        return $this->view($this->userType .'.' . $this->module . '.profile_basic_edit', $this->data);
    }

    public function basicUpdate(Request $request, $id) {
        //   dd($request);
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'required',
            'phone' => 'required|',
            'mobile' => 'required',
            'fax' => ''
        ]);
        Profile::find($id)->update($request->all());
        //$user=User::with('profile', 'address')->where('id',Auth::user()->id)->get();
        return redirect()->route('profile.basic.index')
                        ->with('success', 'User updated successfully');
    }

//**********************************************************************************************************//    
    // User Address  Methods
    //***************************************    
    public function addressIndex() {
        $this->data['page_title'] = 'Profile Basic Data';
        $this->data['data'] = Auth::user()->address;

        return $this->view($this->userType .'.' . $this->module . '.profile_address_index', $this->data);
    }

    public function addressCreate() {
        $this->data['page_title'] = 'Profile Address Create';

        $this->data['countries']=Country::all()->pluck('name', 'id')->all();

        return $this->view($this->userType .'.' . $this->module . '.profile_address_create', $this->data);
    }

    public function addressStore(Request $request) {
        $this->validate($request, [

            'country_id' => 'required',
            'city' => 'required',
            'house_no' => 'required',
            'street' => 'required',
            'postal_code' => 'required'
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['address_type_id'] = 1;
        $input['user_type'] = 'user';
        Address::create($input);

        return redirect()->route('profile.address.index')
                        ->with('success', 'Address created successfully');
    }

    public function addressEdit($id) {
        $this->data['page_title'] = 'Profile Basic Edit';
        $this->data['data'] = Address::find($id);
        $this->data['countries']=Country::all()->pluck('name', 'id')->all();
        return $this->view($this->userType .'.' . $this->module . '.profile_address_edit', $this->data);
    }

    public function addressUpdate(Request $request, $id) {
        //   dd($request);
        $this->validate($request, [
            'country_id' => 'required',
            'city' => 'required',
            'street' => 'required',
            'house_no' => 'required|',
            'postal_code' => 'required'
        ]);
        Address::find($id)->update($request->all());
        //$user=User::with('profile', 'address')->where('id',Auth::user()->id)->get();
        return redirect()->route('profile.address.index')
                        ->with('success', 'User updated successfully');
    }

    public function destroy($id) {
        Address::find($id)->delete();
        return redirect()->route('profile.address.index')
                        ->with('success', 'Address deleted successfully');
    }

//**********************************************************************************************************//    
    //methods for create users by Salesman,Advertiser
    //show user created by
//==============================================//    
    public function usersIndex() {
        $this->data['page_title'] = 'Users Created';
        $this->data['data'] = User::where('created_by', Auth::user()->id)->get();
        return $this->view($this->userType .'.' . $this->module . '.users_index', $this->data);
    }

    //display form for create by users
    public function usersCreate() {
        $this->data['page_title'] = 'Create User';
        return $this->view($this->userType .'.' . $this->module . '.users_create', $this->data);
    }

    //Store users created by    
    public function usersStore(Request $request) {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                    $request, $validator
            );
        }

        $user = $this->create($request->all());
        return redirect(route('users.index'))->with('status', 'We sent you an activation code. Check your email.');
    }

    protected function create(array $data) {
        $user = User::create([
                    'name' => $data['email'],
                    'email' => $data['email'],
                    'is_activated' => 1,
                    'created_by' => Auth::user()->id,
                    'password' => bcrypt($data['password']),
        ]);
        $user->roles()->attach($data['user_role']); // id only   to assign role id to the created user;

        $expireDate = Carbon::today()->addWeeks(1)->toDateString();

        $profile = new Profile(array(
            'user_status_id' => 1,
            'expire_date' => $expireDate,
        ));

        $user->profile()->save($profile);
        return $user;
    }

    protected function validator(array $data) {
        return Validator::make($data, [
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6'
        ]);
    }

//**********************************************************************************************************//    
    // User Bank Account Methods
    //***************************************
//display my bank accounts    
    public function bankAccountIndex() {

        $this->data['page_title'] = 'Bank Account Data';
        // $user = User::with('profile', 'address')->where('id', Auth::user()->id)->get();
        $this->data['data'] = Auth::user()->bankAccounts;

        return $this->view($this->userType .'.' . $this->module . '.profile_bankaccount_index', $this->data);
    }

    // create Bank Account form
    public function bankAccountCreate() {
        $this->data['page_title'] = 'Bank Account Create';

        /// $this->data['user_id'] = $id;
        $this->data['bank_data_types']=  \App\Models\BankDataType::all()->pluck('name', 'id')->all();       
        return $this->view($this->userType .'.' . $this->module . '.profile_bankaccount_create', $this->data);
    }

    public function bankAccountStore(Request $request) {
        $this->validate($request, [
            'bank_data_type_id' => 'required',
            'bank_name' => 'required',
            'id_number' => 'required',
            'owner_name' => 'required'
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        BankAccount::create($input);

        return redirect()->route('profile.bankaccount.index')
                        ->with('success', 'Bank account created successfully');
    }

    /* Edit bankAccountEdit form 
     */

    public function bankAccountEdit($id) {
        //$this->data['user_id'] = $id;
        $this->data['page_title'] = 'Bank Account Edit';
        $this->data['data'] = BankAccount::find($id);
        $this->data['bank_data_types']=  \App\Models\BankDataType::all()->pluck('name', 'id')->all();       

        return $this->view($this->userType .'.' . $this->module . '.profile_bankaccount_edit', $this->data);
    }

    /*     * * Update the bankAccount  in storage. */

    public function bankAccountUpdate(Request $request, $id) {
        $this->validate($request, [
            'bank_data_type_id' => 'required',
            'bank_name' => 'required',
            'id_number' => 'required',
            'owner_name' => 'required',
        ]);

        $input = $request->all();

        $bankAccount = BankAccount::where('id', $id)->first();
        $bankAccount->update($input);

        return redirect()->route('profile.bankaccount.index', $bankAccount->user_id)
                        ->with('success', 'User updated successfully');
    }

    // detete bank account
    public function bankAccountDestroy($id) {
        $bankAccount = BankAccount::find($id);
        $bankAccount->delete(); // delete user_bank_account entry
        return redirect()->route('profile.bankaccount.index', $bankAccount->user_id)
                        ->with('success', 'Bank Account deleted successfully');
    }

//**********************************************************************************************************//  
}
