@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/account.relation') }}

@endsection

@section('contentheader_title')
{{ trans('backend/account.relation') }}
@endsection

@section('contentheader_description')


@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/account.relation') }}
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<!--******************************************************************************************************************-->
    <!-- Indicators -->
    <ul class="nav nav-tabs" style="border-bottom: 0; margin-bottom: 25px;">
        <li class="active" style="border-bottom: 3px solid #3C8DBC;"><a href="{{route('admin::account_setting.relation')}}">{{ trans('backend/account_to_tax.title') }}</a></li>
        <li><a href="{{route('admin::account_setting.setting_relation2')}}">{{ trans('backend/dashboard.assign_account_to_company_type') }}</a></li>
        <li><a href="{{route('admin::account_setting.setting_relation3')}}">{{ trans('backend/dashboard.assign_account_to_screen') }}</a></li>
    </ul>
    <div class="clearfix"></div>
    <!-- Wrapper for slides -->
    <div class="tab-content">

    <!--************************************** Account To Taxes View **************************************************-->
        <div class="item item1 tab-pane active in">
            <div class="pag1">

                <table class="table table-hover daTatable dataTable demo-foo-filtering" id="acc-table1" style="width: 99%;border: 1px solid #DDD;">
                    <thead>
                        <tr style="background-color: #f8f8f9;">
                            <th>ID</th>
                            <th>{{ trans('backend/account_to_tax.account') }}</th>
                            <th>{{ trans('backend/account_to_tax.tax') }}</th>
                            <th>{{ trans('backend/account_to_tax.rate') }}</th>
                            <th>{{ trans('master.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($accounts  as $item)
                            <?php
                                if ($item->is_major == 1){
                                    $bgcolor='#DDD';$color='#000';$font_size='700';$tBorder="1px solid #FFF";
                                }else{
                                    $bgcolor='';$color='';$font_size='';$tBorder='';
                                }
                            ?>
                        <tr class="">

                            <td>{{ $item->account_code }}</td>
                            <td style="background:{{  $bgcolor }};color:{{  $color }};font-weight:{{  $font_size }}; border-bottom: {{ $tBorder }}">{{ $item->name }}</td>
                            <td class="tax-name{{$item->id}}">@foreach($item->taxes as $key){{$key->name}}<br>@endforeach</td>
                            <td class="tax-rate{{$item->id}}">@foreach($item->taxes as $key){{$key->rate}} <br>@endforeach</td>

                            <td>
                                @foreach($item->taxes as $tax)
                                    <span class="hidden tax_id" id="{{$tax->id}}"></span>
                                @endforeach

                                @permission('account-edit')
                                    <button type="button" class="btn btn-primary btn-xs edit-account-tax"  value="{{$item->account_code}}" value1="{{$item->name}}" value2="{{$item->id}}"><i class="fa fa-edit"></i> {{ trans('button.edit') }}</button>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

           </div>
        </div>
    <!--***************************************************************************************************-->

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
<style type="text/css">
    .content-wrapper, .right-side , .wrapper{
        background-color: #FFF !important;
    }
    .row{
        padding-right: 50px;
        margin-bottom: 20px;
    }
    .carousel-indicators{
        float: left;
        position: unset !important;
        margin: 0;
        width: 100%;
        display: block;
        text-align: center;
        margin-bottom: 25px;
    }
    .carousel-indicators li{
        display: inline-block;
        height: 100%;
        padding: 8px ;
        cursor: pointer;
        text-decoration: none;
        position: static !important;
        transition: #2d8cf0 .3s ease-in-out;
        float: left;
        text-indent: 0;
        min-width: 200px;
        min-height: 40px;
        text-align: center;
        border-radius: 0;
    }
    .carousel-indicators li.active{
        border-bottom: 2px solid #2d8cf0;
    }
    .carousel-indicators li a{
        color: #000;
        text-decoration: none;
    }
    .carousel-indicators li.active a{
        color: #2d8cf0;

    }
    button i{
        font-size: 13px;
        margin-right: 5px;
    }
    .table{
        color: #495060;
    }
    .table thead tr > th{
        text-align: center;
        padding: 10px 12px;
    }
    .table tbody tr > td{
        text-align: center;
        padding: 10px 7px;
        font-size: 14px;
    }
    .table tbody tr:hover{
        cursor: pointer;
        -webkit-transition: all ease-in-out .3s;
        -moz-transition: all ease-in-out .3s;
        -o-transition: all ease-in-out .3s;
        transition: all ease-in-out .3s;
        background-color: #EBF7FF;
    }
    .account_id{
        width: 50%;
    }

    #acc-table1_wrapper .col-sm-6:first-of-type,
    #acc-table1_wrapper .col-sm-5{
        float: right !important;
    }
    #acc-table1_filter,.dataTables_paginate.paging_simple_numbers{
        float: left !important;
    }
    .dataTables_info,
    #acc-table1_wrapper .col-sm-6 .dataTables_length{
        float: right !important;
        margin-right: 15px !important;
    }
</style>
@endsection

@section('page-scripts')
@include(Config::get('back_theme').'.layouts.modals.edit_acc_to_tax')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
    $(function(){
            $('.demo-foo-filtering').DataTable({
              "pageLength": 50
            });
        /***************************Pagination Code*********************************/
            /*function getItems(page,element,element2){
                $.ajax({
                    url:page
                }).done(function(data){
                    $(element).html($(data).find(element2));
                });
            }
            $(document).on('click','.item1 .pagination a',function(e){
                e.preventDefault();
                var page = $(this).attr('href');
                getItems(page , '.item1', '.pag1');
                window.history.pushState("", "", page);
            });      */

            $("input[type=checkbox]").iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_minimal-blue'
            });

            function close(){
                $('input[type=checkbox]').each(function(){
                    $(this).iCheck('uncheck');
                });
            };
           $('.modal .btn-danger , .modal .close').on('click',function(){
                close();
           });

           $('.item1').on('click','.edit-account-tax',function(e){
                e.preventDefault();
                e.stopPropagation();
                var code = $(this).val();
                var name = $(this).attr('value1');
                var id   = $(this).attr('value2');
                var IDs = [];
                var parent =$(this).parent();
                parent.find(".tax_id").each(function(){ IDs.push(this.id); });
                for (var i = IDs.length - 1; i >= 0; i--) {

                    $('input[type=checkbox]').each(function(){
                        if($(this).attr('value1') == IDs[i]){
                            $(this).iCheck('check');
                        }
                    });
                }

                $('#edit-acctax-modal .account_id').val(code+"-"+name);
                $('#edit-acctax-modal').modal({ backdrop: 'static', keyboard: false });
                $('#edit-acctax-modal .btn-success').unbind('click');
                $('#edit-acctax-modal .btn-success').on('click',function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    var taxes_id = [];
                    $.each($("input[name='tax']:checked"), function(){
                        taxes_id.push($(this).attr('value1'));
                    });

                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                    $.ajax({
                        type: 'post',
						url: '{{URL::to('backend/editAccTax')}}',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id': id,
                            'taxes_id': taxes_id
                        },
                        success: function(data) {
                            $('.tax-name'+id).empty();
                            $('.tax-rate'+id).empty();
                            $.each($("input[name='tax']:checked"), function(){
                                $('.tax-name'+id).append($(this).attr('value2') + "<br>");
                                $('.tax-rate'+id).append($(this).attr('value3') + "<br>");

                            });
                            $('#edit-acctax-modal').modal('toggle');
                            close();
                            location.reload();
                        }
                    });

                });
            });



/*****************************************************************************************************************************/
    });
</script>

@endsection
