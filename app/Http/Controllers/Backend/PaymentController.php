<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use App\Models\UserProfile as Profile;
use App\Models\UserBankAccount as BankAccount;
use App\Models\Payment;
use Config;
use Carbon;
use Illuminate\Contracts\Encryption\DecryptException;

class PaymentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $data = Payment::orderBy('id', 'DESC')->paginate(10);
        return view(Config::get('back_theme') . '.payment.index', compact('data'))
                        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->data['users'] = \DB::table('user_profiles')->pluck('first_name', 'user_id');
        $this->data['users'] = $this->selectUserID();

        return view(Config::get('back_theme') . '.payment.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'amount' => 'required',
            'user_id' => 'required',
        ]);

        $input = $request->all();
        //get current user id for created by user:

        $input['created_by'] = Auth::user()->id;
 
        Payment::create($input);

        // expire date update
        $expireDate = Carbon::today()->addDays($input['paid_days'])->toDateString(); // add paid_days from Register Date for expire Date in user profile
        $current_date = date("Y-m-d");

        $expireDateFromTable = Profile::where(['user_id' => $input['user_id']])->first()->expire_date; //1 day later
        $expireDateCarbonObj = new Carbon($expireDateFromTable);
        if (strtotime($expireDateFromTable) <= strtotime($current_date)) {
            $expireDate = Carbon::today()->addDays($input['paid_days'])->toDateString(); // add paid_days To Today and update expire Date in user profile
        } else {
            $expireDate =$expireDateCarbonObj->addDays($input['paid_days'])->toDateString();// add paid_days To expire Date from table  and update new expire Date in user profile
        }
        
//        $profile = new Profile(array(
//            'user_status_id' => 1,
//            'expire_date' => $expireDate,
//        ));
        $profile = array(
            'user_status_id' => 1,
            'expire_date' => $expireDate,
        );

        $data = Profile::where(['user_id' => $input['user_id']]);
        $data->update($profile);
        ///////////////////////////////////////////

        return redirect()->route('admin::payments.index')
                        ->with('success', 'Payment created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $item = Payment::find($id);
        return view(Config::get('back_theme') . '.payment.show', compact('item'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Payment::find($id)->delete();
        return redirect()->route('admin::payment.index')
                        ->with('success', 'Payment deleted successfully');
    }

    
    //=========================================================
    //Helper methods
    //=========================================================
    public function selectUserID() {

        $select = Profile::get(['user_id', 'first_name', 'last_name'])->flatten()->all();
        foreach ($select as $v) {
            $profiles[$v->user_id] = $v->first_name . ' ' . $v->last_name;
        }
        return $profiles;
    }

    //=========================================================
    //searchable methods
    //=========================================================

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function overview(Request $request) {
        $this->data = [];
        if ($request->has('search')) {
            $this->data['data'] = Payment::search($request->input('search'))->paginate(20); //->toArray()
        }

        if ($request->has('searchYear')) {
            $name = $request->input('searchYear');
            $this->data['data'] = Payment::where(function ($q) use ($name) {
                        $q->whereYear('receipt_date', '=', $name);
                    })->paginate(5);
            //    $this->data['data'] = Payment::search($request->input('searchYear'))->paginate(5);//->toArray()
        }

        if ($request->has('searchMonth')) {
            $name = $request->input('searchMonth');
            $this->data['data'] = Payment::where(function ($q) use ($name) {
                        $q->whereMonth('receipt_date', '=', $name);
                    })->paginate(5);
        }

        return view(Config::get('back_theme') . '.payment.overview', $this->data)->with('i');
        ;
    }

    public function plans(Request $request){

        $this->data['plans'] = \DB::table('price_plans')->orderBy('id','DESC')->get();
        return view(Config::get('back_theme') . '.payment.plans', $this->data)->with('i');
    }

    public function addPlan(Request $request){
        \DB::table('price_plans')->insert([
            'period' => $request->period,
            'price'  => $request->price,
            'name' => $request->end_products,
            'period_id' => $request->period_id,
        ]);
        return response ()->json();
    }

    public function editPlan(Request $request){
        $data = $request->all();

        $plan = \DB::table('price_plans')->where('id',$request->id)->update([
            'period' => $request->period,
            'price' => $request->price,
            'name' => $request->end_products,
            'support' => $request->support,
            'updates' => $request->updates,
            'avail_support' => $request->avail_support,
            'discount' => $request->discount,
            'period_id' => $request->period_id,

        ]);
        
        
        return response()->json($plan);   
    }

    public function removePlan(Request $request){
        
        \DB::table('price_plans')->where('id',$request->id)->delete();
        return response ()->json ();
       
    }
}
