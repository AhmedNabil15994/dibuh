@extends(Config::get('front_theme').'.layouts.default')


@section('title',$page_title)

@section('page-styles')

    <link rel="stylesheet" type="text/css" href="plugins/select2/css/select2.min.css">
    <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">
    <!-- Custom box scc -->
    <link href="plugins/custombox/css/custombox.css" rel="stylesheet">


<style>
    thead tr th {text-align: center}
     .header-print{margin-top: 75px;}
    @media print {@page {size: landscape}
       .wrapper{padding-top: 0px !important}
        .header-print,.panel{margin-top: 0px; !important}
        .container{width: 100% !important}
        .page-panel .panel-body .pbody,.card-box{padding: 0px}
    }
  .dataTables_filter{
        display: none;
    }
   .select2-container[dir="rtl"] .select2-selection--single .select2-selection__rendered{
    font-size: 16px;
   }  
   #datatable_paginate{
        text-align: left;
    }
    .dataTables_wrapper .row:first-of-type .col-sm-6:first-of-type{
        float: left;
    } 
    #datatable_wrapper .row:last-of-type{
        margin-top: 30px;
    }
    .dataTables_filter{
        display: none;
    }
    .dataTables_length,
    .pagination{
        float: left;
    }
    table.table-bordered.dataTable th, table.table-bordered.dataTable td{
      border: 1px solid #ebeff2;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered{
      direction: rtl;
      font-size: 14px !important;
    }
    .select2-container--default .select2-search--dropdown .select2-search__field{
      direction: rtl;
    }
</style>
@endsection()


@section('subnav')
    @include(Config::get('front_theme').'.dashboard.'.$userType.'.report.inc.subnav')
@endsection




@section('content')





    <div class="row m-b-20 header-print" >
        <div class="col-xs-12 ">
            <h4 class="page-title">{{trans('frontend/reports.title')}}</h4>
            <p class="text-muted page-title-alt m-b-0">{{trans('frontend/reports.description')}}</p>
        </div>
    </div>






<div class="panel panel-default page-panel">

        <div class="panel-heading hidden-print">
            <div class="row">
                <div class="col-md-5 pull-right " style="padding: 0">
                    <button id="btnFilter" type="button" class="btn btn-default waves-effect waves-light pull-right" style="margin: 5px 5px;"><i class="md md-filter-list"></i>{{trans('button.filter')}}  </button>

                    <div class="btn-group pull-right export" style="margin-top: 5px;">
                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-upload"></i> {{trans('button.export')}}  <span class="caret"></span> </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                            <a> <?php $title=trans('frontend/reports.title').'.pdf'; ?>
                              {!!Form::open(['class'=>'PdfForm','route'=>'report.pdf']) !!}
                                 <button type="submit" id="pdfSubmit"  style="background:none;border:0;color:black margin-right:5px;">Pdf File </button>
                              {!! Form::hidden('tableContent',null,['id'=>'tableContent']) !!}
                              {!! Form::hidden('title',$title) !!}
                              {!! Form::close()!!}
                              </a>
                            </li>
                            <li><a href="{{route('report.excel')}}">Excel File</a></li>
                            <li><a href="{{route('report.csv')}}">Csv File</a></li>
                        
                        </ul>
                    </div>
                </div>

                <ul class="panel-nav pull-left">
<!--
                    <li><a class="active" id="state_all"    href="javascript:void(0)"  link="">الكل</a></li>
                    <li><a class="" id="status_Save"  href="javascript:void(0)"  link="">خزائن</a></li>
                    <li><a class="" id="status_Bank"    href="javascript:void(0)"  link="">بنوك</a></li>
