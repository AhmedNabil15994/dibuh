<!DOCTYPE html>
<html>
    <head>
        <base href="{{URL::to('').Config::get('assets_frontend')}}">          
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="images/favicon.ico">

        <title>Dibuh - تسجيل  عضوية</title>

        <link href="css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- Custom box scc -->
        <link rel="stylesheet" type="text/css" href="plugins/select2/css/select2.min.css">

       
        <link href="css/core.css" rel="stylesheet" type="text/css" />
        <link href="css/components.css" rel="stylesheet" type="text/css" />
        <link href="css/icons.css" rel="stylesheet" type="text/css" />
        <link href="css/pages.css" rel="stylesheet" type="text/css" />
        <link href="css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="plugins/jquery.steps/css/jquery.steps.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/css/core.css">
        <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/css/components.css">
        <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/css/icons.css">
        <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/css/pages.css">
        <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/css/menu.css">
        <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/css/responsive.css">
        <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/css/style.css">
        <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/css/select2.min.css">
        <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/css/select2-bootstrap.min.css">

        
        
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->


        <script src="js/modernizr.min.js"></script>
        <style type="text/css">
            a[href="#finish"]{
                display: none !important;
            }
            input,.select2-container{
                margin-bottom: 20px !important;
            }
            input[name='captcha']{
                padding: 10px !important;
				width: 150px;
				height: 33px;
            }  
            #myForm input[type="checkbox"]{
                margin-top: 12px;
            }      
            .checkbox{
                margin-bottom: 30px;
            }      
            .submit{
                margin-bottom: 20px;
            }
            textarea.form-control{
                min-width: 100%;
                max-width: 100%;
                min-height: 150px;
                max-height: 150px;
                font-weight: bold;
                color: #777;
            }        
            .card-box{
                padding: 20px 0 !important;
            }
            .row{
                padding: 0 !important;
                margin: 0 !important;
            }

            div.bhoechie-tab-container{
              z-index: 10;
              background-color: #ffffff;
              padding: 0 !important;
              border-radius: 4px;
              -moz-border-radius: 4px;
              border:1px solid #ddd;
              margin-top: 20px;
              margin-left: 50px;
              -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
              box-shadow: 0 6px 12px rgba(0,0,0,.175);
              -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
              background-clip: padding-box;
              opacity: 0.97;
              filter: alpha(opacity=97);
              float: right !important;
              margin-bottom: 20px;
            }
            div.bhoechie-tab-menu{
              padding-right: 0;
              padding-left: 0;
              padding-bottom: 0;
              float: right !important;
            }
            div.bhoechie-tab-menu div.list-group{
              margin-bottom: 0;
            }
            div.bhoechie-tab-menu div.list-group>a{
              margin-bottom: 0;
            }
            div.bhoechie-tab-menu div.list-group>a .glyphicon,
            div.bhoechie-tab-menu div.list-group>a .fa {
              color: #5fbeaa;
            }
            div.bhoechie-tab-menu div.list-group>a:first-child{
              border-top-right-radius: 0;
              -moz-border-top-right-radius: 0;
            }
            div.bhoechie-tab-menu div.list-group>a:last-child{
              border-bottom-right-radius: 0;
              -moz-border-bottom-right-radius: 0;
            }
            div.bhoechie-tab-menu div.list-group>a.active,
            div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
            div.bhoechie-tab-menu div.list-group>a.active .fa{
              background-color: #5fbeaa;
              background-image: #5fbeaa;
              color: #ffffff;
            }
            div.bhoechie-tab-menu div.list-group>a.active:after{
                content: '';
                position: absolute;
                left: -4%;
                top: 50%;
                margin-top: -13px;
                border-left: 0;
                border-bottom: 13px solid transparent;
                border-top: 13px solid transparent;
                border-left: 10px solid #5fbeaa;
                transform: rotateZ(180deg);
            }

            div.bhoechie-tab-content{
              background-color: #ffffff;
              /* border: 1px solid #eeeeee; */
              padding-left: 20px;
              padding-top: 10px;
            }

            div.bhoechie-tab div.bhoechie-tab-content:not(.active){
              display: none;
            }
            .list-group-item.active, 
            .list-group-item.active:hover, 
            .list-group-item.active:focus{
                border-color: #5fbeaa;
            }
            @media(max-width: 767px){
                div.bhoechie-tab-menu div.list-group>a.active:after{
                    display: none;
                }
            }
            @media(max-width: 991px){
                .breadcrum_sec{
                    margin-top: 0px;
                }
            }
            @media (min-width:992px) and (max-width:1065px){
                .breadcrum_sec{
                    margin-top: 70px;
                }
            }
            @media(min-width: 1066px){
                .breadcrum_sec{
                    margin-top: 20px;
                }
            }
            @media(max-width: 768px){
                .form-group{
                    margin-bottom: 50px;
                }
            }
            .modal-dialog{
                width: 100%;
            }
            .btn-default{
                float: left;
                margin-left: 10px;
                margin-top: 30px;
            }
            .modal-header h4{
                margin-bottom: 20px;
            }
            .select2-container--default .select2-selection--single .select2-selection__rendered{
                text-align: right;
                line-height: 30px !important;
                font-size: 15px;
            }
            .alert-success,
            .alert-danger{
                padding: 35px;
                float: right;
                margin-bottom: -20px;
                display: block;
                width: 100%;
                margin-top: 20px;
                text-align: right;
            }
            /*.select2-container .select2-selection--single .select2-selection__rendered {
                line-height: 30px !important;
                font-size: 16px;
                padding-left: 12px !important;
            }*/
        </style>    
    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="wrapper-page" style="width: 100%;">
                <div class=" card-box">
                    <div class="panel-heading">
                        <h3 class="text-center"> تسجيل الدخول الى <strong class="text-custom"> دى بو</strong> </h3>
                    </div>
                    <div class="alert alert-danger hidden" >
                        <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                        <ul>
                            
                        </ul>
                    </div>
                    <div class="alert alert-success text-right hidden" style="padding: 35px;float: right;">
                        <strong>تم التسجيل بنجاح, ارسلنا لك رسالة التفعيل الي البريد الالكتروني الخاص بك</strong><br>
                    </div>
                    <div class="bhoechie-tab-container col-xs-12">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bhoechie-tab-menu pull-right">
                              <div class="list-group">
                                <a href="#" class="list-group-item active text-center">
                                  <h4 class="glyphicon glyphicon-user"></h4><br/>الحساب الشخصي
                                </a>
                                <a href="#" class="list-group-item text-center">
                                  <h4 class="fa fa-building fa-2x"></h4><br/>الشركة
                                </a>
                                <a href="#" class="list-group-item text-center">
                                  <h4 class="glyphicon glyphicon-credit-card"></h4><br/>الضرائب
                                </a>
                                <a href="#" class="list-group-item text-center">
                                  <h4 class="fa fa-university fa-2x"></h4><br/>الباقات
                                </a>
                                <a href="#" class="list-group-item text-center">
                                  <h4 class="fa fa-check fa-2x" style="background-color: transparent; "></h4><br/>انهاء التسجيل
                                </a>
                                
                                
                                
                              </div>
                        </div>
                        <form id="myForm" action="{{ url('/register') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">    
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 bhoechie-tab">
                                <div class="bhoechie-tab-content active">
                                    <div class="modal-dialog" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;margin-bottom:30px;">معلومات الحساب الشخصي</h4>
                                                <div class="box-body">
                                                    <div class="form-group">    
                                                        <div class="col-xs-5 col-sm-3">
                                                            <label for="email">البريد الالكتروني</label>
                                                        </div>        
                                                        <div class="col-xs-7 col-sm-9">               
                                                            <input id="userName-2" name="email" type="text" class=" form-control" >
                                                        </div>   
                                                    </div>  
                                                    <div class="form-group">       
                                                        <div class="col-xs-5 col-sm-3">
                                                            <label for="password-2">كلمة السر</label>
                                                        </div>          
                                                        <div class="col-xs-7 col-sm-9">              
                                                            <input id="password-2" name="password" type="password" class=" form-control" >
                                                        </div>    
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-xs-5 col-sm-3">
                                                            <label for="confirm-2">تأكيد كلمة السر</label>
                                                        </div> 
                                                        <div class="col-xs-7 col-sm-9">
                                                            <input id="confirm-2" type="password" class=" form-control" name="password_confirmation" >
                                                        </div> 
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>    
                                    </div>
                                </div>    
                                <div class="bhoechie-tab-content">
                                    <div class="modal-dialog" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;margin-bottom:30px;">معلومات الشركة</h4>
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <div class="col-xs-5 col-sm-3">
                                                            <label for="company-2">اسم الشركة</label>
                                                        </div> 
                                                        <div class="col-xs-7 col-sm-9">
                                                            <input id="company-2" name="company" type="text" class=" form-control">
                                                        </div>    
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <label for="employees-2">عدد الموظفين</label>
                                                                </div> 
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <select id="employees-2" class="form-control employees" style="direction: rtl;">
                                                                        <option>10 : 25 </option>
                                                                        <option>25 : 50</option>
                                                                        <option>50 : 100</option>
                                                                        <option>100 : 250</option>
                                                                    </select>
                                                                </div>    
                                                            </div>
                                                        </div>  
                                                        <div class="col-sm-6">
                                                            <div class="col-xs-6 col-sm-6">
                                                                <label for="company_type_id-2">نوع الشركة</label>
                                                            </div> 
                                                            <div class="col-xs-6 col-sm-6">
                                                                <select class="form-control company_type_id">
                                                                    <?php $types = \DB::table('company_types')->orderBy('id','ASC')->get(); ?>
                                                                    @foreach($types as $type)
                                                                    <option value="{{$type->id}}">{{$type->name_ar}}</option>    
                                                                    @endforeach
                                                                </select>
                                                            </div>    
                                                        </div>  
                                                    </div>
                                                
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <label for="fname-2">الاسم الاول</label>
                                                                </div> 
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <input id="fname-2" name="fname" type="text" class=" form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <label for="lname-2">الاسم الاخير</label>
                                                                </div> 
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <input id="lname-2" name="lname" type="text" class=" form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <label for="phone-2">التليفون</label>
                                                                </div> 
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <input id="phone-2" name="phone" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <label for="code-2">الرقم البريدي</label>
                                                                </div> 
                                                                <div class="col-xs-6 col-sm-6">
                                                                    <input id="code-2" name="code" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>    
                                    </div>
                                </div>    
                                                
                                <div class="bhoechie-tab-content">
                                    <div class="modal-dialog" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;margin-bottom:30px;">معلومات الضرائب</h4>
                                                <div class="box-body">
                                                    <div class="col-md-7">
                                                        <div align="center" class="embed-responsive embed-responsive-16by9" style="height: 228px;margin-top: -35px;">
                                                            <video controls>
                                                                <source src="{{asset('dibuh-video/www.dibuh.com.mp4')}}" type="video/mp4">
                                                            </video>
                                                        </div>   
                                                    </div>

                                                    <div class="col-md-5">
                                                        <div class="form-group">            
                                                            <div class="col-xs-6 col-sm-12">
                                                                <label for="comm-3">السجل التجاري</label>  
                                                            </div> 
                                                            <div class="col-xs-6 col-sm-12">            
                                                                <input id="comm-3" name="comm" type="text" class=" form-control" >
                                                            </div>
                                                        </div>  
                                                        <div class="form-group">  
                                                            <div class="col-xs-6 col-sm-12">
                                                                <label for="card-3">البطاقة الضريبية</label>        
                                                            </div> 
                                                            <div class="col-xs-6 col-sm-12">       
                                                                <input id="card-3" name="card" type="text" class=" form-control" >
                                                            </div>
                                                        </div>  
                                                        <div class="form-group">   
                                                            <div class="col-xs-6 col-sm-12">
                                                               <label for="num-3">الرقم الضريبي</label> 
                                                            </div> 
                                                            <div class="col-xs-6 col-sm-12">                   
                                                                <input id="num-3" name="num" type="text" class=" form-control" >
                                                            </div>    
                                                        </div>  
                                                    </div>  
                                                </div>  
                                            </div>
                                        </div>    
                                    </div>
                                </div>        
                                <div class="bhoechie-tab-content">
                                    <div class="modal-dialog" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;margin-bottom:30px;">معلومات الباقات المتاحة</h4>
                                                <div class="box-body">
                                    
                                                    <div class="row" style="margin:0;padding: 0;margin-bottom: 25px;">
                                                        <div class="form-group">
                                                            <div class="col-xs-3">
                                                                <label>الباقات المتاحة</label>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <select class="select form-control price_plans">
                                                                    <?php $plans = \DB::table('price_plans')->orderBy('id','DESC')->get(); ?>
                                                                    @foreach($plans as $plan)
                                                                    <option value="{{$plan->id}}">{{$plan->name}}</option>    
                                                                    @endforeach
                                                                </select>
                                                            </div>    
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-xs-3">
                                                            <label>تفاصل الباقة المختارة</label>
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <textarea class="form-control"></textarea>
                                                        </div>    
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>    
                                    </div>
                                </div>            

                                <div class="bhoechie-tab-content">
                                    <div class="modal-dialog" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="box-title" style="border-bottom: 1px solid #DDD; padding-bottom: 15px;">الشروط والاحكام</h4>
                                                <div class="box-body">                                   
                                                    <div class="form-group">
                                                        <div class="col-xs-12">
                                                            <p> {!!captcha_img()!!}  </p>                   
                                                            <input type="text" name="captcha">
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <input type="hidden" class="form-control" required=""  placeholder="{{ trans('adminlte_lang::message.retrypepassword') }}" name="user_role" value="2"/>
                                   
                                                    </div>
                                                    <div>
                                                        <div class="col-xs-12">
                                                            <div class="checkbox checkbox-primary checkbox_register icheck">
                                                                <input id="checkbox-signup" type="checkbox" name="terms">
                                                                <label for="checkbox-signup">اوافق علي <a href="#" data-toggle="modal" data-target="#termsModal">الشروط والاحكام</a></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center m-t-40">
                                                        <div class="col-xs-3"></div>
                                                        <div class="col-xs-6">
                                                            <button class="btn btn-block text-uppercase waves-effect waves-light submit" type="submit" style="background-color: #5FBFAD !important;color: #FFF">
                                                                تسجيل
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>    
                                    </div>
                                </div>            
                                <input type="hidden" name="address">
                                <input type="hidden" name="city">
                                <input type="hidden" name="governorate">
                                <input type="hidden" name="country">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 text-center">
                        <p>
                            هل لديك حساب بالفعل ؟!<a href="{{route('login')}}" class="text-primary m-l-5"><b>تسجيل الدخول</b></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>    

        



        <!-- jQuery  -->
       
    @include(Config::get('front_theme').'.auth.terms')
    @include(Config::get('front_theme').'.layouts.partials.scripts_auth')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="http://maps.googleapis.com/maps/api/js?language=en"></script> 
    <script src="{{URL::to('').Config::get('assets_frontend')}}/plugins/custombox/js/custombox.min.js"></script>
    <script src="/plugins/select2/select2.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/plugins/select2/css/select2.min.css">
    <link href="{{URL::to('').Config::get('assets_frontend')}}/plugins/custombox/css/custombox.css" rel="stylesheet">


    <script>
        $(function () {
            $('select').select2();
            var city ;
            var govern;
            var country;
            var address;
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
                    console.log("Geolocation is not supported by this browser.");
                }
            }

            function showPosition(position) {
                //console.log("Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude);
                var geocoder  = new google.maps.Geocoder();             // create a geocoder object
                var location  = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);    // turn coordinates into an object          
                geocoder.geocode({'latLng': location}, function (results, status) {
                    if(status == google.maps.GeocoderStatus.OK) {           // if geocode success
                        var add=results[0].formatted_address;         // if address found, pass to processing function
                        var value=add.split(",");
                        count=value.length;
                        country=value[count-1];
                        country = $.trim(country);
                        state=value[count-2];
                        city = value[count-3];
                        if(state.indexOf('Governorate')>-1){
                            govern = state.replace('Governorate',"");
                            govern = $.trim(govern);
                        }
                        address = value[count-4]+" "+value[count-5];
                        //console.log(state);
                        //console.log(country+ " test" + state +" test" + city +" test" + address);
                        
                    }
                });    
            }

            getLocation();

           /* var form = $("#myForm").show();
 
            form.steps({
                labels: {
                    //current: "current step:",
                    //pagination: "Pagination",
                    //finish: "Finish",
                    next: "التالي",
                    previous: "السابق",
                    //loading: "Loading ..."
                },
                headerTag: "h3",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                enableAllSteps: true,
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Allways allow previous action even if the current form is not valid!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }
                    // Forbid next action on "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age-2").val()) < 18)
                    {
                        return false;
                    }
                    // Needed in some cases if the user went back (clean up)
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        form.find(".body:eq(" + newIndex + ") label.error").remove();
                        form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                    }
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Used to skip the "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
                    {
                        form.steps("next");
                    }
                    // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        form.steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    form.validate().settings.ignore = ":disabled";
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    alert("Submitted!");
                }
            }).validate({
                //errorPlacement: function errorPlacement(error, element) { element.before(error); },
                rules: {
                    confirm: {
                        equalTo: "#password-2"
                    }
                }
            });*/

            $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                var index = $(this).index();
                $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
            });


            if($("input[name='terms']").is(':checked')){
                $('.submit').removeAttr('disabled');
            }else{
                $('.submit').attr('disabled','true');
            }

            $('input[name="terms"]').on('change',function(){
                if($("input[name='terms']").is(':checked')){
                    $('.submit').removeAttr('disabled');
                }else{
                    $('.submit').attr('disabled','true');
                }
            });
            $('.submit').on('click',function(e){
                //$('#myForm').submit();
                $('#myForm input[name="address"]').val(address);
                $('#myForm input[name="governorate"]').val(govern);
                $('#myForm input[name="city"]').val(city);
                $('#myForm input[name="country"]').val(country);
                e.preventDefault();
                e.stopPropagation();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                    
                $.ajax({
                    type : "POST",
                    url  : "{{route('register')}}",
                    data :{
                        '_token': $('input[name=_token]').val(),
                        "email" : $("#myForm input[name='email']").val(),
                        'password': $("#myForm input[name='password']").val(),
                        'password_confirmation': $("#myForm input[name='password_confirmation']").val(),
                        'terms' : $('#myForm input[name="terms"]').val(),
                        'captcha' : $('#myForm input[name="captcha"]').val(),
                        'user_role' : $('#myForm input[name="user_role"]').val(),
                        'company'   : $('#myForm input[name="company"]').val(),
                        'employees' : $('#myForm .employees option:selected').text(),
                        'first_name' : $('#myForm input[name="fname"]').val(),
                        'last_name' : $('#myForm input[name="lname"]').val(),
                        'phone' : $('#myForm input[name="phone"]').val(),
                        'postal_code' : $('#myForm input[name="code"]').val(),
                        'address' : $('#myForm input[name="address"]').val(),
                        'district' : $('#myForm input[name="city"]').val(),
                        'governorate' : $('#myForm input[name="governorate"]').val(),
                        'country' : $('#myForm input[name="country"]').val(),
                        'commercial_no' : $('#myForm input[name="comm"]').val(),
                        'tax_file_no' : $('#myForm input[name="card"]').val(),
                        'tax_no' : $('#myForm input[name="num"]').val(),
                        'company_type_id' : $('#myForm .company_type_id option:selected').val(),
                        'price_plan_id' : $('#myForm .price_plans option:selected').val(),
                        
                    },
                    success:function(data) {
                       //alert('Registration successful,We Sent You An Activation Mail To Your Email.'); 
                       $('.alert-success').removeClass('hidden');
                       //window.location.href = "{{route('login')}}";
                    },
                    error: function (data) {
                            var response = JSON.parse(data.responseText);
                            $.each(response.errors, function (key, val) {
                                $('.alert-danger').removeClass('hidden');
                                $('.alert-danger').append('<li>'+val+'</li>')
                            });
                    }
                });
            });
            $('#myForm .price_plans').unbind('change');
            $('#myForm .price_plans').change(function(){
                var id = $(this).val();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                    
                $.ajax({
                    type : "POST",
                    url  : "{{route('register.getPlans')}}",
                    data :{
                        '_token': $('input[name=_token]').val(),
                        'id' : id,
                    },
                    success:function(data) {
                        $('#myForm textarea').val(data);   
                    }
                });
            });



       });
    </script>
</body>
 </html>