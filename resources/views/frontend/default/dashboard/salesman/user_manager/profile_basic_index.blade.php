@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')


@section('module_breadcrumb')
<li><a href="{{ route('account.index') }}">{{trans('frontend/dashboard.user_manager')}}</a></li>            
<li class="active"> {{trans('frontend/user.profile')}}</li>

@endsection

@section('content_dashboard')
<!-- right column -->


<h3>{{trans('frontend/user.profile_basic_data')}}</h3>
<hr>
<div>



    <a class="btn btn-info" href="{{ route('profile.basic.edit') }}">{{trans('button.edit')}}</a>



</div>



<!-- End Section Main Content -->	
@endsection