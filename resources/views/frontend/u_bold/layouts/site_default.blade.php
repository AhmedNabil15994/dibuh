<!DOCTYPE html>
<html lang="en">

    @include(Config::get('front_theme').'.layouts.partials_site.head')
<body id="home">

        <!-- Navbar -->
        @include(Config::get('front_theme').'.layouts.partials_site.header')
        <!-- End navbar-custom -->


        <!-- CONTENT -->
        @yield('content')
        <!-- FOOTER -->

        <!-- FOOTER -->
        @include(Config::get('front_theme').'.layouts.partials_site.footer')          
        <!-- End Footer -->
        

        <!-- Back to top -->    
        <a href="#" class="back-to-top" id="back-to-top"> <i class="fa fa-angle-up"></i> </a>


        <!-- js placed at the end of the document so the pages load faster -->
        @include(Config::get('front_theme').'.layouts.partials_site.javascript')         


    </body>
</html>