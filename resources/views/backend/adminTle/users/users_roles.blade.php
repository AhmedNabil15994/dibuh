@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/role.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/role.list') }}
@endsection

@section('contentheader_description')
 

@endsection

<!--breadcrumb current page-->
@section('previous_breadcrumb')
{{ trans('backend/user.list') }}
@endsection

@section('current_breadcrumb')
{{ trans('backend/role.list') }}
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div id="add-role" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">{{ trans('backend/role.create_new') }}</h4>
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
	                        	<strong>{{ trans('backend/role.name')}} :</strong>
	                        </div>	
	                        {!! Form::text('name', null, array('placeholder' =>trans('backend/role.name'),'class' => 'form-control')) !!}
	                    </div>
	                </div>
	                <div class="col-xs-12 col-sm-12 col-md-12">
	                    <div class="form-group">
	                    	<div class="col-sm-4">
	                        	<strong>{{ trans('backend/role.display_name')}}:</strong>
	                        </div>	
	                        {!! Form::text('display_name', null, array('placeholder' =>trans('backend/role.display_name'),'class' => 'form-control')) !!}
	                    </div>
	                </div>
	                <div class="col-xs-12 col-sm-12 col-md-12">
	                    <div class="form-group">
	                    	<div class="col-sm-4">
	                        	<strong>{{ trans('backend/role.description')}}:</strong>
	                        </div>	
	                        {!! Form::textarea('description', null, array('placeholder' => trans('backend/role.description'),'class' => 'form-control','style'=>'height:100px')) !!}
	                    </div>
	                </div>
	                <div class="col-xs-12 col-sm-12 col-md-12">
	                    <div class="form-group">
	                    	<div class="col-sm-4">
	                        	<strong>{{ trans('backend/role.permission')}}:</strong>
	                       	</div>
	                       	<div class="col-sm-8">
	                        @foreach($permission as $value)
	                        <label style="width: 220px;">
	                        	<input type="checkbox" class="icheckbox_flat" name="permission" value="{{$value->id}}"> {{ $value->display_name }}
	                        </label>
	                        
	                        @endforeach
	                        </div>
	                    </div>
	                </div>
	            </div>

                <div class="box-footer">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-home"></i>  {{ trans('button.cancel') }}</button>       
                        <button type="button" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-save"></i> {{ trans('button.create') }}</button>
                    </div>
                </div> 
            </div>    
        </div>
    </div>
</div>

<div id="edit-role" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">{{ trans('backend/role.edit') }}</h4>
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
	                        	<strong>{{ trans('backend/role.name')}} :</strong>
	                        </div>	
	                        {!! Form::text('name', null, array('placeholder' =>trans('backend/role.name'),'class' => 'form-control' , 'disabled' => 'disabled')) !!}
	                    </div>
	                </div>
	                <div class="col-xs-12 col-sm-12 col-md-12">
	                    <div class="form-group">
	                    	<div class="col-sm-4">
	                        	<strong>{{ trans('backend/role.display_name')}}:</strong>
	                        </div>	
	                        {!! Form::text('display_name', null, array('placeholder' =>trans('backend/role.display_name'),'class' => 'form-control')) !!}
	                    </div>
	                </div>
	                <div class="col-xs-12 col-sm-12 col-md-12">
	                    <div class="form-group">
	                    	<div class="col-sm-4">
	                        	<strong>{{ trans('backend/role.description')}}:</strong>
	                        </div>	
	                        {!! Form::textarea('description', null, array('placeholder' => trans('backend/role.description'),'class' => 'form-control','style'=>'height:100px')) !!}
	                    </div>
	                </div>
	                <div class="col-xs-12 col-sm-12 col-md-12">
	                    <div class="form-group">
	                    	<div class="col-sm-4">
	                        	<strong>{{ trans('backend/role.permission')}}:</strong>
	                       	</div>
	                       	<div class="col-sm-8">
	                        @foreach($permission as $value)
	                        <label style="width: 220px;">
	                        	<input type="checkbox" class="icheckbox_flat" name="permission" value="{{$value->id}}"> {{ $value->display_name }}
	                        </label>
	                        
	                        @endforeach
	                        </div>
	                    </div>
	                </div>
	            </div>

                <div class="box-footer">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-home"></i>  {{ trans('button.cancel') }}</button>       
                        <button type="button" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>
                    </div>
                </div> 
            </div>    
        </div>
    </div>
