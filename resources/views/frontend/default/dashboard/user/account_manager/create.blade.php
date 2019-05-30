@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')

@section('module_breadcrumb')
<li><a href="{{ route('account.index') }}"> {{trans('frontend/dashboard.account_manager')}} </a></li>            
<li class="active"> {{trans('frontend/account.create_new')}} </li>
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
<h3>{{trans('frontend/account.create_new')}}</h3>
<hr>    
{!! Form::open(array('route' => 'account.store','method'=>'POST')) !!}


<div class="form-group">
    <label class="col-lg-3 control-label">     {{ trans('frontend/account.account_code')}} :</label>
    <div class="col-lg-8">


        {!! Form::text('account_code', null, array('placeholder' => trans('backend/account.account_code'),'class' => 'form-control' )) !!}                        

    </div>

</div>
<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/account.name')}} :</label>
    <div class="col-lg-8">

        {!! Form::text('name', null, array('placeholder' => trans('backend/account.name'),'class' => 'form-control' )) !!}                        

    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">  {{ trans('frontend/account.text')}} :</label>
    <div class="col-lg-8">
        {!! Form::text('text', null, array('placeholder' => trans('backend/account.text'),'class' => 'form-control' )) !!}                            
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">           {{ trans('frontend/account.description')}} :</label>
    <div class="col-lg-8">


        {!! Form::text('description', null, array('placeholder' => trans('backend/account.description'),'class' => 'form-control' )) !!}                        

    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/account.tax')}} :</label>
    <div class="col-lg-8">

        {!! Form::text('tax', null, array('placeholder' => trans('backend/account.tax'),'class' => 'form-control' )) !!}      
    </div>
</div>


<div class="form-group">
    <label class="col-lg-3 control-label">     {{ trans('frontend/account.account_category')}}:</label>
    <div class="col-lg-8">

        {!! Form::select('account_category_id', 
        (['' =>  trans('master.select_item_from_list') ] + $account_category), 
        null, 
        ['class' => 'form-control select2']) !!}     
    </div>
</div>    

<div class="form-group">
    <label class="col-lg-3 control-label">     {{ trans('frontend/account.account_type')}}:</label>
    <div class="col-lg-8">

        {!! Form::select('account_type_id', 
        (['' =>  trans('master.select_item_from_list') ] + $account_type), 
        null, 
        ['class' => 'form-control select2']) !!}     
    </div>
</div>                    

<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/account.is_common')}}:</label>
    <div class="col-lg-8">
        {!! Form::select('is_common', 
        (['' =>  trans('master.select_item_from_list') ] + $is_common), 
        null, 
        ['class' => 'form-control select2']) !!}      
    </div>
</div>   

 


<div class="form-group">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-8">
        <input type="submit" class="btn btn-primary" value="{{trans('button.save')}}">         
        <a class="btn btn-danger pull-left" href="{{ route('account.index') }}"> {{trans('button.cancel')}}</a>           


    </div>
</div>
{!! Form::close() !!}




<!-- End Section Main Content -->	
@endsection