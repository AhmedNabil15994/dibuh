@extends(Config::get('front_theme').'.layouts.default')

@section('title')
- {{$page_title}}
@endsection

@section('page-styles')
<link rel="stylesheet" type="text/css" href="css/user_dashboard.css">
@endsection



@section('content')

<!-- Start Section Main Content -->
<div class="main_contant">
    <div class="container">
        <div class="row">
            <!-- left column/sidebar -->

            {{--@include(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.module_sidebar')--}}

            <!-- edit form column -->
            <div class="col-md-12 personal-info">

                @yield('content_dashboard')
            </div>
        </div>
    </div>




</div>




<!-- End Section Main Content -->	
@endsection