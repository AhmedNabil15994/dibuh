<?php

namespace App\Http\Controllers\Backend;

 
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\BackendBaseController;

use App\Models\Tax;
use App\Models\AccountTax;
use App\Models\Account;
use App\Models\TaxType;

use Session;
use Config;
use Carbon;
 

class AccountToTaxController extends BackendBaseController
{
    //
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $accounts = Account::orderBy('lineage', 'ASC')->paginate(25);

        return view(Config::get('back_theme') . '.account_to_tax.index', compact('accounts'));        
        $data = AccountTax::orderBy('id', 'DESC')->paginate($this->rowPerPage);
        return view(Config::get('back_theme') . '.account_to_tax.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * $this->rowPerPage);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->data['accounts'] = Account::get()->pluck('full_desc', 'id')->all();       
        $this->data['taxes'] = Tax::get()->pluck('full_desc', 'id')->all();           
        $this->data['tax_types'] = TaxType::get()->pluck('name', 'id')->all();           
     //   return view(Config::get('back_theme') . '.tax.create', $this->data);
        return $this->view('account_to_tax.create', $this->data);    
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'account_id' => 'required',
            'tax_id' => 'required',
      
        ]);
        $input = $request->all();
        AccountTax::create($input);

        return redirect()->route('admin::account_to_tax.index')
                        ->with('success', 'Account Assigned successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $model = Account::findOrFail($id);
        $selected_taxes = AccountTax::where('account_id', $id)->get()->pluck('tax_id')->all();
        $tax_types = TaxType::get()->pluck('name', 'id')->all();   
        $accounts = Account::get()->pluck('full_desc', 'id')->all();
        $taxes =Tax::get()->pluck('full_desc', 'id')->all();  


        $this->data = compact('model', 'accounts', 'taxes','tax_types', 'selected_taxes');
        return view(Config::get('back_theme') . '.account_to_tax.edit', $this->data);
        
//        $this->data['accounts'] = Account::get()->pluck('full_desc', 'id')->all();       
//        $this->data['taxes'] = Tax::get()->pluck('name', 'id')->all();           
//        $this->data['tax_types'] = TaxType::get()->pluck('name', 'id')->all();   
//        $this->data['data'] = AccountTax::find($id);
//
//        return $this->view('account_to_tax.edit', $this->data);
               
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
     $account_id=$id;
       // $account_to_companytype = AccountCompanytype::findOrFail($id);
        $delete = AccountTax::where('account_id', '=', $account_id)->delete();
     
        $input = $request->all();
    //    $account_id = $input['account_id'];

        if (isset($delete)) {
            // dd(\Input::get('taxes') );
            foreach (\Input::get('taxes') as $selected_id=>$val) {
                $new_post = array(
                    'account_id' => $account_id,
                    'tax_id' => $selected_id
                );
                // $selected_id.'<br />';
                $AccountTax = new AccountTax($new_post);
                $AccountTax->save();
            }
        //    die;
        }
        Session::flash('flash_message', 'Account assigned to tax and  updated successfully!');

        return redirect(route('admin::account_to_tax.index'));
        //
        $this->validate($request, [
            'account_id' => 'required',
            'tax_id' => 'required',
      
        ]);

        $input = $request->all();

        $model = AccountTax::find($id);
        $model->update($input);

        return redirect()->route('admin::account_to_tax.index')
                        ->with('success', 'Account assigned to tax and  updated successfully');
    }
    
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        AccountTax::find($id)->delete();
        return redirect()->route('admin::account_to_tax.index')
                        ->with('success', 'Account tax deleted successfully');
    }

    public function editAccTax(Request $request) {
        
        $account_id=$request->id;

        $delete = AccountTax::where('account_id', '=', $account_id)->delete();
     
        $taxes_id = $request->taxes_id; 

         if(count($taxes_id)>0){
            if (isset($delete)) {
                foreach ($taxes_id as $selected_id) {
                    $new_post = array(
                        'account_id' => $account_id,
                        'tax_id' => $selected_id
                    );
                    $AccountTax = new AccountTax($new_post);
                    $AccountTax->save();
                }
            }
         }
        return response()->json();   
    }
 
}
