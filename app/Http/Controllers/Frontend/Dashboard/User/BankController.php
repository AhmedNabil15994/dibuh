<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
use App\Models\Cost;
use App\Models\InvoiceStatus;
use App\Models\Contact;
use App\Models\Account;
use App\Models\UserFile;
use Config;
use Carbon;
use View;
use Illuminate\Contracts\Encryption\DecryptException;

class BankController extends DashboardBaseController {
    protected $userType = 'user';
    protected $module = 'bank';    
    
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
        $this->data['page_title'] = trans('frontend/cost.title') ;
        
        return $this->view($this->userType . '.'.$this->module.'.'.'main', $this->data);
     
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //
        $this->data['page_title'] =   trans('frontend/cost.title') ;
        $this->data['user_type'] = Auth::user()->roles;
        $this->data['data'] = Cost::orderBy('id', 'DESC')->paginate(10);
        return $this->view($this->userType . '.'.$this->module.'.'.'index', $this->data)
                        ->with('i', ($request->input('page', 1) - 1) * 10);
 
    }
    
    //ajax request
    public function getContactData(Request $request){
        $contactId=$request->contactID;
        $responce= Contact::where('id', $contactId)->get();

        return $responce;
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $this->data['page_title'] =   trans('frontend/cost.create_new') ;
        $this->data['contacts'] = Contact::where('contact_type_id',2)->get()->pluck('full_name','id')->all(); //\ 2 Supplier              
        $this->data['invoice_status'] = InvoiceStatus::all()->pluck('name', 'id')->all(); //          
        $this->data['accounts'] = Account::all()->pluck('name', 'id')->all();        

        $this->data['user_id'] = Auth::user()->id;        



        return $this->view($this->userType . '.'.$this->module.'.'.'create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
 
        $this->validate($request, [
            'receipt_number' => 'required',
            'price' => 'required',
            'description' => 'required',
            'contact_id' => 'required',
            'contact_name' => 'required',            

        ]);
        $input = $request->all();

        //get current user id for created by user:
        $input['user_id'] = Auth::user()->id; //this is only for frontend method
        //user_file_id
        $userFileInputs['file']=$input['user_file_id'];
        $userFileInputs['user_id']=$input['user_id'];
        $userFileInputs['file_name']='test';        
        $userFile=UserFile::create($userFileInputs);
        
        if($userFile){
            $input['user_file_id']=$userFile->id;
            Cost::create($input);
        }
       // dd(  $input['created_by']);
        

        return redirect()->route('cost.index')
                        ->with('success', 'Cost created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $this->data['page_title'] =   trans('frontend/cost.edit') ;
        $this->data['data'] = Cost::find($id);
        
        $this->data['contacts'] = Contact::where('contact_type_id',2)->get()->pluck('full_name','id')->all(); //\ 2 Supplier
        $this->data['invoice_status'] = InvoiceStatus::all()->pluck('name', 'id')->all(); //             
        $this->data['accounts'] = Account::all()->pluck('name', 'id')->all();        
        //$this->data['status'] = Unit::all()->pluck('name', 'id')->all();
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
            'receipt_number' => 'required',
            'price' => 'required',
            'description' => 'required',
            'contact_id' => 'required',
            'contact_name' => 'required',            

        ]);

        $input = $request->all();


        $model = Cost::find($id);
        $model->update($input);


        return redirect()->route('cost.index')
                        ->with('success', 'Cost updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //

        Cost::find($id)->delete();
        return redirect()->route('cost.index')
                        ->with('success', 'Cost deleted successfully');
    }


}
