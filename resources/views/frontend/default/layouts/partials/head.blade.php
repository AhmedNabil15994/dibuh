<head>
    <base href="{{URL::to('').Config::get('assets_frontend')}}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- meta for responsive mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ Config::get('settings.website_title')  }} @yield('title')</title>	

 @include(Config::get('front_theme').'.layouts.partials.style')     
</head>    