@extends(Config::get('front_theme').'.layouts.default')

@section('title',$page_title)

@section('page-styles')
    <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/plugins/select2/css/select2.min.css">
    <!-- Ladda buttons css -->
    <link href="{{URL::to('').Config::get('assets_frontend')}}/plugins/ladda-buttons/css/ladda-themeless.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom box css -->
    <link href="{{URL::to('').Config::get('assets_frontend')}}/plugins/custombox/css/custombox.css" rel="stylesheet">

    <!-- Custom box scc -->
    <link href="{{URL::to('').Config::get('assets_frontend')}}/plugins/custombox/css/custombox.css" rel="stylesheet">

    <link rel="stylesheet" href="{{URL::to('').Config::get('assets_frontend')}}/plugins/PrintArea/print.css" media="print">

    <style>

        .ladda-button[data-style=slide-down] .ladda-spinner{
            right: 38%;
        }
        .form-page-create{
            margin-top: 90px;
        }
        .select2-container .select2-selection--single{
            height: 33px !important;
            direction: rtl !important;
        }
        #product-row .select2-container .select2-selection--single:first-of-type{
            width: 150px !important;
        }
        .account_id{
            width: 200px !important;
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
        textarea.form-control{
            max-height: 103px;
            min-height: 103px;
            min-width: 100%;
            max-width: 100%;
        }
        .form-group.has-feedback{
            padding-left: 0;
            padding-right: 0;
        }
        .form-group.has-feedback.col-md-12,
        .form-group.has-feedback.col-md-12 input,.quantity{
            width: 60px !important;
        }
        .units{
            width: 90px !important;
        }
        .select2-dropdown.select2-dropdown--below{
            z-index: 99999 !important;
        }
        @media(max-width: 540px){
            .name{
                width: 80%;
            }
            .tabs-vertical-env .tab-content{
                width: 53%;
            }
        }
        #secModel .modal-content{
            border: 0 !important;
        }
        #secModel .modal-footer{
            margin-top: 70px !important; 
        }
    </style>

@endsection()

@section('subnav')
    @include(Config::get('front_theme').'.dashboard.user.sales_invoice.inc.subnav')
@endsection

