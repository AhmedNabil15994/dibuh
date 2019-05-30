<?php

namespace App\Http\Controllers\Backend;
//namespace App\Http\Controllers\Frontend\Dashboard\User;

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
use App\Models\Finance_bank;
use App\Models\SalesInvoiceItem;
use App\Models\Finance_treasury;
use App\Models\Finance_credit;
use App\Models\Installment;
use App\Models\Contact;
use App\Models\Salary;
use App\Models\Cost;
use App\Models\CostOther;
use App\Models\SalesInvoiceReturn;
use App\Models\AbstractInvoice;
use App\Models\OtherIncomeInvoice;
use DB;
use Hash;
use Config;
use Carbon;
use Auth;


use Illuminate\Contracts\Encryption\DecryptException;


class ClearDataController extends Controller {

    public function __construct()
    {
        $this->middleware('permission:user-list',   ['only' => ['show', 'index']]);
        $this->middleware('permission:user-create', ['only' => ['create']]);
        $this->middleware('permission:user-edit',   ['only' => ['edit']]);
        $this->middleware('permission:user-delete',   ['only' => ['destroy']]);
    }






    //delete data from tables
     public function accountDestroyTables(Request $request)
     {
      // ddd($request->all());
       $this->validate($request,[
         // 'email'=>'required',
         'contact_name'=>'required',
         'tables'=>'required'
       ]);

       $contact_id=$request->contact_name;
       $user_id=$request->user_id;

       // if(!count($request->tables))
       //      return response()->json(['success'=>'There are not tables']);
       foreach($request->tables as $table)
       {

         if($table=='sales_invoice_tables')
                ClearDataController::removeSalesInvoice($user_id,$contact_id);
          elseif($table=='contacts_customer_tables')
                 ClearDataController::removeContactsCustomer($user_id,$contact_id);
          elseif($table=='finance_banks_tables')
                 ClearDataController::removeFinanceBanks($user_id,$contact_id);
          elseif($table=='finance_treasury_tables')
                 ClearDataController::removeFinanceTreasures($user_id,$contact_id);
         elseif($table=='finance_credit_tables')
                 ClearDataController::removeFinanceCredits($user_id,$contact_id);
         elseif($table=='sales_invoice_return')
                ClearDataController::removeSalesInvoiceReturn($user_id,$contact_id);
         elseif($table=='abstract_invoice_tables')
                ClearDataController::removeAbstractInvoice($user_id,$contact_id);
         elseif($table=='other_income')
               ClearDataController::removeOtherIncome($user_id,$contact_id);
         elseif($table=='cost')
                ClearDataController::removeCost($user_id,$contact_id);
        elseif($table=='cost_other')
                ClearDataController::removeCostOther($user_id,$contact_id);
        elseif($table=='salary')
                 ClearDataController::removeSalary($user_id,$contact_id);




       }

       return response()->json(['success'=>'Tables Deleted successfully']);



     }
     public function removeSalesInvoice($user_id,$contact_id)
     {
           $sales_invoices=SalesInvoice::where('user_id',$user_id)->where('contact_id',$contact_id)->get();
           foreach($sales_invoices as $sale_invoice)
           {
             $sales_invoice_items=$sale_invoice->invoiceItems;
             $installments=Installment::where('sales_invoice_id',$sale_invoice->id)->get();

             foreach($sales_invoice_items as $sales_invoice_item)
                {
               $sales_invoice_item->delete();

               }
             foreach($installments as $installment)
             {
                  $installment->delete();

             }
           $sale_invoice->delete();
           }

           return 1;
     }
     public function removeFinanceBanks($user_id,$contact_id)
     {
           $finance_banks=Finance_bank::where('user_id',$user_id)->get();

           foreach($finance_banks as $bank)
           {
             $this->delete_installements($bank->id,1);
              $bank->delete();}
           return 1;
     }
     public function removeFinanceTreasures($user_id,$contact_id)
     {
           $finance_treasures=Finance_treasury::where('user_id',$user_id)->get();
           foreach($finance_treasures as $treasure)
           {
              $this->delete_installements($treasure->id,2);
              $treasure->delete();}
           return 1;
     }
     public function removeFinanceCredits($user_id,$contact_id)
     {
           $finance_credits=Finance_credit::where('user_id',$user_id)->get();
           foreach($finance_credits as $credit)
           {
             $this->delete_installements($credit->id,3);
             $credit->delete();}
           return 1;
     }
     //===delete installment for the finance
         public function delete_installements($id,$type) {


         //  $theInstallment=Installment::find($id);
           $installments=Installment::where('finance_id',$id)->where('finance_type',$type)->get();
            DB::beginTransaction();

            foreach($installments as $installment)
              {
                 $thesale_invoice=SalesInvoice::find($installment->sales_invoice_id);
                 $newRest=$thesale_invoice->rest+$installment->paid;
                 $thesale_invoice->rest=$newRest;
              if($newRest==$thesale_invoice->total_invoice)
                 $thesale_invoice->invoice_status_id=3;
              else
                 $thesale_invoice->invoice_status_id=5;
                 $thesale_invoice->save();
                 $installment->delete();

             }
               DB::commit();
            return 2;

         }
         //end delete installments
     public function removeAbstractInvoice($user_id,$contact_id)
     {
           $abstract_invoices=AbstractInvoice::where('user_id',$user_id)->where('contact_id',$contact_id)->get();
           foreach($abstract_invoices as $abstract_invoice)
           {
             $abstract_invoice_items=$abstract_invoice->abstractInvoiceItems;
             foreach($abstract_invoice_items as $abstract_invoice_item)
                {
               $abstract_invoice_item->delete();

               }
           $abstract_invoice->delete();
           }
           return 1;
     }//end abstract_invoices
     public function removeSalesInvoiceReturn($user_id,$contact_id)
        {
              $sales_invoice_returns=SalesInvoiceReturn::where('user_id',$user_id)->where('contact_id',$contact_id)->get();
              foreach($sales_invoice_returns as $sales_invoice_return)
              {
                $sales_invoice_return_items=$sales_invoice_return->sales_invoices_returnItems;
                foreach($sales_invoice_return_items as $item)
                   {
                    $item->delete();

                  }
              $sales_invoice_return->delete();
              }
              return 1;
        }
        public function removeOtherIncome($user_id,$contact_id)
        {
              $income_invoices=OtherIncomeInvoice::where('user_id',$user_id)->where('contact_id',$contact_id)->get();
              foreach($income_invoices as $income_invoice)
              {
                $income_invoices_items=$income_invoice->otherIncomeInvoiceItems;
                foreach($income_invoices_items as $item)
                   {
                     $item->delete();
                  }
              $income_invoice->delete();
              }
              return 1;
        }
        public function removeCost($user_id,$contact_id)
        {
              $costs=Cost::where('user_id',$user_id)->where('contact_id',$contact_id)->get();
              foreach($costs as $cost)
              {
                $cost_items=$cost->costItems;
                foreach($cost_items as $item)
                   {
                     $item->delete();
                  }
              $cost->delete();
              }
              return 1;
        }
        public function removeCostOther($user_id,$contact_id)
        {
              $other_costs=CostOther::where('user_id',$user_id)->where('contact_id',$contact_id)->get();
              foreach($other_costs as $other_cost)
              {
                $other_costs_items=$other_cost->costOtherItems;
                foreach($other_costs_items as $item)
                   {
                  $item->delete();

                  }
              $other_cost->delete();
              }
              return 1;
        }
        public function removeSalary($user_id,$contact_id)
        {
              $salaries=Salary::where('user_id',$user_id)->where('contact_id',$contact_id)->get();
              foreach($salaries as $salary)
              {
                $salary_items=$salary->salaryItems;
                foreach($salary_items as $item)
                   {
                  $item->delete();
                  }
              $salary->delete();
              }
              return 1;
        }


    //
    // public function searchEmail(Request $request){
    //
    //          if($request->ajax()){
    //
    //             $output = '';
    //             $emails = DB::table("users")->where('Email','LIKE','%'.$request->search.'%')
    //                                              ->get();
    //             }
    //             if($emails){
    //                 $i = 0;
    //                 foreach ($emails as $key => $value) {
    //                     $user_id = $value->id;
    //                     $roles    = \DB::table('role_user')->where('user_id','=',$user_id)->get();
    //                     $user_roles = [];
    //                     foreach ($roles as $key => $value4) {
    //                         $names = Role::where('id', '=' , $value4->role_id)->get();
    //                         foreach ($names as $key => $role_name) {
    //                             array_push($user_roles, $role_name->display_name);
    //                         }
    //                     }
    //
    //
    //
    //                     $output .=  "<form class='form".$value->id."' action='".route('admin::users.editUser',$value->id)."' method='get'>".
    //                                 "<tr class='tab-row".$value->id." selected_record'>".
    //                                     "<input type='hidden' class='user_id' name='user_id' value='".$value->id."'>".
    //                                     "<td>".++$i."</td>".
    //                                     "<td>".$value->email."</td>"."<td>";
    //
    //                         for ($x=0; $x < count($user_roles); $x++) {
    //                              $output .= "<label class='label' style='margin-right:5px;'>".$user_roles[$x]."</label>";
    //                         }
    //                     $output .="</td>"."<td>".
    //                                 "<button type='button' name='delete' class='btn btn-danger btn-xs  delete' value='".$value->id."' alt='". trans('button.delete')."'>"."<i class='fa fa-trash'></i> ". trans('button.delete') ."</button>".
    //                                 "</td>".
    //                             "</tr>".
    //                         "</form>";
    //
    //
    //                }
    //             return Response($output);
    //             }else{
    //                 $msg = 'No result are found';
    //                 return Response("<div class='row' style='margin:0;padding:0;'>".$msg."</div>");
    //             }
    // }



    //
    // public function editUser(Request $req){
    //
    //
    //     $data = User::where('id' , '=' , $req->user_id)->get();
    //     $user_id=$req->user_id;
    //     $roles = Role::orderBy('id','ASC')->get();
    //     $tables=array('sales_invoice_tables'=>'sales_invoice_tables','contacts_customer_tables'=>'contacts_customer_tables',
    //                   'finance_banks_tables'=>'finance_banks_tables','finance_treasury_tables'=>'finance_treasury_tables');
    //
    //     $contact_names=Contact::where('user_id',$user_id)->get(['first_name','last_name','id'])->pluck('full_name','id');
    //     return view(Config::get('back_theme') . '.users.edituser', compact('data','roles','tables','contact_names','user_id'));
    //
    // }






}
