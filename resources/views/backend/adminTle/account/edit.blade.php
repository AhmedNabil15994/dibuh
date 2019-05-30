@extends(Config::get('back_theme').'.layouts.app')
@section('htmlheader_title')
{{ trans('backend/account.edit') }}
@endsection

@section('contentheader_title')
{{ trans('backend/account.edit') }}
@endsection

@section('contentheader_description')
{{ trans('backend/account.contentheader_description') }}
@endsection


@section('current_breadcrumb')
<!--breadcrumb current page-->
{{ trans('backend/account.edit') }}
@endsection 




@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">        
        <div class="box box-info">

            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('backend/account.edit') }}</h3>
            </div>

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
 
            {!! Form::model($data, ['method' => 'PATCH','route' => ['admin::account.update', $data->id]]) !!}
            <div class="box-body">    
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/account.parent_id')}} :</strong>
                        {!! Form::select('parent_id', 
                        ([0 =>  trans('master.select_item_from_list') ] + $parent), 
                        null, 
                        ['class' => 'form-control select2']) !!}           
                          
                    </div>
                </div>
              
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/account.account_code')}} :</strong>
     
                        {!! Form::text('account_code', null, array('placeholder' => trans('backend/account.account_code'),'class' => 'form-control' )) !!}                        
                        
                    </div>
                </div>  
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/account.is_major')}} :</strong>
                        {!! Form::select('is_major', 
                        (['' =>  trans('master.select_item_from_list') ] + $is_major), 
                        null, 
                        ['class' => 'form-control select2']) !!}                        
                    </div>
                </div>         
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/account.name')}} :</strong>
     
                        {!! Form::text('name', null, array('placeholder' => trans('backend/account.name'),'class' => 'form-control' )) !!}                        
                        
                    </div>
                </div>  
                
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/account.text')}} :</strong>
     
                        {!! Form::text('text', null, array('placeholder' => trans('backend/account.text'),'class' => 'form-control' )) !!}                        
                        
                    </div>
                </div>   
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/account.description')}} :</strong>
     
                        {!! Form::text('description', null, array('placeholder' => trans('backend/account.description'),'class' => 'form-control' )) !!}                        
                        
                    </div>
                </div>  
 
      
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/account.company_type')}} :</strong>
                        {!! Form::select('company_type_id', 
                        (['' =>  trans('master.select_item_from_list') ] + $company_type), 
                        null, 
                        ['class' => 'form-control select2']) !!}                        
                    </div>
                </div>   
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/account.category')}} :</strong>
                        {!! Form::select('category_id', 
                        (['' =>  trans('master.select_item_from_list') ] + $category), 
                        null, 
                        ['class' => 'form-control select2']) !!}                        
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/account.account_category')}} :</strong>
                        {!! Form::select('account_category_id', 
                        (['' =>  trans('master.select_item_from_list') ] + $account_category), 
                        null, 
                        ['class' => 'form-control select2']) !!}                        
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/account.account_type')}} :</strong>
                        {!! Form::select('account_type_id', 
                        (['' =>  trans('master.select_item_from_list') ] + $account_type), 
                        null, 
                        ['class' => 'form-control select2']) !!}                        
                    </div>
                </div>
                
                

                
              
 
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/account.is_common')}} :</strong>
                        {!! Form::select('is_common', 
                        (['' =>  trans('master.select_item_from_list') ] + $is_common), 
                        null, 
                        ['class' => 'form-control select2']) !!}                        
                    </div>
                </div>   
                
            </div>

            <div class="box-footer">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                   <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>   
                    <a class="btn btn-danger pull-right" href="{{ route('admin::account.index') }}"><i class="fa fa-home "></i>  {{ trans('button.cancel') }}</a>       
                </div>
            </div>         

            {!! Form::close() !!}

        </div>
    </div>
</div>    
@endsection



@section('page-styles')
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">  

   
@endsection

@section('page-scripts')
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>

    <!-- Page script -->
    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();



        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
            function (start, end) {
              $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        );

        //Date picker
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
          autoclose: true
        });        

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });


        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>    
@endsection

