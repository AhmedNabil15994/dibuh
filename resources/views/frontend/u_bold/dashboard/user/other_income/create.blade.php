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
            width: 270px !important;
            padding-right: 30px !important;
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
            width: 40%;
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
        
        @media(min-width: 991px){
            #cat-modal .modal-dialog{
                width: 750px;
            }
        }


        .tabs-vertical-env .tab-content{
          width:55% !important;
        }
       
        .units{
            width: 90px !important;
        }
        @media(max-width: 540px){
            .name{
                width: 80%;
            }
            
        }
      
    </style>

@endsection()

@section('subnav')
    @include(Config::get('front_theme').'.dashboard.user.other_income.inc.subnav')
@endsection

@section('content')
    
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
                                            $screen_id = \DB::table('accounts_to_screens')->where('account_id', '=' , $item->id)->where('screen_id' , '=' ,'3')->get();
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
                                            $level= \App\Models\Account::find($item->id)->depth;
                                            $dash=' ';
                                            for($i=1;$i< $level;$i++){
                                                $dash.='--';
                                            } 
                                            $screen_id = \DB::table('accounts_to_screens')->where('account_id', '=' , $item->id)->where('screen_id' , '=' ,'3')->get();
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
                                $accountszx= \DB::table('accounts')->where('category_id' , '=', $row->id)->where('is_major','=',0)->orderBy('lineage','ASC')->join('accounts_to_screens','accounts.id','=','accounts_to_screens.account_id')->where('accounts_to_screens.screen_id' , '=' ,3)->get();  
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
    
    <form class="form-page-create" role="form" id="idform" method="POST" action="{{-- route('other_income.store') --}} ">
        {{ csrf_field() }}
        <input type="hidden" name="old_draft_id" id="old_draft_id" value="-1">
        <div class="col-md-offset-1 col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-toolbar form-group m-b-0">
                        <div class="pull-right">
                            <button  name="submit" data-style="slide-down"  formaction="{{ route('other_income.store_draft') }}" type="submit" class="btn btn-success waves-effect waves-light m-r-5 ladda-button btn-save" led="btn-save">
                                <span class="ladda-label"><i class="fa fa-floppy-o"></i></span>
                                <span class="ladda-spinner"></span>
                            </button>
                            <button type="button" class="btn btn-success waves-effect waves-light m-r-5 btn_delete"><i class="fa fa-trash-o"></i></button>
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
                        <h3 class="pull-left label label-def" data-toggle="customer-row">معلومات عن الفاتورة والعميل</h3>
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
                            <textarea rows="8" class="form-control" type="text" name="address" id="address">{{old('address')? old('address') : ''}}

                            </textarea>
                        </div>

                    </div>

                
                    <div class="col-md-6 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback ">
                                    <label for="invoice_number" class="control-label">رقم الفاتورة :</label>
                                    <input class="form-control" type="text" name="invoice_number" id="invoice_number" placeholder="{{ trans('frontend/sales_invoice.invoice_number')}}">
                                    <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback ">
                                    <label for="invoice_date" class="control-label">تاريخ الفاتورة :</label>{{-- trans('frontend/sales_invoice.invoice_date')--}}
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
                                    <label for="reference_number" class="control-label">رقم المرجع :</label>{{--trans('frontend/sales_invoice.reference_number')--}}
                                    <input class="form-control" type="text" name="reference_number" id="reference_number" placeholder="{{trans('frontend/sales_invoice.reference_number')}}">
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
                        <h3 class="pull-left label label-def" data-toggle="product-row">المنتجات</h3>
                    </div>
                </div>
                <div class="row" id="product-row">
                    <div class="col-md-12 col-xs-12" style="margin-bottom: 15px">
                           <div class="mytable table-responsive">
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
                           
                            <tbody >
                                <?php $index = 0 ?>
                                    <?php $index++ ?>
                                    <tr class="tab-row{{$index}}">
                                        <td>
                                            <span>{{$index}}</span>
                                        </td>
                                        <td >
                                            <div class="col-md-12" style="padding: 0;">
                                                <input type="text" class='product_name  form-control' name='details[{{$index}}][product_name]' id='product_name{{$index}}' placeholder="حدد المنتج" value="{{isset($product['product_name'])  ? $product['product_name'] : ''}}">
                                                   
                                              
                                            </div>
                                        </td>

                                        <td id='td_account_{{$index}}'>
                                            <div class='col-md-12' style='padding: 0;'>
                                                <select class="form-control account_id select2" value1="{{$index}}" type="text" name="details[{{$index}}][account]" id="account_id{{$index}}" style="position: relative; padding-right: 25px;">
                                                </select>    
                                                <button class="btn btn-xs choose" value1="{{$index}}" style="position: absolute;top: 5px;right: 5px; width: 20px;"><i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <input type="hidden" name="details[{{$index}}][account_id]" class="checkID{{$index}}">
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
                                            @if(isset($product['tax']) && count($product['tax'])>1)
                                                <?php $counter = 0 ?>
                                                @foreach($product['tax'] as $tax_row)
                                                        <?php $counter++ ?>
                                                    <div class="form-group has-feedback col-md-12">
                                                        <input class="form-control tax_txt" type="text" name="details[{{$index}}][tax][tax_{{$counter}}][val]" id="tax_{{$index}}_{{$counter}}" value="{{isset($tax_row["val" ])? $tax_row["val"] : 0}}" data-taxTypeName="{{isset( $tax_row['name']) ?  $tax_row['name'] : 0}}" data-taxTypeid="{{isset($tax_row['id']) ? $tax_row['id'] : -1}}" data-taxTypeSign="{{isset($tax_row['sign']) ? $tax_row['sign'] : '+'}}" placeholder="{{trans('frontend/sales_invoice.tax')}}" onkeyup="changeDetails({{$index}})" >
                                                        {{$tax_row['name']}}
                                                    </div>
                                                @endforeach()
                                            @else
                                                <div class='form-group has-feedback col-md-12'>
                                                    <input class='form-control tax_txt' type='text' name="details[{{$index}}][tax][tax_1][val]" id='tax_1_1' value='{{isset($product['tax']['tax_1']['val']) ? $product['tax']['tax_1']['val'] : 0}}' placeholder='{{trans('frontend/sales_invoice.tax')}}' onkeyup='changeDetails({{$index}})' >
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-group has-feedback ">
                                                <input class="form-control amount_txt" type="text" name="details[{{$index}}][amount]" id="amount_{{$index}}" value="{{isset($product['amount']) ? $product['amount'] : 0.00}}" placeholder="{{trans('frontend/sales_invoice.amount')}}" readonly>
                                            </div>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                           
                            
                            </tbody>
                        </table>

                        </div>
                        <a href="javascript:void(0);" id="addCF">+إضافه منتج</a>
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
                            <div class="col-xs-6 text-right" ><span id="netPrice">{{old('netPrice')?old('netPrice') : ''}}</span> جنيه مصري </div>
                        </h5>
                    </div>
                    <hr />

                    <div class="row with-border-dotted">
                        <h5 class="totals">
                            <div class="col-xs-6 text-left">اجمالي الخصم</div>
                            <div class="col-xs-6 text-right" ><span id="discount">{{old('total_discount')?old('total_discount'):''}}</span> جنيه مصري </div>
                        </h5>
                    </div>
                    <hr />    
                    
                    <div class="row with-border-dotted">
                        <h5 class="totals">
                            <div class="col-xs-6 text-left">بعد  الخصم</div>
                            <div class="col-xs-6 text-right" ><span id="totalAmount">{{old('total_amount')?old('total_amount'):'0'}}</span> جنيه مصري </div>
                        </h5>
                    </div>
                    <hr />    
                    <input type="hidden" name="acc_id">
                    @foreach($taxes as $k=>$v)
                    <div id="tax_total_row_{{$v->id}}"  class="tax_types">
                        <div class="row with-border-dotted">
                            <h5 class="totals">
                                <div class="col-xs-6 text-left">{{ $v->name }}</div>
                                <div class="col-xs-6 text-right" >
                                    <span id="tax_type_{{$v->id}}" date-TotalTaxTypeId="{{$v->id}}"  data-taxTypeVal="0">{{isset(old('tax_totals')['id_'.$k]) ? old('tax_totals')['id_'.$k] : 0}}</span> جنيه مصري
                                    <input type="hidden" name="tax_totals[id_{{$v->id}}]" id="tax_totals_id_{{$v->id}}" value="{{isset(old('tax_totals')['id_'.$k]) ? old('tax_totals')['id_'.$k] : 0}}">
                                    {{--{{dd(old('tax_totals')['id_1'])}}--}}
                                </div>
                            </h5>
                        </div>
                        <hr />
                    </div>
                    @endforeach 
         
                    <div class="row">
                        <h5 class="totals bold">
                            <div class="col-xs-6 text-left">الاجمالي</div>
                            <div class="col-xs-6 text-right" ><span id="totalInvoice">{{old('total_invoice')?old('total_invoice'):'0'}}</span> جنيه مصري </div>
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
                            <button  name="submit" data-style="slide-down"  formaction="{{ route('other_income.store_draft') }}" type="submit" class="btn btn-success waves-effect waves-light m-r-5 ladda-button btn-save" led="btn-save">
                                <span class="ladda-label"><i class="fa fa-floppy-o"></i></span>
                                <span class="ladda-spinner"></span>
                            </button>
                            <a href="javascript:void(0)" class="btn btn-success waves-effect waves-light m-r-5 btn_delete"><i class="fa fa-trash-o"></i></a>
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

    <div id="contact_modal" class="modal fade" taex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
        @include(Config::get('front_theme').'.dashboard.user.other_income.inc.create_contact_modal')
    </div><!-- /.modal -->

    <div id="product_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
        @include(Config::get('front_theme').'.dashboard.user.other_income.inc.create_product_modal')
    </div><!-- /.modal -->

    <!-- Modal -->
        {{--<div id="create_model" class="modal-demo">--}}
            {{--<button type="button" class="close" onclick="Custombox.close();">--}}
                {{--<span>&times;</span><span class="sr-only">Close</span>--}}
            {{--</button>--}}
            {{--<h4 class="custom-modal-title">Add Contact</h4>--}}
            {{--<div class="custom-modal-text text-left">--}}
                {{--<form role="form">--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="name">Name</label>--}}
                        {{--<input type="text" class="form-control" id="name" placeholder="Enter name">--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="position">Position</label>--}}
                        {{--<input type="text" class="form-control" id="position" placeholder="Enter position">--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="company">Company</label>--}}
                        {{--<input type="text" class="form-control" id="company" placeholder="Enter company">--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="exampleInputEmail1">Email address</label>--}}
                        {{--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">--}}
                    {{--</div>--}}

                    {{--<button type="submit" class="btn btn-default waves-effect waves-light">Save</button>--}}
                    {{--<button type="button" class="btn btn-danger waves-effect waves-light m-l-10">Cancel</button>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}


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
            var index ;
    jQuery(document).ready(function($) {

        $(".select2").select2();
        $('.tab-pane:first-of-type').addClass('active');
        $('.tab-pane:first-of-type').removeClass('fade');
        $('#invoice_number').val("");
        
        $(document).on('click','.choose',function(e){
            e.preventDefault();
            $('#cat-modal').modal({ backdrop: 'static', keyboard: false });
            index = $(this).attr('value1');
        });

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
        

        var l = $('.ladda-button').ladda();
        
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
                url: "{{route('other_income.get_account_json') }}" ,
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


        var rowNum = 1;
        $("#addCF").click(function () {
            rowNum++;
            //$("#customFields tbody").find('.account_id').select2('destroy');
            //$('.account_id').select2();
           //$('.new').select2();
            //var listRow = 'details' + '[' + rowNum + ']';
            $("#customFields tbody").append("<tr class='tab-row"+rowNum+"'>" 
                        +"<td></td>" 
                        +"<td>"
                            +"<div class='col-md-12' style='padding: 0;'>"
                                +"<input type='text' class='product_name form-control' name='details[" + rowNum + "][product_name]' id='product_name" + rowNum + "' placeholder='حدد المنتج' value=''>"
                           +"</div>"
                        +"</td>" 
                        +"<td id='td_account_" + rowNum + "'>" 
                            +"<div class='col-md-12' style='padding: 0;'>"
                                +"<select class='form-control account_id new select2' value1="+rowNum+" type='text' name='details["+rowNum+"][account]' id='account_id"+rowNum+"' style='position: relative; padding-right: 25px;'>"
                                +"</select>"
                                +"<button class='btn btn-xs choose' value1="+rowNum+" style='position: absolute;top: 5px;right: 5px; width: 20px;'><i class='fa fa-ellipsis-v'></i>"
                                +"</button>"            
                                +"<input type='hidden' name='details["+rowNum+"][account_id]' class='checkID"+rowNum+"'>"     
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
            $('.new').select2();
            $('.new').select2({
                language:optsss.language,
                tags: false,
                dir: "rtl",
                multiple: false,
                tokenSeparators: [',', ''],
                minimumInputLength: 1,
                minimumResultsForSearch: 10,
                ajax: {
                    url: "{{route('other_income.get_account_json') }}" ,
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

            $('.new').on('change',function(){
                var row = $(this).attr('value1');
                $('.checkID'+row).val($(this).val());
                getInfo('#account_id'+row);
            });
            //getProduct();

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
                url: "{{route('other_income.get_contact_json') }}" ,
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
        })

        $("#idform").submit(function(e) {
                if ($(this).attr('state') == 'draft'){
                    e.preventDefault();
                    $('.alerts').html('');
                    $('.ladda-button[led="btn-save"]').ladda('start');
                    var url = "{{ route('other_income.store_draft') }}"; // the script where you handle the form input.--}}
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(data)
                        {
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
                                $('#old_draft_id').val(data);
                                $.Notification.autoHideNotify('success', 'top right', 'Saved successfully','Invoice Saved successfully In Other Incomes if you show it in Other Incomes<br>');
                                window.location.href = "{{URL::to('dashboard/other_income/list')}}";
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
        })

        $('.BtnSend').on('click',function () {
            $('.alerts').html('');
            $('.ladda-button[led="BtnSend"]').ladda('start');
            var url = "{{ route('other_income.invoice_validation') }}";
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
                        $('.printInvoice #customerAddress').html('<pre>' + $('#address').val() + '</pre>');
                        $('.printInvoice #invoiceDate').html($('#invoice_date').val());
                        $('.printInvoice #invoiceNumber').html($('#invoice_number').val());
                        $('.printInvoice #totalsRow').html($('.page-create #totals-row').html());
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
                        $('#invoice_modal').modal('show');
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

        $('#btnSavePrint , #btndownloadPrint , #btnSendmailPrint').on('click' , function () {
            $('.alerts').html('');
            var led = $(this).attr('led')
            var lada = '.ladda-button[led="' + led + '"]'
            $(lada).ladda('start');
            var url = "{{ route('other_income.store') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#idform").serialize(),
                success: function(data)
                {
                    setTimeout(function () {
                        $(lada).ladda('stop');
                    },2000)
                    if (isNaN(data)){
                        $.each(data['errors'], function(i, item) {
                            $.Notification.autoHideNotify('error', 'top right', 'Whoops',item);
                        });
                    }else{
                        var mode = 'iframe'; //popup
                        var close = mode == "popup";
                        var options = { mode : mode, popClose : close};

                        if (led == 'btnSavePrint'){
                            $("div.printAreaInvoice").printArea( options );

                        }else if(led == 'btndownloadPrint'){

                        }else if(led == 'btnSendmailPrint'){

                        }

                        setTimeout(function() {
                            window.location.href = "{{route('other_income.index')}}";
                        }, 2500);
                        $.Notification.autoHideNotify('success', 'top right', 'Saved successfully','Invoice Saved successfully<br>');
                    }
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
    function getAddressById(id) {
        var e = document.getElementById("contact_id");
        var contactID = id || e.options[e.selectedIndex].value;
        var contactName = e.options[e.selectedIndex].text;
        $('#contact_name').val(contactName);
        var url = '{{ route("other_income.get_one_contact_address", ":contact_id") }}';
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
    }


    function getAccountDetails(num) {
        var e = document.getElementById("account_id"+num);
        var accountID = e.options[e.selectedIndex].value;

        $.ajax({
            type: 'GET',
            url: '{{route('other_income.get_account_data')}}',
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
               var url = '{{route('other_income.get_account_data')}}';
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
        var url = '{{route('other_income.get_tax_fields_view')}}';
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

    function getInfo(element){
        var id = $(element).val();
        var number = $(element).attr('value1');
        getTaxFields( id,number);
        $('input[name="acc_id"]').val(id);        
    }
    function changeDetails(num) {
        var price = Number($("#price_"+num).val());
        var quantity = Number($("#quantity_"+num).val());
        var net_price=price*quantity;
        var discount_amount=  (Number($("#discount_"+num).val())/100) * net_price ;
        var totalAmount =Number( net_price  - discount_amount); //+ sumOfTaxes
        $('#amount_after_discount_'+num).val(totalAmount);
        // get count of tax input inside "#td_tax_num"
//        var taxCount=$("#td_taxes_"+num).children().length; // get number of elements of #td_taxes_num
        var sumOfTaxes=0;
        $("#td_taxes_"+ num + " input[type!='hidden']").each(function() {
            var object = $(this);
            if (object.attr('data-taxTypeSign') == '-'){
                sumOfTaxes+= -1 * (totalAmount * (object.val() / 100));
            }else{
                sumOfTaxes+=  1 * (totalAmount * (object.val() /100));
            }
            var id = object.attr('data-taxtypeid');
            $('#tax_total_row_' +id).removeClass('hidden');
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
        @foreach($taxes as $k=>$v)
            taxTypeArr.push({{$v->id}});
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
                totalOfTaxes[taxTypeRow[objTaxType[i]]]+= 1 * ( (Number(amount)-((Number(discount_row)/100) * net_price))  * taxRate[i]/100);
                $('#tax_type_'+ object.attr('data-taxtypeid')).html(totalOfTaxes[taxTypeRow[objTaxType[i]]]); //change the attribute
                $('#tax_type_'+ object.attr('data-taxtypeid')).attr('data-taxtypeval' , totalOfTaxes[taxTypeRow[object.attr('data-taxTypeId')]]); //change the attribute
                $('#tax_totals_id_'+ object.attr('data-taxtypeid')).val(totalOfTaxes[taxTypeRow[objTaxType[i]]]);


//                if (object.attr('data-taxTypeSign') == '-'){
//                    sumOfTaxes+= -1 * ((Number(amount)-((Number(discount_row)/100) * net_price)) * (object.val() / 100));
//                }else{
//                    sumOfTaxes+=  1 * ((Number(amount)-((Number(discount_row)/100) * net_price)) * (object.val() /100));
//                }
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
//        $('#countOfUnits').html(quantity);
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
        $('#net_Price').val(Number(totalCost).toFixed(2));
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
        var url = '{{ route("other_income.get_contact_address", ":contact_id") }}';
        url = url.replace(":contact_id", contactID);

        $('#addressModal').on('show.bs.modal', function (e) {
            $(this).find('.modal-body').load(url);
        });

    }
    function setAddress(id){
        var url = '{{ route("other_income.get_contact_address_by_id", ":contact_id") }}';
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
                if (element != null){
                    
                    element.innerHTML = document.createElement("div").innerHTML = '<a href="#contact_modal" id="BtnAddNewContact" class="btn btn-default waves-effect waves-light m-r-20" data-toggle="modal" data-target="#contact_modal" data-overlayColor="#36404a"><i class="fa fa-plus-square"></i> إضافة عميل جديد</a>';
                    $('#Contact_form #first_name').val( $("#contact_id").data('select2').$dropdown.find("input").val())
                   
                }else{
                    var element2 = $("[id^='select2-product_id'][id$='-results']");
                    var id =element2.attr('id').replace('select2-','').replace('-results','');
                    $('#product_form #field_id').val(id);
                    var v = $('.select2-search__field')[0].value;
//                    var ul = "<ul>" +
//                                "<li>" + $("#" + id).data('select2').$dropdown.find("input").val()  + "</li>"+
//                            "</ul>"
//                    var op = "<option value='"+1+"' >"+ $("#" + id).data('select2').$dropdown.find("input").val() +"</option>";
//                    $("#" + id).append(op)
//                    $("#" + id).html(null);
//                    $("#" + id).append('<option value="0">' + $("#" + id).data('select2').$dropdown.find("input").val() + '</option>')
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
                $(this).parent().parent().remove();
            });
        });


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
                        $('#contact_id').append('<option value='+ data +' selected>'+ fname +'</option>');
                        getAddressById(data);
                        jQuery('#Contact_form').trigger( 'reset' );
                        $('#contact_modal').modal('toggle');
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