</div>




  <div id="home">

    <div class="pag">
        <div class="row">
            @foreach($roles as $role)

            @endforeach

            <button type="button" class="btn btn-success btn-circle pull-right role-add" value="{{$role->id}}"><i class="fa fa-plus"></i> <span>{{ trans('button.create') }}</span></button>
        </div>

        <table class="table table-bordered table-hover deleteFormModal text-center" data-form="deleteForm" id="users-table">
            <tr style="background-color: #EEE;".selected_record>
                <th>{{ trans('master.no#') }}</th>
                <th>{{ trans('backend/role.name') }}</th>
                <th class="col-sm-4">{{ trans('backend/role.description') }}</th>
                <th>{{ trans('master.action') }}</th>
            </tr>
            <?php $i = 0; ?>
           @foreach ($roles as $key => $role)
                <tr class="tab-row{{$role->id}} selected_record">
                    <input type="hidden" class="role_id" name="role_id" value="{{$role->id}}">
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->display_name }}</td>
                    <td>{{ $role->description }}</td>
                    <td>	
                    	<?php 
                              $permission_role = \DB::table("permission_role")->where('role_id',$role->id)->pluck('permission_id');
                              $permission = array();
                              foreach ($permission_role as $key => $value) {
                              	$permission = \DB::table('permissions')->where('id',$value)->get();
                              	foreach($permission as $key){?>	
	                        		<input type="hidden" name="permission_id" class="permission_id" id="{{$key->id}}">
	                        	<?php }
                              }
                              
                        ?>      
                        

                        		                       
                    	<button type="button" class="btn btn-primary btn-xs  role-edit" alt=" {{trans('button.edit')}}" value="{{$role->id}}" name="{{$role->name}}" display="{{$role->display_name}}" description="{{$role->description}}"><i class="fa fa-pencil"></i> {{ trans('button.edit') }}</button>    

                        <button type="button" name="delete" class="btn btn-danger btn-xs  role-delete" alt=" {{trans('button.delete')}}" value="{{$role->id}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button>                
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </table>
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
    textarea{
    	min-height: 150px;
    	max-height: 150px;
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

        $("input[type=checkbox]").iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_minimal-blue'
        });

        function close(){
            $('.modal input[type="text"] , .modal input[type="number"]').val('');
            $('select').prop('selectedIndex',-1);
            $('.modal .alert').addClass('hidden');
            $('input[type=checkbox]').each(function(){
                    $(this).iCheck('uncheck');
            });
        }

        $('.modal .btn-danger , .modal .close').on('click',function(){
                close();
        });

        $('.breadcrumb .prev').toggle();
        $('.breadcrumb .prev a').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = "{{URL::to('backend/users_view')}}";
        });
/*************************************************Add Role********************************************************/
		$(document).on('click','.role-add',function(){
			$('#add-role').modal({ backdrop: 'static', keyboard: false });
            $('#add-role .btn-success').unbind('click');    
            $('#add-role .btn-success').on('click',function(e){
            	var perm=[];
                $.each($("input[name='permission']:checked"), function(){
                        perm.push($(this).val());
                });
                var name = $('#add-role input[name="name"]').val(),
                	display_name = $('#add-role input[name="display_name"]').val(),
                	description  = $('#add-role textarea').val();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/addRole') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'name':name,
                        'display_name':display_name,
                        'description':description,
                        'permission':perm   
                    },
                    success: function(data) {   
                        $('#add-role').modal('toggle');   
                        location.reload();
                    },
                    
                });

            });
		});
/*************************************************Remove Role*****************************************************/
		$(document).on('click','.role-delete',function(){
			var id = $(this).val();
			$('#confirm-delete').modal({ backdrop: 'static', keyboard: false });
            $('#confirm-delete .btn-danger').unbind('click');    
            $('#confirm-delete .btn-danger').on('click',function(e){
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/removeRole') }}',
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

/**************************************************Edit Role******************************************************/
		$(document).on('click','.role-edit',function(){
			var id = $(this).val(),
				name = $(this).attr('name'),
				display_name = $(this).attr('display'),
				description = $(this).attr('description');
				var IDs = [];
                var parent =$(this).parent();
                parent.find(".permission_id").each(function(){ IDs.push(this.id); });
                for (var i = IDs.length - 1; i >= 0; i--) {
                    $('#edit-role input[type=checkbox]').each(function(){
                        if($(this).val() == IDs[i]){
                            $(this).iCheck('check');
                        }
                    });
                }

			$('#edit-role input[name="name"]').val(name);
			$('#edit-role input[name="display_name"]').val(display_name);
			$('#edit-role textarea').val(description);	

			$('#edit-role').modal({ backdrop: 'static', keyboard: false });
            $('#edit-role .btn-success').unbind('click');    
            $('#edit-role .btn-success').on('click',function(e){
            	
            var name = $('#edit-role input[name="name"]').val(),
            	display_name = $('#edit-role input[name="display_name"]').val(),	
            	description  = $('#edit-role textarea').val()
            	perm=[];
                $.each($("#edit-role input[name='permission']:checked"), function(){
                        perm.push($(this).val());
                });

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/editRole') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'role_id':id,
                        'permission' :perm,
                        'name' : name,
                        'display_name' : display_name,
                        'description'  : description
                    },
                    success: function(data) {   
                        location.reload();
                    },
                    
                });

            });
		});
/*****************************************************************************************************************/
    });
</script>
 
@endsection
