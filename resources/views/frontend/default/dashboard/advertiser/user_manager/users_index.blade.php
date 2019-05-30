@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')


@section('module_breadcrumb')
<li><a href="{{ route('account.index') }}"> {{trans('frontend/dashboard.user_manager')}} </a></li>           
<li class="active"> {{trans('frontend/user.created_users')}} </li>

@endsection
 

@section('content_dashboard')
<!-- right column -->


<h3>{{trans('frontend/user.created_users')}} </h3>
<hr>
<div>

    <ul class="list-unstyled">
        @foreach ($data as $row)
        <li><label class="label-info">{{trans('frontend/user.user_id')}} :  </label> {{ $row->id }} / <label class="label-info">{{trans('frontend/user.email')}}:  </label> {{ $row->email }} 
 
        </li>
        <hr>

        @endforeach
    </ul>  

<a class="btn btn-info" href="{{ route('users.create') }}">{{trans('button.create')}}</a>    
</div>      



@endsection




