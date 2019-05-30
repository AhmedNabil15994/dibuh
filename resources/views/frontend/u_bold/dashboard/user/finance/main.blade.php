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
        .select2-container .select2-selection--single{
            height: 33px !important;
            direction: rtl !important;
        }
        .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 32px !important;
            padding-left: 25px !important;
            padding-right: 5px !important;
            font-size: 14px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 3px;
            right: inherit;
            left: 5px;
        }
        .select2-container--open .select2-dropdown--above {
            padding: 0;
            direction: rtl;
        }

        .label[type='1']{
            padding-left: 30px;
            padding-right: 31px;
        }
        .label[type='2']{
            padding-left: 24px;
            padding-right: 25px;
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
       .table tbody tr td {
         cursor:pointer !important;
    }

        div.dt-buttons .btn-group{
            display:none !important;
        }

    #demo-foo-filtering_info {
        display:inline-block !important;
        text-align:right !important;
        width:40% !important;
          float:none;
    }


    #demo-foo-filtering_paginate {
    padding:0 !important;
    width: 60% !important;
    vertical-align: top !important;
    float:none;
    text-align:left;
    display: inline-block !important;
    }
    .del{
        padding-left: 7px !important;
    padding-right: 7px !important;
    }
    @media(max-width: 767px){
        form .btn-danger{
            display: inline-block;
        }

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
      #demo-foo-filtering_paginate,
        .dataTables_length{
          float: left !important;
        }

      .table >thead > tr > th , .table >tbody> tr > td{
          text-align:center !important;
      }

      .paginate_button{
          padding:0 !important;
          margin:0 !important;
      }
    /*mobile responsive */
    @media (max-width:768px){

        .table > thead >tr>th{
        font-size:11px;
        padding-left: 0;
    text-align: center;

      }
      .table > tbody > tr > td{
          text-align:center;
          font-size: 13px;
      }

       .table > thead > tr > th:nth-child(1) , .table > thead > tr > th:nth-child(4) , .table > thead > tr > th:nth-child(5)
        ,    .page-panel .panel-body .pbody .table>tbody>tr>td:nth-child(1) , .panel-body .pbody .table>tbody>tr>td:nth-child(4) , .table > tbody > tr > td:nth-child(5){
            display:none;

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
        .page-panel .panel-heading  ul.panel-nav li  .al {
            font-size:10px;

        }

    }


    @media (max-width:359px){
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


@section('content')


   <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">


    <div class="row m-b-20" style="margin-top: 75px;">
        <div class="col-xs-12 ">
            <h4 class="page-title">المالية</h4>
            <p class="text-muted page-title-alt m-b-0">من هنا يمكنك متابعه اموالك</p>
        </div>
    </div>




   @if ($message = Session::get('success'))
       <div class="alert alert-success">
           <p>{{ $message }}</p>
       </div>
   @endif

<div class="panel panel-default page-panel">

        <div class="panel-heading">
            <div class="row">
                <div class="col-md-5 pull-right " style="padding: 0">

                    <button id="btnFilter" type="button" class="btn btn-default waves-effect waves-light pull-right" style="margin: 0 5px;"><i class="md md-filter-list"></i> فيلتر </button>

                    <div class="btn-group pull-right export">
                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-upload"></i> تصدير <span class="caret"></span> </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">PDF File</a></li>
                            <li><a href="#">Excel File</a></li>
                            <li><a href="#">Csv File</a></li>
                            <li><a href="#">Html File</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="panel-nav pull-left">
                    <li><a class="al active" id="state_all"        href="javascript:void(0)"  link="{{Route('finance.get_finance_with_status',[0])}}">الكل</a></li>
                    <li><a class="al"       id="status_treasury"  href="javascript:void(0)"  link="{{Route('finance.get_finance_with_status',[1])}}">بنوك</a></li>
                    <li><a class="al"       id="status_bank"      href="javascript:void(0)"  link="{{Route('finance.get_finance_with_status',[2])}}">خزائن</a></li>
                    <li><a class="al"       id="status_credit"    href="javascript:void(0)"  link="{{Route('finance.get_finance_with_status',[3])}}">كروت أئتمان</a></li>
                </ul>

            </div>
        </div>



        <div class="panel-body">
            <div class="filter" style="display: none">
                <div class="row ">
                    <div class="col-md-2 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label for="filterType" class="control-label">نوع الحساب :</label>{{-- trans('frontend/sales_invoice.contact_id')--}}
                            <select class="form-control" name="filterType" id="filterType">
                                <option value="0">الكل</option>
                                <option value="1">البنوك</option>
                                <option value="2">الخزائن</option>
                                <option value="3">كروت الأئتمان</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label for="filterName" class="control-label">أسم الخزينة او الحساب :</label>
                            <input class="form-control" type="text" name="filterName" id="filterName" value="" >
                            <span class="fa fa-tags fa-fw form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label for="filterFinanceNumber" class="control-label">رقم الحساب :</label>
                            <input class="form-control" type="text" name="filterFinanceNumber" id="filterFinanceNumber" value="" >
                            <span class="fa fa-search fa-fw form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="form-group-without-label">
                            <button type="button" id="btnClearFilters" class="btn btn-white waves-effect ">الغاء المدخلات </button>
                            <button type="button" id="btnOkFilters" class="btn btn-white waves-effect "><i class="fa fa-search"></i></button>
                        </div>

                    </div>


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
            <div class="pbody table-responsive">
                <div class="BoxContent">
                    <table class="table table-hover daTatable dataTable demo-foo-filtering" id="demo-foo-filtering" >
                        <thead>
                            <tr>
                                <th>النوع</th>
                                <th>تاريخ الافتتاح</th>
                                <th>أسم الخزنه او الحساب</th>
                                <th>رقم الحساب</th>
                                <th>الرصيد الحالى</th>
                                <th>العملة</th>
                                <th></th>
                            </tr>
                        </thead>
                        <div class="tableBody">
                            <tbody>
                                @if(count($data))
                                <?php $label_type=['warning','info','danger','success'];
                                    $label_name = ['بنك','خزينة','كارت أئتمان'];
                                ?>
                                    @foreach($data as $row)
                                    <?php
                                        $check_closed = \DB::table('closed')->where('finance_type','=',$row['type'])->where('finance_id','=',$row['id'])->get();
                                    ?>
                                    @if(count($check_closed) > 0)

                                    @else
                                        <tr>
                                            <td><span class="label label-{{$label_type[$row['type']-1]}} full-size"  type="{{$row['type']}}">{{ $label_name[$row['type']-1] }}</span></td>
                                            <td>{{$row['start_date']}}</td>
                                            <td>{{$row['owner_name']}}</td>
                                            <td>{{$row['serial_number']}}</td>
                                            <td>{{$row['balance']}}</td>
                                            <td>{{$row['currency']}}</td>
                                            <td>
                                            <div class="btns">
                                                <a class="btn detail-btn hidden show_btn btn-primary waves-effect waves-light" href="{{route('finance.show',['id' => $row['id'] , 'type'=>$row['type']])}}"><i class="fa fa-vcard"></i> {{trans('button.show')}} </a>
                                                <a class="btn detail-btn btn-default waves-effect waves-light" href="{{route('finance.edit',['id' => $row['id'] , 'type'=>$row['type']])}}"><i class="fa fa-edit"></i> تعديل </a>
                                                <form method="POST" action="{{route('finance.destroy', $row['id'])}}" accept-charset="UTF-8" style="display:inline">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    {{csrf_field()}}
                                                    <input name="type" type="hidden" value="{{$row['type']}}">
                                                    <button type="submit" class="btn del detail-btn btn-danger waves-effect waves-light"><i class="fa fa-close"></i> {{trans('button.delete')}}</button>
                                                </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                @endif
                            </tbody>
                        </div>
                    </table>
                    @if(!count($data))
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

        <div class="panel-footer">
            <div class="row">
                <div class="col-md-4 pull-left">
                    <a class="btn btn-default waves-effect waves-light" href="{{ route('finance.create') }}">   أضافة خزنة او بنك  </a>
                </div>

            </div>
        </div>
    </div>



@endsection

@section('page-scripts')
<!-- export files -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>

<!-- export files -->
<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/select2/js/select2.min.js"></script>
<!--
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script> -->
<script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>

<!-- Notification js -->
<script src="plugins/notifyjs/js/notify.js"></script>
<script src="plugins/notifications/notify-metro.js"></script>
<script>

 //route function
        $(document).on('click','.demo-foo-filtering tbody tr',function(){

              var route  = $(this).find('.show_btn').attr('href');
            //   console.log(route);
              window.location.href=route;
            });

    var filtered = false;

    $.fn.dataTable.ext.search.push(
        function( settings, aData, dataIndex ) {
            var min =  $('#start_date').val();
            var max =  $('#end_date').val();
            var iStartDateCol = 1;
            var iEndDateCol = 1;

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
               console.log("finance");

        $('.demo-foo-filtering').DataTable();
        $('#start_date,#end_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });

        $( "#btnFilter" ).click(function() {
            if($('.filter').css('display') == 'block' && filtered){
                getData(null , $('.page-panel .panel-heading .panel-nav a.active').attr('link'));
                filtered = false;
            }
            $( ".filter" ).slideToggle(200);
        });

        var oTable = $('.demo-foo-filtering').DataTable();
        $('#start_date, #end_date').change( function() {
            oTable.draw();
        } );

        $("#filterType").select2({
           width: '100%',
           minimumResultsForSearch: -1
        });

        $('#btnClearFilters').click(function () {
            $('#filterFinanceNumber,#filterName').val('');
            $("#filterType").val("0").trigger("change");
            $('#filterName').focus();
            if (filtered){
                getData(null , $('.page-panel .panel-heading .panel-nav a.active').attr('link'));
                filtered = false;
            }
        });

        /*$('body').on('click', '.page-panel .pagination a', function(ev) {
           ev.preventDefault();
        //               var page_number = $(this).attr('href').split('page=')[1];
           getData(null,$(this).attr('href'));
        });*/

        $('#state_all , #status_treasury , #status_bank , #status_credit ').click(function () {
           if ($(this).hasClass('active')){
               return void (0);
           }else{
               $('.page-panel .panel-heading .panel-nav a.active').removeClass('active');
               $(this).addClass('active');
               getData(null , $(this).attr('link'));
           }

        });


        function getData(page_number , url) {
            url = url || '?page=' + page_number
            //               window.history.pushState("", "", url);
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
               var error = '<div id="overlayError" class="alert alert-danger" style="margin: 0"><h4>خطأ في الاتصال<i class="fa fa-exclamation fa-fw"></i></h4><p>حدث خطأ اثناء الاتصال قد يكون انقطاع في الاتصال . حاول مرة اخري</p></div>';
               $(Box).html(error);
            });
        }

        $('#btnOkFilters').on('click', function() {
            filtered = true;
            var url = "{{Route('finance.filter')}}" +
                '/' + ($('#filterType').val() == '' ? '-1' :$('#filterType').val()) +
                '/' + ($('#filterName').val() == '' ? '-1' : $('#filterName').val()) +
                '/' + ($('#filterFinanceNumber').val() == '' ? '-1' : $('#filterFinanceNumber').val())  ;
            var outerBox = '.page-panel';
            var Box = '.page-panel .BoxContent';
            var loaging = '<div id="overlayPagination" class="overlay overlay-x1"><i class="fa fa-spinner fa-pulse fa-fw" ></i></div>';
            $(outerBox + ' .btn').attr('disabled','disabled');
            $(Box + ' #overlayPagination').remove();
            $(Box).append(loaging);
            $.ajax({
                url : url
            }).done(function (data) {
                if($.isArray(data['errors'])) {
                    $.each(data['errors'], function (i, item) {
                        $.Notification.autoHideNotify('error', 'top right', 'Whoops', item);
                    });
                    $('.BoxContent #overlayPagination').remove();
                    $(outerBox + ' .btn').removeAttr('disabled','disabled');
                }else{
                    $(Box).html(data);
                    $('.CopyedPagination').html($('.NewPagination').html());
                    $('.BoxContent #overlayPagination').remove();
                    $(outerBox + ' .btn').removeAttr('disabled','disabled');
                }
            }).fail(function () {
                $('.BoxContent #overlayPagination').remove();
                $('.BoxContent #overlayError').remove();
                $(outerBox + ' .btn').removeAttr('disabled','disabled');
                var error = '<div id="overlayError" class="alert alert-danger" style="margin: 0"><h4>خطأ في الاتصال<i class="fa fa-exclamation fa-fw"></i></h4><p>حدث خطأ اثناء الاتصال قد يكون انقطاع في الاتصال . حاول مرة اخري</p></div>';
                $(Box).html(error);
            });
        });
    });
</script>

@endsection