-->
                </ul>

            </div>
        </div>



        <div class="panel-body">
            <div class="filter" style="display: none">
               <div class="row ">
                   <div class="col-md-2 col-xs-12">
                       <div class="form-group has-feedback ">
                           <label for="filterCustomer" class="control-label">{{trans('frontend/reports.account')}} :</label>
                           <select class="form-control" name="filterCustomer" id="filterCustomer">
                            @foreach($reports as $report)
                            <option value="{{$report->account_code}}">{{$report->account_code}} -- {{$report->name}}</option>
                            @endforeach
                           </select>
                       </div>
                   </div>
                   <div class="col-md-2 col-xs-12">
                       <div class="form-group has-feedback ">
                           <label for="year" class="control-label">{{trans('frontend/reports.year')}} :</label>
                           <input  class="form-control" type="text" name="filterStartdate" id="year" placeholder="yyyy" value="{{Carbon::now()->year}}">
                           <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                       </div>
                   </div>
                   <div class="col-md-2 col-xs-12">
                       <div class="form-group has-feedback ">
                           <label for="start-date" class="control-label">{{trans('frontend/reports.start_date')}} :</label>
                           <input  class="form-control" type="text" name="filterStartdate" id="start-date" placeholder="dd/mm" value="{{Carbon::now()->format('Y-m-d')}}">
                           <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                       </div>
                   </div>
                   <div class="col-md-2 col-xs-12">
                       <div class="form-group has-feedback ">
                           <label for="end-date" class="control-label">{{trans('frontend/reports.end_date')}} :</label>
                           <input class="form-control" type="text" name="filterenddate" id="end-date" placeholder="dd/mm" value="{{Carbon::now()->year}}-12-31" >
                           <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                       </div>
                   </div>
                   <div class="col-md-1 col-xs-12">
                       <div class="form-group-without-label">
                           <button type="button" id="search" class="btn btn-white waves-effect "><i class="fa fa-search" style="margin-left: 5px;"></i>{{trans('frontend/reports.search')}} </button>
                       </div>
                   </div>
                   <div class="col-md-2 col-xs-12">
                       <div class="form-group-without-label">
                           <button type="button" id="btnClearFilters" class="btn btn-white waves-effect ">{{trans('frontend/reports.clear')}} </button>
                       </div>
                   </div>
               </div>
            </div>
            <div class="pbody table-responsive">
                <div class="BoxContent card-box">
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
                                        $finance = App\Models\Finance_bank::where('user_id','=',Auth::user()->id)->where('serial_number','=',$report->receiver_code)->first();
                                        $name2 = $finance['account_owner'];
                                      }elseif ($report->finance_type == 2) {
                                        $fin_type= trans('frontend/reports.treasury');
                                        $finance = App\Models\Finance_treasury::where('user_id','=',Auth::user()->id)->where('serial_number','=',$report->receiver_code)->first();
                                        $name2 = $finance['treasury_name'];
                                      }elseif ($report->finance_type == 3) {
                                        $fin_type= trans('frontend/reports.credit');
                                        $finance = App\Models\Finance_credit::where('user_id','=',Auth::user()->id)->where('serial_number','=',$report->receiver_code)->first();
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
                </div>
            </div>
        </div>

    </div>



@endsection

@section('page-scripts')

  <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="plugins/select2/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>
    <script>
        var filtered = false;
        
       jQuery(document).ready(function($) {


             
            $('.demo-foo-filtering').DataTable({
                "order": [[ 1, "desc" ]]
            } );
            $('#start-date,#end-date').datepicker({
                autoclose: true,
                todayHighlight: true,
                 format : 'mm-dd',
              }).on('show', function() {
                  // remove the year from the date title before the datepicker show
                  var dateText  = $(".datepicker-days .datepicker-switch").text();
                  var dateTitle = dateText.substr(0, dateText.length - 5);
                  $(".datepicker-days .datepicker-switch").text(dateTitle);
            });
            $('#year').datepicker({
              autoclose: true,
              format: "yyyy",
              viewMode: "years", 
              minViewMode: "years"
            });
            

            $( "#btnFilter" ).click(function() {
                if($('.filter').css('display') == 'block' && filtered){
                    filtered = false;
                }
                $( ".filter" ).slideToggle(200);
            });

           $('#btnClearFilters').click(function () {
                $('#filterCustomer,#year,#start-date,#end-date').val('');
                $("#filterCustomer").val('').trigger('change')
               if (filtered){
                   filtered = false;
               }
           });

            

           $('#search').on('click', function() {
               filtered = true;
               code = $('select option:selected').val();
               from = $('#year').val() +"-"+ $('#start-date').val();
               to = $('#year').val() +"-"+ $('#end-date').val();
               var url = "{{Route('report.filter')}}" +
                       '/' + (code == '' ? '-1' :code) +
                       '/' + (from == null ? '-1' : from) +
                       '/' + (to == '' ? '-1' : to) ;
               var outerBox = '.page-panel';
               var Box = '.page-panel .BoxContent';
               var loaging = '<div id="overlayPagination" class="overlay overlay-x1"><i class="fa fa-spinner fa-pulse fa-fw" ></i></div>';
               $(outerBox + ' .btn').attr('disabled','disabled');
               $(Box + ' #overlayPagination').remove();
               $(Box).append(loaging);
               $.ajax({
                   url : url
               }).done(function (data) {
                   $(Box).html(data);
                   $('.CopyedPagination').html($('.NewPagination').html());
                   $('.BoxContent #overlayPagination').remove();
                   $(outerBox + ' .btn').removeAttr('disabled','disabled');
               }).fail(function () {
                   $('.BoxContent #overlayPagination').remove();
                   $('.BoxContent #overlayError').remove();
                   $(outerBox + ' .btn').removeAttr('disabled','disabled');
                   var error = '<div id="overlayError" class="alert alert-danger" style="margin: 0"><h4>خطأ في الاتصال<i class="fa fa-exclamation fa-fw"></i></h4><p>حدث خطأ اثناء الاتصال قد يكون انقطاع في الاتصال . حاول مرة اخري</p></div>';
                   $(Box).html(error);
               });
           });


           $("#filterCustomer").on("select2:open", function() {
               $(".select2-search__field").attr("placeholder", "بحث");
           });
           $("#filterCustomer").select2();
          
        });
       
    </script>

        <!-- Modal-Effect -->
        <script src="plugins/custombox/js/custombox.min.js"></script>

@endsection
