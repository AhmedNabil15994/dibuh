@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/user.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/language.files') }} =>
{{$lang_name}}
@endsection

@section('contentheader_description')


@endsection


<!--breadcrumb current page-->
@section('previous_breadcrumb')
{{ trans('backend/user.list') }}
@endsection

@section('current_breadcrumb')
{{ trans('backend/language.files') }}
@endsection

@section('content')
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- Notification js -->


@if ($message = Session::get('success'))
<div  class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div  class="alert alert-success" hidden>
    <p class="message"></p>
</div>







<div class="col-sm-9 user-details">
  <a class="btn btn-primary" href="{{ route('admin::language.files',$id) }}"> {{ trans('backend/language.public') }}</a>
  <a class="btn btn-primary" href=" {{route('admin::language.files_front',$id) }}"> {{ trans('backend/language.frontend') }}</a>
  <a class="btn btn-primary" href=" {{route('admin::language.files_back',$id) }}"> {{ trans('backend/language.backend') }}</a>

	<ul class="nav nav-tabs" style="width:850;">
	  <li class="active"><a data-toggle="tab" data-target="#home">{{ trans('frontend/account.title') }}</a></li>
	  <li><a data-toggle="tab" href="#menuContact" style="padding-left:10px; padding-right:10px;">{{ trans('frontend/contact.title') }}</a></li>
	  <li><a data-toggle="tab" href="#menuCost" style="padding-left:10px; padding-right:10px;">{{ trans('frontend/cost.title') }}</a></li>
    <li><a data-toggle="tab" href="#menuDashboard" style="padding-left:10px; padding-right:10px;">{{ trans('frontend/dashboard.title') }}</a></li>
    <li><a data-toggle="tab" href="#menuExpense" style="padding-left:10px; padding-right:10px;">{{ trans('frontend/expense.title') }}</a></li>
    <li><a data-toggle="tab" href="#menuFinance" style="padding-left:10px; padding-right:10px;">{{ trans('frontend/finance.title') }}</a></li>
    <li><a data-toggle="tab" href="#menuProduct" style="padding-left:10px; padding-right:10px;">{{ trans('frontend/product.title') }}</a></li>
    <li><a data-toggle="tab" href="#menuReports" style="padding-left:10px; padding-right:10px;">{{ trans('frontend/reports.title') }}</a></li>
    <li><a data-toggle="tab" href="#menuSales_invoice" style="padding-left:10px; padding-right:10px;">{{ trans('frontend/sales_invoice.title') }}</a></li>
    <li><a data-toggle="tab" href="#menuUser" style="padding-left:10px; padding-right:10px;">{{ trans('frontend/user.title') }}</a></li>



	</ul>

	<div class="tab-content">

    <div id="home"  class="tab-pane active in">
      <?php
         /**pagination**/



       ?>
  {!! Form::open(['route'=>['admin::language.save_file',$id,'frontend','account.php']]) !!}
            <div class="row" style="padding: 0;margin: 0;">
                <div class="col-xs-12 col-sm-12 col-md-12" style="width:850;">
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('frontend/account.title')}}</h3>
                        </div>
                        <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example1" style="width: 99%;border: 1px solid #DDD;">
                          <thead>
                            <th>key</th>
                            <th>content</th>
                          </thead>
                          <tbody>
                        <!-- <div class="box-body"> -->
                          @foreach($content_account as $key=>$item)
                              <tr>
                              <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                                  <div class="form-group">
                                    <div class="col-sm-3"> -->
                                       <td style="width:200px;"=>  <strong>{{$key}}:</strong></td>
                                      <!-- </div> -->
                                       <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                                  <!-- </div>
                              </div> -->
                            </tr>
                          @endforeach
                            </tbody>

                        </div>
                      </table>

                        <div class="box-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                    <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            {!! Form::close() !!}



  </div>
      <div id="menuContact" class="tab-pane fade">
        {!! Form::open(['route'=>['admin::language.save_file',$id,'fontend','contact.php']]) !!}
                  <div class="row" style="padding: 0;margin: 0;">
                      <div class="col-xs-12 col-sm-12 col-md-12" style="width:850;">
                          <div class="box box-solid">

                              <div class="box-header with-border">
                                  <h3 class="box-title">{{ trans('frontend/contact.title')}}</h3>
                              </div>
                              <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example2" style="width: 99%;border: 1px solid #DDD;">
                                <thead>
                                  <th>key</th>
                                  <th>content</th>
                                </thead>
                                <tbody>
                              <!-- <div class="box-body"> -->
                                @foreach($content_contact as $key=>$item)
                                    <tr>
                                             <td>  <strong>{{$key}}:</strong></td>
                                             <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                                  </tr>
                                @endforeach
                                  </tbody>

                              </div>
                            </table>

                              <div class="box-footer">
                                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                          <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                                  </div>

                              </div>

                          </div>

                      </div>
                  </div>
                  {!! Form::close() !!}


    </div>
    <div id="menuCost" class="tab-pane fade">
      {!! Form::open(['route'=>['admin::language.save_file',$id,'frontend','cost.php']]) !!}
                <div class="row" style="padding: 0;margin: 0;">
                    <div class="col-xs-12 col-sm-12 col-md-12" style="width:850;">
                        <div class="box box-solid">

                            <div class="box-header with-border">
                                <h3 class="box-title">{{ trans('frontend/cost.title')}}</h3>
                            </div>
                            <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example3" style="width: 99%;border: 1px solid #DDD;">
                              <thead>
                                <th>key</th>
                                <th>content</th>
                              </thead>
                              <tbody>
                            <!-- <div class="box-body"> -->
                              @foreach($content_cost as $key=>$item)
                                  <tr>
                                           <td>  <strong>{{$key}}:</strong></td>
                                           <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                                </tr>
                              @endforeach
                                </tbody>

                            </div>
                          </table>

                            <div class="box-footer">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                        <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                {!! Form::close() !!}
                {!! $content_cost->appends(Input::except('page'))->render() !!}

  </div>
  <div id="menuDashboard" class="tab-pane fade">
    {!! Form::open(['route'=>['admin::language.save_file',$id,'frontend','dashboard.php']]) !!}
              <div class="row" style="padding: 0;margin: 0;">
                  <div class="col-xs-12 col-sm-12 col-md-12" style="width:850;">
                      <div class="box box-solid">

                          <div class="box-header with-border">
                              <h3 class="box-title">{{ trans('frontend/dashboard.title')}}</h3>
                          </div>
                          <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example4" style="width: 99%;border: 1px solid #DDD;">
                            <thead>
                              <th>key</th>
                              <th>content</th>
                            </thead>
                            <tbody>
                          <!-- <div class="box-body"> -->
                            @foreach($content_dashboard as $key=>$item)
                                <tr>
                                         <td>  <strong>{{$key}}:</strong></td>
                                         <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                              </tr>
                            @endforeach
                              </tbody>

                          </div>
                        </table>

                          <div class="box-footer">
                              <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                      <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                              </div>

                          </div>

                      </div>

                  </div>
              </div>
              {!! Form::close() !!}


