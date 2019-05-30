<!DOCTYPE html>
<html>
    <head>
        <base href="{{URL::to('').Config::get('assets_frontend')}}">         
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="images/favicon.ico">

        <title>Dibuh تسجيل دخول</title>

        <link href="css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="css/core.css" rel="stylesheet" type="text/css" />
        <link href="css/components.css" rel="stylesheet" type="text/css" />
        <link href="css/icons.css" rel="stylesheet" type="text/css" />
        <link href="css/pages.css" rel="stylesheet" type="text/css" />
        <link href="css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            .btn-windows{
                color: #FFF !important;
                background-color: #125acd !important;
                width: fit-content;
                margin-left: 0 !important;
            }
        </style>
        <script src="js/modernizr.min.js"></script>
        
    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class=" card-box">
            <div class="panel-heading"> 
                <h3 class="text-center"> تسجيل الدخول الى <strong class="text-custom"> دى بو</strong> </h3>
            </div> 


            <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif             
 
            <form class="form-horizontal m-t-20" action="{{ url('/login') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input type="email" class="form-control" required="" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email"/>                        
 
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
 
                        <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>                        
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup">
                                <input type="checkbox" name="remember">تذكرنى  
                            </label>
                        </div>
                        
                    </div>
                </div>
                
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-block btn-default  waves-effect waves-light" type="submit">تسجيل دخول </button>
                    </div>
                </div>
                
                
                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <div class="g-signin2" data-onsuccess="onSignIn"></div>

                    <a href="{{ url('/authMic/microsoft') }}" class="btn m-t-10 m-b-10 m-r-10 col-xs-3  btn-social btn-windows btn-flat"><i class="fa fa-windows"></i> Microsoft</a>
                    <a href="{{ url('/auth/twitter') }}" class="btn m-t-10 m-b-10  col-xs-3 col-xs-offset-1 btn-social btn-twitter btn-flat"><i class="fa fa-twitter"></i> Twitter</a>
                    <a href="{{ url('/auth/google') }}" class="btn m-t-10 col-xs-3 col-xs-offset-1 btn-social btn-googleplus btn-flat"><i class="fa fa-google-plus"></i> Google</a>
                </div><!-- /.social-auth-links -->

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
 
                    <a href="{{ url('/password/reset') }}" class="text-dark"><i class="fa fa-lock m-r-5"></i>هل نسيت كلمة المرور ؟</a><br>
                            
                    </div>
                </div>
            </form> 
            
            </div>   
            </div>                              
                <div class="row">
            	<div class="col-sm-12 text-center">
            	     <p>ليس لديدك حساب ؟  
 
                        <a href="{{ url('/register') }}" class="text-primary m-l-5"><b>انشى حساب جديد من هنا </b></a>                         
                     </p>
   
                        
                    </div>
            </div>
            
        </div>
        
        

        
    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap-rtl.min.js"></script>
        <script src="js/detect.js"></script>
        <script src="js/fastclick.js"></script>
        <script src="js/jquery.slimscroll.js"></script>
        <script src="js/jquery.blockUI.js"></script>
        <script src="js/waves.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/jquery.scrollTo.min.js"></script>


        <script src="js/jquery.core.js"></script>
        <script src="js/jquery.app.js"></script>
	
	</body>
</html>