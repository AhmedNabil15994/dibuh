 
@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')
 
 
@section('module_breadcrumb')
  <li class="active">{{trans('frontend/dashboard.user_manager')}}</li>
@endsection

@section('content_dashboard')
            <!-- right column -->
            
     
                <h4>{{trans('frontend/dashboard.user_manager')}}</h4>
               

          
            
@endsection


 
 

 