</div>

<div id="menuExpense" class="tab-pane fade">
  {!! Form::open(['route'=>['admin::language.save_file',$id,'frontend','expense.php']]) !!}
            <div class="row" style="padding: 0;margin: 0;">
                <div class="col-xs-12 col-sm-12 col-md-12" style="width:850;">
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('frontend/expense.title')}}</h3>
                        </div>
                        <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example5" style="width: 99%;border: 1px solid #DDD;">
                          <thead>
                            <th>key</th>
                            <th>content</th>
                          </thead>
                          <tbody>
                        <!-- <div class="box-body"> -->
                          @foreach($content_expense as $key=>$item)
                              <tr>
                                       <td>  <strong>{{$key}}:</strong></td>
                                       <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                            </tr>
                          @endforeach
                            </tbody>

                        </div>
                      </table>

                        <div class="box-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                    <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            {!! Form::close() !!}
            {!! $content_expense->appends(Input::except('page'))->render() !!}

</div>

<div id="menuFinance" class="tab-pane fade">
  {!! Form::open(['route'=>['admin::language.save_file',$id,'frontend','finance.php']]) !!}
            <div class="row" style="padding: 0;margin: 0;">
                <div class="col-xs-12 col-sm-12 col-md-12" style="width:850;">
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('frontend/finance.title')}}</h3>
                        </div>
                        <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example6" style="width: 99%;border: 1px solid #DDD;">
                          <thead>
                            <th>key</th>
                            <th>content</th>
                          </thead>
                          <tbody>
                        <!-- <div class="box-body"> -->
                          @foreach($content_finance as $key=>$item)
                              <tr>
                                       <td>  <strong>{{$key}}:</strong></td>
                                       <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                            </tr>
                          @endforeach
                            </tbody>

                        </div>
                      </table>

                        <div class="box-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                    <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            {!! Form::close() !!}


