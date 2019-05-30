<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use App\Models\currency_table;
use App\Models\Finance_bank;
use App\Models\Finance_credit;
use App\Models\Finance_treasury;
use App\Models\Setting;
//use App\Models\UserSetting;
use Illuminate\Http\Request;
//use Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use App\Models\User;
use App\Models\Account;
use App\Models\UserProfile As Profile;
use App\Models\Contact;
use App\Models\ContactType;
use App\Models\Title;
use App\Models\Country;
use App\Models\ContactAddress;
use App\Models\Governorate;
use App\Models\ContactsToContactType;

use App\Models\SalesInvoice;
use Config;
use Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use View;
use Illuminate\Contracts\Encryption\DecryptException;

class FinanceController extends DashboardBaseController {

    protected $userType = 'user';
    protected $module = 'finance';
    protected $module2 = 'bank_settings';

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

    public function show(Request $request , $id , $type){
        $this->data['page_title'] = trans('frontend/sales_invoice.title');
        $this->data['type'] = $type;
        $this->data['id'] = $id;

        $this->data['paid']=\DB::table('installement_invoices')->where('finance_id','=',$id)->where('finance_type','=',$type)->get();
        $this->data['amounts'] = \DB::table('amounts')->where('finance_id','=',$id)->where('finance_type','=',$type)->get();
        $months = [1,2,3,4,5,6,7,8,9,10,11,12];
        $year  = date('Y');

        $post = [] ;
        $added = [];
        $received = [];

        $nega = [];
        $sent = [];


        for ($i=0; $i < count($months) ; $i++) {

            $post[] = \DB::table('installement_invoices')->where([['finance_id','=',$id],['finance_type','=',$type]])
              ->whereYear('paid_date', '=', $year)
              ->whereMonth('paid_date','=',$months[$i])
              ->where(function ($query) {
                $query->where('invoice_type','=',0)
                      ->orWhere('invoice_type','=',1)
                      ->orWhere('invoice_type','=',2);
                })->latest()->sum('paid');

            $added[] =   \DB::table('amounts')->where([['finance_id','=',$id],['finance_type','=',$type],['receiver_id','=','0']])
                          ->whereYear('added_date', '=', $year)
                          ->whereMonth('added_date','=',$months[$i])
                          ->sum('amount');

            $received[] =   \DB::table('amounts')->where([['finance_id','=',$id],['finance_type','=',$type],['receiver_id','=',$id]])
                          ->whereYear('added_date', '=', $year)
                          ->whereMonth('added_date','=',$months[$i])
                          ->sum('amount');

            $nega[] = \DB::table('installement_invoices')->where([['finance_id','=',$id],['finance_type','=',$type]])
              ->whereYear('paid_date', '=', $year)
              ->whereMonth('paid_date','=',$months[$i])
              ->where(function ($query) {
                $query->where('invoice_type','=',3)
                      ->orWhere('invoice_type','=',4)
                      ->orWhere('invoice_type','=',5)
                      ->orWhere('invoice_type','=',6);
                })->latest()->sum('paid');

            $sent[] =   \DB::table('amounts')->where([['finance_id','=',$id],['finance_type','=',$type],['receiver_id','!=',0]])
                          ->whereYear('added_date', '=', $year)
                          ->whereMonth('added_date','=',$months[$i])
                          ->sum('amount');

        }
        $this->data['post'] = $post;
        $this->data['added'] = $added;
        $this->data['received'] = $received;
        $this->data['nega'] = $nega;
        $this->data['sent'] = $sent;

        return $this->view($this->userType . '.'.$this->module2.'.'.'index', $this->data)->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function main(Request $request) {
        //
        $this->data['data'] = SalesInvoice::where('status','=',0)->orderBy('id', 'DESC')->paginate(10);
        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadInvoicesWithStatus', $this->data)->render();
        }

        $this->data['page_title'] = trans('frontend/sales_invoice.title');
        $this->data['user_type'] = Auth::user()->roles;

        return $this->view($this->userType . '.'.$this->module.'.'.'main', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $user_id = Auth::user()->id;
        $currency = currency_table::all()->pluck('name', 'id')->all();
        $finance_banks = Finance_bank::where('user_id' , $user_id)
            ->get(['id','account_owner as owner_name','serial_number' , 'bank_balance as balance' , 'currency_id' ,'start_date as start_date']);

        $finance_treasury = Finance_treasury::where('user_id' , $user_id)
            ->get(['id','treasury_name as owner_name','serial_number' , 'start_balance as balance','currency_id' ,'start_date as start_date']);

        $finance_credit = Finance_credit::where('user_id' , $user_id)
            ->get(['id','credit_owner as owner_name','serial_number' , 'credit_balance as balance' ,'credit_start_date as start_date']);

        $arr=[];
        foreach ($finance_banks as $bank){
            $arr[] = [
                'id'           => $bank->id,
                'owner_name'   => $bank->owner_name,
                'serial_number'=> $bank->serial_number,
                'balance'      => $bank->balance,
                'currency'     => $currency[$bank->currency_id],
                'start_date'   => $bank->start_date,
                'type'         => 1
            ];
        }
        foreach ($finance_treasury as $treasury){
            $arr[] = [
                'id'           => $treasury->id,
                'owner_name'   => $treasury->owner_name,
                'serial_number'=> $treasury->serial_number,
                'balance'      => $treasury->balance,
                'currency'     => $currency[$treasury->currency_id],
                'start_date'   => $treasury->start_date,
                'type'         => 2
            ];
        }
        foreach ($finance_credit as $credit){
            $arr[] = [
                'id'           => $credit->id,
                'owner_name'   => $credit->owner_name,
                'serial_number'=> $credit->serial_number,
                'balance'      => $credit->balance,
                'currency'     => null,
                'start_date' => $credit->start_date,
                'type'         => 3
            ];
        }
        $this->data['data'] = $arr;
        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadFinanceWithStatus', $this->data)->with('i', ($request->input('page', 1) - 1) * 10);
        }

        $this->data['page_title'] = trans('frontend/sales_invoice.title');
        $this->data['user_type'] = Auth::user()->roles;
        return $this->view($this->userType . '.' . $this->module . '.' . 'main', $this->data)
                        ->with('i', ($request->input('page', 1) - 1) * 10);
    }



