@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/user.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/user.list') }}
@endsection

@section('contentheader_description')
{{ trans('backend/user.list') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/user.list') }}
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div id="add-user-modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">{{ trans('backend/user.create_new') }}</h4>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
        {!! Form::open(array('route' => 'admin::users.create','method'=>'POST')) !!}
              <div class="box-body">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>Email:</strong>
                        </div>
                        {!! Form::text('email', null, array('placeholder' => trans('backend/user.email'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>Password:</strong>
                        </div>
                        {!! Form::password('password', array('placeholder' => trans('backend/user.password'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>Confirm Password:</strong>
                        </div>
                        {!! Form::password('confirm-password', array('placeholder' => trans('backend/user.password_confirmation'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user.admin_access') }}:</strong>
                        </div>
                        {!! Form::hidden('is_admin', false) !!}
                        {!! Form::checkbox('is_admin', true) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom: 20px;border-bottom: 1px solid #DDD;">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user.roles') }}:</strong>
                        </div>
                        <select class="roles form-control select2" multiple id="roles" tabindex="1">
                            <option disabled>{{trans('master.select_item_from_list')}}</option>
                        @foreach($roles as $role)

                            <option value="{{$role->id}}">{{$role->display_name}}</option>

                        @endforeach
                        </select>
                    </div>
                </div>
           </div>
           <div class="box-footer pull-right" style="border-top: 0">
                <button type="submit" class="btn btn-success" style="background-color: #449d44"><i class="fa fa-save"></i> {{ trans('button.create') }}</button>
                <button type="button" class="btn btn-danger btn-close" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>
        {!! Form::close() !!}
    </div>
    </div>
    </div>
</div>

<ul class="nav nav-tabs">
  <li class="{{ active('admin::users.users_view') }}"><a  href="{{ route('admin::users.users_view') }}">{{ trans('backend/user.list') }}</a></li>
  <li class="{{ active('admin::users.users_settings') }}"><a  href="{{ route('admin::users.users_settings') }}">{{ trans('backend/user_settings.title') }}</a></li>
  <li class="{{ active('admin::invoices.*') }}"><a  href="{{ route('admin::invoices.index') }}">{{ trans('backend/main.invoices') }}</a></li>
    <li class="{{ active('admin::invoices.*') }}"><a  href="{{ route('admin::feedback.index') }}">{{ trans('backend/main.feedback') }}</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane active in">
    <div class="row ul-row">
        <ul class="panel-nav pull-left">
            <li><a class="active al" id="state-all" href="javascript:void(0)" link="{{route('admin::users.users_view')}}">{{trans('backend/user.all')}}</a></li>
            <li><a class="al" id="inact" href="javascript:void(0)" link="{{route('admin::users.inactivated')}}">{{trans('backend/user.notact')}}</a></li>
            <li><a class="al" id="plan" href="javascript:void(0)" link="{{route('admin::users.users_plan')}}">{{trans('backend/user.userplan')}}</a></li>
            <li><a class="al" id="expire" href="javascript:void(0)" link="{{route('admin::users.epxire_plan')}}">{{trans('backend/user.susb')}}</a></li>
            <li><a class="al" id="new" href="javascript:void(0)" link="{{route('admin::users.new')}}">{{trans('backend/user.new')}}</a></li>
            <li><a class="al" id="pend" href="javascript:void(0)" link="{{route('admin::users.pend')}}">{{trans('backend/user.pend')}}</a></li>
            <li><a class="al" id="susp" href="javascript:void(0)" link="{{route('admin::users.susp')}}">{{trans('backend/user.susp')}}</a></li>
            <li><a class="al" id="roles" href="javascript:void(0)" link="{{route('admin::users.rolesUser')}}">{{trans('backend/user.role')}}</a></li>

        </ul>
    </div>
    <div class="pag">
        <div class="row" style="margin-bottom: -35px;margin-right: 2px;">
                <?php
                    $id   = '';
                    if(count($data)<1){
                        $id = 0;
                    }else{
                        foreach ($data as $key => $value) {
                           $id   = $value->id;
                        }
                    }
                ?>

                <button type="button" class="btn btn-success btn-circle pull-right user-add" value="<?php echo $id; ?>"><i class="fa fa-plus"></i> <span>{{ trans('button.create') }}</span></button>
        </div>
         <table class="table table-hover daTatable dataTable deleteFormModal text-center demo-foo-filtering" data-form="deleteForm" id="users-table">
            <thead>
                <tr style="background-color: #EEE;">
                <th>{{ trans('master.no#') }}</th>
                <th style="padding: 0;"><input type="text" style="margin-bottom: 5px;" name="search" class="form-control" placeholder="{{ trans('master.email') }}" id="search"></th>
                <th class="col-sm-4">{{ trans('backend/user.roles') }} <a class="btn btn-primary btn-xs" href="{{ route('admin::users.users_roles') }}"><i class="fa fa-pencil"></i></a></th>
                <th>{{ trans('master.action') }}</th>
            </tr>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                @foreach ($data as $key => $users)
                <form class="form{{$users->id}}" action="{{route('admin::users.editUser',$users->id)}}" method="get">
                    <tr class="tab-row{{$users->id}} selected_record">
                        <input type="hidden" class="user_id" name="user_id" value="{{$users->id}}">
                        <td>{{ ++$i }}</td>
                        <td>{{ $users->email }}</td>
                        <td>
                            @if(!empty($users->roles))
                            @foreach($users->roles as $v)
                            <label class="label">{{ $v->display_name }}</label>
                            @endforeach
                            @endif
                        </td>
                        <td>
                            <button type="button" name="delete" class="btn btn-danger btn-xs  delete" alt=" {{trans('button.delete')}}" value="{{$users->id}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                </form>
                @endforeach
            </tbody>

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
    .ul-row{
        border-bottom: 1px solid #DDD;
        margin-left: 0px;
        margin-right: 5px;
    }
    ul.panel-nav {
        display: inline-block;
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: transparent;
    }
    ul.panel-nav li {
        float: left;
    }
    ul.panel-nav li a.active {
        border-bottom: 2px solid #5fbeaa;
        color: #111;
    }
    ul.panel-nav li a:hover {
        color: #111;
    }
    ul.panel-nav li a {
        display: block;
        color: silver;
        text-align: center;
        padding: 10px!important;
        margin-bottom: 0;
        text-decoration: none;
        font-weight: bold;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        color: #666;
    }
    table td{
        text-align: left !important;
    }
    .table tbody tr > td:first-of-type,
    .table tbody tr > td:last-of-type{
        text-align: center !important;
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
    .pag{
        min-height: 300px;
    }
    .tab-content{
        border: 1px solid #DDD;
        box-shadow: 5px 5px 5px #999;
    }
</style>
@endsection

@section('page-scripts')

@include(Config::get('back_theme').'.layouts.modals.comfirm_delete')

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

        $('#state-all , #inact , #plan , #expire , #new , #susp , #pend , #roles').click(function () {
                if ($(this).hasClass('active')) {
                    return void (0);
                } else {
                    $('.panel-nav a.active').removeClass('active');
                    $(this).addClass('active');
                    getData(null, $(this).attr('link'));
                }

        });

        function getData(page_number, url) {
                url = url || '?page=' + page_number
                var outerBox = '#home';
                var Box = '#home .pag';
                var loaging = '<div id="overlayPagination" class="overlay overlay-x1"><i class="fa fa-spinner fa-pulse fa-fw" ></i></div>';
                $(Box + ' #overlayPagination').remove();
                $(Box).append(loaging);
                $.ajax({
                    url: url
                }).done(function (data) {
                    $(Box).html(data);
                    $('.pag #overlayPagination').remove();
                }).fail(function () {
                    $('.pag #overlayPagination').remove();
                    $('.pag #overlayError').remove();
                    var error = '<div id="overlayError" class="alert alert-danger" style="margin: 0"><h4>خطأ في الاتصال<i class="fa fa-exclamation fa-fw"></i></h4><p>حدث خطأ اثناء الاتصال قد يكون انقطاع في الاتصال . حاول مرة اخري</p></div>';
                    $(Box).html(error);
                });
            }


        $(".select2").select2();
        $("#add-user-modal .roles").select2({
            placeholder: "Select Roles"
        });
        $("input[type=checkbox]").iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_minimal-blue'
        });
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

        $(document).on('click','table tr.selected_record',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).children('.user_id').val();
            var route = "{{route('admin::users.editUser',['user_id' => 'uid'])}}";
            route = route.replace('uid', id);

            //$('.form'+id).submit();
            window.location.href = route;
        });



/************************************Search Email*****************************************************************/

       /* $('#home').on('keyup','#search',function(){

            $value=$(this).val();
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type : 'POST',
                url: '{{URL::to('backend/searchEmail')}}',
                data:{
                    '_token': $('input[name=_token]').val(),
                    'search':$value
                },
                success:function(data){
                   $('#users-table tbody').html(data);
                }

            });



        });*/



/************************************Add New User***************************************************************/
        $('.tab-content').on('click','.user-add',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id =$(this).val();
            id = ++id;
            $('#add-user-modal').modal({ backdrop: 'static', keyboard: false });
            $('#add-user-modal .btn-success').unbind('click');
            $('#add-user-modal .btn-success').on('click',function(e){

                e.preventDefault();
                e.stopPropagation();

                var email = $('input[name=email]').val();
                var password = $('input[name=password]').val();
                var is_admin = '';
                if ($('input[name=is_admin]').is(':checked')) {
                    is_admin=1;
                }else{
                    is_admin=0;
                }
                var roles=[];
                 $('.select2 option:selected').each(function(){
                     roles.push($(this).val());
                    });

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/addUser') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'email':email,
                        'password':password,
                        'is_admin':is_admin,
                        'roles':roles
                    },
                    success: function(data) {
                        $('#add-user-modal').modal('toggle');
                        close();
                        id++;
                    },

                });

            });


        });
/*****************************************Delete User***********************************************************/
        $(document).on('click','.delete',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id =$(this).val();

            $('#confirm-delete').modal({ backdrop: 'static', keyboard: false });
            $('#confirm-delete .btn-danger').unbind('click');
            $('#confirm-delete .btn-danger').on('click',function(e){

                e.preventDefault();
                e.stopPropagation();

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/removeUser') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'id':id

                    },
                    success: function(data) {
                        $('#confirm-delete').modal('toggle');
                        $('.tab-row'+id).remove();
                    },

                });

            });


        });
/***************************************************************************************************************/


    });
</script>

@endsection
