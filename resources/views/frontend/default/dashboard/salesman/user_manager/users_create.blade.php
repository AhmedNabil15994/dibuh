@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')


@section('module_breadcrumb')
    <li><a href="{{ route('account.index') }}"> {{trans('frontend/dashboard.user_manager')}} </a></li>           
    <li class="active"> {{trans('frontend/user.create_user')}} </li>
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
    <h3> {{trans('frontend/user.create_user')}}</h3>
<hr>    

    {!! Form::open( ['method' => 'POST','route' => [ 'users.store']]) !!}     


    <div class="form-group">
        <label class="col-lg-3 control-label">{{trans('frontend/user.email')}}:</label>
        <div class="col-lg-8">
            {!! Form::text('email', null, ['placeholder' => 'Email','class' => 'form-control']) !!}     
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">{{trans('frontend/user.password')}}:</label>
        <div class="col-lg-8">
            {!! Form::password('password', null, ['placeholder' => trans('frontend/user.password'),'class' => 'form-control']) !!}     
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">{{trans('frontend/user.password_confirmation')}}:</label>
        <div class="col-lg-8">
            {!! Form::password('password_confirmation', null, ['placeholder' => trans('frontend/user.password_confirmation'),'class' => 'form-control']) !!}     
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">{{trans('frontend/user.user_type')}}:</label>
        <div class="col-lg-8">
            <select name="user_role" class="form-control ">
                        <option value="2">{{trans('frontend/user.user')}}</option>
                        <option value="4">{{trans('frontend/user.advertiser')}}</option>
                    </select>                        
              
        </div>
    </div>       
    
 



    <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-8">
    <input type="submit" class="btn btn-primary" value="{{trans('button.save')}}">         
        <a class="btn btn-danger pull-left" href="{{ route('profile.address.index')}}"> {{trans('button.cancel')}}</a>        
                        
        </div>
    </div>
    {!! Form::close() !!}
 



<!-- End Section Main Content -->	
@endsection