    public function LoadAjaxFilterStatus(Request $request, $status) {
        $user_id = Auth::user()->id;
        $currency = currency_table::all()->pluck('name', 'id')->all();

        if ($status == 0) {
            $finance_banks = Finance_bank::where('user_id' , $user_id)
                ->get(['id','account_owner as owner_name','serial_number' , 'bank_balance as balance','currency_id','start_date']);

            $finance_treasury = Finance_treasury::where('user_id' , $user_id)
                ->get(['id','treasury_name as owner_name','serial_number' , 'start_balance as balance','currency_id','start_date']);

            $finance_credit = Finance_credit::where('user_id' , $user_id)
                ->get(['id','credit_owner as owner_name','serial_number' , 'credit_balance as balance','credit_start_date']);

            $data=[];
            foreach ($finance_banks as $bank){
                $data[] = [
                    'id'           => $bank->id,
                    'owner_name'   => $bank->owner_name,
                    'serial_number'=> $bank->serial_number,
                    'currency'     => $currency[$bank->currency_id],
                    'balance'      => $bank->balance,
                    'start_date'   => $bank->start_date,
                    'type'         => 1
                ];
            }
            foreach ($finance_treasury as $treasury){
                $data[] = [
                    'id'           => $treasury->id,
                    'owner_name'   => $treasury->owner_name,
                    'serial_number'=> $treasury->serial_number,
                    'balance'      => $treasury->balance,
                    'currency'     => $currency[$treasury->currency_id],
                    'start_date'   => $treasury->start_date,
                    'type'         => 2
                ];
            }
            foreach ($finance_credit as $credit){
                $data[] = [
                    'id'           => $credit->id,
                    'owner_name'   => $credit->owner_name,
                    'serial_number'=> $credit->serial_number,
                    'balance'      => $credit->balance,
                    'currency'     => null,
                    'start_date'   => $credit->credit_start_date,
                    'type'         => 3
                ];
            }

        } else if($status == 1 ){
            $data = Finance_bank::
                selectRaw('id,account_owner as owner_name,serial_number,bank_balance as balance,currency_id,start_date')
                ->where('user_id' , $user_id)
                ->orderBy('id' , 'desc')
                ->paginate(10);

        } else if($status == 2 ){
            $data = Finance_treasury::
            selectRaw('id,treasury_name as owner_name,serial_number,start_balance as balance,currency_id,start_date')
                ->where('user_id' , $user_id)
                ->orderBy('id' , 'desc')
                ->paginate(10);
        } else if($status == 3 ){
            $data = Finance_credit::
            selectRaw('id,credit_owner as owner_name,serial_number,credit_balance as balance, credit_start_date as start_date')
                ->where('user_id' , $user_id)
                ->orderBy('id' , 'desc')
                ->paginate(10);
        }


            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadFinanceWithStatus', ['data' => $data , 'status' => $status, 'currency'  => $currency])->with('i', ($request->input('page', 1) - 1) * 10);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $user_id = Auth::user()->id;
        $this->data['page_title'] = trans('frontend/' . $this->module . 'create_new');
        $this->data['governorates'] = Governorate::all()->pluck('name', 'id')->all();
        $this->data['currency'] = currency_table::all()->pluck('name', 'id')->all();

        $bank_row_serial_number = Finance_bank::whereRaw("serial_number = (select max(serial_number) from finance_banks where user_id = $user_id )")->get(['serial_number']);
        $bank_serial_number_start=0;
        if(!count($bank_row_serial_number) > 0){
            $bank_serial_number_start = Setting::where('key' , 'finance_banks_start')->get(['value'])->pluck('value')->all();
        }
        $bank_serial_number = count($bank_row_serial_number) > 0 ? $bank_row_serial_number[0]->serial_number : $bank_serial_number_start[0];
        $this->data['bank_serial_number'] = count($bank_row_serial_number) > 0 ? ++$bank_serial_number : $bank_serial_number;

        $treasury_row_serial_number = Finance_treasury::whereRaw("serial_number = (select max(serial_number) from finance_treasury where user_id = $user_id )")->get(['serial_number']);
        $treasury_serial_number_start = 0;
        if(!count($treasury_row_serial_number) > 0){
            $treasury_serial_number_start = Setting::where('key' , 'finance_treasury_start')->get(['value'])->pluck('value')->all();
        }
        $treasury_serial_number = count($treasury_row_serial_number) > 0 ? $treasury_row_serial_number[0]->serial_number : $treasury_serial_number_start[0];
        $this->data['treasury_serial_number'] = count($treasury_row_serial_number) > 0 ? ++$treasury_serial_number : $treasury_serial_number;

        $credit_row_serial_number = Finance_credit::whereRaw("serial_number = (select max(serial_number) from finance_credit where user_id = $user_id )")->get(['serial_number']);
        $credit_serial_number_start = 0;
        if(!count($credit_row_serial_number) > 0 ){
            $credit_serial_number_start = Setting::where('key' , 'finance_credit_start')->get(['value'])->pluck('value')->all();
        }
        $credit_serial_number = count($credit_row_serial_number) > 0 ? $credit_row_serial_number[0]->serial_number : $credit_serial_number_start[0];
        $this->data['credit_serial_number'] = count($credit_row_serial_number) > 0 ? ++$credit_serial_number : $credit_serial_number;
        $this->data['data']=User::find(Auth::user()->id)->profile;

        return $this->view($this->userType . '.' . $this->module . '.' . 'create', $this->data);
    }


