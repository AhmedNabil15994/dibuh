@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')


@section('content_dashboard')

<link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="plugins/select2/css/select2.min.css">
<link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">

<style type="text/css">
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
<h4 style="margin-top: -45px;">{{trans('frontend/dashboard.contact_manager')}}</h4>

<div class="panel panel-default page-panel">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-5 pull-right " style="padding: 0">
                <button id="btnFilter" type="button" class="btn btn-default waves-effect waves-light pull-right" style="margin: 0 5px;"><i class="md md-filter-list"></i> فيلتر </button>
                <div class="btn-group pull-right export">
                    <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-upload"></i> تصدير <span class="caret"></span> </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{route('contact.exportPdf')}}">Pdf File</a></li>
                        <li><a href="{{route('contact.exportExcel')}}">Excel File</a></li>
                        <li><a href="{{route('contact.exportCsv')}}">Csv File</a></li>
                    </ul>
                </div>
            </div>
            <ul class="panel-nav pull-left">
                <li><a class="active" id="state-all" href="javascript:void(0)" link="{{Route('contact.get_contact_with_type',[0])}}">الكل</a></li>
                <li><a class="" id="state-customer" href="javascript:void(0)" link="{{Route('contact.get_contact_with_type',[1])}}">العملاء</a></li>
                <li><a class="" id="state-supllier" href="javascript:void(0)" link="{{Route('contact.get_contact_with_type',[2])}}">الموردين</a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <div class="filter" style="display: none">
           <div class="row ">
               <div class="col-md-2 col-xs-12">
                   <div class="form-group has-feedback ">
                       <label for="filterAccountingNumber" class="control-label">الرقم المحاسبي :</label>
                       <input class="form-control " type="text" name="filterAccountingNumber" id="filterAccountingNumber" value="">
                       <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                   </div>
               </div>
               <div class="col-md-2 col-xs-12">
                   <div class="form-group has-feedback ">
                       <label for="filterFirstName" class="control-label">الاسم الاول :</label>
                       <input class="form-control" type="text" name="filterFirstName" id="filterFirstName" value="" >
                       <span class="fa fa-user fa-fw form-control-feedback"></span>
                   </div>
               </div>
               <div class="col-md-2 col-xs-12">
                   <div class="form-group has-feedback ">
                       <label for="filterCompanyName" class="control-label">أسم الشركة :</label>
                       <input class="form-control" type="text" name="filterCompanyName" id="filterCompanyName" value="" >
                       <span class="fa fa-briefcase fa-fw form-control-feedback"></span>
                   </div>
               </div>
               <div class="col-md-2 col-xs-12">
                   <div class="form-group has-feedback ">
                       <label for="filterPhoneNumber" class="control-label">رقم التليفون :</label>
                       <input class="form-control" type="text" name="filterPhoneNumber" id="filterPhoneNumber" value="" >
                       <span class="fa fa-mobile-phone fa-fw form-control-feedback"></span>
                   </div>
               </div>
               <div class="col-md-2 col-xs-12">
                   <div class="form-group-without-label">
                       <button type="button" id="btnClearFilters" class="btn btn-white waves-effect ">الغاء المدخلات </button>
                       <button type="button" id="btnOkFilters" class="btn btn-white waves-effect "><i class="fa fa-search"></i></button>
                   </div>
               </div>
           </div>
        </div>
        <div class="pbody table-responsive">
            <div class="BoxContent">
                <table class="table table-hover table-striped-del daTatable dataTable demo-foo-filtering" id="demo-foo-filtering" >
                    <thead>
                        <tr>
                            <th>رقم العميل</th>
                            <th>رقم المورد</th>
                            <th>نوع العميل</th>
                            <th>الاسم الاول</th>
                            <th>الاسم الاخير</th>
                            <th>اسم الشركة</th>
                            <th>المدينة</th>
                            <th>رقم التليفون</th>
                            <th></th>
                        </tr>
                    </thead>
                    <div class="tableBody">
                        <tbody>
                            @if(count($data))
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{!! $row->customer_display_id  && $row->customer_display_id !=$row->supplier_display_id  ? $row->customer_display_id : '<span class="label label-inverse">ليس عميل</span>' !!}</td>
                                        <td>{!! $row->supplier_display_id ? $row->supplier_display_id : '<span class="label label-inverse">ليس مورد</span>' !!}</td>
                                        <td>{{$row->supplier_display_id !=null && $row->customer_display_id != null && $row->customer_display_id !=$row->supplier_display_id  ? $types[1] . " | " .$types[2] : $types[$row->contact_type_id] }}</td>
                                        <td>{{$row->first_name}}</td>
                                        <td>{{$row->last_name}}</td>
                                        <td>{{$row->company}}</td>
                                        <td>{{$row->city}}</td>
                                        <td>{!!$row->phone !='' ? $row->phone : '<span class="label label-info">لا يوجد رقم</span>'!!}</td>

{{--                                        <td>{!!$row->phone_number != '' ? $row->phone_number  : '<span class="label label-info">لا يوجد رقم</span>'!!}</td>--}}
                                        <td>
                                            <a class="btn btn-default waves-effect waves-light" href="{{route('contact.edit',$row->contact_id)}}">
                                                <i class="fa fa-edit"></i> {{trans('تعديل')}} </a>

                                            <form method="POST" action="{{route('contact.destroy' , $row->contact_id)}}" style="display:inline">
                                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger waves-effect waves-light"><i class="fa fa-close"></i> {{trans('حذف')}}</button>
                                            </form>
                                        </td>
                                    </tr>
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
                <a class="btn btn-default waves-effect waves-light" href="{{ route('contact.create') }}">   إضافة عميل او مورد جديد  </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')

<script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>
<script>
    var filtered = false;
    jQuery(document).ready(function($) {
        $('.demo-foo-filtering').DataTable();
        $( "#btnFilter" ).click(function() {
            if($('.filter').css('display') == 'block' && filtered){
                getData(null , $('.page-panel .panel-heading .panel-nav a.active').attr('link'));
                filtered = false;
            }
            $( ".filter" ).slideToggle(200);
        });
       $('#btnClearFilters').click(function () {
            $('#filterAccountingNumber,#filterFirstName,#filterCompanyName,#filterPhoneNumber').val('');
            $('#filterAccountingNumber').focus();
           if (filtered){
               getData(null , $('.page-panel .panel-heading .panel-nav a.active').attr('link'));
               filtered = false;
           }
       });
       $('#state-all , #state-customer , #state-supllier').click(function () {
           if ($(this).hasClass('active')){
               return void (0);
           }else{
               $('.page-panel .panel-heading .panel-nav a.active').removeClass('active');
               $(this).addClass('active');
               getData(null , $(this).attr('link'));
           }
       });
       /*$('body').on('click', '.page-panel .pagination a', function(ev) {
           ev.preventDefault();
           getData(null,$(this).attr('href'));
       });*/
       function getData(page_number , url) {
            url = url || '?page=' + page_number
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
           var url = "{{Route('contacts.filter')}}" +
                   '/' + ($('#filterAccountingNumber').val() == '' ? '-1' :$('#filterAccountingNumber').val()) +
                   '/' + ($('#filterFirstName').val()        == '' ? '-1' : $('#filterFirstName').val()) +
                   '/' + ($('#filterCompanyName').val()      == '' ? '-1' : $('#filterCompanyName').val())  +
                   '/' + ($('#filterPhoneNumber').val()      == '' ? '-1' : $('#filterPhoneNumber').val()) ;
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
    });
</script>

@endsection
