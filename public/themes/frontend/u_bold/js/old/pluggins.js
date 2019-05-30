
/* global $, jQuery, alert */
$(document).ready(function (){
	"use strict";
	$('.carousel').carousel({
		interval:3000
	});

	// show color box (style selector)
	$('.gear_check').click(function (){
		$('.color_option').fadeToggle();
	});

	// Change color theme
	var colorBox=$('.color_option ul li');
	colorBox
		.eq(0).css("backgroundColor","#E41B17").end()
		.eq(1).css("backgroundColor","#3bc492").end()		
		.eq(2).css("backgroundColor","#3e74b7").end()
		.eq(3).css("backgroundColor","#4b824d").end()
		.eq(4).css("backgroundColor","#f1600b")  ;	

	colorBox.click(function (){
		// $("link[href*='style']").remove();		
		$("link[href*='theme']").attr("href",  $(this).attr("data-value") );
		//var a=  $(this).attr("data-value") ;
		//alert(a);
	});	

	// Loading splash screen
/*	$(window).load(function (){

		$(".loading_overlay .spinner").fadeOut(2,
			function ()
			{
				//show the scroller 				
				$("body").css("overflow","auto");				
				$(this).parent().fadeOut(2,
					function (){


						// remvoe section loading_overlay						
						$(this).remove();						
					});
			});
	});*/



	// Caching The Scroll Top Button
	var scrollButton = $("#scroll_up");

	$(window).scroll(function ()
	{
		//console.log($(this).scrollTop());
		if ($(window).scrollTop() > 195) {
	      $('#nav_bar').addClass('navbar-fixed');
	    }
	    if ($(window).scrollTop() < 196) {
	      $('#nav_bar').removeClass('navbar-fixed');
	    }

		$(this).scrollTop() >= 700 ? scrollButton.show(): scrollButton.hide();

	});

	// Click Scroll Button Up
	scrollButton.click(function ()
	{
		$("html,body").animate({scrollTop :0},600);
	});	

});