 
@extends(Config::get('front_theme').'.layouts.site_default')



@section('page-styles')
 

@endsection

@section('content')
    <!-- End NavBar -->
    <!--  Start Slider  -->
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="images/slider/1.jpg">
                <div class="carousel-caption">
                    <div class="main-title">
                        <h2 class="wow bounceInDown" data-wow-duration="2s">Dibuh</h2>
                        <h5 class="wow bounceInUp" data-wow-duration="2s">all your accounts services</h5>
                    </div>
                    <h2 class="wow bounceIn" data-wow-duration="2s">join us</h2>
                </div>
            </div>
            <div class="item">
                <img src="images/slider/2.jpg">
                <div class="carousel-caption">
                    <div class="main-title">
                        <h2 class="wow bounceInLeft" data-wow-duration="2s">Dibuh</h2>
                        <h5 class="wow bounceInRight" data-wow-duration="2s">all your accounts services</h5>
                    </div>
                    <h2 class="wow bounceIn" data-wow-duration="2s">join us</h2>
                </div>
            </div>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!--  End Slider  -->
    <!--  Start about counter  -->
    <section id="about-counter">
        <div id="particles-js"></div>
        <div class="about-counter-inner">
            <div id="counter">
                <div class="counter-value" data-count="8"><span>0</span>
                    <h6>Million</h6>
                    <h4>Trasaction / Month</h4>
                    <img class="oddImg" src="images/counter-circle.png" alt="">
                </div>
                <div class="counter-value" data-count="5000"><span>0</span>
                    <h6>+</h6>
                    <h4>ADVISORS</h4> <img class="evenImg" src="images/counter-circle.png" alt="">
                </div>
                <div class="counter-value" data-count="15"><span>0</span>
                    <h6>years</h6>
                    <h4>     Experiencxe In <br>
