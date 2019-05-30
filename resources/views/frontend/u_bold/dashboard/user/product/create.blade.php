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
    .tabs-vertical-env{
            direction: ltr !important;
        }
        .tabs-vertical-env .tab-content{
            display: inline-block;
            width: 73%;
            float: left;
            padding: 5px;
            margin-right: 1px;
            box-shadow: none;
            border:1px solid #eee;
        }
        .tabs-vertical-env .tab-content .row{
            padding: 0;
            margin: 0;
        }
        .tabs-vertical-env .tab-content .row.account_info{
            padding: 5px;
            border-bottom: 1px solid #EEE;
        }
        .tabs-vertical-env .tab-content .row.account_info:hover{
            cursor: pointer;
        }
        .tabs-vertical-env .tab-content .row.account_info:last-of-type{
            border-bottom: 0;
        }
        .tabs-vertical-env .tab-content .tab-pane{
            direction: rtl;
        }
        .tabs-vertical-env .nav.tabs-vertical{
            border-top: 1px solid #EEE !important;
            border-right: 2px solid #81c868 !important;
            display: inline-block;
            float: left;
            width: 25%;
        }
        .tabs-vertical-env .nav.tabs-vertical li{
            border-bottom: 1px solid #EEE;
        }
        .tabs-vertical-env .nav.tabs-vertical li a{
            line-height: unset;
            padding: 10px;
            text-align: right;
        }
        .name{
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 10px;
        }
        .code,.description{
            color: #999;
            font-size: 9px;
        }
        .description{
            margin-bottom: 0;
            margin-left: 15px;
        }
        .col-xs-12:first-of-type .select2-container .select2-selection--single .select2-selection__rendered{
            padding-right: 30px !important;
        }
        @media(min-width: 991px){
            #cat-modal .modal-dialog{
                width: 750px;
            }
        }
        @media(max-width: 540px){
            .name{
                width: 80%;
            }
            .tabs-vertical-env .tab-content{
                width: 53%;
            }
        }
