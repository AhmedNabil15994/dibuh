 
@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')
 
 
@section('module_breadcrumb')
  <li class="active">{{trans('frontend/dashboard.contact_manager')}}</li>
@endsection

@section('content_dashboard')
            <!-- right column -->
            
 
                <h4>{{trans('frontend/dashboard.contact_manager')}}</h4>
<hr>
<div>
 
    <a class="btn btn-info" href="{{ route('contact.create') }}">   {{trans('button.create')}}  </a>    
</div>   
            
@endsection


 
 

 