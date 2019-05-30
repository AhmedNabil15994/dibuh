@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/main.invoices') }}
@endsection

@section('contentheader_title')
{{ trans('backend/main.invoices') }}

@endsection

@section('contentheader_description')
{{ trans('backend/main.invoices') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/main.invoices') }}
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<ul class="nav nav-tabs">
  <li class="{{ active('admin::users.users_view') }}"><a  href="{{ route('admin::users.users_view') }}">{{ trans('backend/user.list') }}</a></li>
  <li class="{{ active('admin::users.users_settings') }}"><a  href="{{ route('admin::users.users_settings') }}">{{ trans('backend/user_settings.title') }}</a></li>
  <li class="{{ active('admin::invoices.*') }}"><a  href="{{ route('admin::invoices.index') }}">{{ trans('backend/main.invoices') }}</a></li>
  <li class="{{ active('admin::invoices.*') }}"><a  href="{{ route('admin::feedback.index') }}">{{ trans('backend/main.feedback') }}</a></li>


</ul>
<div class="tab-content">
    <div id="home" class="tab-pane active in">

        <div class="pag">
                <div class="row" style="margin-bottom: -35px;margin-right: 2px;">
                        <a href="{{route('admin::invoices.create')}}" class="btn btn-success btn-circle pull-right user-add"><i class="fa fa-plus"></i> <span>{{ trans('backend/main.add') }}</span></a>
                </div>
                 <table class="table table-hover table-bordered daTatable dataTable deleteFormModal text-center demo-foo-filtering" data-form="deleteForm" id="users-table">
                    <thead>
                        <tr style="background-color: #EEE;">
                            <th class="col-sm-4">{{ trans('backend/main.inv_no') }}</th>
                            <th style="padding: 0;"><input type="text" style="margin-bottom: 5px;" name="search" class="form-control" placeholder="{{ trans('backend/main.client') }}" id="search"></th>
                            <th>{{ trans('backend/main.plan') }}</th>
                            <th>{{ trans('backend/main.inv_date') }}</th>
                            <th>{{ trans('backend/main.due_date') }}</th>
                            <th>{{ trans('backend/main.inv_stat') }}</th>
                            <th>{{ trans('backend/main.bf_tax') }}</th>
                            <th>{{ trans('backend/main.af_tax') }}</th>
                            <th>{{ trans('backend/main.all') }}</th>
                            <th>{{ trans('master.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                      @foreach($invoices as $invoice)
                        <tr>
                          <?php $price_plan=App\Models\PricePlan::find($invoice->price_plan_id); ?>
                            <td>{{$invoice->serial_number}}</td>
                            <td>{{$invoice->user_name}}</td>
                            <td>{{$price_plan->name}}</td>
                            <td>{{$invoice->invoice_date}}</td>
                            <td>{{$invoice->due_date}}</td>
                            <td>Deserved</td>
                            <td>1000</td>
                            <td>1096</td>
                            <td>1096</td>
                            <td>

                                <a style="padding-left: 8px;" class="btn show_btn  hidden btn-primary   detail-btn waves-effect waves-light" href="{{ route('admin::invoices.show' , $invoice->id) }}"><i class="fa fa-vcard"></i>  {{trans('frontend/sales_invoice.show')}}</a>

                                {!! Form::open(['method' => 'POST','route' => ['admin::invoices.destroy',$invoice->id],'style'=>'display:inline']) !!}
                                <button style="padding-right: 10px; padding-left: 5px;" type="submit" class="btn btn-danger btn-xs detail-btn waves-effect detail-btn waves-light"><i class="fa fa-close"></i> {{trans('frontend/sales_invoice.delete')}}</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

        </div>
    </div>
</div>



@endsection

@section('page-styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<style type="text/css">
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        color: #666;
    }
    .pag{
        border: 1px solid #DDD;
        padding: 20px 20px;
        background-color: #FFF;
        border-radius: 5px;
        box-shadow: 5px 5px 5px #999;
    }
    table td{
        text-align: left !important;
    }
    table thead tr:first-of-type > th{
        width: 200px !important;
    }
    table thead tr:first-of-type > th:nth-of-type(2){
        width: 200px !important;
    }
    table thead tr:first-of-type > th:nth-of-type(2) input{
        width: 100% !important;
    }

    .table tbody tr > td{
        text-align: center !important;
    }
    .table tbody tr > td:nth-of-type(2){
        text-align: left !important;
    }
    .content-wrapper, .right-side , .wrapper{
        background-color: #FFF !important;
    }
    .label{
        background-color: #358eda;
        padding: 5px;
        margin-bottom: 10px;
        display: inline-block;
    }
    #form_search input.form-control{
        display: block;
        width: 100% !important;
        position: relative;
    }
    #form_search .input-group-btn{
        position: absolute;
        right: 0;
    }
    .row{
        margin-bottom: 20px;
    }
    button i{
        font-size: 13px;
        margin-right: 5px;
    }
    .table{
        color: #495060;
        border: 1px solid #DDD;
    }
    .table thead tr > th{
        text-align: center;
        padding: 12px 5px;
    }
    .table tbody tr > td{
        text-align: center;
        padding: 10px 7px;
        font-size: 14px;
    }
    .table tbody .selected_record:hover{
        cursor: pointer;
        -webkit-transition: all ease-in-out .3s;
        -moz-transition: all ease-in-out .3s;
        -o-transition: all ease-in-out .3s;
        transition: all ease-in-out .3s;
        background-color: #EBF7FF;
    }
    .table tbody .tab-row.active,.table tbody .selected_record:active{
        background-color: #DDD;
    }
    .btn-warning{
        background-color: #FFAD33;
        padding: 6px 5px;
        padding-left: 10px;
        display: inline-block;
        font-size: 12px;
    }
    .btn-warning:hover{
        opacity: .8;
    }
    .tax-delete{
        padding: 0;
        font-size: 12px;
        padding: 2px 7px;
        background-color: #ed3f14;
    }
    .taxs .text{
        border: 1px solid #e9eaec;
        background-color: #f7f7f7;
        padding: 5px;
        display: block;
        width: fit-content;
        margin: auto;
        margin-bottom: 10px;
    }
    .taxs .rate{
        min-width: 40px;
    }
    th.edit{
        position: relative;
    }
    th.edit div{
        position: absolute;
        top: 0;
        left: 0;
        padding: 5px 15px;
        display: block;
        width: 100%;
        text-align: center;
    }
    td .btn{
        margin-bottom: 5px;
    }
    .tab-pane{
        padding: 15px;
        border: 1px solid #DDD;
        border-top: 0;
    }
    .select2,.form-control{
        width: 50% !important;
        display: inline-block;
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
    .dataTables_wrapper .row .col-sm-5{
        float: right;
    }
    .dataTables_wrapper .row .col-sm-5 .dataTables_info{
        float: right;
    }
    #search{
        float: left;
    }
</style>
@endsection

@section('page-scripts')


<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript">
    $(function(){

/*********************************************** Pagination Code***********************************************/
        /*$(document).on('click','.pagination a',function(e){
            e.preventDefault();
            var page = $(this).attr('href');
            getItems(page);
            window.history.pushState("", "", page);
        });

        function getItems(page){
            $.ajax({
                url:page
            }).done(function(data){
                $('#home').html($(data).find(".pag"));
            });
        }*/

        $(document).on('click','.demo-foo-filtering tbody tr',function(){

              var route  = $(this).find('.show_btn').attr('href');
            //   console.log(route);
              window.location.href=route;
            });

        $(".select2").select2();
        var oTable = $('.demo-foo-filtering').DataTable({
                      "ordering": false
                    } );
        $('#search').on('keyup',function(){
            oTable.search( this.value ).draw();
        });
        function close(){
            $('.modal input').val('');
            $('select').prop('selectedIndex',-1);
            $('.modal .alert').addClass('hidden');
            $('input[type=checkbox]').each(function(){
                    $(this).iCheck('uncheck');
            });
        }

        $('.modal .btn-danger , .modal .close').on('click',function(){
                close();
        });



    });
</script>

@endsection