EUROPE, AFFRICA, MIDDLE EAST</h4> <img class="oddImg" src="images/counter-circle.png" alt="">
                </div>
                <div class="counter-value" data-count="25"><span>0</span>
                    <h6>+</h6>
                    <h4>LANGUAGES</h4> <img class="evenImg" src="images/counter-circle.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <!--  End about counter  -->
    <!--  Start our location Section  -->
    <section id="our-location">
        <h2 class="section-title wow fadeInUp">our locations</h2>
        <div class="map">
            <img id="map-img" src="images/map.png" alt="" class="img-responsive">
            <span id="egy"><img src="images/flag/egy.png" alt="">
            <img class="mask" src="images/flag/mask.png" alt=""></span>
            <span id="uae"><img src="images/flag/UAE.png" alt=""><img class="mask" src="images/flag/mask.png" alt=""></span>
            <span id="poland"><img src="images/flag/POLAND.png" alt=""><img class="mask" src="images/flag/mask.png" alt=""></span>
           
        </div>
    </section>
    <!--  End our location Section  -->
    <!--  Start industries Section  -->
    <section id="industries">
        <div class="container">
            <h2 class="section-title">industries</h2>
            <div class="industries-block col-lg-3 col-md-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="0.2s">
                <img src="images/industries/1.jpg" alt="" class="img-responsive">
                <h5>tachnology</h5>
                <p>In order to stay competitive in a highly complex and changing customer demographic in the market of technology and electronics, companies must keep up with frequent </p>
                <a href="#">read more</a>
            </div>
            <div class="industries-block col-lg-3 col-md-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="0.4s">
                <img src="images/industries/2.jpg" alt="" class="img-responsive">
                <h5>telecom</h5>
                <p>In order to stay competitive in a highly complex and changing customer demographic in the market of technology and electronics, companies must keep up with frequent </p>
                <a href="#">read more</a>
            </div>
            <div class="industries-block col-lg-3 col-md-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="0.6s">
                <img src="images/industries/3.jpg" alt="" class="img-responsive">
                <h5>FAST FOOD</h5>
                <p>In order to stay competitive in a highly complex and changing customer demographic in the market of technology and electronics, companies must keep up with frequent </p>
                <a href="#">read more</a>
            </div>
            <div class="industries-block col-lg-3 col-md-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="0.8s">
                <img src="images/industries/4.jpg" alt="" class="img-responsive">
                <h5>BANKING</h5>
                <p>In order to stay competitive in a highly complex and changing customer demographic in the market of technology and electronics, companies must keep up with frequent </p>
                <a href="#">read more</a>
            </div>
            <div class="industries-block col-lg-3 col-md-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="0.8s">
                <img src="images/industries/5.jpg" alt="" class="img-responsive">
                <h5>AUTOMOTVE</h5>
                <p>In order to stay competitive in a highly complex and changing customer demographic in the market of technology and electronics, companies must keep up with frequent </p>
                <a href="#">read more</a>
            </div>
            <div class="industries-block col-lg-3 col-md-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="0.6s">
                <img src="images/industries/6.jpg" alt="" class="img-responsive">
                <h5>WHITE GOODS</h5>
                <p>In order to stay competitive in a highly complex and changing customer demographic in the market of technology and electronics, companies must keep up with frequent </p>
                <a href="#">read more</a>
            </div>
            <div class="industries-block col-lg-3 col-md-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="0.4s">
                <img src="images/industries/7.jpg" alt="" class="img-responsive">
                <h5>RETAIL</h5>
                <p>In order to stay competitive in a highly complex and changing customer demographic in the market of technology and electronics, companies must keep up with frequent </p>
                <a href="#">read more</a>
            </div>
            <div class="industries-block col-lg-3 col-md-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="0.2s">
                <img src="images/industries/8.jpg" alt="" class="img-responsive">
                <h5>telecom</h5>
                <p>In order to stay competitive in a highly complex and changing customer demographic in the market of technology and electronics, companies must keep up with frequent </p>
                <a href="#">read more</a>
            </div>
        </div>
    </section>
    <!--  End industries Section  -->
    <!--  Start Our Services Section  -->
    <section id="our-services">
        <h2 class="section-title">our services</h2>
        <div id="services-inner" class="container">
            <div class="text col-lg-6 col-md-6 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay="0.2s">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap.</p>
            </div>
            <div class="text service col-lg-3 col-md-3 col-sm-3 col-xs-12 wow fadeInUp" data-wow-delay="0.4s">
                <div class="serviceShow">
                    <img src="images/services/1.png" alt="">
                    <span>contact center</span>
                </div>
                <div class="serviceMask">
                    <img src="images/services/11.png" alt="">
                    <span>contact center</span>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. </p>
                </div>
            </div>
            <div class="text service col-lg-3 col-md-3 col-sm-3 col-xs-12 wow fadeInUp" data-wow-delay="0.6s">
                <div class="serviceShow">
                    <img src="images/services/2.png" alt="">
                    <span>back office</span>
                </div>
                <div class="serviceMask">
                    <img src="images/services/22.png" alt="">
                    <span>back office</span>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. </p>
                </div>
            </div>
            <div class="text service col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="serviceShow">
                    <img src="images/services/1.png" alt="">
                    <span>contact center</span>
                </div>
                <div class="serviceMask">
                    <img src="images/services/11.png" alt="">
                    <span>contact center</span>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. </p>
                </div>
            </div>
            <div class="text service col-lg-3 col-md-3 col-sm-3 col-xs-12 wow fadeInUp" data-wow-delay="1s">
                <div class="serviceShow">
                    <img src="images/services/3.png" alt="">
                    <span>profissional services</span>
                </div>
                <div class="serviceMask">
                    <img src="images/services/33.png" alt="">
                    <span>profissional services</span>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                </div>
            </div>
            <div class="text service col-lg-3 col-md-3 col-sm-3 col-xs-12 wow fadeInUp" data-wow-delay="0.8s">
                <div class="serviceShow">
                    <img src="images/services/4.png" alt="">
                    <span>social media support</span>
                </div>
                <div class="serviceMask">
                    <img src="images/services/44.png" alt="">
                    <span>social media support</span>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                </div>
            </div>
            <div class="text service col-lg-3 col-md-3 col-sm-3 col-xs-12 wow fadeInUp" data-wow-delay="1s">
                <div class="serviceShow">
                    <img src="images/services/5.png" alt="">
                    <span>inside saled</span>
                </div>
                <div class="serviceMask">
                    <img src="images/services/55.png" alt="">
                    <span>inside saled</span>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                </div>
            </div>
        </div>
    </section>
    <!--  End Our Services Section  -->
    <!--  Start Video  -->
    <section id="video">
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/5A38z1ZSlrQ" frameborder="0" allowfullscreen></iframe>
        
        
    </section>
    <!--  End Video  -->
    <!--  Start Quote  -->
    <section id="quote">
        <div id="overlay">
            <h3>
                <i class="fa fa-quote-left"></i>
                We remain committed to our long term goal of maximizing the value
 of our shareholders
                <i class="fa fa-quote-right"></i>
            </h3>
            <em id="position">Medhat Khalil, <br>Chairman, Dibuh Corporation</em>
        </div>
    </section>
    <!--  End Quote  -->
    <!--  Start Gallery  -->
    <section id="gallery">
        <h2 class="section-title">gallery</h2>
        <div class="container">
            <div class="gallery-left col-lg-7 col-md-7 col-sm-7 col-xs-12">
                <div class="gallery-left-top col-xs-12">
                    <div class="gallery-overlay gallery-left-top-left col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <img src="images/gallery/1.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="gallery-left-top-right col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="gallery-overlay gallery-left-top-right-top col-xs-12">
                            <img src="images/gallery/2.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="gallery-overlay gallery-left-top-right-bottom col-xs-12">
                            <img src="images/gallery/3.jpg" alt="" class="img-responsive">
                        </div>
                    </div>
                </div>
                <div class="gallery-left-bottom col-xs-12">
                    <div class="gallery-overlay gallery-left-bottom-img col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <img src="images/gallery/6.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="gallery-overlay gallery-left-bottom-img col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <img src="images/gallery/5.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="gallery-overlay gallery-left-bottom-img col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <img src="images/gallery/7.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="gallery-overlay gallery-left-bottom-img col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <img src="images/gallery/8.jpg" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="gallery-overlay gallery-left col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <img src="images/gallery/4.jpg" alt="" class="img-responsive">
            </div>
        </div>
    </section>
    <!--  End Gallery  -->
    <!--  Start Newsletter  -->
    <section id="newsletter">
        <h2 class="section-title">newsletter</h2>
        <h4>Subscribe and stay up to date with the latest news</h4>
        <input type="text" placeholder="Email">
        <input type="submit" value="Subscribe">
    </section>
    <!--  End Newsletter  -->	
