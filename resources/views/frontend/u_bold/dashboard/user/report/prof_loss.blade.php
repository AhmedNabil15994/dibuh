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
            <h4 class="page-title">{{trans('frontend/reports.title2')}}</h4>
            <p class="text-muted page-title-alt m-b-0">{{trans('frontend/reports.description2')}}</p>
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
                            @foreach($data as $report)
                            <option value="{{$report['account_code']}}">{{$report['account_code']}} -- {{$report['account_name']}}</option>
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
                                <th class="col-md-3">{{trans('frontend/reports.name')}}</th>
                                <th class="col-md-3">{{trans('frontend/reports.date')}}</th>
                                <th>{{trans('frontend/reports.desc')}}</th>
                            </tr>
                        </thead>
                        <div class="tableBody">
                          <tbody>
                             @foreach($data as $row)
                              <tr>
                                <td>{{$row['account_code']}} -- {{$row['account_name']}}</td>
                                <td>{{$row['created_at']}}</td>
                                <td>
                                  <ul>
                                    <li>
                                      {{$row['account_code']}}
                                      <ul>
                                        <li>{{trans('frontend/reports.invoice_number')}} {{$row['invoice_number']}} ({{$row['invoice_type']}})</li>
                                        <ul>
                                          <li>{{trans('frontend/reports.prices_taxes')}} {{$row['price']}}</li>
                                          @foreach($row['taxes'] as $key)
                                          <li>{{$key->tax_name}} <?php echo (($key->tax_rate/100) * $row['price']) ; ?></li>
                                          @endforeach
                                        </ul>
                                      </ul>
                                    </li>
                                  </ul>
                                </td>
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

             
             var table =$('.demo-foo-filtering').DataTable({
                "order": [[ 1, "desc" ]]
            } );
            $('#start-date,#end-date').datepicker({
                autoclose: true,
                todayHighlight: true,
                 format : 'yyyy-mm-dd',
              
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
          $('#filterCustomer,#start-date,#end-date').on( 'change', function () {
              table.search( this.value ).draw();
          } );  
        });
       
    </script>

        <!-- Modal-Effect -->
        <script src="plugins/custombox/js/custombox.min.js"></script>

@endsection
