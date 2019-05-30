@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')

@section('module_breadcrumb')
<li><a href="{{ route('account.index') }}"> {{trans('frontend/dashboard.user_manager')}} </a></li>            
<li class="active"> {{trans('frontend/user.address_create')}}  </li>

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
<h3>{{trans('frontend/user.address_create')}}</h3>
<hr>    

{!! Form::open( ['method' => 'POST','route' => [ 'profile.address.store']]) !!}     
<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/user.name')}}:</label>
    <div class="col-lg-8">
        {!! Form::text('name', null, ['placeholder' => trans('frontend/user.name'),'class' => 'form-control']) !!}     
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/user.street')}}:</label>
    <div class="col-lg-8">
        {!! Form::text('street', null, ['placeholder' => trans('frontend/user.street'),'class' => 'form-control']) !!}     
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/user.house_no')}}:</label>
    <div class="col-lg-8">
        {!! Form::text('house_no', null, ['placeholder' =>  trans('frontend/user.house_no')  ,'class' => 'form-control']) !!}     
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label"> {{trans('frontend/user.address_additional')}} :</label>
    <div class="col-lg-8">
        {!! Form::text('address_additional', null, ['placeholder' => trans('frontend/user.address_additional')  ,'class' => 'form-control']) !!}     
    </div>
</div> 

<div class="form-group">
    <label class="col-lg-3 control-label"> {{trans('frontend/user.postal_code')}}     :</label>
    <div class="col-lg-8">
        {!! Form::text('postal_code', null, ['placeholder' => trans('frontend/user.postal_code')  ,'class' => 'form-control']) !!}     
    </div>
</div>                    



<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/user.city')}} :</label>
    <div class="col-lg-8">
        {!! Form::text('city', null, ['placeholder' => trans('frontend/user.city')  ,'class' => 'form-control']) !!}     
    </div>
</div>


<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/user.country')}}:</label>
    <div class="col-lg-8">
        {!! Form::select('country_id', 
        (['' => trans('master.select_item_from_list')] + $countries), 
        null, 
        ['class' => 'form-control']) !!} 
    </div>

</div>
           



<div class="form-group">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-8">
        <input type="submit" class="btn btn-primary" value="{{trans('button.save')}}">         
        <a class="btn btn-danger pull-left" href="{{ route('profile.address.index') }}"> {{trans('button.cancel')}}</a>           
    </div>
</div>
{!! Form::close() !!}




<!-- End Section Main Content -->	
@endsection