</div>
<div id="menuProduct" class="tab-pane fade">
  {!! Form::open(['route'=>['admin::language.save_file',$id,'frontend','product.php']]) !!}
            <div class="row" style="padding: 0;margin: 0;">
                <div class="col-xs-12 col-sm-12 col-md-12" style="width:850;">
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('frontend/product.title')}}</h3>
                        </div>
                        <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example7" style="width: 99%;border: 1px solid #DDD;">
                          <thead>
                            <th>key</th>
                            <th>content</th>
                          </thead>
                          <tbody>
                        <!-- <div class="box-body"> -->
                          @foreach($content_product as $key=>$item)
                              <tr>
                                       <td>  <strong>{{$key}}:</strong></td>
                                       <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                            </tr>
                          @endforeach
                            </tbody>

                        </div>
                      </table>

                        <div class="box-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                    <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            {!! Form::close() !!}
            {!! $content_product->appends(Input::except('page'))->render() !!}

</div>
<div id="menuReports" class="tab-pane fade">
  {!! Form::open(['route'=>['admin::language.save_file',$id,'frontend','reports.php']]) !!}
            <div class="row" style="padding: 0;margin: 0;">
                <div class="col-xs-12 col-sm-12 col-md-12" style="width:850;">
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('frontend/reports.title')}}</h3>
                        </div>
                        <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example8" style="width: 99%;border: 1px solid #DDD;">
                          <thead>
                            <th>key</th>
                            <th>content</th>
                          </thead>
                          <tbody>
                        <!-- <div class="box-body"> -->
                          @foreach($content_reports as $key=>$item)
                              <tr>
                                       <td>  <strong>{{$key}}:</strong></td>
                                       <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                            </tr>
                          @endforeach
                            </tbody>

                        </div>
                      </table>

                        <div class="box-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                    <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            {!! Form::close() !!}


</div>
<div id="menuSales_invoice" class="tab-pane fade">
  {!! Form::open(['route'=>['admin::language.save_file',$id,'frontend','sales_invoice.php']]) !!}
            <div class="row" style="padding: 0;margin: 0;">
                <div class="col-xs-12 col-sm-12 col-md-12" style="width:850;">
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('frontend/sales_invoice.title')}}</h3>
                        </div>
                        <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example9" style="width: 99%;border: 1px solid #DDD;">
                          <thead>
                            <th>key</th>
                            <th>content</th>
                          </thead>
                          <tbody>
                        <!-- <div class="box-body"> -->
                          @foreach($content_sales_invoice as $key=>$item)
                              <tr>
                                       <td>  <strong>{{$key}}:</strong></td>
                                       <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                            </tr>
                          @endforeach
                            </tbody>

                        </div>
                      </table>

                        <div class="box-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                    <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            {!! Form::close() !!}


</div>
<div id="menuUser" class="tab-pane fade">
  {!! Form::open(['route'=>['admin::language.save_file',$id,'frontend','user.php']]) !!}
            <div class="row" style="padding: 0;margin: 0;">
                <div class="col-xs-12 col-sm-12 col-md-12" style="width:850;">
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('frontend/user.title')}}</h3>
                        </div>
                        <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example10" style="width: 99%;border: 1px solid #DDD;">
                          <thead>
                            <th>key</th>
                            <th>content</th>
                          </thead>
                          <tbody>
                        <!-- <div class="box-body"> -->
                          @foreach($content_user as $key=>$item)
                              <tr>
                                       <td>  <strong>{{$key}}:</strong></td>
                                       <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                            </tr>
                          @endforeach
                            </tbody>

                        </div>
                      </table>

                        <div class="box-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                    <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            {!! Form::close() !!}
            {!! $content_account->appends(Input::except('page'))->render() !!}

</div>







</div>
</div>
@endsection

