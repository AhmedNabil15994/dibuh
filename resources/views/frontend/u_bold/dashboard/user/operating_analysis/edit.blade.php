@extends(Config::get('front_theme').'.layouts.default')

@section('title',$page_title)

@section('page-styles')
<link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="plugins/select2/css/select2.min.css">

<style>

    .page-panel{
        margin-top: 80px;
    }
    .select2-container .select2-selection--single{
        height: 33px !important;
        direction: rtl !important;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 32px !important;
        padding-left: 25px !important;
        padding-right: 5px !important;
        font-size: 14px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 3px;
        right: inherit;
        left: 5px;
    }
    .select2-container--open .select2-dropdown--above {
        padding: 0;
        direction: rtl;
    }
</style>

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

<div class="col-md-offset-1 col-md-10" style="margin-bottom: 100px">
    <div class="panel panel-default page-panel page-create">

        <div class="panel-body with-padding">
            <div class="row">
                <div class="col-xs-12 ">
                    <h3 class="pull-left label label-def" data-toggle="customer-row">    {{ trans('frontend/product.title')}}      </h3>
                </div>
            </div>
            <div class="row" id="customer-row">
                {!! Form::model($data, ['method' => 'PATCH','route' => ['product.update', $data->id]]) !!}     
                @include(Config::get('front_theme').'.dashboard.user.product.form')        
                <div class="col-md-12 col-xs-12">
                    <div class="form-group">

                    <!--<input type="submit" class="btn btn-primary" value="{{trans('button.save')}}">     -->
                        <button type="submit" class="btn w-sm btn-default waves-effect waves-light">{{trans('button.save')}}</button>
                        <a class="btn w-sm btn-white waves-effect" href="{{ route('product.index') }}"> {{trans('button.cancel')}}</a>           
                    </div>
                </div>                            
                {!! Form::close() !!}

            </div>



        </div>

    </div>
</div>








<!-- End Section Main Content -->	
@endsection



@section('page-scripts')
<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/select2/js/select2.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script>

jQuery(document).ready(function ($) {



    $("#product_type_id").select2({
        width: '100%',
        minimumResultsForSearch: -1
    });
    $("#unit_id").select2({
        width: '100%',
        minimumResultsForSearch: -1
    });
 

 

});





</script>


<script type="text/javascript">
//===== start get taxes  ===================

    $(function () {

        // Get IDs for Account (Categories and SubCategories)
        var account_id = $('#account_id').find('option:selected').val();
 

        // Categories[Tax Type] select
        $('#account_id').val(account_id).prop('selected', true);

        // Sync of SubCategories[Taxes]
        accountUpdate(account_id);
        // Categories[Tax Type]  change event
        $('#account_id').on('change', function (e) {
            var accountId = e.target.value;
            //tax_id = false;append( "<p>Test</p>" )
            $('#tax_id').empty();
            
              accountUpdate(accountId);
        });
        // Ajax Request for SubCategories[Taxes]
        function accountUpdate(account_id) {

            $.get('/api/tax-product?cat_id=' + account_id, function (data) {
                $('#tax_id').empty();
                $('#tax_id').append(data);
 
 
            });
        }
    });

    //================================================================================================
    
//===== start get taxes  ===================

//    $(function () {
//        // Get IDs for Tax Types and Taxes (Categories and SubCategories)
//        var tax_type_id = "{{ old('taxt_type_id', $data->tax_type_id) }}";
//        var tax_id = "{{ old('taxt_id', $data->tax_id) }}";
//
//        // Categories[Tax Type] select
//        $('#tax_type_id').val(tax_type_id).prop('selected', true);
//        // Sync of SubCategories[Taxes]
//        taxUpdate(tax_type_id);
//        // Categories[Tax Type]  change event
//        $('#tax_type_id').on('change', function (e) {
//            var taxTypeId = e.target.value;
//            //tax_id = false;
//
//            taxUpdate(taxTypeId);
//        });
//        // Ajax Request for SubCategories[Taxes]
//        function taxUpdate(tax_type_id) {
//
//            $.get('/api/tax-dropdown?cat_id=' + tax_type_id, function (data) {
//                $('#tax_id').empty();
//                $('#tax_id').append($('<option>', {
//                    value: "",
//                    text: "{{trans('master.select_item_from_list')}}"
//                }));
//                $.each(data, function (index, objTax) {
//                    $('#tax_id').append($('<option>', {
//                        value: objTax.id,
//                        text: objTax.name
//                    }));
//                });
//                if (tax_type_id) {
//                    $('#tax_id').val(tax_id).prop('selected', true);
//                }
//            });
//        }
//    });
    //================================================================================================

</script>    
</script>	
@endsection