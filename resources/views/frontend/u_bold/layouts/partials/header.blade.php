



<style>
a:hover{color:black;}
a:visited{color:black;}
a:active{
   color:black
}
a{ color:black}
.introjs-helperLayer{
  color:black;important;
}

.box-title{
    border-bottom: 1px solid #DDD;
    padding: 15px 10px;
    padding-top: 0;
    margin-bottom:20px;
}

.sidenav {
    height: 100%; /* 100% Full-height */
    width: 0; /* 0 width - change this with JavaScript */
    position: fixed; /* Stay in place */
    z-index: 10; /* Stay on top */
    top: 60px; /* Stay at the top */
    left: 0;
    background-color: #f9f9f9; /*#36404A; Black*/
    overflow: hidden; /* Disable horizontal scroll */
    padding-top: 15px; /* Place content 60px from the top */
    transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
    box-shadow: 5px 5px 5px #999;
    border-radius: 5px;
}


/* The navigation menu links */
.sidenav a {
    /*padding: 8px 8px 8px 32px;*/
    text-decoration: none;
   /*font-size: 25px;
    color: #818181;*/
    display: block;
    transition: 0.3s;
    padding: 10px 15px;
    border-bottom: 1px solid #DDD;
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
    /*color: #f1f1f1;*/
    background-color: #5FBEAA;
}


/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
</style>
<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container">

            <!-- Logo container-->
            <div class="logo">
                <a href="{{route('dashboard.index')}}" class="logo"><span class="firstLogo">Di</span><span>BUh</span></a>
            </div>
            <!-- End Logo container-->

            <div id="mySidenav" class="sidenav">
                    <h4 class="box-title">{{trans('button.create')}}</h4>
                    <div class="box-body">
                        <div aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item waves-effect waves-light" href="{{route('sales_invoice.create')}}">{{trans('frontend/dashboard.create_sales_invoice')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('contact.create')}}">{{trans('frontend/dashboard.create_contact')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('finance.create')}}">{{trans('frontend/dashboard.create_finance')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('abstract.create')}}">{{trans('frontend/dashboard.create_abstract')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('other_income.create')}}">{{trans('frontend/dashboard.create_other_income')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('cost.create')}}">{{trans('frontend/dashboard.create_cost')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('cost_other.create')}}">{{trans('frontend/dashboard.create_cost_other')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('sales_invoice_return.create')}}">{{trans('frontend/dashboard.create_sales_invoice_return')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('salary.create')}}">{{trans('frontend/dashboard.create_salary')}}</a>
                        </div>
                    </div>
            </div>

            <div class="menu-extras">

                <ul class="nav navbar-nav navbar-right pull-right">

<!--                    <li class="dropdown navbar-c-items">
                        <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-globe"></i> Language </a>
                        <ul class="dropdown-menu btn-lang">
                            <li><a href="javascript:void(0)">{{ Config::get('languages.available_locales')[App::getLocale()]['native_name'] }}</a></li>
                            <?php
                            $listLang = Config::get('languages.available_locales');
                            foreach ($listLang as $lang => $language) {
                                if ($lang != App::getLocale()) {  ?>
                                <?php
                                }
                            }
                            ?>
                        </ul>
                    </li>-->

