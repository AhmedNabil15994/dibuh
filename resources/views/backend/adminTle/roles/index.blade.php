@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/role.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/role.list') }}
@endsection

@section('contentheader_description')
{{ trans('backend/role.list') }}

@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/role.list') }}
@endsection

@section('page-scripts')
@include(Config::get('back_theme').'.layouts.modals.js.comfirm_delete_js')
@show 

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">

            {{ trans('backend/role.list') }} 

        </div>
        <div class="pull-right">
            @permission('role-create')
            <a class="btn btn-success btn-md" href="{{ route('admin::roles.create') }}"><i class="fa fa-plus"></i> {{ trans('button.create') }}</a> 
            @endpermission
        </div>
    </div>
</div>
<table class="table table-bordered deleteFormModal" data-form="deleteForm">
    <tr>
        <th>{{ trans('master.no#') }}</th>
        <th>{{ trans('backend/role.name') }}</th>
        <th>{{ trans('backend/role.description') }}</th>
        <th width="280px">{{ trans('master.action') }}</th>
    </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->display_name }}</td>
        <td>{{ $role->description }}</td>
        <td>

            @permission('role-edit')
            <a class="btn btn-primary btn-xs" href="{{ route('admin::roles.edit',$role->id) }}"><i class="fa fa-edit"></i> {{ trans('button.edit') }}</a>
            @endpermission
            @permission('role-delete')
            {!! Form::open(['method' => 'DELETE','route' => ['admin::roles.destroy', $role->id], 'class' =>' form-delete','style'=>'display:inline']) !!}
                <button type="submit" name="delete" class="btn btn-danger btn-xs  delete" alt=" {{trans('button.delete')}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button>                                
            {!! Form::close() !!}
            @endpermission
        </td>
    </tr>
    @endforeach
</table>
{!! $roles->render() !!}

<!--include modal for  Deleting Confirmation-->
@include(Config::get('back_theme').'.layouts.modals.comfirm_delete')        
@endsection