 
@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')
 
 
@section('module_breadcrumb')
  <li class="active">{{trans('frontend/dashboard.contact_manager')}}</li>
@endsection

@section('content_dashboard')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
            <!-- right column -->
            
 
                <h4>{{trans('frontend/dashboard.contact_manager')}}</h4>
<hr>
<div>

    <ul class="list-unstyled">
        @foreach ($data as $row)
        <li><label class="label-info"> {{trans('frontend/'.$module.'.first_name')}}:  </label>{{ $row->first_name }} /
            <label class="label-info">{{trans('frontend/'.$module.'.last_name')}}:  </label>{{ $row->last_name }} /
            <label class="label-info">{{trans('frontend/'.$module.'.contact_type')}}:  </label> {{  $row->contactType->name  }} /
 
            <label class="label-info">{{trans('frontend/'.$module.'.contact_number')}} :  </label>{{ $row->contact_number }} 
            <a class="btn btn-warning" href="{{ route($module.'.edit',$row->id) }}">{{trans('button.edit')}}</a>
            <a class="btn btn-warning" href="{{ route($module.'.address.index',$row->id) }}">{{trans('button.list_address')}}</a>
            {!! Form::open(['method' => 'DELETE','route' => [$module.'.destroy', $row->id],'style'=>'display:inline']) !!}
            {!! Form::submit(trans('button.delete'), ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </li>
        <hr>

        @endforeach
    </ul> 
    <div style="padding: 10px 0;">
        {!! $data->render() !!}
    </div>
    
    <a class="btn btn-info" href="{{ route($module.'.create') }}">   {{trans('button.create')}}  </a>    
</div>   
            
@endsection


 
 

 