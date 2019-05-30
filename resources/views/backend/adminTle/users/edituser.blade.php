@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/user.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/user.profile_details') }}
@endsection

@section('contentheader_description')


@endsection


<!--breadcrumb current page-->
@section('previous_breadcrumb')
{{ trans('backend/user.list') }}
@endsection

@section('current_breadcrumb')
{{ trans('backend/user.profile_details') }}
@endsection

@section('content')
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- Notification js -->


@if ($message = Session::get('success'))
<div  class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div  class="alert alert-success" hidden>
    <p class="message"></p>
</div>


<div id="add-user-address" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">{{ trans('backend/user.address_create') }}</h4>
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
                                <strong>{{ trans('backend/user.name') }}:</strong>
                            </div>
                            {!! Form::text('name', null, array('placeholder' => trans('backend/user.name'),'class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.street') }}:</strong>
                            </div>
                            {!! Form::text('street', null, array('placeholder' => trans('backend/user.street'),'class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.house_no') }}:</strong>
                            </div>
                            {!! Form::number('house_no', null, array('placeholder' => trans('backend/user.house_no'),'class' => 'form-control' , 'min' => 0)) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.address_additional') }}:</strong>
                            </div>
                            {!! Form::text('address_additional', null, array('placeholder' => trans('backend/user.address_additional'),'class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.postal_code') }}:</strong>
                            </div>
                            {!! Form::number('postal_code', null, array('placeholder' => trans('backend/user.postal_code'),'class' => 'form-control' , 'min' => 0)) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.city') }}:</strong>
                            </div>
                            {!! Form::text('city', null, array('placeholder' => trans('backend/user.city'),'class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.country') }}:</strong>
                            </div>
                            <select class="form-control select2" name="country_id">
                                <option>{{trans('master.select_item_from_list')}}</option>

                                <?php $countries = \DB::table('countries')->get(); ?>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name_ar}}</option>
                                @endforeach

                            </select>
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

<div id="edit-user-address" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">{{ trans('backend/user.address_edit') }}</h4>
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
                                <strong>{{ trans('backend/user.name') }}:</strong>
                            </div>
                            <input class="form-control" type="text" name="name" placeholder="{{trans('backend/user.name')}}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.street') }}:</strong>
                            </div>
                            <input class="form-control" type="text" name="street" placeholder="{{trans('backend/user.street')}}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.house_no') }}:</strong>
                            </div>
                            <input class="form-control" type="number" name="house_no" placeholder="{{trans('backend/user.house_no')}}" min="0">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.address_additional') }}:</strong>
                            </div>
                            <input class="form-control" type="text" name="address_additional" placeholder="{{trans('backend/user.address_additional')}}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.postal_code') }}:</strong>
                            </div>
                            <input class="form-control" type="number" name="postal_code" placeholder="{{trans('backend/user.postal_code')}}" min="0">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.city') }}:</strong>
                            </div>
                            <input class="form-control" type="text" name="city" placeholder="{{trans('backend/user.city')}}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.country') }}:</strong>
                            </div>
                            <select class="form-control select2" name="country_id">
                                <option>{{trans('master.select_item_from_list')}}</option>

                                <?php $countries = \DB::table('countries')->get(); ?>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name_ar}}</option>
                                @endforeach

                            </select>
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

<div id="add-bank-account" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">{{ trans('backend/user.bank_account_create') }}</h4>
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
                                <strong>{{ trans('backend/user.bank_data_type')}} :</strong>
                            </div>
                            <select class="form-control select2" name="bank_data_type_id">
                                <option>{{ trans('master.select_item_from_list')}}</option>

                                <?php $banks = \DB::table('bank_data_types')->get(); ?>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}">{{$bank->name_ar}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.bank_name')}}:</strong>
                            </div>
                            {!! Form::text('bank_name', null, array('placeholder' => trans('backend/user.bank_name'),'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.id_number')}} :</strong>
                            </div>
                            {!! Form::text('id_number', null, array('placeholder' => trans('backend/user.id_number'),'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.owner_name')}}:</strong>
                            </div>
                            {!! Form::text('owner_name', null, array('placeholder' =>trans('backend/user.owner_name'),'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.iban')}} :</strong>
                            </div>
                            {!! Form::text('iban', null, array('placeholder' => trans('backend/user.iban'),'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.bic')}} :</strong>
                            </div>
                            {!! Form::text('bic', null, array('placeholder' => trans('backend/user.bic'),'class' => 'form-control')) !!}
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

