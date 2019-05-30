<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
use App\Models\Account;
use App\Models\AccountType;
use App\Models\AccountCategory;
use Config;
use Carbon;
use Response;
use View;
use Illuminate\Contracts\Encryption\DecryptException;

class AccountController extends DashboardBaseController {

    protected $userType = 'user';
    protected $module = 'account_manager';

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

    public function main(Request $request) {
        //
        $this->data['page_title'] = trans('frontend/account.title');
                $accounts = \DB::table('accounts')
                    ->join('accounts_to_company_types', 'accounts.id', '=', 'accounts_to_company_types.account_id')
                    ->select('accounts.id','accounts.account_code','accounts.name','accounts.is_major','accounts_to_company_types.company_type_id',\DB::raw('1 as is_visible') )
                    ->groupBy('accounts.account_code')
                    ->orderBy('accounts.lineage')
                    ->get(); 
        $this->data['data'] = $accounts;        
 
  //      dd($accounts);     
        return $this->view($this->userType . '.' . $this->module . '.' . 'main', $this->data);
        //     return $this->view($this->userType . '.account_manager.profile_basic_index', $this->data);        
    }

    public function filter(Request $request){
        $ids = [];
        $data =[];
        $accounts = [];
        for ($i=0; $i <count($request->ids) ; $i++) {  
            if(isset($request->ids[$i])){       
                $ids[] = $request->ids[$i];
                $accounts[] = \DB::table('accounts')
                    ->join('accounts_to_company_types', 'accounts.id', '=', 'accounts_to_company_types.account_id')
                    ->where('accounts_to_company_types.company_type_id','=',$request->ids[$i])
                    ->select('accounts.id','accounts.account_code','accounts.name','accounts.is_major','accounts_to_company_types.company_type_id',\DB::raw('1 as is_visible') )
                    ->orderBy('accounts.lineage')
                    ->get();   

            }else{

            }
        }    
        foreach ($accounts as $key => $value) {
            foreach ($value as $key => $value1) {
                if(isset($data[$value1->account_code]) && $data[$value1->account_code] == $value1->account_code) {

                }else{
                    $data[$value1->account_code]=[
                        'account_code' => $value1->account_code,
                        'id'           => $value1->id,
                        'company_type_id' => $value1->company_type_id,
                        'name'         => $value1->name,
                        'is_major'      => $value1->is_major,
                    ];
                }
            }
            
        }   

        if ($request->ajax()) {
           return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadAccounts', ['data' => $data])->render();
        } 

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //
        $this->data['page_title'] = trans('frontend/account.title');
        $this->data['user_type'] = Auth::user()->roles;
        $this->data['data'] = Account::orderBy('id', 'DESC')->paginate(10);

        return $this->view($this->userType . '.' . $this->module . '.' . 'index', $this->data)
                        ->with('i', ($request->input('page', 1) - 1) * 10);
        //     return $this->view($this->userType . '.account_manager.profile_basic_index', $this->data);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $this->data['page_title'] = trans('frontend/account.create_new');
        $this->data['account_type'] = AccountType::all()->pluck('name', 'id')->all(); //\DB::table('account_type')->pluck('name', 'id');
        $this->data['account_category'] = AccountCategory::all()->pluck('name', 'id')->all();
        $this->data['is_common'] = ['0' => trans('master.no'), '1' => trans('master.yes')];
        $this->data['created_by'] = Auth::user()->id;


        return $this->view($this->userType . '.' . $this->module . '.' . 'create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // 'name', 'tax', 'text', 'description', 'account_type', 'created_by', 'is_visible'
        $this->validate($request, [
            'account_code' => 'required|digits_between:1,10|unique:accounts',
            'name' => 'required',
            'text' => 'required',
            'description' => 'required',
            'account_type_id' => 'required',
        ]);
        $input = $request->all();

        //get current user id for created by user:
        $input['created_by'] = Auth::user()->id; //this is only for frontend method
        // dd(  $input['created_by']);
        Account::create($input);


        return redirect()->route('account.index')
                        ->with('success', 'Account created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $this->data['page_title'] = trans('frontend/account.edit');
        $this->data['data'] = Account::find($id);
        $this->data['account_type'] = AccountType::all()->pluck('name', 'id')->all(); //\DB::table('account_type')->pluck('name', 'id');
        $this->data['account_category'] = AccountCategory::all()->pluck('name', 'id')->all();
        $this->data['is_common'] = ['0' => trans('master.no'), '1' => trans('master.yes')];
        $this->data['created_by'] = $this->selectUserID();

        return $this->view($this->userType . '.' . $this->module . '.' . 'edit', $this->data);
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


        $this->validate($request, [
            'account_code' => 'required|digits_between:1,10|unique:accounts,account_code,' . $id,
            'name' => 'required',
            'text' => 'required',
            'description' => 'required',
            'account_type_id' => 'required',
        ]);

        $input = $request->all();


        $model = Account::find($id);
        $model->update($input);


        return redirect()->route('account.index')
                        ->with('success', 'Account updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //

        Account::find($id)->delete();
        return redirect()->route('account.index')
                        ->with('success', 'Account deleted successfully');
    }
    
    
    //ajax request
    public function getAccountsJson(Request $request) {
       $accounts = Account::where('id','>',0)->get();;

        return \Response::json($accounts);
    }
    
    /**
	* Get all accounts with assigned company type for each user.
	*
	* @return \Illuminate\Http\Response
	*/
    public function getAccountsCompanyTypeJson() {
		$accounts = \DB::table('accounts')->get(); 
        return \Response::json($accounts);
    }
    
    /**
	* Save all used accounts for a user.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
  	public function saveAccountsToUser(Request $request) 
	{
		\DB::table('accounts_to_users')->where('user_id', Auth::user()->id)->delete();
		$data = $request->input('account_list');
		$accounts = array();
		$response = array("status" => "OK");
		if(is_array($data))
		{
			foreach($data as $account)
			{
				if($account["use"] == 1)
				{
					$insertAccount = array();
					$insertAccount["user_id"] = Auth::user()->id;
					$insertAccount["account_id"] = $account["account_id"];
					$insertAccount["displayname"] = NULL;
					if(!is_null($account["display_name"]) && !empty($account["display_name"]))
						$insertAccount["displayname"] = $account["display_name"];
					$insertAccount["created_at"] = date('Y-m-d H:i:s');
					$insertAccount["updated_at"] = date('Y-m-d H:i:s');
					$accounts[] = $insertAccount;
				}
			}
			if(count($accounts) > 0)
			{
				\DB::table('accounts_to_users')->insert($accounts);
				$response["status"] = "ok";
				$response["message"] = trans('account.accounts_saved');
			}
		}
		else
		{
			$response["status"] = "error";
			$response["message"] = trans('account.accounts_not_saved');
		}
		return \Response::json($response);
	}
    
    
     
     
 
    

    //=========================================================
    //Helper methods
    //=========================================================   
    public function selectUserID() {

        $select = Profile::get(['user_id', 'first_name', 'last_name'])->flatten()->all();
        foreach ($select as $v) {
            $profiles[$v->user_id] = $v->first_name . ' ' . $v->last_name;
        }
        return $profiles;
    }


    public function storeDisplay(Request $request){
        $account_id = $request->account_id;
        $display_name   = $request->display_name;
        $user_id  = Auth::user()->id;

        if(\DB::table('users_accounts')->where('user_id','=',$user_id)->where('account_id','=',$account_id)->count() > 0){
            \DB::table('users_accounts')->where('user_id','=',$user_id)->where('account_id','=',$account_id)->update([

                'account_id'      => $account_id,
                'display_name'    => $display_name,
                'user_id'         => $user_id

            ]);
        }else{
            \DB::table('users_accounts')->insert([

                'account_id'      => $account_id,
                'display_name'    => $display_name,
                'user_id'         => $user_id

            ]);
        }

        return Response::json();
    }

}
