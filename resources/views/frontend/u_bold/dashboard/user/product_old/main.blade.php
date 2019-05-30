 
@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')
 
 
@section('module_breadcrumb')
  <li class="active">{{trans('frontend/dashboard.product')}}</li>
@endsection

@section('content_dashboard')
            <!-- right column -->
            
 
                <h4>{{trans('frontend/dashboard.product')}}</h4>
<hr>
<div>
 
    <a class="btn btn-info" href="{{ route('product.create') }}">   {{trans('button.create')}}  </a>    
</div>   
            
@endsection


 
 

 