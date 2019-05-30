@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/setting.settings_list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/setting.settings_list') }}
@endsection

@section('contentheader_description')
{{ trans('backend/setting.settings_list') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/setting.settings_list') }}
@endsection


@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
    <tr>
        <th> {{ trans('backend/main.no#') }}</th>
        <th> {{ trans('backend/main.key') }}</th>
        <th> {{ trans('backend/main.value') }}</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($data as $key => $row)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $row->key }}</td>
        <td>{{ $row->value }}</td>

        <td>
            @permission('setting-edit')
                <a class="btn btn-primary" href="{{ route('admin::settings.edit',$row->id) }}"> {{ trans('button.edit') }}</a>
            @endpermission


        </td>
    </tr>
    @endforeach
</table>
{!! $data->render() !!}
@endsection