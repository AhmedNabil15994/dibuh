<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\BackendBaseController;
use App\Models\AccountCompanytype;
use App\Models\Account;
use Illuminate\Http\Request;
use Session;
use Config;

class AccountToCompanytypeController extends BackendBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $accounts = Account::orderBy('lineage', 'ASC')->paginate(25);

        return view(Config::get('back_theme') . '.account_to_companytype.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $selected_companytype = [];
        $accounts = Account::get()->pluck('full_desc', 'id')->all();
        $company_types = \App\Models\CompanyType::get()->pluck('name', 'id')->all();
        $this->data = compact('accounts', 'company_types','selected_companytype');
        return view(Config::get('back_theme') . '.account_to_companytype.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {

        $input = $request->all();
        //    dd($input);
        $account_id = $input['account_id'];
        foreach (\Input::get('company_types') as $selected_id) {
            $new_post = array(
                'account_id' => $account_id,
                'company_type_id' => $selected_id
            );
            $AccountCompanytype = new AccountCompanytype($new_post);
            $AccountCompanytype->save();
        }


        //   AccountCompanytype::create($input);

        Session::flash('flash_message', 'AccountCompanytype added!');

        return redirect(route('admin::account_to_companytype.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $account_to_companytype = AccountCompanytype::findOrFail($id);

        return view(Config::get('back_theme') . '.account_to_companytype.show', compact('account_to_companytype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $account_to_companytype = Account::findOrFail($id);
        $selected_companytype = AccountCompanytype::where('account_id', $id)->get()->pluck('company_type_id')->all();
      //  dd($selected_companytype);
        $accounts = Account::get()->pluck('full_desc', 'id')->all();
        $company_types = \App\Models\CompanyType::get()->pluck('name', 'id')->all();


        $this->data = compact('account_to_companytype', 'accounts', 'company_types', 'selected_companytype');
        return view(Config::get('back_theme') . '.account_to_companytype.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request) {
        $account_id=$id;
       // $account_to_companytype = AccountCompanytype::findOrFail($id);
        $delete = AccountCompanytype::where('account_id', '=', $account_id)->delete();
     
        $input = $request->all();
    //    $account_id = $input['account_id'];

        if (isset($delete)) {
          //  dd(\Input::get('company_types') );
            foreach (\Input::get('company_types') as $selected_id=>$val) {
                $new_post = array(
                    'account_id' => $account_id,
                    'company_type_id' => $selected_id
                );
                $AccountCompanytype = new AccountCompanytype($new_post);
                $AccountCompanytype->save();
            }
        }

        Session::flash('flash_message', 'AccountCompanytype updated!');

        return redirect(route('admin::account_to_companytype.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
//    public function destroy($id) {
//        AccountCompanytype::destroy($id);
//
//        Session::flash('flash_message', 'AccountCompanytype deleted!');
//
//        return redirect(route('admin::account.index'));
//    }
     public function editAccCompany(Request $request) {
        $account_id = $request->id;
        $delete = AccountCompanytype::where('account_id', '=', $account_id)->delete();

        $company_type_id = $request->company_type_id;  
        if(count($company_type_id) > 0){
            if (isset($delete)) {
                foreach ($company_type_id as $selected_id) {
                    $new_post = array(
                        'account_id' => $account_id,
                        'company_type_id' => $selected_id
                    );
                    $AccountCompanytype = new AccountCompanytype($new_post);
                    $AccountCompanytype->save();
                }
            }
        }
        return response()->json($company_type_id);   
    }
}
