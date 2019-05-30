<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use Auth;
use View;
use App\Models\Helping;
use App\Models\HelpingReplay;
use Illuminate\Support\Facades\Response;
use Carbon;
use Config;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Http\Controllers\Backend\BackendBaseController;

use Illuminate\Contracts\Encryption\DecryptException;


class HelpController extends BackendBaseController {

  protected $userType = 'user';

   public function __construct() {
     $this->middleware('permission:user-list',   ['only' => ['show', 'index']]);
     $this->middleware('permission:user-create', ['only' => ['create']]);
     $this->middleware('permission:user-edit',   ['only' => ['edit']]);
     $this->middleware('permission:user-delete',   ['only' => ['destroy']]);

   }



    public function show()
    {
         $this->data['helps']=Helping::orderBy('created_at','desc')->paginate(10);
        //  return $this->view($this->userType.'.help.show',$this->data);
            return view(Config::get('back_theme').'.helps.show', $this->data);
    }
    public function previous_replays($id)
    {

    //   $replays=HelpingReplay::where('helping_id',$id)->get();

       $replays=DB::table('helpings_replays')
                          ->join('users','helpings_replays.user_id','=','users.id')
                          ->select('helpings_replays.*','users.name')
                          ->where('helping_id',$id)
                          ->get();
       $count=$replays->count();
      // dd($replays);
       return response::json(['replays'=>$replays,'count'=>$count]);


    }
    public function delete_replay($id)
    {

      HelpingReplay::find($id)->delete();
            return response::json(['deleted']);
    }
    public function update(Request $request)
    {

      $help=Helping::find($request->help_id);
      //dd($request->appear);
      if($request->appear=="1")
         $help->appear_status=1;
     else
         $help->appear_status=0;

     if($request->replay!="")
     {
       $replay=new HelpingReplay();
       $replay->replay=$request->replay;
       $replay->helping_id=$request->help_id;
       $replay->user_id=Auth::user()->id;            //adminid
       $replay->save();
          $help->replay_status=1;
          $help->save();
          return back()->with('success','تم الرد');
     }else {
           $help->save();
        return back()->with('success','تم التغيير');
     }




    }
    public function destroy($id)
    {
      $help=Helping::find($id);
      $replays=HelpingReplay::where('helping_id',$help->id)->get();
       foreach($replays as $replay)
              $replay->delete();
       $help->delete();

         return back()->with('success','تم الحذف بنجاح ');
    }

    public function store_faq(Request $request)
    {
      $this->validate($request,[
      'title'=>'required|max:100',
      'message'=>'required|max:500',
      'replay'=>'required|max:500'
      ]);

      $user_id=Auth::user()->id;
      $help=new Helping();
      $help->title=$request->title;
      $help->subject=$request->message;
      $help->user_id=$user_id;
      $help->appear_status=1;
      $help->replay_status=1;
      $help->faq_status=1;
      $help->save();

      $replay=new HelpingReplay();
      $replay->helping_id=$help->id;
      $replay->replay=$request->replay;
      $replay->user_id=$user_id;
      $replay->save();
      return back()->with('success','تم الاضافه بنجاح');





    }





}
