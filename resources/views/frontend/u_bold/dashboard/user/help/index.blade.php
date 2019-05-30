
@extends(Config::get('front_theme').'.layouts.default')
@section('title',$page_title)


@section('page-styles')

<link rel="stylesheet" type="text/css" href="css/user_dashboard.css">
 <!--Chartist Chart CSS -->
		<link rel="stylesheet" href="plugins/chartist/css/chartist.min.css">
<!-- Animation css -->
        <link href="plugins/animate/animate.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.pbody{
		background:#fff;
		padding: 10px;
	}
	.wrapper{
		padding-bottom:30px;
	}
	.current{
		background:#5fbeaa;
	}
	#btnSendmailPrint{
		/* margin-right: 20px; */
    margin-top: 20px;
	margin-right: 10px;
	}
	#btnSendmailPrint i {
		margin-right:5px;
	}
	hr{
		width:100%;
	}
	.show-all{
		padding-right: 15px;
    padding-top: 15px;
    padding-bottom: 10px;

	}
	.dropdown-toggle{
		cursor:pointer;
	}
	.dropdown-menu > li > a {
    padding: 6px 20px;
}
.order{
	margin-right: 20px;

}
.post{
	margin-top:20px;
}
ul.dropdown-menu{
	width: fit-content;
}

.single-post{
	border-radius: 15px;
	padding: 16px 15px;
	box-shadow: 0 0 3px 1px rgba(0, 0, 0, 0.42);

}
.single-post h5 {
	line-height: 1.5;
    font-size: 20px;
    margin-bottom: 17px;
    color: #5f5b5b;
    max-width: 900px;


}
.reply{
	/* margin-right: 10px; */
	/* max-width: 550px; */
	margin-bottom:10px;
	line-height:1.5;
}
.replay-content{
	margin-bottom: 10px;

}
.replay-content .small-content{
	display: inline-block;
    float: left;

    /* margin-left: 1.7rem; */
}
.replay-content small{
	font-size: 85%;
    margin-right: 1.7rem;
    float: left;
	/* font-weight:bold; */
	color:#adadad;

}
.hash:after{
display:inline-block;
font-weight: bold;

content:"\00af";
margin-right: 10px;
    font-size: 14px;
}
.infos .user , .infos .date{
	color:#adadad;
	/* font-weight:bold; */
	margin-right:1.6rem;
}
.post hr {
	margin-top:0;
}
.light{
	color:#888
}
.control{
	text-align:center;
	float: left;
    padding-left: 10px;
}

.Page{
	text-align:center !important;

}

@media screen  and (max-width:768px){
	.single-post  h5 {
		font-size:18px;
	}
	.single-post .replay-content .reply{
	font-size:13px;
	margin-bottom:5px;
		width:100%;
	}
	.single-post .replay-content .small-content{

		margin-top:0px;
		width:100%;
	}
	.single-post .replay-content .small-content small{
		font-size:75%;
		margin-right:0;
		float:right;
		margin-right: 15px;

	}
	.single-post .replay-content .small-content .hash::after{
		content:none;

	}
	.single-post .replay-content .small-content .hash{
		margin-left:8px;
	}
	#btnSendmailPrint {
   font-size:13px;
}

}
@media screen  and (max-width:590px){
	.single-post  h5 {
		font-size:16px;
	}
	.single-post .replay-content .reply{

	}

	.single-post .replay-content .small-content{

	}

	.single-post .replay-content .small-content small{


	}
	#btnSendmailPrint {

    margin-right: 0px;
	font-size:12px;

}
}

@media screen  and (max-width:400px){
	#btnSendmailPrint {
		margin-top:0;
    width:100%;

}
.control{
	float:none;
}
}

</style>
@endsection




@section('content')
<!-- Main content -->

    <div class="row m-b-20" style="margin-top: 25px;">
        <div class="col-xs-12 ">
            <h4 class="page-title">الشكاوى والاقتراحات  </h4>
            <p class="text-muted page-title-alt m-b-0"> من هنا يمكنك متابعه الشكاوى والاقتراحات </p>
        </div>
    </div>
		<div class="alerts">
				@if ($message = Session::get('success'))
						<div class="alert alert-success">
								<p>{{ $message }}</p>
						</div>
				@endif
				@if (count($errors) > 0)
						<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
										@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
										@endforeach
								</ul>
						</div>
				@endif
		</div>



		<div class="pbody">
		<div class="container">


<div class="show-all">
	<span class="dropdown">
		<span data-toggle="dropdown" class="dropdown-toggle">
			إظهار الكل

