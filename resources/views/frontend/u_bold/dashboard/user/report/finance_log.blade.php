@extends(Config::get('front_theme').'.layouts.default')


@section('title',$page_title)

@section('page-styles')

    <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">

    <style>
    thead tr th , tbody tr td{text-align: center}
    tbody tr td a {display:block !important;vertical-align: middle;margin-bottom:5px;color:#797979;    font-weight: 500;
    -webkit-transition: color .2s ease-in-out ;
    -moz-transition: color .2s ease-in-out ;
    transition: color .2s ease-in-out ;}
    tbody tr td a:hover{
        color:#111;
    }
     .header-print{margin-top: 75px;}

    @media print {@page {size: landscape}
       .wrapper{padding-top: 0px !important}
        .header-print,.panel{margin-top: 0px; !important}
        .container{width: 100% !important}
        .page-panel .panel-body .pbody,.card-box{padding: 0px}
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
    #navigation{
        position:relative !important;
    }



    @media (max-width:690px){
        .subnav li a{
            padding-left:6px !important;
            padding-right:6px !important;
         /*content:none !important;*/
     }
    }
    @media (max-width:611px){
        .subnav{

        /*display:inline-flex;*/
    }
    .subnav li {
        float:right !important;
        width:25%;
     }
      .subnav li a:before{
         content:none !important;
     }
        .subnav li a{
           font-size:13px !important;
         /*content:none !important;*/
     }
    }
    .col-sm-5{
        display:inline-block;
        text-align:right;
        width:40%;
    }


    .col-sm-7 {
    padding:0;
    width: 60%;
    vertical-align: top;

    display: inline-block;
    }
    @media(max-width: 767px){
        form .btn-danger{
            display: inline-block;
        }
        table td , table th{
            width: 150px !important;
        }
        .page-panel .panel-body .pbody .table > thead > tr > th{
            width: 150px !important;
        }
        .page-panel .panel-body .pbody .table>tbody>tr>td{
            width: 150px !important;
        }
    }

    .show-filter{
    padding-top: 5px;
    padding-bottom: 8px;

    }

    .detail-btn{
        width:auto;
        margin-bottom:5px;
    }

        .btns{
            padding-top:6px;
        }
        tbody td:last-child{
            padding: 0;
    text-align: center;
    margin-top:5px;
        }

      .table{
          width:100%;
      }
      .tabel thead
      {
    font-size: 11px;

      }
      .entries{
        padding-top: 15px;

      }

      .table >thead > tr > th , .table >tbody> tr > td{
          text-align:center !important;
      }
    /*mobile responsive */
    @media (max-width:768px){

        .table > thead >tr>th{
        font-size:11px;
        padding-left: 0;

      }
      .table > tbody > tr > td{
          font-size: 13px;
      }



    }



     @media (max-width:552px){
      .page-panel .panel-heading  ul.panel-nav li .al {
            font-size:13px;
        padding-right:6px !important;
      padding-left:6px !important;

          }
          .btns a , .btns form button {
              font-size:11px !important;
          }
          .table > thead >tr>th{
        font-size:10px;
        padding-right:0!important;
        padding-left:0 !important;

      }
      .table > tbody > tr > td{
padding-right:0!important;
        padding-left:0 !important;
                  font-size: 12px;
      }

      #btnFilter ,.pull-right .export button{
            padding: 4px 6px !important;

      }

    #demo-foo-filtering_info , #demo-foo-filtering_paginate{
        font-size:12px;
    }
    .pagination li a {
        padding:6px;
    }
    }

    @media (max-width:465px){
        .page-panel .panel-heading  ul.panel-nav li .al {
            font-size:12px;

            padding-right:4px !important;
      padding-left:4px !important;


        }
        .btns a , .btns form button {
              font-size:10px !important;
          }


          .table > thead >tr>th{
        font-size:9px;

      }
      .table > tbody > tr > td{
          text-align:center;
          font-size: 11px;
      }

            #btnFilter ,.pull-right .export button{
            padding: 2px 4px !important;

      }
    }


    @media (max-width:410px){
        .col-sm-5{
        font-size:12px !important;
    }


    .col-sm-7 {
        font-size:12px !important;
    }
        .page-panel .panel-heading  ul.panel-nav li  .al {
            font-size:10px;

        }

    }


    @media (max-width:359px){
         .col-sm-5{
        font-size:11px !important;
    }


    .col-sm-7 {
        font-size:11px !important;
    }
        .page-panel .panel-heading  ul.panel-nav li  .al {
            font-size:9px;

        }
        #demo-foo-filtering_info , #demo-foo-filtering_paginate{
        font-size:10px;
    }


    }

    @media (max-width:335px){
        .page-panel .panel-heading  ul.panel-nav li  .al {
            /*font-size:9px;*/

            padding-right:3px !important;
      padding-left:3px !important;
        }

}


    </style>
@endsection()


@section('subnav')
    @include(Config::get('front_theme').'.dashboard.'.$userType.'.report.inc.subnav')
@endsection