    public function store(Request $request) {

        $error_serial_number = 'Serial Number your entered is already exist';
        $user_id = Auth::user()->id;
        $type = $request->type;


        if($type == "bank"){
            $rules = [
                'serial_number' => 'required|integer',
                'account_owner' => 'required|max:255',
                'bank_balance'  => 'required|integer',
                'bank_name'     => 'required|max:255',
                'bank_currency' => 'required|integer',
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()){
                return Response::json([
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }

            $rowsSerial_number = Finance_bank::where('serial_number', $request->serial_number)->where('user_id', $user_id)->count();
            $err=[];
            isset($rowsSerial_number) && $rowsSerial_number > 0 ? $err[]=$error_serial_number : '';

            if (isset($rowsSerial_number) && $rowsSerial_number > 0 )
            {
                return Response::json(array(
                    'errors' => $err
                ));
            }

            DB::beginTransaction();
            try {
                $finance_bank = Finance_bank::create([
                    'serial_number'      => $request->serial_number,
                    'account_owner'      => $request->account_owner,
                    'bank_balance'       => $request->bank_balance,
                    'open_balance'       => $request->bank_balance,
                    'start_date'         => $request->start_date,
                    'IBAN'               => $request->IBAN,
                    'swift_international'=> $request->swift_international,
                    'account_number'     => $request->account_number,
                    'swift_national'     => $request->swift_national,
                    'bank_name'          => $request->bank_name,
                    'branch_name'        => $request->branch_name,
                    'branch_code'        => $request->branch_code,
                    'branch_address'     => $request->branch_address,
                    'city'               => $request->city,
                    'governorate_id'     => $request->governorate,
                    'currency_id'        => $request->bank_currency,
                    'user_id'            => $user_id
                ]);

                $insertedID = $finance_bank->id;

                \DB::table('account_reports')->insert([
                        'account_code'  => $request->serial_number,
                        'name'          => $request->account_owner,
                        'invoice_number'   => 0,
                        'invoice_type'  => 0,
                        'finance_id'    => $insertedID,
                        'finance_type'  => 1,
                        'deal_type'     => trans('frontend/reports.addbank'),
                        'amount'        => $request->start_balance,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'user_id'       => Auth::user()->id
                    ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return ['errors' => [$e->getMessage()]];
            }
            return $finance_bank->id;
        }else if($type == "treasury"){
            $rules = [
                'serial_number'     => 'required|integer',
                'treasury_name'     => 'required|max:255',
                'start_balance'     => 'required|integer',
                'treasury_currency' => 'required|integer',
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()){
                return Response::json([
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }
            $rowsSerial_number = Finance_treasury::where('serial_number', $request->serial_number)->where('user_id', $user_id)->count();
            $err=[];
            isset($rowsSerial_number) && $rowsSerial_number > 0 ? $err[]=$error_serial_number : '';

            if (isset($rowsSerial_number) && $rowsSerial_number > 0 )
            {
                return Response::json(array(
                    'errors' => $err
                ));
            }

            DB::beginTransaction();
            try {
                $finance_treasury = Finance_treasury::create([
                    'serial_number' => $request->serial_number,
                    'treasury_name' => $request->treasury_name,
                    'start_date'    => $request->treasury_start_date,
                    'start_balance' => $request->start_balance,
                    'currency_id'   => $request->treasury_currency,
                    'user_id'       => $user_id,
                    'open_balance'  => $request->start_balance
                ]);

                $insertedID = $finance_treasury->id;

                \DB::table('account_reports')->insert([
                        'account_code'  => $request->serial_number,
                        'name'          => $request->treasury_name,
                        'invoice_number'   => 0,
                        'invoice_type'  => 0,
                        'finance_id'    => $insertedID,
                        'finance_type'  => 2,
                        'deal_type'     => trans('frontend/reports.addtrea'),
                        'amount'        => $request->start_balance,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'user_id'       => Auth::user()->id
                    ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return ['errors' => [$e->getMessage()]];
            }
            return $finance_treasury->id;
        }else if($type == "credit_card"){
            $rules = [
                'serial_number'    => 'required|integer',
                'credit_owner'     => 'required|max:255',
                'credit_balance'   => 'required|integer',
                'credit_bank_name' => 'required|max:255',
                'credit_number'    => 'required|max:255',
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()){
                return Response::json([
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }

            $rowsSerial_number = Finance_credit::where('serial_number', $request->serial_number)->where('user_id', $user_id)->count();
            $err=[];
            isset($rowsSerial_number) && $rowsSerial_number > 0 ? $err[]=$error_serial_number : '';

            if (isset($rowsSerial_number) && $rowsSerial_number > 0 )
            {
                return Response::json(array(
                    'errors' => $err
                ));
            }

            DB::beginTransaction();
            try {
                $credit_bank = Finance_credit::create([
                    'serial_number'     => $request->serial_number,
                    'credit_owner'=> $request->credit_owner,
                    'credit_balance'=> $request->credit_balance,
                    'open_balance'  => $request->credit_balance,
                    'credit_start_date'=> $request->credit_start_date,
                    'credit_end_date'=> $request->credit_end_date,
                    'credit_bank_name'=> $request->credit_bank_name,
                    'credit_number'=> $request->credit_number,
                    'credit_type'=> $request->credit_type,
                    'user_id'=> $user_id
                ]);

                $insertedID = $credit_bank->id;

                \DB::table('account_reports')->insert([
                        'account_code'  => $request->serial_number,
                        'name'          => $request->credit_owner,
                        'invoice_number'   => 0,
                        'invoice_type'  => 0,
                        'finance_id'    => $insertedID,
                        'finance_type'  => 3,
                        'deal_type'     => trans('frontend/reports.addcred'),
                        'amount'        => $request->start_balance,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'user_id'       => Auth::user()->id
                    ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return ['errors' => [$e->getMessage()]];
            }
            return $credit_bank->id;
        }
    }


    public function edit($id,$type) {
        //

        $this->data['page_title'] = trans('frontend/sales_invoice.create_edit');
        $user_id = Auth::user()->id;
        $currency = currency_table::all()->pluck('name', 'id')->all();
        $this->data['currency']=$currency;
        $this->data['governorates'] = Governorate::all()->pluck('name', 'id')->all();
        $this->data['type']=$type;


        if($type==1)
        {
          $this->data['data']=Finance_bank::where('id',$id)->where('user_id',$user_id)->first();

        }elseif($type==2){
          $this->data['data']=Finance_treasury::where('id',$id)->where('user_id',$user_id)->first();
        }elseif($type==3){
          $this->data['data']=Finance_credit::where('id',$id)->where('user_id',$user_id)->first();

        }




        return $this->view($this->userType . '.' . $this->module . '.' . 'edit', $this->data);
    }


    public function update(Request $request, $id) {


$user_id = Auth::user()->id;
$type = $request->type;

if($type == 1){
    $rules = [
        'serial_number' => 'required|integer',
        'account_owner' => 'required|max:255',
        'bank_balance'  => 'required|integer',
        'bank_name'     => 'required|max:255',
        'bank_currency' => 'required|integer',
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()){
        return Response::json([
            'errors' => $validator->getMessageBag()->toArray()
        ]);
    }


    DB::beginTransaction();
    try {
    //  $finance_bank = Finance_bank::find($id);
        $finance_bank = Finance_bank::where('id',$id)->where('user_id',$user_id)->update([
            'serial_number'      => $request->serial_number,
            'account_owner'      => $request->account_owner,
            'bank_balance'       => $request->bank_balance,
            'open_balance'       => $request->bank_balance,
            'start_date'         => $request->start_date,
            'IBAN'               => $request->IBAN,
            'swift_international'=> $request->swift_international,
            'account_number'     => $request->account_number,
            'swift_national'     => $request->swift_national,
            'bank_name'          => $request->bank_name,
            'branch_name'        => $request->branch_name,
            'branch_code'        => $request->branch_code,
            'branch_address'     => $request->branch_address,
            'city'               => $request->city,
            'governorate_id'     => $request->governorate,
            'currency_id'        => $request->bank_currency,
            'user_id'            => $user_id
        ]);

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return ['errors' => [$e->getMessage()]];
    }
    return $id;
}else if($type == 2){
    $rules = [
        'serial_number'     => 'required|integer',
        'treasury_name'     => 'required|max:255',
        'start_balance'     => 'required|integer',
        'treasury_currency' => 'required|integer',
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()){
        return Response::json([
            'errors' => $validator->getMessageBag()->toArray()
        ]);
    }


    DB::beginTransaction();
    try {
        $finance_treasury = Finance_treasury::where('id',$id)->where('user_id',$user_id)->update([
            'serial_number' => $request->serial_number,
            'treasury_name' => $request->treasury_name,
            'start_date'    => $request->treasury_start_date,
            'start_balance' => $request->start_balance,
            'currency_id'   => $request->treasury_currency,
            'user_id'       => $user_id,
            'open_balance'  => $request->start_balance
        ]);

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return ['errors' => [$e->getMessage()]];
    }
    return $id;
}else if($type == 3){
    $rules = [
        'serial_number'    => 'required|integer',
        'credit_owner'     => 'required|max:255',
        'credit_balance'   => 'required|integer',
        'credit_bank_name' => 'required|max:255',
        'credit_number'    => 'required|max:255',
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()){
        return Response::json([
            'errors' => $validator->getMessageBag()->toArray()
        ]);
    }



    DB::beginTransaction();
    try {
        $credit_bank = Finance_credit::where('id',$id)->where('user_id',$user_id)->update([
            'serial_number'     => $request->serial_number,
            'credit_owner'=> $request->credit_owner,
            'credit_balance'=> $request->credit_balance,
            'open_balance'  => $request->credit_balance,
            'credit_start_date'=> $request->credit_start_date,
            'credit_end_date'=> $request->credit_end_date,
            'credit_bank_name'=> $request->credit_bank_name,
            'credit_number'=> $request->credit_number,
            'credit_type'=> $request->credit_type,
            'user_id'=> $user_id
        ]);

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return ['errors' => [$e->getMessage()]];
    }
    return $id;
}
    }


    public function destroy($id) {
//        dd($id);
        $type = Input::get(['type']);
        if($type == 1){
            Finance_bank::find($id)->delete();
            return redirect()->route('finance.main')
                            ->with('success', 'Finance Bank  deleted successfully');
        }elseif($type == 2){
            Finance_treasury::find($id)->delete();
            return redirect()->route('finance.main')
                ->with('success', 'Finance Treasury  deleted successfully');
        }else{
            Finance_credit::find($id)->delete();
            return redirect()->route('finance.main')
                ->with('success', 'Finance Credit Card  deleted successfully');
        }


    }

    public function filter(Request $request,$type = null,$filterName = null,$financeNumber=null, $pages=10){
        $user_id = Auth::user()->id;
        $currency = currency_table::all()->pluck('name', 'id')->all();

        if($type != 0 && $type != 1 && $type != 2 && $type != 3){
            return Response::json(array(
                'errors' => ['error in type']
            ));
        }


        if ($financeNumber != -1 && $type == 0){
            $finance_banks = Finance_bank::where('user_id' , $user_id)
                ->where('serial_number',$financeNumber)
                ->get(['id','account_owner as owner_name','serial_number' , 'bank_balance as balance','currency_id']);

            $finance_treasury = Finance_treasury::where('user_id' , $user_id)
                ->where('serial_number',$financeNumber)
                ->get(['id','treasury_name as owner_name','serial_number' , 'start_balance as balance','currency_id']);

            $finance_credit = Finance_credit::where('user_id' , $user_id)
                ->where('serial_number',$financeNumber)
                ->get(['id','credit_owner as owner_name','serial_number' , 'credit_balance as balance']);

            $data=[];
            foreach ($finance_banks as $bank){
                $data[] = [
                    'id'           => $bank->id,
                    'owner_name'   => $bank->owner_name,
                    'serial_number'=> $bank->serial_number,
                    'balance'      => $bank->balance,
                    'currency'     => $currency[$bank->currency_id],
                    'type'         => 1
                ];
            }
            foreach ($finance_treasury as $treasury){
                $data[] = [
                    'id'           => $treasury->id,
                    'owner_name'   => $treasury->owner_name,
                    'serial_number'=> $treasury->serial_number,
                    'balance'      => $treasury->balance,
                    'currency'     => $currency[$treasury->currency_id],
                    'type'         => 2
                ];
            }
            foreach ($finance_credit as $credit){
                $data[] = [
                    'id'           => $credit->id,
                    'owner_name'   => $credit->owner_name,
                    'serial_number'=> $credit->serial_number,
                    'balance'      => $credit->balance,
                    'currency'     => null,
                    'type'         => 3
                ];
            }
        }elseif($financeNumber != -1 && $type != 0 ){
            if($type == 1){
                $data = Finance_bank::
                selectRaw('id,account_owner as owner_name,serial_number,bank_balance as balance,currency_id')
                    ->where('user_id' , $user_id)
                    ->where('serial_number',$financeNumber)
                    ->orderBy('id' , 'desc')
                    ->get();
            }elseif($type == 2){
                $data = Finance_treasury::
                selectRaw('id,treasury_name as owner_name,serial_number,start_balance as balance,currency_id')
                    ->where('user_id' , $user_id)
                    ->where('serial_number',$financeNumber)
                    ->orderBy('id' , 'desc')
                    ->get();
            }elseif($type == 3){
                $data = Finance_credit::
                selectRaw('id,credit_owner as owner_name,serial_number,credit_balance as balance')
                    ->where('user_id' , $user_id)
                    ->where('serial_number',$financeNumber)
                    ->orderBy('id' , 'desc')
                    ->get();
            }
        }elseif($filterName != -1 && $type == 0 ){
            $finance_banks = Finance_bank::where('user_id' , $user_id)
                ->where('account_owner','like',"%$filterName%")
                ->get(['id','account_owner as owner_name','serial_number' , 'bank_balance as balance','currency_id']);

            $finance_treasury = Finance_treasury::where('user_id' , $user_id)
                ->where('treasury_name','like',"%$filterName%")
                ->get(['id','treasury_name as owner_name','serial_number' , 'start_balance as balance','currency_id']);

            $finance_credit = Finance_credit::where('user_id' , $user_id)
                ->where('credit_owner','like',"%$filterName%")
                ->get(['id','credit_owner as owner_name','serial_number' , 'credit_balance as balance']);

            $data=[];
            foreach ($finance_banks as $bank){
                $data[] = [
                    'id'           => $bank->id,
                    'owner_name'   => $bank->owner_name,
                    'serial_number'=> $bank->serial_number,
                    'balance'      => $bank->balance,
                    'currency'     => $currency[$bank->currency_id],
                    'type'         => 1
                ];
            }
            foreach ($finance_treasury as $treasury){
                $data[] = [
                    'id'           => $treasury->id,
                    'owner_name'   => $treasury->owner_name,
                    'serial_number'=> $treasury->serial_number,
                    'balance'      => $treasury->balance,
                    'currency'     => $currency[$treasury->currency_id],
                    'type'         => 2
                ];
            }
            foreach ($finance_credit as $credit){
                $data[] = [
                    'id'           => $credit->id,
                    'owner_name'   => $credit->owner_name,
                    'serial_number'=> $credit->serial_number,
                    'balance'      => $credit->balance,
                    'currency'     => null,
                    'type'         => 3
                ];
            }
        }elseif($filterName != -1 && $type != 0 ){
            if($type == 1){
                $data = Finance_bank::
                selectRaw('id,account_owner as owner_name,serial_number,bank_balance as balance,currency_id')
                    ->where('user_id' , $user_id)
                    ->where('account_owner','like',"%$filterName%")
                    ->orderBy('id' , 'desc')
                    ->get();
            }elseif($type == 2){
                $data = Finance_treasury::
                selectRaw('id,treasury_name as owner_name,serial_number,start_balance as balance,currency_id')
                    ->where('user_id' , $user_id)
                    ->where('treasury_name','like',"%$filterName%")
                    ->orderBy('id' , 'desc')
                    ->get();
            }elseif($type == 3){
                $data = Finance_credit::
                selectRaw('id,credit_owner as owner_name,serial_number,credit_balance as balance')
                    ->where('user_id' , $user_id)
                    ->where('credit_owner','like',"%$filterName%")
                    ->orderBy('id' , 'desc')
                    ->get();
            }

        }else{
            if($type == 0){
                $finance_banks = Finance_bank::where('user_id' , $user_id)
                    ->get(['id','account_owner as owner_name','serial_number' , 'bank_balance as balance','currency_id']);

                $finance_treasury = Finance_treasury::where('user_id' , $user_id)
                    ->get(['id','treasury_name as owner_name','serial_number' , 'start_balance as balance','currency_id']);

                $finance_credit = Finance_credit::where('user_id' , $user_id)
                    ->get(['id','credit_owner as owner_name','serial_number' , 'credit_balance as balance']);

                $data=[];
                foreach ($finance_banks as $bank){
                    $data[] = [
                        'id'           => $bank->id,
                        'owner_name'   => $bank->owner_name,
                        'serial_number'=> $bank->serial_number,
                        'balance'      => $bank->balance,
                        'currency'     => $currency[$bank->currency_id],
                        'type'         => 1
                    ];
                }
                foreach ($finance_treasury as $treasury){
                    $data[] = [
                        'id'           => $treasury->id,
                        'owner_name'   => $treasury->owner_name,
                        'serial_number'=> $treasury->serial_number,
                        'balance'      => $treasury->balance,
                        'currency'     => $currency[$treasury->currency_id],
                        'type'         => 2
                    ];
                }
                foreach ($finance_credit as $credit){
                    $data[] = [
                        'id'           => $credit->id,
                        'owner_name'   => $credit->owner_name,
                        'serial_number'=> $credit->serial_number,
                        'balance'      => $credit->balance,
                        'currency'     => null,
                        'type'         => 3
                    ];
                }

            }elseif($type == 1){
                $data = Finance_bank::
                selectRaw('id,account_owner as owner_name,serial_number,bank_balance as balance,currency_id')
                    ->where('user_id' , $user_id)
                    ->orderBy('id' , 'desc')
                    ->get();
            }elseif($type == 2){
                $data = Finance_treasury::
                selectRaw('id,treasury_name as owner_name,serial_number,start_balance as balance,currency_id')
                    ->where('user_id' , $user_id)
                    ->orderBy('id' , 'desc')
                    ->get();
            }elseif($type == 3){
                $data = Finance_credit::
                selectRaw('id,credit_owner as owner_name,serial_number,credit_balance as balance')
                    ->where('user_id' , $user_id)
                    ->orderBy('id' , 'desc')
                    ->get();
            }
        }
      //  dd($data);

        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadFinanceWithStatus', ['data' => $data , 'status' => $type,'currency' => $currency ])->render();
        }
    }


    //=========================================================
    //Helper methods
    //=========================================================
    public function filterAll(Request $request,$start_date = null,$end_date = null, $pages=10){
        $user_id = Auth::user()->id;
        $currency = currency_table::all()->pluck('name', 'id')->all();

        if ($start_date != -1  && $end_date != -1){
            $invoices = \DB::table('installement_invoices')->whereBetween('paid_date',array($start_date,$end_date))->get();


            $paid=[];
            foreach ($invoices as $invoice){
                $paid[] = [
                    'id'           => $invoice->id,
                    'sales_invoice_id'   => $invoice->sales_invoice_id,
                    'paid'=> $invoice->paid,
                    'paid_date'      => $invoice->paid_date,
                    'finance_id'     => $invoice->finance_id,
                    'finance_type'         => $invoice->finance_type,
                    'finance_notes'     => $invoice->finance_notes
                ];
            }


        }

        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadFinanceWithStatus', ['data' => $data , 'status' => $type,'currency' => $currency ])->render();
        }
    }

    public function addAmount(Request $request){
        $type = $request->finance_type;
        $id   = $request->finance_id;
        $amount = $request->amount;
        $ldate  = $request->date;
        if($type ==1){

           $finance = Finance_bank::find($id);
           $finance->bank_balance += $amount;
           $finance->save();

           DB::table('amounts')->insert([
                'finance_type' => $type,
                'finance_id'   => $id,
                'added_date'   => $ldate,
                'amount' => $amount,
                'user_id' => Auth::user()->id
           ]);

           \DB::table('account_reports')->insert([
                        'account_code'  => $finance->serial_number,
                        'name'          => $finance->account_owner,
                        'invoice_number'   => 0,
                        'invoice_type'  => 0,
                        'finance_id'    => $id,
                        'finance_type'  => 1,
                        'deal_type'     => trans('frontend/reports.addprice'),
                        'amount'        => $request->amount,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'receiver_code' => $finance->serial_number,
                        'user_id'       => Auth::user()->id
                    ]);

        }elseif ($type ==2) {

           $finance = Finance_treasury::find($id);
           $finance->start_balance += $amount;
           $finance->save();

            DB::table('amounts')->insert([
                'finance_type' => $type,
                'finance_id'   => $id,
                'added_date'   => $ldate,
                'amount' => $amount,
                'user_id' => Auth::user()->id
           ]);

                \DB::table('account_reports')->insert([
                        'account_code'  => $finance->serial_number,
                        'name'          => $finance->treasury_name,
                        'invoice_number'   => 0,
                        'invoice_type'  => 0,
                        'finance_id'    => $id,
                        'finance_type'  => 2,
                        'deal_type'     => trans('frontend/reports.addprice'),
                        'amount'        => $request->amount,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'receiver_code' => $finance->serial_number,
                        'user_id'       => Auth::user()->id
                    ]);


        }elseif ($type ==3) {

           $finance = Finance_credit::find($id);
           $finance->credit_balance += $amount;
           $finance->save();

           DB::table('amounts')->insert([
                'finance_type' => $type,
                'finance_id'   => $id,
                'added_date'   => $ldate,
                'amount' => $amount,
                'user_id' => Auth::user()->id
           ]);

           \DB::table('account_reports')->insert([
                        'account_code'  => $finance->serial_number,
                        'name'          => $finance->credit_owner,
                        'invoice_number'   => 0,
                        'invoice_type'  => 0,
                        'finance_id'    => $id,
                        'finance_type'  => 3,
                        'deal_type'     => trans('frontend/reports.addprice'),
                        'amount'        => $request->amount,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'receiver_code' => $finance->serial_number,
                        'user_id'       => Auth::user()->id
                    ]);

        }
        return response()->json();
    }

    public function transform(Request $request){
        $type = $request->finance_type;
        $id   = $request->finance_id;
        $amount = $request->amount;
        $ldate = $request->added_date;
        $receiver_id = $request->receiver_id;
        $description = $request->description;
        if($type ==1){

           $finance = Finance_bank::find($id);
           $finance->bank_balance -= $amount;
           $finance->save();

           $finance2 = Finance_bank::find($receiver_id);
           $finance2->bank_balance += $amount;
           $finance2->save();

           DB::table('amounts')->insert([
                'finance_type' => $type,
                'finance_id'   => $id,
                'added_date'   => $ldate,
                'amount' => $amount,
                'receiver_id' => $receiver_id,
                'description' => $description,
                'user_id' => Auth::user()->id
           ]);

           \DB::table('account_reports')->insert([
                        'account_code'  => $finance->serial_number,
                        'name'          => $finance->account_owner,
                        'invoice_number'   => 0,
                        'invoice_type'  => 0,
                        'finance_id'    => $id,
                        'finance_type'  => 1,
                        'deal_type'     => trans('frontend/reports.transfer'),
                        'amount'        => $request->amount,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'receiver_code'   => $finance2->serial_number,
                        'user_id'       => Auth::user()->id
                    ]);


        }elseif ($type ==2) {

           $finance = Finance_treasury::find($id);
           $finance->start_balance -= $amount;
           $finance->save();

           $finance2 = Finance_treasury::find($receiver_id);
           $finance2->start_balance += $amount;
           $finance2->save();

            DB::table('amounts')->insert([
                'finance_type' => $type,
                'finance_id'   => $id,
                'added_date'   => $ldate,
                'amount' => $amount,
                'receiver_id' => $receiver_id,
                'description' => $description,
                'user_id' => Auth::user()->id
            ]);

            \DB::table('account_reports')->insert([
                        'account_code'  => $finance->serial_number,
                        'name'          => $finance->treasury_name,
                        'invoice_number'   => 0,
                        'invoice_type'  => 0,
                        'finance_id'    => $id,
                        'finance_type'  => 2,
                        'deal_type'     => trans('frontend/reports.transfer'),
                        'amount'        => $request->amount,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'receiver_code'   => $finance2->serial_number,
                        'user_id'       => Auth::user()->id
                    ]);



        }elseif ($type ==3) {

           $finance = Finance_credit::find($id);
           $finance->credit_balance -= $amount;
           $finance->save();

           $finance2 = Finance_credit::find($receiver_id);
           $finance2->credit_balance += $amount;
           $finance2->save();

           DB::table('amounts')->insert([
                'finance_type' => $type,
                'finance_id'   => $id,
                'added_date'   => $ldate,
                'amount' => $amount,
                'receiver_id' => $receiver_id,
                'description' => $description,
                'user_id' => Auth::user()->id
           ]);

           \DB::table('account_reports')->insert([
                        'account_code'  => $finance->serial_number,
                        'name'          => $finance->credit_owner,
                        'invoice_number'   => 0,
                        'invoice_type'  => 0,
                        'finance_id'    => $id,
                        'finance_type'  => 3,
                        'deal_type'     => trans('frontend/reports.transfer'),
                        'amount'        => $request->amount,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'receiver_code'   => $finance2->serial_number,
                        'user_id'       => Auth::user()->id
                    ]);

        }
        return response()->json();
    }

    public function close(Request $request){
        $type = $request->finance_type;
        $id   = $request->finance_id;
        $ldate = date('Y-m-d');
        if($type == 1){
            $finance = Finance_bank::find($id);
            \DB::table('account_reports')->insert([
                        'account_code'  => $finance->serial_number,
                        'name'          => $finance->account_owner,
                        'invoice_number'   => 0,
                        'invoice_type'  => 0,
                        'finance_id'    => $id,
                        'finance_type'  => $type,
                        'deal_type'     => trans('frontend/reports.closebank'),
                        'amount'        => $finance->start_balance,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'user_id'       => Auth::user()->id
                    ]);
        }elseif ($type == 2) {
            $finance = Finance_treasury::find($id);
            \DB::table('account_reports')->insert([
                        'account_code'  => $finance->serial_number,
                        'name'          => $finance->treasury_name,
                        'invoice_number'   => 0,
                        'invoice_type'  => 0,
                        'finance_id'    => $id,
                        'finance_type'  => $type,
                        'deal_type'     => trans('frontend/reports.closetrea'),
                        'amount'        => $finance->start_balance,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'user_id'       => Auth::user()->id
                    ]);
        }elseif ($type == 3) {
            $finance = Finance_credit::find($id);
            \DB::table('account_reports')->insert([
                        'account_code'  => $finance->serial_number,
                        'name'          => $finance->credit_owner,
                        'invoice_number'   => 0,
                        'invoice_type'  => 0,
                        'finance_id'    => $id,
                        'finance_type'  => $type,
                        'deal_type'     => trans('frontend/reports.closecred'),
                        'amount'        => $finance->start_balance,
                        'debtor'        => "----",
                        'creditor'      => "----",
                        'user_id'       => Auth::user()->id
                    ]);
        }
        DB::table('closed')->insert([
                'finance_type' => $type,
                'finance_id'   => $id,
                'closed_date'  => $ldate,
                'user_id'      => Auth::user()->id 
           ]);
        

        return response()->json();
    }

    public function removeAmount(Request $request){
        $id   = $request->id;
        \DB::table('installement_invoices')->where('id','=',$id)->delete();
        return response()->json();
    }
    public function removeTrans(Request $request){
        $id   = $request->id;
        \DB::table('amounts')->where('id','=',$id)->delete();
        return response()->json();
    }

}
