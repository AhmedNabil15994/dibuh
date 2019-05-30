@extends(Config::get('front_theme').'.layouts.default')


@section('title',$page_title)

@section('page-styles')

    <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    
   <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    
<style>
    thead tr th {text-align: center}
         .header-print{margin-top: 75px;}
    @media print {@page {size: landscape}
       .wrapper{padding-top: 0px !important}
        .header-print,.panel{margin-top: 0px; !important}
        .container{width: 100% !important}
        .page-panel .panel-body .pbody,.card-box{padding: 0px}
    }
       
</style>
@endsection()


@section('subnav')
    @include(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.inc.subnav')
@endsection




@section('content')



 

    <div class="row m-b-20 header-print">
        <div class="col-xs-12 ">
            <h4 class="page-title">التقارير</h4>
            <p class="text-muted page-title-alt m-b-0">تحليل مصروفات تشغيل 2014</p>
        </div>
    </div>



    
    

<div class="panel panel-default page-panel">
       
        <div class="panel-heading hidden-print">
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

                <ul class="panel-nav pull-left">
<!--
                    <li><a class="active" id="state_all"    href="javascript:void(0)"  link="">الكل</a></li>
                    <li><a class="" id="status_Save"  href="javascript:void(0)"  link="">خزائن</a></li>
                    <li><a class="" id="status_Bank"    href="javascript:void(0)"  link="">بنوك</a></li> 
-->
                </ul>
                
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
                <div class="BoxContent card-box">
                         <table class="table table-hover table-bordered " id="demo-foo-filtering" data-page-size="12">
                        <thead>
                            <tr>
                                <th >البيان</th>
                                <th >يوميات</th>
                                <th>مرتبات</th>
                                <th >املاك</th>
                                <th >كهرباء</th>
                                <th >اجمالى</th>
                            </tr>
                        </thead>
                        <div class="tableBody">
                            <tbody>
                               
                                <tr>
                                    <td>يناير</td>
                                    <td>-</td>
                                    <td>3,896</td>
                                    <td>-</td>
                                    <td>4,852</td>
                                    <td>-</td>
                                </tr>
                               
                               
                                <tr>
                                    <td>فبراير</td>
                                    <td>-</td>
                                    <td>3,896</td>
                                    <td>-</td>
                                    <td>4,852</td>
                                    <td>-</td>
                                </tr>
                                
                                 <tr>
                                    <td>مارس</td>
                                    <td>1.657</td>
                                    <td>-</td>
                                    <td>5,186</td>
                                    <td>2,222</td>
                                    <td>129,796</td>
                                </tr>
                                
                                 <tr>
                                    <td>ابريل</td>
                                    <td>-</td>
                                    <td>3,896</td>
                                    <td>-</td>
                                    <td>2,222</td>
                                    <td>-</td>
                                </tr>
                                
                                 <tr>
                                    <td>مايو</td>
                                    <td>1.657</td>
                                    <td>-</td>
                                    <td>5,186</td>
                                    <td>2,222</td>
                                    <td>129,796</td>
                                </tr>
                                
                                 <tr>
                                    <td>يونيو</td>
                                    <td>-</td>
                                    <td>3,896</td>
                                    <td>-</td>
                                    <td>4,852</td>
                                    <td>-</td>
                                </tr>
                                
                                <tr>
                                    <td>يوليو</td>
                                    <td>1.657</td>
                                    <td>-</td>
                                    <td>5,186</td>
                                    <td>2,222</td>
                                    <td>129,796</td>
                                </tr>
                               <tr>
                                    <td>أغسطس</td>
                                    <td>1.657</td>
                                    <td>-</td>
                                    <td>5,186</td>
                                    <td>2,222</td>
                                    <td>129,796</td>
                                </tr>
                                
                                <tr>
                                    <td>سبتمبر</td>
                                    <td>1.657</td>
                                    <td>-</td>
                                    <td>5,186</td>
                                    <td>2,222</td>
                                    <td>129,796</td>
                                </tr>
                                
                                <tr>
                                    <td>أكتوبر</td>
                                    <td>1.657</td>
                                    <td>-</td>
                                    <td>5,186</td>
                                    <td>2,222</td>
                                    <td>129,796</td>
                                </tr>
                                
                                <tr>
                                    <td>نوفمبر</td>
                                    <td>1.657</td>
                                    <td>-</td>
                                    <td>5,186</td>
                                    <td>2,222</td>
                                    <td>129,796</td>
                                </tr>
                                
                                <tr>
                                    <td>ديسمبر</td>
                                    <td>1.657</td>
                                    <td>-</td>
                                    <td>5,186</td>
                                    <td>2,222</td>
                                    <td>129,796</td>
                                </tr>
                           
                        </tbody>
                        
                        
                        <tfoot>
                           <tr>
                                    <td>الاجمالى</td>
                                    <td>1.657</td>
                                    <td>129,796</td>
                                    <td>5,186</td>
                                    <td>2,222</td>
                                    <td>129,796</td>
                                </tr>
                                <tr class="hidden-print">
                                <td colspan="12">
                                    <div class="text-right">
                                        <ul class="pagination pagination-split m-t-30 m-b-0"style="    direction: ltr;"></ul>
                                    </div>
                                </td>
                            </tr>
                          </tfoot>

                        </div>
                        
                        
             
                    </table>
<!--
                        <div class="row">
                            <div class="col-xs-4 pull-left" style="margin-top:-50px">
                                <a class="btn btn-default waves-effect waves-light" href="{{ route('cost.create') }}">   أضافة خزنة او بنك  </a>
                            </div>
                        </div>                  
-->
                </div>
            </div>
        </div>
    
    </div>



@endsection

@section('page-scripts')
    

    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>


        <!--FooTable-->
		<script src="plugins/footable/js/footable.all.min.js"></script>

		<script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

        <!--FooTable Example-->
		<script src="pages/jquery.footable.js"></script>
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

           $('#state_all,#state_Save,#state_Bank').click(function () {
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
 
 

 