<!DOCTYPE html>
<html >

    @include(Config::get('front_theme').'.layouts.partials_web.head')
    <body data-spy="scroll" data-target="#navbar-menu">

        <!-- Navbar -->
        @include(Config::get('front_theme').'.layouts.partials_web.header')
        <!-- End navbar-custom -->


        <!-- CONTENT -->
        @yield('content')
        <!-- FOOTER -->

        <!-- FOOTER -->
        @include(Config::get('front_theme').'.layouts.partials_web.footer')
        <!-- End Footer -->


        <!-- Back to top -->
        <a href="#" class="back-to-top" id="back-to-top"> <i class="fa fa-angle-up"></i> </a>


        <!-- js placed at the end of the document so the pages load faster -->
        @include(Config::get('front_theme').'.layouts.partials_web.javascript')


    </body>
</html>
