@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')

@section('module_breadcrumb')
<li><a href="{{ route('account.index') }}"> {{trans('frontend/dashboard.user_manager')}} </a></li>            
<li class="active"> {{trans('frontend/user.bank_account_edit')}} </li>
@endsection

 

@section('content_dashboard')
<!-- right column -->


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
<h3>{{trans('frontend/user.bank_account_edit')}} </h3>
<hr>

{!! Form::model($data, ['method' => 'PATCH','route' => [ 'profile.bankaccount.update', $data->id]]) !!}     
<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/user.bank_data_type')}} :</label>
    <div class="col-lg-8">
        {!! Form::select('bank_data_type_id', 
        (['' =>trans('master.select_item_from_list')] + $bank_data_types), 
        $data->bank_data_type_id, 
        ['class' => 'form-control']) !!}
    </div>

</div>
<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/user.bank_name')}}:</label>
    <div class="col-lg-8">
        {!! Form::text('bank_name', null, array('placeholder' => trans('frontend/user.bank_name'),'class' => 'form-control')) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/user.id_number')}}:</label>
    <div class="col-lg-8">
        {!! Form::text('id_number', null, array('placeholder' => trans('frontend/user.id_number'),'class' => 'form-control')) !!} 
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/user.owner_name')}}:</label>
    <div class="col-lg-8">
        {!! Form::text('owner_name', null, array('placeholder' => trans('frontend/user.owner_name'),'class' => 'form-control')) !!}   
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/user.iban')}}:</label>
    <div class="col-lg-8">
        {!! Form::text('iban', null, array('placeholder' =>trans('frontend/user.iban'),'class' => 'form-control')) !!} 
    </div>
</div>                    

<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/user.bic')}}  :</label>
    <div class="col-lg-8">
        {!! Form::text('bic', null, array('placeholder' => trans('frontend/user.bic'),'class' => 'form-control')) !!}
    </div>
</div>         


<div class="form-group">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-8">
      <input type="submit" class="btn btn-primary" value="{{trans('button.save')}}">         
        <a class="btn btn-danger pull-left" href="{{ route('profile.bankaccount.index') }}"> {{trans('button.cancel')}}</a>                            
    </div>
</div>
{!! Form::close() !!}


@endsection







