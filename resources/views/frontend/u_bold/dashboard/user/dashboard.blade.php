
@extends(Config::get('front_theme').'.layouts.default')

@section('title')
- {{$page_title}}
@endsection

@section('page-styles')

<!-- styles for first login tooltip  -->
  <!-- <link href="plugins/step-by-step-modal/bootstrap.min.css" rel="stylesheet"> -->
 <link href="plugins/step-by-step-modal/demo.css" rel="stylesheet">
 <!-- Add IntroJs styles -->
 <link href="plugins/step-by-step-modal/introjs.css" rel="stylesheet">
 <!-- Add IntroJs RTL styles -->
 <link href="plugins/step-by-step-modal/introjs-rtl.css" rel="stylesheet">
 <link href="plugins/step-by-step-modal/bootstrap-responsive.min.css" rel="stylesheet">
 <!--  -->

<link rel="stylesheet" type="text/css" href="css/user_dashboard.css">
 <!--Chartist Chart CSS -->
<link rel="stylesheet" href="plugins/chartist/css/chartist.min.css">
<!-- Animation css -->
<link href="plugins/animate/animate.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.forlist{
    color: #eb4d4b !important;
    font-size:16px;
    font-weight: bold;
}
.introjs-helperLayer{
        background-color: rgba(255,255,255,.3) !important;
        height: 59px !important;



}
.introjs-tooltipReferenceLayer{
 top:30px !important;
}
.introjs-tooltip{
    min-width:300px !important;
    padding: 15px !important;


}

/*for 9 and 10
.introjs-tooltip{
    top:15px;
    left: 107px;
}
.introjs-helperNumberLayer{
        top: 6px;
    left: 74px;
}
.introjs-helperLayer{
     height: 55px !important;
    top: 4px !important;
}
        top: 15px !important;


*/

.introjs-tooltip {
    padding-bottom: 10px !important;
    padding-top: 20px !important;
    padding-right: 20px !important;
    padding-left: 20px !important;
}
.introjs-helperLayer  .introjs-fixedTooltip .introjs-fixedTooltip{
       opacity: .3 !important;


}
.introjs-tooltiptext{
    padding:10px !important;
        font-size: 13px !important;
    line-height: 20px !important;
    letter-spacing: .6px !important;
        box-shadow: 7px 0px 2px 0px grey !important;

}
.introjs-bullets li a {
    width:12px !important;
    height:12px !important;

}
.introjs-helperNumberLayer{
background:#5fbda9 !important;


}
.introjs-bullets ul li a.active , .introjs-bullets ul li a:hover{

background:#5fbda9 !important;

}
.introjs-tooltipbuttons{
       margin-top: 12px;

    text-align: center;
}

.introjs-button {
    color: #fff !important;;

    display: inline-block !important;;
    font-weight: 200 !important;;
    line-height: 1.25 !important;;
    text-align: center !important;;
    white-space: nowrap !important;;
    vertical-align: middle !important;;
    font-size: 13px !important;
    letter-spacing:1px !important;
     background:#d9534f !important;
    border-color: #d9534f !important;
}
.introjs-skipbutton {
        padding: 6px 15px 6px 15px !important;
    margin-left: -2px !important;
        margin-right: 0 !important;

     background:#d9534f !important;
    border-color: #d9534f !important;

}
.introjs-button .introjs-skipbutton:hover{
     color:#ffff;
    background-color: #c9302c !important;
    border-color: #c12e2a !important;
}




.introjs-prevbutton{
    background-color: #5fbda9  !important;
    border-color: #5fbda9  !important;
    padding:6px 10px !important;

}

.introjs-nextbutton {
    padding:6px 10px !important;

    background-color: #5fbda9  !important;
    border-color: #5fbda9  !important;
}
 .introjs-prevbutton:hover , .introjs-prevbutton:focus  , .introjs-nextbutton:hover , .introjs-nextbutton:focus {
 background-color: #117a8b !important ;
    border-color: #10707f !important;
    color:#ffff;
}



.introjs-button:focus, .introjs-button:hover {
    text-decoration: none !important;
}
.introjs-fixedTooltip:first-child{
    opacity:.3
}

