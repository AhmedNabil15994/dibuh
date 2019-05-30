@extends(Config::get('back_theme').'.layouts.app')
@section('htmlheader_title')
{{ trans('backend/user.create') }}
@endsection

@section('contentheader_title')
{{ trans('backend/user.create') }}
@endsection

@section('contentheader_description')
{{ trans('backend/user.create') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/user.create') }}
@endsection
@section('content')



<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">        
        <div class="box box-info">

            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('backend/user.create_new') }}</h3>
            </div>
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

            {!! Form::open(array('route' => 'admin::users.store','method'=>'POST')) !!}

            <div class="box-body">
                <!--                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    </div>
                                </div>-->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {!! Form::text('email', null, array('placeholder' => trans('backend/user.email'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Password:</strong>
                        {!! Form::password('password', array('placeholder' => trans('backend/user.password'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Confirm Password:</strong>
                        {!! Form::password('confirm-password', array('placeholder' => trans('backend/user.password_confirmation'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.admin_access') }}:</strong>
                        {!! Form::hidden('is_admin', false) !!}
                        {!! Form::checkbox('is_admin', true) !!}   
                    </div>
                </div>  

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.roles') }}:</strong>
                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                    </div>
                </div>

            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-success pull-left"><i class="fa fa-save"></i>  {{ trans('button.create') }}</button>
                <a class="btn btn-danger pull-right" href="{{ route('admin::users.index') }}"><i class="fa fa-home "></i>  {{ trans('button.cancel') }}</a>             
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection