 
<head>
    <base href="{{URL::to('').Config::get('assets_frontend_web')}}">        
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ Config::get('settings.website_description') }}" >
    <meta name="author" content="Coderthemes">
   
    <link rel="shortcut icon" href="images/favicon.ico">

    <title>{{ Config::get('settings.website_title')  }} | @yield('title')</title>
    @include(Config::get('front_theme').'.layouts.partials_web.style')
</head>

