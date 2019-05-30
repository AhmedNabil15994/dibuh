@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/user.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/user.list') }}
@endsection

@section('contentheader_description')
{{ trans('backend/user.list') }}

@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/user.list') }}
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

            {{ trans('backend/user.list') }} 

        </div>
        <div class="pull-right">
            @permission('role-create')
            <a class="btn btn-success btn-md" href="{{ route('admin::users.create') }}"><i class="fa fa-plus"></i> {{ trans('button.create') }}</a> 
            @endpermission
        </div>
    </div>
</div>
<table class="table table-bordered deleteFormModal" data-form="deleteForm">
    <tr>
        <th>{{ trans('master.no#') }}</th>
<!--        <th>Name</th>-->
        <th>{{ trans('master.email') }}</th>
        <th>{{ trans('backend/user.roles') }}</th>
        <th width="280px">{{ trans('master.action') }}</th>
    </tr>
    @foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$i }}</td>
<!--        <td>{{ $user->name }}</td>-->
        <td>{{ $user->email }}</td>
        <td>
            @if(!empty($user->roles))
            @foreach($user->roles as $v)
            <label class="label label-success">{{ $v->display_name }}</label>
            @endforeach
            @endif
        </td>
        <td>
<!--            <a class="btn btn-primary btn-xs" href="{{ route('admin::users.edit',$user->id) }}"><i class="fa fa-edit"></i> roles</a>            -->
            <a class="btn btn-primary btn-xs" href="{{ route('admin::users.show',$user->id) }}"><i class="fa fa-edit"></i> {{ trans('button.edit') }}</a>
            {!! Form::open(['method' => 'DELETE','route' => ['admin::users.destroy', $user->id], 'class' =>' form-delete','style'=>'display:inline']) !!}
                <button type="submit" name="delete" class="btn btn-danger btn-xs  delete" alt=" {{trans('button.delete')}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button>                
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</table>
{!! $data->render() !!}

<!--include modal for  Deleting Confirmation-->
@include(Config::get('back_theme').'.layouts.modals.comfirm_delete')
@endsection
