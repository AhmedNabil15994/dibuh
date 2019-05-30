
@extends(Config::get('front_theme').'.layouts.web_default')



@section('page-styles')

    <style type="text/css">
        .plan-header h5{
            font-size: 16px !important;
            margin-top: 20px;
            color: #999;
            text-decoration: line-through;
        }
    </style>
@endsection

@section('content')

        <!-- HOME -->
        <section class="home bg-img-1" id="home">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="home-fullscreen">
                            <div class="full-screen">
                                <div class="home-wrapper home-wrapper-alt">
                                    <h2 class="font-light text-white">{{trans('frontend/dashboard.image_title')}} </h2>
                                    <h4 class="text-white">{{trans('frontend/dashboard.image_description')}}
</h4>
                                    <a href="{{route('register.index')}}" target="_blank" class="btn btn-custom">الاشتراك الان</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END HOME -->


        <!-- Features -->
        <section class="section" id="features">
            <div class="container">

                <div class="row">
                    <div class="col-sm-12 text-center">
                       <h3 class="title">{{trans('frontend/dashboard.image_title')}} </h3>

                        <p class="text-muted sub-title">{{trans('frontend/dashboard.sub_title')}}.</p>
                    </div>
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-sm-4">
                        <div class="features-box">
                            <i class="fa fa-diamond"></i>
                            <h4>{{trans('frontend/dashboard.responsive')}}</h4>
                            <p class="text-muted">{{trans('frontend/dashboard.responsive_description')}}ز .</p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="features-box">
                            <i class="fa fa-bicycle"></i>
                            <h4>{{trans('frontend/dashboard.speed')}}</h4>
                            <p class="text-muted">{{trans('frontend/dashboard.speed_description')}}.</p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="features-box">
                            <i class="fa fa-signal"></i>
                            <h4>{{trans('frontend/dashboard.update')}} </h4>
                            <p class="text-muted">{{trans('frontend/dashboard.update_description')}} .</p>
                        </div>
                    </div>

                </div> <!-- end row -->

            </div> <!-- end container -->
        </section>
        <!-- end Features -->



        <!-- Features Alt -->
        <section class="section p-t-0">
            <div class="container">

                <div class="row">
                    <div class="col-sm-5">
                        <div class="feat-description m-t-20">
                            <h4>خدمة دي بو تمنحك السيطرة على عملك ويسمح لك لتتبع أموالك بسهولة و حتى تتمكن من التركيز على عملك حتى تتمكن من التركيز على عملك</h4>
                            <p class="text-muted">خدمة دي بو تمنحك السيطرة على عملك ويسمح لك لتتبع أموالك بسهولة و حتى تتمكن من التركيز على عملك
                            خدمة دي بو تمنحك السيطرة على عملك ويسمح لك لتتبع أموالك بسهولة و حتى تتمكن من التركيز على عملك
                            خدمة دي بو تمنحك السيطرة على عملك ويسمح لك لتتبع أموالك بسهولة و حتى تتمكن من التركيز على عملك</p>

                            <a href="{{route('register.index')}}" class="btn btn-custom">الاشتراك الان</a>
                        </div>
                    </div>

                    <div class="col-sm-6 col-sm-offset-1">
                        <img src="images/mac_1.png" alt="img" class="img-responsive m-t-20">
                    </div>

                </div><!-- end row -->

            </div> <!-- end container -->
        </section>
        <!-- end features alt -->


        <!-- Features Alt -->
        <section class="section">
            <div class="container">

                <div class="row">
                    <div class="col-sm-6">
                        <img src="images/mac_2.png" alt="img" class="img-responsive">
                    </div>

                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="feat-description">
                            <h4>خدمة دي بو تمنحك السيطرة على عملك ويسمح لك لتتبع أموالك بسهولة و حتى تتمكن من التركيز على عملك حتى تتمكن من التركيز على عملك</h4>
                            <p class="text-muted">خدمة دي بو تمنحك السيطرة على عملك ويسمح لك لتتبع أموالك بسهولة و حتى تتمكن من التركيز على عملك
                            خدمة دي بو تمنحك السيطرة على عملك ويسمح لك لتتبع أموالك بسهولة و حتى تتمكن من التركيز على عملك
                            خدمة دي بو تمنحك السيطرة على عملك ويسمح لك لتتبع أموالك بسهولة و حتى تتمكن من التركيز على عملك</p>

                             <a href="{{route('register.index')}}" class="btn btn-custom">الاشتراك الان</a>

                        </div>
                    </div>

                </div><!-- end row -->

            </div> <!-- end container -->
        </section>
        <!-- end features alt -->


        <!-- Features Alt -->
        <section class="section">
            <div class="container">

                <div class="row">
                    <div class="col-sm-5">
                           <div class="feat-description">
                            <h4>خدمة دي بو تمنحك السيطرة على عملك ويسمح لك لتتبع أموالك بسهولة و حتى تتمكن من التركيز على عملك حتى تتمكن من التركيز على عملك</h4>
                            <p class="text-muted">خدمة دي بو تمنحك السيطرة على عملك ويسمح لك لتتبع أموالك بسهولة و حتى تتمكن من التركيز على عملك
                            خدمة دي بو تمنحك السيطرة على عملك ويسمح لك لتتبع أموالك بسهولة و حتى تتمكن من التركيز على عملك
                            خدمة دي بو تمنحك السيطرة على عملك ويسمح لك لتتبع أموالك بسهولة و حتى تتمكن من التركيز على عملك</p>

                             <a href="{{route('register.index')}}" class="btn btn-custom">الاشتراك الان</a>

                        </div>
                    </div>

                    <div class="col-sm-6 col-sm-offset-1">
                        <img src="images/mac_3.png" alt="img" class="img-responsive">
                    </div>

                </div><!-- end row -->

            </div> <!-- end container -->
        </section>
        <!-- end features alt -->


        <!-- Testimonials section -->
        <section class="section bg-img-1">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                            <?php $feedbacks=App\Models\Feedback::all(); //dd(count($feedbacks));?>
                     @if(count($feedbacks)>0)
                        <div class="owl-carousel text-center">

                          @foreach($feedbacks as $feedback)
                            <div class="item">
                                <div class="testimonial-box">
                                    <h4>{{$feedback->feedback}}.</h4>
                                    <img src="images/user.jpg" class="testi-user img-circle" alt="testimonials-user">
                                    <?php $user_name=\DB::table("users")->where('id',$feedback->user_id)->first()->name; ?>
                                    <p>-{{$user_name}}</p>
                                </div>
                            </div>

                            @endforeach
                              </div>
                        @elseif(count($feedbacks)>0)
                                    <?php $feedbacks=App\Models\Feedback::first(); ?>
                        <div >
                          <div >
                              <div class="testimonial-box" style="text-align:center">
                                    <h4>{{$feedbacks->feedback}}.</h4>
                                    <img src="images/user.jpg" class="testi-user img-circle" alt="testimonials-user">
                                    <?php $user_name=\DB::table("users")->where('id',$feedbacks->user_id)->first()->name; ?>
                                    <p>-{{$user_name}}</p>
                                </div>
                            </div>
                          </div>

                        @endif


                    </div>
                </div>
            </div>
        </section>

        <!-- End Testimonials section -->


        <!-- PRICING -->
        <section class="section" id="pricing">
            <div class="container">

                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h3 class="title"> {{trans('frontend/dashboard.prices')}}  </h3>
                        <p class="text-muted sub-title">The clean and well commented code allows easy customization of the theme.It's <br> designed for describing your app, agency or business.</p>
                    </div>
                </div> <!-- end row -->


                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="row">

                            <?php $plans = \DB::table('price_plans')->orderBy('id','DESC')->get(); ?>
                            @foreach($plans as $item)
                            <!--Pricing Column-->
                            @if($item->discount == 0)
                            <article class="pricing-column col-lg-4 col-md-4">
                                <div class="inner-box" style="font-family: sans-serif !important;">
                                    <div class="plan-header text-center">
                                        <h3 class="plan-title" style="font-family: sans-serif !important;">{{$item->period}}</h3>
                                        <h2 class="plan-price" style="margin-top:59px; ;direction: rtl;font-family: sans-serif !important;">  {{$item->price}} <span>ج.م </span></h2>
                                        <div class="plan-duration">Per License</div>
                                    </div>
                                    <ul class="plan-stats list-unstyled">
                                        <li style="font-family: sans-serif !important;"> <i class="pe-7s-server"></i>Name <b style="font-family: sans-serif !important;">{{$item->name}}</b></li>
                                        <li style="font-family: sans-serif !important;"> <i class="pe-7s-graph"></i>{{$item->support}} </li>
                                        <li style="font-family: sans-serif !important;"> <i class="pe-7s-mail-open"></i>{{$item->updates}} </li>
                                        <li style="font-family: sans-serif !important;"> <i class="pe-7s-tools"></i>{{$item->avail_support}} </li>
                                    </ul>

                                    <div class="text-center">
                                        <a href="{{route('register.index')}}" class="btn btn-sm btn-custom">اشترك الان</a>
                                    </div>
                                </div>
                            </article>
                            @else
                            <article class="pricing-column col-lg-4 col-md-4">
                                <div class="inner-box" style="font-family: sans-serif !important;">
                                    <div class="plan-header text-center">
                                        <?php
                                            $price = $item->price;
                                            $discount = $item->discount;
                                            $new = $price - $price * ($discount/100);
                                         ?>
                                        <h3 class="plan-title" style="font-family: sans-serif !important;">{{$item->period}}</h3>
                                        <h5 class="plan-price" style="font-family: sans-serif !important;">was {{$item->price}}<span> ج.م  </span></h5>
                                        <h2 class="plan-price" style="direction: rtl;font-family: sans-serif !important;"> <?php echo $new; ?><span> ج.م </span></h2>
                                        <div class="plan-duration">Per License</div>
                                    </div>
                                    <ul class="plan-stats list-unstyled">
                                        <li style="font-family: sans-serif !important;"> <i class="pe-7s-server"></i>Name <b style="font-family: sans-serif !important;">{{$item->name}}</b></li>
                                        <li style="font-family: sans-serif !important;"> <i class="pe-7s-graph"></i>{{$item->support}}</li>
                                        <li style="font-family: sans-serif !important;"> <i class="pe-7s-mail-open"></i>{{$item->updates}}</li>
                                        <li style="font-family: sans-serif !important;"> <i class="pe-7s-tools"></i>{{$item->avail_support}}</li>
                                    </ul>

                                    <div class="text-center">
                                        <a href="{{route('register.index')}}" class="btn btn-sm btn-custom">اشترك الان</a>
                                    </div>
                                </div>
                            </article>
                            @endif
                            @endforeach



                        </div>
                    </div><!-- end col -->
                </div>
                 <!-- end row -->

            </div> <!-- end container -->
        </section>
        <!-- End Pricing -->


        <!-- Clients -->
        <section class="section p-t-0" id="clients">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h3 class="title">Trusted by Thousands</h3>
                        <p class="text-muted sub-title">The clean and well commented code allows easy customization of the theme.It's <br/> designed for describing your app, agency or business.</p>
                    </div>
                </div>
                <!-- end row -->

                <div class="row text-center">
                    <div class="col-sm-12">
                        <ul class="list-inline client-list">
                            <li><a href="" title="Microsoft"><img src="images/clients/microsoft.png" alt="clients"></a></li>
                            <li><a href="" title="Google"><img src="images/clients/google.png" alt="clients"></a></li>
                            <li><a href="" title="Instagram"><img src="images/clients/instagram.png" alt="clients"></a></li>
                            <li><a href="" title="Converse"><img src="images/clients/converse.png" alt="clients"></a></li>
                        </ul>
                    </div> <!-- end Col -->

                </div><!-- end row -->

            </div>
        </section>
        <!--End  Clients -->
@endsection


@section('page-scripts')
        <script type="text/javascript">
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay: true,
                autoplayTimeout: 4000,
                responsive:{
                    0:{
                        items:1
                    }
                }
            })
        </script>
@endsection