@endsection


@section('page-scripts')
    <script>
    new WOW().init();
    </script>
    <script>
    $('.carousel').carousel({
        pause: false,
        interval: 4000
    });
    </script>
   <script>
    /* ---- particles.js config ---- */

    particlesJS("particles-js", {
        "particles": {
            "number": {
                "value": 50,
                "density": {
                    "enable": true,
                    "value_area": 800
                }
            },
            "color": {
                "value": "#dee2ed"
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 2,
                    "color": "#bcc2d1"
                },
                "polygon": {
                    "nb_sides": 5
                },
                "image": {
                    "src": "img/github.svg",
                    "width": 100,
                    "height": 100
                }
            },
            "opacity": {
                "value": 0.5,
                "random": false,
                "anim": {
                    "enable": false,
                    "speed": 1,
                    "opacity_min": 0.1,
                    "sync": false
                }
            },
            "size": {
                "value": 20,
                "random": true,
                "anim": {
                    "enable": false,
                    "speed": 40,
                    "size_min": 0.1,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": 150,
                "color": "#bcc2d1",
                "opacity": 0.4,
                "width": 3
            },
            "move": {
                "enable": true,
                "speed": 6,
                "direction": "none",
                "random": false,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 1200
                }
            }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": {
                    "enable": true,
                    "mode": "grab"
                },
                "onclick": {
                    "enable": true,
                    "mode": "push"
                },
                "resize": true
            },
            "modes": {
                "grab": {
                    "distance": 140,
                    "line_linked": {
                        "opacity": 1
                    }
                },
                "bubble": {
                    "distance": 400,
                    "size": 40,
                    "duration": 2,
                    "opacity": 8,
                    "speed": 3
                },
                "repulse": {
                    "distance": 200,
                    "duration": 0.4
                },
                "push": {
                    "particles_nb": 4
                },
                "remove": {
                    "particles_nb": 2
                }
            }
        },
        "retina_detect": true
    });
    </script>
    <script>
    var a = 0;
    $(window).scroll(function() {

        var oTop = $('#counter').offset().top - window.innerHeight;
        //            console.log('counter offset ' + $('#counter').offset().top + ' inner height ' + window.innerHeight + ' oTop ' + oTop + ' scroll Top ' + $(window).scrollTop());
        if (a == 0 && $(window).scrollTop() > oTop) {
            $('.counter-value').each(function() {
                var $this = $(this).children("span"),
                    countTo = $(this).attr('data-count');
                $({
                    countNum: $this.text()
                }).animate({
                        countNum: countTo
                    },

                    {

                        duration: 3000,
                        easing: 'swing',
                        step: function() {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $this.text(this.countNum);
                            //alert('finished');
                        }

                    });
            });
            a = 1;
        }

    });
    </script>
    <script>
    $(document).ready(function() {
        // START MAP CACL
        var a = 0;
        $(window).scroll(function() {
            var MapTop = $('#our-location').offset().top - 400;

            //    console.log(MapTop + ' ' + $(window).scrollTop())
            if (a == 0 && $(window).scrollTop() > MapTop) {
                a = 1;
                var eg = $("#egy"),
                    uae = $("#uae"),
                    poland = $("#poland"),
                    mask = $("#our-location .map span .mask"),
                    det1 = $("#our-location .map .details .det1"),
                    det2 = $("#our-location .map .details .det2"),
                    det3 = $("#our-location .map .details .det3"),
                    det1Li = $("#our-location .map .details .det1 ul li"),
                    det2Li = $("#our-location .map .details .det2 ul li"),
                    det3Li = $("#our-location .map .details .det3 ul li"),
                    mapTime = new TimelineMax(),
                    time = new TimelineMax();
                time.to(eg, 0.5, {
                    y: 0,
                    autoAlpha: 1,
                    scale: 1
                })
                time.to(uae, 0.5, {
                    y: 0,
                    autoAlpha: 1,
                    scale: 1
                })
                time.to(poland, 0.5, {
                    y: 0,
                    autoAlpha: 1,
                    scale: 1
                })
                time.to(mask, 0.75, {
                    autoAlpha: 1,
                    repeat: -1,
                    yoyo: true
                })


            }
        })

        var mapWidth = $("#map-img").width();
        var mapHeight = $("#map-img").height();
        $("#egy").css("left", mapWidth * (1035 / 1920) - 20);
        $("#egy").css("top", mapHeight * (110 / 436) - 40);

        $("#uae").css("left", mapWidth * (1100 / 1920) - 10);
        $("#uae").css("top", mapHeight * (135 / 436) - 42);


        $("#poland").css("left", mapWidth * (990 / 1920) - 20);
        $("#poland").css("top", mapHeight * (50 / 436) - 40);

        $(window).resize(function() {
            var mapWidth = $("#map-img").width();
            var mapHeight = $("#map-img").height();
            //    console.log(mapWidth)
            //    console.log(mapHeight)
            $("#egy").css("left", mapWidth * (1035 / 1920) - 20);
            $("#egy").css("top", mapHeight * (110 / 436) - 40);



            $("#uae").css("left", mapWidth * (1100 / 1920) - 10);
            $("#uae").css("top", mapHeight * (135 / 436) - 42);


            $("#poland").css("left", mapWidth * (990 / 1920) - 20);
            $("#poland").css("top", mapHeight * (50 / 436) - 69);


        });


        // END MAP CACL
    })
    </script>
@endsection