@section('content')





    <div class="row m-b-5 header-print" >
        <div class="col-xs-12 ">
        </div>
    </div>

    <div class="panel panel-default page-panel">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-5 pull-right " style="padding: 0">

                    <button id="btnFilter" type="button" class="btn btn-default waves-effect waves-light pull-right" style="margin: 0 5px;"><i class="md md-filter-list"></i>{{trans('button.filter')}}  </button>

                    <div class="btn-group pull-right export">
                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-upload"></i> {{trans('button.export')}}  <span class="caret"></span> </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">PDF File</a></li>
                            <li><a href="#">Excel File</a></li>
                            <li><a href="#">Csv File</a></li>
                            <li><a href="#">Html File</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="panel-nav pull-left">
                    <li><a class="active" href="{{route('log.index')}}">{{trans('frontend/dashboard.finance')}}</a></li>
                    <li><a class="" href="{{route('log.income')}}">{{trans('frontend/dashboard.invoices')}}</a></li>
                    <li><a href="{{route('log.contact')}}">{{trans('frontend/dashboard.contact_manager')}}</a></li>
                    <li><a href="{{route('log.tax')}}">{{trans('frontend/dashboard.taxes')}}</a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
          <div class="filter" style="display: none">
               <div class="row ">
                  
                  <div class="col-md-2 col-xs-12">
                      <div class="form-group has-feedback ">
                          <label for="filterFinanceDate1" class="control-label">من :</label>
                          <input class="form-control date_range_filter" type="text" name="start_date" id="start_date">
                          <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                      </div>
                  </div>

                  <div class="col-md-2 col-xs-12">
                    <div class="form-group has-feedback ">
                          <label for="filterFinanceDate2" class="control-label">الي :</label>
                          <input class="form-control date_range_filter" type="text" name="end_date" id="end_date">
                          <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                    </div>
                  </div>

               </div>
            </div>

            <div class="pbody">
              <table class="table table-hover table-striped " id="demo-foo-filtering" data-page-size="6">
                <thead>
                  <tr>
                    <th>التاريخ</th>
                    <th>الوصف</th>
                  </tr>
                </thead>
                  <tbody>
                  @if(count($sales_invoice_install) || count($amounts) || count($banks) || count($treasury) || count($credits) || count($closed))
                    @foreach($sales_invoice_install as $item)
                      <?php
                        $type=$item->finance_type;
                        $finance_id = $item->finance_id;
                        $type_name;
                        $finance_name;
                        $invoice_type;
                        $status;
                        if ($item->invoice_type == 0) {
                          $invoice_type = trans('frontend/dashboard.invoices');
                          $status = 'اضافة مبلغ في' ;
                        }elseif ($item->invoice_type == 1) {
                          $invoice_type = trans('frontend/dashboard.abstracts');
                          $status = 'اضافة مبلغ في' ;
                        }elseif ($item->invoice_type == 2) {
                          $invoice_type = trans('frontend/dashboard.revenue_other');
                          $status = 'اضافة مبلغ في' ;
                        }elseif ($item->invoice_type == 3) {
                          $invoice_type = trans('frontend/sales_invoice.purchase');
                          $status = 'سحب مبلغ من' ;
                        }elseif ($item->invoice_type == 4) {
                          $invoice_type = trans('frontend/sales_invoice.expenses');
                          $status = 'سحب مبلغ من' ;
                        }elseif ($item->invoice_type == 5) {
                          $invoice_type = trans('frontend/sales_invoice.bills_return');
                          $status = 'سحب مبلغ من' ;
                        }elseif ($item->invoice_type == 6) {
                          $invoice_type = trans('frontend/sales_invoice.salaries');
                          $status = 'سحب مبلغ من' ;
                        }
                      ?>
                      @if($type==1)
                      <?php
                        $finance = \DB::table('finance_banks')->where([['id','=',$finance_id],['user_id','=',$user_id]])->first();
                        $type_name = 'بنك';
                      ?>
                      @elseif($type==2)
                      <?php
                        $finance = \DB::table('finance_treasury')->where([['id','=',$finance_id],['user_id','=',$user_id]])->first();
                        $type_name = 'خزينة';
                      ?>
                      @elseif($type==3)
                        <?php
                          $finance = \DB::table('finance_credit')->where([['id','=',$finance_id],['user_id','=',$user_id]])->first();
                          $type_name = 'بطاقة ائتمان';
                        ?>
                      @endif
                      <tr>
                        <td>{{$item->paid_date}}</td>
                        <td>تم <?php echo $status; ?> <?php echo $type_name; ?> رقم {{$item->finance_id}} فاتورة (<?php echo $invoice_type; ?>)  رقم {{$item->sales_invoice_id}}</td>
                      </tr>
    
                    @endforeach

                    @foreach($amounts as $item)
                      <?php
                        $type=$item->finance_type;
                        $finance_id = $item->finance_id;
                        $type_name;
                        $finance_name;
                        $invoice_type;
                        $status;
                        $status2;
                      ?>
                      @if($type==1)
                      <?php
                        $finance = \DB::table('finance_banks')->where([['id','=',$finance_id],['user_id','=',$user_id]])->first();
                        $type_name = 'بنك';
                      ?>
                      @elseif($type==2)
                      <?php
                        $finance = \DB::table('finance_treasury')->where([['id','=',$finance_id],['user_id','=',$user_id]])->first();
                        $type_name = 'خزينة';
                      ?>
                      @elseif($type==3)
                        <?php
                          $finance = \DB::table('finance_credit')->where([['id','=',$finance_id],['user_id','=',$user_id]])->first();
                          $type_name = 'بطاقة ائتمان';
                        ?>
                      @endif
                      <?php
                          if($item->receiver_id == 0){
                            $status = "اضافة مبلغ ".$item->amount." في";
                            $status2 ='';
                          }else{
                            $status = 'تحويل مبلغ '.$item->amount.' من';
                            $status2 = 'الي '.$type_name.' رقم '.$item->receiver_id;
                          }
                      ?>
                      <tr>
                        <td>{{$item->added_date}}</td>
                        <td>تم <?php echo $status; ?> <?php echo $type_name; ?> رقم {{$item->finance_id}} {{$status2}}</td>
                      </tr>
                      
                    @endforeach     

                    @foreach($banks as $one)

                      <tr>
                        <td>{{ Carbon\Carbon::parse($one->created_at)->format('Y-m-d') }}</td>
                        <td>تم انشاء بنك رقم {{$one->id}}</td>
                      </tr>

                    @endforeach         
                    
                    @foreach($treasury as $one)

                      <tr>
                        <td>{{ Carbon\Carbon::parse($one->created_at)->format('Y-m-d') }}</td>
                        <td>تم انشاء خزينة رقم {{$one->id}}</td>
                      </tr>

                    @endforeach

                    @foreach($credits as $one)

                      <tr>
                        <td>{{ Carbon\Carbon::parse($one->created_at)->format('Y-m-d') }}</td>
                        <td>تم انشاء بطاقة ائتمان رقم {{$one->id}}</td>
                      </tr>

                    @endforeach

                    @foreach($closed as $close)
                      <?php
                        $type=$close->finance_type;
                        $finance_id = $close->finance_id;
                        $type_name;
                        $finance_name;
                        $status = 'اغلاق';
                      ?>
                      @if($type==1)
                      <?php
                        $finance = \DB::table('finance_banks')->where([['id','=',$finance_id],['user_id','=',$user_id]])->first();
                        $type_name = 'بنك';
                      ?>
                      @elseif($type==2)
                      <?php
                        $finance = \DB::table('finance_treasury')->where([['id','=',$finance_id],['user_id','=',$user_id]])->first();
                        $type_name = 'خزينة';
                      ?>
                      @elseif($type==3)
                        <?php
                          $finance = \DB::table('finance_credit')->where([['id','=',$finance_id],['user_id','=',$user_id]])->first();
                          $type_name = 'بطاقة ائتمان';
                        ?>
                      @endif                          
                      <tr>
                        <td>{{$close->closed_date}}</td>
                        <td>تم <?php echo $status; ?> <?php echo $type_name; ?> رقم {{$close->finance_id}}</td>
                      </tr>
                      
                    @endforeach  

                  @endif  

                 </tbody>
              </table>

              @if(!count($sales_invoice_install) && !count($amounts) && !count($banks) && !count($treasury) && !count($credits) && count($closed))
                <style type="text/css">
                    tbody,
                    .dataTables_wrapper .row:last-of-type,
                    .dataTables_wrapper .row:first-of-type{
                        display: none;
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







@endsection

@section('page-scripts')


    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <!--FooTable-->
    <script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>


    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>


   <script>

           $.fn.dataTable.ext.search.push(
              function( settings, aData, dataIndex ) {
                  var min =  $('#start_date').val();
                  var max =  $('#end_date').val();
                  var iStartDateCol = 0;
                  var iEndDateCol = 0;

                  min=min.substring(6,10) + min.substring(3,5)+ min.substring(0,2);
                  max=max.substring(6,10) + max.substring(3,5)+ max.substring(0,2);

                  var datofini=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
                  var datoffin=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);

                  if ( min === "" && max === "" )
                  {
                      return true;
                  }
                  else if ( min <= datofini && max === "")
                  {
                      return true;
                  }
                  else if ( max >= datoffin && min === "")
                  {
                      return true;
                  }
                  else if (min <= datofini && max >= datoffin)
                  {
                      return true;
                  }
                  return false;
              }
          );
         jQuery(document).ready(function($) {

            $('#demo-foo-filtering').DataTable();

              $( "#btnFilter" ).click(function() {
                  $( ".filter" ).slideToggle( 200, function() {

                  });
              });

             $('#start_date,#end_date').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });
            var oTable = $('#demo-foo-filtering').DataTable();
            $('#start_date, #end_date').change( function() {
                oTable.draw();
            } );
          });
      </script>

@endsection
