@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/user_settings.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/user_settings.list') }}
@endsection

@section('contentheader_description')
 

@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/user_settings.list') }}
@endsection

@section('page-scripts')
@include(Config::get('back_theme').'.layouts.modals.js.comfirm_delete_js')
@show 


@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">        
        <div class="box box-info">  
            @if ($message = Session::get('flash_message'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

 

            <div class="box-header with-border">
                <div class="pull-left">

                     <h3 class="box-title">{{ trans('backend/user_settings.list') }}</h3> 

                </div>
                <div class="pull-right">
                    @permission('user-settings-create')
                    <a class="btn btn-success btn-md" href="{{ route('admin::user_settings.create') }}"><i class="fa fa-plus"></i> {{ trans('button.create') }}</a> 
                    @endpermission
                </div>
            </div>



                
                        <div class="table-responsive">
                        <div class="box-body">
                            <table class="table table-borderless deleteFormModal" data-form="deleteForm">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Key </th><th> Value </th><th> Name </th><th> Description </th><th> User_ID </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($user_settings as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->key }}</td><td>{{ $item->value }}</td><td>{{ $item->name }}</td><td>{{ $item->description }}</td><td>{{ $item->user_id }}</td>
                                        <td>
                                        
                                            @permission('user-settings-edit')
                                                <a href="{{ url('/backend/user_settings/' . $item->id) }}" class="btn btn-success btn-sm" title="View user_setting"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>

                                                <a href="{{ route('admin::user_settings.edit',$item->id)  }}" class="btn btn-primary btn-sm" title="Edit user_setting"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            @endpermission

                                            @permission('user-settings-delete')
                                                {!! Form::open([
                                                'method'=>'DELETE',
                                                'route' => ['admin::user_settings.destroy', $item->id],
                                                'style' => 'display:inline',
                                                'class'=>'form-delete'
                                                ]) !!}
                                                   {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete user_setting" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm delete',
                                                        'title' => 'Delete user_setting',
                                                        'name' => 'delete',
                                                        'alt'=>trans('button.delete')
                                                     )) !!}
                                                {!! Form::close() !!}
                                            @endpermission
                                           
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            
                            <div class="box-footer">
                                <div class="pagination-wrapper"> {!! $user_settings->render() !!} </div>
                            </div>                            
                        </div>

                    
        </div>
    </div>
</div> 
</div> 
 <!--include modal for  Deleting Confirmation-->
@include(Config::get('back_theme').'.layouts.modals.comfirm_delete')         
@endsection


 

 