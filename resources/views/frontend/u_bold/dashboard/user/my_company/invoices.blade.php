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
    .tax_info_body{display:none;}
    .custom_note{
        background: #5fbeaa;
        height: 50px;
        color: #FFF;
        text-align: center;
        line-height: 50px;
        margin-bottom: 25px;
        border-radius: 010px;
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

</style>

@endsection()


@section('subnav')

@include(Config::get('front_theme').'.dashboard.'.$userType.'.my_company.inc.subnav')

@endsection




@section('content')




<div class="row m-b-20" style="margin-top: 75px;">
    <div class="col-xs-12 ">
        <h4 class="page-title">جميع الفواتير المستلمة</h4>
        <p class="text-muted page-title-alt m-b-0">من هنا يمكنك متابعة جميع الفواتير المستلمة</p>
    </div>
</div>

<div class="panel panel-default page-panel">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-5 pull-right show-filter">

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
                <li><a class="al active" id="state-all"    href="javascript:void(0)"  link="{{Route('other_income.get_invoices_with_status',[0])}}">{{trans('frontend/sales_invoice.status_All'   )}}</a></li>
                <li><a class="al"       id="state-draft"  href="javascript:void(0)"  link="{{Route('other_income.get_invoices_with_status',[5])}}">{{trans('frontend/sales_invoice.status_Partly_Paid' )}}</a></li>
                <li><a class="al"       id="state-unpaid" href="javascript:void(0)"  link="{{Route('other_income.get_invoices_with_status',[2])}}">{{trans('frontend/sales_invoice.status_Unpaid')}}</a></li>
                
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <div class="filter" style="display: none">
            <div class="row ">
                
                <div class="col-md-2 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="filterCustomer" class="control-label">العميل :</label>{{-- trans('frontend/sales_invoice.contact_id')--}}
                        <select class="form-control" name="filterCustomer" id="filterCustomer">

                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group has-feedback ">
                        <label for="filterInvoice_date" class="control-label">تاريخ الفاتورة :</label>
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
                        <label for="filterInvoiceNumber" class="control-label">رقم الفاتورة :</label>
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
                            <th>التاريخ</th>
                            <th>المبلغ قبل الضرائب</th>
                            <th>المبلغ بعد الضرائب</th>
                            <th>الاجمالي</th>
                            <th></th>
                        </tr>
                    </thead>
                    <div class="tableBody">
                        <tbody>
                            @if(count($data))
                            <?php $label_type = ['warning', 'info', 'danger', 'success','success']; ?>
                            <tr>
                                <td> <span class="label label-info full-size">غير مدفوعة</span></td>
                                <td>1</td>
                                <td>{{Carbon::now()->format('Y-m-d')}}</td>
                                <td>1000</td>
                                <td>1096</td>
                                <td>1096</td>
                                <td>
                                     <a class="btn detail-btn btn-primary show_btn hidden waves-effect waves-light" href=""><i class="fa fa-vcard"></i>  {{trans('frontend/sales_invoice.show')}}</a>

                                   
                                    <button type="submit" class="btn detail-btn btn-danger waves-effect waves-light"><i class="fa fa-close"></i> حذف </button>
                                   
                                </td>
                            </tr>
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
    
</div>





<!--ُEnd company_info_body-->

@endsection


@section('page-scripts')
<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/select2/js/select2.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>
<script>

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

            var oTable = $('.demo-foo-filtering').DataTable();
            $('#start_date, #end_date').change( function() {
                oTable.draw();
            } );

            $(document).on('click','.demo-foo-filtering tbody tr',function(){
                
              var route  = $(this).find('.show_btn').attr('href');
            //   console.log(route);
              window.location.href=route;
            });
           

        });


</script>


@endsection



