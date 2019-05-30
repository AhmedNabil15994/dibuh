 
@extends(Config::get('front_theme').'.layouts.web')

@section('page-scripts')


<script>
    $(window).load(function () {

        $(".loading_overlay .spinner").fadeOut(2,
                function ()
                {
                    //show the scroller 				
                    $("body").css("overflow", "auto");
                    $(this).parent().fadeOut(2,
                            function () {


                                // remvoe section loading_overlay						
                                $(this).remove();
                            });
                });
    });
</script>
@endsection

@section('page-styles')

<style type="text/css">
    body
    {

        overflow: hidden;

    }

</style>
@endsection

@section('loading_overlay')
  	<!-- Start Section Option Box -->
  	<div class="loading_overlay text-center">
  		<h2>loading...</h2>
  		<div class="spinner">
  			<div class="rect1"></div>
  			<div class="rect2"></div>
  			<div class="rect3"></div>
  			<div class="rect4"></div>
  			<div class="rect5"></div>
  		</div> 	 
  	</div>
  	<!-- End Section Option Box -->

@endsection

@section('content')






<!-- Start Section About-->
<!--<section class="about text-center">
    <div class="container">
        <h1>Meet Our New Template <span>One Accounting.</span></h1>

        <p class="lead">			
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
        </p>		
    </div>

</section>-->
<!-- End Section About-->

<!-- Start Section Main Content -->
<div class="main_contant">

 

    <!-- End Section Main Content -->	

    <!-- Start Section Main Content -->

 
 
 	

</div>



<!-- End Section Main Content -->	
@endsection



