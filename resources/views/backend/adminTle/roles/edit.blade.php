@extends(Config::get('back_theme').'.layouts.app')
@section('htmlheader_title')
{{ trans('backend/role.edit_form') }}
@endsection

@section('contentheader_title')
{{ trans('backend/role.edit_form') }}
@endsection

@section('contentheader_description')
{{ trans('backend/role.edit_form') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/role.edit_form') }}
@endsection 
@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">        
        <div class="box box-info">

            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('backend/role.edit_form') }}</h3>
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
            {!! Form::model($role, ['method' => 'PATCH','route' => ['admin::roles.update', $role->id]]) !!}
            <div class="box-body"> 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/role.name')}} :</strong>
                        {!! Form::text('name', null, array('placeholder' =>trans('backend/role.name'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/role.display_name')}}:</strong>
                        {!! Form::text('display_name', null, array('placeholder' =>trans('backend/role.display_name'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/role.description')}}:</strong>
                        {!! Form::textarea('description', null, array('placeholder' => trans('backend/role.description'),'class' => 'form-control','style'=>'height:100px')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/role.permission')}}:</strong>
                        <br/>
                        @foreach($permission as $value)
                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                            {{ $value->display_name }}</label>
                        <br/>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="box-footer">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>      
                    <a class="btn btn-danger pull-right" href="{{ route('admin::roles.index') }}"><i class="fa fa-home "></i>  {{ trans('button.cancel') }}</a>       
                </div>
            </div>         

            {!! Form::close() !!}
        </div>
    </div>
</div>    
@endsection