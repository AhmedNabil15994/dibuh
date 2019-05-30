<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;
//namespace App\Http\Controllers;
use App\Models\ContactsToContactType;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\currency_table;
use App\Http\Controllers\Frontend\Dashboard\DashboardBaseController;
use Auth;
use App\Models\User;
use App\Models\UserProfile As Profile;
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
use App\Models\ContactType;
use Config;
use Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use View;
use PDF;
use Mpdf;
use Excel;
use App\Models\TaxSalesInvoiceItem;
use Illuminate\Contracts\Encryption\DecryptException;
//require_once __DIR__ . '/vendor/autoload.php';

class ExportFilesController extends DashboardBaseController {

    protected $userType = 'user';
    protected $module = 'sales_invoice';

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
        $this->data['page_title'] = trans('frontend/sales_invoice.title');

        return $this->view($this->userType . '.' . $this->module . '.' . 'main', $this->data);
    }



      public function export_pdf(Request $request) {



            $user_id = Auth::user()->id;
            $this->data['page_title'] = trans('frontend/sales_invoice.title');
            $data = SalesInvoice::where('user_id' , $user_id)->orderBy('invoice_number', 'DESC')->get(['invoice_status_id','invoice_number','contact_name','invoice_date','delivery_date','total_discount','total_amount']);
            $this->data['data']=$data;
            //////////////
             $path='frontend.u_bold.dashboard.user.sales_invoice.pdf_table';
            //dd($request->tableContent);
           $css="<style>body{direction:rtl;  text-align:right;  } .table{display:none;}</style>";
           $pdf = PDF::loadHtml($css.$request->tableContent,'utf-8');
           $pdf->download($request->title);

          }

      public function export_excel() {
          $user_id = Auth::user()->id;
          $this->data['page_title'] = trans('frontend/sales_invoice.title');
          $data = SalesInvoice::where('user_id' , $user_id)->orderBy('invoice_number', 'DESC')->get(['invoice_status_id','invoice_number','contact_name','invoice_date','delivery_date','total_discount','total_amount']);

        $dataArray[] = [trans('frontend/sales_invoice.status'), trans('frontend/sales_invoice.invoice_number'),trans('frontend/sales_invoice.customer')
                       ,trans('frontend/sales_invoice.date'),trans('frontend/sales_invoice.received_date'),trans('frontend/sales_invoice.discount'),trans('frontend/sales_invoice.final_cost')];
      $title=trans('frontend/sales_invoice.title');
       foreach ($data as $d) {
            if($d->invoice_status_id!=0)
            {
              if($d->invoice_status_id=="1")
                    $d->invoice_status_id=trans('frontend/sales_invoice.status_Draft');
             elseif($d->invoice_status_id=="2")
                  $d->invoice_status_id=trans('frontend/sales_invoice.status_Unpaid');
             elseif($d->invoice_status_id=="3")
                    $d->invoice_status_id=trans('frontend/sales_invoice.status_Due');
             elseif($d->invoice_status_id=="4")
                      $d->invoice_status_id=trans('frontend/sales_invoice.status_Paid');
              elseif($d->invoice_status_id=="5")
                $d->invoice_status_id=trans('frontend/sales_invoice.status_Partly_Paid');

            }
               $dataArray[] = $d->toArray();
          }
        Excel::create($title, function($excel) use($dataArray) {

            $excel->sheet('Excel sheet', function($sheet) use($dataArray) {
              $sheet->fromArray($dataArray, null, 'A1', false, false);

            if (Config::get('app.locale')=="ar") {
            }  $sheet->setRightToLeft(true);

            $sheet->setOrientation('portrait');

          });
          ob_end_clean(); ob_start();
        })->export('xls');


    }
    public function export_csv() {
              //  $path='frontend.u_bold.dashboard.user.'. $this->module . '.' . 'pdf';

               $user_id = Auth::user()->id;

              $data = SalesInvoice::where('user_id' , $user_id)->orderBy('invoice_number', 'DESC')->get(['invoice_status_id','invoice_number','contact_name','invoice_date','delivery_date','total_discount','total_amount']);
              $dataArray[] = ['الحاله ',' رقم الفاتوره ',' العميل ',' التاريخ ',' تاريخ الاستلام ',' الخصم ','المبلغ الصافى '];
              $title=trans('frontend/sales_invoice.title');
              foreach ($data as $d) {
                   if($d->invoice_status_id!=0)
                   {
                     if($d->invoice_status_id=="1")
                           $d->invoice_status_id=trans('frontend/sales_invoice.status_Draft');
                    elseif($d->invoice_status_id=="2")
                         $d->invoice_status_id=trans('frontend/sales_invoice.status_Unpaid');
                    elseif($d->invoice_status_id=="3")
                           $d->invoice_status_id=trans('frontend/sales_invoice.status_Due');
                    elseif($d->invoice_status_id=="4")
                             $d->invoice_status_id=trans('frontend/sales_invoice.status_Paid');
                     elseif($d->invoice_status_id=="5")
                       $d->invoice_status_id=trans('frontend/sales_invoice.status_Partly_Paid');

                   }
                      $dataArray[] = $d->toArray();
                 }

            Excel::create($title, function($excel) use($dataArray) {
                  $excel->sheet('Excel sheet', function($sheet) use($dataArray) {
                  $sheet->fromArray($dataArray, null, 'A1', false, false);
                    $sheet->setOrientation('landscape');

           });
       ob_end_clean(); ob_start();
         })->download('csv');

              }
      public function export_html() {
                           $user_id = Auth::user()->id;
                           $title=trans('frontend/sales_invoice.title');
                           $data = SalesInvoice::where('user_id' , $user_id)->orderBy('invoice_number', 'DESC')->get(['invoice_status_id','invoice_number','contact_name','invoice_date','delivery_date','total_discount','total_amount']);
                           $dataArray[] = [trans('frontend/sales_invoice.status'), trans('frontend/sales_invoice.invoice_number'),trans('frontend/sales_invoice.customer')
                                       ,trans('frontend/sales_invoice.date'),trans('frontend/sales_invoice.received_date'),trans('frontend/sales_invoice.discount'),trans('frontend/sales_invoice.final_cost')];

                                       foreach ($data as $d) {
                                            if($d->invoice_status_id!=0)
                                            {
                                              if($d->invoice_status_id=="1")
                                                    $d->invoice_status_id=trans('frontend/sales_invoice.status_Draft');
                                             elseif($d->invoice_status_id=="2")
                                                  $d->invoice_status_id=trans('frontend/sales_invoice.status_Unpaid');
                                             elseif($d->invoice_status_id=="3")
                                                    $d->invoice_status_id=trans('frontend/sales_invoice.status_Due');
                                             elseif($d->invoice_status_id=="4")
                                                      $d->invoice_status_id=trans('frontend/sales_invoice.status_Paid');
                                              elseif($d->invoice_status_id=="5")
                                                $d->invoice_status_id=trans('frontend/sales_invoice.status_Partly_Paid');

                                            }
                                               $dataArray[] = $d->toArray();
                                          }

                         Excel::create($title, function($excel) use($dataArray) {
                               $excel->setTitle('Invoices');
                               $excel->sheet('Excel sheet', function($sheet) use($dataArray) {
                               $sheet->fromArray($dataArray, null, 'A1', false, false);
                                 $sheet->setOrientation('landscape');

                        });

                      })->download('html');


                        }
            ////Export files in Costs
            public function cost_export_pdf(){
              $path='frontend.u_bold.dashboard.user.cost.pdf_table';
              $user_id=Auth::user()->id;
              $this->data['page_title'] = trans('frontend/cost.create_edit');
              $this->data['data'] = Cost::where('user_id' , $user_id)->orderByRaw("FIELD(invoice_status_id , '2', '3', '5' ,'4') ASC")->get();


              $pdf = PDF::loadView($path, $this->data,[], [
                        'format' => 'A4-M'
                      ]);

             return $pdf->download('Costs.pdf');

            }
            //export excel
            public function cost_export_excel(){
              $user_id = Auth::user()->id;
              $this->data['page_title'] = trans('frontend/cost.title');
            //  $data = Cost::where('user_id' , $user_id)->orderByRaw("FIELD(invoice_status_id , '2', '3', '5' ,'4') ASC")->get();

              $data = Cost::where('user_id' , $user_id)->orderBy('invoice_number', 'DESC')->get(['invoice_status_id','invoice_number','contact_name','invoice_date','delivery_date','total_discount','total_amount']);

            $dataArray[] = [trans('frontend/sales_invoice.status'), trans('frontend/sales_invoice.invoice_number'),trans('frontend/sales_invoice.customer')
                           ,trans('frontend/sales_invoice.date'),trans('frontend/sales_invoice.received_date'),trans('frontend/sales_invoice.discount'),trans('frontend/sales_invoice.final_cost')];
          $title=trans('frontend/cost.title');
           foreach ($data as $d) {
                if($d->invoice_status_id!=0)
                {
                  if($d->invoice_status_id=="1")
                        $d->invoice_status_id=trans('frontend/sales_invoice.status_Draft');
                 elseif($d->invoice_status_id=="2")
                      $d->invoice_status_id=trans('frontend/sales_invoice.status_Unpaid');
                 elseif($d->invoice_status_id=="3")
                        $d->invoice_status_id=trans('frontend/sales_invoice.status_Due');
                 elseif($d->invoice_status_id=="4")
                          $d->invoice_status_id=trans('frontend/sales_invoice.status_Paid');
                  elseif($d->invoice_status_id=="5")
                    $d->invoice_status_id=trans('frontend/sales_invoice.status_Partly_Paid');

                }
                   $dataArray[] = $d->toArray();
              }

            Excel::create($title, function($excel) use($dataArray) {

                $excel->sheet('Excel sheet', function($sheet) use($dataArray) {
                  $sheet->fromArray($dataArray, null, 'A1', false, false);

                if (Config::get('app.locale')=="ar") {
                }  $sheet->setRightToLeft(true);

                $sheet->setOrientation('portrait');

              });
              ob_end_clean(); ob_start();
            })->export('xls');

            }
            //export csv in cost
            public function cost_export_csv() {
                      $user_id = Auth::user()->id;
                      $data = Cost::where('user_id' , $user_id)->orderBy('invoice_number', 'DESC')->get(['invoice_status_id','invoice_number','contact_name','invoice_date','delivery_date','total_discount','total_amount']);
                      $dataArray[] = ['الحاله ',' رقم الفاتوره ',' العميل ',' التاريخ ',' تاريخ الاستلام ',' الخصم ','المبلغ الصافى '];
                      $title=trans('frontend/cost.title');
                      foreach ($data as $d) {
                           if($d->invoice_status_id!=0)
                           {
                             if($d->invoice_status_id=="1")
                                   $d->invoice_status_id=trans('frontend/sales_invoice.status_Draft');
                            elseif($d->invoice_status_id=="2")
                                 $d->invoice_status_id=trans('frontend/sales_invoice.status_Unpaid');
                            elseif($d->invoice_status_id=="3")
                                   $d->invoice_status_id=trans('frontend/sales_invoice.status_Due');
                            elseif($d->invoice_status_id=="4")
                                     $d->invoice_status_id=trans('frontend/sales_invoice.status_Paid');
                             elseif($d->invoice_status_id=="5")
                               $d->invoice_status_id=trans('frontend/sales_invoice.status_Partly_Paid');

                           }
                              $dataArray[] = $d->toArray();
                         }

                    Excel::create($title, function($excel) use($dataArray) {
                          $excel->sheet('Excel sheet', function($sheet) use($dataArray) {
                          $sheet->fromArray($dataArray, null, 'A1', false, false);
                            $sheet->setOrientation('landscape');

                   });
               ob_end_clean(); ob_start();
                 })->download('csv');

                      }
        //export files in finance

        public function finance_export_pdf(){
          $path='frontend.u_bold.dashboard.user.finance.pdf_table';
          $this->data['data'] = ExportFilesController::finance_array();
          $pdf = PDF::loadView($path, $this->data,[], [
                    'format' => 'A4-M'
                  ]);
         return $pdf->download('Costs.pdf');
        }
        //export excel
       public function finance_export_excel(){
          $user_id = Auth::user()->id;
          $this->data['page_title'] = trans('frontend/finance.title');
          $data = ExportFilesController::finance_array();
          $dataArray[] = ["النوع", "تاريخ الافتتاح"," إسم الخزنه أو الحساب "    ,"رقم الحساب","الرصيد الحالى ","العمله "];
         $title=trans('frontend/finance.title');
       foreach ($data as $d) {
               $dataArray[] = $d;
          }
      //    dd($dataArray);
        Excel::create($title, function($excel) use($dataArray) {
            $excel->sheet('Excel sheet', function($sheet) use($dataArray) {
              $sheet->fromArray($dataArray, null, 'A1', false, false);
            if (Config::get('app.locale')=="ar") {
            }  $sheet->setRightToLeft(true);
            $sheet->setOrientation('portrait');
          });
          ob_end_clean(); ob_start();
        })->export('xls');
        }

        //export csv in finance
        public function finance_export_csv() {
                  $user_id = Auth::user()->id;
                  $data = ExportFilesController::finance_array();
                  $dataArray[] = ["النوع", "تاريخ الافتتاح"," إسم الخزنه أو الحساب "    ,"رقم الحساب","الرصيد الحالى ","العمله "];
                  $title=trans('frontend/finance.title');
                  foreach ($data as $d) {
                          $dataArray[] = $d;
                     }
                Excel::create($title, function($excel) use($dataArray) {
                      $excel->sheet('Excel sheet', function($sheet) use($dataArray) {
                      $sheet->fromArray($dataArray, null, 'A1', false, false);
                        $sheet->setOrientation('landscape');
               });
           ob_end_clean(); ob_start();
             })->download('csv');

           }

           public function finance_array()
           {
             $user_id=Auth::user()->id;
             $currency = currency_table::all()->pluck('name', 'id')->all();
             $this->data['page_title'] = trans('frontend/cost.create_edit');
             //$this->data['data'] = Cost::where('user_id' , $user_id)->orderByRaw("FIELD(invoice_status_id , '2', '3', '5' ,'4') ASC")->get();
             $finance_banks = Finance_bank::where('user_id' , $user_id)
                 ->get(['id','account_owner as owner_name','serial_number' , 'bank_balance as balance' , 'currency_id' ,'start_date as start_date']);

             $finance_treasury = Finance_treasury::where('user_id' , $user_id)
                 ->get(['id','treasury_name as owner_name','serial_number' , 'start_balance as balance','currency_id' ,'start_date as start_date']);

             $finance_credit = Finance_credit::where('user_id' , $user_id)
                 ->get(['id','credit_owner as owner_name','serial_number' , 'credit_balance as balance' ,'credit_start_date as start_date']);

             $arr=[];
             foreach ($finance_banks as $bank){
                 $arr[] = [
                     'type'           =>trans('frontend/sales_invoice.bank_type'),
                     'start_date'   => $bank->start_date,
                     'owner_name'   => $bank->owner_name,
                     'serial_number'=> $bank->serial_number,
                     'balance'      => $bank->balance,
                     'currency'     => $currency[$bank->currency_id],
                     'id'          =>$bank->id,
                     'type_id'    =>1

                 ];
             }
             foreach ($finance_treasury as $treasury){
                 $arr[] = [
                     'type'           =>trans('frontend/sales_invoice.treasury_type'),
                     'start_date'   => $treasury->start_date,
                     'owner_name'   => $treasury->owner_name,
                     'serial_number'=> $treasury->serial_number,
                     'balance'      => $treasury->balance,
                     'currency'     => $currency[$treasury->currency_id],
                      'id'          =>$treasury->id,
                      'type_id'    =>2


                 ];
             }
             foreach ($finance_credit as $credit){
                 $arr[] = [
                     'type'           => trans('frontend/sales_invoice.credit_type'),
                     'start_date' => $credit->start_date,
                     'owner_name'   => $credit->owner_name,
                     'serial_number'=> $credit->serial_number,
                     'balance'      => $credit->balance,
                     'currency'     =>$currency[$credit->currency_id],
                     'id'          =>$credit->id,
                     'type_id'    =>3


                 ];
             }
             return $arr;
           }
           ///////////Export files in contacts
           public function contact_export_pdf(){
             $path='frontend.u_bold.dashboard.user.contact.pdf_table';
             $this->data['data'] = $this->GetDataQuery();
             $this->data['types'] = ContactType::all()->pluck('name', 'id')->all();
             $pdf = PDF::loadView($path, $this->data,[], [
                       'format' => 'A4-M'
                     ]);
            return $pdf->download('Contacts.pdf');
           }
           //export excel
          public function contact_export_excel(){
             $user_id = Auth::user()->id;
             $this->data['page_title'] = trans('frontend/contact.titlepage');
             $data = $this->GetDataQuery();
             $types = ContactType::all()->pluck('name', 'id')->all();
            // $dataArray[] = ["النوع", "تاريخ الافتتاح"," إسم الخزنه أو الحساب "    ,"رقم الحساب","الرصيد الحالى ","العمله "];
             $dataArray[]=["رقم العميل ","رقم المورد ","نوع العميل ","الأسم الاول ","الاسم الاخير ","إسم الشركه ","المدينه "," رقم التليفون "];
            $title=trans('frontend/contact.titlepage');
        //    dd($types);
          foreach ($data as $d) {
            $customer_id=$d->customer_display_id;
            $supplier_id=$d->supplier_display_id;
            $phone=$d->phone;
            $type=$d->contact_type_id;
            if($customer_id==$supplier_id)
               $customer_id=" ليس عميل";
            if($supplier_id==null)
                $supplier_id="ليس مورد";
            if($phone==null)
               $phone="لا يوجد رقم";
            if($d->customer_display_id !=null && $d->supplier_display_id !=null && $d->customer_display_id != $d->supplier_display_id )
                $type="عميل |مورد ";
            else
              $type=$types[$d->contact_type_id];


                  $dataArray[] = [$customer_id,$supplier_id,$type,$d->first_name,$d->last_name,$d->company,$d->city,$phone];
             }
          //  dd($dataArray);
           Excel::create($title, function($excel) use($dataArray) {
                $excel->sheet('Excel sheet', function($sheet) use($dataArray) {
                 $sheet->fromArray($dataArray, null, 'A1', false, false);
                  if (Config::get('app.locale')=="ar") {
                      }  $sheet->setRightToLeft(true);
                         $sheet->setOrientation('portrait');
                 });
             ob_end_clean(); ob_start();
           })->export('xls');
           }

           //export csv in contact
           public function contact_export_csv(){
              $user_id = Auth::user()->id;
              $this->data['page_title'] = trans('frontend/contact.titlepage');
              $data = $this->GetDataQuery();
              $types = ContactType::all()->pluck('name', 'id')->all();
             // $dataArray[] = ["النوع", "تاريخ الافتتاح"," إسم الخزنه أو الحساب "    ,"رقم الحساب","الرصيد الحالى ","العمله "];
              $dataArray[]=["رقم العميل ","رقم المورد ","نوع العميل ","الأسم الاول ","الاسم الاخير ","إسم الشركه ","المدينه "," رقم التليفون "];
             $title=trans('frontend/contact.titlepage');
         //    dd($types);
           foreach ($data as $d) {
             $customer_id=$d->customer_display_id;
             $supplier_id=$d->supplier_display_id;
             $phone=$d->phone;
             $type=$d->contact_type_id;
             if($customer_id==$supplier_id)
                $customer_id=" ليس عميل";
             if($supplier_id==null)
                 $supplier_id="ليس مورد";
             if($phone==null)
                $phone="لا يوجد رقم";
             if($d->customer_display_id !=null && $d->supplier_display_id !=null && $d->customer_display_id != $d->supplier_display_id )
                 $type="عميل |مورد ";
             else
               $type=$types[$d->contact_type_id];


                   $dataArray[] = [$customer_id,$supplier_id,$type,$d->first_name,$d->last_name,$d->company,$d->city,$phone];
              }
           //  dd($dataArray);
           Excel::create($title, function($excel) use($dataArray) {
                 $excel->sheet('Excel sheet', function($sheet) use($dataArray) {
                 $sheet->fromArray($dataArray, null, 'A1', false, false);
                   $sheet->setOrientation('landscape');
                        });
                  ob_end_clean(); ob_start();
                   })->download('csv');
               }
              protected function GetDataQuery(){
              $user_id =Auth::user()->id;
              $data = DB::table('contacts_to_contact_types as contype')->distinct()//contact_phones.phone_number,
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











    //=========================================================
    //Helper methods
    //=========================================================
}
