@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/account.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/account.list') }}
@endsection

@section('contentheader_description')
 

@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/account.list') }}
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

            {{ trans('backend/account.list') }} 

        </div>
        <div class="pull-right">
            @permission('account-create')
            <a class="btn btn-success btn-md" href="{{ route('admin::account.create') }}"><i class="fa fa-plus"></i> {{ trans('button.create') }}</a> 
            @endpermission
        </div>
    </div>
</div>
<table class="table table-bordered deleteFormModal" data-form="deleteForm">
    <tr>
        <th>{{ trans('master.no#') }}</th>
        <th>{{ trans('backend/account.account_code') }}</th>
        <th>{{ trans('backend/account.name') }}</th>        
        <th>{{ trans('backend/account.text') }}</th>
        <th>{{ trans('backend/account.parent_id') }}</th>        
        <th>{{ trans('backend/account.account_type') }}</th>
        <th width="280px">{{ trans('master.action') }}</th>
    </tr>
    @foreach ($data as $key => $account)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $account->account_code }}</td>
        <td>{{ $account->name }}</td>        
        <td>{{ $account->text }}</td>
        <td>{{ $account->parent['name']}}</td>
        <td>{{ $account->accountType['name'] }}</td>        
        <td>

            @permission('account-edit')
           <a class="btn btn-primary btn-xs" href="{{ route('admin::account.edit',$account->id) }}"><i class="fa fa-edit"></i> {{ trans('button.edit') }}</a>
            @endpermission
 
            @permission('account-delete')
            {!! Form::open(['method' => 'DELETE','route' => ['admin::account.destroy', $account->id], 'class' =>' form-delete','style'=>'display:inline']) !!}
                <button type="submit" name="delete" class="btn btn-danger btn-xs  delete" alt=" {{trans('button.delete')}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button>                                
            {!! Form::close() !!}
            @endpermission
        </td>
    </tr>
    @endforeach
</table>
{!! $data->render() !!}

<!--include modal for  Deleting Confirmation-->
@include(Config::get('back_theme').'.layouts.modals.comfirm_delete')        
@endsection