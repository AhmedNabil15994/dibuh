<!doctype html>
<html>
<head>
    @include(app('FrontEndTheme').'.shared.head')
</head>
<body>

    @include(app('FrontEndTheme').'.shared.header')

    @yield('content')
    
    @include(app('FrontEndTheme').'.shared.footer')

    @include(app('FrontEndTheme').'.shared.javascript')        

</body>
</html>