<div id="edit-bank-account" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">{{ trans('backend/user.bank_account_edit') }}</h4>
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
                                <strong>{{ trans('backend/user.bank_data_type')}} :</strong>
                            </div>
                            <select class="form-control select2" name="bank_data_type_id">
                                <option>{{ trans('master.select_item_from_list')}}</option>

                                <?php $banks = \DB::table('bank_data_types')->get(); ?>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}">{{$bank->name_ar}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.bank_name')}}:</strong>
                            </div>
                            {!! Form::text('bank_name', null, array('placeholder' => trans('backend/user.bank_name'),'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.id_number')}} :</strong>
                            </div>
                            {!! Form::text('id_number', null, array('placeholder' => trans('backend/user.id_number'),'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.owner_name')}}:</strong>
                            </div>
                            {!! Form::text('owner_name', null, array('placeholder' =>trans('backend/user.owner_name'),'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.iban')}} :</strong>
                            </div>
                            {!! Form::text('iban', null, array('placeholder' => trans('backend/user.iban'),'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/user.bic')}} :</strong>
                            </div>
                            {!! Form::text('bic', null, array('placeholder' => trans('backend/user.bic'),'class' => 'form-control')) !!}
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
@foreach($data as $user)
@endforeach
<input type="hidden" name="user_id" class="user_id" value="{{$user->id}}">
<div class="col-sm-3 user-info">
	<div class="info">

		<div class="text-center" style="font-weight: bold;font-size: 15px;margin-bottom: 5px;">
			{{ $user->profile->first_name }}  {{ $user->profile->last_name }}
		</div>

		<div class="text-center" style="margin-bottom: 10px;">{{ $user->profile->company }}</div>

		<div class="row">
			<span style="width: 50px;">{{trans('backend/user.email')}}</span>
			<span>{{$user->email}}</span>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<span>{{trans('backend/user.user_status')}}</span>
				<?php $status = '';
					$user_status = $user->is_activated;
						if($user_status == 1){
							$status = 'Active';
						}else if($user_status ==0){
							$status = 'In Active';
						}else if($user_status ==3){
                            $status = 'Pending';
                        }else{
                            $status = 'Check Database :)';
                        }
				?>
			<span><?php echo $status; ?></span>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="roles">
		<h4>Roles</h4>
		<div class="row">
			@if(!empty($user->roles))
                @foreach($user->roles as $v)
                    <span class="label label-primary" style="background-color: #4e7b68 !important;width: auto;">{{ $v->display_name }}</span>
                @endforeach
            @endif
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="col-sm-9 user-details">
	<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#home">{{ trans('backend/user.user_account_details') }}</a></li>
	  <li><a data-toggle="tab" href="#menu1" style="padding-left:10px; padding-right:10px;">{{ trans('backend/user.user_profile_details') }}</a></li>
	  <li><a data-toggle="tab" href="#menu2" style="padding-left:10px; padding-right:10px;">{{ trans('backend/user.user_address_details') }}</a></li>
	  <li><a data-toggle="tab" href="#menu3" style="padding-left:10px; padding-right:10px;">{{ trans('backend/user.user_bank_account_details') }}</a></li>
    @permission('account-delete')
      @if(count($contact_names)>0)
    <li><a data-toggle="tab" href="#menu4" style="padding-left:10px; padding-right:10px;">{{ trans('backend/user.user_delete_account_details') }}</a></li>
      @endif
    @endpermission

	</ul>

	<div class="tab-content">
		<div id="home" class="tab-pane fade in active">
			{!! Form::close() !!}   {!! Form::model($user, ['method' => 'PATCH','route' => ['admin::users.update', $user->id]]) !!}
		        <div class="row" style="padding: 0;margin: 0;">
		            <div class="col-xs-12 col-sm-12 col-md-12">
		                <div class="box box-solid">

		                    <div class="box-header with-border">
		                        <h3 class="box-title">{{ trans('backend/user.edit_form') }}</h3>
		                    </div>
		                    <div class="box-body">
		                        <div class="col-xs-12 col-sm-12 col-md-12">
		                            <div class="form-group">
		                            	<div class="col-sm-3">
		                                	<strong>{{ trans('backend/user.email') }}:</strong>
		                                </div>
		                                {!! Form::text('email', null, array('placeholder' => trans('backend/user.email'),'class' => 'form-control')) !!}
		                            </div>
		                        </div>
		                        <div class="col-xs-12 col-sm-12 col-md-12">
		                            <div class="form-group">
		                            	<div class="col-sm-3">
		                                	<strong>Password:</strong>
		                                </div>
		                                {!! Form::password('password', array('placeholder' => trans('backend/user.password'),'class' => 'form-control')) !!}
		                            </div>
		                        </div>
		                        <div class="col-xs-12 col-sm-12 col-md-12">
		                            <div class="form-group">
		                            	<div class="col-sm-3">
		                                	<strong>Confirm Password:</strong>
		                                </div>
		                                {!! Form::password('confirm-password', array('placeholder' => trans('backend/user.password_confirmation'),'class' => 'form-control confirm_password')) !!}
		                            </div>
		                        </div>
		                        <div class="col-xs-12 col-sm-12 col-md-12">
		                            <div class="form-group">
		                            	<div class="col-sm-3">
		                                	<strong>{{ trans('backend/user.admin_access') }}   :</strong>
		                            	</div>
		                                {!! Form::hidden('is_admin', false) !!}
                        				{!! Form::checkbox('is_admin', true , array('class' => 'icheckbox_flat')) !!}
                        				<input type="hidden" name="check_admin" class="check_admin">
		                            </div>
		                        </div>
		                        <div class="col-xs-12 col-sm-12 col-md-12">
		                            <div class="form-group">
		                            	<div class="col-sm-3">
		                                	<strong>{{ trans('backend/user.roles') }}:</strong>
		                                </div>
		                                <select class="form-control" multiple id="roles" name="roles[]" tabindex="1">
                                            <?php
                                                $id = $user->id;
                                                $user_roles = \DB::table('role_user')->where('user_id' , '=' , $id)->get();
                                            ?>

                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}" attre='<?php echo $id; ?>' style="padding: 5px;">{{$role->display_name}}</option>

                                            @endforeach

                                            @foreach($user_roles as $row)
                                                <input type="hidden" name="test" class="test" value="{{$row->role_id}}">
                                            @endforeach

				                        </select>
		                            </div>
		                        </div>
		                    </div>


		                    <div class="box-footer">
		                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		                            @permission('user-edit')
		                            <button type="button" class="btn btn-success pull-right user-acc-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>
		                            @endpermission
		                        </div>
		                    </div>

		                </div>

		            </div>
		     </div>
		</div>
		<div id="menu1" class="tab-pane fade">
		    {!! Form::model($user->profile) !!}
            <div class="row" style="padding: 0;margin: 0;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('backend/user.user_profile_edit') }}</h3>
                        </div>
                        <div class="box-body">
                            <input type="hidden" name="activate" value="{{$user->is_activated}}">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                	<div class="col-sm-3">
                                    	<strong>{{ trans('backend/user.first_name') }}:</strong>
                                    </div>
                                    {!! Form::text('first_name', null, array('placeholder' => trans('backend/user.first_name'),'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                	<div class="col-sm-3">
                                    	<strong>{{ trans('backend/user.last_name') }}:</strong>
                                    </div>
                                    {!! Form::text('last_name', null, array('placeholder' => trans('backend/user.last_name'),'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                	<div class="col-sm-3">
                                    	<strong>{{ trans('backend/user.company') }}:</strong>
                                    </div>
                                    {!! Form::text('company', null, array('placeholder' =>trans('backend/user.company'),'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                	<div class="col-sm-3">
                                    	<strong>{{ trans('backend/user.mobile') }}:</strong>
                                    </div>
                                    {!! Form::text('mobile', null, array('placeholder' =>trans('backend/user.mobile'),'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                	<div class="col-sm-3">
                                    	<strong>{{ trans('backend/user.fax') }}:</strong>
                                    </div>
                                    {!! Form::text('fax', null, array('placeholder' => trans('backend/user.fax'),'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                	<div class="col-sm-3">
                                    	<strong>{{ trans('backend/user.tax_no') }}:</strong>
                                    </div>
                                    {!! Form::text('tax_no', null, array('placeholder' =>trans('backend/user.tax_no'),'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                	<div class="col-sm-3">
                                    	<strong>Url:</strong>
                                    </div>
                                    {!! Form::text('url', null, array('placeholder' =>'url','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                	<div class="col-sm-3">
    	                                <strong>{{ trans('backend/user.expire_date') }}:</strong>
    	                            </div>
    	                                {!! Form::text('expire_date', null, array('placeholder' =>trans('backend/user.expire_date'),'class' => 'form-control')) !!}

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                	<div class="col-sm-3">
                                    	<strong>{{ trans('backend/user.user_status') }}:</strong>
                                    </div>
                                    <select class="select2 form-control" name="user_status_id">
                                    	<option>{{trans('master.select_item_from_list')}}</option>
                                    	<?php   $status=    \DB::table('user_statuses')->get();
                                        ?>
                                        @foreach($status as $key)
                                            <option value="{{$key->id}}">{{$key->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="box-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    @permission('user-edit')
                                    <button type="button" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>
                                    @endpermission
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            {!! Form::close() !!}
		</div>
		<div id="menu2" class="tab-pane fade">
            {!! Form::model($user->profile) !!}
            <div class="row" style="padding: 0;margin: 0;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('backend/user.address_edit') }}</h3>
                      
                        </div>
                        <?php
                                $address = \DB::table('user_addresses')->get();
                        ?>
                        <?php
                            $id   = '';
                            if(count($address)<1){
                                $id = 0;
                            }else{
                                foreach ($address as $key => $value) {
                                   $id   = $value->id;
                                }
                            }
                        ?>
                        <div class="box-body">
                            <div class="row" style="padding-right: 30px;">
                                <button type="button" class="btn btn-success btn-circle pull-right address-add" data-target="tabs_modal" value="<?php echo $id; ?>"><i class="fa fa-plus"></i> <span>{{ trans('button.create') }}</span></button>
                            </div>
                            @foreach($user->address as $v)
                            <div class="row test{{$v->id}}" style="padding: 0;margin: 0;border-top: 1px solid #f4f4f4;">
                                <div class="col-md-9" style="padding: 10px 0;">
                                    {{$v->name}}<br/>
                                    {{$v->street}} /  {{$v->house_no}}  / {{$v->address_additional}} <br/>
                                    {{$v->postal_code}}  /  {{$v->city}} <br/>
                                    {{$v->country->name}}

                                </div>
                                <div class="col-md-3" style="padding-top: 5%;">
                                    <span class="pull-right">
                                        @permission('user-create')
                                            <button type="button" class="btn btn-primary btn-xs" value="{{$v->id}}" name="{{$v->name}}" street="{{$v->street}}" house_no="{{$v->house_no}}" address_additional="{{$v->address_additional}}" postal_code="{{$v->postal_code}}" city="{{$v->city}}" country="{{$v->country->id}}"><i class="fa fa-edit"></i> {{ trans('button.edit') }}</button >
                                        @endpermission

                                        @permission('user-delete')
                                            <button type="button" class="btn btn-danger btn-xs" value="{{$v->id}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button >
                                        @endpermission


                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

		</div>

		<div id="menu3" class="tab-pane fade">
		   {!! Form::model($user->profile) !!}
            <div class="row" style="padding: 0;margin: 0;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('backend/user.bank_account_edit') }}</h3>
                        </div>
                        <?php
                                $address = \DB::table('user_addresses')->get();
                        ?>
                        <?php
                            $id   = '';
                            if(count($address)<1){
                                $id = 0;
                            }else{
                                foreach ($address as $key => $value) {
                                   $id   = $value->id;
                                }
                            }
                        ?>
                        <div class="box-body">
                            <div class="row" style="padding-right: 30px;">
                                <button type="button" class="btn btn-success btn-circle pull-right bank-add" data-target="tabs_modal" value="<?php echo $id; ?>"><i class="fa fa-plus"></i> <span>{{ trans('button.create') }}</span></button>
                            </div>
                            @foreach($user->bankAccounts as $v)
                            <div class="row test{{$v->id}}" style="padding: 0;margin: 0;border-top: 1px solid #f4f4f4;">
                                <div class="col-md-9" style="padding: 10px 0;">
                                    {{$v->bankDataType['name']}}<br/>
                                    {{$v->owner_name}}<br/>
                                    {{ $v->bank_name  }} <br/>
                                    {{ $v->id_number  }}<br/>
                                    {{ $v->iban  }}<br/>
                                    {{ $v->bic  }}

                                </div>
                                <div class="col-md-3" style="padding-top: 5%;">
                                    <span class="pull-right">
                                        @permission('user-create')
                                            <button type="button" class="btn btn-primary btn-xs" value="{{$v->id}}" bankDataType="{{$v->bankDataType['id']}}" owner_name="{{$v->owner_name}}" bank_name="{{ $v->bank_name  }}" id_number="{{ $v->id_number  }}" iban="{{ $v->iban  }}" bic="{{ $v->bic  }}"><i class="fa fa-edit"></i> {{ trans('button.edit') }}</button >
                                        @endpermission

                                        @permission('user-delete')
                                            <button type="button" class="btn btn-danger btn-xs" value="{{$v->id}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button >
                                        @endpermission


                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

		</div>


<div id="menu4" class="tab-pane fade ">
    {!! Form::open(['class'=>'menu4Delete','url'=>'backend/accountdetails'] ) !!}
        <div class="row" style="padding: 0;margin: 0;">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="box box-solid">

                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('backend/user.delete_details') }}</h3>
                    </div>
                    <div class="box-body">
                      {{Form::hidden('user_id',$user_id)}}
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                              <div class="col-sm-3">
                                  <strong>{{ trans('backend/user.email') }}:</strong>
                                </div>
                                {!! Form::email('email', null, array('placeholder' => trans('backend/user.email'),'class' => 'form-control')) !!}
                            </div>
                        </div> -->
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                              <div class="col-sm-3">
                                  <strong>{{ trans('backend/user.contact_name') }}:</strong>
                                </div>
                                {!! Form::select('contact_name',$contact_names,null,array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                              <div class="col-sm-3">
                                  <strong>{{ trans('backend/user.tables') }}:</strong>
                                </div>
                                {!! Form::select('tables[]',$tables,null,array('class' => 'form-control','multiple'=>'multiple')) !!}


                            </div>
                        </div>
                    </div>


                    <div class="box-footer">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            @permission('account-delete')
                            <button type="submit" class="btn btn-success pull-right user-acc-edit"><i class="fa fa-save"></i> {{ trans('button.delete') }}</button>
                            @endpermission
                        </div>
                    </div>

                </div>

            </div>
     </div>
     {{Form::close()}}
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
    .user-info>div{
    	background-color: #EEE;
    	padding: 10px;
    	border-radius: 5px;
    	border-top: 4px solid #3C8DBC;
    	margin-bottom: 20px;
    }
    .user-info .row {
    	padding: 0;
    	margin: 0;
    	border-top: 1px dashed #777;
    }
    .user-info .row span{
    	padding: 10px 0;
    	display: inline-block;
    }
    .user-info .row span:first-of-type{
    	font-weight: bold;
    	width: 78px;
    }
    .user-info .row span:nth-of-type(2){
    	color:#044e22;
    	float: right;
    }
    .user-info .row:last-of-type{
    	border-bottom: 1px dashed #777;
    	margin-bottom: 15px;
    }
    .roles{
    	padding-top: 5px !important;
    }
    .roles h4{
    	border-bottom: 1px dashed #777;
    	padding-bottom: 5px;
    }
    .roles .row{
    	border: 0 !important;
    	margin-bottom: 0 !important;
    }
    .roles .row span{
    	padding: 3px;
    	display: inline-block;
    	float: left;
    	margin-bottom: 5px;
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
  	.content{
  		min-height: 670px;
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
    .table tbody tr:hover{
        cursor: pointer;
        -webkit-transition: all ease-in-out .3s;
        -moz-transition: all ease-in-out .3s;
        -o-transition: all ease-in-out .3s;
        transition: all ease-in-out .3s;
        background-color: #EBF7FF;
    }
    .table tbody .tab-row.active,.table tbody tr:active{
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
</style>
@endsection

@section('page-scripts')

@include(Config::get('back_theme').'.layouts.modals.comfirm_delete')

<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
    $(function(){

/***********************************************************************************************************/
        $(".select2").select2();

        var selected=[];
            $('#home .test').each(function(){
                selected.push($(this).val());
            });

            option = document.getElementById("roles").options;
            for (var i = selected.length - 1; i >= 0; i--) {
                var sel = i-1;
                option[selected[i] - 1].setAttribute('selected', 'selected');
            }

        $("input[type=checkbox]").iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_minimal-blue'
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
        var activate = $('#menu1 input[name="activate"]').val();
        $('#menu1 .select2').val(activate).trigger('change');

        $("#home .roles").select2({
            placeholder: "Select Roles"
        });

        $("#menu1 .select2").select2({
            placeholder: "Select Status"
        });

        $('.breadcrumb .prev').toggle();
        $('.breadcrumb .prev a').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = "{{URL::to('backend/users_view')}}";
        });
/***********************************************Account Details**************************************************/
		$('#home').on('click','.user-acc-edit',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id =$('.user_id').val();
            var email = $('input[name=email]').val();
            var password = $('input[name=password]').val();
            var confirm_password = $('.confirm_password').val();
            var is_admin = '';
            if ($('input[name=is_admin]').is(':checked')) {
                is_admin=1;
            }else{
                is_admin=0;
            }
            var roles=[];
            $('#home #roles option:selected').each(function(){
                roles.push($(this).val());
            });

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: 'post',
                url: '{{ URL::to('backend/editUserAcc') }}',
                data: {
                    '_token': $('#modal input[name=_token]').val(),
                    'id':id,
                    'email':email,
                    'password':password,
                    'confirm_password':confirm_password,
                    'is_admin':is_admin,
                    'roles':roles
                    },
                success: function(data) {
                    location.reload();
                },

            });
      	});
/***********************************************Profile Details***************************************************/
        $('#menu1').on('click','.user-profile-edit',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id =$('.user_id').val(),
                fname = $('input[name="first_name"]').val(),
                lname = $('input[name="last_name"]').val(),
                company = $('input[name="company"]').val(),
                mobile = $('input[name="mobile"]').val(),
                fax = $('input[name="fax"]').val(),
                tax_no = $('input[name="tax_no"]').val(),
                url = $('input[name="url"]').val(),
                expire_date = $('input[name="expire_date"]').val(),
                user_status_id = $('#menu1 .select2 option:selected').val();

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: 'post',
                url: '{{ URL::to('backend/editUserProfile') }}',
                data: {
                    '_token': $('#modal input[name=_token]').val(),
                    'id':id,
                    'first_name':fname,
                    'last_name':lname,
                    'company':company,
                    'mobile':mobile,
                    'fax':fax,
                    'tax_no':tax_no,
                    'url':url,
                    'expire_date':expire_date,
                    'user_status_id':user_status_id

                    },
                success: function(data) {
                    location.reload();
                },

            });
        });
/***********************************************Address Add*******************************************************/
        $('#menu2').on('click','.address-add',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $('.user_id').val();
            $('#add-user-address').modal({ backdrop: 'static', keyboard: false });
            $('#add-user-address .btn-success').unbind('click');
            $('#add-user-address .btn-success').on('click',function(e){
                var name = $('input[name="name"]').val(),
                    street = $('input[name="street"]').val(),
                    house_no = $('input[name="house_no"]').val(),
                    address_additional = $('input[name="address_additional"]').val(),
                    postal_code = $('input[name="postal_code"]').val(),
                    city = $('input[name="city"]').val(),
                    country_id = $('#add-user-address .select2 option:selected').val();
                e.preventDefault();
                e.stopPropagation();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/addUserAddress') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'user_id':id,
                        'name':name,
                        'street':street,
                        'house_no':house_no,
                        'address_additional':address_additional,
                        'postal_code':postal_code,
                        'city':city,
                        'country_id':country_id
                        },
                    success: function(data) {
                        location.reload();
                    },

                });
            });

        });
/**********************************************Address Remove****************************************************/
        $('#menu2').on('click','.btn-danger',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).val();
            $('#confirm-delete').modal({ backdrop: 'static', keyboard: false });
            $('#confirm-delete .btn-danger').unbind('click');
            $('#confirm-delete .btn-danger').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/removeUserAddress') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'id':id,
                        },
                    success: function(data) {
                        $('#confirm-delete').modal('toggle');
                        $('.test'+id).remove();
                    },

                });
            });

        });
/**********************************************Address Edit*****************************************************/
        $('#menu2').on('click','.btn-primary',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).val();
                name = $(this).attr('name'),
                street = $(this).attr('street'),
                house_no = $(this).attr('house_no'),
                address_additional = $(this).attr('address_additional'),
                postal_code = $(this).attr('postal_code'),
                city = $(this).attr('city'),
                country_id = $(this).attr('country');
            $('#edit-user-address input[name="name"]').val(name);
            $('#edit-user-address input[name="street"]').val(street);
            $('#edit-user-address input[name="house_no"]').val(house_no);
            $('#edit-user-address input[name="address_additional"]').val(address_additional);
            $('#edit-user-address input[name="postal_code"]').val(postal_code);
            $('#edit-user-address input[name="city"]').val(city);
            $('#edit-user-address .select2').val(country_id).trigger('change');

            $('#edit-user-address').modal({ backdrop: 'static', keyboard: false });
            $('#edit-user-address .btn-success').unbind('click');
            $('#edit-user-address .btn-success').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                var name = $('#edit-user-address input[name="name"]').val();
                    street = $('#edit-user-address input[name="street"]').val();
                    house_no = $('#edit-user-address input[name="house_no"]').val();
                    address_additional = $('#edit-user-address input[name="address_additional"]').val();
                    postal_code = $('#edit-user-address input[name="postal_code"]').val();
                    city = $('#edit-user-address input[name="city"]').val();
                    country_id = $('#edit-user-address .select2 option:selected').val();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/editUserAddress') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'id':id,
                        'name':name,
                        'street':street,
                        'house_no':house_no,
                        'address_additional':address_additional,
                        'postal_code':postal_code,
                        'city':city,
                        'country_id':country_id
                        },
                    success: function(data) {
                        location.reload();
                    },

                });
            });

        });
/*********************************************Bank Account Add**************************************************/
        $('#menu3').on('click','.bank-add',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $('.user_id').val();
            $('#add-bank-account').modal({ backdrop: 'static', keyboard: false });
            $('#add-bank-account .btn-success').unbind('click');
            $('#add-bank-account .btn-success').on('click',function(e){
                var bank_name = $('input[name="bank_name"]').val(),
                    id_number = $('input[name="id_number"]').val(),
                    owner_name = $('input[name="owner_name"]').val(),
                    iban = $('input[name="iban"]').val(),
                    bic = $('input[name="bic"]').val(),
                    bank_data_type_id = $('#add-bank-account .select2 option:selected').val();

                e.preventDefault();
                e.stopPropagation();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/addUserBankAccount') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'user_id':id,
                        'bank_name':bank_name,
                        'id_number':id_number,
                        'owner_name':owner_name,
                        'iban':iban,
                        'bic':bic,
                        'bank_data_type_id':bank_data_type_id
                        },
                    success: function(data) {
                        location.reload();
                    },

                });
            });

        });