/* select option:disabled {
   background: red !important;
   width: 500px !important;
   padding: 5px !important;
   }

select option.colr_disabled {
   background: greenyellow  !important;
   width: 500px !important;
   padding: 5px !important;
   }    
   
select option.colr {
   background: greenyellow;
   width: 500px;
   padding: 5px;
   }    
   
  option:disabled {
	color: #808080;
}   */
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
<div id="cat-modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">الحساب:</h4>
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
            <div class="modal-body">
  
                    <div class="tabs-vertical-env">
                        <div class="tab-content">

                             @foreach($category as $row)        
                            
                                <?php 
                                    $accountszx= \DB::table('accounts')->where('category_id' , '=', $row->id)->where('is_major','=',0)->orderBy('lineage','ASC')->get();  
                                ?>
                                @if(count($accountszx) > 0)     
                                    <div class="tab-pane fade" id="v2-{{$row->id}}">
                                    @foreach($accountszx as $item)
                                        <?php                                                                    
                                            $screen_id = \DB::table('accounts_to_screens')->where('account_id', '=' , $item->id)->where('screen_id' , '=' ,'13')->get();
                                            if(count($screen_id) > 0 ){

                                            ?>                                                           
                                       
                                                
                                         <div class="row account_info">
                                          <div class="row">
                                              <span class="pull-right code">{{$item->account_code}}</span>  
                                              <span class="pull-left name">{{$item->name}}</span>
                                              <input type="hidden" class="sel_acc_id" value="{{$item->id}}">
                                          </div>
                                          <p class="pull-left description">{{$item->description}}</p>
                                        </div>
                                        
                                        <?php }?>
                                    @endforeach 
                                    </div>
                                @endif

                                
                            @endforeach   
                            <div class="tab-pane fade" id="v2-uncategorized"> 
                                <?php 
                                    $accountszx= \DB::table('accounts')->where('category_id' , '=', 0)->where('is_major','=',0)->orderBy('lineage','ASC')->get();  
                                ?>
                                @if(count($accountszx) > 0)     
                                
                                    @foreach($accountszx as $item)
                                        <?php                                                                    
                                            $screen_id = \DB::table('accounts_to_screens')->where('account_id', '=' , $item->id)->where('screen_id' , '=' ,'13')->get();
                                            if(count($screen_id) > 0 ){

                                            ?>                                                           
                                        <div class="row account_info">
                                          <div class="row">
                                              <span class="pull-right code">{{$item->account_code}}</span>  
                                              <span class="pull-left name">{{$item->name}}</span>
                                              <input type="hidden" class="sel_acc_id" value="{{$item->id}}">
                                          </div>
                                          <p class="pull-left description">{{$item->description}}</p>
                                        </div>
                                        <?php }?>
                                    @endforeach 

                                @endif

                                </div> 
                            
                        </div>
                        <ul class="nav tabs-vertical">
                            @foreach($category as $row)   
                            <?php 
                                $accountszx= \DB::table('accounts')->where('category_id' , '=', $row->id)->where('is_major','=',0)->orderBy('lineage','ASC')->join('accounts_to_screens','accounts.id','=','accounts_to_screens.account_id')->where('accounts_to_screens.screen_id' , '=' ,13)->get();  
                            ?>
                            @if(count($accountszx) > 0)                       
                                <li class="nav-item">
                                    <a href="#v2-{{$row->id}}" data-toggle="tab" aria-expanded="true" class="nav-link active"><i class="fa fa-angle-left pull-right"></i>
                                        {{$row->name}}
                                    </a>
                                </li>       
                             @endif                   
                            @endforeach
                                <li class="nav-item">
                                    <a href="#v2-uncategorized" data-toggle="tab" aria-expanded="true" class="nav-link active"><i class="fa fa-angle-left pull-right"></i>
                                        غير مصنف
                                    </a>
                                </li>         
                        </ul>
                    </div>
                    <div class="clearfix"></div>
            </div>
            <div class="modal-footer" style="border-top: 0">
                <button type="button" class="btn btn-danger btn-close" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="col-md-offset-1 col-md-10" style="margin-bottom: 100px">
    <div class="panel panel-default page-panel page-create">

        <div class="panel-body with-padding">
            <div class="row">
                <div class="col-xs-12 ">
                    <h3 class="pull-left label label-def" data-toggle="customer-row">    {{ trans('frontend/product.title')}}      </h3>
                </div>
            </div>
            <div class="row" id="customer-row">
                {!! Form::open(array('route' => 'product.store','method'=>'POST')) !!}                
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
<script src="plugins/custombox/js/custombox.min.js"></script>
<script src="plugins/custombox/js/legacy.min.js"></script>
<!-- ladda js -->
<script src="plugins/ladda-buttons/js/spin.min.js"></script>
<script src="plugins/ladda-buttons/js/ladda.min.js"></script>
<script src="plugins/ladda-buttons/js/ladda.jquery.min.js"></script>
<!-- Notification js -->
<script src="plugins/notifyjs/js/notify.js"></script>
<script src="plugins/notifications/notify-metro.js"></script>

<!-- Modal-Effect -->
<script src="plugins/custombox/js/custombox.min.js"></script>
<script src="plugins/custombox/js/legacy.min.js"></script>


<!-- PrintArea -->
<script src="plugins/PrintArea/jquery.PrintArea.js"></script>
<script>
    var index ;
