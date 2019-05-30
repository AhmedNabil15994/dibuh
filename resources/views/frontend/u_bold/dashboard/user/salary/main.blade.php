 
@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')

 
@section('module_breadcrumb')
  <li class="active">{{trans('frontend/dashboard.sales_invoice')}}</li>
@endsection

@section('content_dashboard')
            <!-- right column -->
            
 
                <h4>{{trans('frontend/dashboard.sales_invoice')}}</h4>
<hr>
<div>
 
    <a class="btn btn-info" href="{{ route('salary.create') }}">   {{trans('button.create')}}  </a>    
</div>   
            
@endsection


 
 

 