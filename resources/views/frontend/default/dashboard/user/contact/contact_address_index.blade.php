 
@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')
 
 
@section('module_breadcrumb')
  <li ><a href="{{ route($module.'.main') }}"> {{trans('frontend/dashboard.contact_manager')}}</a></li>
<li class="active"> {{trans('frontend/'.$module.'.address')}} </li>  
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
        <li><label class="label-info"> {{trans('frontend/user.street')}} :  </label>{{ $row->street }} /
            <label class="label-info"> {{trans('frontend/user.house_no')}}     :  </label>{{ $row->house_no }} /
            <label class="label-info"> {{trans('frontend/user.country')}} :  </label>  {{$row->country->name}}
            <label class="label-info"> {{trans('frontend/user.city')}} :  </label>{{ $row->city }} 
            <a class="btn btn-warning" href="{{ route('contact.address.edit',[$id,$row->id]) }}"> {{trans('button.edit')}} </a>

            {!! Form::open(['method' => 'DELETE','route' => ['contact.address.destroy', $row->id],'style'=>'display:inline']) !!}
              {!! Form::submit(trans('button.delete') , ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </li>
        <hr>

        @endforeach
    </ul> 
    <div style="padding: 10px 0;">
        {!! $data->render() !!}
    </div>
    
    <a class="btn btn-info" href="{{ route($module.'.address.create',$id) }}">   {{trans('button.create')}}  </a>    
</div>   
            
@endsection


 
 

 