<i class="fa light fa-arrow-down"></i>
</span>
		<ul class="dropdown-menu" rolw="menu">
		<li><a href="{{route('help_myquestions')}}"> أسئلتى فقط</a>  </li>
		<li><a href="{{route('help_faq')}}">أسئلة FAQ</a>   </li>



		</ul>
	</span>


		<!-- <span class="dropdown order">
		<span data-toggle="dropdown" class="dropdown-toggle">
			الترتيب حسب

<i class="fa light fa-arrow-down"></i>
</span>
		<ul class="dropdown-menu" rolw="menu">
		<li><a href="#">الاسئله المجاب عنها</a>  </li>
		<li><a href="#">الاسئله الغير  المجاب عنها</a>   </li>
		<li><a href="#">الاسئله  الاكثر تكرار</a>  </li>


		</ul>
	</span> -->




</div>

<!-- <hr> -->
<!-- start class post-overview -->
<div class="post">

	@foreach($helpings as $help)
	<?php $user_name=App\Models\User::where('id',$help->user_id)->first()->name;
											       $replays=App\Models\HelpingReplay::where('helping_id',$help->id)->get();

														 	 ?>

	<div class="single-post">
		<h5 class="post-info">
		{{$help->subject}}

		</h5>
		@foreach($replays as $replay)
											<?php
                            					$admin_name=App\Models\User::where('id',$replay->user_id)->first()->name;

			?>

		<div class="row replay-content">
		<span style="display:inline-block" class="reply col-md-7">
				{{$replay->replay}}
		</span>
		<div class="small-content col-md-5">

		<small >{{$admin_name}}</small>
		<small class="hash ">{{$replay->created_at}}</small>
		</div>


		</div>

		@endforeach
		<div class="infos">
		<small class="user"> {{$user_name}} </small>


		<small class="date hash">{{$help->created_at}} </small>
		</div>


	</div>
	<hr>
	<!-- end single post -->
	@endforeach



</div>
<!-- end classs post -->

<div class="row">
<!-- <hr> -->
<div class="control">
<nav aria-label="Page  navigation example">
  <ul class="pagination">
		{{$helpings->links()}}
    <!-- <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li> -->
  </ul>
</nav>

	</div>
	<!-- end control div -->

<button  type="button" data-style="expand-right" id="btnSendmailPrint" class="btn btn-default waves-effect waves-light"  data-toggle="modal" data-target="#HelpModal">

<span class="ladda-label"> أرسال شكوى أو إقتراح<i class="fa fa-send"></i></span>
<span class="ladda-spinner"></span>
</button>

</div>
 <!-- end row pagination -->
</div>
<!-- end container -->


						<div id="HelpModal" class="modal fade" role="dialog">
						      <div class="modal-dialog">

						        <!-- Modal content-->
						        <div class="modal-content">
						          <div class="modal-header">
						            <button type="button" class="close" data-dismiss="modal">&times;</button>
						            <h4 class="modal-title">إرسال شكوى أو إقتراح </h4>
						          </div>
						          <div class="modal-body">
                    {{Form::open(['class'=>'HelpForm','route'=>'help.store'])}}

						        <div class="form-group Email-main-info">
						            <label for="title">العنوان:</label>
						            <input type="text" class="form-control User_NameInput" id="title" name="title" placeholder="" >
						        </div>
						        <div class="clearfix"></div>


						        <div class="clearfix"></div>


						        <span class=" label"> المــحتوي : </span>
						        <div class="form-group text-area">
						            <textarea class="form-control"  name="subject" rows="4"></textarea>
						        </div>



						    </div>
						          <div class="modal-footer">


												<button  name="submit"  type="submit" class="btn btn-primary waves-effect waves-light m-r-5 ladda-button  send " >
													 إرسال
													   <span class=""><i class="fa fa-share-square"></i> </span>
												</button>

						            <button type="button"  class="btn btn-danger" data-dismiss="modal">

						                اغلاق
						                <span><i class="fa fa-times-circle"></i></span>
						                </button>
						          </div>
												{{Form::close()}}
						        </div>

						      </div>
						    </div>


<!-- End Section Main Content -->
@endsection


@section('page-scripts')


        <!--FooTable-->
		<script src="plugins/footable/js/footable.all.min.js"></script>

		<script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

        <!--FooTable Example-->
		<script src="pages/jquery.footable.js"></script>
		<!--datepicker js for date -->
		<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

		<!-- <script src="plugins/select2/js/select2.min.js"></script> -->
		<!--<script src="plugins/select2/js/select2.full.js"></script>-->
		<script src="plugins/tinymce/tinymce.min.js"></script>

		<!-- Modal-Effect -->
		<script src="plugins/custombox/js/custombox.min.js"></script>
		<script src="plugins/custombox/js/legacy.min.js"></script>
		<!-- ladda js -->
		<script src="plugins/ladda-buttons/js/spin.min.js"></script>
		<script src="plugins/ladda-buttons/js/ladda.min.js"></script>
		<script src="plugins/ladda-buttons/js/ladda.jquery.min.js"></script>
		<!-- Notification js -->
		<script src="plugins/notifyjs/js/notify.js"></script>
		<script src="plugins/notifications/notify-metro.js"></script>

		<!-- Modal-Effect -->
		<script src="plugins/custombox/js/custombox.min.js"></script>
		<script src="plugins/custombox/js/legacy.min.js"></script>


		<!-- PrintArea -->
		<script src="plugins/PrintArea/jquery.PrintArea.js"></script>
    <script>
       jQuery(document).ready(function($) {

            $( "#btnFilter" ).click(function() {
                $( ".filter" ).slideToggle( 200, function() {

                });
            });

           $('#start-date , #end-date').datepicker({
               autoclose: true,
               todayHighlight: true
           });

           $('#btnClearFilters').click(function () {
                $('#filterSearch,#filterCustomer,#start-date,#end-date,#filterTags').val('');
                $('#filterSearch').focus();
           });


           $('body').on('click', '.page-panel .pagination a', function(ev) {
               ev.preventDefault();
//               var page_number = $(this).attr('href').split('page=')[1];
               getData(null,$(this).attr('href'));
           });

           $('#state_all,#status_mounthly,#status_quarterly').click(function () {
               if ($(this).hasClass('active')){
                   return void (0);
               }else{
                   $('.page-panel .panel-heading .panel-nav a.active').removeClass('active');
                   $(this).addClass('active');
                   //getData(null , $(this).attr('link'));
               }

           });


           function getData(page_number , url) {
               url = url || '?page=' + page_number
//               window.history.pushState("", "", url);
               var outerBox = '.page-panel';
               var Box = '.page-panel .BoxContent';
               var loaging = '<div id="overlayPagination" class="overlay overlay-x1"><i class="fa fa-spinner fa-pulse fa-fw" ></i></div>';
               $(outerBox + ' .btn').attr('disabled','disabled');
               $(Box + ' #overlayPagination').remove();
               $(Box).append(loaging);
               $.ajax({
                   url : url
               }).done(function (data) {
                   $(Box).html(data);
                   $('.CopyedPagination').html($('.NewPagination').html());
                   $('.BoxContent #overlayPagination').remove();
                   $(outerBox + ' .btn').removeAttr('disabled','disabled');
               }).fail(function () {
                   $('.BoxContent #overlayPagination').remove();
                   $('.BoxContent #overlayError').remove();
                   var error = '<div id="overlayError" class="alert alert-danger" style="margin: 0"><h4>خطأ في الاتصال<i class="fa fa-exclamation fa-fw"></i></h4><p>حدث خطأ اثناء الاتصال قد يكون انقطاع في الاتصال . حاول مرة اخري</p></div>';
                   $(Box).html(error);
               });
           }



	 //send problem or suggestion
// 	 $('form.HelpForm').submit(function(){
// 		 var this_objct = this;
// console.log('in help form');
// $.post($(this).attr('action'),$(this).serialize(),function(result){
//
//
// },'json');
// return false;
//
// 	 });
// 	 //
// $('form.HelpForm').submit(function(){
// 		$('.alerts').html('');
// 	 var led = $(this).attr('led')
// 	 var lada = '.ladda-button[led="' + led + '"]'
// 	 $(lada).ladda('start');
// 		console.log( $(this).serialize());
// 		var url = "{{ route('help.store') }}";
// 		$.ajax({
// 				type: "post",
// 				url: url,
// 				data: $(this).serialize() ,
// 				success: function(data)
// 				{
// 					console.log(data);
// 					console.log(data);
// 						setTimeout(function () {
// 							 $(lada).ladda('stop');
// 						},2000)
// 						if (isNaN(data)){
// 								$.each(data['errors'], function(i, item) {
// 										$.Notification.autoHideNotify('error', 'top right', 'Whoops',item);
// 								});
// 						}else{
// 								var mode = 'iframe'; //popup
// 								var close = mode == "popup";
// 								var options = { mode : mode, popClose : close};
//
//
// 								setTimeout(function() {
//
// 						 //  window.location.href = "{{route('sales_invoice.index')}}";
// 								}, 2500);
// 							$.Notification.autoHideNotify('success', 'top right', 'Yor Message send successfully','Admin will replay you in as soon as possible<br>');
// 						}
// 				},
// 				error: function(data){
// 						setTimeout(function () {
// 								$(lada).ladda('stop');
// 						},2000)
// 						$.Notification.autoHideNotify('error', 'top right', 'Whoops','Error may be in connection to server<br>');
// 				}
// 		});
// });

        });
    </script>

@endsection
