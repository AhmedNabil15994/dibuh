var counter = 0;
$(document).ready(function() {
    'use strict';

    //Start Submenu on hover
    $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });
    //End Submenu on hover

   

    // // START MAP CACL
    // var a = 0;
    // $(window).scroll(function () {
    //   var MapTop = $('#our-location').offset().top - 400;

    //   //    console.log(MapTop + ' ' + $(window).scrollTop())
    //   if (a == 0 && $(window).scrollTop() > MapTop) {
    //     a = 1;
    //     var eg = $("#egy"),
    //       uae = $("#uae"),
    //       poland = $("#poland"),
    //       mask = $("#our-location .map span .mask"),
    //       det1 = $("#our-location .map .details .det1"),
    //       det2 = $("#our-location .map .details .det2"),
    //       det3 = $("#our-location .map .details .det3"),
    //       det1Li = $("#our-location .map .details .det1 ul li"),
    //       det2Li = $("#our-location .map .details .det2 ul li"),
    //       det3Li = $("#our-location .map .details .det3 ul li"),
    //       mapTime = new TimelineMax(),
    //       time = new TimelineMax();
    //     time.to(eg, 0.5, {
    //       y: 0,
    //       autoAlpha: 1,
    //       scale: 1
    //     })
    //     time.to(uae, 0.5, {
    //       y: 0,
    //       autoAlpha: 1,
    //       scale: 1
    //     })
    //     time.to(poland, 0.5, {
    //       y: 0,
    //       autoAlpha: 1,
    //       scale: 1
    //     })
    //     time.to(mask, 0.75, {
    //       autoAlpha: 1,
    //       repeat: -1,
    //       yoyo: true
    //     })

    //     // Start Details Animation
    //     $(eg).hover(function () {
    //       mapTime
    //         .to(det1, 0.3, {
    //           autoAlpha: 1
    //         })
    //         .staggerTo(det1Li, 0.3, {
    //           autoAlpha: 1,
    //           y: 0
    //         }, "0.2")
    //     }, function () {
    //       mapTime
    //         .to(det1, 0.1, {
    //           autoAlpha: 0
    //         })
    //         .set(det1Li, {
    //           autoAlpha: 0,
    //           y: 20
    //         })
    //     });
    //     $(uae).hover(function () {
    //       mapTime
    //         .to(det2, 0.3, {
    //           autoAlpha: 1
    //         })
    //         .staggerTo(det2Li, 0.3, {
    //           autoAlpha: 1,
    //           y: 0
    //         }, "0.2")
    //     }, function () {
    //       mapTime
    //         .to(det2, 0.1, {
    //           autoAlpha: 0
    //         })
    //         .set(det2Li, {
    //           autoAlpha: 0,
    //           y: 20
    //         })
    //     });
    //     $(poland).hover(function () {
    //       mapTime
    //         .to(det3, 0.3, {
    //           autoAlpha: 1
    //         })
    //         .staggerTo(det3Li, 0.3, {
    //           autoAlpha: 1,
    //           y: 0
    //         }, "0.2")
    //     }, function () {
    //       mapTime
    //         .to(det3, 0.1, {
    //           autoAlpha: 0
    //         })
    //         .set(det3Li, {
    //           autoAlpha: 0,
    //           y: 20
    //         })
    //     });
    //     // End Details Animation 
    //   }
    // })

    // var mapWidth = $("#map-img").width();
    // var mapHeight = $("#map-img").height();
    // $("#egy").css("left", mapWidth * (1035 / 1920) - 20);
    // $("#egy").css("top", mapHeight * (110 / 436) - 40);

    // $("#uae").css("left", mapWidth * (1100 / 1920) - 10);
    // $("#uae").css("top", mapHeight * (135 / 436) - 42);


    // $("#poland").css("left", mapWidth * (990 / 1920) - 20);
    // $("#poland").css("top", mapHeight * (50 / 436) - 40);

    // $(window).resize(function () {
    //   var mapWidth = $("#map-img").width();
    //   var mapHeight = $("#map-img").height();
    //   //    console.log(mapWidth)
    //   //    console.log(mapHeight)
    //   $("#egy").css("left", mapWidth * (1035 / 1920) - 20);
    //   $("#egy").css("top", mapHeight * (110 / 436) - 40);



    //   $("#uae").css("left", mapWidth * (1100 / 1920) - 10);
    //   $("#uae").css("top", mapHeight * (135 / 436) - 42);


    //   $("#poland").css("left", mapWidth * (990 / 1920) - 20);
    //   $("#poland").css("top", mapHeight * (50 / 436) - 69);


    // });


    // // END MAP CACL
    // Start Gallery Overlay
    $("<div class='galleryMask'><i class='fa fa-arrows-alt'></i></div>").appendTo(".gallery-overlay");
    $(".galleryMask").click(function() {
        var galleryImg = $(this).parent(".gallery-overlay").children("img");
        $(galleryImg).clone().insertBefore(this).wrap("<div class='gallery-popup'></div>");
        $(".gallery-popup").fadeIn(500);
        $(".gallery-popup").click(function() {
            $(this).fadeOut(500, function() {
                $(this).remove();
            });
        })
    });

    // End Gallery Overlay
    //Start Sticky Header
    $(window).scroll(function() {
        var nav = $(".navbar-default"),
            navTime = new TimelineMax();
        if ($(window).scrollTop() > 0 && $(window).width() > 767) {
            $(".navbar-default").addClass("sticky-header");

        } else {
            $(".navbar-default").removeClass("sticky-header");
        };
        if ($(window).scrollTop() > 300) {
            var newCounter = $(window).scrollTop();
            //      console.log("counter = "+counter+' '+"newCounter = "+newCounter)
            if ($(window).width() >= 767) {
                if (newCounter > counter) {
                    navTime.to(nav, 0.1, {
                            y: -200,
                            ease: Power0.easeNone
                        }, 0)
                        //        $(".navbar-default").addClass("sticky-top")
                    counter = newCounter;
                    console.log("ccc")

                } else {
                    navTime.to(nav, 0.1, {
                            y: 0,
                            ease: Bounce.easeInOut
                        }, 0)
                        //        $(".navbar-default").removeClass("sticky-top");
                    counter = newCounter
                }
            }
        }

    });
    //End Sticky Header
});
