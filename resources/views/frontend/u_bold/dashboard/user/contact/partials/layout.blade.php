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

    @yield('content_dashboard')

</div>




<!-- End Section Main Content -->	
@endsection