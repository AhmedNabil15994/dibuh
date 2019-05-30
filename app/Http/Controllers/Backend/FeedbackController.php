<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use Auth;
use View;
use App\Models\Feedback;
use App\Models\Helping;
use App\Models\HelpingReplay;
use Illuminate\Support\Facades\Response;
use Carbon;
use Config;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Http\Controllers\Backend\BackendBaseController;

use Illuminate\Contracts\Encryption\DecryptException;


class FeedbackController extends BackendBaseController {

  protected $userType = 'user';

   public function __construct() {
     $this->middleware('permission:user-list',   ['only' => ['show', 'index']]);
     $this->middleware('permission:user-create', ['only' => ['create']]);
     $this->middleware('permission:user-edit',   ['only' => ['edit']]);
     $this->middleware('permission:user-delete',   ['only' => ['destroy']]);

   }



    public function index()
    {
      //ask if the user is user name control all feddback else control his feeback only

        if(Auth::user()->is_admin)
            $this->data['feedbacks']=Feedback::orderBy('created_at','desc')->paginate(10);
        else
           $this->data['feedbacks']=Feedback::where('user_id',Auth::user()->id)->first();

            return view(Config::get('back_theme').'.feedbacks.index', $this->data);
    }

    public function appear_front(Request $request,$type)
    {
  //    dd($type);
      $feedbacks=Feedback::all();
  //    dd($request->input('appear'));
      if($type=="admin")
      {

        foreach($feedbacks as $feed)
            {
               $feed->appear_status=0;
               $feed->save();
            }
        if($request->input('appear')!=null){
            foreach($request->input('appear') as $id)
            {
              $feedback=Feedback::find($id);
              $feedback->appear_status=1;
              $feedback->update();
            }}
      }else {
        $id=$request->id;
        $feedback=Feedback::find($id);
        if($request->appear==$id)
            $feedback->appear_status=1;
            else
            $feedback->appear_status=0;
        $feedback->update();
      }


    return back()->with('success','Updated Succeefully');

    }


    public function update(Request $request)
    {

  //  dd($request->all());
       $id=$request->feedback_id;
       $feedback=Feedback::find($id);
       $feedback->feedback=$request->feedback;
       $feedback->update();
       return back()->with('success','Updated Succeefully');

    }

    public function destroy($id)
    {
      //dd("delete");
       $feedback=Feedback::find($id);
       $feedback->delete();


         return back()->with('success','Deleted succefully ');
    }






}
