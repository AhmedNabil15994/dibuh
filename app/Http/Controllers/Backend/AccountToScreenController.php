<?php

namespace App\Http\Controllers\Backend;

 
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\BackendBaseController;


use App\Models\AccountScreen;
use App\Models\Account;
use App\Models\Screen;

use Session;
use Config;
use Carbon;
 

class AccountToScreenController extends BackendBaseController
{
    //
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $accounts = Account::orderBy('lineage', 'ASC')->paginate(25);

        return view(Config::get('back_theme') . '.account_to_screen.index', compact('accounts'));        
        $data = AccountScreen::orderBy('id', 'DESC')->paginate($this->rowPerPage);
        return view(Config::get('back_theme') . '.account_to_screen.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * $this->rowPerPage);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->data['accounts'] = Account::get()->pluck('full_desc', 'id')->all();       
        $this->data['screens'] = Screen::get()->pluck('full_desc', 'id')->all();           
          
     //   return view(Config::get('back_theme') . '.screen.create', $this->data);
        return $this->view('account_to_screen.create', $this->data);    
        
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
            'screen_id' => 'required',
      
        ]);
        $input = $request->all();
        AccountScreen::create($input);

        return redirect()->route('admin::account_to_screen.index')
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
        $selected_screens = AccountScreen::where('account_id', $id)->get()->pluck('screen_id')->all();
 
        $accounts = Account::get()->pluck('full_desc', 'id')->all();
        $screens =  Screen::get()->pluck('name', 'id')->all();  


        $this->data = compact('model', 'accounts', 'screens', 'selected_screens');
        return view(Config::get('back_theme') . '.account_to_screen.edit', $this->data);
        
 
               
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
        $delete = AccountScreen::where('account_id', '=', $account_id)->delete();
     
        $input = $request->all();
    //    $account_id = $input['account_id'];

        if (isset($delete)) {
            // dd(\Input::get('screenes') );
            foreach (\Input::get('screen') as $selected_id=>$val) {
                $new_post = array(
                    'account_id' => $account_id,
                    'screen_id' => $selected_id
                );
                // $selected_id.'<br />';
                $AccountScreen = new AccountScreen($new_post);
                $AccountScreen->save();
            }
        //    die;
        }
        Session::flash('flash_message', 'Account assigned to screen and  updated successfully!');

        return redirect(route('admin::account_to_screen.index'));
        //
        $this->validate($request, [
            'account_id' => 'required',
            'screen_id' => 'required',
      
        ]);

        $input = $request->all();

        $model = AccountScreen::find($id);
        $model->update($input);

        return redirect()->route('admin::account_to_screen.index')
                        ->with('success', 'Account assigned to screen and  updated successfully');
    }
    
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        AccountScreen::find($id)->delete();
        return redirect()->route('admin::account_to_screen.index')
                        ->with('success', 'Account screen deleted successfully');
    }

    
    public function editAccScreen(Request $request) {
        
        $account_id=$request->id;

        $delete = AccountScreen::where('account_id', '=', $account_id)->delete();
     
        $screen_id = $request->screen_id; 

        if (count($screen_id) > 0) {
            if (isset($delete)) {
                foreach ($screen_id as $selected_id) {
                    $new_post = array(
                        'account_id' => $account_id,
                        'screen_id' => $selected_id
                    );
                    $AccountScreen = new AccountScreen($new_post);
                    $AccountScreen->save();
                }
            }
        }

        return response()->json();   
    }
}
