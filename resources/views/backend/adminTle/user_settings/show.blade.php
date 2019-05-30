@extends(Config::get('back_theme').'.layouts.app')
@section('htmlheader_title')
{{ trans('backend/user_settings.title') }}
@endsection

@section('contentheader_title')
{{ trans('backend/user_settings.title') }}
@endsection

@section('contentheader_description')
{{ trans('backend/user_settings.contentheader_description') }}
@endsection

@section('content')
   
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">        
        <div class="box box-info">


            <div class="box-header with-border">
                <div class="pull-left">

                     <h3 class="box-title">{{ trans('backend/user_settings.title') }}</h3> 

                </div>
                <div class="pull-right">
                    @permission('user-settings-edit')
                        <a href="{{ url('backend/user_settings/' . $user_setting->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit user_setting"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['backend/user_settings', $user_setting->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete user_setting',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                    @endpermission
                </div>
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

                        <div class="box-body"> 


                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>ID</th><td>{{ $user_setting->id }}</td>
                                        </tr>
                                        <tr><th> Key </th><td> {{ $user_setting->key }} </td></tr><tr><th> Value </th><td> {{ $user_setting->value }} </td></tr><tr><th> Name </th><td> {{ $user_setting->name }} </td></tr><tr><th> Description </th><td> {{ $user_setting->description }} </td></tr><tr><th> Field </th><td> {{ $user_setting->field }} </td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
        </div>
    </div>
</div> 
   
@endsection