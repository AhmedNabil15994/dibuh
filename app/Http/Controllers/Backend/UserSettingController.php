<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\BackendBaseController;
use Auth;
use App\Models\UserSetting;
use App\Models\UserSettingType;
use App\Models\UserProfile;
use Config;
use Carbon;
 use Session;

class UserSettingController extends BackendBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user_settings = UserSetting::paginate(25);

        return view(Config::get('back_theme').'.user_settings.index', compact('user_settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //UserProfile::pluck('FullName', 'user_id');
     $users = UserProfile::orderBy('user_id')->get()->pluck('IdFullName', 'user_id')->all();
     $UserSettingType = UserSettingType::orderBy('id')->get()->pluck('name', 'id')->all();     
        return view(Config::get('back_theme').'.user_settings.create',  compact('users','UserSettingType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'key' => 'required',
			'value' => 'required'
		]);
        $requestData = $request->all();
        
        UserSetting::create($requestData);

        Session::flash('flash_message', 'UserSetting added!');

        return redirect(route('admin::user_settings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user_setting = UserSetting::findOrFail($id);

        return view(Config::get('back_theme').'.user_settings.show', compact('user_setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user_setting = UserSetting::findOrFail($id);
     $users = UserProfile::orderBy('user_id')->get()->pluck('IdFullName', 'user_id')->all();
     $UserSettingType = UserSettingType::orderBy('id')->get()->pluck('name', 'id')->all();    
        return view(Config::get('back_theme').'.user_settings.edit', compact('user_setting','users','UserSettingType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
			'key' => 'required',
			'value' => 'required'
		]);
        $requestData = $request->all();
        
        $user_setting = UserSetting::findOrFail($id);
        $user_setting->update($requestData);

        Session::flash('flash_message', 'UserSetting updated!');

        return redirect(route('admin::user_settings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        UserSetting::destroy($id);

        Session::flash('flash_message', 'UserSetting deleted!');

        return redirect(route('admin::user_settings.index'));
    }

/*******************************************************************************************************/

    public function addSetting(Request $request)
    {
        $this->validate($request, [
            'key' => 'required',
            'value' => 'required'
        ]);
        $requestData = $request->all();
        
        UserSetting::create($requestData);

        return response ()->json ();
    }   

    public function removeSetting(Request $request)
    {
        UserSetting::destroy($request->id);

        return response ()->json ();
    }

    public function editSetting(Request $request)
    {
        $this->validate($request, [
            'key' => 'required',
            'value' => 'required'
        ]);
        $requestData = $request->all();
        
        $user_setting = UserSetting::findOrFail($request->id);
        $user_setting->update($requestData);

        return response ()->json ();
    }

}
