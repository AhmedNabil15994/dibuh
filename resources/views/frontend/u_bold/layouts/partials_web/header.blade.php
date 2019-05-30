<div class="navbar navbar-custom sticky navbar-fixed-top" role="navigation" id="sticky-nav">
            <div class="container">

                <!-- Navbar-header -->
                <div class="navbar-header">

                    <!-- Responsive menu button -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- LOGO -->
                    <a class="navbar-brand logo" href="index.html">
                        Di<span class="text-custom">b</span>uh
                    </a>

                </div>
                <!-- end navbar-header -->

                <!-- menu -->
                <div class="navbar-collapse collapse" id="navbar-menu">

                    <!-- Navbar right -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active">
                            <a href="#home" class="nav-link"> {{trans('frontend/dashboard.main_dashboard')}}</a>
                        </li>
                        <li>
                            <a href="#features" class="nav-link">{{trans('frontend/dashboard.features')}} </a>
                        </li>
                        <li>
                            <a href="#pricing" class="nav-link"> {{trans('frontend/dashboard.prices')}} </a>
                        </li>
                        <li>
                            <a href="#clients" class="nav-link">{{trans('frontend/dashboard.contacts')}} </a>
                        </li>
                        <li>
                            <a href="{{route('login')}}">{{trans('frontend/dashboard.login')}}</a>
                        </li>
                        <li>
                            <a href="{{route('register.index')}}" class="btn btn-white-bordered navbar-btn">{{trans('frontend/dashboard.register')}}</a>
                        </li>
                    </ul>

                </div>
                <!--/Menu -->
            </div>
            <!-- end container -->
        </div>
