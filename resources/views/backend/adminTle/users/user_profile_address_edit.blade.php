@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/user.address_edit') }}
@endsection

@section('contentheader_title')
{{ trans('backend/user.address_edit') }}
@endsection

@section('contentheader_description')
{{ trans('backend/user.address_edit') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/user.address_edit') }}
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box box-info">

            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('backend/user.address_edit') }}</h3>
                  <h3 class="box-title">{{ trans('backend/user.address_edit') }}</h3>
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
            {!! Form::model($user, ['method' => 'PATCH','route' => ['admin::users.profile.address.update', $user->id]]) !!}

            <div class="box-body">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.name') }}:</strong>
                        {!! Form::text('name', null, array('placeholder' => trans('backend/user.name'),'class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.street') }}:</strong>
                        {!! Form::text('street', null, array('placeholder' => trans('backend/user.street'),'class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.house_no') }}:</strong>
                        {!! Form::text('house_no', null, array('placeholder' => trans('backend/user.house_no'),'class' => 'form-control')) !!}
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.address_additional') }}:</strong>
                        {!! Form::text('address_additional', null, array('placeholder' => trans('backend/user.address_additional'),'class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.postal_code') }}:</strong>
                        {!! Form::text('postal_code', null, array('placeholder' => trans('backend/user.postal_code'),'class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.city') }}:</strong>
                        {!! Form::text('city', null, array('placeholder' => trans('backend/user.city'),'class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Country:</strong>
                        {!! Form::select('country_id',
                        (['' =>  trans('master.select_item_from_list')] + $countries),
                        $user->country_id,
                        ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>
                    <a class="btn btn-danger pull-right" href="{{ route('admin::users.show',$user->user_id) }}"><i class="fa fa-home "></i>  {{ trans('button.cancel') }}</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
