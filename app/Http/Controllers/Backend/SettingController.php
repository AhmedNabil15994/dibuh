<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\BackendBaseController;
use App\Models\Setting;
use DB;
use Config;

class SettingController extends BackendBaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Setting::orderBy('id','DESC')->paginate(10);
        return $this->view('.settings.index',compact('data'))   
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tbl = Setting::find($id);
         return $this->view('.settings.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Setting::find($id);


         return $this->view('.settings.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            
            'value' => 'required'

        ]);

        $input = $request->all();
 

        $data = Setting::find($id);
        $data->update($input);


        
 

        return redirect()->route('admin::settings.index')
                        ->with('success','Settings updated successfully');
    }

 
}