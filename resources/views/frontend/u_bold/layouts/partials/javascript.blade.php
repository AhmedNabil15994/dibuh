		<!-- jQuery  -->
		<script  src="https://code.jquery.com/jquery-1.12.4.js"></script>
		    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


		<script  src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script  src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
		<script  src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
		<script  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
		<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
		<script  src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
		<script  src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
		<!-- end export file -->
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
		<script src="js/select2.min.js"></script>


		<script src="plugins/peity/jquery.peity.min.js"></script>

		<!-- Bootstrap confirmation js -->
		<script src="plugins/bootbox/bootbox.min.js"></script>

		<!-- jQuery  -->
		<script src="plugins/waypoints/lib/jquery.waypoints.js"></script>
		<script src="plugins/counterup/jquery.counterup.min.js"></script>

		<script src="plugins/morris/morris.min.js"></script>
		<script src="plugins/raphael/raphael-min.js"></script>

		<script src="plugins/jquery-knob/jquery.knob.js"></script>

		{{--<script src="pages/jquery.dashboard.js"></script>--}}

		<script src="js/jquery.core.js"></script>
		<script src="js/jquery.app.js"></script>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
		
				$('.counter').counterUp({
					delay: 100,
					time: 1200
				});

				$(".knob").knob();

				$(window).bind('scroll', function () {
					if ($(window).scrollTop() > 10) {
						$('#topnav .subnav ul.subnav li a.active').addClass('nobefore');
						$('#topnav .container-fluid.no-padding.subnav').css({
							borderBottom:"solid 1px rgba(54, 64, 74, 0.08)"
						});
						//$('#topfixed').addClass('navbar-fixed-top');
						$('.topbar-main').slideUp(200);
					} else {
						$('#topnav .subnav ul.subnav li a.active').removeClass('nobefore');
						$('#topnav .container-fluid.no-padding.subnav').css({
							borderBottom:"0"
						});
						//$('#topfixed').removeClass('navbar-fixed-top');
						$('.topbar-main').slideDown(400);
					}
//					console.log($(window).scrollTop())
				});
			});





		</script>


		{{--<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>--}}
		{{--<script type="text/javascript" src="js/bootstrap.min.js"></script>--}}
		{{--<script type="text/javascript" src="js/wow.min.js"></script>--}}
		{{--<script type="text/javascript" src="js/pluggins.js"></script>--}}
		{{--<script>--}}
			{{--new WOW().init();--}}
		{{--</script>	--}}

        @yield('page-scripts')