@section('page-styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">
<style type="text/css">
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
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        color: #666;
    }
    .user-info>div{
    	background-color: #EEE;
    	padding: 10px;
    	border-radius: 5px;
    	border-top: 4px solid #3C8DBC;
    	margin-bottom: 20px;
    }
    .user-info .row {
    	padding: 0;
    	margin: 0;
    	border-top: 1px dashed #777;
    }
    .user-info .row span{
    	padding: 10px 0;
    	display: inline-block;
    }
    .user-info .row span:first-of-type{
    	font-weight: bold;
    	width: 78px;
    }
    .user-info .row span:nth-of-type(2){
    	color:#044e22;
    	float: right;
    }
    .user-info .row:last-of-type{
    	border-bottom: 1px dashed #777;
    	margin-bottom: 15px;
    }
    .roles{
    	padding-top: 5px !important;
    }
    .roles h4{
    	border-bottom: 1px dashed #777;
    	padding-bottom: 5px;
    }
    .roles .row{
    	border: 0 !important;
    	margin-bottom: 0 !important;
    }
    .roles .row span{
    	padding: 3px;
    	display: inline-block;
    	float: left;
    	margin-bottom: 5px;
    }
    .content-wrapper, .right-side , .wrapper{
        background-color: #FFF !important;
    }
    .label{
        background-color: #358eda;
        padding: 5px;
        margin-bottom: 10px;
        display: inline-block;
    }
  	.content{
  		min-height: 670px;
  	}
    .row{
        padding-right: 50px;
        margin-bottom: 20px;
    }
    button i{
        font-size: 13px;
        margin-right: 5px;
    }
    .table{
        color: #495060;
    }
    .table thead tr > th{
        text-align: center;
        padding: 12px 5px;
    }
    .table tbody tr > td{
        text-align: center;
        padding: 10px 7px;
        font-size: 14px;
    }
    .table tbody tr:hover{
        cursor: pointer;
        -webkit-transition: all ease-in-out .3s;
        -moz-transition: all ease-in-out .3s;
        -o-transition: all ease-in-out .3s;
        transition: all ease-in-out .3s;
        background-color: #EBF7FF;
    }
    .table tbody .tab-row.active,.table tbody tr:active{
        background-color: #DDD;
    }
    .btn-warning{
        background-color: #FFAD33;
        padding: 6px 5px;
        padding-left: 10px;
        display: inline-block;
        font-size: 12px;
    }
    .btn-warning:hover{
        opacity: .8;
    }
    .tax-delete{
        padding: 0;
        font-size: 12px;
        padding: 2px 7px;
        background-color: #ed3f14;
    }
    .taxs .text{
        border: 1px solid #e9eaec;
        background-color: #f7f7f7;
        padding: 5px;
        display: block;
        width: fit-content;
        margin: auto;
        margin-bottom: 10px;
    }
    .taxs .rate{
        min-width: 40px;
    }
    th.edit{
        position: relative;
    }
    th.edit div{
        position: absolute;
        top: 0;
        left: 0;
        padding: 5px 15px;
        display: block;
        width: 100%;
        text-align: center;
    }
    td .btn{
        margin-bottom: 5px;
    }
    .tab-pane{
        padding: 15px;
        border: 1px solid #DDD;
        border-top: 0;
    }
    .select2,.form-control{
        width: 50% !important;
        display: inline-block;
    }
</style>
@endsection

@section('page-scripts')

@include(Config::get('back_theme').'.layouts.modals.comfirm_delete')

<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript">
    $(function(){
      // $("#example2").DataTable({
      //   "pageLength":7
      // });
      $('#example1,#example2,#example3,#example4,#example5,#example6,#example7,#example8,#example9,#example10').DataTable({
        "pageLength": 7
      });


/***********************************************************************************************************/
        $(".select2").select2();

        var selected=[];
            $('#home .test').each(function(){
                selected.push($(this).val());
            });

            option = document.getElementById("roles").options;
            for (var i = selected.length - 1; i >= 0; i--) {
                var sel = i-1;
                option[selected[i] - 1].setAttribute('selected', 'selected');
            }

        $("input[type=checkbox]").iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_minimal-blue'
        });

        function close(){
            $('.modal input').val('');
            $('select').prop('selectedIndex',-1);
            $('.modal .alert').addClass('hidden');
            $('input[type=checkbox]').each(function(){
                    $(this).iCheck('uncheck');
            });
        }
        $('.modal .btn-danger , .modal .close').on('click',function(){
                close();
           });
        var activate = $('#menu1 input[name="activate"]').val();
        $('#menu1 .select2').val(activate).trigger('change');

        $("#home .roles").select2({
            placeholder: "Select Roles"
        });

        $("#menu1 .select2").select2({
            placeholder: "Select Status"
        });

        $('.breadcrumb .prev').toggle();
        $('.breadcrumb .prev a').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = "{{URL::to('backend/users_view')}}";
        });
/***********************************************Account Details**************************************************/



    });
</script>

@endsection
