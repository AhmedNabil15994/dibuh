@extends(Config::get('front_theme').'.layouts.default')


@section('title',$page_title)

@section('page-styles')
    
    <link rel="stylesheet" type="text/css" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link href="plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">

    <style>
        .bank_header{
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
        .select2-dropdown{
            z-index: 9999 !important;
        }   
        .select2-selection__rendered{
            font-size: 14px;
            direction: rtl;
        }
		@media(min-width:991px){
			#add_price .modal-dialog .modal-content{
				width:400px;
				margin:auto;
			}
		}

    </style>
    
@endsection



@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


<div id="add_price" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">اضافة ملبغ</h4>
            </div>
            <div class="modal-body">
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
                    
                    <div class="box-body">    
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <strong>المبلغ:</strong>
                                </div>    
                                <input type="text" name="amount" id="modal_amount" class="form-control" style="width: 66.666% !important; position: relative;" placeholder="المبلغ">
                                <span style="position: absolute;top: 7px;left: 17px"><i class="fa fa-money"></i></span>
                                <input type="hidden" id="modal_type" value="{{$type}}">
                                <input type="hidden" id="modal_id" value="{{$id}}">                          

                            </div>
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <strong>تاريخ الدفع:</strong>
                                </div>    
                                <input type="text" name="date" id="modal_date" class="form-control" style="width: 66.666% !important; position: relative;" placeholder="تاريخ الدفع" value="{{Carbon::now()->format('Y-m-d')}}">
                                <span style="position: absolute;top: 55px;left: 17px"><i class="fa fa-calendar"></i></span>

                            </div>
                        </div>  
                        
                    </div>   
            </div>      
            {!! Form::open(array('route' => 'finance.addAmount','method'=>'POST' ,'style' => 'margin-top:75px;')) !!}        
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="margin: auto; background-color: #449d44"><i class="fa fa-save"></i> {{ trans('button.create') }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>       
<?php $balance =''; $open_balance=''; $start_date =''; $name = ''; ?>
                                    @if($type == 1)
                                        <?php $balance_bank = \DB::table('finance_banks')->where('id','=',$id)->first();  $balance = $balance_bank->bank_balance;
                                              $open_balance = $balance_bank->open_balance; 
                                              $start_date   = $balance_bank->start_date;    
                                              $name         = $balance_bank->account_owner;
                                        ?>
                                    @elseif($type==2)
                                        <?php $balance_treasury = \DB::table('finance_treasury')->where('id','=',$id)->first();  
                                            $balance = $balance_treasury->start_balance;
                                            $open_balance = $balance_treasury->open_balance;  
                                            $start_date   = $balance_treasury->start_date; 
                                            $name         = $balance_treasury->treasury_name;
                                        ?>
                                    @elseif($type==3)
                                        <?php $balance_credit = \DB::table('finance_credit')->where('id','=',$id)->first();  
                                            $balance = $balance_credit->credit_balance;  
                                            $open_balance = $balance_credit->open_balance;
                                            $start_date   = $balance_credit->credit_start_date;
                                            $name         = $balance_credit->credit_owner;
                                        ?>
                                    @endif
<div id="convert" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">تحويل</h4>
            </div>
            <div class="modal-body">
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

                    
                    
                    <div class="box-body">    
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <strong>المبلغ:</strong>
                                </div>    
                                <input type="text" name="amount" id="modal_amount" class="form-control" style="width: 66.666% !important; position: relative;" placeholder="المبلغ">
                                <span style="position: absolute;top: 7px;left: 17px"><i class="fa fa-money"></i></span>
                                                   

                            </div>
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <strong>من:</strong>
                                </div>

                                <?php $from=''; ?>         
                                  @if($type==1)
                                    <?php
                                        $finance = \DB::table('finance_banks')->where('id','=',$id)->get();
                                        foreach ($finance as $key => $value) {
                                            $from = $value->account_owner ;
                                        }
                                    ?>
                                  @elseif($type==2)
                                    <?php
                                        $finance = \DB::table('finance_treasury')->where('id','=',$id)->get();
                                        foreach ($finance as $key => $value) {
                                            $from = $value->treasury_name;
                                        }
                                    ?>
                                  @elseif($type==3)
                                    <?php
                                        $finance = \DB::table('finance_credit')->where('id','=',$id)->get();
                                        foreach ($finance as $key => $value) {
                                            $from = $value->credit_owner ;
                                        }
                                    ?>
                                  @endif                                                   
                                  <input type="text" name="from" id="modal_from" class="form-control" style="width: 66.666% !important;" value="<?php echo $from; ?>" value1="<?php echo $id; ?>" disabled>
                                  <input type="hidden" name="type" id="type" value="{{$type}}">
                            </div>
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <strong>الي:</strong>
                                </div>    
                                <div class="col-xs-8" style="padding: 0;margin-bottom: 15px;">
                                    <select class="form-control select2" name="to" id="modal_to">

                                        <option>{{trans('master.select_item_from_list')}}</option>
                                    @if($type==1)
                                        <?php
                                            $finance = \DB::table('finance_banks')->where('id','!=',$id)->get();
                                        ?>
                                        @foreach($finance as $row)
                                        <option value="{{$row->id}}">{{$row->account_owner}}</option>
                                        @endforeach  
                                    @elseif($type==2)
                                        <?php
                                            $finance = \DB::table('finance_treasury')->where('id','!=',$id)->get();
                                        ?>
                                        @foreach($finance as $row)
                                        <option value="{{$row->id}}">{{$row->treasury_name}}</option>
                                        @endforeach  
                                    @elseif($type==3)
                                        <?php
                                            $finance = \DB::table('finance_credit')->where('id','!=',$id)->get();
                                        ?>
                                        @foreach($finance as $row)
                                        <option value="{{$row->id}}">{{$row->credit_owner}} -- {{$row->credit_bank_name}}</option>
                                        @endforeach  
                                    @endif             
                                    </select>
                                </div>
                            </div>
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <strong>التاريخ:</strong>
                                </div>    
                                <input type="text" name="date" id="modal_date" class="form-control" style="width: 66.666% !important; position: relative;" placeholder="تاريخ التحويل" value="{{Carbon::now()->format('Y-m-d')}}">
                                 <span style="position: absolute;top: 7px;left: 17px"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <strong>الوصف:</strong>
                                </div>    
                                <input type="text" name="description" id="modal_description" class="form-control" style="width: 66.666% !important; position: relative;" placeholder="الوصف">
                                <span style="position: absolute;top: 7px;left: 17px"><i class="fa fa-info"></i></span>
                                                   

                            </div>
                        </div>  
                        
                    </div>   
            </div>      
            {!! Form::open(array('route' => 'finance.addAmount','method'=>'POST' ,'style' => 'margin-top:219px;')) !!}        
            <div class="modal-footer">
                
                <?php $name=''; ?>
                @if($type==1)
                    <?php $name = "الحساب"; ?>
                @elseif($type==2)
                    <?php $name = "الخزنة"; ?>
                @elseif($type==3)
                    <?php $name = "الحساب"; ?>
                @endif
                <?php $attr='';$attr2=''; ?>
                @if($balance == 0)
                <?php $attr = ''; $attr2 = 'disabled';?>
                @else
                <?php $attr = 'disabled'; $attr2 = ''; ?>
                @endif
                <button type="button" class="btn btn-default" style="margin: auto; background-color: #449d44" {{$attr2}}><i class="fa fa-save"></i>  تحويل</button>
                <button class="btn btn-danger remove-account" {{$attr}}><i class="fa fa-trash"></i>  اغلاق <?php echo $name; ?></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>   
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
                                    
                                <p class="balance"><?php echo $balance; ?></p>
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
                                  <?php echo $balance; ?>
                                </p>
                            </div>
                        </div>
        </div>

    </div>

</div>


    <div class="panel panel-default page-panel">
    
      

    
        <div class="panel-heading">
            <div class="row" style="padding-bottom: 10px;">
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
                      <button type="button" class="btn btn-default waves-effect waves-light add">أضافة مبلغ</button>

                      <button type="button" class="btn btn-default  waves-effect waves-light convert">تحويل</button>
                  </div>
            </div>
        </div>
    
 
        
        <div class="panel-body">
            <div class="filter" style="display: none">
               <div class="row ">
                   
                   <div class="col-md-2 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label for="filterFinanceDate1" class="control-label">من :</label>
                            <input class="form-control date_range_filter" type="text" name="start_date" id="start_date">
                            <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label for="filterFinanceDate2" class="control-label">الي :</label>
                            <input class="form-control date_range_filter" type="text" name="end_date" id="end_date">
                            <span class="fa fa-calendar fa-fw form-control-feedback"></span>
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
                    <table class="table daTatable table-hover" id="demo-foo-filtering">
                        <thead>
                            <tr>
                                <th>التاريخ</th>
                                <th>{{trans('frontend/sales_invoice.customer')}}</th>
                                <th>الوصف</th>
                                <th>الحالة</th>
                                <th>{{trans('frontend/sales_invoice.invoice_number')}}</th>
                                <th>الكمية</th>
                                <th></th>
                            </tr>
                        </thead>
                        <div class="tableBody">
                            <tbody>
                                
                                @foreach($paid as $row)
                                <tr>
                                    <td>{{$row->paid_date}}</td>
                                    <?php
                                        $sales_invoice = [] ; $sign; $status ; $type;
                                        $invoice_type = $row->invoice_type;
                                        if($invoice_type == 0){
                                            $sales_invoice = \DB::table('sales_invoices')->where('id','=',$row->sales_invoice_id)->get();
                                            $sign = "+";
                                            $status = "وارد";
                                            $type   = "success";
                                        }elseif ($invoice_type == 1) {
                                            $sales_invoice = \DB::table('abstract_invoices')->where('id','=',$row->sales_invoice_id)->get();
                                            $sign = "+";
                                            $status = "وارد";
                                            $type   = "success";
                                        }elseif ($invoice_type == 2) {
                                            $sales_invoice = \DB::table('other_income_invoices')->where('id','=',$row->sales_invoice_id)->get();
                                            $sign = "+";
                                            $status = "وارد";
                                            $type   = "success";
                                        }elseif ($invoice_type == 3) {
                                            $sales_invoice = \DB::table('costs')->where('id','=',$row->sales_invoice_id)->get();
                                            $sign = "-";
                                            $status = "صادر";
                                            $type   = "danger";
                                        }elseif ($invoice_type == 4) {
                                            $sales_invoice = \DB::table('costs_other')->where('id','=',$row->sales_invoice_id)->get();
                                            $sign = "-";
                                            $status = "صادر";
                                            $type   = "danger";
                                        }elseif ($invoice_type == 5) {
                                            $sales_invoice = \DB::table('sales_invoices_return')->where('id','=',$row->sales_invoice_id)->get();
                                            $sign = "-";
                                            $status = "صادر";
                                            $type   = "danger";
                                        }elseif ($invoice_type == 6) {
                                            $sales_invoice = \DB::table('salaries')->where('id','=',$row->sales_invoice_id)->get();
                                            $sign = "-";
                                            $status = "صادر";
                                            $type   = "danger";
                                        }

                                    ?>
                                    <td>@foreach($sales_invoice as $one){{$one->contact_name}}@endforeach </td>
                                    <td>{{$row->finance_notes}}</td>
                                    <td>{{$status}}</td>
                                    <td>{{$row->sales_invoice_id}}</td>
                                    <td class="text-{{$type}}">{{$row->paid}} {{$sign}}</td>
                                    <td>
                                        
                                        <button type="submit" class="btn btn-danger waves-effect waves-light del" value="{{$row->id}}" ><i class="fa fa-close"></i> حذف</button>
                                    </td>
                                </tr>
                                @endforeach
                                
                                @foreach($amounts as $row)
                                <tr>
                                    <td>{{$row->added_date}}</td>
                                    <td>--</td>
                                    <td>{{$row->description}}</td>
                                    
                                    @if($row->receiver_id !=0)
                                    <td>تحويل صادر</td>
                                    <td>--</td>
                                    <td class="text-danger">{{$row->amount}} -</td>
                                    @elseif($row->receiver_id ==0)
                                    <td>اضافة</td>
                                    <td>--</td>
                                    <td class="text-success">{{$row->amount}} +</td>
                                    @endif
                                    <td>
                                        <button type="submit" class="btn btn-danger waves-effect waves-light del2" value="{{$row->id}}"><i class="fa fa-close"></i> حذف</button>
                                    </td>
                                </tr>
                                @endforeach
                                
                                <?php 
                                    $amounts2 = \DB::table('amounts')->where('receiver_id','=',$id)->get();
                                ?>
                                @if(count($amounts2) > 0)
                                @foreach($amounts2 as $row)
                                <tr>
                                    <td>{{$row->added_date}}</td>
                                    <td>--</td>
                                    <td></td>
                                    <td>تحويل مستلم</td>
                                    <td>--</td>
                                    <td class="text-success">{{$row->amount}} +</td>
                                    <td>
                                        <button type="submit" class="btn btn-danger waves-effect waves-light del2" value="{{$row->id}}" ><i class="fa fa-close"></i> حذف</button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif


                        </tbody>
                    </div>
                    
                    </table>    
                    @if(!count($paid) && !count($amounts) && !count($amounts2))
                        <style type="text/css">
                            tbody,
                            .pbody .dataTables_wrapper .row:last-of-type,
                            .pbody .dataTables_wrapper .row:first-of-type{
                                display: none;
                            }
                            .table-condensed tbody{
                                display: table-header-group;
                            }
                        </style>
                        <div id="overlayError">
                            <div class="row" style="margin-top: 20px;">
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
            </div>
        </div>
         
    </div>


@endsection

@section('page-scripts')
    
    <!-- Chart JS -->
        <script src="plugins/chart.js/chart.min.js"></script>
        <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <!--FooTable-->
		<script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <!--FooTable Example-->
        <script src="plugins/select2/js/select2.min.js"></script>

        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>

        <script>

$.fn.dataTable.ext.search.push(
    function( settings, aData, dataIndex ) {
        var min =  $('#start_date').val();
        var max =  $('#end_date').val();
        var iStartDateCol = 0;
        var iEndDateCol = 0;
 
        min=min.substring(6,10) + min.substring(3,5)+ min.substring(0,2);
        max=max.substring(6,10) + max.substring(3,5)+ max.substring(0,2);
 
        var datofini=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
        var datoffin=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);
 
        if ( min === "" && max === "" )
        {
            return true;
        }
        else if ( min <= datofini && max === "")
        {
            return true;
        }
        else if ( max >= datoffin && min === "")
        {
            return true;
        }
        else if (min <= datofini && max >= datoffin)
        {
            return true;
        }
        return false;
    }
);