jQuery(document).ready(function ($) {
    $('#product_type_id').val(1);
    $('#unit_id').val(1);
    $('.select2').select2();

    $('.tab-pane:first-of-type').addClass('active');
    $('.tab-pane:first-of-type').removeClass('fade');
        
    $(document).on('click','.choose',function(e){
        e.preventDefault();
        $('#cat-modal').modal({ backdrop: 'static', keyboard: false });
        index = $(this).attr('value1');
    });
    function accountUpdate(account_id) {
            var url = "{{route('Api.getTaxProductData' , 'cat_id=:data')}}"
            url  = url.replace(':data', account_id)
            //console.log(url)
            $.get(url, function (data) {
                $('#tax_id').empty();
                $('#tax_id').append(data);
            });
    }
    $(document).on('click','.account_info',function(){
        var id = $(this).children('.row').children('.sel_acc_id').val();
        var code = $(this).children('.row').children('.code').text();
        var name = $(this).children('.row').children('.name').text();
        $('#account_id'+index).attr('value2',id);
        $('#account_id'+index).val(name);
        $('#account_id'+index).append("<option value='"+id+"' selected style='padding-right:25px;'>"+code+" -- "+name+"</option>")
        $('.checkID'+index).val(id);
        $('#cat-modal').modal('toggle');
        getInfo('#account_id'+index);
    });
    var optsss = {
            language: {
                inputTooShort: function(args) {
                    // args.minimum is the minimum required length
                    // args.input is the user-typed text
                    return "ادخل عدد " + args.minimum + " أحرف على الاقل";
                },
                inputTooLong: function(args) {
                    // args.maximum is the maximum allowed length
                    // args.input is the user-typed text
                    return "You typed too much";
                },
                errorLoading: function() {
                    return "خطأ في تحميل مزيد من النتائج";
                },
                loadingMore: function() {
                    return "تحميل مزيد من النتائج";
                },
                noResults: function() {
                    return "لا يوجد نتائج";    
               },
                searching: function() {
                    return "جاري البحث ...";
                },
                maximumSelected: function(args) {
                    // args.maximum is the maximum number of items the user may select
                    return "خطأ في التحميل";
                }
            }
        };

    $('.account_id').select2({
            language:optsss.language,
            tags: false,
            dir: "rtl",
            multiple: false,
            tokenSeparators: [',', ''],
            minimumInputLength: 1,
            minimumResultsForSearch: 10,
            ajax: {
                url: "{{route('product.get_account_json') }}" ,
                dataType: "json",
                type: "GET",
                data: function (params) {

                    var queryParameters = {
                        text: params.term
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.account_code +" -- "+item.name ,
                                id: item.id
                            }
                        })
                    };

                }

            }
    });

    $('.account_id').on('change',function(){
            var row = $(this).attr('value1');
            $('.checkID'+row).val($(this).val());
            getInfo('#account_id'+row);
    });

     function getInfo(element){
        var id = $(element).val();
        var number = $(element).attr('value1');
        //getTaxFields( id,number);
        accountUpdate(id);
        $('input[name="acc_id"]').val(id);        
    }


    /*$("#product_type_id").select2({
        width: '100%',
        minimumResultsForSearch: -1
    });
    $("#unit_id").select2({
        width: '100%',
        minimumResultsForSearch: -1
    });
    
    $(".select2").select2({
        width: '100%',
        minimumResultsForSearch: -1
    });*/
    
//    $("#tax_type_id").select2({
//        width: '100%',
//        minimumResultsForSearch: -1
//    });

//    $("#tax_id").select2({
//        width: '100%',
//        minimumResultsForSearch: -1
//    });

});





</script>


<script type="text/javascript">

//===== start get taxes  ===================

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
            var url = "{{route('Api.getTaxProductData' , 'cat_id=:data')}}"
            url  = url.replace(':data', account_id)
            //console.log(url)
            $.get(url, function (data) {
                $('#tax_id').empty();
                $('#tax_id').append(data);
            });
        }
    });

//================================================================================================
    

//===== start get taxes  ===================

//    $(function () {
//
//        // Get IDs for Tax Types and Taxes (Categories and SubCategories)
//        var tax_type_id = $('#tax_type_id').find('option:selected').val();
//        var tax_id = $('#tax_id').find('option:selected').val();
//
//        // Categories[Tax Type] select
//        $('#tax_type_id').val(tax_type_id).prop('selected', true);
//
//        // Sync of SubCategories[Taxes]
//        taxUpdate(tax_type_id);
//        // Categories[Tax Type]  change event
//        $('#tax_type_id').on('change', function (e) {
//            var taxTypeId = e.target.value;
//            //tax_id = false;
//            $('#tax_id').append($('<option>', {
//                value: "",
//                text: "{{trans('master.select_item_from_list')}}"
//            }));
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
//                $('#tax_id').find('option:selected').val();
//                if (tax_type_id) {
//                    $('#tax_id').val(tax_id).prop('selected', true);
//                }
//            });
//        }
//    });

    //================================================================================================
</script>	
@endsection