<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\BackendBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
use App\Models\Account;
use App\Models\AccountType;
use App\Models\AccountCategory;
use Config;
use Carbon;
use Illuminate\Contracts\Encryption\DecryptException;

class AccountCategoryController extends BackendBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //

        $data = AccountCategory::orderBy('id', 'DESC')->paginate(10);
        return $this->view('account_category.index', compact('data'))
                        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //

        return $this->view('account_category.create', $this->data);
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
            'code' => 'required|digits_between:1,10|unique:account_categories',
            'name' => 'required',
        ]);

        $input = $request->all();
        AccountCategory::create($input);


        return redirect()->route('admin::account_category.index')
                        ->with('success', 'Account Category created successfully');
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
        //
        $this->data['data'] = AccountCategory::find($id);




        return $this->view('account_category.edit', $this->data);
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
            'code' => 'required|digits_between:1,10|unique:account_categories,code,' . $id,
            'name' => 'required',
            

        ]);

        $input = $request->all();

        $model = AccountCategory::find($id);
        $model->update($input);


        return redirect()->route('admin::account_category.index')
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

        AccountCategory::find($id)->delete();
        return redirect()->route('admin::account_category.index')
                        ->with('success', 'Account Cateogry deleted successfully');
    }

    //=========================================================
    //Helper methods
    //=========================================================   
    public function setting_acc_category(Request $request){
        $acc_cat = AccountCategory::orderBy('id', 'ASC')->paginate(25);
        return view(Config::get('back_theme') . '.account_setting.Acc_category', compact('acc_cat'))->with('i', ($request->input('page', 1) - 1) * 25);
    }

    public function addAccCat(Request $request) {
        // 'name', 'tax', 'text', 'description', 'account_type', 'created_by', 'is_visible'
        $this->validate($request, [
            'code' => 'required|digits_between:1,10|unique:account_categories',
            'name' => 'required',
        ]);

        $data = new AccountCategory ();
        $data->name = $request->name;
        $data->code = $request->code;
        $data->save ();
        return response ()->json ( $data );
    }

    public function editAccCat(Request $request) {
        //
        $this->validate($request, [
            //'code' => 'required|digits_between:1,10|unique:account_categories,code,' . $request->id,
            'name' => 'required',
        ]);

        $cat = AccountCategory::find ($request->id);
        $cat->name = $request->name;
        
        $cat->save();
        return response()->json($cat);   
    }

    public function removeAccCat(Request $request) {
        //
       
        AccountCategory::find($request->id)->delete();
        return response()->json();
    }
 

}