<!--                    <li class="dropdown navbar-c-items">
                        <a href="#" class="waves-effect waves-light profile"> Settings </a>
                    </li>-->
                    <li class="dropdown navbar-c-items">
                          <a href="javascript:void(0)" class="dropdown-toggle add-all waves-effect waves-light" id="dropdownMenuButton" data-toggle="sidenav" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-plus-circle fa-3x" style="margin-left: 3px;"></i> {{trans('button.create')}}
                          </a>
                        <!--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item waves-effect waves-light" href="{{route('sales_invoice.create')}}">{{trans('frontend/dashboard.create_sales_invoice')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('contact.create')}}">{{trans('frontend/dashboard.create_contact')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('finance.create')}}">{{trans('frontend/dashboard.create_finance')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('abstract.create')}}">{{trans('frontend/dashboard.create_abstract')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('other_income.create')}}">{{trans('frontend/dashboard.create_other_income')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('cost.create')}}">{{trans('frontend/dashboard.create_cost')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('cost_other.create')}}">{{trans('frontend/dashboard.create_cost_other')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('sales_invoice_return.create')}}">{{trans('frontend/dashboard.create_sales_invoice_return')}}</a>
                            <a class="dropdown-item waves-effect waves-light" href="{{route('salary.create')}}">{{trans('frontend/dashboard.create_salary')}}</a>
                        </div>-->
                    </li>
                    <li class="dropdown navbar-c-items">
                        <a data-step="10" data-intro="لتعديل معلومات حسابك الشخصى وشركتك وحسابك البنكى والضرائب والدفع" data-position='left' href="{{ route('users.main') }}" class="waves-effect waves-light profile"> {{trans('frontend/dashboard.user_manager')}} </a>
                    </li>

                    <li class="dropdown navbar-c-items">
                        <a data-step="11" data-intro="اذا وجدت صعوبه او اى مشكله فى الاستخدام فلا تتردد وراسلنا .نحن فى انتظارك" data-position='left' href="{{route('helps.index')}}" class="waves-effect waves-light profile"> {{trans('frontend/dashboard.help')}} </a>
                    </li>
                    <?php $feedback=\DB::table('user_feedbacks')->where('user_id',Auth::user()->id)->get();// dd(count($feedback)); ?>
                      @if(!count($feedback))
                     <li>
                           <a data-target="#feedbackModel" href="#feedbackModel" data-toggle="modal" data-step="8" data-intro="ضف تقييمك للسيستم " data-position='left'  class="waves-effect waves-light profile">{{trans('frontend/dashboard.feedback')}}</a>

                     </li>


                            @endif

                    <li class="dropdown navbar-c-items">
                        <a href="{{route('logout')}}" class="waves-effect waves-light profile"></i>{{trans('master.logout')}}</a></a>
                    </li>


                </ul>
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

        </div>
    </div>

    <div id="topfixed">
        <div class="navbar-custom">
            <div class="container">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
					<style type="text/css">
						@media(max-width: 991px){
							div#navigation{
								z-index: 9000;
							}
						}
					</style>

                        <li class="">
                            <a href="{{ route('dashboard.index') }}"><i class="md md-dashboard"></i>{{trans('frontend/dashboard.main_dashboard')}}</a>
                        </li>

                        <li class="{{Active('sales_invoice.*')}}">
                            <a  data-step="1" data-intro="هذه الصفحه تمكنك من عمل فواتير البيع و اضافه المنتجات بها وتمكنك من الدفع بها وادراتها واستخراج المعلومات بالصيغه التى تريدها من خلال تصدير الملفات " data-position='left' href="{{ route('sales_invoice.index') }}"><i class="fa fa-inbox"></i>{{trans('frontend/dashboard.sales_invoice')}}</a>
                        </li>

                        <li class="{{Active(['cost.*','purchase_invoice.*','sales_invoice_return.*','cost_other.*','salary.*'])}}">
                            <a data-step="2" data-intro="    هذه الصفحه تمكنك من عمل فواتير المصروفات و اضافه المنتجات بها وتمكنك من الدفع بها وادراتها واستخراج المعلومات بالصيغه التى تريدها من خلال تصدير الملفات" data-position='left' href="{{ route('cost.index') }}"><i class="fa fa-money"></i>{{trans('frontend/dashboard.cost')}}</a>
                        </li>

                        <li  class="{{Active(['cash.*','bank.*','bank_settings.*'])}}">
                            <a data-step="3" data-intro="  من هنا يمكنك متابعه أمواللك فى الخزن والبنوك وبطاقات الائتمان الخاصه بك." data-position='left'  href="{{ route('finance.main') }}"><i class="fa fa-money"></i>{{trans('frontend/dashboard.finance')}}</a>
                        </li>

                        <li>
                            <a data-step="4" data-intro="  لإضافة العملا والموردين الخاصين بك و ادراة المعلومات الخاصه بهما." data-position='left' href="{{ route('contact.index') }}"><i class="md md-account-circle"></i>{{trans('frontend/dashboard.contact_manager')}}</a>
                        </li>


<!--                        <li>
                            <a href="{{ route('account.main') }}"><i class="md md-account-balance-wallet"></i>{{trans('frontend/dashboard.account_manager')}}</a>
                        </li>-->

                        <li>
                            <a  data-step="5" data-intro="هذه الصفحه هى المسئوله عن التقارير بشكل مفصل كما يمكنك متابعة ما يحدث بأدق التفاصيل من خلال اللوج " data-position='left' href="{{ route('report.main') }}"><i class="md md-pages"></i>{{trans('frontend/dashboard.reports')}}</a>
                        </li>

                        <li>
                            <a data-step="6" data-intro="إذا أردت معرفة الضرايب المربوطه بحسابك والتفاصيل وكيفية التحكم بها فمن هنا" data-position='left' href="{{ route('tax.main') }}"><i class="md md-pages"></i>{{trans('frontend/dashboard.taxes')}}</a>
                        </li>

                        <li>
                            <a data-step="7" data-intro="هذه الصفحة تشمل المنتجات والخدمات والاكواد الحسابيه وغيره" data-position='left' href="{{ route('product.index') }}"><i class="md md-pages"></i>{{trans('frontend/dashboard.more')}}</a>
                        </li>



                        <li class="{{Active('mycompany.index')}}">
                            <a data-step="9" data-intro="للتحكم فى معلومات شركتك او معلومات الضرايب فمن هنا" data-position='left' href="{{ route('mycompany.index') }} " ><i class="md md-pages"></i>{{trans('frontend/dashboard.settings_user')}}</a>
                        </li>

<!--                        <li>
                            <a href="{{ route('product.main') }}"><i class="md md-pages"></i>{{trans('frontend/dashboard.product')}}</a>
                        </li>-->




                    </ul>


                    <!-- End navigation menu        -->
                </div>
            </div> <!-- end container -->
        </div> <!-- end navbar-custom -->
        <div class="container-fluid no-padding subnav">
            <div class="container no-padding">
                <ul class="subnav">
                    @yield('subnav')
                </ul>
            </div>
        </div>
    </div>



</header>
<body>
  <div class="modal fade" id="feedbackModel"  role="dialog" role="dialog" tabindex="-1" aria-hidden="true">
      @include(Config::get('front_theme').'.layouts.partials.feedback')
  </div>
</body>
<!-- End Navigation Bar-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
`
<script type="text/javascript">
        $(function(){
            $('.add-all').on('click',function(){
                document.getElementById("mySidenav").style.width = "250px";
                if($('#mySidenav').css('width') == '0px'){
                    document.getElementById("mySidenav").style.width = "250px";
                }else{
                    document.getElementById("mySidenav").style.width = "0px";
                }
            });

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0px";
            }

            $(window).on('scroll',function(){
                closeNav();
            });

            $('body').click(function(evt){
                if(!$(evt.target).is('.dropdown-toggle')) {
                    closeNav();
                }
            });
        });
</script>
