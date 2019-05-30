 
@extends(Config::get('front_theme').'.layouts.default')

@section('title')
- {{$page_title}}
@endsection

@section('page-styles')
<link rel="stylesheet" type="text/css" href="css/user_dashboard.css">
@endsection

@section('content')

<!-- ### Breadcrumb -->
<div class="breadcrum_sec">
    <div class="container">
        <ol class="breadcrumb">
                <li><a href="{{route('home.index')}}">{{trans('master.home')}}</a></li>
            <li class="active">{{trans('master.dashboard')}}</li>
        </ol>	
    </div>
</div>

<!-- End Breadcrumb --> 
<!-- Start Section Main Content -->
<div class="main_contant">
    <div class="container">
        <section class="sec dashboard">         
            <div class="row " >
                <div class="col-md-2">
                    <ul class="nav nav-pills nav-stacked well">
                        <li  class="dashboard_title"><a  href="{{ route('dashboard.index') }}" class="dashboard_title"><i class="fa fa-dashboard"></i> {{trans('master.dashboard')}}</a></li>

                        <li><a href="{{ route('users.main') }}"><i class="fa fa-user"></i> {{trans('frontend/dashboard.user_manager')}}</a></li>
                        <li><a href="{{ route('account.main') }}"><i class="fa fa-user"></i> {{trans('frontend/dashboard.account_manager')}}</a></li>
                        <li><a href="{{ route('contact.main') }}"><i class="fa fa-user"></i> {{trans('frontend/dashboard.contact_manager')}}</a></li>     
                        <li><a href="{{ route('product.main') }}"><i class="fa fa-user"></i> {{trans('frontend/dashboard.product')}}</a></li>  
                        <li><a href="{{ route('cost.main') }}"><i class="fa fa-user"></i> {{trans('frontend/dashboard.cost')}}</a></li>                             
                        <li><a href="{{ route('sales_invoice.main') }}"><i class="fa fa-user"></i> {{trans('frontend/dashboard.sales_invoice')}}</a></li>                          
                        <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> {{trans('master.logout')}}</a></li>
                    </ul>
                </div>
                <div class="col-md-10">

                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-dashboard"></i> tab1</a></li>
                        <li><a href="#tab2" data-toggle="tab"><i class="fa fa-reply-all"></i> tab2</a></li>
                        <li><a href="#tab3" data-toggle="tab"><i class="fa fa-file-text-o"></i> tab3</a></li>
                        <li><a href="#tab4" data-toggle="tab"><i class="fa fa-clock-o"></i> tab4</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                        </div>

                        <div class="tab-pane" id="tab2">
                            tab2
                        </div>


                        <div class="tab-pane" id="tab3">
                            tab 3
                        </div>

                        <div class="tab-pane" id="tab4">
                            tab 4
                        </div>



                    </div>

                </div>
            </div>


    </div>

</section

</div>



<!-- End Section Main Content -->	
@endsection