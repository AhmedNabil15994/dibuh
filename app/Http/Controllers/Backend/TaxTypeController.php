<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\BackendBaseController;
use Auth;
use App\Models\User;
use App\Models\TaxType;
use Config;
use Carbon;
use Illuminate\Contracts\Encryption\DecryptException;

class TaxTypeController extends BackendBaseController
{
    //
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $data = TaxType::orderBy('id', 'DESC')->paginate($this->rowPerPage);
     //   return view(Config::get('back_theme') . '.tax_type.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * $this->rowPerPage);
        return view(Config::get('back_theme') . '.tax_type.index', compact('data'))
                        ->with('i', ($request->input('page', 1) - 1) * $this->rowPerPage);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->data['tax_type'] = TaxType::get()->pluck('name', 'id')->all();     
     //   return view(Config::get('back_theme') . '.tax_type.create', $this->data);
        return $this->view('tax_type.create', compact('data'));           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',

        ]);
        $input = $request->all();


        TaxType::create($input);

        return redirect()->route('admin::account_setting.index')
                        ->with('success', 'TaxType created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $this->data['data'] = TaxType::find($id);

        return $this->view('tax_type.edit', $this->data);
               
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id) {
        TaxType::find($id)->delete();
        return redirect()->route('admin::account_setting.index')
                        ->with('success', 'Tax Type deleted successfully');
    }

    public function addTaxType(Request $request) {
        //
        $this->validate($request, [
            'name' => 'required',

        ]);
        
        $tax_type = new TaxType();
        $tax_type->name = $request->name;  
        $tax_type->purchases_sign = '+';
        $tax_type->sales_sign = '-';
        $tax_type->save();
        return response()->json($tax_type);                      
    }

    public function editTaxType(Request $request) {
        //
        $this->validate($request, [
            'name' => 'required',

        ]);
        
        $tax_type = TaxType::find ($request->id);
        $tax_type->name = $request->name;  
        $tax_type->save();
        return response()->json($tax_type);                      
    }
    
    public function removeTaxType(Request $req) {
        TaxType::find($req->id)->delete();
        return response()->json();
    }
}
