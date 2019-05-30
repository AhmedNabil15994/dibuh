<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use App\Models\ContactsToContactType;
use App\Models\Governorate;
use App\Models\Setting;
//use App\Models\UserSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
use App\Models\Contact;
use App\Models\ContactAddress;
use App\Models\ContactType;
use App\Models\Title;
use App\Models\Country;
use App\Models\Contact_phone;
use Config;
use Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use View;
use Illuminate\Contracts\Encryption\DecryptException;

class ContactController extends DashboardBaseController {

    protected $userType = 'user';
    protected $module = 'contact';

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
        $this->data['page_title'] = 'User Profile';
        return $this->view($this->userType . '.' . $this->module . '.' . 'main', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        protected function GetDataQuery(){
        $user_id =Auth::user()->id;
        $data = DB::table('contacts_to_contact_types as contype')->distinct()
               ->where('contype.user_id','=',$user_id)//contact_phones.phone_number,
               ->selectRaw("con.first_name,
                            contype.id,
                            contype.display_id as customer_display_id,
                            contype.contact_type_id,
                            con.last_name,
                            con.company,
                                (SELECT
                                    contact_phones.phone_number
                                    FROM
                                    contact_phones
                                    WHERE
                                    contact_phones.contact_id = con.id and
                                    contact_phones.phone_number is not null
                                    LIMIT 1) as phone,
                            con.id as contact_id,
                            contact_addresses.city,
                             (
                             SELECT display_id
                             FROM contacts as conn
                             INNER JOIN contacts_to_contact_types ON contacts_to_contact_types.contact_id = conn.id
                             WHERE
                                  contacts_to_contact_types.contact_id = con.id AND
                                  contacts_to_contact_types.is_deleted IS NULL AND
                                  contacts_to_contact_types.user_id = $user_id AND
                                  contacts_to_contact_types.contact_type_id = 2
                             ) as supplier_display_id
                            ")
            ->join('contacts as con', 'contype.contact_id', '=', 'con.id')
//            ->join('contact_phones', 'contact_phones.contact_id', '=', 'con.id')
            ->join('contact_addresses', 'contact_addresses.contact_id', '=', 'con.id')
            ->where('contype.is_deleted',NULL)
            ->where('contype.user_id',$user_id)
            ->where('contype.contact_type_id',1)
            ->orwhere('contype.contact_type_id',2)
            ->where('contype.user_id',$user_id)
            ->where('contype.is_deleted',NULL)
            ->whereNotIn('contype.contact_id',function ($q) use ($user_id){
                $q->from('contacts_to_contact_types as cont')
                  ->select('cont.contact_id')
//                  ->where('cont.contact_id', 'contact_id')
                  ->where('cont.contact_type_id', 1)
                  ->where('cont.is_deleted', null)
                  ->where('cont.user_id', $user_id);
            })
            ->orderBy('contype.display_id' , 'desc')
            ->get();



        return $data;
    }
    public function index(Request $request) {

//        $data = ContactsToContactType::where('is_deleted',NULL)->where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);

        $data = $this->GetDataQuery();
        $cont = Contact::where('user_id','=',Auth::user()->id)->get();
        $user_id = Auth::user()->id;
        $types = ContactType::all()->pluck('name', 'id')->all();

        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadContactsWithTypeAll', ['data'=>$data , 'types'=>$types , 'cont'=>$cont])->render();
        }
        $page_title = trans('frontend/' . $this->module . '.title');
        $user_type = Auth::user()->roles;
        return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.index',compact('page_title','user_type','data','types','cont','user_id'))->with('i', ($request->input('page', 1) - 1) * 10);
//                        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $user_id = Auth::user()->id;
        $this->data['page_title'] = trans('frontend/' . $this->module . 'create_new');
        $this->data['titles'] = Title::all()->pluck('name', 'id')->all();
//        $this->data['contact_type'] = ContactType::all()->pluck('name', 'id')->all();
        $this->data['countries'] = Country::all()->pluck('name', 'id')->all();
        $this->data['governorates'] = Governorate::all()->pluck('name', 'id')->all();
//dd($this->data['governorates']);
//        $display_id = ContactsToContactType::whereRaw("display_id = (select max(display_id) from contacts_to_contact_types where contact_type_id = 1 AND user_id = $user_id )")->get(['display_id']);
//        $customer_number=count($display_id) > 0 ? $display_id[0]->display_id++ : 999;

        $display_id = ContactsToContactType::whereRaw("display_id = (select max(display_id) from contacts_to_contact_types where contact_type_id = 1 AND user_id = $user_id )")->get(['display_id']);
        $contacts_customer_start = 0;
        if(!count($display_id) > 0){
            $contacts_customer_start = Setting::where('key' , 'contacts_customer_start')->get(['value'])->pluck('value')->all();
        }
        $customer_number= count($display_id) > 0 ? $display_id[0]->display_id : $contacts_customer_start[0];
        $this->data['customer_number'] = count($display_id) > 0 ? ++$customer_number : $customer_number;


        $display_id = ContactsToContactType::whereRaw("display_id = (select max(display_id) from contacts_to_contact_types where contact_type_id = 2 AND user_id = $user_id )")->get(['display_id']);
        $contacts_supplier_start = 0;
        if(!count($display_id) > 0){
            $contacts_supplier_start = Setting::where('key' , 'contacts_supplier_start')->get(['value'])->pluck('value')->all();
        }
        $supplier_number= count($display_id) > 0 ? $display_id[0]->display_id : $contacts_supplier_start[0];
        $this->data['supplier_number'] = count($display_id) > 0 ? ++$supplier_number : $supplier_number;

        return $this->view($this->userType . '.' . $this->module . '.' . 'create', $this->data);
    }



    public function store(Request $request)
    {
        $error_customer = 'customer code your entered is already exist';
        $error_supplier = 'supplier code your entered is already exist';
        $error_cust_equal_supp = 'customer code and supplier code must be not equal';

        $user_id = Auth::user()->id;
        $masterRules1 = [
            'first_name' => 'required|max:25',
            'last_name' => 'required|max:25',
            'job' => 'max:20',
            'company' => 'required|max:25',
            'IBAN' => 'max:14',
            'bic' => 'max:14',
            'bank_name' => 'max:25',
            'bank_number' => 'max:20',
//            'adresse.*.address_number' => 'required',
            'phones.*.phone_number' => 'max:11',
        ];


        if ($request->supplier_input == 'on' && $request->customer_input == 'on') {
            $masterRules2 = [
                'customer_code' => "required",//|unique:contacts_to_contact_types,display_id,NULL,id,user_id,$user_id",
                'customer_reference_code' => "max:14",//|contacts_to_contact_types,reference_id,NULL,id,user_id,$user_id",
                'supplier_code' => "required",//|unique:contacts_to_contact_types,display_id,NULL,id,user_id,$user_id",
                'supplier_reference_code' => "max:14",//|contacts_to_contact_types,reference_id,NULL,id,user_id,$user_id"
            ];
            $rowsCustomerExist = ContactsToContactType::where('contact_type_id', 1)->where('display_id', $request->customer_code)->where('user_id', $user_id)->count();
            $rowsSupplierExist = ContactsToContactType::where('contact_type_id', 2)->where('display_id', $request->supplier_code)->where('user_id', $user_id)->count();

        } elseif ($request->customer_input == 'on') {
            $masterRules2 = [
                'customer_code' => "required",//|unique:contacts_to_contact_types,display_id,NULL,id,user_id,$user_id",
                'customer_reference_code' => "max:14",//|unique:contacts_to_contact_types,reference_id,NULL,id,user_id,$user_id"
            ];
            $rowsCustomerExist = ContactsToContactType::where('contact_type_id', 1)->where('display_id', $request->customer_code)->where('user_id', $user_id)->count();
        } elseif ($request->supplier_input == 'on') {
            $masterRules2 = [
                'supplier_code' => "required",//|unique:contacts_to_contact_types,display_id,NULL,id,user_id,$user_id",
                'supplier_reference_code' => "max:14",//|contacts_to_contact_types,reference_id,NULL,id,user_id,$user_id"
            ];
            $rowsSupplierExist = ContactsToContactType::where('contact_type_id', 2)->where('display_id', $request->supplier_code)->where('user_id', $user_id)->count();
        } else {
            $masterRules2 = [
                'customer_input' => 'required',
                'customer_code' => "required",//|unique:contacts_to_contact_types,display_id,NULL,id,user_id,$user_id",
                'customer_reference_code' => "max:14",//|contacts_to_contact_types,reference_id,NULL,id,user_id,$user_id"
            ];
            $rowsCustomerExist = ContactsToContactType::where('contact_type_id', 1)->where('display_id', $request->customer_code)->where('user_id', $user_id)->count();
        }

        $err = [];
        isset($rowsCustomerExist) && $rowsCustomerExist > 0 ? $err[]=$error_customer : '';
        isset($rowsSupplierExist) && $rowsSupplierExist > 0 ? $err[]=$error_supplier : '';
        if( (isset($request->customer_code) && isset($request->supplier_code)) && $request->customer_code == $request->supplier_code){$err[]=$error_cust_equal_supp; $error_equality='err';}
        if ((isset($rowsCustomerExist) && $rowsCustomerExist > 0 )|| (isset($rowsSupplierExist) && $rowsSupplierExist > 0) || isset($error_equality)) {return Redirect()->back()->withInput()->withErrors($err);}

        $rules = array_merge($masterRules1, $masterRules2);
        $this->validate($request, $rules);

        DB::beginTransaction();
        try {

            $contact = new Contact();
            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->job = $request->job;
            $contact->company = $request->company;
            $contact->iban = $request->IBAN;
            $contact->bic = $request->BIC;
            $contact->notes = $request->header_text;
            $contact->bank_name = $request->bank_name;
            $contact->bank_number = $request->bank_number;
            $contact->user_id = $user_id;
            $contact->save();

            if ($request->customer_input == 'on') {
                $contact->contact_type()->create([
                    'contact_type_id' => '1',
                    'display_id' => $request->customer_code,
                    'reference_id' => $request->customer_reference_code,
                    'user_id' => $user_id
                ]);
            }

            if ($request->supplier_input == 'on') {
                $contact->contact_type()->create([
                    'contact_type_id' => '2',
                    'display_id' => $request->supplier_code,
                    'reference_id' => $request->supplier_reference_code,
                    'user_id' => $user_id
                ]);
            }

            foreach ($request->adresse as $key => $value) {
                $contact->addresses()->create([
                    'user_id' => $user_id,
                    'address_type_id' => 1,
                    'house_no' => $value['address_number'],
                    'city' => $value['region'],
                    'postal_code' => $value['code_tax'],   // postal code   -> code_tax in form need to be fixed
                    'country_id' => $value['country'],
                    'governorate_id' => $value['governorate']
                ]);
            }

            foreach ($request->phones as $key => $value) {
                $contact->phones()->create([
                    'phone_number' => $value['phone_number'],
                    'user_id' => $user_id
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
            return Redirect()->back()->with('success', $e->getMessage());
        }

        return redirect()->route($this->module . '.index')
            ->with('success', 'Contact created successfully');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $this->data['page_title'] = trans('frontend/' . $this->module . 'edit');
        $this->data['titles'] = Title::all()->pluck('name', 'id')->all();
        $this->data['contact_type'] = ContactType::all()->pluck('name', 'id')->all();
        $this->data['data'] = Contact::find($id);
        $this->data['governorates'] = Governorate::all()->pluck('name', 'id')->all();
        $this->data['countries'] = Country::all()->pluck('name', 'id')->all();
        $user_id=Auth::user()->id;
        ///create new_customer and supplier_display_id
                $display_id = ContactsToContactType::whereRaw("display_id = (select max(display_id) from contacts_to_contact_types where contact_type_id = 1 AND user_id = $user_id )")->get(['display_id']);
                $contacts_customer_start = 0;
                if(!count($display_id) > 0){
                    $contacts_customer_start = Setting::where('key' , 'contacts_customer_start')->get(['value'])->pluck('value')->all();
                }
                $customer_number= count($display_id) > 0 ? $display_id[0]->display_id : $contacts_customer_start[0];
                $this->data['new_customer_number'] = count($display_id) > 0 ? ++$customer_number : $customer_number;


                $display_id = ContactsToContactType::whereRaw("display_id = (select max(display_id) from contacts_to_contact_types where contact_type_id = 2 AND user_id = $user_id )")->get(['display_id']);
                $contacts_supplier_start = 0;
                if(!count($display_id) > 0){
                    $contacts_supplier_start = Setting::where('key' , 'contacts_supplier_start')->get(['value'])->pluck('value')->all();
                }
                $supplier_number= count($display_id) > 0 ? $display_id[0]->display_id : $contacts_supplier_start[0];
                $this->data['new_supplier_number'] = count($display_id) > 0 ? ++$supplier_number : $supplier_number;
      //////////end customer and supplier number


        return $this->view($this->userType . '.' . $this->module . '.' . 'edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
    // $this->validate($request,[
    //       'first_name' => 'required|max:25',
    //       'last_name' => 'required|max:25',
    //       'job' => 'max:20',
    //       'company' => 'required|max:25',
    //       'IBAN' => 'max:14',
    //       'bic' => 'max:14',
    //       'bank_name' => 'max:25',
    //       'bank_number' => 'max:20',
    // //            'adresse.*.address_number' => 'required',
    //       'phones.*.phone_number' => 'max:11',
    //   ]);
    //     // $input = $request->all();
    //     // $model = Contact::find($id);
    //     // $model->update($input);
    //     // return redirect()->route($this->module . '.index')
    //     //                 ->with('success', 'Contact updated successfully');
    //                 //

                            $error_cust_equal_supp = 'customer code and supplier code must be not equal';

                            $user_id = Auth::user()->id;
                          $rules = [
                                'first_name' => 'required|max:25',
                                'last_name' => 'required|max:25',
                                'job' => 'max:20',
                                'company' => 'required|max:25',
                                'IBAN' => 'max:14',
                                'bic' => 'max:14',
                                'bank_name' => 'max:25',
                                'bank_number' => 'max:20',
                    //            'adresse.*.address_number' => 'required',
                                'phones.*.phone_number' => 'max:11',
                            ];

                            $this->validate($request, $rules);

                            DB::beginTransaction();
                            try {

                                $contact = Contact::find($id);
                                $contact->first_name = $request->first_name;
                                $contact->last_name = $request->last_name;
                                $contact->job = $request->job;
                                $contact->company = $request->company;
                                $contact->iban = $request->IBAN;
                                $contact->bic = $request->BIC;
                                $contact->notes = $request->header_text;
                                $contact->bank_name = $request->bank_name;
                                $contact->bank_number = $request->bank_number;
                                $contact->user_id = $user_id;
                                $contact->save();
                                //edit here
                                //delete the prevoius relation between contact and contact to contact type
                                $user_id=Auth::user()->id;
                                $contact_to_contact_type=ContactsToContactType::where('contact_id',$id)->where('user_id',$user_id)->get();
                                foreach($contact_to_contact_type as $ctype){
                                  $ctype->delete();
                                }

                                if ($request->customer_input == 'on') {
                                    $contact->contact_type()->create([
                                        'contact_type_id' => '1',
                                        'display_id' => $request->customer_code,
                                        'reference_id' => $request->customer_reference_code,
                                        'user_id' => $user_id
                                    ]);
                                }

                                if ($request->supplier_input == 'on') {
                                    $contact->contact_type()->create([
                                        'contact_type_id' => '2',
                                        'display_id' => $request->supplier_code,
                                        'reference_id' => $request->supplier_reference_code,
                                        'user_id' => $user_id
                                    ]);
                                }
                                $contact_to_contact_address=ContactAddress::where('contact_id',$id)->where('user_id',$user_id)->get();
                                foreach($contact_to_contact_address as $address){
                                  $address->delete();
                                }
                                foreach ($request->adresse as $key => $value) {
                                    $contact->addresses()->create([
                                        'user_id' => $user_id,
                                        'address_type_id' => 1,
                                        'house_no' => $value['address_number'],
                                        'city' => $value['region'],
                                        'postal_code' => $value['code_tax'],   // postal code   -> code_tax in form need to be fixed
                                        'country_id' => $value['country'],
                                        'governorate_id' => $value['governorate']
                                    ]);
                                }
                                $contact_to_contact_phone=Contact_phone::where('contact_id',$id)->get();
                                foreach($contact_to_contact_phone as $phone){
                                  $phone->delete();
                                }

                                foreach ($request->phones as $key => $value) {
                                    $contact->phones()->create([
                                        'phone_number' => $value['phone_number']
                                    ]);
                                }

                                DB::commit();
                            } catch (\Exception $e) {
                                DB::rollback();
                                return $e->getMessage();
                                return Redirect()->back()->with('success', $e->getMessage());
                            }

                            return redirect()->route($this->module . '.index')
                                ->with('success', 'Contact created successfully');
                        }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::beginTransaction();
        try {

           \DB::table('contacts_to_contact_types')->where('contact_id','=',$id)->delete();
           \DB::table('contacts')->where('id','=',$id)->delete();
           \DB::table('contact_addresses')->where('contact_id','=',$id)->delete();
           \DB::table('contact_phones')->where('contact_id','=',$id)->delete();

           DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            return Redirect()->back()->with('error', 'Contact deleted unsuccessfully ' . $e->getMessage());;
        }
        return redirect()->route($this->module . '.index')
            ->with('success', 'Contact deleted successfully');
    }


    public function addressIndex(Request $request, $id) {
        $this->data['page_title'] = 'Contact List Address';
        $this->data['id'] = $id;
        $this->data['data'] = Auth::user()->address;
        $user = Auth::user();
        //$this->data['data'] = $user->contacts()->find($id)->addresses()->orderBy('id', 'DESC')->paginate(10); // it works
        $this->data['data'] = Contact::find($id)->addresses()->orderBy('id', 'DESC')->paginate(10);
        return $this->view($this->userType . '.' . $this->module . '.' . 'contact_address_index', $this->data)
                        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function addressCreate($id) {
        $this->data['page_title'] = 'Conact Address Create';
        $this->data['id'] = $id;
        $this->data['countries'] = Country::all()->pluck('name', 'id')->all();
        return $this->view($this->userType . '.' . $this->module . '.' . 'contact_address_create', $this->data);
    }

    public function addressStore(Request $request, $id) {
        $this->validate($request, [
            'country_id' => 'required',
            'city' => 'required',
            'house_no' => 'required',
            'street' => 'required',
            'postal_code' => 'required'
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['address_type_id'] = 1;
        $input['contact_id'] = $id;
        ContactAddress::create($input);

        return redirect()->route($this->module . '.address.index', $id)
                        ->with('success', 'Contact Address created successfully');
    }

    public function addressEdit($contact_id, $id) {
        $this->data['page_title'] = 'Profile Basic Edit';
        $this->data['id'] = $contact_id;
        $this->data['data'] = ContactAddress::find($id);
        $this->data['countries'] = Country::all()->pluck('name', 'id')->all();
        return $this->view($this->userType . '.' . $this->module . '.' . 'contact_address_edit', $this->data);
    }

    public function addressUpdate(Request $request, $id) {
        $this->validate($request, [
            'country_id' => 'required',
            'city' => 'required',
            'street' => 'required',
            'house_no' => 'required|',
            'postal_code' => 'required'
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['address_type_id'] = 1;


        ContactAddress::find($id)->update($input);

        return redirect()->route('contact.address.index', $request['contact_id'])
                        ->with('success', 'Contact Address updated successfully');
    }

    public function addressDestroy($id) {
        $contactAddress = ContactAddress::find($id);
        $contactAddress->delete();
        return redirect()->route('contact.address.index', $contactAddress['contact_id'])
                        ->with('success', 'Contact Address deleted successfully');
    }

    public function LoadAjaxFilterType(Request $request, $type) {
        $user_id = Auth::user()->id;
        if ($type == 0) {
//            $data = ContactsToContactType::where('is_deleted',null)->where('user_id',$user_id)->orderBy('id', 'DESC')->paginate(10);
            $data= $this->GetDataQuery();
            $types = ContactType::all()->pluck('name', 'id')->all();
            if ($request->ajax()) {
                return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadContactsWithTypeAll', ['data' => $data ,'types'=>$types ])->render();
            }
        } else {
            $data = ContactsToContactType::where('is_deleted',null)->where('user_id',$user_id)->where('contact_type_id',$type)->orderBy('id', 'DESC')->get();
        }

        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadContactsWithType', ['data' => $data])->render();
        }
    }

    public function filter(Request $request,$accountingNumber = null,$firstName = null,$companyName=null ,$phoneNumber = null , $pages=10){
        $user_id = Auth::user()->id;
              $ContactTypes = ContactType::all()->pluck('name', 'id')->all();

        if ($accountingNumber != -1){
            $data = ContactsToContactType::where('is_deleted',null)->where('user_id',$user_id)->where('display_id','=', "$accountingNumber")
                ->orderBy('id', 'desc')->get();
            if ($request->ajax()) {

                return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadContactsWithType', ['data' => $data])->render();
            }
        }else if($accountingNumber == -1&&$firstName==-1&&$companyName==-1&&$phoneNumber==-1){
          $data = ContactsToContactType::where('is_deleted',null)->where('user_id',$user_id)
              ->orderBy('id', 'desc')->get();
              if ($request->ajax()) {

                  return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadContactsWithType', ['data' => $data])->render();
                }
        }else{
            $data = DB::table('contacts_to_contact_types')->distinct()
            ->selectRaw("   contacts_to_contact_types.id,
                            contacts_to_contact_types.display_id as customer_display_id,
                            contacts_to_contact_types.contact_type_id,
                            con.first_name,
                            con.last_name,
                            con.company,
                                (SELECT
                                    contact_phones.phone_number
                                    FROM
                                    contact_phones
                                    WHERE
                                    contact_phones.contact_id = con.id and
                                    contact_phones.phone_number is not null
                                    LIMIT 1) as phone,
                            con.id as contact_id,
                            contact_addresses.city,
                             (
                             SELECT display_id
                             FROM contacts as conn
                             INNER JOIN contacts_to_contact_types ON contacts_to_contact_types.contact_id = conn.id
                             WHERE
                                  contacts_to_contact_types.contact_id = con.id AND
                                  contacts_to_contact_types.is_deleted IS NULL AND
                                  contacts_to_contact_types.user_id = $user_id AND
                                  contacts_to_contact_types.contact_type_id = 2
                             ) as supplier_display_id
                            "
            )
                ->join('contacts as con', 'contacts_to_contact_types.contact_id', '=', 'con.id')
                ->join('contact_phones', 'contact_phones.contact_id', '=', 'con.id')
                ->join('contact_addresses', 'contact_addresses.contact_id', '=', 'con.id')
                ->where('contacts_to_contact_types.is_deleted',NULL)
                ->where('contacts_to_contact_types.user_id',$user_id)
                ->where('contacts_to_contact_types.contact_type_id',1)
                ->where(function ($q) use ($firstName,$companyName,$phoneNumber){
                    if($firstName != -1 ){
                        if($companyName !=-1 && $phoneNumber != -1) {
                            $q->where('con.first_name','like',"%$firstName%")
                                ->orwhere('con.company','like',"%$companyName%")
                                ->orwhere('contact_phones.phone_number','like',"%$phoneNumber%");
                        }elseif($companyName !=-1){
                            $q->where('con.first_name','like',"%$firstName%")
                                ->orwhere('con.company','like',"%$companyName%");
                        }elseif($phoneNumber != -1){
                            $q->where('con.first_name','like',"%$firstName%")
                                ->orwhere('contact_phones.phone_number','like',"%$phoneNumber%");
                        }else{
                            $q->where('con.first_name','like',"%$firstName%");
                        }
                    }elseif($companyName != -1 || $phoneNumber !=-1){
                        if($companyName !=-1 && $phoneNumber != -1) {
                            $q->where('con.company','like',"%$companyName%")
                                ->orwhere('contact_phones.phone_number','like',"%$phoneNumber%");
                        }elseif($companyName !=-1){
                            $q->where('con.company','like',"%$companyName%");
                        }elseif($phoneNumber != -1){
                            $q->where('contact_phones.phone_number','like',"%$phoneNumber%");
                        }
                    }
                })
                ->orderBy('contacts_to_contact_types.display_id' , 'desc')
                ->get();
        }



        if ($request->ajax()) {
            return view($this->dashboardPath . '.' . $this->userType . '.' . $this->module . '.Ajax.LoadContactsWithTypeAll', ['data' => $data , 'types'=>$ContactTypes])->render();
        }
    }
}
