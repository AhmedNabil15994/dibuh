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
use App\Models\CompanyType;
use App\Models\Category;
use App\Models\Tax;
use App\Models\TaxType;
use App\Models\AccountCategory;
use App\Models\AccountTax;
use App\Models\AccountScreen;
use App\Models\Screen;
use Config;
use DB;
use Carbon;
use Illuminate\Contracts\Encryption\DecryptException;

class AccountController extends BackendBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //

        $data = Account::orderBy('lineage', 'ASC')->paginate(50);
        return $this->view('account.index', compact('data'))
                        ->with('i', ($request->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $this->data['account_type'] = AccountType::all()->pluck('name', 'id')->all();
        $this->data['category'] = Category::all()->pluck('name', 'id')->all();
        $this->data['account_category'] = AccountCategory::all()->pluck('name', 'id')->all();
        $this->data['company_type'] = CompanyType::all()->pluck('name', 'id')->all();
//        $this->data['tax_1'] = \App\Models\Tax::where('tax_type_id',1)->get()->pluck('full_desc', 'id')->all();   //
//        $this->data['tax_2'] = \App\Models\Tax::where('tax_type_id',2)->get()->pluck('full_desc', 'id')->all();   //
        $this->data['created_by'] = $this->selectUserID();
        // #3 Getting ancestors by primary key
        ///$result = Account::descendantsOf(0);
        $this->data['parent'] = Account::where('is_major',1)->get()->pluck('name', 'id')->all();
        $this->data['is_common'] = ['0'=>trans('master.no'),'1'=>trans('master.yes')];
        $this->data['is_major'] = ['0'=>trans('master.no'),'1'=>trans('master.yes')];
        return $this->view('account.create', $this->data);
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
        $input['created_by'] = Auth::user()->id;
        $account=new Account();
        $input['depth'] =$account->setDepthVal( $input['parent_id']); //get depth for the new inserted record

      //  Account::create($input);
        $insertedId = Account::create($input)->id;

        if(!empty($insertedId))

          $data['lineage']= $account->createLineage($insertedId,$input['parent_id']);
        $account->doUpdate($insertedId,$data);;

        return redirect()->route('admin::account.index')
                        ->with('success', 'Account created successfully');
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
        $this->data['data'] = Account::find($id);
        $this->data['account_type'] = AccountType::all()->pluck('name', 'id')->all();
        $this->data['category'] = Category::all()->pluck('name', 'id')->all();
        $this->data['account_category'] = AccountCategory::all()->pluck('name', 'id')->all();
        $this->data['company_type'] = CompanyType::all()->pluck('name', 'id')->all();
//        $this->data['tax_1'] = \App\Models\Tax::where('tax_type_id',1)->get()->pluck('full_desc', 'id')->all();   //
//        $this->data['tax_2'] = \App\Models\Tax::where('tax_type_id',2)->get()->pluck('full_desc', 'id')->all();   //
        $this->data['created_by'] = $this->selectUserID();

        $this->data['parent'] = Account::where(['is_major'=>1])->get()->pluck('name', 'id')->all();
        $this->data['is_common'] = ['0'=>trans('master.no'),'1'=>trans('master.yes')];
        $this->data['is_major'] = ['0'=>trans('master.no'),'1'=>trans('master.yes')];



        return $this->view('account.edit', $this->data);
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
        $input['created_by'] = Auth::user()->id;

        $account=new Account();


        if( $input['parent_id']==0 ||  $input['parent_id'] == null)
            $input['depth']=1;
        else
            $input['depth'] =$account->setDepthVal( $input['parent_id']); //get depth for the new inserted record

        $model = Account::find($id);
        $model->update($input);
        if(!empty($id))
          $data['lineage']= $account->createLineage($id,$input['parent_id']);
       // die;
        $account->doUpdate($id,$data);;    // update lineage


        return redirect()->route('admin::account.index')
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
        return redirect()->route('admin::account.index')
                        ->with('success', 'Account deleted successfully');
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



    public function setting_index(Request $request) {

        $parent = Account::where('is_major',1)->get();
        $is_major = ['0'=>trans('master.no'),'1'=>trans('master.yes')];
        $company_type= CompanyType::get();
        $category = Category::get();
        $account_category= AccountCategory::get();
        $account_type= AccountType::get();
        $created_by= Auth::user()->id;
        $data = Account::orderBy('lineage', 'ASC')->paginate(25);
        return view(Config::get('back_theme') . '.account_setting.accounts', compact('data',$this->data,'parent','company_type','category','account_category','account_type','created_by'))->with('i', ($request->input('page', 1) - 1) * 25);
    }

    public function setting_tax(Request $request) {
        //
       $tax_types = TaxType::with('tax')->paginate(25);
       return view(Config::get('back_theme') . '.account_setting.tax', compact('tax_types'));
    }

    public function setting_taxtype(Request $request) {
        //
       $tax_types = TaxType::orderBy('id','ASC')->paginate(25);
       return view(Config::get('back_theme') . '.account_setting.tax_type', compact('tax_types'));
    }

    /*public function setting_relation(Request $request) {
        //
       $accounts = Account::orderBy('lineage', 'ASC')->paginate(25,['*'],'totax');
       $data = AccountTax::orderBy('id', 'DESC')->paginate($this->rowPerPage);
       $taxs = Tax::orderBy('id','ASC')->get();
       $accounts2 = Account::orderBy('lineage', 'ASC')->paginate(25,['*'],'tocompany');
       $accounts3 = Account::orderBy('lineage', 'ASC')->paginate(25,['*'],'toscreen');
       $data3 = AccountScreen::orderBy('id', 'DESC')->paginate($this->rowPerPage);
       $company = CompanyType::orderBy('id','ASC')->get();
       $screens = Screen::orderBy('id','ASC')->get();

       return view(Config::get('back_theme') . '.account_setting.relation', compact('accounts','data','accounts2','data3','accounts3','company','screens','taxs'));
    }*/

    public function setting_relation(Request $request) {
        //
      
       $accounts = Account::orderBy('lineage', 'ASC')->get();
       $data = AccountTax::orderBy('id', 'DESC')->paginate($this->rowPerPage);
       $taxs = Tax::orderBy('id','ASC')->get();

       return view(Config::get('back_theme') . '.account_setting.relation', compact('accounts','data','taxs'));
    }
     public function setting_relation2(Request $request) {
        //
       $accounts2 = Account::orderBy('lineage', 'ASC')->get();
       $company = CompanyType::orderBy('id','ASC')->get();

       return view(Config::get('back_theme') . '.account_setting.companyType', compact('accounts2','company'));
    }
     public function setting_relation3(Request $request) {
        //
       $accounts3 = Account::orderBy('lineage', 'ASC')->get();
       $data3 = AccountScreen::orderBy('id', 'DESC')->paginate($this->rowPerPage);
       $screens = Screen::orderBy('id','ASC')->get();
       return view(Config::get('back_theme') . '.account_setting.accountScreen', compact('accounts3','data3','screens'));
    }



    public function addAccount(Request $request) {
        // 'name', 'tax', 'text', 'description', 'account_type', 'created_by', 'is_visible'
        $this->validate($request, [
            'account_code' => 'required|digits_between:1,10|unique:accounts',
            'name' => 'required',
            'text' => 'required',
            'description' => 'required',
            'account_type_id' => 'required',
        ]);
        $data = new Account();
        $data->parent_id = $request->parent_id;
        $data->account_code = $request->account_code;
        $data->is_major = $request->is_major;
        $data->is_common = $request->is_common;
        $data->name = $request->name;
        $data->text = $request->text;
        $data->description = $request->description;
        $data->category_id = $request->category_id;
        $data->account_category_id = $request->account_category_id;
        $data->account_type_id = $request->account_type_id;
        $data->created_by = $request->created_by;
        $data->depth =$data->setDepthVal( $request->parent_id);
        $data->save();

        $insertedId = $data->id;
        if(!empty($insertedId))
        $lineage['lineage']= $data->createLineage($insertedId,$request->parent_id);
        $data->doUpdate($insertedId,$lineage);

        return response ()->json ( $data );

    }

    public function editAccount(Request $request) {
        //


        $this->validate($request, [
            //'account_code' => 'required|digits_between:1,10|unique:accounts,account_code,' . $request->account_code,
            'name' => 'required',
            'text' => 'required',
            'description' => 'required',
            //'account_type_id' => 'required',
        ]);
        $data = $request->all();
        $account = new Account();
        if( $data['parent_id']==0 ||  $data['parent_id'] == null)
            $data['depth']=1;
        else
            $data['depth'] =$account->setDepthVal( $data['parent_id']); //get depth for the new inserted record

        $model = Account::find ($request->id);
        $model->update($data);

         if(!empty($request->id))
          $lineage['lineage']= $account->createLineage($request->id,$data['parent_id']);
       // die;
        $account->doUpdate($request->id,$lineage);;    // update lineage

        return response()->json($data);
    }

    public function searchAccount(Request $request){

             if($request->ajax()){

                $output = '';
                $accounts = DB::table("accounts")->where('account_code','LIKE','%'.$request->search.'%')
                                                 ->orWhere('name','LIKE','%'.$request->search.'%')
                                                 ->get();
                }
                if($accounts){
                    $parent_name            = '';
                    $account_type_name      = '';
                    $category_name          = '';
                    $account_category_name  = '';
                   foreach ($accounts as $key => $value) {

                        if($value->is_major == 1){

                            $parent_name='';

                        }else{

                            $parent_id = $value->parent_id;
                            $parent = Account::where('id','=',$parent_id)->get();

                            foreach ($parent as $key => $value2) {
                                $parent_name = $value2->name;
                            }

                        }

                        $account_type_id = $value->account_type_id;
                        $account_type = AccountType::where('id','=',$account_type_id)->get();
                            foreach ($account_type as $key => $value3) {
                                $account_type_name = $value3->name;
                            }

                        $category_id = $value->category_id;
                        $category = Category::where('id','=',$category_id)->get();
                            foreach ($category as $key => $value4) {
                                $category_name = $value4->name_ar;
                            }

                        $account_category_id = $value->account_category_id;
                        $account_category    = AccountCategory::where('id','=',$account_category_id)->get();
                            foreach ($account_category as $key => $value4) {
                                $account_category_name = $value4->name_ar;
                            }

                        $output .= "<tr clsas='tab-row-acc".$value->id."'>".
                                        "<td class='account_code'>".$value->account_code."</td>".
                                        "<td class='name'>".$value->name."</td>".
                                        "<td class='text'>".$value->text."</td>".
                                        "<td class='parent'>".$parent_name."</td>".
                                        "<td class='account_type'>".$account_type_name."</td>".
                                        "<td class='category'>".$category_name."</td>".
                                        "<td class='account_category'>".$account_category_name."</td>".
                        "<input type='hidden' name='parent_id' id='parent_id' value='".$value->parent_id."'>".
                        "<input type='hidden' name='is_major' id='is_major' value='".$value->is_major."'>".
                        "<input type='hidden' name='is_common' id='is_common'  value='".$value->is_common."'>".
                        "<input type='hidden' name='description' id='description' value='".$value->description."'>".
                        "<input type='hidden' name='ct' id='ct' value='".$value->company_type_id."'>".
                        "<input type='hidden' name='cc' id='cc' value='".$value->category_id."'>".
                        "<input type='hidden' name='account_category_id' id='account_category_id' value='".$value->account_category_id."'>".
                        "<input type='hidden' name='account_type_id' id='account_type_id' value='".$value->account_type_id."'>".
                        "<td>".
                         "<button type='button' class='btn btn-primary btn-xs edit-account'  value='".$value->id."'>"."<i class='fa fa-edit'>"."</i>". trans('button.edit') ."</button>".

                         "<button type='button' name='delete' class='btn btn-danger btn-xs  delete-account' value='".$value->id."' alt='". trans('button.delete')."'>"."<i class='fa fa-trash'></i> ". trans('button.delete') ."</button>".

                        "</td>".
                                   "</tr>";


                   }
                return Response($output);
                }else{
                    $msg = 'No result are found';
                    return Response("<div class='row' style='margin:0;padding:0;'>".$msg."</div>");
                }
    }

    public function addCompany(Request $request){

        $data = new CompanyType ();
        $data->name_ar = $request->name;
        $data->description_ar = $request->description;
        $data->save ();
        return response ()->json ( $data );
    }

    public function removeAccount(Request $req) {
        //

        Account::find($req->id )->delete();
        return response ()->json ();
    }

}
