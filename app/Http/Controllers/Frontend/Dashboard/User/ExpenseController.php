<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
use App\Models\Expense;
use App\Models\ProductType;
use App\Models\ExpenseType;
use App\Models\Unit;
use Config;
use Carbon;
use View;
use Illuminate\Contracts\Encryption\DecryptException;

class ExpenseController extends DashboardBaseController {
    protected $userType = 'user';
    protected $module = 'expense';

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
        $this->data['page_title'] = trans('frontend/expense.title') ;

        return $this->view($this->userType . '.'.$this->module.'.'.'main', $this->data);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //


        $this->data['data'] = Expense::orderBy('id', 'DESC')->get();
        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.ajax.load_expense_with_types' ,  $this->data)->render();
        }

        $this->data['page_title'] = trans('frontend/expense.title') ;
        $this->data['user_type'] = Auth::user()->roles;

        return $this->view($this->userType . '.' . $this->module . '.' . 'index', $this->data)
                        ->with('i', ($request->input('page', 1) - 1) * 10);

    }
    //ajax request
    public function LoadAjaxFilterType(Request $request,$type){
        if ($type == 0 ){
            $data = Expense::orderBy('id', 'DESC')->get();
        }else{
            $expenseType = ExpenseType::find($type);
            $data = $expenseType->expense()->get();
        }

        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.ajax.load_expense_with_types' , ['data' => $data])->render();
        }

        $page_title = trans('frontend/expense.title');
        $user_type = Auth::user()->roles;
        return $this->view($this->userType . '.' . $this->module . '.' . 'index', compact('page_title','user_type','data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    public function getTaxData(Request $request){
        $tax_type_id=$request->tax_type_id;
        $responce= \App\Models\Tax::where('tax_type_id', $tax_type_id)->get();

        return Response::json($responce);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $this->data['page_title'] =   trans('frontend/expense.create_new') ;
        $this->data['expense_type'] = ExpenseType::all()->pluck('name', 'id')->all(); //\DB::table('expense_type')->pluck('name', 'id');
        $this->data['unit'] = Unit::all()->pluck('name', 'id')->all();



        $this->data['accounts'] =\DB::table('v_user_accounts')
                                                        ->where('screens', 'like', '%|14|%')
                                                        ->where('user_id',  Auth::user()->id)
                                                        ->select('account_id as id', 'account_code', 'name')
                                                        ->get();

     //   $this->data['accounts'] = \App\Models\Screen::find( 13)->accounts()->users->all();
   //     $this->data['accounts'] =$this->data['accounts']->screen->all();
        $this->data['accounts_major'] = \App\Models\User::find(Auth::user()->id)->accounts()->where('is_major',1)->get()->pluck('id')->toArray();
        $this->data['tax_type'] = \App\Models\TaxType::get()->pluck('name', 'id')->all(); //\DB::table('expense_type')->pluck('name', 'id');
        $this->data['user_id'] = Auth::user()->id;
    //    dd($this->data['accounts_major']);

        return $this->view($this->userType . '.'.$this->module.'.'.'create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // 'name', 'tax', 'text', 'description', 'expense_type', 'created_by', 'is_visible'
        $this->validate($request, [
            'expense_code' => 'required|unique:expenses',
            'name' => 'required',
          'description' => 'required',
        //    'expense_type_id' => 'required',

        ]);
        $input = $request->all();

        //get current user id for created by user:
        $input['user_id'] = Auth::user()->id; //this is only for frontend method
       // dd(  $input['created_by']);
        Expense::create($input);

        return redirect()->route('expense.index')
                        ->with('success', 'Expense created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $this->data['page_title'] =   trans('frontend/expense.edit') ;
        $this->data['data'] = Expense::find($id);
        $this->data['expense_type'] = ExpenseType::all()->pluck('name', 'id')->all(); //\DB::table('expense_type')->pluck('name', 'id');
        $this->data['unit'] = Unit::all()->pluck('name', 'id')->all();
        $this->data['accounts'] = \App\Models\User::find( Auth::user()->id)->accounts()->orderBy('lineage', 'ASC')->get()->pluck('full_desc','id')->all();
        $this->data['accounts_major'] = \App\Models\User::find(Auth::user()->id)->accounts()->where('is_major',1)->get()->pluck('full_desc','id')->all();

        $this->data['tax_type'] = \App\Models\TaxType::get()->pluck('name', 'id')->all(); //\DB::table('expense_type')->pluck('name', 'id');
        $this->data['user_id'] = Auth::user()->id;





        return  $this->view($this->userType . '.'.$this->module.'.'.'edit', $this->data);

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
            'expense_code' => 'required|unique:expenses,expense_code,' . $id,
            'name' => 'required',

            'description' => 'required',
        //    'expense_type_id' => 'required',

        ]);

        $input = $request->all();


        $model = Expense::find($id);
        $model->update($input);


        return redirect()->route('expense.index')
                        ->with('success', 'Expense updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //

        Expense::find($id)->delete();
        return redirect()->route('expense.index')
                        ->with('success', 'Expense deleted successfully');
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

    public function filter(Request $request,$expenseNumber = null,$name = null , $pages=10){
      if ($expenseNumber != -1 ){
          $data = Expense::where('expense_code',$expenseNumber)->orderBy('id', 'DESC')->get();
      }elseif($expenseNumber ==-1 && $name == -1 ){
          $data = Expense::orderBy('id', 'DESC')->get();
      }else{
      $data = Expense::where('name',$name)->orderBy('id', 'DESC')->get();

      }

      if ($request->ajax()) {
          return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.ajax.load_expense_with_types' , ['data' => $data])->render();
      }

    }

}