var filtered = false;
var sum=0 ;
var length ;
!function($) {
    "use strict";

    $('.select2').select2();
    $('#convert #modal_amount').val($('.balance').text());
    $('#start_date,#end_date,#modal_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
    });
    $("body").delegate("#modal_date", "focusin", function(){
        $(this).datepicker();
    });

    $('.add').on('click',function(){
        $('#add_price').modal({ backdrop: 'static', keyboard: false });
        $('#add_price .btn-default').unbind('click');
        $('#add_price .btn-default').on('click',function(){
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'POST',
                    url:"{{route('finance.addAmount')}}",
                    data:{
                        '_token': $('input[name=_token]').val(),
                        'finance_id': $('#add_price #modal_id').val(),
                        'finance_type': $('#add_price #modal_type').val(),
                        'amount': $('#add_price #modal_amount').val(),
                        'date' : $('#add_price #modal_date').val()
                    },
                    success:function(data){
                        location.reload();                         
                    }
                });     
        });
    });

    $('.convert').on('click',function(){
        $('#convert').modal({ backdrop: 'static', keyboard: false });
        $('#convert .btn-default').unbind('click');
        $('#convert .btn-default').on('click',function(){
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'POST',
                    url:"{{route('finance.transform')}}",
                    data:{
                        '_token': $('input[name=_token]').val(),
                        'finance_type' : $('#convert #type').val(),
                        'finance_id' : $('#convert #modal_from').attr('value1'),
                        'added_date' : $('#convert #modal_date').val(),
                        'amount' : $('#convert #modal_amount').val(),
                        'description' : $('#convert #description').val(),
                        'receiver_id' : $('#convert .select2 option:selected').val()

                    },
                    success:function(data){
                        location.reload();                         
                    }
                });     
        });

        $('#convert .remove-account').unbind('click');
        $('#convert .remove-account').on('click',function(e){
			e.preventDefault();
            e.stopPropagation();
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'POST',
                    url:"{{route('finance.close')}}",
                    data:{
                        '_token': $('input[name=_token]').val(),
                        'finance_type' : $('#convert #type').val(),
                        'finance_id' : $('#convert #modal_from').attr('value1')
                    },
                    success:function(data){
                        window.location.href = "{{route('finance.main')}}";                         
                    }
                });     
        });
    });

    $('.del').on('click',function(){
        var id = $(this).val();
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
            type: 'POST',
            url:"{{route('finance.removeAmount')}}",
            data:{
                '_token': $('input[name=_token]').val(),
                'id': id
            },
            success:function(data){
                location.reload();                         
            }
        });     
    });
    
    $('.del2').on('click',function(){
        var id = $(this).val();
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
            type: 'POST',
            url:"{{route('finance.removeTrans')}}",
            data:{
                '_token': $('input[name=_token]').val(),
                'id': id
            },
            success:function(data){
                location.reload();                         
            }
        });     
    });


    var oTable = $('#demo-foo-filtering').DataTable({
        "order": [[ 0, "desc" ]]
    } );
    //var allData = oTable.column(5).data().reverse();
    //console.log(allData);
    //var dates = oTable.column(0).data().reverse();
    var labels=['January','February','March','April','May','June','July','August','Septemper','October','November','December'] ;
    var data = [];
    var total = [];
    var balance = <?php echo $balance; ?>;
    var open_balance = <?php echo $open_balance; ?>;
    var test =open_balance;
    data.unshift(open_balance);
    var start_date = "<?php echo $start_date; ?>";
    labels.unshift(start_date);
    total.unshift(open_balance);
    length = labels.length;
    <?php 
        for ( $i = 0; $i < 12; $i++) {?>
             total.push({{($post[$i]+$added[$i]+$received[$i])-($sent[$i]+$nega[$i])}});
        <?php }

    ?>
    //console.log(total);
    for (var i = 0; i < labels.length; i++) {
        if(i==0){

        }else{
            data[i] = data[i-1] + total[i];
        }
    }
    //console.log(data);
    $('#start_date, #end_date').change( function() {
        oTable.draw();
    } );

    $('#btnClearFilters').click(function () {
            $('#start_date,#end_date').val('');
            if (filtered){
                getData(null , $('.page-panel .panel-heading .panel-nav a.active').attr('link'));
                filtered = false;
            }
    });
    var ChartJs = function() {};

    $('#btnOkFilters').on('click', function() {
            filtered = true;
            var url = "{{Route('finance.filterAll')}}" +
                '/' + ($('#start_date').val() == '' ? '-1' :$('#start_date').val()) +
                '/' + ($('#end_date').val() == '' ? '-1' : $('#end_date').val())  ;
            var outerBox = '.page-panel';
            var Box = '.page-panel .BoxContent';
            var loaging = '<div id="overlayPagination" class="overlay overlay-x1"><i class="fa fa-spinner fa-pulse fa-fw" ></i></div>';
            $(outerBox + ' .btn').attr('disabled','disabled');
            $(Box + ' #overlayPagination').remove();
            $(Box).append(loaging);
            $.ajax({
                url : url
            }).done(function (data) {
                if($.isArray(data['errors'])) {
                    $.each(data['errors'], function (i, item) {
                        $.Notification.autoHideNotify('error', 'top right', 'Whoops', item);
                    });
                    $('.BoxContent #overlayPagination').remove();
                    $(outerBox + ' .btn').removeAttr('disabled','disabled');
                }else{
                    $(Box).html(data);
                    $('.CopyedPagination').html($('.NewPagination').html());
                    $('.BoxContent #overlayPagination').remove();
                    $(outerBox + ' .btn').removeAttr('disabled','disabled');
                }
            }).fail(function () {
                $('.BoxContent #overlayPagination').remove();
                $('.BoxContent #overlayError').remove();
                $(outerBox + ' .btn').removeAttr('disabled','disabled');
                var error = '<div id="overlayError" class="alert alert-danger" style="margin: 0"><h4>خطأ في الاتصال<i class="fa fa-exclamation fa-fw"></i></h4><p>حدث خطأ اثناء الاتصال قد يكون انقطاع في الاتصال . حاول مرة اخري</p></div>';
                $(Box).html(error);
            });
        });

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
             new Chart(ctx, {type: 'bar', data: data, options: options});

        };
        // run function - render chart at first load
        generateChart();
    },
    //init
    
    ChartJs.prototype.init = function() {
        //creating lineChart
        @if($type==1)
            <?php
                $finance = \DB::table('finance_banks')->where('id','=',$id)->get();
            ?>
            @foreach($finance as $row)
                <?php $name =$row->account_owner ;  ?>
            @endforeach  
        @elseif($type==2)
            <?php
                $finance = \DB::table('finance_treasury')->where('id','=',$id)->get();
            ?>
            @foreach($finance as $row)
                <?php $name = $row->treasury_name ; ?>
            @endforeach  
        @elseif($type==3)
            <?php
                $finance = \DB::table('finance_credit')->where('id','=',$id)->get();
            ?>
            @foreach($finance as $row)
                <?php $name =  $row->credit_owner;?>
            @endforeach  
        @endif   

        var lineChart = {
            labels: labels,
            datasets: [
                {
                    label: "<?php echo $name; ?>",
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
                    data: data
                }
            ]
        };
        var number = sum/length;
        var balance = <?php echo $balance; ?>;
        var max;
        var reading_balance = <?php echo $open_balance; ?>;
        if(balance == 0){
            max = reading_balance + reading_balance*.3; 
        }else{
            max = balance + balance * .3;
        }
        var rate = max *.15;
        var lineOpts = {
            scales: {
                yAxes: [{
                    ticks: {
                        max: Math.round(max/1000)*1000,
                        min: 0,
                        stepSize: Math.round(rate/1000)*1000
                    }
                }]
            }
        };

        this.respChart($("#lineChart"),'Bar',lineChart, lineOpts);

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


           /*$('body').on('click', '.page-panel .pagination a', function(ev) {
               ev.preventDefault();
//               var page_number = $(this).attr('href').split('page=')[1];
               getData(null,$(this).attr('href'));
           });*/

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
 
 

 