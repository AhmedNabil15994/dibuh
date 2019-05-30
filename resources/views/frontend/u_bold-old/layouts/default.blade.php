<!doctype html>
<html>

    @include(Config::get('front_theme').'.layouts.partials.head')

<body>

    @yield('loading_overlay')
    
    @include(Config::get('front_theme').'.layouts.partials.header')
    
    @yield('content')

    @include(Config::get('front_theme').'.layouts.partials.footer')

    @include(Config::get('front_theme').'.layouts.partials.javascript')        

</body>
</html>