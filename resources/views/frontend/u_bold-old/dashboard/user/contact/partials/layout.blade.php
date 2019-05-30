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
            <li><a href="{{ route('home.index') }}">{{trans('master.home')}}</a></li>              
            <li><a href="{{ route('dashboard.index') }}">{{trans('master.dashboard')}}</a></li>      
            @yield('module_breadcrumb')
        </ol>	
    </div>
</div>


<!-- Start Section Main Content -->
<div class="main_contant">
    <div class="container">



        <div class="row">
            <!-- left column/sidebar -->

            @include(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.module_sidebar')

            <!-- edit form column -->
            <div class="col-md-10 personal-info">

                @yield('content_dashboard')
            </div>
        </div>
    </div>




</div>




<!-- End Section Main Content -->	
@endsection