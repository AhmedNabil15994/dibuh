



<!-- Start Top Page Header -->
<div class="top_page_header" >
    <div class="container"  >
        <div class="row">
            <div class="col-lg-3">
                <ul class="list-unstyled login_area"  >
                    <li class="btn_sperator">
                        <a href="{{route('register.index')}}" class="hvr-shrink"> 
                            <i class="fa fa-user-plus" aria-hidden="true"></i> Register
                        </a>
                    </li>
                    <li>
                        <a href="{{route('login')}}" class="hvr-shrink"> 
                            <i class="fa fa-sign-in" aria-hidden="true"></i> Sign In
                        </a>
                    </li>

                </ul>
                <ul class="list-unstyled  login_area"    >

                </ul>

            </div>
            <div class="col-lg-3"  >
 
                    {{ Config::get('languages.available_locales')[App::getLocale()]['native_name'] }}
                    <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ Config::get('languages.available_locales')[App::getLocale()]['native_name'] }}</a>          -->
                    <?php
                    $listLang = Config::get('languages.available_locales');

                    foreach ($listLang as $lang => $language) {
                        if ($lang != App::getLocale()) {  ?>
                     <a href="{{ route('lang.switch', $lang) }}">{{$language['native_name']  }}</a>  
                          
                        <?php
                        
                        }
                    }
                    ?>

 


 
            </div>
            <div class="col-lg-6">		
                <ul class="list-unstyled social_list ">
                    <li><a href="" class="hvr-shutter-out-vertical">
                            <i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i></a></li>
                    <li><a href="" class="hvr-shutter-out-vertical">
                            <i class="fa fa-twitter-square fa-lg" aria-hidden="true"></i></a></li>
                    <li><a href="" class="hvr-shutter-out-vertical">
                            <i class="fa fa-google-plus-square fa-lg" aria-hidden="true"></i></a></li>
                    <li><a href="" class="hvr-shutter-out-vertical">
                            <i class="fa fa-youtube-square fa-lg" aria-hidden="true"></i></a></li>
                    <li><a href="" class="hvr-shutter-out-vertical">
                            <i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a></li>
                    <li><a href="" class="hvr-shutter-out-vertical">
                            <i class="fa fa-pinterest-square fa-lg" aria-hidden="true"></i></a></li>
                </ul>
            </div>

        </div>
    </div>
</div>
<!-- End Top Page Header -->


<!-- Start Page Header -->
<header class="page_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">	
                <div class="logo-image">
                    <!-- 			<a href="http://planetshine.net/demo/goliath-news/">
                                                    <img alt="" src="http://cdn2.goliath-news.cdn.planetshine.net/wp-content/themes/goliath/demo/images/logo-goliath-1-green.png">
                                            </a> -->
                    <a class="hvr-pop" href="#"><span>Dibuh</span> Gate </a>			
                </div>
            </div>

            <div class="col-lg-8 visible-lg">			
                <div class="banner-728x90 ">
                    <a target="_blank" href="http://planetshine.net">
                        <img alt="My awesome banner!" src="http://cdn1.goliath-news.cdn.planetshine.net/wp-content/uploads/goliath/banner-728x90.png">
                    </a>
                </div>	
            </div>
        </div>
    </div>

</header>
<!-- Start Page Header -->

<!-- Start Our Navbar-->
<nav class="navbar navbar-inverse " id="nav_bar">
    <div class="container"><!-- or class="container-fluid" -->

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#multi-level-dropdown" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hvr-pop" href="#"><span>Dibuh</span> Gate </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="multi-level-dropdown">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="{{route('home.index')}}" >Home</a></li>                                
                <li><a href="#">Contact</a></li>        
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>


                

            </ul>
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
</nav> 
<!-- End Our Navbar-->