/*
 end intro js style
*/


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

    @media (min-width:991px){
      .pbody.table-responsive{
        overflow: hidden;
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
    a.introjs-button{
        margin-left: 20px;
        border-radius: 5px;
        float: right;
    }
    a.introjs-button.introjs-skipbutton{
        float: none;
        float: left;
    }

    .wrapper{
        padding-bottom: 40px;
    }


</style>
@endsection




@section('content')

<!-- End Breadcrumb -->
<!-- Start Section Main Content -->
<div class="main_contant">
    <div class="container">


                <!-- Page-Title -->
                <div class="row flash animated">
                    <div class="col-sm-12">


                        <h4 class="page-title" style="margin-top: -50px;">لوحة التحكم</h4>
                        <p class="text-muted page-title-alt">اهلا بك فى <span style="color: #5DB9A6;font-weight: bold">دى بو</span></p>
                    </div>
                </div>
                <!-- end row -->
				
				<div class="row">
                    <div class="col-sm-4  fadeInRight animated">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="الايرادات"></i>
                            <h4 class="text-muted">إجمالي الدخل</h4>
                            <?php
                                $user_id = Auth::user()->id;
                                $incomes = \DB::table('sales_invoices')->where('status','=',0)->where('user_id','=' , $user_id )->sum('total_invoice');
                                $outcomes = \DB::table('costs')->where('user_id','=' , $user_id )->sum('total_invoice');
                                $incomes = round($incomes,2);
                                $outcomes = round($outcomes,2);
                                if($incomes == ''){
                                    $incomes = 0;
                                }
                                if($outcomes == ''){
                                    $outcomes = 0;
                                }
                                $diff = $incomes-$outcomes;
                                $all  = $incomes+$outcomes;

                                $diff = round($diff,2);
                                $all = round($all,2);    

                                /*$outrate = ($outcomes/$all)*100;
                                $inrate  = ($incomes/$all)*100;
                                $diffrate= ($diff/$all)*100;*/
                            ?>
                            <h2 class="text-primary text-center"><span>{{$incomes}}</span> ج.م</h2>
                            <p class="text-muted">إجمالي الايرادات :  {{$incomes}} ج.م<span class="pull-right"><i class="fa fa-caret-up text-primary m-r-5"></i><?php ?> %</span></p>
                        </div>
                    </div>

                    <div class="col-sm-4 fadeInDown animated">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="المصروفات"></i>
                            <h4 class="text-dark">وضع المبيعات</h4>
                            <h2 class="text-pink text-center"><span>{{$outcomes}}</span> ج.م</h2>
                            <p class="text-muted">إجمالي المبيعات : {{$outcomes}} ج.م<span class="pull-right"><i class="fa fa-caret-down text-danger m-r-5"></i><?php ?> %</span></p>
                        </div>
                    </div>

                    <div class="col-sm-4 fadeInUp animated">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="الفرق بين الايرادات والمصروفات"></i>
                            <h4 class="text-dark">حالة الربح</h4>
                            <h2 class="text-success text-center"><span>{{$diff}}</span> ج.م</h2>
                            <p class="text-muted">إجمالي الربح : {{$diff}} ج.م<span class="pull-right"><i class="fa fa-caret-up text-primary m-r-5"></i><?php ?> %</span></p>
                        </div>
                    </div>


                </div>	
                
                <!-- end row -->

                <div class="row">
									<div id="firstHelpModal" class="modal fade"  role="dialog" aria-labelledby="" aria-hidden="true" data-modal-date="{{Auth::user()->last_login_front}}"   >
											@include(Config::get('front_theme').'.dashboard.user.first_login_help.first_login_help')
									</div><!-- /.modal -->

                    <div class="col-sm-8 col-xs-12 bounceInLeft animated" style="height:440px">
                      <div class="card-box">
                        <h4 class="m-t-0 header-title"><b>مخطط بيانى للوضع الحالى </b></h4>
                        <p class="text-muted m-b-30 font-13">
                            يمكنك متابعة التغيرات هنا
                        </p>

                          <div id="temps_div"></div>
              
                      <?= Lava::render('AreaChart', 'Temps', 'temps_div') ?>
                    </div>


                    </div>


                    <div class="col-sm-4 col-xs-12 bounceInRight animated">
                        <div class="card-box" style="max-height:417px">
                            <h4 class="text-dark header-title m-t-0 m-b-30">فيديو توضيحى</h4>


                            <div align="center" class="embed-responsive embed-responsive-16by9" style="height: 340px">
                                  <video controls>
                                       <source src="{{asset('dibuh-video/www.dibuh.com.mp4')}}" type="video/mp4">
                                    </video>
                                </div>
                        </div>
                    </div>

                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="widget-panel widget-style-2 bg-white">
                            <i class="md md-attach-money text-primary"></i>
                            <?php
                                $user_id = Auth::user()->id;
                                $start_balance = \DB::table('finance_treasury')->where('currency_id' ,'=', '1')->where('user_id','=' , $user_id )->sum('start_balance');
                                if($start_balance == ''){
                                    $start_balance = 0;
                                }
                            ?>
                            <h2 class="m-0 text-dark  font-600" style="display: inline-block;"><?php echo $start_balance;?></h2> جنيها مصريا
                            <div class="text-muted m-t-5">الخزنة</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="widget-panel widget-style-2 bg-white">
                            <i class="md fa fa-money text-pink"></i>
                            <?php
                                $user_id = Auth::user()->id;
                                $bank_balance = \DB::table('finance_banks')->where('currency_id' ,'=', '1')->where('user_id','=' , $user_id )->sum('bank_balance');
                                if($bank_balance == ''){
                                    $bank_balance = 0;
                                }
                            ?>
                            <h2 class="m-0 text-dark  font-600" style="display: inline-block;"><?php echo $bank_balance;?></h2>  جنيها مصريا
                            <div class="text-muted m-t-5">البنوك</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="widget-panel widget-style-2 bg-white">
                            <i class="md fa fa-credit-card text-info"></i>
                            <?php
                                $user_id = Auth::user()->id;
                                $credit_balance = \DB::table('finance_credit')->where('user_id','=' , $user_id )->sum('credit_balance');
                                if($credit_balance == ''){
                                    $credit_balance = 0;
                                }

                            ?>
                            <h2 class="m-0 text-dark  font-600" style="display: inline-block;"><?php echo $credit_balance;?></h2>  جنيها مصريا
                            <div class="text-muted m-t-5">بطاقة ائتمان</div>
                        </div>
                    </div>

                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-md-8" >

                        <div class="pbody table-responsive">
                <div class="BoxContent">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>الحاله</th>
                                <th>رقم الفاتوره</th>
                                <th> اسم الشركه</th>
                                <th>اسم العميل </th>
                                <th>المبلغٍ </th>
                                <th> العمله </th>
                                <th>تاريخ الاستحقاق باليوم </th>

                                <th></th>
                            </tr>
                        </thead>
                        <div class="tableBody">
                            <tbody>
                              @if(count($invoices))
                                <?php $label_type = ['warning', 'info', 'danger', 'success','success'];

                                ?>
                                  @foreach($invoices as $invoice)
                                  <?php     $deliver_date=\Carbon::parse($invoice->delivery_date);
                                            $company=App\Models\User::find(Auth::user()->id)->profile;
                                      ?>
                                        <tr>
                                          <td><span class="label label-{{$label_type[$invoice->invoiceStatus->id-1]}} full-size">{{ $invoice->invoiceStatus->name }}</span></td>
                                          <td>{{ $invoice->invoice_number    }}</td>
                                          <td> {{$company->company}}</td>
                                          <td>{{ $invoice->contact_name      }}</td>
                                          <td>{{ $invoice->total_invoice     }}</td>
                                          <td>{{ $deliver_date->diffInDays($date_now)  }}</td>


                                            <td>
                                              <a class="btn show btn-primary waves-effect waves-light" href="{{ route('sales_invoice.show' ,$invoice->id) }}"><i class="fa fa-vcard"></i>  {{trans('frontend/sales_invoice.show')}}</a>
                                           </button>
                                            </td>
                                        </tr>
                                        @endforeach

                                          <tr>

                                      </tr>

                                        @endif


                            </tbody>

                        </div>
                    </table>
                        @if(!count($invoices))
                        <div id="overlayError">
                            <div class="row" >
                                <div class="col-xs-6 text-right">
                                    <img style="width: 120px;" src="images/filter.svg">
                                </div>
                                <div class="col-xs-6">
                                    <div class="callout callout-info" style="margin-top: 50px;">
                                        <h4>لا يوجد نتائج <i class="fa fa-exclamation fa-fw"></i></h4>
                                        <p>لا يوجد نتائج مطابقه الان</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                </div>
                  <a style=""class="btn more btn-primary waves-effect showMore waves-light" href="{{ route('sales_invoice.index') }}"><i class="glyphicon glyphicon-align-center"></i>  المزيد</a>
            </div>


                      </div>
                       <!-- Start Activities -->
                    <div class="col-md-4">
                        <div class="card-box">
                            <h4 class="text-dark header-title m-t-0">المسار</h4>
                            <p class="text-muted font-13">
                                هنا ستجد اخر التعديلات .
                            </p>

                            <div class="nicescroll p-20" style="height: 320px;">
                                <div class="timeline-2">
                                    <div class="time-item">
                                        <div class="item-info">
                                            <div class="text-muted"><small>منذ ٥ دقائق</small></div>
                                            <p><strong><a href="#" class="text-info">محمد طه</a></strong> رفع صورة <strong>"DSC000586.jpg"</strong></p>
                                        </div>
                                    </div>

                                    <div class="time-item">
                                        <div class="item-info">
                                            <div class="text-muted"><small>منذ ۳۰ دقيقة</small></div>
                                            <p><a href="" class="text-info">محمود</a> علق على منشور .</p>
                                            <p><em>"نحن سعداء بالعمل فى هذا المشروع "</em></p>
                                        </div>
                                    </div>

                                    <div class="time-item">
                                        <div class="item-info">
                                            <div class="text-muted"><small>منذ ٥۹ دقيقة</small></div>
                                            <p><a href="" class="text-info">خالد</a> حضر اجتماع مع <a href="#" class="text-success">محمد طه</a>.</p>
                                            <p><em>"نحن سعداء بالعمل فى هذا المشروع . نحن سعداء بالعمل فى هذا المشروع "</em></p>
                                        </div>
                                    </div>

                                    <div class="time-item">
                                        <div class="item-info">
                                            <div class="text-muted"><small>منذ ۱ ساعة</small></div>
                                            <p><strong><a href="#" class="text-info">ماركو </a></strong>حمل ۳ صور جديده</p>
                                        </div>
                                    </div>

                                    <div class="time-item">
                                        <div class="item-info">
                                            <div class="text-muted"><small>منذ ٥ دقائق</small></div>
                                            <p><strong><a href="#" class="text-info">محمد طه</a></strong> رفع صورة <strong>"DSC000586.jpg"</strong></p>
                                        </div>
                                    </div>

                                    <div class="time-item">
                                        <div class="item-info">
                                            <div class="text-muted"><small>منذ ۳۰ دقيقة</small></div>
                                            <p><a href="" class="text-info">محمود</a> علق على منشور .</p>
                                            <p><em>"نحن سعداء بالعمل فى هذا المشروع "</em></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Activities -->


          </div>



                </div>
                <!-- end row -->

        </div><!-- end container -->



    </div>

</div>



<!-- End Section Main Content -->
@endsection

@section('page-scripts')
    <!-- first login tooltip -->
    <script type="text/javascript" src="plugins/step-by-step-modal/intro.js"></script>
    <!--Chartist Chart-->
	<script src="plugins/chartist/js/chartist.min.js"></script>
    <script src="plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>
	<script src="pages/jquery.chartist.init.js"></script>
    <!-- Dashboard 4 js -->
	<script src="pages/jquery.dashboard_4.js"></script>
	<script type="text/javascript">

		var date=document.getElementById("firstHelpModal").getAttribute("data-modal-date");
		console.log(date);
		// $('#firstHelpModal').modalSteps({
		// btnCancelHtml: 'Cancel',
		// btnPreviousHtml: 'Previous',
		// btnNextHtml: 'Next',
		// btnLastStepHtml: 'Complete',
		// disableNextButton: false,
		// completeCallback: function(){},
		// callbacks: {}
		// });
    	//	console.log($('#firstHelpModal').date());
    	if(date=="" &  $(window).width() >= 992)
    	introJs().setOptions({ 'nextLabel': ' التالي', 'prevLabel': 'السابق ', 'skipLabel': 'تخطي', 'doneLabel': 'انهاء ' }).start();
        $(window).load(function () {
           $.get('dashboard/last_login_front',function(){});

        });
		// $('#firstHelpModal').modal("show");

        if($('.introjs-overlay').length != 0) {
            $('#navigation .navigation-menu  li a') .addClass('forlist');
        }else{
            $('#navigation .navigation-menu  li a') .removeClass('forlist');
        }

        $(document).on('click',function(){
            //console.log('clicked');
            $('#navigation .navigation-menu  li a') .removeClass('forlist');
        });



	</script>
@endsection