/**********************************************Bank Account Remove**********************************************/
        $('#menu3').on('click','.btn-danger',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).val();
            $('#confirm-delete').modal({ backdrop: 'static', keyboard: false });
            $('#confirm-delete .btn-danger').unbind('click');
            $('#confirm-delete .btn-danger').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/removeUserBankAccount') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'id':id,
                        },
                    success: function(data) {
                        $('#confirm-delete').modal('toggle');
                        $('.test'+id).remove();
                    },

                });
            });

        });
/**********************************************Bank Account Edit************************************************/
        $('#menu3').on('click','.btn-primary',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).val();
                bankDataType = $(this).attr('bankDataType'),
                owner_name = $(this).attr('owner_name'),
                bank_name = $(this).attr('bank_name'),
                id_number = $(this).attr('id_number'),
                iban = $(this).attr('iban'),
                bic = $(this).attr('bic');

            $('#edit-bank-account .select2').val(bankDataType).trigger('change');
            $('#edit-bank-account input[name="bank_name"]').val(bank_name);
            $('#edit-bank-account input[name="id_number"]').val(id_number);
            $('#edit-bank-account input[name="owner_name"]').val(owner_name);
            $('#edit-bank-account input[name="iban"]').val(iban);
            $('#edit-bank-account input[name="bic"]').val(bic);

            $('#edit-bank-account').modal({ backdrop: 'static', keyboard: false });
            $('#edit-bank-account .btn-success').unbind('click');
            $('#edit-bank-account .btn-success').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/editUserBankAccount') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'id' : id,
                        'bank_name' : $('#edit-bank-account input[name="bank_name"]').val(),
                        'owner_name' : $('#edit-bank-account input[name="owner_name"]').val(),
                        'id_number' : $('#edit-bank-account input[name="id_number"]').val(),
                        'iban' : $('#edit-bank-account input[name="iban"]').val(),
                        'bic'  : $('#edit-bank-account input[name="bic"]').val(),
                        'bank_data_type_id' :  $('#edit-bank-account .select2 option:selected').val()
                        },
                    success: function(data) {
                        location.reload();
                    },

                });
            });

        });
/***************************************************************************************************************/

    $('form.menu4Delete').submit(function(){
      $(this).serialize();
      var this_objct = this;
      $.post($(this).attr('action'),$(this).serialize(),function(result){

      $("#menu4").notify(result.success,{ position:"top" ,className:"success"});

      },


      'json');

      return false;
    });

// });

/***********************************/


    });
</script>

@endsection
