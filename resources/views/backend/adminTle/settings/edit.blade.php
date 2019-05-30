@extends(Config::get('back_theme').'.layouts.app')
@section('htmlheader_title')
{{ trans('backend/setting.settings_edit') }}
@endsection

@section('contentheader_title')
{{ trans('backend/setting.settings_edit') }}
@endsection

@section('contentheader_description')
{{ trans('backend/setting.settings_edit') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/setting.settings_edit') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">        
        <div class="box box-info">

            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('backend/setting.settings_edit') }}</h3>
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

            {!! Form::model($data, ['method' => 'PATCH','route' => ['admin::settings.update', $data->id]]) !!}

            <div class="box-body">            
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/setting.'.$data->key) }} :</strong>
                        <?php
                        $field = json_decode($data->field, true);
                        ?>
                        @if ($field['type']=='textarea')                   
                                 {!! Form::textarea('value', null, array('placeholder' =>  trans('backend/setting.'.$data->key) ,'size' => $field['size'],'class' => 'form-control')) !!}
                        @else
                                {!! Form::text('value', null, array('placeholder' =>  trans('backend/setting.'.$data->key) ,'class' => 'form-control')) !!}
                        @endif                        
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>                      
                <a class="btn btn-danger pull-right" href="{{ route('admin::settings.index') }}"><i class="fa fa-home "></i> Cancel</a>             
            </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection