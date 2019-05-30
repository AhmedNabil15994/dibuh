
@extends(Config::get('front_theme').'.layouts.default')
@section('title',$page_title)


@section('page-styles')

<link rel="stylesheet" type="text/css" href="css/user_dashboard.css">
 <!--Chartist Chart CSS -->
		<link rel="stylesheet" href="plugins/chartist/css/chartist.min.css">
<!-- Animation css -->
        <link href="plugins/animate/animate.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">


    .col-sm-5{
        display:inline-block;
        text-align:right;
        width:40%;
    }

    .pbody{
        background:#fff !important;
        min-height: 413px;
        position:relative;
        margin-bottom:15px;
    }


    @media (max-width:992px){
        .pbody{
       min-height: auto !important;
        }
         .pbody .showMore{
    position: relative !important;
    }
    }
    .pbody .showMore{
    position: absolute;
    bottom: 0;
    right: 5px
    }
    div.Boxontent{
        height:auto;
    }
    .col-sm-7 {
    padding:0;
    width: 60%;
    vertical-align: top;

    display: inline-block;
    }

    .button-list .convert{
        margin-left:0 !important;

    }
    .more{
        margin-right:10px;
        margin-bottom:10px;
    }
		@media(min-width:991px){
			#add_price .modal-dialog .modal-content{
				width:400px;
				margin:auto;
			}
		}
        .total_box{
            margin-top:5rem;
        }

        @media(max-width:576px){
              .balance{

            font-size:15px;

        }
        }
        .panel-body{
            background-color:#f6f6f6;
            overflow-x:scroll;
        }
        .button-list button{
                margin-bottom:0;
        }
        .table thead tr th , .table tbody tr td{
            text-align:center;
        }
      @media (max-width:768px){

       .table > thead > tr > th:nth-child(1) , .table > thead > tr > th:nth-child(4) , .table > thead > tr > th:nth-child(5)
        , .pbody .table>tbody>tr>td:nth-child(1) , .panel-body .pbody .table>tbody>tr>td:nth-child(4) , .table > tbody > tr > td:nth-child(5){
            display:none;

        }
      }
     @media (max-width:552px){
         .page-title , h4.text-dark , p.text-muted{
             font-size:16px !important;
        }

        h2.text-primary , h2.text-pink , h2.text-success ,h2.text-warning ,
        .widget-panel h2.text-dark{
             font-size:20px;
         }
         .widget-panel i {
             font-size:35px;
         }
        div.BoxContent{
            height:auto;
            padding-right: 15px;
    padding-left: 15px ;
        }

        .table > thead >tr>th{
        font-size:10px;
        padding-right:0!important;
        padding-left:0 !important;

      }
      .table > tbody > tr > td{
padding-right:0!important;
        padding-left:0 !important;
                  font-size: 12px;
      }

     .table tbody tr td:last-child  a {
        padding:2px !important;
      }

      .more{
              padding: 3px;

      }
    }

    @media (max-width:465px){



          .table > thead >tr>th{
        font-size:9px;

      }
      .table > tbody > tr > td{
          text-align:center;
          font-size: 11px;
      }

            #btnFilter ,.pull-right .export button {
                margin-bottom:0;
            padding: 2px 4px !important;

      }
    }



    @media (max-width:359px){

        body{
            font-size:9px !important;

        }

    }

    @media (max-width:375px){
        .show{
            padding:0.5px !important;
            font-size:10px !important;
        }
        }

    .pbody{
        padding-left:0 !important;
        padding-right:0 !important;
    }
		.label{
		    margin-bottom:8px;
		    font-weight:bold;
		    color:#898989;
		}
		textarea{
		    margin-top: 10px;
		    max-height: 150px;
		    min-height: 150px;
		    min-width: 100%;
		    max-width: 100%;
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
<div class="panel panel-default page-panel">

	        <div class="panel-heading">
	            <div class="row">
	                <div class="col-md-5 pull-right " style="padding: 0">

	                    <button id="btnFilter" type="button" class="btn btn-default waves-effect waves-light pull-right" style="margin: 0 5px;"><i class="md md-filter-list"></i> فيلتر </button>

	                    <div class="btn-group pull-right export">
	                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-upload"></i> تصدير <span class="caret"></span> </button>
	                        <ul class="dropdown-menu" role="menu">
	                            <li><a href="#">PDF File</a></li>
	                            <li><a href="#">Excel File</a></li>
	                            <li><a href="#">Csv File</a></li>
	                            <li><a href="#">Html File</a></li>
	                        </ul>
	                    </div>
	                </div>




	            </div>
	        </div>





		        <div class="panel-body">
		            <div class="filter" style="display: none">
		               <div class="row ">
		                   <div class="col-md-2 col-xs-12">
		                       <div class="form-group has-feedback ">
		                           <label for="filterSearch" class="control-label">البحث :</label>
		                           <input class="form-control " type="text" name="filterSearch" id="filterSearch" value="">
		                           <span class="fa fa-search fa-fw form-control-feedback"></span>
		                       </div>
		                   </div>
		                   <div class="col-md-2 col-xs-12">
		                       <div class="form-group has-feedback ">
		                           <label for="filterCustomer" class="control-label">العميل :</label>
		                           <input class="form-control" type="text" name="filterCustomer" id="filterCustomer" value="" >
		                           <span class="fa fa-user fa-fw form-control-feedback"></span>
		                       </div>
		                   </div>
		                   <div class="col-md-2 col-xs-12">
		                       <div class="form-group has-feedback ">
		                           <label for="start-date" class="control-label">تاريخ البدء :</label>
		                           <input  class="form-control" type="text" name="filterStartdate" id="start-date" placeholder="mm/dd/yyyy" value="">
		                           <span class="fa fa-calendar fa-fw form-control-feedback"></span>
		                       </div>
		                   </div>
		                   <div class="col-md-2 col-xs-12">
		                       <div class="form-group has-feedback ">
		                           <label for="end-date" class="control-label">تاريخ الانتهاء :</label>
		                           <input class="form-control" type="text" name="filterenddate" id="end-date" placeholder="mm/dd/yyyy" value="" >
		                           <span class="fa fa-calendar fa-fw form-control-feedback"></span>
		                       </div>
		                   </div>
		                   <div class="col-md-2 col-xs-12">
		                       <div class="form-group has-feedback ">
		                           <label for="filterTags" class="control-label">الكلمات الدلالية :</label>
		                           <input class="form-control" type="text" name="filterTags" id="filterTags" value="" >
		                           <span class="fa fa-tags fa-fw form-control-feedback"></span>
		                       </div>
		                   </div>
		                   <div class="col-md-2 col-xs-12">
		                       <div class="form-group-without-label">
		                           <button type="button" id="btnClearFilters" class="btn btn-white waves-effect ">الغاء المدخلات </button>
		                       </div>
		                   </div>
		               </div>
		            </div>


					  <div class="pbody table-responsive">
							  <div class="BoxContent">
							<table class="table table-hover table-striped" id="example1" data-page-size="6">
								<thead>
										<tr>
												<th>عنوان الشكوى </th>
												<th>الشكوى  </th>
												<th>الشكوى من </th>
												<th>التاريخ </th>

												<th></th>
										</tr>
								</thead>
						 <div class="tableBody">
								 <tbody>
									 @foreach($helpings as $help)
										 <tr>
											 <?php $user_name=App\Models\User::where('id',$help->user_id)->first()->name;
											       $replays=App\Models\HelpingReplay::where('helping_id',$help->id)->get();

														 	 ?>
												 <td> {{$help->title}}</td>
												 <td>{{$help->subject}} </td>
												 <td>{{$user_name}}  </td>
												 <td>{{$help->created_at}} </td>
												 <br><br>

                       @foreach($replays as $replay)
											 <?php
                            $admin_name=App\Models\User::where('id',$replay->user_id)->first()->name;
											  ?>
											 <tr>
                           <td>{{$replay->replay}}</td>
													 <td>{{$admin_name}}</td>
													 <td>{{$replay->created_at}}</td>
											 </tr>
											 @endforeach

										 </tr>
										 @endforeach







						 </tbody>

						 </div>
</div>

						 <tfoot>
								 <tr>
										 <td colspan="12">
												 <div class="text-right">
														 <ul class="pagination pagination-split m-t-30 m-b-0"style="    direction: ltr;"></ul>
												 </div>
										 </td>
								 </tr>
						 </tfoot>

				 </table>
			 </div>
						 <div class="row">

								 <button style="margin-top:-50px" type="button" data-style="expand-right" id="btnSendmailPrint" class="btn btn-default waves-effect waves-light"  data-toggle="modal" data-target="#HelpModal">
										 <span class="ladda-label"> أرسال شكوى أو إقتراح<i class="fa fa-send"></i></span>
										 <span class="ladda-spinner"></span>
								 </button>
						 </div>

		 </div>




						</div>

						<div id="HelpModal" class="modal fade" role="dialog">
						      <div class="modal-dialog">

						        <!-- Modal content-->
						        <div class="modal-content">
						          <div class="modal-header">
						            <button type="button" class="close" data-dismiss="modal">&times;</button>
						            <h4 class="modal-title">إرسال شكوى أو إقتراح </h4>
						          </div>
						          <div class="modal-body">
                    {{Form::open(['class'=>'HelpForm','route'=>'helps.store'])}}

						        <div class="form-group Email-main-info">
						            <label for="title">عنوان الشكوى  :</label>
						            <input type="text" class="form-control User_NameInput" id="title" name="title" placeholder="عنوان الشكوى " >
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
