@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')


@section('module_breadcrumb')
<li><a href="{{ route('account.index') }}"> {{trans('frontend/dashboard.user_manager')}}</a></li>            
<li class="active"> {{trans('frontend/user.profile_basic_edit')}}</li>

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
<h3>{{trans('frontend/user.profile_basic_edit')}}</h3>
<hr>

                    {!! Form::model($data, ['method' => 'PATCH','route' => [ 'profile.basic.update', $data->id]]) !!}     
                    
                  
                                       
                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{trans('frontend/user.first_name')}}:</label>
                        <div class="col-lg-8">
                            {!! Form::text('first_name', null, ['placeholder' => trans('frontend/user.first_name'),'class' => 'form-control']) !!}     
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{trans('frontend/user.last_name')}}:</label>
                        <div class="col-lg-8">
                            {!! Form::text('last_name', null, ['placeholder' => trans('frontend/user.last_name'),'class' => 'form-control']) !!}     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{trans('frontend/user.company')}}:</label>
                        <div class="col-lg-8">
                            {!! Form::text('company', null, ['placeholder' => trans('frontend/user.company'),'class' => 'form-control']) !!}     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{trans('frontend/user.phone')}}:</label>
                        <div class="col-lg-8">
                            {!! Form::text('phone', null, ['placeholder' =>  trans('frontend/user.phone'),'class' => 'form-control']) !!}     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{trans('frontend/user.mobile')}}:</label>
                        <div class="col-lg-8">
                            {!! Form::text('mobile', null, ['placeholder' => trans('frontend/user.mobile'),'class' => 'form-control']) !!}     
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{trans('frontend/user.fax')}}:</label>
                        <div class="col-lg-8">
                            {!! Form::text('fax', null, ['placeholder' =>  trans('frontend/user.fax'),'class' => 'form-control']) !!}     
                        </div>
                    </div>   




                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input type="submit" class="btn btn-primary" value="{{trans('button.save')}}">

                           <a class="btn btn-danger pull-left" href="{{ route('profile.basic.index') }}"> {{trans('button.cancel')}}</a>   
                        </div>
                    </div>
                    {!! Form::close() !!}
                     



<!-- End Section Main Content -->	
@endsection