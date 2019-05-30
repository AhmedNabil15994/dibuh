<!doctype html>
<html>

    @include(Config::get('front_theme').'.layouts.partials.head')

<body>

    @yield('loading_overlay')
    
    @include(Config::get('front_theme').'.layouts.partials.header')

    <div class="wrapper">
        <div class="container">
        {{--<!-- Page-Title -->--}}
            {{--<div class="row">--}}
                {{--<div class="col-sm-12">--}}
                    {{--<div class="btn-group pull-right m-t-15 m-b-15">--}}
                        {{--<button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Info <span class="m-l-5"><i class="fa fa-cog"></i></span></button>--}}
                        {{--<ul class="dropdown-menu" role="menu">--}}
                            {{--<li><a href="#">Action</a></li>--}}
                            {{--<li><a href="#">Another action</a></li>--}}
                            {{--<li><a href="#">Something else here</a></li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li><a href="#">Separated link</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<span class="pull-left m-t-15 m-b-15 title-head">--}}
                        {{--عنوان قائمه تجربه--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        @yield('content')
        </div>
    </div>
    @include(Config::get('front_theme').'.layouts.partials.footer')

    @include(Config::get('front_theme').'.layouts.partials.javascript')        

</body>
</html>