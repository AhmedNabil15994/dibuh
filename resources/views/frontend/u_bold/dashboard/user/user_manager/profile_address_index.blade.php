@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')


@section('module_breadcrumb')
<li><a href="{{ route('account.index') }}"> {{trans('frontend/dashboard.user_manager')}} </a></li>            
<li class="active"> {{trans('frontend/user.profile_address')}} </li>

@endsection

@section('content_dashboard')
<!-- right column -->


<h3> {{trans('frontend/user.profile_address')}} </h3>
<hr>
<div>

    <ul class="list-unstyled">
        @foreach ($data as $row)
        <li><label class="label-info"> {{trans('frontend/user.street')}} :  </label>{{ $row->street }} /
            <label class="label-info"> {{trans('frontend/user.house_no')}}     :  </label>{{ $row->house_no }} /
            <label class="label-info"> {{trans('frontend/user.country')}} :  </label>  {{$row->country->name}}
            <label class="label-info"> {{trans('frontend/user.city')}} :  </label>{{ $row->city }} 
            <a class="btn btn-warning" href="{{ route('profile.address.edit',$row->id) }}"> {{trans('button.edit')}} </a>

            {!! Form::open(['method' => 'DELETE','route' => ['profile.address.destroy', $row->id],'style'=>'display:inline']) !!}
              {!! Form::submit(trans('button.delete') , ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </li>
        <hr>

        @endforeach
    </ul>  
<a class="btn btn-info" href="{{ route('profile.address.create') }}"> {{trans('button.create')}} </a>    
</div>      



@endsection




