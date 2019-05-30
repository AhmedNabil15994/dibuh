<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\UserProfile as Profile;
use App\Models\UserAddress as Address;
use App\Models\UserBankAccount as BankAccount;
use App\Models\UserBankDataType ;
use App\Models\Role;
use App\Models\Permission;
use App\Models\userRole;
use App\Models\UserSetting;
use App\Models\UserSettingType;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceItem;
use App\Models\Installment;
use App\Models\Contact;
use App\Models\Invoice;
use DB;
use Hash;
use Config;
use Carbon;
use Auth;
use PDF;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use App\Models\PricePlan;



class InvoicesController extends Controller
{
     protected $data=[];

    public function index(Request $request) {
    //    $data = User::orderBy('id', 'DESC')->paginate(5);
        $invoices=Invoice::all();
        return view(Config::get('back_theme') . '.invoices.index', compact('invoices'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(Request $request) {
       $user_id=Auth::user()->id;
        $data = User::orderBy('id', 'DESC')->paginate(5);
        $price_plans=DB::table('price_plans')->pluck('name','id');
        //bank_serial_number
        $invoice_row_serial_number = Invoice::whereRaw("serial_number = (select max(serial_number) from invoices where user_id = $user_id )")->get(['serial_number']);
        $invoice_serial_number_start=0;
        if(!count($invoice_row_serial_number) > 0){
            $invoice_serial_number_start = Setting::where('key' , 'invoice_start')->get(['value'])->pluck('value')->all();
        }

   if(count($invoice_row_serial_number) > 0)
       $invoice_serial_number=$invoice_row_serial_number[0]->serial_number;
   else
   $invoice_serial_number= $invoice_serial_number_start[0];
        //$invoice_serial_number = count($invoice_row_serial_number) > 0 ? $invoice_row_serial_number[0]->serial_number : $invoice_serial_number_start[0];

        $invoice_serial_number = count($invoice_row_serial_number) > 0 ? ++$invoice_serial_number : $invoice_serial_number;

        return view(Config::get('back_theme') . '.invoices.create', compact('data','price_plans','invoice_serial_number'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }
		public function store(Request $request)
		{
	//		dd(Input::all());
			$rules=array(  'user_name'=>'required',
			              'address'=>'required',
										'serial_number'=>'unique:invoices,serial_number',
										'price_plan'=>'required',
										'invoice_date'=>'required',
										'due_date'=>'required',
                    'from_date'=>'required',
                    'to_date'=>'required'

			);
    //  $request->vaildate($rules);
			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails()){
					// If validation fails redirect back to login.
					// return Response::json(array(
					// 		'fail' => true,
					// 		'errors' => $validator->getMessageBag()->toArray()
					// ));

                  return back()
                              ->withErrors($validator)
                              ->withInput();

        //  return back()
			}

	   DB::beginTransaction();
			   try {
					 $invoice=new Invoice();
					 $invoice->user_name=$request->user_name;
					 $invoice->user_id=$request->user_id_;
           $invoice->address=$request->address;
			 	   $invoice->user_address_id=$request->user_address_id;
				   $invoice->serial_number=$request->serial_number;
					 $invoice->price_plan_id=$request->price_plan;
					 $invoice->invoice_date=$request->invoice_date;
					 $invoice->due_date=$request->invoice_date;
				   $invoice->from_date=$request->invoice_date;
		  		 $invoice->to_date=$request->invoice_date;
					 $invoice->save();

				   DB::commit();
				 } catch (\Exception $e) {
						 DB::rollback();
						 $arr[]=$e->getMessage();
						 return Response::json(array('fail' => true,'errors' => $arr));
				 }

    //  return $invoice->id;
    return back()->with('success','تم الاضافه بنجاح');
		}
		public function getUsersJson(Request $request) {
				$users=User::where('name', 'like', "%$request->text%")->get(['name', 'id']);
				return Response::json($users);
		}
    public function getOneUserAddress($id) {
        $address = UserAddress::where('user_id', $id)->first();
       return "$address->name $address->street $address->house_no\n$address->postal_code $address->city\n {$address->country->name}|$address->id";
    }
    public function getToDate($invoice_date,$id)
    {
      $price_plan=Db::table('price_plans')->where('id',$id)->first();
       $to_date=Carbon::parse($invoice_date);
      if($price_plan->period_id==1)
      {  $to_date=$to_date->addMonth()->format('Y-m-d');
      }
      elseif($price_plan->period_id==2)
      { $to_date=$to_date->addMonth(6)->format('Y-m-d');
      }
      elseif($price_plan->period_id==3)
      {  $to_date=$to_date->addMonth(12)->format('Y-m-d');
      }

       return Response::json(array('result' => $to_date));

    }

    public function show(Request $request, $id) {

        $invoice=Invoice::find($id);
        $data=User::find($invoice->user_id)->profile;
        $user_email=User::find($invoice->user_id)->email;
        $address = UserAddress::where('user_id', $invoice->user_id)->first();
        $data_admin=User::find(Auth::user()->id)->profile;
        $address_admin = UserAddress::where('user_id', Auth::user()->id)->first();
        $price_plan=PricePlan::find($invoice->price_plan_id);

        return view(Config::get('back_theme') . '.invoices.show',compact('data','data_admin','address','address_admin','invoice','price_plan','user_email'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function download_pdf($id)
    {
      $invoice=Invoice::find($id);
      $path='backend.adminTle.invoices.pdf';
      $this->data['invoice']=Invoice::find($id);
      $this->data['data']=User::find($invoice->user_id)->profile;
      $this->data['address'] = UserAddress::where('user_id', $invoice->user_id)->first();

      $this->data['data_admin']=User::find(Auth::user()->id)->profile;
      $this->data['address_admin'] = UserAddress::where('user_id', Auth::user()->id)->first();

      $this->data['price_plan']=PricePlan::find($invoice->price_plan_id);


      $pdf=PDF::loadView($path, $this->data,[], [
                'format' => 'A4-M'
              ]);


        return $pdf->download(  $this->data['data']->getFullNameAttribute().$this->data['invoice']->serial_number.'.pdf');

    }

    public function destroy(Request $request, $id) {
           Invoice::find($id)->delete();
           return back()->with('success','deleted successfully');
        //return view(Config::get('back_theme') . '.invoices.create', compact('data'))
                        //->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function sendEmail(Request $request){

        $rules = [
            //  'id' => 'required',
              'email' => 'required|email',
          ];
          $validator = Validator::make(Input::all(), $rules);
          if ($validator->fails()){
              return Response::json([
                  'errors' => $validator->getMessageBag()->toArray()
              ]);
          }

        $client_name =$request->user_name;
        $content  = $request->message;
        $subject  = $request->subject;
        $email = $request->email;
        $sender = Auth::user()->email;
        $serial_number = $request->serial_number;
        $type=1;
        $invoice=Invoice::find($request->invoice_id);
        $email12 = \DB::table('email_templates')->where('id','=',$type)->first();
        $old = ["[INVOICE_NUMBER]"];
        $new   = [$serial_number];
        $phrase = $email12->subject;
        $newPhrase = str_replace($old, $new, $phrase);
        $admin=User::find(Auth::user()->id)->profile;
        $address=UserAddress::where('user_id', Auth::user()->id)->first();

        $address_admin=$address->street." ". $address->house_no
        ." ".$address->postal_code." ".$address->city
        ." ".$address->country->name;
        $package=PricePlan::where('id',$invoice->price_plan_id)->first()->name;

        $data = [
              'no-reply' => 'admin@dibuh.com',
              'name'     => 'Dibuh',
              'Fname'    => $request->user_name,
              'Email'    => $email,
              'Company'  => $request->company,
              'message'    => $content,
              'serial_number' => $request->serial_number,
              'sent_company' => $admin->company,
              'address'     => $address_admin,
              'phone'       => $admin->phone,
              'sender'      => $sender,
              'subject'    => $newPhrase,
              'package'    => $package,
              'invoice_id'=>$request->invoice_id
          ];

          \Mail::send('emails.mail3', ['data' => $data,'type'=>$type],
              function ($message) use ($data)
              {
                  $message
                      ->from($data['no-reply'],$data['name'])
                      ->to($data['Email'])->subject($data['subject']);
              });
        return Response::json($invoice->id);
      }
}
