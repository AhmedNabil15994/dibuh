@extends(Config::get('front_theme').'.layouts.default')


@section('title',$page_title)

@section('page-styles')
    <style>
        .bank_header{
            margin-top: 80px;
        }
    </style>
    <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
@endsection

@section('subnav')
    @include(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.inc.subnav')
@endsection


@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


            <div class="card-box bank_header" >
                <div class="row m-t-20" >
                    <div class="col-lg-8" >
                        <div class="card-box" style="background:#eee"> 
                            <canvas id="lineChart" height="300"></canvas>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-lg-offset-1 text-center m-l-0">
                        <div class="panel panel-color panel-custom">
                            <div class="panel-heading">
                                <h3 class="panel-title ">الصافى</h3>
                            </div>
                            <div class="panel-body" style="font-size:24px">
                                <p>
                                  ٢٥٣.٤٦  ج.م
                                </p>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-lg-2 col-lg-offset-1 text-center m-l-0">
                        <div class="panel panel-color panel-custom">
                            <div class="panel-heading">
                                <h3 class="panel-title ">السنة المالية</h3>
                            </div>
                            <div class="panel-body" style="font-size:24px">
                                <p>
                                  ٢٥٣.٤٦  ج.م
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

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
                
                    <div class="button-list">
                      <button type="button" class="btn btn-default waves-effect waves-light ">أضافة مبلغ</button>

                      <button type="button" class="btn btn-white  waves-effect waves-light m-l-20">تحرير الحساب</button>
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
                <div class="BoxContent card-box">
                    <table class="table table-hover table-striped " id="demo-foo-filtering" data-page-size="6">
                        <thead>
                            <tr>
                                <th>التاريخ</th>
                                <th>رقم العميل</th>
                                <th>الوصف</th>
                                <th>الفئة</th>
                                <th>رقم العملية</th>
                                <th>الكمية</th>
                                <th></th>
                            </tr>
                        </thead>
                        <div class="tableBody">
                            <tbody>
                                <tr>
                                    <td>000-00-00</td>
                                    <td>2222</td>
                                    <td>وصف</td>
                                    <td>مدفوع</td>
                                    <td>02</td>
                                    <td class="text-success">+ 230</td>
                                    <td>
                                        <form method="POST" action="" accept-charset="UTF-8" style="display:inline"><input name="" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light" ><i class="fa fa-close"></i> حذف</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>123-12-12</td>
                                    <td>333</td>
                                    <td>وصف</td>
                                    <td>غير مدفوع</td>
                                    <td>03</td>
                                    <td class="text-danger">- 230</td>
                                    <td>
                                        <form method="POST" action="" accept-charset="UTF-8" style="display:inline"><input name="" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light" disabled><i class="fa fa-close"></i> حذف</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                  <tr>
                                    <td>000-00-00</td>
                                    <td>2222</td>
                                    <td>وصف</td>
                                    <td>مدفوع</td>
                                    <td>02</td>
                                    <td class="text-success">+ 230</td>
                                    <td>
                                        <form method="POST" action="" accept-charset="UTF-8" style="display:inline"><input name="" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light"><i class="fa fa-close"></i> حذف</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>123-12-12</td>
                                    <td>333</td>
                                    <td>وصف</td>
                                    <td>غير مدفوع</td>
                                    <td>03</td>
                                    <td class="text-danger">- 230</td>
                                    <td>
                                        <form method="POST" action="" accept-charset="UTF-8" style="display:inline"><input name="" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light"><i class="fa fa-close"></i> حذف</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                  <tr>
                                    <td>000-00-00</td>
                                    <td>2222</td>
                                    <td>وصف</td>
                                    <td>مدفوع</td>
                                    <td>02</td>
                                    <td class="text-success">+ 230</td>
                                    <td>
                                        <form method="POST" action="" accept-charset="UTF-8" style="display:inline"><input name="" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light" disabled><i class="fa fa-close" ></i> حذف</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>123-12-12</td>
                                    <td>333</td>
                                    <td>وصف</td>
                                    <td>غير مدفوع</td>
                                    <td>03</td>
                                    <td class="text-danger">- 230</td>
                                    <td>
                                        <form method="POST" action="" accept-charset="UTF-8" style="display:inline"><input name="" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light"><i class="fa fa-close"></i> حذف</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                  <tr>
                                    <td>000-00-00</td>
                                    <td>2222</td>
                                    <td>وصف</td>
                                    <td>مدفوع</td>
                                    <td>02</td>
                                    <td class="text-success">+ 230</td>
                                    <td>
                                        <form method="POST" action="" accept-charset="UTF-8" style="display:inline"><input name="" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light"><i class="fa fa-close"></i> حذف</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>123-12-12</td>
                                    <td>333</td>
                                    <td>وصف</td>
                                    <td>غير مدفوع</td>
                                    <td>03</td>
                                    <td class="text-danger">- 230</td>
                                    <td>
                                        <form method="POST" action="" accept-charset="UTF-8" style="display:inline"><input name="" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light"><i class="fa fa-close"></i> حذف</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                
                                
                        </tbody>

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
            </div>
        </div>
        
    
    
    

    
    </div>


@endsection

@section('page-scripts')
    
    <!-- Chart JS -->
        <script src="plugins/chart.js/chart.min.js"></script>
        <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <!--FooTable-->
        <script src="plugins/footable/js/footable.all.min.js"></script>
		<script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <!--FooTable Example-->
		<script src="pages/jquery.footable.js"></script>

        
        <script>

!function($) {
    "use strict";

    var ChartJs = function() {};

    ChartJs.prototype.respChart = function(selector,type,data, options) {
        // get selector by context
        var ctx = selector.get(0).getContext("2d");
        // pointing parent container to make chart js inherit its width
        var container = $(selector).parent();
        // enable resizing matter
        $(window).resize( generateChart );
        // this function produce the responsive Chart JS
        function generateChart(){
            // make chart width fit with its container
            var ww = selector.attr('width', $(container).width() );
             new Chart(ctx, {type: 'line', data: data, options: options});

        };
        // run function - render chart at first load
        generateChart();
    },
    //init
    ChartJs.prototype.init = function() {
        //creating lineChart
        var lineChart = {
            labels: ["10", "20", "30", "40", "50", "60", "70", "80", "90"],
            datasets: [
                {
                    label: "الايرادات",
                    fill: true,
                    lineTension: 0.1,
                    backgroundColor: "#5d9cec",
                    borderColor: "#5d9cec",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#F00",
                    pointBackgroundColor: "#5FBEAA",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#5FBEAA",
                    pointHoverBorderColor: "#333",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: [65, 59, 80, 81, 56, 55, 40, 35, 30]
                }
            ]
        };

        var lineOpts = {
            scales: {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 20,
                        stepSize: 10
                    }
                }]
            }
        };

        this.respChart($("#lineChart"),'Line',lineChart, lineOpts);

    },
    $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.ChartJs.init()
}(window.jQuery);

        </script>

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

           $('#state-all , #state-product , #state-service').click(function () {
               if ($(this).hasClass('active')){
                   return void (0);
               }else{
                   $('.page-panel .panel-heading .panel-nav a.active').removeClass('active');
                   $(this).addClass('active');
                   getData(null , $(this).attr('link'));
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


        });
    </script>

@endsection
 
 

 