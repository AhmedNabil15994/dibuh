@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/user_settings.title') }}
@endsection

@section('contentheader_title')
{{ trans('backend/user_settings.title') }}
@endsection

@section('contentheader_description')
{{ trans('backend/user_settings.title') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/user_settings.title') }}
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


<div id="add-modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">{{ trans('backend/user_settings.create_new') }}</h4>
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
            <div class="box-body">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.key') }} :</strong>
                        </div>
                        {!! Form::text('key', null, array('placeholder' => trans('backend/user_settings.key'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.value') }} :</strong>
                        </div>
                        {!! Form::text('value', null, array('placeholder' => trans('backend/user_settings.value'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.name') }} :</strong>
                        </div>
                        {!! Form::text('name', null, array('placeholder' => trans('backend/user_settings.name'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.description') }} :</strong>
                        </div>

                        <textarea class="form-control" name="description" placeholder="{{trans('backend/user_settings.description')}}" style="min-height: 150px;max-height: 150px;"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.field') }} :</strong>
                        </div>
                        {!! Form::text('field', null, array('placeholder' => trans('backend/user_settings.field'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.account_type_id') }}:</strong>
                        </div>
                        <select class="type form-control select2" name="type">
                            <option>{{trans('master.select_item_from_list')}}</option>
                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.user_id') }}:</strong>
                        </div>
                        <select class="user_id form-control select2" name="user_id">
                            <option>{{trans('master.select_item_from_list')}}</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->id}} -- {{$user->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12"  style="padding-bottom: 5px;border-bottom: 1px solid #DDD;">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.is_active') }}:</strong>
                        </div>
                        <div class="col-sm-8" style="padding: 0;">
                            <div class="col-sm-12" style="padding: 0; margin-bottom: 10px;">
                                <input type="radio" name="iCheck" value="1"> {{ trans('backend/user_settings.yes') }}
                            </div>
                            <div class="col-sm-12" style="padding: 0; margin-bottom: 10px;">
                                <input type="radio" name="iCheck" value="0" checked> {{ trans('backend/user_settings.no') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer pull-right" style="border-top: 0">
                <button type="submit" class="btn btn-success" style="background-color: #449d44"><i class="fa fa-save"></i> {{ trans('button.create') }}</button>
                <button type="button" class="btn btn-danger btn-close" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>

    </div>
    </div>
    </div>
</div>


<div id="edit-modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">{{ trans('backend/user_settings.edit') }}</h4>
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
            <div class="box-body">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.key') }} :</strong>
                        </div>
                        {!! Form::text('key', null, array('placeholder' => trans('backend/user_settings.key'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.value') }} :</strong>
                        </div>
                        {!! Form::text('value', null, array('placeholder' => trans('backend/user_settings.value'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.name') }} :</strong>
                        </div>
                        {!! Form::text('name', null, array('placeholder' => trans('backend/user_settings.name'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.description') }} :</strong>
                        </div>

                        <textarea class="form-control" name="description" placeholder="{{trans('backend/user_settings.description')}}" style="min-height: 150px;max-height: 150px;"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.field') }} :</strong>
                        </div>
                        {!! Form::text('field', null, array('placeholder' => trans('backend/user_settings.field'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.account_type_id') }}:</strong>
                        </div>
                        <select class="type form-control select2" name="type">
                            <option>{{trans('master.select_item_from_list')}}</option>
                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.user_id') }}:</strong>
                        </div>
                        <select class="user_id form-control select2" name="user_id">
                            <option>{{trans('master.select_item_from_list')}}</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->id}} -- {{$user->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12"  style="padding-bottom: 5px;border-bottom: 1px solid #DDD;">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/user_settings.is_active') }}:</strong>
                        </div>
                        <div class="col-sm-8" style="padding: 0;">
                            <div class="col-sm-12" style="padding: 0; margin-bottom: 10px;">
                                <input type="radio" name="iCheck" value="1" class="first"> {{ trans('backend/user_settings.yes') }}
                            </div>
                            <div class="col-sm-12" style="padding: 0; margin-bottom: 10px;">
                                <input type="radio" name="iCheck" value="0" checked class="second"> {{ trans('backend/user_settings.no') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer pull-right" style="border-top: 0">
                <button type="submit" class="btn btn-success" style="background-color: #449d44"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>
                <button type="button" class="btn btn-danger btn-close" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>

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

    <div class="pag">
        <div class="row">


                <button type="button" class="btn btn-success btn-circle pull-right add" value=""><i class="fa fa-plus"></i> <span>{{ trans('button.create') }}</span></button>
        </div>

        <table class="table table-bordered table-hover deleteFormModal text-center" data-form="deleteForm" id="users-table">
            <tr style="background-color: #EEE;">
                <th>{{ trans('backend/user_settings.id') }}</th>
                <th>{{ trans('backend/user_settings.key') }}</th>
                <th>{{ trans('backend/user_settings.value') }}</th>
                <th>{{ trans('backend/user_settings.name') }}</th>
                <th>{{ trans('backend/user_settings.description') }}</th>
                <th>{{ trans('backend/user_settings.user_id') }}</th>
                <th>{{ trans('master.action') }}</th>
            </tr>
            <?php $i = 0; ?>
            @foreach ($data as $key => $setting)
                <tr class="tab-row{{$setting->id}} selected_record">
                    <input type="hidden" class="user_id" name="user_id" value="{{$setting->id}}">
                    <td>{{ ++$i }}</td>
                    <td class="key1">{{ $setting->key }}</td>
                    <td class="value1">{{ $setting->value }}</td>
                    <?php
                        $name ='';
                        if(!empty($setting->name)){
                            $name = $setting->name;
                        } else{
                            $name = "<span style='color:#c1c1c1;'>No Name</span>";
                        }

                    ?>
                    <td class="name1"><?php echo $name; ?></td>
                    <?php
                        $description ='';
                        if(!empty($setting->description)){
                            $description = $setting->description;
                        } else{
                            $description = "<span style='color:#c1c1c1;'>No Description</span>";
                        }

                    ?>
                    <td class="description1"><?php echo $description; ?></td>
                    <td class="user_id1">{{ $setting->user_id }}</td>
                    <input class="field1" type="hidden" name="field1" value="{{$setting->field}}">
                    <input class="is_active1" type="hidden" name="is_active1" value="{{$setting->is_active}}">
                    <input class="user_setting_type_id1" type="hidden" name="user_setting_type_id1" value="{{$setting->user_setting_type_id}}">
                    <td>
                        <button type="button" name="edit" class="btn btn-primary btn-xs  edit" alt=" {{trans('button.delete')}}" value="{{$setting->id}}"><i class="fa fa-pencil"></i> {{ trans('button.edit') }}</button>

                        <button type="button" name="delete" class="btn btn-danger btn-xs  delete" alt=" {{trans('button.delete')}}" value="{{$setting->id}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button>
                    </td>
                </tr>
            @endforeach
        </table>
        {!! $data->render() !!}

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
<style type="text/css">
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        color: #666;
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
        padding-right: 50px;
        margin-bottom: 20px;
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
<script type="text/javascript">
    $(function(){

/*********************************************** Pagination Code***********************************************/
        $(document).on('click','.pagination a',function(e){
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
        }

        $(".select2").select2();
        $("input[type=radio]").iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });

        function close(){
            $('.modal input').val('');
            $('select').prop('selectedIndex',-1);
            $('.modal .alert').addClass('hidden');
            $('input[type=checkbox]').each(function(){
                    $(this).iCheck('uncheck');
            });
            $('input[type=radio]').each(function(){
                    $(this).iCheck('uncheck');
            });
        }

        $('.modal .btn-danger , .modal .close').on('click',function(){
            close();
        });



/************************************Add New Setting***************************************************************/
        $(document).on('click','.add',function(){
            $('#add-modal').modal({ backdrop: 'static', keyboard: false });
            $('#add-modal .btn-success').unbind('click');
            $('#add-modal .btn-success').on('click',function(e){

                e.preventDefault();
                e.stopPropagation();

                var key = $('input[name=key]').val(),
                    value = $('input[name=value]').val(),
                    name = $('input[name=name]').val(),
                    description = $('#add-modal textarea').val(),
                    field = $('input[name=field]').val(),
                    type = $('.type option:selected').val(),
                    user_id = $('.user_id option:selected').val(),
                    is_active = $(".checked input[name=iCheck]").val();

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/addSetting') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'key':key,
                        'value':value,
                        'name':name,
                        'description':description,
                        'field':field,
                        'user_setting_type_id':type,
                        'user_id':user_id,
                        'is_active':is_active,
                    },
                    success: function(data) {
                        $('#add-user-modal').modal('toggle');
                        location.reload();
                    },

                });

            });


        });
/*************************************************Remove Setting************************************************/
        $(document).on('click','.delete',function(){
            var id = $(this).val();
            $('#confirm-delete').modal({ backdrop: 'static', keyboard: false });
            $('#confirm-delete .btn-danger').unbind('click');
            $('#confirm-delete .btn-danger').on('click',function(e){

                e.preventDefault();
                e.stopPropagation();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/removeSetting') }}',
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
/*************************************************Edit Setting**************************************************/
        $(document).on('click','.edit',function(){
            var id = $(this).val(),
                key = $('.tab-row'+id+' .key1').text(),
                value = $('.tab-row'+id+' .value1').text(),
                user_id = $('.tab-row'+id+' .user_id1').text(),
                is_active = $('.tab-row'+id+' .is_active1').val(),
                type = $('.tab-row'+id+' .user_setting_type_id1').val(),
                name = $('.tab-row'+id+' .name1').text(),
                description = $('.tab-row'+id+' .description1').text(),
                field = $('.tab-row'+id+' .field1').val();

                if(name == "No Name"){
                    name = "";
                }
                if(description == "No Description"){
                    description = "";
                }

            $('#edit-modal input[name="key"]').val(key);
            $('#edit-modal input[name="value"]').val(value);
            $('#edit-modal input[name="name"]').val(name);
            $('#edit-modal textarea').val(description);
            $('#edit-modal input[name="field"]').val(field);
            $('#edit-modal .type').val(type).trigger('change');
            $('#edit-modal .user_id').val(user_id).trigger('change');
            if(is_active == 1 ){

                $('#edit-modal .first').iCheck('check');
                $('#edit-modal .second').iCheck('uncheck');
            }else if(is_active == 0){
                $('#edit-modal .first').iCheck('uncheck');
                $('#edit-modal .second').iCheck('check');
            }

            $('#edit-modal').modal({ backdrop: 'static', keyboard: false });
            $('#edit-modal .btn-success').unbind('click');
            $('#edit-modal .btn-success').on('click',function(e){

                e.preventDefault();
                e.stopPropagation();
                var key = $('#edit-modal input[name=key]').val(),
                    value = $('#edit-modal input[name=value]').val(),
                    name = $('#edit-modal input[name=name]').val(),
                    description = $('#edit-modal textarea').val(),
                    field = $('#edit-modal input[name=field]').val(),
                    type = $('#edit-modal .type option:selected').val(),
                    user_id = $('#edit-modal .user_id option:selected').val(),
                    is_active = $(".checked input[name=iCheck]").val();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/editSetting') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'id':id,
                        'key':key,
                        'value':value,
                        'name':name,
                        'description':description,
                        'field':field,
                        'user_setting_type_id':type,
                        'user_id':user_id,
                        'is_active':is_active
                    },
                    success: function(data) {
                        $('#edit-modal').modal('toggle');
                        $('.tab-row'+id+' .key1').text(key);
                        $('.tab-row'+id+' .value1').text(value);
                        $('.tab-row'+id+' .name1').text(name);
                        $('.tab-row'+id+' .description1').text(description);
                        $('.tab-row'+id+' .user_id1').text(user_id);
                        $('.tab-row'+id+' .field1').val(field);
                        $('.tab-row'+id+' .is_active1').val(is_active);
                        $('.tab-row'+id+' .user_setting_type_id1').val(type);
                        close();
                    },

                });

            });


        });
/***************************************************************************************************************/
    });
</script>

@endsection
