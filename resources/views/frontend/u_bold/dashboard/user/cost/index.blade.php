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
    .form-page-create{
        margin-top: 90px;
    }
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
    .page-panel{
        margin-top:70px;
    }
    #datatable_paginate{
        text-align: left;
    }
    .dataTables_wrapper .row:first-of-type .col-sm-6:first-of-type{
        padding-top:8px;
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
  .table tbody tr td {
         cursor:pointer !important;
     }
    .row{
        padding-top:15px;
    }

    .col-sm-5{
        display:inline-block;
        width:40%;
        text-align:right;
    }
    .col-sm-7 {
    padding:0;
    width: 60%;
    
        vertical-align:top;

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

    }

    .detail-btn{
        width:auto;
            margin-bottom:5px;

        }
        
        .btns{
            padding-top:6px;
        }
        .del{
                padding-left: 7px !important;
    padding-right: 6px !important;
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
        /*.table > thead > tr > th , .table > tbody > tr > td{
            padding:0;
        }*/
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

</style>

@endsection()

@section('subnav')
        @include(Config::get('front_theme').'.dashboard.user.cost.inc.subnav')

@endsection

@section('content')

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
            {{--'status_All'=>'الكل',--}}
            {{--'status_Draft'=>'مسوده',--}}
            {{--'status_Unpaid'=>'غير مدفوعه',--}}
            {{--'status_Due'=>'مستحقة',--}}
            {{--'status_Paid'=>'مدفوعه',--}}
            <ul class="panel-nav pull-left">
                <li><a class="al active" id="state-all"    href="javascript:void(0)"  link="{{Route('cost.get_invoices_with_status',[0])}}">{{trans('frontend/sales_invoice.status_All'   )}}</a></li>
                <li><a class="al"       id="state-draft"  href="javascript:void(0)"  link="{{Route('cost.get_invoices_with_status',[5])}}">{{trans('frontend/sales_invoice.status_Partly_Paid' )}}</a></li>
                <li><a class="al"       id="state-unpaid" href="javascript:void(0)"  link="{{Route('cost.get_invoices_with_status',[2])}}">{{trans('frontend/sales_invoice.status_Unpaid')}}</a></li>
                <li><a class="al"       id="state-due"    href="javascript:void(0)"  link="{{Route('cost.get_invoices_with_status',[3])}}">{{trans('frontend/sales_invoice.status_Due'   )}}</a></li>
                <li><a class="al"       id="state-paid"   href="javascript:void(0)"  link="{{Route('cost.get_invoices_with_status',[4])}}">{{trans('frontend/sales_invoice.status_Paid'  )}}</a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <div class="filter" style="display: none">
            <div class="row ">
                {{--<div class="col-md-2 col-xs-12">--}}
                {{--<div class="form-group has-feedback ">--}}
                {{--<label for="filterSearch" class="control-label">البحث :</label>--}}
                {{--<input class="form-control " type="text" name="filterSearch" id="filterSearch" >--}}
                {{--<span class="fa fa-search fa-fw form-control-feedback"></span>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="col-md-2 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="filterCustomer" class="control-label">العميل :</label>{{-- trans('frontend/sales_invoice.contact_id')--}}
                        <select class="form-control" name="filterCustomer" id="filterCustomer">

                        </select>
                    </div>
                    {{--<div class="form-group has-feedback ">--}}
                    {{--<label for="filterCustomer" class="control-label">العميل :</label>--}}
                    {{--<input class="form-control" type="text" name="filterCustomer" id="filterCustomer" value="" >--}}
                    {{--<span class="fa fa-user fa-fw form-control-feedback"></span>--}}
                    {{--</div>--}}
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="filterInvoice_date" class="control-label">تاريخ المستخلص :</label>
                        <input  class="form-control" type="text" name="filterInvoice_date" id="filterInvoice_date" placeholder="mm/dd/yyyy" value="">
                        <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="filterPayment_day" class="control-label">تاريخ الاستلام :</label>
                        <input class="form-control" type="text" name="filterPayment_day" id="filterPayment_day" placeholder="mm/dd/yyyy" value="" data-date="">
                        <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="filterInvoiceNumber" class="control-label">رقم المستخلص :</label>
                        <input class="form-control" type="text" name="filterInvoiceNumber" id="filterInvoiceNumber" value="" >
                        <span class="fa fa-tags fa-fw form-control-feedback"></span>
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
                            <th>الحاله</th>
                            <th>رقم الفاتوره</th>
                            <th>العميل</th>
                            <th>التاريخ</th>
                            <th>تاريخ الاستلام</th>
                            <th>الخصم</th>
                            <th>المبلغ الصافي</th>
                            <th></th>
                        </tr>
                    </thead>
                    <div class="tableBody">
                        <tbody>
                            @if(count($data))
                            <?php $label_type = ['warning', 'info', 'danger', 'success','success']; ?>
                            @foreach ($data as $row)
                            <tr style="">
                                <td><span class="label label-{{$label_type[$row->invoiceStatus->id-1]}} full-size">{{$row->invoiceStatus->name}}</span></td>
                                <td>{{ $row->invoice_number    }}</td>
                                <td>{{ $row->contact_name      }}</td>
                                <td>{{ $row->invoice_date      }}</td>
                                <td>{{ $row->delivery_date     }}</td>
                                <td>{{ $row->total_discount    }}</td>
                                <td>{{ $row->total_invoice     }}</td>
                                <td>
                                    <div class="btns">
                                    <a class="btn btn-primary waves-effect hidden show_btn detail-btn waves-light" href="{{ route('cost.show' ,$row->id) }}"><i class="fa fa-vcard"></i>  {{trans('frontend/sales_invoice.show')}}</a>

                                    <a class="btn btn-default waves-effect detail-btn waves-light" href="{{ route('cost.edit',$row->id) }}"><i class="fa fa-edit"></i> تعديل  </a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['cost.destroy', $row->id],'style'=>'display:inline']) !!}
                                    <button type="submit" class="btn btn-danger del detail-btn waves-effect waves-light"><i class="fa fa-close"></i> حذف </button>
                                    {!! Form::close() !!}
                                </td>
                                    </div>
                            </tr>
                            @endforeach

                            @endif()
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
                <a class="btn btn-default waves-effect waves-light" href="{{ route('cost.create') }}">   {{trans('button.create')}}  </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="create_model" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Add Contact</h4>
    <div class="custom-modal-text text-left">
        <form role="form">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" class="form-control" id="position" placeholder="Enter position">
            </div>
            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" class="form-control" id="company" placeholder="Enter company">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>

            <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
            <button type="button" class="btn btn-danger waves-effect waves-light m-l-10">Cancel</button>
        </form>
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
                var iStartDateCol = 3;
                var iEndDateCol = 3;
         
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
        jQuery(document).ready(function ($) {

            $('.demo-foo-filtering').DataTable();
            $('#start_date,#end_date').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });
            var oTable = $('.demo-foo-filtering').DataTable();
            $('#start_date, #end_date').change( function() {
                oTable.draw();
            } );


            $("#btnFilter").click(function () {
                if ($('.filter').css('display') == 'block' && filtered) {
                    getData(null, $('.page-panel .panel-heading .panel-nav a.active').attr('link'));
                    filtered = false;
                }
                $(".filter").slideToggle(200);
            });

            $('#filterInvoice_date , #filterPayment_day').datepicker({
                autoclose: true,
                todayHighlight: true
            });


            $('#btnClearFilters').click(function () {
                $('#filterSearch,#filterCustomer,#filterInvoice_date,#filterPayment_day,#filterInvoiceNumber').val('');
                $("#filterCustomer").val('').trigger('change')
                $('#filterSearch').focus();
                if (filtered) {
                    getData(null, $('.page-panel .panel-heading .panel-nav a.active').attr('link'));
                    filtered = false;
                }
            });


            /*$('body').on('click', '.page-panel .pagination a', function (ev) {
                ev.preventDefault();
//               var page_number = $(this).attr('href').split('page=')[1];
                getData(null, $(this).attr('href'));
            });*/

            $('#state-all , #state-draft , #state-due , #state-paid , #state-unpaid').click(function () {
                if ($(this).hasClass('active')) {
                    return void (0);
                } else {
                    $('.page-panel .panel-heading .panel-nav a.active').removeClass('active');
                    $(this).addClass('active');
                    getData(null, $(this).attr('link'));
                }

            });


            function getData(page_number, url) {
                url = url || '?page=' + page_number
//               window.history.pushState("", "", url);
                var outerBox = '.page-panel';
                var Box = '.page-panel .BoxContent';
                var loaging = '<div id="overlayPagination" class="overlay overlay-x1"><i class="fa fa-spinner fa-pulse fa-fw" ></i></div>';
                $(outerBox + ' .btn').attr('disabled', 'disabled');
                $(Box + ' #overlayPagination').remove();
                $(Box).append(loaging);
                $.ajax({
                    url: url
                }).done(function (data) {
                    $(Box).html(data);
                    $('.CopyedPagination').html($('.NewPagination').html());
                    $('.BoxContent #overlayPagination').remove();
                    $(outerBox + ' .btn').removeAttr('disabled', 'disabled');
                }).fail(function () {
                    $('.BoxContent #overlayPagination').remove();
                    $('.BoxContent #overlayError').remove();
                    var error = '<div id="overlayError" class="alert alert-danger" style="margin: 0"><h4>خطأ في الاتصال<i class="fa fa-exclamation fa-fw"></i></h4><p>حدث خطأ اثناء الاتصال قد يكون انقطاع في الاتصال . حاول مرة اخري</p></div>';
                    $(Box).html(error);
                });
            }

            $('#btnOkFilters').on('click', function () {
                filtered = true;
//               data = [$('#filterInvoiceNumber').val(),$('#filterCustomer').val(),$('#filterInvoice_date').val(),$('#filterPayment_day').val()];
                var url = "{{Route('cost.filter')}}" +
                        '/' + ($('#filterInvoiceNumber').val() == '' ? '-1' : $('#filterInvoiceNumber').val()) +
                        '/' + ($('#filterCustomer').val() == null ? '-1' : $('#filterCustomer').val()) +
                        '/' + ($('#filterInvoice_date').val() == '' ? '-1' : $('#filterInvoice_date').val()) +
                        '/' + ($('#filterPayment_day').val() == '' ? '-1' : $('#filterPayment_day').val());
                var outerBox = '.page-panel';
                var Box = '.page-panel .BoxContent';
                var loaging = '<div id="overlayPagination" class="overlay overlay-x1"><i class="fa fa-spinner fa-pulse fa-fw" ></i></div>';
                $(outerBox + ' .btn').attr('disabled', 'disabled');
                $(Box + ' #overlayPagination').remove();
                $(Box).append(loaging);
                $.ajax({
                    url: url
                }).done(function (data) {
                    $(Box).html(data);
                    $('.CopyedPagination').html($('.NewPagination').html());
                    $('.BoxContent #overlayPagination').remove();
                    $(outerBox + ' .btn').removeAttr('disabled', 'disabled');
                }).fail(function () {
                    $('.BoxContent #overlayPagination').remove();
                    $('.BoxContent #overlayError').remove();
                    $(outerBox + ' .btn').removeAttr('disabled', 'disabled');
                    var error = '<div id="overlayError" class="alert alert-danger" style="margin: 0"><h4>خطأ في الاتصال<i class="fa fa-exclamation fa-fw"></i></h4><p>حدث خطأ اثناء الاتصال قد يكون انقطاع في الاتصال . حاول مرة اخري</p></div>';
                    $(Box).html(error);
                });
            });


            $("#filterCustomer").on("select2:open", function () {
                $(".select2-search__field").attr("placeholder", "بحث");
            });
            $("#filterCustomer").select2({
                language: opts.language,
                tags: false,
                dir: "rtl",
                multiple: false,
                tokenSeparators: [',', ''],
                minimumInputLength: 1,
                minimumResultsForSearch: 10,
//            maximumSelectionLength: 1,
                ajax: {
                    url: "{{route('cost.get_contact_json') }}",
                    dataType: "json",
                    type: "GET",
                    data: function (params) {

                        var queryParameters = {
                            text: params.term
                        }
                        return queryParameters;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.first_name + " " + item.last_name,
                                    id: item.id
                                }
                            })
                        };
                    }

                }

            });

        });
        var opts = {
            language: {
                inputTooShort: function (args) {
                    // args.minimum is the minimum required length
                    // args.input is the user-typed text
                    return "ادخل عدد " + args.minimum + " أحرف على الاقل";
                },
                inputTooLong: function (args) {
                    // args.maximum is the maximum allowed length
                    // args.input is the user-typed text
                    return "You typed too much";
                },
                errorLoading: function () {
                    return "خطأ في تحميل مزيد من النتائج";
                },
                loadingMore: function () {
                    return "تحميل مزيد من النتائج";
                },
                noResults: function () {
                    var para = document.createElement("div");
                    para.innerHTML = '<a href="#create_model" class="btn btn-default btn-md waves-effect waves-light" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a" style="width: 100%;"><i class="md md-add"></i> Add Contact</a>';
                    var element = document.getElementById("select2-filterCustomer-results");
                    element.appendChild(para);

                },
                searching: function () {
                    return "جاري البحث ...";
                },
                maximumSelected: function (args) {
                    // args.maximum is the maximum number of items the user may select
                    return "خطأ في التحميل";
                }
            }
        };
</script>

<!-- Modal-Effect -->
<script src="plugins/custombox/js/custombox.min.js"></script>
@endsection