@section('content')


    <form class="form-page-create" role="form" id="idform" method="POST" action="{{-- route('sales_invoice.store') --}} ">
        {{ csrf_field() }}
        <input type="hidden" name="old_draft_id" id="old_draft_id" value="-1">

        <div class="col-md-offset-1 col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-toolbar form-group m-b-0">
                        <div class="pull-right">
                            <button  name="submit" data-style="slide-down"  formaction="{{ route('sales_invoice.store_draft') }}" type="submit" class="btn btn-success waves-effect waves-light m-r-5 ladda-button btn-save" led="btn-save">
                                <span class="ladda-label"><i class="fa fa-floppy-o"></i></span>
                                <span class="ladda-spinner"></span>
                            </button>
                            <button type="button" class="btn btn-success waves-effect waves-light m-r-5 btn_delete"><i class="fa fa-trash-o"></i></button>
                            <button  name="send" data-style="expand-right" type="button"  class="btn btn-default waves-effect waves-light ladda-button BtnSend" led="BtnSend">
                                <span class="ladda-label"><span>{{trans('frontend/sales_invoice.send')}}</span> <i class="fa fa-send m-l-10"></i></span>
                                <span class="ladda-spinner"></span>
                            </button>
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
                <div class="alerts">
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
                </div>
                <div class="row">
                    <div class="col-xs-12 ">
                        <h3 class="pull-left label label-def" data-toggle="customer-row">{{trans('frontend/sales_invoice.customer_information')}}</h3>
                    </div>
                </div>
                <div class="row" id="customer-row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label for="contact_id" class="control-label">{{trans('frontend/sales_invoice.customer')}} :</label>{{-- trans('frontend/sales_invoice.contact_id')--}}
                            <select class="form-control" name="contact_id" id="contact_id">
                                {!! old('contact_id') ? '<option value=' . old('contact_id') . ' selected ="selected">' . old('contact_name') . '</option>':''!!}

                            </select>
                            <input type="hidden" name="contact_name" id="contact_name" value="{{old('contact_name')? old('contact_name') : ''}}">
                            {{--<input class="form-control" type="text" name="filterCustomer" id="filterCustomer" value="" >--}}
                            {{--<span class="fa fa-user fa-fw form-control-feedback"></span>--}}
                        </div>

                        <div class="form-group has-feedback ">
                            <label for="address" class="control-label">{{trans('frontend/sales_invoice.address')}} :</label>{{-- trans('frontend/sales_invoice.address')--}}
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
                            >{{trans('frontend/sales_invoice.choose_address')}}
                            </span>
                            <textarea rows="8" class="form-control" type="text" name="address" id="address" style="height: 103px;">{{old('address')? old('address') : ''}}

                            </textarea>
                        </div>

                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback ">
                                    <label for="invoice_number" class="control-label">{{trans('frontend/sales_invoice.invoice_number')}} :</label>
                                    <?php 
                                        $sales = \DB::table('sales_invoices')->where('user_id','=',Auth::user()->id)->orderBy('invoice_number','DESC')->first();
                                        $invoice_no = '';
                                    ?>
                                    @if(!empty($sales))
                                    <?php $invoice_no = $sales->invoice_number + 1; ?>
                                    @else
                                    <?php $invoice_no = 200; ?>
                                    @endif
                                    <input class="form-control" type="text" name="invoice_number" id="invoice_number" value="{{$invoice_no}}" placeholder="{{ trans('frontend/sales_invoice.invoice_number')}}" readonly>
                                    <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback ">
                                    <label for="invoice_date" class="control-label">{{trans('frontend/sales_invoice.invoice_date')}} :</label>{{-- trans('frontend/sales_invoice.invoice_date')--}}
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
                                    <label for="delivery_date" class="control-label">{{trans('frontend/sales_invoice.delivery_date')}} :</label>{{-- trans('frontend/sales_invoice.delivery_date')--}}
                                    <input class="form-control" type="text" name="delivery_date" id="delivery_date" placeholder="yyyy-dd-mm" value="" >
                                    <span class="fa fa-calendar fa-fw form-control-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback ">
                                    <label for="reference_number" class="control-label">{{trans('frontend/sales_invoice.reference_number')}} :</label>{{--trans('frontend/sales_invoice.reference_number')--}}
                                    <input class="form-control" type="text" name="reference_number" id="reference_number" placeholder="" value="{{old('reference_number')? old('reference_number') : ''}}" >
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
                        <h3 class="pull-left label label-def"  data-toggle="header-row">{{trans('frontend/sales_invoice.bill_header')}}</h3>
                    </div>
                </div>
                <div class="row" id="header-row">
                    <div class="col-md-12 col-xs-12" style="margin-bottom: 15px">
                        <textarea  style="width:100%" id="new_header_text"class="form-control" name="header_text">{!! old('header_text') ? old('header_text') : '' !!}</textarea>

                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-xs-12 ">
                        <h3 class="pull-left label label-def" data-toggle="product-row">{{trans('frontend/sales_invoice.products')}}</h3>
                    </div>
                </div>
                <div class="row" id="product-row">
                    <div class="col-md-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="table-responsive mytable">
                        <table class="form-table" id="customFields">
                            <thead>
                                <td >#</td>
                                <td  >{{trans('frontend/sales_invoice.product')}}</td>
                                <td  >{{trans('frontend/sales_invoice.accounts')}}</td>
                                <td >{{trans('frontend/sales_invoice.quantity')}}</td>
                                <td  >{{trans('frontend/sales_invoice.unit')}}</td>
                                <td  >{{trans('frontend/sales_invoice.price')}}</td>
                                <td >{{trans('frontend/sales_invoice.discount')}}(%)</td>
                                <td  >{{trans('frontend/sales_invoice.after_discount')}}</td>
                                <td >{{trans('frontend/sales_invoice.tax')}}(%)</td>
                                <td  >{{trans('frontend/sales_invoice.total')}}</td>
                                <td  ></td>
                            </thead>

                            <tbody >
                            @if(!empty(old('details')))
                                <?php $index = 0 ?>
                                @foreach(old('details') as $product)
                                    <?php $index++ ?>
                                    <tr>
                                        <td>
                                            <span>{{$index}}</span>
                                        </td>
                                        <td >
                                            <div class="col-md-12" style="padding: 0;">
                                                <select class='product_id  form-control' name='details[{{$index}}][product_id]' id='product_id{{$index}}' onchange='getProductDetails({{$index}})'>
                                                    @if(isset($product['product_id']) && isset($product['product_name']))
                                                        <option value="{{$product['product_id']}}" selected>{{$product['product_name']}}</option>
                                                    @endif
                                                </select>
                                                <input type="hidden" class='product_name' name="details[{{$index}}][product_name]" id="product_name{{$index}}" value="{{isset($product['product_name'])  ? $product['product_name'] : ''}}" readonly >
                                            </div>
                                        </td>

                                        <td id='td_account_{{$index}}'>
                                            <div class='col-md-12' style='padding: 0;'>
                                                <input class='form-control account_id' type='text' name='details[{{$index}}][account_id]' id='account_id{{$index}}' value='{{isset($product['account_id'])  ? $product['account_id'] : ''}}'  placeholder='{{trans('frontend/sales_invoice.account')}}'>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group has-feedback ">
                                                <input class="form-control quantity" type="text" name="details[{{$index}}][quantity]" id="quantity_{{$index}}" value="{{isset($product['quantity']) ? $product['quantity'] : '1'}}" onkeyup="changeDetails({{$index}})" placeholder="{{trans('frontend/sales_invoice.quantity')}}">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group has-feedback ">
                                                <select class="form-control units" name="details[{{$index}}][unit_id]" id='unit_id_{{$index}}'>
                                                    @foreach($unit as $id => $name)
                                                        <option value="{{$id}}" {{isset($product['unit_id']) && $product['unit_id'] == $id ? 'selected' : ''}}>{{$name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>

                                        <td >
                                            <div class="form-group has-feedback ">
                                                <input class="form-control new_price" type="text" name="details[{{$index}}][price]" id="price_{{$index}}" value="{{isset($product['price'])? $product['price'] : '0'}}" placeholder="{{trans('frontend/sales_invoice.price')}}"  onkeyup="changeDetails({{$index}})" >
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group has-feedback ">
                                                <input class="form-control discount_txt" type="text" name="details[{{$index}}][discount]" id="discount_{{$index}}" value="{{isset($product['discount']) ? $product['discount'] : '0.00'}}" placeholder="{{trans('frontend/sales_invoice.discount')}}" onkeyup="changeDetails({{$index}})" >
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group has-feedback ">
                                                <input class='form-control row_price_txt' type='hidden' name='details[{{$index}}][row_price]" id="row_price_{{$index}}' value='{{isset( $product['row_price']) ? $product['row_price'] : '0.00'}}' placeholder='{{trans('frontend/sales_invoice.price')}}' onchange='calculateSum({{$index}});' readonly >
                                                <input class='form-control amount_after_discount_txt' type='text' name='details[{{$index}}][amount_after_discount]' id='amount_after_discount_{{$index}}' value='{{isset($product['amount_after_discount']) ? $product['amount_after_discount'] : '0.00'}}' placeholder='{{trans('frontend/sales_invoice.price')}}' onchange='calculateSum({{$index}});' readonly >
                                            </div>
                                        </td>

                                        <td id='td_taxes_{{$index}}'>
                                          <?php     $tax_array=[];?>
                                            @if(isset($product['tax']) && !empty($product['tax']))
                                                <?php $counter = 0

                                                 ?>
                                                @foreach($product['tax'] as $tax_row)
                                                        <?php $counter++ ?>
                                                    <div class="form-group has-feedback col-md-12">
                                                        <input class="form-control tax_txt" type="text" name="details[{{$index}}][tax][tax_{{$counter}}][val]" id="tax_{{$index}}_{{$counter}}" value="{{isset($tax_row["val" ])? $tax_row["val"] : 0}}" data-taxTypeName="{{isset( $tax_row['name']) ?  $tax_row['name'] : 0}}" data-taxTypeid="{{isset($tax_row['id']) ? $tax_row['id'] : -1}}" data-taxTypeSign="{{isset($tax_row['sign']) ? $tax_row['sign'] : '+'}}" placeholder="{{trans('frontend/sales_invoice.tax')}}" onkeyup="changeDetails({{$index}})" >
                                                    </div>
                                                    <?php $tax_array.push($tax_row["val"]); ?>
                                                @endforeach()

                                            @else
                                                <div class='form-group has-feedback col-md-12'>
                                                    <input class='form-control tax_txt' type='text' name="details[{{$index}}][tax][tax_1][val]" id='tax_1_1' value='{{isset($product['tax']['tax_1']['val']) ? $product['tax']['tax_1']['val'] : 0}}' placeholder='{{trans('frontend/sales_invoice.tax')}}' onkeyup='changeDetails({{$index}})' >
                                                </div>
                                                      <?php $tax_array.push($product['tax']['tax_1']); ?>
                                            @endif
                                                      <input type="hidden" name="tax_array" value={{$tax_array}}>
                                        </td>
                                        <td>
                                            <div class="form-group has-feedback ">
                                                <input class="form-control amount_txt" type="text" name="details[{{$index}}][amount]" id="amount_{{$index}}" value="{{isset($product['amount']) ? $product['amount'] : 0.00}}" placeholder="{{trans('frontend/sales_invoice.amount')}}" readonly>
                                            </div>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <span>1</span>
                                    </td>
                                    <td >
                                        <div class="col-md-12" style="padding: 0;">
                                            <select class='product_id  form-control' name='details[1][product_id]' id='product_id1' onchange='getProductDetails(1)'>

                                            </select>
                                            <input type="hidden" class='product_name' name="details[1][product_name]" id="product_name1" value="">
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
                                    </td>

                                    <td>
                                        <div class="form-group has-feedback ">
                                            <select class="form-control units" name="details[1][unit_id]" id='unit_id_1'>
                                                @foreach($unit as $id => $name)
                                                    <option value="{{$id}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>

                                    <td >
                                        <div class="form-group has-feedback ">
                                            <input class="form-control new_price" type="text" name="details[1][price]" id="price_1" value="" placeholder="{{trans('frontend/sales_invoice.price')}}"  onkeyup="changeDetails(1)" >
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-group has-feedback ">
                                            <input class="form-control discount_txt" type="text" name="details[1][discount]" id="discount_1" value="0.00" placeholder="{{trans('frontend/sales_invoice.discount')}}" onkeyup="changeDetails(1)" >
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-group has-feedback ">
                                            <input class='form-control row_price_txt' type='hidden' name='details[1][row_price]" id="row_price_1' value='0.00' placeholder='{{trans('frontend/sales_invoice.price')}}' onchange='calculateSum(1);' readonly >
                                            <input class='form-control amount_after_discount_txt' type='text' name='details[1][amount_after_discount]' id='amount_after_discount_1' value='0.00' placeholder='{{trans('frontend/sales_invoice.price')}}' onchange='calculateSum(1);' readonly >
                                        </div>
                                    </td>

                                    <td id='td_taxes_1'>
                                        <div class='form-group has-feedback'>
                                            <input class='form-control tax_txt' type='text' name='details[1][tax][tax_1][val]' id='tax_1_1' value='0.00' placeholder='{{trans('frontend/sales_invoice.tax')}}' onkeyup='changeDetails(1)' >
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-group has-feedback ">
                                            <input class="form-control amount_txt" type="text" name="details[1][amount]" id="amount_1" value="0.00" placeholder="{{trans('frontend/sales_invoice.amount')}}" readonly>
                                        </div>
                                    </td>

                                    <td>

                                    </td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                        </div>
                        
                        <a href="javascript:void(0);" id="addCF">+{{trans('frontend/sales_invoice.add_product')}}</a>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-xs-12 ">
                        <h3 class="pull-left label label-def"  data-toggle="footer-row">{{trans('frontend/sales_invoice.bill_footer')}}</h3>
                    </div>
                </div>
                <div class="row" id="footer-row">
                    <div class="col-md-12 col-xs-12" style="margin-bottom: 15px">
                        <textarea style="width:100%" class="form-control" id="new_footer_text"name="footer_text" >{!! old('footer_text') ? old('footer_text') : '' !!}</textarea>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-xs-12 ">
                        <h3 class="pull-left label label-def" data-toggle="totals-row">{{trans('frontend/sales_invoice.totals')}}</h3>
                    </div>
                </div>
                <div id="totals-row">

                    <div class="row with-border-dotted">
                        <h5 class="totals">
                            <div class="col-xs-6 text-left">{{trans('frontend/sales_invoice.net_price')}} price</div>
                            <div class="col-xs-6 text-right" ><span id="netPrice">{{old('netPrice')?old('netPrice') : ''}}</span>{{trans('frontend/sales_invoice.LE')}}</div>
                        </h5>
                    </div>
                    <hr />
                    <div class="row with-border-dotted">
                        <h5 class="totals">
                            <div class="col-xs-6 text-left">{{trans('frontend/sales_invoice.total_discount')}}</div>
                            <div class="col-xs-6 text-right" ><span id="discount">{{old('total_discount')?old('total_discount'):''}}</span>{{trans('frontend/sales_invoice.LE')}}</div>
                        </h5>
                    </div>
                    <hr />

                    <div class="row with-border-dotted">
                        <h5 class="totals">
                            <div class="col-xs-6 text-left">{{trans('frontend/sales_invoice.total_amount')}}</div>
                            <div class="col-xs-6 text-right" ><span id="totalAmount">{{old('total_amount')?old('total_amount'):'0'}}</span>{{trans('frontend/sales_invoice.LE')}}</div>
                        </h5>
                    </div>
                    <hr />

                    @foreach($tax_types as $k=>$v)
                    <div id="tax_total_row_{{$k}}"  class="tax_types">
                        <div class="row with-border-dotted">
                            <h5 class="totals">
                                <div class="col-xs-6 text-left">{{ $v }}</div>
                                <div class="col-xs-6 text-right" >
                                    <span id="tax_type_{{$k}}" date-TotalTaxTypeId="{{$k}}"  data-taxTypeVal="0">{{isset(old('tax_totals')['id_'.$k]) ? old('tax_totals')['id_'.$k] : 0}}</span>{{trans('frontend/sales_invoice.LE')}}<input type="hidden" name="tax_totals[id_{{$k}}]" id="tax_totals_id_{{$k}}" value="{{isset(old('tax_totals')['id_'.$k]) ? old('tax_totals')['id_'.$k] : 0}}">
                                    {{--{{dd(old('tax_totals')['id_1'])}}--}}
                                </div>
                            </h5>
                        </div>
                        <hr />
                    </div>
                    @endforeach

                    <div class="row">
                        <h5 class="totals bold">
                            <div class="col-xs-6 text-left">{{trans('frontend/sales_invoice.total')}}</div>
                            <div class="col-xs-6 text-right" ><span id="totalInvoice">{{old('total_invoice')?old('total_invoice'):'0'}}</span>{{trans('frontend/sales_invoice.LE')}}</div>
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
                            <button  name="submit" data-style="slide-down"  formaction="{{ route('sales_invoice.store_draft') }}" type="submit" class="btn btn-success waves-effect waves-light m-r-5 ladda-button btn-save" led="btn-save">
                                <span class="ladda-label"><i class="fa fa-floppy-o"></i></span>
                                <span class="ladda-spinner"></span>
                            </button>
                            <a href="javascript:void(0)" class="btn btn-success waves-effect waves-light m-r-5 btn_delete"><i class="fa fa-trash-o"></i></a>
                            <button  name="send" data-style="expand-right" type="button"  class="btn btn-default waves-effect waves-light ladda-button BtnSend" led="BtnSend">
                                <span class="ladda-label"><span>{{trans('frontend/sales_invoice.send')}}</span> <i class="fa fa-send m-l-10"></i></span>
                                <span class="ladda-spinner"></span>
                            </button>
                        </div>
                        <div class="pull-left">
                            <a href="javascript:void(0)" class="btn btn-default waves-effect waves-light AllToggle"> <i class="fa fa-bars"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <input type="hidden" id='items_count'     name="items_count"    readonly="yes" value="{{old('items_count')?old('items_count'):'1'}}"><br>
        <input type="hidden" id='net_Price'       name='netPrice'       readonly="yes" value="{{old('netPrice')?old('netPrice'):'0'}}"><br>
        {{--total_cost      <input type="text" id='total_cost'      name='total_cost'     readonly="yes" value="{{old('total_cost')?old('total_cost'):'0'}}"><br>--}}
        <input type="hidden" id='total_discount'  name='total_discount' readonly="yes" value="{{old('total_discount')?old('total_discount'):'0'}}"><br>
        <input type="hidden" id='total_amount'    name='total_amount'   readonly="yes" value="{{old('total_amount')?old('total_amount'):'0'}}"><br>
        <input type="hidden" id='total_invoice'   name='total_invoice'  readonly="yes" value="{{old('total_invoice')?old('total_invoice'):'0'}}"><br>


    </form>
    <input type="hidden" id="test">
    <!-- Modal -->
    <div class="modal fade" id="addressModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{trans('frontend/sales_invoice.detect_customer_adrress')}} </h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> {{trans('frontend/sales_invoice.close')}} <i class="fa fa-close" ></i></button>
                </div>
            </div>

        </div>
    </div>

    <div id="contact_modal" class="modal fade" taex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
        @include(Config::get('front_theme').'.dashboard.user.sales_invoice.inc.create_contact_modal')
    </div><!-- /.modal -->

    <div id="product_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
        @include(Config::get('front_theme').'.dashboard.user.sales_invoice.inc.create_product_modal')
    </div><!-- /.modal -->

    <div id="invoice_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
        @include(Config::get('front_theme').'.dashboard.user.sales_invoice.inc.invoice_modal')
    </div><!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" tabindex="-1"  id="secModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background:#fff;">
                    <h4 class="modal-title" style="width: 90%;display: inline-block;"> إرســــال فاتورة</h4>
                    <button type="button" class="close" data-dismiss="#secModel" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              
                <div class="modal-content">
                    <div class="modal-body">
                        <form>
                            <input type="hidden" name="receiver_id" value="">
                            <div class="form-group" style="margin-top:10px">
                                <div class="col-sm-4 col-xs-12">
                                    <strong>الراســـل :</strong>
                                </div>

                                <div class="col-sm-8">
                                    <input class="form-control" type="email" name="frmoemail" style="margin-bottom:15px;" value="{{Auth::user()->profile->first_name}} {{Auth::user()->profile->last_name}} <{{Auth::user()->email}}>">
                                </div>                              
                            </div>

                            <div class="form-group">
                                <div class="col-sm-4 col-xs-12">
                                    <strong>المرســل اليه :</strong>
                                </div>
                                <div class="col-sm-8">
                                    <input class="form-control" type="email" id="ReciverEmail"  style="margin-bottom:15px;" >
                                </div>                                          
                            </div>
                        </form>
                    </div>
                </div>     

                <div class="modal-footer">
                    <div class="hidden-print">
                        <button class="btn btn-danger">{{trans('button.close')}}</button>
                        <button type="button" data-style="expand-right" class="btn sent_email btn-inverse waves-effect waves-light ladda-button" led="sent_email">
                                <span class="ladda-label" >  {{trans('button.send_by_email')}}<i class="fa fa-send"></i></span>
                                <span class="ladda-spinner"></span>
                        </button>
                    </div>
                </div>
            </div>    
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


    jQuery(document).ready(function($) {
        
		$(".select2").select2();
        $('#product_form #account_id').select2();
        var l = $('.ladda-button').ladda();
		$('#product_form #product_type_id').val(1);
        $('#product_form #unit_id').val(1);
        $('#delivery_date,#payment_day,#invoice_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
        var old_invoice_date= "{{old('invoice_date')? old('invoice_date') : ''}}"
        var old_payment_day= "{{old('due_date')? old('due_date') : ''}}"
        var old_delivery_date= "{{old('delivery_date')? old('delivery_date') : ''}}"
        $("#invoice_date").datepicker("setDate",old_invoice_date ? old_invoice_date :  new Date());
        $("#payment_day").datepicker("setDate",old_payment_day ? old_payment_day :  new Date());
        $("#delivery_date").datepicker("setDate",old_delivery_date ? old_delivery_date :  new Date());


        if($("#header_text").length > 0){
            tinymce.init({
                selector: "textarea#header_text",
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
                                +"<input type='hidden' class='product_name' name='details[" + rowNum + "][product_name]' id='product_name" + rowNum + "' value='' readonly>"
                           +"</div>"
                        +"</td>"
                        +"<td id='td_account_" + rowNum + "'>"
                            +"<div class='col-md-12' style='padding: 0;'>"
                                +"<input class='form-control account_id' type='text' name='details[" + rowNum + "][account_id]' id='account_id" + rowNum + "' value=''  placeholder='{{trans('frontend/sales_invoice.account')}}'>"
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
                                            +"<input class='form-control tax_txt' type='text' name='details[" + rowNum + "_1][tax][tax-" + rowNum + "][val]' id='tax_" + rowNum + "_1' value='0.00' placeholder='{{trans('frontend/sales_invoice.tax')}}' onkeyup='changeDetails(" + rowNum + ")' >"
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
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'حدد المنتج'
                },
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
//                        if (data == ""){
//                            data = [{"name":"mohammed","id":17}]
//                        }

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
                  //console.log(data);

                    return {
                        results: $.map(data, function (item) {

                            return {
                                text: item.first_name +" "+ item.last_name,
                                id: item.id
                            }
                        })
                    };
                }

            }

        });

        $("#contact_id").on('change',function () {
            getAddressById($(this).val());

        });


        $('.btn-save').on('click' , function () {
            $("#idform").attr('action' , $(this).attr('formaction'));
            $("#idform").attr('state' , 'draft');
        });

        $("#idform").submit(function(e) {
                if ($(this).attr('state') == 'draft'){
                    e.preventDefault();
                    $('.alerts').html('');
                    $('.ladda-button[led="btn-save"]').ladda('start');
                    var url = "{{ route('sales_invoice.store_draft') }}"; 
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(data)
                        { console.log(data);
                            setTimeout(function () {
                                $('.ladda-button[led="btn-save"]').ladda('stop');
                            },2000)
                            if (isNaN(data)){
                                $.Notification.autoHideNotify('error', 'top right', 'Whoops',data);

                                $('.alerts').html('<div class="alert alert-danger">'+
                                    '<strong>Whoops!</strong> There were some problems with your input.<br><br>'+
                                    '<div>'+data + '</div>' +
                                '</div>')
                            }else{
                               console.log(data);
                                $('#old_draft_id').val(data);
                             $.Notification.autoHideNotify('success', 'top right', 'Saved successfully','Invoice Saved successfully In Drafts if you show it in drafts<br>');
                            }
                        },
                        error: function(data){
                            setTimeout(function () {
                                $('.ladda-button[led="btn-save"]').ladda('stop');
                            },2000)
                            $('.alerts').html('<div class="alert alert-danger">'+
                                '<strong>Whoops!</strong> Error may be in connection to server <br><br>'+
                                '</div>');
                            $.Notification.autoHideNotify('error', 'top right', 'Whoops','Error may be in connection to server<br>');

                        }
                    });
                    $("#idform").removeAttr('state');
                }
        });

        $('.BtnSend').on('click',function () {
            $('.alerts').html('');
            $('.ladda-button[led="BtnSend"]').ladda('start');
            var url = "{{ route('sales_invoice.invoice_validation') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#idform").serialize(),
                success: function(data)
                {
                    setTimeout(function () {
                        $('.ladda-button[led="BtnSend"]').ladda('stop');
                    },2000)
                    if (isNaN(data)){
                        var err = "<ul>";
                        $.each(data['errors'], function(i, item) {
                            $.Notification.autoHideNotify('error', 'top right', 'Whoops',item);
                            err += "<li>" + item + "</li>";
                        });
                        err += "</ul>";
                        $('.alerts').html('<div class="alert alert-danger">'+
                            '<strong>Whoops!</strong> There were some problems with your input.<br><br>'+
                            '<div>'+ err + '</div>' +
                            '</div>')
                    }else if(data==1){


                        $('.printTable .table tbody tr').remove();
                        var index = 1;
                          getContactPhones();
                        $('.printInvoice #customerAddress').html('<pre>' + $('#address').val() + '</pre>');
                        $('.printInvoice #invoiceDate').html($('#invoice_date').val());
                        $('.printInvoice #invoiceNumber').html($('#invoice_number').val());
                        $('.printInvoice #contact_id').html($('#contact_id').val());
                        $('.printInvoice #contact_name').html($('#contact_name').val());
                        $('.printInvoice .contact_name').html($('#contact_name').val());
                        //$('.printInvoice #contact_address').html($('#address').val());
                        //$('.printInvoice .contact_address').append($('#address').val());

                        $('.printInvoice #header_text').html($('#new_header_text').val());
                        $('.printInvoice #footer_text').html($('#new_footer_text').val());
                        $('.printInvoice #totalsRow').html($('.pa   ge-create #totals-row').html());
                        $('#product-row td .quantity').each(function() {
                            var object = $(this);
                            var quantity_row = object.val();
                            var price = object.closest('tr').find('.new_price').val();
                            var name = object.closest('tr').find('.product_name').val();
                            var discount_row = object.closest('tr').find('.discount_txt').val();
                            var total_row = object.closest('tr').find('.amount_txt').val();
                            var amount = (Number(price) * Number(quantity_row));

                            var row = "<tr>" +
                                            "<td>" + index + "</td>" +
                                            "<td>" + name + "</td>" +
                                            "<td>" + quantity_row + "</td>" +
                                            "<td>" + price + "</td>" +
                                            "<td>" + discount_row + "</td>" +
                                            "<td>" + total_row + "</td>" +
                                      "</tr>";
                            $('.printTable .table tbody').append(row);
                            index++;
                        });
                        $('.alerts').html('');
                        var led = $(this).attr('led')
                        var lada = '.ladda-button[led="' + led + '"]'
                        $(lada).ladda('start');
                        var url = "{{ route('sales_invoice.store') }}";
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: $("#idform").serialize(),
                            success: function(data)
                            {
                                setTimeout(function () {
                                    $(lada).ladda('stop');
                                    $('#btndownloadPrint').val(data);
                                    //$.Notification.autoHideNotify('success', 'top right', 'Saved Successfully','Invoice Saved successfully<br>');
                                    $('#invoice_modal').modal('show');

                                },2000)
                            },
                            error: function(data){
                                setTimeout(function () {
                                    $(lada).ladda('stop');
                                },2000)
                                var response = JSON.parse(data.responseText);
                                $.each(response.errors, function (key, val) {
                                    $('.alert-danger').removeClass('hidden');
                                    $('.alert-danger').append('<li>'+val+'</li>')
                                });
                                $.Notification.autoHideNotify('error', 'top right', 'Whoops','Error may be in connection to server<br>');
                            }
                        });
                        
                    }
                },
                error: function(data){
                    setTimeout(function () {
                        $('.ladda-button[led="BtnSend"]').ladda('stop');
                    },2000)
                    $('.alerts').html('<div class="alert alert-danger">'+
                        '<strong>Whoops!</strong> Error may be in connection to server <br><br>'+
                        '</div>');
                    $.Notification.autoHideNotify('error', 'top right', 'Whoops','Error may be in connection to server<br>');
                }
            });
        });

        $('#btnSavePrint').on('click',function(){
            $('#invoice_modal').modal('toggle');
        })

        $('#btnSendmailPrint ,#done').on('click' , function () {
            //e.preventDefault();
            //e.stopPropagation();
            
            $('#invoice_modal').modal('toggle'); 
            $('#secModel').modal('toggle');    
            $('#secModel input[name="subject"]').val('ارسال فاتورة رقم '+$('#invoice_number').val());
            
        });

        $('#secModel .close,#secModel .btn-danger').on('click',function(){
            $('#secModel').modal('toggle');
            //$('.printInvoice').css('opacity','1');
        });

        $('#secModel .sent_email').on('click',function(){
            $('.alerts').html('');
            var led = $(this).attr('led')
            var lada = '.ladda-button[led="' + led + '"]'
            $(lada).ladda('start');
            var url = "{{route('sales_invoice.sendEmail')}}";
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id': $('#test').val(),
                            'email' : $('#secModel #ReciverEmail').val(),
                            'subject' : $('#secModel input[name="subject"]').val(),
                            'message' : tinymce.get('header_text').getContent({ format: 'text' }),
                            'sales_number' : $('#invoice_number').val(),
                        },
                        success: function(data)
                        {
                            setTimeout(function () {
                                $(lada).ladda('stop');
                            },2000)
                           

                            if (isNaN(data)){
                            var err = "<ul>";
                            $.each(data['errors'], function(i, item) {
                                $.Notification.autoHideNotify('error', 'top right', 'Whoops',item);
                                err += "<li>" + item + "</li>";
                            });
                            err += "</ul>";
                       
                            }else if(data==1){
                                $.Notification.autoHideNotify('success', 'top right', 'Email Sent successfully','Invoice is Sent to Your Email <br>');
                                window.location.href = "{{route('sales_invoice.index')}}";
                            }
                        },
                        error: function(data){
                            setTimeout(function () {
                                $(lada).ladda('stop');
                            },2000)
                            $('.alerts').html('<div class="alert alert-danger">'+
                                '<strong>Whoops!</strong> Error may be in connection to server <br><br>'+
                                '</div>');
                            $.Notification.autoHideNotify('error', 'top right', 'Whoops','Error may be in connection to server<br>');
                        }
            });
        });

        $('#btndownloadPrint').on('click',function(){
            var id = $(this).val();
            var led = $(this).attr('led')
            var lada = '.ladda-button[led="' + led + '"]'
            $(lada).ladda('start');
            var url = '{{ route("sales_invoice.downloadPdf", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function (data) {
                    setTimeout(function () {
                        $(lada).ladda('stop');
                    },2000)
                },
                        error: function(data){
                            setTimeout(function () {
                                $(lada).ladda('stop');
                            },2000)
                            
                            $.Notification.autoHideNotify('error', 'top right', 'Whoops','Error may be in connection to server<br>');
                        }
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
                    $("#product_name"+num).val(data[0].name);
                    $("#price_"+num).val(Number(data[0].price).toFixed(2));
                    $("#unit_id_"+num).val(data[0].unit_id);
                    $("#amount_"+num).parent().parent().children('td').children('.form-group').children('.amount_txt').val(Number(data[0].price).toFixed(2));
                    getTaxFields( data[0].account_id,num);     // get tax fields with values

                    sumTotals();
                }
            }
        });
    }
    var contactID;
    function getAddressById(id) {
        var e = document.getElementById("contact_id");
        var contactID = id || e.options[e.selectedIndex].value;
        var contactName = e.options[e.selectedIndex].text;
        $('#contact_name').val(contactName);
        $('#test').val(contactID);
        var url = '{{ route("sales_invoice.get_one_contact_address", ":contact_id") }}';
        url = url.replace(":contact_id", contactID);
        $('span#get_address').addClass('hidden');
        $('#address').val('');
        $('.printInvoice #contact_address').val('');
        $('.printInvoice .contact_address').val('');
        $.ajax({
            url : url
        }).done(function (data) {
            $('#address').val(data);
            $('.printInvoice #contact_address').val(data);
            $('.printInvoice .contact_address').val(data);
            $('span#get_address').removeClass('hidden');

            $.ajax({
            type: 'GET',
            url: '{{route("sales_invoice.get_contact_email")}}',
            data: { id: contactID },
            dataType: 'json',
            success: function (data) {
                if( data == null) {

                }else{
                   $('#secModel #ReciverEmail').val(data);
                }
            }
        });


        }).fail(function () {
            $('span#get_address').addClass('hidden');
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
                 //console.log("taxes: "+ data);
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
        var net_price=price*quantity;
        var discount_amount=  (Number($("#discount_"+num).val())/100) * net_price ;
        var totalAmount =Number( net_price  - discount_amount); //+ sumOfTaxes
        $('#amount_after_discount_'+num).val(totalAmount);
        // get count of tax input inside "#td_tax_num"
        var sumOfTaxes=0;
        $("#td_taxes_"+ num + " input[type!='hidden']").each(function() {
            var object = $(this);
            if (object.attr('data-taxTypeSign') == '-'){
                sumOfTaxes+= -1 * (totalAmount * (object.val() / 100));
            }else{
                sumOfTaxes+=  1 * (totalAmount * (object.val() /100));
            }
        });

        $('#amount_'+num).val(Number(totalAmount+sumOfTaxes).toFixed(2));

        sumTotals();
    }
    function sumTotals(){
        var net_price = 0;
        var quantity = 0;
        var discount = 0;
        var total = 0;
        var totalOfTaxes=[];
        var taxRate=[];
        var objTaxType=[];
        var taxTypeRow=[];

        var taxTypeArr= new Array();
        @foreach($tax_types as$k=>$v)
            taxTypeArr.push({{$k}});
        @endforeach

        $.each(taxTypeArr, function(index, value) {
            totalOfTaxes[value]=  0;
        });

        $('#product-row td .quantity').each(function() {
            var object = $(this);
            var quantity_row = object.val();
            var price = object.closest('tr').find('.new_price').val();
            var discount_row = object.closest('tr').find('.discount_txt').val();
            var total_row = object.closest('tr').find('.amount_txt').val();
            var amount = (Number(price) * Number(quantity_row));

            net_price+= Number(amount);
            discount += (Number(discount_row)/100) * net_price ;
            quantity += Number(quantity_row);
            total += Number(total_row);

            $(object.closest('tr').find('.tax_txt')).each(function() {
                var object = $(this);
                var i = object.attr('data-taxTypeId');
                taxRate[i]=object.val(); // test tax
                objTaxType[i]=object.attr('data-taxTypeId');
                taxTypeRow[objTaxType[i]]=objTaxType[i];
                totalOfTaxes[taxTypeRow[objTaxType[i]]]+=  1 * ( (Number(amount)-((Number(discount_row)/100) * net_price))  * taxRate[i]/100);

                $('#tax_type_'+ object.attr('data-taxtypeid')).html(totalOfTaxes[taxTypeRow[objTaxType[i]]]); //change the attribute
                $('#tax_type_'+ object.attr('data-taxtypeid')).attr('data-taxtypeval' , totalOfTaxes[taxTypeRow[object.attr('data-taxTypeId')]]); //change the attribute
                $('#tax_totals_id_'+ object.attr('data-taxtypeid')).val(totalOfTaxes[taxTypeRow[objTaxType[i]]]);


            });

        });
        $('#totals-row .tax_types').each(function() {
            var object = $(this);
            if (object.find('.totals input').val() == 0 ){
                object.closest('.tax_types').addClass('hidden');
            }else{
                object.closest('.tax_types').removeClass('hidden');
            }
        });
        var total_amount_after_discount = net_price - discount;
        $('#netPrice').html(Number(net_price).toFixed(2));
        $('#discount').html(Number(discount).toFixed(2));
        $('#totalAmount').html(Number(total_amount_after_discount).toFixed(2));
        $('#totalInvoice').html(Number(total).toFixed(2));

        $('#items_count').val(quantity);
        $('#net_Price').val(Number(net_price).toFixed(2));
        $('#total_discount').val(Number(discount).toFixed(2));
        $('#total_amount').val(Number(total_amount_after_discount).toFixed(2));
        $('#total_invoice').val(Number(total).toFixed(2));
    }

    function sumTotals0(){

        var quantity = 0;
        var price = 0;

        var cost = 0;    // per row  (quantity * price)
        var totalCost = 0; // whole invoice

        var discount = 0;      // rate  per row
        var discount_amount = 0; // value   per row
        var totalDiscount = 0; // whole invoice

        var amountAfterDiscount = 0;    // amount after discount   per row   // (cost after discount)
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
             discount =Number($("#discount_"+num).val())/100; // rate  per row

            cost=price*quantity;   //per row  (quantity * price)
            discount_amount= cost * discount ;        // value   per row
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

        $('#netPrice').html(Number(totalCost).toFixed(2));
        $('#net_Price').val(Number(totalCost).toFixed(2));
        $('#discount').html(Number(totalDiscount).toFixed(2));

        $('#totalAmount').html(Number(totalAmount).toFixed(2));
         $('#totalInvoice').html(Number(totalInvoice).toFixed(2));
        $('#items_count').val(num-1); //  it was num++

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
                if (element != null){

                    element.innerHTML = document.createElement("div").innerHTML = '<a href="#contact_modal" id="BtnAddNewContact" class="btn btn-default waves-effect waves-light m-r-20" data-toggle="modal" data-target="#contact_modal" data-overlayColor="#36404a"><i class="fa fa-plus-square"></i> إضافة عميل جديد</a>';
                    $('#Contact_form #first_name').val( $("#contact_id").data('select2').$dropdown.find("input").val())

                }else{
                    var element2 = $("[id^='select2-product_id'][id$='-results']");
                    var id =element2.attr('id').replace('select2-','').replace('-results','');
                    $('#product_form #field_id').val(id);
                    var v = $('.select2-search__field')[0].value;
                    element2.append( '<a href="#product_modal" id="BtnAddNewProduct" class="btn btn-default waves-effect waves-light m-r-20" data-toggle="modal" data-target="#product_modal" data-overlayColor="#36404a"><i class="fa fa-plus-square"></i> إضافة منتج جديد</a><a id="BtnAddNewContact" class="btn waves-effect waves-light m-r-20 m-t-10" >'+v+'</a>');

                    $('#product_form #name').val($("#" + id).data('select2').$dropdown.find("input").val());

                }
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
<script>

    jQuery(document).ready(function(){
        var adresse_rowNum = 1;
        var phone_number_rowNum=1;
        $("#add_adress").click(function () {
            adresse_rowNum++;

            $("#adresse").append('<div class="page-create"><hr></div>' +
                '<div class=" row adresse_block">' +
                '<div class="form-group col-xs-11 ">' +
                '<label>اسم الشارع ورقم البيت :</label>' +
                '<input type="text"  name="adresse[' + adresse_rowNum + '][address_number]"  placeholder="" class="form-control">' +
                '</div>' +
                '<div class="col-xs-1 trash">' +
                '<a href="javascript:void(0);" class="remCF"><i class="fa fa-trash fa-2x " style="color:#5FBEAA;margin-top: 27px;"></i></a>' +
                '</div>' +
                '<div class="form-group col-xs-3 ">' +
                '<label>الرقم البريدى :</label>' +
                '<input type="number"  name="adresse[' + adresse_rowNum + '][code_tax]"  placeholder="" class="form-control" >' +
                '</div>' +
                '<div class="form-group col-xs-3">' +
                '<label>اسم المدينة :</label>' +
                '<input type="text"  name="adresse[' + adresse_rowNum + '][region]" placeholder="" class="form-control" >' +
                '</div>' +
                '<div class="form-group col-xs-3">' +
                '<label>اسم المحافظة :</label>' +
                '<select  name="adresse[' + adresse_rowNum + '][governorate]"  class="form-control">' +
                    @foreach($governorates as $key => $governorate)
                        '<option value="{{$key}}">{{$governorate}}</option>' +
                    @endforeach
                '</select>' +
                '</div>' +
                '<div class="form-group col-xs-3">' +
                '<label>اسم الدولة :</label>' +
                '<select name="adresse[' + adresse_rowNum + '][country]"  class="form-control">' +
                    @foreach($countries as $key => $country)
                        '<option value="{{$key}}">{{$country}}</option>' +
                    @endforeach
                '</select>' +
                '</div>' +
                '</div>');


            $(".remCF").on('click', function () {
                adresse_rowNum--;
                $(this).parent().parent().remove();
            });

        });

        $("#add_tel").click(function () {
            phone_number_rowNum++;
            $(".tel_block").append('<div class="Tel_add ">' +
                '<div class="form-group col-xs-5 ">' +
                '<input type="number" name="phones['+ phone_number_rowNum +'][phone_number]"  placeholder="" class="form-control ">' +
                '</div>' +
                '<div class="col-xs-1 trash">' +
                '<a href="javascript:void(0);" class="remCF"><i class="fa fa-trash fa-2x " style="color:#5FBEAA;" ></i></a>' +
                '</div>' +
                '</div>');
            $(".remCF").on('click', function () {
                phone_number_rowNum--;
            //    $(this).parent().parent().remove();
            });
        });


        if($("#footer_text").length > 0){
            tinymce.init({
                selector: "textarea#footer_text",
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

        $("#Contact_form").submit(function(e) {
            e.preventDefault();
            $('#Contact_form .ladda-button').ladda('start');
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(data)
                {
                    setTimeout(function () {
                        $('#Contact_form .ladda-button').ladda('stop');
                    },2000)
                    if (isNaN(data)){
                        $.each(data['errors'], function(i, item) {
                            $.Notification.autoHideNotify('error', 'top right', 'Whoops',item);
                        });
                    }else{
                        var fname = $('#Contact_form #first_name').val();
                        $('#contact_id').append('<option value='+ data +'>'+ fname +'</option>');
                        getAddressById(data);
                        jQuery('#Contact_form').trigger( 'reset' );
                        $('#contact_modal').modal('toggle');
                      //  console.log($(this).serialize());
                        $.Notification.autoHideNotify('success', 'top right', 'Saved successfully','Contact Saved successfully You Can Include his to Invoice<br>');
                    }
                },
                error: function(data){
                    setTimeout(function () {
                        $('#Contact_form .ladda-button').ladda('stop');
                    },2000)
                    $.Notification.autoHideNotify('error', 'top right', 'Whoops','Error may be in connection to server<br>');
                }
            });
        })

        $("#product_form").submit(function(e) {
            e.preventDefault();
            $('#product_form .ladda-button').ladda('start');
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(data)
                {
                    setTimeout(function () {
                        $('#product_form .ladda-button').ladda('stop');
                    },2000)
                    if (isNaN(data)){
                        $.each(data['errors'], function(i, item) {
                            $.Notification.autoHideNotify('error', 'top right', 'Whoops',item);
                        });
                    }else{
                        var name = $('#product_form #name').val();
                        $('#' + $('#product_form #field_id').val()).append('<option value='+ data +'>'+ name +'</option>');
                        getProductDetails($('#product_form #field_id').val().replace('product_id',''));
                        jQuery('#product_form').trigger( 'reset' );
                        $('#product_modal').modal('toggle');
                        $.Notification.autoHideNotify('success', 'top right', 'Saved successfully','Product Saved successfully You Can Include his to Invoice<br>');
                    }
                },
                error: function(data){
                    setTimeout(function () {
                        $('#product_form .ladda-button').ladda('stop');
                    },2000)
                    $.Notification.autoHideNotify('error', 'top right', 'Whoops','Error may be in connection to server<br>');
                }
            });
        })
    });

</script>


<script type="text/javascript">
function getContactPhones()
{
  var url = '{{route('sales_invoice.get_contact_phones')}}';

var contact_id= $('#contact_id').val();
  $.ajax({
    type: 'GET',
    url:url,
    data: { id:contact_id},
    success:function(data){
    //  console.log(data);

         $('.printInvoice .contact_phones').append(data);

    }

});

}

    $(function () {
        sumTotals();
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




</script>
@endsection
