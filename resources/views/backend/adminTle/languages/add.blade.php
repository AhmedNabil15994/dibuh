@extends(Config::get('back_theme').'.layouts.app')
@section('htmlheader_title')
{{ trans('backend/language.edit') }}
@endsection

@section('contentheader_title')
{{ trans('backend/language.edit') }}
@endsection

@section('contentheader_description')
{{ trans('backend/language.add') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/language.add') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box box-info">

            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('backend/language.add') }}</h3>
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

            {!! Form::open(['route' => ['method'=>'post','admin::languages.save']]) !!}

            <div class="box-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{  trans('backend/language.code') }} :</strong>
                        {!! Form::text('code', null, array('placeholder' =>  trans('backend/language.code' ) ,'class' => 'form-control')) !!}
                    </div>
                </div>
            </div>

            <div class="box-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{  trans('backend/language.name') }} :</strong>
                        {!! Form::text('name', null, array('placeholder' =>  trans('backend/language.name' ) ,'class' => 'form-control')) !!}
                    </div>
                </div>
            </div>

            <div class="box-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{  trans('backend/language.native_name') }} :</strong>
                        {!! Form::text('native_name', null, array('placeholder' =>  trans('backend/language.native_name' ) ,'class' => 'form-control')) !!}
                    </div>
                </div>
            </div>


           <div class="box-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{  trans('backend/language.flag') }} :</strong>
                        {!! Form::text('flag', null, array('placeholder' =>  trans('backend/language.flag' ) ,'class' => 'form-control')) !!}
                    </div>
                </div>
            </div>

            <div class="box-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{  trans('backend/language.regional') }} :</strong>
                        {!! Form::text('regional', null, array('placeholder' =>  trans('backend/language.regional' ) ,'class' => 'form-control')) !!}
                    </div>
                </div>
            </div>

            <div class="box-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{  trans('backend/language.dir') }} :</strong>
                        {!! Form::select('dir', ['ltr'=>'ltr','rtl'=>'rtl'],null, array('class' => 'form-control')) !!}

                    </div>
                </div>
            </div>

            <div class="box-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{  trans('backend/language.txt_dir') }} :</strong>
                        {!! Form::select('txt_dir', ['left'=>'left','right'=>'right'],null, array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>

            <!-- <div class="box-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{  trans('master.is_active') }} :</strong>
                        {!! Form::text('is_active', null, array('placeholder' =>  trans('master.is_active' ) ,'class' => 'form-control')) !!}
                    </div>
                </div>
            </div> -->

            <!-- <div class="box-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{  trans('master.is_default') }} :</strong>
                        {!! Form::text('is_default', null, array('placeholder' =>  trans('master.is_default' ) ,'class' => 'form-control')) !!}
                    </div>
                </div>
            </div> -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>
                <a class="btn btn-danger pull-right" href="{{ route('admin::languages.index') }}"><i class="fa fa-home "></i> Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
