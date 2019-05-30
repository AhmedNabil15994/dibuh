@extends(Config::get('front_theme').'.layouts.default')


@section('title',$page_title)

@section('page-styles')
    <style>
        .page-panel{
            margin-top: 80px;
        }
    </style>
    <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
@endsection()

@section('subnav')
    @include(Config::get('front_theme').'.dashboard.user.product.inc.subnav')
@endsection

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

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
 
                <ul class="panel-nav pull-left">
                    <li><a class="active" id="state-all"    href="javascript:void(0)"  link="{{Route('product.get_product_with_type',[0])}}">{{trans('frontend/product.product_state_all'   )}}</a></li>
                    <li><a class=""       id="state-product"  href="javascript:void(0)"  link="{{Route('product.get_product_with_type',[1])}}">{{trans('frontend/product.products' )}}</a></li>
                    <li><a class=""       id="state-service" href="javascript:void(0)"  link="{{Route('product.get_product_with_type',[2])}}">{{trans('frontend/product.services')}}</a></li>

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
                <div class="BoxContent">
                        @include(Config::get('front_theme').'.dashboard.user.product.ajax.load_product_with_types')
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-4 pull-left">
                    <a class="btn btn-default waves-effect waves-light" href="{{ route('product.create') }}">   {{trans('button.create')}}  </a>
                </div>
                <div class="col-md-8 pull-right">
                    <div class="CopyedPagination pull-right">
                        {!! $data->render() !!}
                        {{--<ul class="pagination">--}}
                            {{--<!-- Previous Page Link -->--}}
                            {{--<li class="disabled"><span>«</span></li>--}}
                            {{--<!-- Pagination Elements -->--}}
                            {{--<!-- Array Of Links -->--}}
                            {{--<li class="active"><span>1</span></li>--}}
                            {{--<li><a href="#">2</a></li>--}}
                            {{--<li><a href="#">3</a></li>--}}
                            {{--<!-- Next Page Link -->--}}
                            {{--<li><a href="#" rel="next">»</a></li>--}}
                        {{--</ul>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-scripts')
    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
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
 
 

 