@extends(Config::get('back_theme').'.layouts.app')
@section('htmlheader_title')
{{ trans('backend/category.create_new') }}
@endsection

@section('contentheader_title')
{{ trans('backend/category.create_new') }}
@endsection

@section('contentheader_description')
{{ trans('backend/category.contentheader_description') }}
@endsection


@section('current_breadcrumb')
<!--breadcrumb current page-->
{{ trans('backend/category.create_new') }}
@endsection 




@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">        
        <div class="box box-info">

            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('backend/category.create_new') }}</h3>
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
            {!! Form::open(array('route' => 'admin::category.store','method'=>'POST')) !!}
            <div class="box-body">    
<!--                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/category.code')}} :</strong>
     
                        {!! Form::text('code', null, array('placeholder' => trans('backend/category.code'),'class' => 'form-control' )) !!}                        
                        
                    </div>
                </div>  -->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/category.name')}} :</strong>
     
                        {!! Form::text('name', null, array('placeholder' => trans('backend/category.name'),'class' => 'form-control' )) !!}                        
                        
                    </div>
                </div>  
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/category.description')}} :</strong>
     
                        {!! Form::text('description', null, array('placeholder' => trans('backend/category.description'),'class' => 'form-control' )) !!}                        
                        
                    </div>
                </div>                  
 
  
                
            </div>

            <div class="box-footer">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-success pull-left"><i class="fa fa-save"></i> {{ trans('button.create') }}</button>      
                    <a class="btn btn-danger pull-right" href="{{ route('admin::category.index') }}"><i class="fa fa-home "></i>  {{ trans('button.cancel') }}</a>       
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

