<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\BackendBaseController;
use Auth;
use App\Models\User;
use App\Models\Tax;
use App\Models\TaxType;
use Config;
use Carbon;
use Illuminate\Contracts\Encryption\DecryptException;

class TaxController extends BackendBaseController
{
    //
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $data = Tax::orderBy('id', 'DESC')->paginate($this->rowPerPage);
        return view(Config::get('back_theme') . '.tax.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * $this->rowPerPage);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->data['tax_type'] = TaxType::get()->pluck('name', 'id')->all();       
     //   return view(Config::get('back_theme') . '.tax.create', $this->data);
        return $this->view('tax.create', $this->data);    
        
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
            'tax_type_id' => 'required',
            'rate' => 'required',            
        ]);
        $input = $request->all();
        Tax::create($input);

        return redirect()->route('admin::account_setting.tax')
                        ->with('success', 'Tax created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $this->data['tax_type'] = TaxType::get()->pluck('name', 'id')->all();     
        $this->data['data'] = Tax::find($id);

        return $this->view('tax.edit', $this->data);
               
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
            'name' => 'required',
            'tax_type_id' => 'required',
        ]);

        $input = $request->all();

        $model = Tax::find($id);
        $model->update($input);

        return redirect()->route('admin::tax.index')
                        ->with('success', 'Tax updated successfully');
    }
    
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Tax::find($id)->delete();
        return redirect()->route('admin::tax.index')
                        ->with('success', 'Tax deleted successfully');
    }

    public function addTax(Request $request) {
        //
        $this->validate($request, [
            'name' => 'required',
            'rate' => 'required'
        ]);
        
        $tax = new Tax();
        $tax->name = $request->name;  
        $tax->rate = $request->rate; 
        $tax->tax_type_id = $request->tax_type_id; 
        $tax->save();
        return response()->json($tax);                      
    }

    public function editTax(Request $request) {
        //
        $this->validate($request, [
            'name' => 'required',
            'rate' => 'required'
        ]);
        
        $tax = Tax::find ($request->id);
        $tax->name = $request->name;  
        $tax->rate = $request->rate;  
        $tax->save();
        return response()->json($tax);                      
    }

    public function removeTax(Request $req) {
        Tax::find($req->id)->delete();
        return response()->json();
    }
 
}
