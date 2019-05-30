@extends(Config::get('front_theme').'.layouts.default')

@section('title',$page_title)

@section('page-styles')
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/select2/css/select2.min.css">
    <!-- Custom box scc -->
        <link href="plugins/custombox/css/custombox.css" rel="stylesheet">
    <style>

        .form-page-create{
            margin-top: 90px;
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
    @include(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.inc.subnav')
@endsection

@section('content')


    <form class="form-page-create" role="form" method="POST" action="{{ route('sales_invoice.store') }}">
        {{ csrf_field() }}

        <div class="col-md-offset-1 col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-toolbar form-group m-b-0">
                        <div class="pull-right">
                            <button  name="submit"  value="save" type="submit" class="btn btn-success waves-effect waves-light m-r-5 "><i class="fa fa-floppy-o"></i></button>
                            <a href="{{ route('sales_invoice.index') }}" class="btn btn-success waves-effect waves-light m-r-5"><i class="fa fa-trash-o"></i></a>

                            <a href="#invoice_modal"  class="btn btn-default waves-effect waves-light m-r-20" data-toggle="modal" data-target="#invoice_modal"><span>ارسال</span> <i class="fa fa-send m-l-10"></i>  </a>
                        </div>
                        <div class="pull-left">
                            <a href="javascript:void(0)" class="btn btn-default waves-effect waves-light AllToggle"> <i class="fa fa-bars"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        <div class="panel panel-default page-panel page-create">
            {{--<div class="panel-heading no-border no-padding-v">--}}

            {{--</div>--}}
            <div class="panel-body with-padding">
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
                <div class="row">
                    <div class="col-xs-12 ">
                        <h3 class="pull-left label label-def" data-toggle="customer-row">معلومات عن الفاتوره والعميل</h3>
                    </div>
                </div>
                <div class="row" id="customer-row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label for="contact_id" class="control-label">العميل :</label>{{-- trans('frontend/sales_invoice.contact_id')--}}
                            <select class="form-control" name="contact_id" id="contact_id">

                            </select>
                            {{--<input class="form-control" type="text" name="filterCustomer" id="filterCustomer" value="" >--}}
                            {{--<span class="fa fa-user fa-fw form-control-feedback"></span>--}}
                        </div>

                        <div class="form-group has-feedback ">
                            <label for="address" class="control-label">العنوان :</label>{{-- trans('frontend/sales_invoice.address')--}}
                            <span
                                    style="cursor: pointer;color: #337ab7;"
                                    class="pull-right hidden"
                                    type="button"
                                    id="get_address"
                                    data-load-url=""
                                    data-contact-id=""
                                    data-toggle="modal"
                                    data-target="#addressModal"
                                    onclick="getAddress();"
                            >إختر عنوان
                            </span>
                            <textarea rows="8" class="form-control" type="text" name="address" id="address" style="height: 103px;"> </textarea>
                        </div>

                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback ">
                                    <label for="invoice_number" class="control-label">رقم الفاتوره :</label>
                                    <input class="form-control" type="text" name="invoice_number" id="invoice_number" value="{{$invoice_number}}" placeholder="{{ trans('frontend/sales_invoice.invoice_number')}}">
                                    <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback ">
                                    <label for="invoice_date" class="control-label">تاريخ الفاتوره :</label>{{-- trans('frontend/sales_invoice.invoice_date')--}}
                                    <input class="form-control" type="text" name="invoice_date" id="invoice_date" placeholder="mm/dd/yyyy" value="" >
                                    <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback ">
                                    <label for="due_date" class="control-label">  {{  trans('frontend/sales_invoice.due_date') }} :</label>
                                    <input class="form-control" type="text" name="due_date" id="payment_day" placeholder="yyyy-dd-mm" value="" >
                                    <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback ">
                                    <label for="delivery_date" class="control-label">تاريخ الاستلام :</label>{{-- trans('frontend/sales_invoice.delivery_date')--}}
                                    <input class="form-control" type="text" name="delivery_date" id="delivery_date" placeholder="yyyy-dd-mm" value="" >
                                    <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback ">
                                    <label for="reference_number" class="control-label">رقم المرجع :</label>{{--trans('frontend/sales_invoice.reference_number')--}}
                                    <input class="form-control" type="text" name="reference_number" id="reference_number" placeholder="" value="" >
                                    <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">

                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-xs-12 ">
                        <h3 class="pull-left label label-def"  data-toggle="header-row">محتوي رأس الفاتوره</h3>
                    </div>
                </div>
                <div class="row" id="header-row">
                    <div class="col-md-12 col-xs-12" style="margin-bottom: 15px">
                        <textarea id="header_text" name="header_text"></textarea>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-xs-12 ">
                        <h3 class="pull-left label label-def" data-toggle="product-row">المنتجات</h3>
                    </div>
                </div>
                <div class="row" id="product-row">
                    <div class="col-md-12 col-xs-12" style="margin-bottom: 15px">
                        <table class="form-table" id="customFields">
                            <thead>
                                <td style='width:1% ;'>#</td>
                                <td style='width:20% ;'>المنتج</td>
                                <td style='width:19% ;'>الحسابات</td>
                                <td style='width:5% ;'>الكميه</td>
                                <td style='width:10% ;'>الوحده</td>
                                <td style='width:10% ;'>السعر</td>


                                <td style='width:7% ;'>الخصم(%)</td>
                                <td style='width:10% ;'> بعد الخصم</td>      
                                <td style='width:7% ;'>الضريبه(%)</td>                                
                                <td style='width:10% ;'>الاجمالي</td>
                                <td style='width: 1% ;'></td>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td>
                                        <span>1</span>
                                    </td>
                                    <td >
                                        <div class="col-md-12" style="padding: 0;">
                                            <select class='product_id  form-control' name='details[1][product_id]' id='product_id1' onchange='getProductDetails(1)'>
                                            

                                            </select>
                                          
                                        </div>
                                    </td>
                                     
                                    <td id='td_account_1'>
                                        <div class='col-md-12' style='padding: 0;'>                                            
                                            <input class='form-control account_id' type='text' name='details[1][account_id]' id='account_id1' value=''  placeholder='{{trans('frontend/sales_invoice.account')}}'>                                        
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group has-feedback ">
                                            <input class="form-control quantity" type="text" name="details[1][quantity]" id="quantity_1" value="1" onkeyup="changeDetails(1)" placeholder="{{trans('frontend/sales_invoice.quantity')}}">
                                        </div>
                                        
    {{--                                    {!! Form::text('', 0, array('placeholder' => ,'id'=>'quantity_1','class' => 'form-control ' ,'onchange'=>'calculateSum(1);')) !!}--}}
                                    </td>
                                    <td>
 
                                        
                                        <div class="form-group has-feedback ">
                                            <select class="form-control units" name="details[1][unit_id]" id='unit_id_1'>
                                                @foreach($unit as $id => $name)
                                                    <option value="{{$id}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>                                        
                                        {{--<div class="form-group">--}}
                                            {{--{!! Form::select('details[1][unit_id]',--}}
                                            {{--(['' =>  trans('master.select_item_from_list') ] + $unit),--}}
                                            {{--null,--}}
                                            {{--['class' => 'form-control select2']) !!}--}}
                                        {{--</div>--}}
                                    </td>

                                    
                                    <td >
                                        <div class="form-group has-feedback ">
                                            <input class="form-control new_price" type="text" name="details[1][price]" id="price_1" value="" placeholder="{{trans('frontend/sales_invoice.price')}}"  onkeyup="changeDetails(1)" >
                                        </div>
    {{--                                    {!! Form::text('details[1][price]', 0, array('placeholder' => trans('frontend/sales_invoice.price'),'id'=>'price_1','class' => 'form-control' ,'onchange'=>'calculateSum(1);' )) !!}--}}
                                    </td>
                                    <td>
                                        <div class="form-group has-feedback ">
                                            <input class="form-control discount_txt" type="text" name="details[1][discount]" id="discount_1" value="0.00" placeholder="{{trans('frontend/sales_invoice.discount')}}" onkeyup="changeDetails(1)" >
                                        </div>
    {{--                                    {!! Form::text('details[1][discount]', 0, array('placeholder' => trans('frontend/sales_invoice.discount'),'id'=>'discount_1','class' => 'discount_txt form-control' ,'onchange'=>'calculateSum(1);')) !!}--}}
                                    </td>


                                      
                                        {{--{!! Form::text('details[1][tax]', 0, array('placeholder' => trans('frontend/sales_invoice.tax'),'id'=>'tax_1','class' => 'tax_txt form-control' ,'onchange'=>'calculateSum(1);')) !!}--}}
                                        {{--{!! Form::hidden('details[1][row_tax]', 0, array('placeholder' => trans('frontend/sales_invoice.tax'),'id'=>'row_tax_1','class' => 'row_tax_txt form-control' ,'onchange'=>'calculateSum(1);')) !!}--}}
                                    </td>

                                    <td>
                                        <div class="form-group has-feedback ">
                                            <input class='form-control row_price_txt' type='hidden' name='details[1][row_price]" id="row_price_1' value='0.00' placeholder='{{trans('frontend/sales_invoice.price')}}' onchange='calculateSum(1);' readonly >
                                            <input class='form-control amount_after_discount_txt' type='text' name='details[1][amount_after_discount]' id='amount_after_discount_1' value='0.00' placeholder='{{trans('frontend/sales_invoice.price')}}' onchange='calculateSum(1);' readonly >
                                        </div>
    {{--                                    {!! Form::text('details[1][row_price]', 0, array('placeholder' => trans('frontend/sales_invoice.price'),'id'=>'row_price_1','class' => 'row_price_txt form-control' ,'onchange'=>'calculateSum(1);','readonly'=>'yes' )) !!}--}}
                                    </td>
                                    
                                    <td id='td_taxes_1'>
                                        <div class='form-group has-feedback'>
                                            <input class='form-control tax_txt' type='text' name='details[1_1][tax]' id='tax_1_1' value='0.00' placeholder='{{trans('frontend/sales_invoice.tax')}}' onkeyup='changeDetails(1)' >                                        
                                        </div>                                            
<!--                                        <div class="form-group has-feedback col-md-6">
                                            <input class="form-control tax_txt" type="text" name="details[1][tax]" id="tax_1" value="0.00" placeholder="{{trans('frontend/sales_invoice.tax')}}" onkeyup="changeDetails(1)" >
                                        </div>-->                                    
                                    <td>
                                        <div class="form-group has-feedback ">
                                            <input class="form-control amount_txt" type="text" name="details[1][amount]" id="amount_1" value="0.00" placeholder="{{trans('frontend/sales_invoice.amount')}}" readonly>
                                        </div>
    {{--                                    {!! Form::text('details[1][amount]', 0, array('placeholder' => trans('frontend/sales_invoice.amount'),'id'=>'amount_1','class' => 'amount_txt form-control' ,'readonly'=>'yes')) !!}--}}
                                    </td>
                                    <td>
                                        {{--<a href="javascript:void(0);" id="addCF"><i class="fa fa-plus-circle fa-2x "></i></a>--}}
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        <a href="javascript:void(0);" id="addCF">+إضافه منتج</a>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-xs-12 ">
                        <h3 class="pull-left label label-def"  data-toggle="footer-row">محتوي ذيل الفاتوره</h3>
                    </div>
                </div>
                <div class="row" id="footer-row">
                    <div class="col-md-12 col-xs-12" style="margin-bottom: 15px">
                        <textarea id="footer_text" name="footer_text"></textarea>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-xs-12 ">
                        <h3 class="pull-left label label-def" data-toggle="totals-row">الاجماليات</h3>
                    </div>
                </div>
                <div id="totals-row">

                    <div class="row with-border-dotted">
                        <h5 class="totals">
                            <div class="col-xs-6 text-left">صافي السعر</div>
                            <div class="col-xs-6 text-right" ><span id="netPrice"></span> جنيه مصري </div>
                        </h5>
                    </div>
                    <hr />
                    <div class="row with-border-dotted">
                        <h5 class="totals">
                            <div class="col-xs-6 text-left">اجمالي الخصم</div>
                            <div class="col-xs-6 text-right" ><span id="discount"></span> جنيه مصري </div>
                        </h5>
                    </div>
                    <hr />    
                    
                    <div class="row with-border-dotted">
                        <h5 class="totals">
                            <div class="col-xs-6 text-left">بعد  الخصم</div>
                            <div class="col-xs-6 text-right" ><span id="totalAmount"></span> جنيه مصري </div>
                        </h5>
                    </div>
                    <hr />                        
                    @foreach($tax_types as $k=>$v)
                                        
                    <div id="tax_total_row_{{$k}}" style="padding:5px;">
                            <div class="row with-border-dotted">
                                <h5 class="totals">
                                    <div class="col-xs-6 text-left">{{ $v }}</div>
                                    <div class="col-xs-6 text-right" ><span id="tax_type_{{$k}}" date-TotalTaxTypeId="{{$k}}"  data-taxTypeVal="0">0</span> جنيه مصري </div>
                                </h5>
                            </div>
                                                    <hr />

                    </div>
                    @endforeach
         
                    <div class="row">
                        <h5 class="totals bold">
                            <div class="col-xs-6 text-left">الاجمالي</div>
                            <div class="col-xs-6 text-right" ><span id="totalInvoice"></span> جنيه مصري </div>
                        </h5>
                    </div>
                </div>
            </div>
            {{--<div class="panel-footer">--}}

            {{--</div>--}}
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-toolbar form-group m-b-0">
                        <div class="pull-right">
                            <button  name="submit" value="save" type="submit" class="btn btn-success waves-effect waves-light m-r-5 "><i class="fa fa-floppy-o"></i></button>
                            <a href="{{ route('sales_invoice.index') }}" class="btn btn-success waves-effect waves-light m-r-5"><i class="fa fa-trash-o"></i></a>
                            <button  name="submit" value="send"  type="submit" class="btn btn-default waves-effect waves-light "> <span>ارسال</span> <i class="fa fa-send m-l-10"></i> </button>
                        </div>
                        <div class="pull-left">
                            <a href="javascript:void(0)" class="btn btn-default waves-effect waves-light AllToggle"> <i class="fa fa-bars"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <input type="hidden" value="1" name='items_count' id='items_count'    readonly="yes">
        
        <input type="hidden" value="0" name='total_cost' id='total_cost'   readonly="yes" >        
        <input type="hidden" value="0" name='total_discount' id='total_discount'   readonly="yes" >           
        <input type="hidden" value="0" name='total_amount' id='total_amount'   readonly="yes" >              
        <input type="hidden" value="0" name='total_invoice' id='total_invoice'   readonly="yes" >             
    </form>
    <!-- Modal -->
    <div class="modal fade" id="addressModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">حدد عنوان العميل</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> إغلاق <i class="fa fa-close" ></i></button>
                </div>
            </div>

        </div>
    </div>
    
    
    <div id="invoice_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
        @include(Config::get('front_theme').'.dashboard.user.sales_invoice.inc.invoice_modal')        
    </div><!-- /.modal -->
 
 
 
 <!-- Modal -->
        <div id="create_model" class="modal-demo">
            <button type="button" class="close" onclick="Custombox.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title">Add Contact</h4>
            <div class="custom-modal-text text-left">
                <form role="form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" class="form-control" id="position" placeholder="Enter position">
                    </div>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" class="form-control" id="company" placeholder="Enter company">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>

                    <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light m-l-10">Cancel</button>
                </form>
            </div>
        </div>



@endsection




@section('page-scripts')
<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/select2/js/select2.min.js"></script>
<!--<script src="plugins/select2/js/select2.full.js"></script>-->
<script src="plugins/tinymce/tinymce.min.js"></script>

        <!-- Modal-Effect -->
        <script src="plugins/custombox/js/custombox.min.js"></script>
        <script src="plugins/custombox/js/legacy.min.js"></script>
<script>

    jQuery(document).ready(function($) {

        $('#delivery_date,#payment_day,#invoice_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'            
        });
        $("#delivery_date,#payment_day,#invoice_date").datepicker("setDate", new Date());

//        $("#invoice_status_id").on("select2:open", function() {
//            $(".select2-search__field").attr("placeholder", "Search...");
//        });
//        $("#invoice_status_id").select2({
//            width: '100%' ,
//            minimumResultsForSearch: -1
//        });


        if($("#header_text").length > 0){
            tinymce.init({
                selector: "textarea#header_text,textarea#footer_text",
                theme: "modern",
                height:100,
                menubar: true,
                statusbar: true,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons  paste textcolor"
                ],
                toolbar: "rtl | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        }

        $('.AllToggle').click(function () {
            $(".label-def").each(function(){
                $('#' + $(this).data('toggle')).slideToggle(200);
            });
        });
        $('.label-def').click(function () {
           $('#' + $(this).data('toggle')).slideToggle(200);
        });

        var rowNum = 1;
        $("#addCF").click(function () {
            rowNum++;
            //var listRow = 'details' + '[' + rowNum + ']';
            $("#customFields tbody").append("<tr>" 
                        +"<td></td>" 
                        +"<td>"
                            +"<div class='col-md-12' style='padding: 0;'>"
                                +"<select class='product_id form-control' name='details[" + rowNum + "][product_id]' id='product_id" + rowNum + "' onchange='getProductDetails(" + rowNum + ");'>"
                                +"</select>"
                           +"</div>"
                        +"</td>" 
                        +"<td id='td_account_" + rowNum + "'>" 
                            +"<div class='col-md-12' style='padding: 0;'>"
                                +"<input class='form-control account_id' type='text' name='details[" + rowNum + "][account_id]' id='account_id" + rowNum + "' value''  placeholder='{{trans('frontend/sales_invoice.account')}}'>" 
                            +"</div>" 
                        +"</td>"    
                        +"<td>" 
                                +"<div class='form-group has-feedback '>" 
                                     +"<input class='form-control quantity' type='text' name='details[" + rowNum + "][quantity]' id='quantity_" + rowNum + "' value='1' onkeyup='changeDetails(" + rowNum + ")' placeholder='{{trans('frontend/sales_invoice.quantity')}}'>" 
                                +"</div>" 
                        +"</td>" 
                        +"<td>" 
                                +"<div class='form-group has-feedback '>" 
                                    +"<select class='form-control units' id='unit_id_" + rowNum + "' name='details[" + rowNum + "][unit_id]'> " 
                                        @foreach($unit as $id => $name)
                                          +"<option value='{{$id}}'>{{$name}}</option>"
                                        @endforeach
                                    +"</select> " 
                                +"</div>" 
                        +"</td>" 
                        +"<td>" 
                                +"<div class='form-group has-feedback '>" 
                                        +"<input class='form-control new_price' type='text' name='details[" + rowNum + "][price]' id='price_" + rowNum + "' value='0.00' placeholder='{{trans('frontend/sales_invoice.price')}}' onkeyup='changeDetails(" + rowNum + ")' >" 
                                +"</div>"
                        +"</td>" 
                        +"<td>" 
                                +"<div class='form-group has-feedback '>"  
                                    +"<input class='form-control discount_txt' type='text' name='details[" + rowNum + "][discount]' id='discount_" + rowNum + "' value='0.00' placeholder='{{trans('frontend/sales_invoice.discount')}}' onkeyup='changeDetails(" + rowNum + ")'>"  
                                +"</div>" 
                        +"</td>"
                        +"<td>" 
                                +"<div class='form-group has-feedback '>"
                                        +"<input class='form-control amount_after_discount_txt' type='text' name='details[" + rowNum + "][amount_after_discount]' id='amount_after_discount_" + rowNum + "'  value='0.00' placeholder='{{trans('frontend/sales_invoice.price')}}' onchange=';' readonly >"
                                        +"<input class='form-control row_price_txt' type='hidden' name='details[" + rowNum + "][row_price]' id='row_price_" + rowNum + "' value='0.00' placeholder='{{trans('frontend/sales_invoice.price')}}' onchange='calculateSum(1);' readonly>" 
                                +"</div>"
                        +"</td>" 
                        +"<td id='td_taxes_" + rowNum + "'>"
                                +"<div class='form-group has-feedback'>"
                                            +"<input class='form-control tax_txt' type='text' name='details[" + rowNum + "_1][tax]' id='tax_" + rowNum + "_1' value='0.00' placeholder='{{trans('frontend/sales_invoice.tax')}}' onkeyup='changeDetails(" + rowNum + ")' >"
                                +"</div>"                       
 
                        +"</td>" +

                        "<td>" +
                            "<div class='form-group has-feedback '>" +
                                "<input class='form-control amount_txt' type='text' name='details[" + rowNum + "][amount]' id='amount_" + rowNum + "' value='0.00' placeholder='{{trans('frontend/sales_invoice.amount')}}' readonly>" +
                            "</div>" +
                        "</td>" +
                        "<td>"+
                            "<a href='javascript:void(0);' class='remCF'><i class='fa fa-trash fa-2x'></i></a>" +
                        "</td>" +
                    "</tr>"
            );
            getProduct();

            //$("#items_count").val(rowNum);

            $('.remCF').click(function (){
                rowNum--;
                addRowsNumbers()
                $(this).parent().parent().remove();
                sumTotals();
            });

            //auto number added rows
            addRowsNumbers();
            function addRowsNumbers() {
                $('#customFields tbody tr').each(function (idx) {
                    $(this).children(":eq(0)").html(idx + 1); //i'm trying to add the row number from here but this isn't working
                });
            }



        });


        getProduct();
        $(".product_id").on("select2:open", function() {
            $(".select2-search__field").attr("placeholder", "بحث");
        });
        function getProduct() {
            $('.product_id').select2({
                language: opts.language ,
                tags: false,
                dir: "rtl",
                multiple: false,
                tokenSeparators: [',', ''],
                minimumInputLength: 1,
                minimumResultsForSearch: 10,
                ajax: {
                    url: "{{route('sales_invoice.get_product_json') }}",
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
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        }
         
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



        $("#contact_id").on("select2:open", function() {
            $(".select2-search__field").attr("placeholder", "بحث");
        });
        $("#contact_id").select2({
            language: opts.language ,
            tags: false,
            dir: "rtl",
            multiple: false,
            tokenSeparators: [',', ''],
            minimumInputLength: 1,
            minimumResultsForSearch: 10,
//            maximumSelectionLength: 1,
            ajax: {
                url: "{{route('sales_invoice.get_contact_json') }}" ,
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
                                text: item.first_name,
                                id: item.id
                            }
                        })
                    };
                }

            }

        });

        $("#contact_id").on('change',function () {
            var e = document.getElementById("contact_id");
            var contactID = e.options[e.selectedIndex].value;
            url = '{{ route("sales_invoice.get_one_contact_address", ":contact_id") }}';
            url = url.replace(":contact_id", contactID);
            $('span#get_address').addClass('hidden')
            $('#address').val('')
            $.ajax({
                url : url
            }).done(function (data) {
                $('#address').val(data)
                $('span#get_address').removeClass('hidden')
            }).fail(function () {
                $('span#get_address').addClass('hidden')
            });
        });



    });

    function getProductDetails(num) {
       var e = document.getElementById("product_id"+num);
        var productID = e.options[e.selectedIndex].value;

        $.ajax({
            type: 'GET',
            url: '{{route('sales_invoice.get_product_data')}}',
            data: { id: productID },
            dataType: 'json',
            success: function (data) {
                if( data == null) {

                }else{
                    
                    getAccountData( data[0].account_id,num);     // get account data with values      
                    $("#product_id"+num).parent().parent().children('td').children('.form-group').children('.row_price_txt').val(parseFloat(Number(data[0].price)).toFixed(2));
                    $("#price_"+num).val(Number(data[0].price).toFixed(2));      
                    $("#unit_id_"+num).val(data[0].unit_id);                        
                    $("#amount_"+num).parent().parent().children('td').children('.form-group').children('.amount_txt').val(Number(data[0].price).toFixed(2));
                    getTaxFields( data[0].account_id,num);     // get tax fields with values         
    
                    sumTotals();
                }
            }
        });
    }




    function getAccountDetails(num) {
       var e = document.getElementById("account_id"+num);
        var accountID = e.options[e.selectedIndex].value;

        $.ajax({
            type: 'GET',
            url: '{{route('sales_invoice.get_account_data')}}',
            data: { id: accountID },
            dataType: 'json',
            success: function (data) {
                if( data == null) {

                }else{
                    getTaxFields( data[0].id,num);
//                    $("#product_id"+num).parent().parent().children('td').children('.form-group').children('.row_price_txt').val(parseFloat(Number(data[0].price)).toFixed(2));
//                    $("#product_id"+num).parent().parent().children('td').children('.form-group').children('.new_price').val(Number(data[0].price).toFixed(2));
//                    $("#product_id"+num).parent().parent().children('td').children('.form-group').children('.tax_txt').val(parseFloat(Number(data[0].tax)).toFixed(2));
//                    $("#product_id"+num).parent().parent().children('td').children('.form-group').children('.units').val(data[0].unit_id);
//                    $("#product_id"+num).parent().parent().children('td').children('.form-group').children('.amount_txt').val(Number(data[0].price).toFixed(2));
                  sumTotals()
                }
            }
        });
    }
    
            // get  account name
           function getAccountData( accountID,rowNum) {
               var url = '{{route('sales_invoice.get_account_data')}}';
               var loaging = '<div id="overlayPagination" class="overlay overlay-x1"><i class="fa fa-spinner fa-pulse fa-fw" ></i></div>';
               var Box = '#td_account_'+rowNum;
               $(Box).append(loaging);
               $.ajax({
                 type: 'GET',
                 url:url,
                 data: { id: accountID, num: rowNum },
                   
               }).done(function (data) {
                   $(Box).html($('#account_id'+rowNum).val(data[0].full_desc));

               }).fail(function () {
                   var error = '<div id="overlayError" class="alert alert-danger" style="margin: 0"><h4>خطأ في الاتصال<i class="fa fa-exclamation fa-fw"></i></h4><p>حدث خطأ اثناء الاتصال قد يكون انقطاع في الاتصال . حاول مرة اخري</p></div>';
                   $(Box).html(error);
               });
           }    
            // generate inputs for taxes depending on account id
           function getTaxFields( accountID,rowNum) {
               var url = '{{route('sales_invoice.get_tax_fields_view')}}';
               var loaging = '<div id="overlayPagination" class="overlay overlay-x1"><i class="fa fa-spinner fa-pulse fa-fw" ></i></div>';
               var Box = '#td_taxes_'+rowNum;
               $(Box).append(loaging);
               $.ajax({
                 type: 'GET',
                 url:url,
                 data: { id: accountID, num: rowNum },
                   
               }).done(function (data) {
                   $(Box).html(data);
                   
                changeDetails(rowNum); //calc the product row after getting taxes
               }).fail(function () {
                   var error = '<div id="overlayError" class="alert alert-danger" style="margin: 0"><h4>خطأ في الاتصال<i class="fa fa-exclamation fa-fw"></i></h4><p>حدث خطأ اثناء الاتصال قد يكون انقطاع في الاتصال . حاول مرة اخري</p></div>';
                   $(Box).html(error);
               });
           }
           
    function changeDetails(num) {
        var price = Number($("#price_"+num).val());
        var quantity = Number($("#quantity_"+num).val());
        var discount =Number($("#discount_"+num).val())/100;

        var cost=price*quantity;
        var discount_amount= cost * discount ; 
        var totalAmount =Number( cost  - discount_amount); //+ sumOfTaxes        
        $('#amount_after_discount_'+num).val(Number(totalAmount).toFixed(2));        
        // get count of tax input inside "#td_tax_num"
        var taxCount=$("#td_taxes_"+num).children().length; // get number of elements of #td_taxes_num
        
        var sumOfTaxes=0;        
        var taxRate=[];
        var taxTypeRow=[];
        var taxSign=[];
  
        for(var i=1;i<=taxCount;i++){
              taxRate[i]=$('#tax_'+num+'_'+i).val(); // test tax
              taxSign[i]=$('#tax_'+num+'_'+i).attr('data-taxTypeSign');   
                //     alert(taxSign[i]);     
              if(taxSign[i] == '-')
                  sumOfTaxes+= -1 * (totalAmount *taxRate[i]/100);
              else
                  sumOfTaxes+=  1 * (totalAmount *taxRate[i]/100);              
        }


        //alert(sumOfTaxes);
        
        //alert('taxType :'+taxType+ ' / tax :'+ tax);

       var totalRow=totalAmount+sumOfTaxes;
        //alert('totla :'+totla+ ' / tax :'+ tax);
        $('#amount_'+num).val(Number(totalRow).toFixed(2));

        sumTotals();
    }
    
 
    function sumTotals(){
       
        var quantity = 0;
        var price = 0;              
    
        var cost = 0;    // per row
        var totalCost = 0; // whole invoice
        
        var discount = 0;      // rate  per row
        var discount_amount = 0; // value   per row 
        var totalDiscount = 0; // whole invoice
        
        var amountAfterDiscount = 0;    // amount after discount   per row
        var totalAmount  = 0; // whole invoice of amount after discount           
        
        var totalInvoice = 0; // whole invoice
        

        var taxTypeVal=[]; 
        var taxTypeRow=[];
        var tax = 0;

        var num=1;
        var totalOfTaxes=[];
        var taxRate=[];

            var taxSign=[];    
            var objTaxType=[];
            

 
 
        var taxTypeArr= new Array();
        <?php foreach($tax_types as$k=>$v){ ?>
            taxTypeArr.push('<?php echo $k; ?>');
        <?php } ?>
            
            //jquery foreach
            $.each(taxTypeArr, function(index, value) {
              // do your stuff here
                  totalOfTaxes[value]=  0;
            });   

         //   alert(taxTypeArr);
        $('#product-row td .quantity').each(function() {
            
            var object = $(this);
            // data row
             price = Number($("#price_"+num).val());
             quantity = Number($("#quantity_"+num).val());
             discount =Number($("#discount_"+num).val())/100;

            cost=price*quantity;
            discount_amount= cost * discount ; 
            amountAfterDiscount =Number( cost  - discount_amount); // amount after disocunt        

            // tax summation part
            var taxCount=$("#td_taxes_"+num).children().length; // get number of elements of #td_taxes_num            
            var sumOfTaxes=0;  
            

            for(var i=1;i<=taxCount;i++){
                  taxRate[i]=$('#tax_'+num+'_'+i).val(); // test tax
                  taxSign[i]=$('#tax_'+num+'_'+i).attr('data-taxTypeSign');   
                  objTaxType[i]=$('#tax_'+num+'_'+i).attr('data-taxTypeId');
                  taxTypeRow[objTaxType[i]]=objTaxType[i];
  
                  totalOfTaxes[taxTypeRow[objTaxType[i]]]+=  1 * (amountAfterDiscount *taxRate[i]/100);
 
                  $('#tax_type_'+taxTypeRow[$('#tax_'+num+'_'+i).attr('data-taxTypeId')]).html(  totalOfTaxes[taxTypeRow[objTaxType[i]]]); //change the attribute                              
                  $('#tax_type_'+taxTypeRow[$('#tax_'+num+'_'+i).attr('data-taxTypeId')]).attr('data-taxtypeval', totalOfTaxes[taxTypeRow[$('#tax_'+num+'_'+i).attr('data-taxTypeId')]]) //
 
                  if(taxSign[i] == '-')
                      sumOfTaxes+= -1 * (amountAfterDiscount *taxRate[i]/100);
                  else
                      sumOfTaxes+=  1 * (amountAfterDiscount *taxRate[i]/100);              
            }
            
       
            
            
            var total_row = object.closest('tr').find('.amount_txt').val();

 
            totalCost+= Number(cost);
            totalDiscount += Number(discount_amount);
            totalAmount += Number(amountAfterDiscount);            
            totalInvoice += Number(total_row);
            
                
            num++;
        });

//var tax_vals=[];
//            //jquery foreach display all type of taxtype
//            $.each(taxTypeArr, function(index, value) {
//               //if(  $('#tax_type_'+value).attr('data-taxtypeval') =='0'){
//       
//                tax_val[index]=[$('#tax_type_'+value).attr('data-taxtypeval')] ;
//                     //   $('#tax_total_row_'+value).addClass('hidden');
//          
//             
//            });  
 
 
 
                   
 
        $('#netPrice').html(Number(totalCost).toFixed(2));
        $('#discount').html(Number(totalDiscount).toFixed(2));
    //    $('#taxes').html(Number(tax).toFixed(2));


        $('#totalAmount').html(Number(totalAmount).toFixed(2));        
         $('#totalInvoice').html(Number(totalInvoice).toFixed(2));
        $('#items_count').val(num-1); //  it was num++ 
//        $('#net_amount').val(Number(totalCost).toFixed(2));
//        $('#total_discount').val(Number(totalDiscount).toFixed(2));
//        $('#total_tax').val(Number(tax).toFixed(2));
//        $('#total_price').val(Number(totalInvoice).toFixed(2));

 
        $('#total_cost').val(Number(totalCost).toFixed(2));
        $('#total_discount').val(Number(totalDiscount).toFixed(2));
        $('#total_amount').val(Number(totalAmount).toFixed(2));
        $('#total_invoice').val(Number(totalInvoice).toFixed(2)); 
 
    }

 
              
    function getAddress(){
        var e = document.getElementById("contact_id");
        var contactID = e.options[e.selectedIndex].value;
        var url = '{{ route("sales_invoice.get_contact_address", ":contact_id") }}';
        url = url.replace(":contact_id", contactID);

        $('#addressModal').on('show.bs.modal', function (e) {
            $(this).find('.modal-body').load(url);
        });

    }
    function setAddress(id){
        var url = '{{ route("sales_invoice.get_contact_address_by_id", ":contact_id") }}';
        url = url.replace(":contact_id", id);

        $('#address').val('')
        $.ajax({
            url : url
        }).done(function (data) {
            $('#address').val(data)
            $('span#get_address').removeClass('hidden')
        }).fail(function () {
            $('span#get_address').addClass('hidden')
        });

//        var e = document.getElementById("adr_" + id);


////        var address = e.textContent;
//        var address = $('#adr_' + id).text();
//        $('#address').val(address.replace(/[^\x20-\x7E]/gmi, "") )
//        $("#contact_address").val(address);
        $('#addressModal').modal('hide');
    }
    var opts = {
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
                var element = document.getElementById("select2-contact_id-results");
                  element.innerHTML = document.createElement("div").innerHTML = '<a href="#create_model" class="btn btn-default btn-md waves-effect waves-light" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a" style="width: 100%;"><i class="md md-add"></i> Add Contact</a>';
                    
                 
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
</script>

<!--js:
 
$(this).data("id") // returns 123
$(this).attr("data-id", "321"); //change the attribute

$(this).data("id") // STILL returns 123!!!
$(this).data("id", "321")
$(this).data("id") // NOW we have 321
-->

@endsection


