<table class="table table-hover table-bordered demo-foo-filtering" id="demo-foo-filtering" data-page-size="6">
                        <thead>
                            <tr>
                                <th>{{trans('frontend/reports.name')}}</th>
                                <th>{{trans('frontend/reports.date')}}</th>
                                <th>{{trans('frontend/reports.desc')}}</th>
                                <th>{{trans('frontend/reports.type')}}</th>
                                <th>{{trans('frontend/reports.amount')}}</th>
                                <th>{{trans('frontend/reports.type1')}}</th>
                                <th>{{trans('frontend/reports.type2')}}</th>
                            </tr>
                        </thead>
                        <div class="tableBody">
                          <tbody>
                                @foreach($data as $report)
                                <tr>                                   
                                  <?php
                                    $type = '';
                                    $inv  = '';
                                    $fin_id ='';
                                    $fin_type ='';
                                    $invoice_number = '';
                                    $fullname = $report->account_code ." -- ". $fin_type." ". $report->name;
                                    $fullname2='';
                                    $name2 = '';
                                    if($report->finance_id == 0 ){

                                    }else{
                                      if($report->finance_type == 1){
                                        $fin_type= trans('frontend/reports.bank');
                                        $finance = App\Models\Finance_bank::where('serial_number','=',$report->receiver_code)->first();
                                        $name2 = $finance['account_owner'];
                                      }elseif ($report->finance_type == 2) {
                                        $fin_type= trans('frontend/reports.treasury');
                                        $finance = App\Models\Finance_treasury::where('serial_number','=',$report->receiver_code)->first();
                                        $name2 = $finance['treasury_name'];
                                      }elseif ($report->finance_type == 3) {
                                        $fin_type= trans('frontend/reports.credit');
                                        $finance = App\Models\Finance_credit::where('serial_number','=',$report->receiver_code)->first();
                                        $name2 = $finance['credit_owner'];
                                      }
                                    }
                                    if($report->invoice_type == 1){
                                      $type = "(".trans('frontend/dashboard.invoices').")";
                                      $inv = trans('frontend/reports.invoice_number');
                                      $invoice_number = $report->invoice_number;
                                    }elseif ($report->invoice_type == 2) {
                                      $type = "(".trans('frontend/dashboard.abstracts').")";
                                      $inv = trans('frontend/reports.invoice_number');
                                      $invoice_number = $report->invoice_number;
                                    }elseif ($report->invoice_type == 3) {
                                      $type = "(".trans('frontend/dashboard.revenue_other').")";
                                      $$inv = trans('frontend/reports.invoice_number');
                                      $invoice_number = $report->invoice_number;
                                    }elseif ($report->invoice_type == 4) {
                                      $type = "(".trans('frontend/sales_invoice.purchase').")";
                                      $inv = trans('frontend/reports.invoice_number');
                                      $invoice_number = $report->invoice_number;
                                    }elseif ($report->invoice_type == 5) {
                                      $type = "(".trans('frontend/sales_invoice.expenses').")";
                                      $inv = trans('frontend/reports.invoice_number');
                                      $invoice_number = $report->invoice_number;
                                    }elseif ($report->invoice_type == 6) {
                                      $type = "(".trans('frontend/sales_invoice.bills_return').")";
                                      $inv = trans('frontend/reports.invoice_number');
                                      $invoice_number = $report->invoice_number;
                                    }elseif ($report->invoice_type == 7) {
                                      $type = "(".trans('frontend/sales_invoice.salaries').")";
                                      $inv = trans('frontend/reports.invoice_number');
                                      $invoice_number = $report->invoice_number;
                                    }elseif ($report->invoice_number == 0) {
                                      if($report->receiver_code == 0 || $report->receiver_code == $report->account_code){
                                          $invoice_number = "-----";
                                      }else{
                                          $invoice_number = "-----";

                                          $fullname2 = $report->receiver_code.' -- '.$name2;
                                      }
                                    }
                                  ?>
                                  
                                  <td>{{$fullname}}</td>
                                  <td>{{ Carbon\Carbon::parse($report->created_at)->format('Y-m-d')}}</td>
                                  <td>{{$inv}} {{$invoice_number}}</td>
                                  <td>
                                  @if($fullname2 == '')
                                    {{$report->deal_type}} {{$type}}
                                  @else
                                    <div>{{$report->deal_type}} {{trans('frontend/reports.from')}}{{$fullname}}</div> 
                                    <div>{{trans('frontend/reports.to')}}{{$fullname2}}</div>
                                  @endif
                                  </td>
                                  <td>{{$report->amount}}</td>
                                  <td>{{$report->debtor}}</td>
                                  <td>{{$report->creditor}}</td>
                                
                                </tr>
                                @endforeach
                          </tbody>

                        </div>



                    </table>
                    @if(!count($data))
                        <style type="text/css">
                            tbody,
                            .pbody .dataTables_wrapper .row:last-of-type,
                            .pbody .dataTables_wrapper .row:first-of-type{
                                display: none;
                            }
                            .table-condensed tbody{
                                display: table-header-group;
                            }
                        </style>
                        <div id="overlayError">
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-xs-6 text-right">
                                    <img style="width: 120px;" src="images/filter.svg">
                                </div>
                                <div class="col-xs-6">
                                    <div class="callout callout-info" style="margin-top: 50px;">
                                        <h4>لا يوجد نتائج <i class="fa fa-exclamation fa-fw"></i></h4>
                                        <p>لا يوجد نتائج مطابقه الان</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif 


                    <script type="text/javascript">
                      $(function(){
                        $('.demo-foo-filtering').DataTable({
                              "order": [[ 1, "desc" ]]
                          } );
                      });
                    </script>