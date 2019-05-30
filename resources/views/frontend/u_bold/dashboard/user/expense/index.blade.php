@extends(Config::get('front_theme').'.layouts.default')


@section('title',$page_title)

@section('page-styles')

    <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">

     <style>
        .page-panel{
            margin-top: 80px;
        }
        #datatable_paginate{
            text-align: left;
        }
        .dataTables_wrapper .row:first-of-type .col-sm-6:first-of-type{
            float: left;
        }
        #datatable_wrapper .row:last-of-type{
            margin-top: 30px;
        }
        .dataTables_filter{
            display: none;
        }
        .dataTables_length,
        .pagination{
            float: left;
        }
    </style>
@endsection()

@section('subnav')
    @include(Config::get('front_theme').'.dashboard.user.more.inc.subnav')
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
                    <li><a class="active" id="state-all"    href="javascript:void(0)"  link="{{Route('expense.get_expense_with_type',[0])}}">{{trans('frontend/expense.expense_state_all'   )}}</a></li>
                    <?php
                    $expnese_type=  App\Models\ExpenseType::all();

                    ?>
                    @foreach ($expnese_type as $row)
                        <li><a class=""       id="state-expense"  href="javascript:void(0)"  link="{{Route('expense.get_expense_with_type',[$row->id])}}">{{$row->name }}</a></li>
                    @endforeach



                </ul>
            </div>
        </div>
        <div class="panel-body">
          <div class="filter" style="display: none">
             <div class="row ">
               <div class="col-md-2 col-xs-12">
                   <div class="form-group has-feedback ">
                       <label for="filterNumber" class="control-label">كود المصروف :</label>
                       <input class="form-control " type="text" name="filterNumber" id="filterNumber" value="">
                       <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                   </div>
               </div>

                 <div class="col-md-2 col-xs-12">
                     <div class="form-group has-feedback ">
                         <label for="filterName" class="control-label">الاسم :</label>
                         <input class="form-control" type="text" name="filterName" id="filterName" value="" >
                        <span class="fa fa-tag fa-fw form-control-feedback"></span>
                     </div>
                 </div>

                 <div class="col-md-2 col-xs-12">
                     <div class="form-group-without-label">
                         <button type="button" id="btnClearFilters" class="btn btn-white waves-effect ">
                             {{trans('button.cancel_input'  )}}
                         </button>
                         <button type="button" id="btnOkFilters" class="btn btn-white waves-effect "><i class="fa fa-search"></i></button>
                     </div>
                 </div>
             </div>
          </div>
            <div class="pbody table-responsive">
                <div class="BoxContent card-box">
                        @include(Config::get('front_theme').'.dashboard.user.expense.ajax.load_expense_with_types')
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-4 pull-left">
                    <a class="btn btn-default waves-effect waves-light" href="{{ route('expense.create') }}">   {{trans('أضافة جديد')}}  </a>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('page-scripts')

    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>

    <script>
       jQuery(document).ready(function($) {
            $('.demo-foo-filtering').DataTable( );
            $( "#btnFilter" ).click(function() {
                $( ".filter" ).slideToggle( 200, function() {

                });
            });

           $('#start-date , #end-date').datepicker({
               autoclose: true,
               todayHighlight: true
           });

           $('#btnClearFilters').click(function () {
                $('#filterNumber,#filterName').val('');
                $('#filterSearch').focus();
           });


           /*$('body').on('click', '.page-panel .pagination a', function(ev) {
               ev.preventDefault();
//               var page_number = $(this).attr('href').split('page=')[1];
               getData(null,$(this).attr('href'));
           });*/

           $('#state-all , #state-expense , #state-service').click(function () {
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
           $('#btnOkFilters').on('click', function() {

               filtered = true;
               console.log($('#filterName').val());
               var url = "{{Route('expense.filter')}}" +
                       '/' + ($('#filterNumber').val() == '' ? '-1' :$('#filterNumber').val()) +
                       '/' + ($('#filterName').val() == '' ? '-1' : $('#filterName').val()) ;

               var outerBox = '.page-panel';
               var Box = '.page-panel .BoxContent';
               var loaging = '<div id="overlayPagination" class="overlay overlay-x1"><i class="fa fa-spinner fa-pulse fa-fw" ></i></div>';
            //   $(outerBox + ' .btn').attr('disabled','disabled');
               $(Box + ' #overlayPagination').remove();
               $(Box).append(loaging);
               $.ajax({
                   url : url
               }).done(function (data) {
                   $(Box).html(data);
                   $('.CopyedPagination').html($('.NewPagination').html());
                   $('.BoxContent #overlayPagination').remove();
                //   $(outerBox + ' .btn').removeAttr('disabled','disabled');
               }).fail(function () {
                   $('.BoxContent #overlayPagination').remove();
                   $('.BoxContent #overlayError').remove();
                   $(outerBox + ' .btn').removeAttr('disabled','disabled');
                   var error = '<div id="overlayError" class="alert alert-danger" style="margin: 0"><h4>خطأ في الاتصال<i class="fa fa-exclamation fa-fw"></i></h4><p>حدث خطأ اثناء الاتصال قد يكون انقطاع في الاتصال . حاول مرة اخري</p></div>';
                   $(Box).html(error);
               });
           });


        });
    </script>

@endsection
