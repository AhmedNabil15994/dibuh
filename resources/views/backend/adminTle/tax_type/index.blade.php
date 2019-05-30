@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/tax_type.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/tax_type.list') }}
@endsection

@section('contentheader_description')
 

@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/tax_type.list') }}
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

            {{ trans('backend/tax_type.list') }} 

        </div>
        <div class="pull-right">
            @permission('account-create')
            <a class="btn btn-success btn-md" href="{{ route('admin::tax_type.create') }}"><i class="fa fa-plus"></i> {{ trans('button.create') }}</a> 
            @endpermission
        </div>
    </div>
</div>
<table class="table table-bordered deleteFormModal" data-form="deleteForm">
    <tr>
        <th>{{ trans('master.no#') }}</th>

        <th>{{ trans('backend/tax_type.name') }}</th>        

        <th width="280px">{{ trans('master.action') }}</th>
    </tr>
    @foreach ($data as $key => $accountCategory)
    <tr>
        <td>{{ ++$i }}</td>

        <td>{{ $accountCategory->name }}</td>        

        <td>

            @permission('account-edit')
           <a class="btn btn-primary btn-xs" href="{{ route('admin::tax_type.edit',$accountCategory->id) }}"><i class="fa fa-edit"></i> {{ trans('button.edit') }}</a>
            @endpermission
 
            @permission('account-delete')
            {!! Form::open(['method' => 'DELETE','route' => ['admin::tax_type.destroy', $accountCategory->id], 'class' =>' form-delete','style'=>'display:inline']) !!}
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