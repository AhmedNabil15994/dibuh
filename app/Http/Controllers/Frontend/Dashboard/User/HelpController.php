<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Illuminate\Http\Request;
use Auth;
use View;
use App\Models\Helping;
use App\Models\HelpingReplay;
use Illuminate\Support\Facades\Response;
use Carbon;
use Illuminate\Support\Facades\Validator;
use DB;

class HelpController extends DashboardBaseController {
    protected $userType = 'user';

     public function __construct() {
        parent::__construct();
        View::share ( 'userType', $this->userType );

     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=Auth::user()->id;
        $this->data['helpings']=Helping::where('appear_status','1')->where('user_id',$user_id)->orwhere('faq_status','1')->paginate(4);
        $this->data['page_title']=$this->userType.' Helping';
        return $this->view($this->userType.'.help.index',$this->data);
    }
    public function get_faq()
    {
  //    dd("faq");
      $user_id=Auth::user()->id;
      $this->data['helpings']=Helping::where('appear_status','1')->where('faq_status','1')->paginate(4);
      $this->data['page_title']=$this->userType.' Helping';
      return $this->view($this->userType.'.help.index',$this->data);

    }
    public function get_myquestion_only()
    {
    //  dd("only");
      $user_id=Auth::user()->id;
      $this->data['helpings']=Helping::where('appear_status','1')->where('user_id',$user_id)->paginate(4);
      $this->data['page_title']=$this->userType.' Helping';
      return $this->view($this->userType.'.help.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
      'title'=>'required|max:100',
      'subject'=>'required|max:500'
      ]);
      // $validator = Validator::make($request, [
      // 'title'=>'required|max:100',
      // 'subject'=>'required|max:500'
      // ]);
      // if ($validator->fails()){
      //     return Response::json([
      //         'errors' => $validator->getMessageBag()->toArray()
      //     ]);
      // }
      DB::beginTransaction();
      try {
        $help=new Helping();
        $help->title=$request->title;
        $help->subject=$request->subject;
        $help->user_id=Auth::user()->id;
        $help->save();
        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        // $arr[]=$e->getMessage();
        // return Response::json(array('fail' => true,'errors' => $arr));
    }

      return back()->with('success','تم إرسال شكوتك وسنرسل لك رساله  على بريدك الالكترونى بالرد فى أقرب وقت  ');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
         $this->data['helps']=Helping::orderBy('created_at','desc')->paginate(10);
          return $this->view($this->userType.'.help.show',$this->data);
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
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        return back()->with('success','تم التغيير');
     }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
      $help=Helping::find($id);
      $replays=HelpingReplay::where('helping_id',$help->id)->get();
       foreach($replays as $replay)
              $replay->delete();
       $help->delete();

         return back()->with('success','تم الحذف بنجاح ');
    }
}
