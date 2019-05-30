@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')






@section('module_breadcrumb')
<li><a href="{{ route('sales_invoice.index') }}"> {{trans('frontend/dashboard.sales_invoice')}} </a></li>            
<li class="active"> {{trans('frontend/sales_invoice.edit')}} </li>
@endsection

@section('page-scripts')
<script>
    var rowNum = {{$details_count}};
    $(document).ready(function () {
        $("#addCF").click(function () {
            rowNum++;


            var listRow = 'details' + '[' + rowNum + ']';
            //     alert(listRow);
            $("#customFields").append("<tr valign='top'>" +
                    "<td><input type='text' value=" + rowNum + " name='row_num[]' id='row_num' class='form-control'' ></td>" +
                    //placeholder='{{trans('frontend/sales_invoice.product_id')}}'

                    "<td><select name=" + listRow + "[product_id] class='product_id form-control' onchange ='getProductName(" + rowNum + ",this);'>  " +
                    "<option value=''>{{ trans('master.select_item_from_list') }}</option>" +
<?php foreach ($products as $k => $v) { ?>
                "<option value='<?php echo $k ?>'><?php echo $v ?></option>" +
<?php } ?>
            "</select></td>" +
                    "<td><input type='text' value='' name=" + listRow + "[product_name]  class='form-control' placeholder='{{trans('frontend/sales_invoice.product_name')}}' id='product_name_" + rowNum + "' ></td>" +
                    "<td><input type='text' value=0 name=" + listRow + "[quantity]  class='form-control' placeholder='{{trans('frontend/sales_invoice.quantity') }}' id='quantity_" + rowNum + "' onchange='calculateSum(" + rowNum + ");' ></td>" +
                    "<td><select name=" + listRow + "[unit_id] class='form-control'' >" +
                    "<option value=''>{{ trans('master.select_item_from_list') }}</option>" +
<?php foreach ($unit as $k => $v) { ?>
                "<option value='<?php echo $k ?>'><?php echo $v ?></option>" +
<?php } ?>
            "</select></td>" +
                    "<td><input type='text' value=0 name=" + listRow + "[price] class='form-control'' placeholder='{{trans('frontend/sales_invoice.price')}}' id='price_" + rowNum + "' onchange='calculateSum(" + rowNum + ");' ></td>" +
                    "<td><input type='text' value=0 name=" + listRow + "[row_price] class='row_price_txt form-control'' placeholder='{{trans('frontend/sales_invoice.price')}}' id='row_price_" + rowNum + "' onchange='calculateSum(" + rowNum + ");' readonly='yes' ></td>" +
                    "<td>\n\
                        <input type='text' value=0 name=" + listRow + "[tax] class='tax_txt form-control' placeholder='{{trans('frontend/sales_invoice.tax')}}' id='tax_" + rowNum + "' onchange='calculateSum(" + rowNum + ");'>\n\
                        <input type='hidden' value=0 name=" + listRow + "[row_tax] class='row_tax_txt form-control'' placeholder='{{trans('frontend/sales_invoice.tax')}}' id='row_tax_" + rowNum + "' onchange='calculateSum(" + rowNum + ");' >" +
                    "</td>" +
                    "<td><input type='text' value=0 name=" + listRow + "[discount] class='discount_txt form-control' placeholder='{{trans('frontend/sales_invoice.discount')}}' id='discount_" + rowNum + "' onchange='calculateSum(" + rowNum + ");'></td>" +
                    "<td><input type='text' value=0 name=" + listRow + "[amount] class='amount_txt form-control' placeholder='{{trans('frontend/sales_invoice.amount')}}' id='amount_" + rowNum + "' readonly='yes' ></td>" +
                    "<td><a href='javascript:void(0);' class='remCF'><i class='fa fa-trash fa-2x'></i></a></td>" +
                    "</tr>"
                    );
                    $("#items_count").val(rowNum);

            $(".remCF").on('click', function () {
                $(this).parent().parent().remove();
            });

        });



        $('#contact_id').on('change', function (e) {
            var contactID = e.target.value

            $('#contact_name').empty();

            $.ajax({
                url: "{{route('sales_invoice.get_contact_data')}}",
                data: {contactID: contactID},
                dataType: "json",
            }).done(function (response) {

                obj = response[0];
                $("#contact_name").val(obj.full_name);
            });
        });


    });

    function getProductName(indexRow, sel) {

        var productID = sel.value;
        var indexRow = indexRow;
        $('#product_name_' + indexRow).empty();

        $.ajax({
            url: "{{route('sales_invoice.get_product_data')}}",
            data: {productID: productID},
            dataType: "json",
        }).done(function (response) {
            var obj = response[0];

            $('#product_name_' + indexRow).val(obj['name']);
        });

    }

    function calculateSum(indexRow) {

        var amount = 0;
        var total_price = 0;
        var total_tax = 0;
        var total_discount = 0;
        var total_discount = 0;
        var net_amount = 0;

        var quantity = parseFloat($('#quantity_' + indexRow).val());
        var price = parseFloat($('#price_' + indexRow).val());
        var tax = (parseFloat($('#tax_' + indexRow).val())) / 100;
        var discount = parseFloat($('#discount_' + indexRow).val());
        var amount = parseFloat($('#amount_' + indexRow).val());

        var row_price = quantity * price;
        var row_tax = row_price * tax;
        //amount = (row_price - row_tax) - discount;
        amount = ((quantity * price) - ((quantity * price) * tax)) - discount;

        $('#row_price_' + indexRow).val(row_price.toFixed(2));
        $('#row_tax_' + indexRow).val(row_tax.toFixed(2));

        //.toFixed() method will roundoff the final sum to 2 decimal places
        $('#amount_' + indexRow).val(amount.toFixed(2));


        //iterate through each textboxes for Price in the grid and add the values
        $('.row_price_txt').each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                total_price += parseFloat(this.value);
            }

        });
        $('#total_price').val(total_price.toFixed(2));
        //************************************************************************

        //iterate through each textboxes for Tax in the grid and add the values
        $('.row_tax_txt').each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                total_tax += parseFloat(this.value);
            }

        });
        $('#total_tax').val(total_tax.toFixed(2));
        //************************************************************************        
        //
        //iterate through each textboxes for Tax in the grid and add the values
        $('.discount_txt').each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                total_discount += parseFloat(this.value);
            }

        });
        $('#total_discount').val(total_discount.toFixed(2));
        //************************************************************************     
        //
        //iterate through each textboxes for Amount in the grid and add the values
        $('.amount_txt').each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                net_amount += parseFloat(this.value);
            }
        });
        $('#net_amount').val(net_amount.toFixed(2));
        //************************************************************************
    }
    //================================================================================================
    //  startUp fn to loop and call calculateSum(rowIndex);    
    function startUp(  details_count ){
        for (i = 1; i <= details_count; i++) { 
                    calculateSum(i) ;
                }
    }
    // call startUp fn when page load;
     startUp({{$details_count}} );
    //================================================================================================     
</script>	
@endsection

@section('content_dashboard')
<!-- right column -->

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
<h3>{{trans('frontend/sales_invoice.create_new')}}</h3>
<hr>    

{!! Form::model($data, ['method' => 'PATCH','route' => ['sales_invoice.update', $data->id]]) !!}
<div class="col-lg-5">
    <div class="form-group ">
        <label class="col-lg-5 control-label">     {{ trans('frontend/sales_invoice.invoice_number')}} :</label>
        <div class="col-lg-7">
            {!! Form::text('invoice_number', null, array('placeholder' => trans('frontend/sales_invoice.invoice_number'),'class' => 'form-control' )) !!}                        
        </div>
    </div>    

</div>

<div class="col-lg-7">
    <div class="form-group ">
        <label class="col-lg-4 control-label">     {{ trans('frontend/sales_invoice.invoice_date')}} :</label>
        <div class="col-lg-8">
            {!! Form::text('invoice_date', null, array('placeholder' => trans('frontend/sales_invoice.invoice_date'),'class' => 'form-control' )) !!}                        
        </div>
    </div>      

</div>


<div class="col-lg-5">
    <label class="col-lg-5 control-label">{{ trans('frontend/sales_invoice.contact_id')}} :</label>    
    {!! Form::select('contact_id', 
    (['' =>  trans('master.select_item_from_list') ] + $contacts), 
    null, 
    ['id'=>'contact_id', 'class' => 'form-control col-lg-7 select2','style'=>'width:180px;margin-right:18px']) !!}    
</div>



<div class="col-lg-7">
    <div class="form-group">
        <label class="col-lg-4 control-label">{{ trans('frontend/sales_invoice.contact_name')}} :</label>
        <div class="col-lg-8">
            {!! Form::text('contact_name', null, array('placeholder' => trans('frontend/sales_invoice.contact_name'),'id'=>'contact_name','class' => 'form-control' )) !!}                        
        </div>
    </div>    
</div>


<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/sales_invoice.address')}} :</label>
    <div class="col-lg-8">
        {!! Form::text('address', null, array('placeholder' => trans('frontend/sales_invoice.address'),'class' => 'form-control' )) !!}                        
    </div>
</div>


<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/sales_invoice.header_text')}} :</label>
    <div class="col-lg-8">
        {!! Form::text('header_text', null, array('placeholder' => trans('frontend/sales_invoice.header_text'),'class' => 'form-control' )) !!}                        
    </div>
</div> 


<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/sales_invoice.footer_text')}} :</label>
    <div class="col-lg-8">
        {!! Form::text('footer_text', null, array('placeholder' => trans('frontend/sales_invoice.footer_text'),'class' => 'form-control' )) !!}                        
    </div>
</div> 



<div class="col-lg-12">

    <table class="form-table" id="customFields">
        <thead valign="top">
        <td>
            No.
        </td>
        <td>
            Product Id
        </td>
        <td>
            Product Name
        </td>
        <td>
            Quantity
        </td>
        <td>
            Unit
        </td>            
        <td>
            Price
        </td>
        <td>
            Row Price
        </td>        
        <td>
            Tax(%)
        </td>        
        <td>
            Discount
        </td>          
        <td>
            Amount
        </td>
        <td>
            Action
        </td>        
        </thead>
        
        <?php $index=1?>
        @foreach ($data->invoiceItems as $row)
        <tr valign="top" class="tblRow">

            <td><input type="text" value="{{$index}}" name="row_num" id="row_num" class="form-control" ></td>

            <td> 

<!--                <input type="text"  name='details[1][product_id]' id='product_id' placeholder="{{trans('frontend/sales_invoice.product_id') }}" class="form-control" >-->

                {!! Form::select('details['.$index.'][product_id]', 
                (['' =>  trans('master.select_item_from_list') ] + $products), 
                $row->product_id, 
                ['id'=>'product_id', 'class' => 'product_id form-control col-lg-7 select2','style'=>'width:180px;','onchange' =>'getProductName(1,this);']) !!}                    
            </td>
            <td>
                {!! Form::text('details['.$index.'][product_name]', $row->product_name, array('id'=>'product_name_1','placeholder' => trans('frontend/sales_invoice.product_name'),'class' => 'form-control' )) !!}                        
            </td>
            <td>
                {!! Form::text('details['.$index.'][quantity]', $row->quantity, array('placeholder' => trans('frontend/sales_invoice.quantity'),'id'=>'quantity_'.$index.'','class' => 'form-control ' ,'onchange'=>'calculateSum('.$index.');')) !!}                                        
            </td>
            <td>
                <div class="form-group">
                    {!! Form::select('details['.$index.'][unit_id]', 
                    (['' =>  trans('master.select_item_from_list') ] + $unit), 
                    $row->unit_id, 
                    ['class' => 'form-control select2']) !!}  

                </div>
            </td>                    
            <td>{!! Form::text('details['.$index.'][price]', $row->price, array('placeholder' => trans('frontend/sales_invoice.price'),'id'=>'price_'.$index.'','class' => 'form-control' ,'onchange'=>'calculateSum('.$index.');' )) !!}</td>
            <td>{!! Form::text('details['.$index.'][row_price]', 0, array('placeholder' => trans('frontend/sales_invoice.price'),'id'=>'row_price_'.$index.'','class' => 'row_price_txt form-control' ,'onchange'=>'calculateSum('.$index.');','readonly'=>'yes' )) !!}</td>            
            <td>
                {!! Form::text('details['.$index.'][tax]', $row->tax, array('placeholder' => trans('frontend/sales_invoice.tax'),'id'=>'tax_'.$index.'','class' => 'tax_txt form-control' ,'onchange'=>'calculateSum('.$index.');')) !!}
                {!! Form::hidden('details['.$index.'][row_tax]', 0, array('placeholder' => trans('frontend/sales_invoice.tax'),'id'=>'row_tax_'.$index.'','class' => 'row_tax_txt form-control' ,'onchange'=>'calculateSum('.$index.');')) !!}                               
            </td>
            <td>{!! Form::text('details['.$index.'][discount]', $row->discount, array('placeholder' => trans('frontend/sales_invoice.discount'),'id'=>'discount_'.$index.'','class' => 'discount_txt form-control' ,'onchange'=>'calculateSum('.$index.');')) !!}</td>
            <td>{!! Form::text('details['.$index.'][amount]', $row->amount, array('placeholder' => trans('frontend/sales_invoice.amount'),'id'=>'amount_'.$index.'','class' => 'amount_txt form-control' ,'readonly'=>'yes')) !!}</td>
            <td>
                @if($index==1)
                    <a href="javascript:void(0);" id="addCF"><i class="fa fa-plus-circle fa-2x "></i></a>
                @else                
                    <a href='javascript:void(0);' class='remCF'><i class='fa fa-trash fa-2x'></i></a>
                @endif
                
                
            </td>

        </tr>
        {{$index++}}
        @endforeach

        <tfoot>
            <tr><td>Total Price</td><td><input type="text" value="0" name='total_price' id='total_price'   class='form-control' readonly="yes" ></td></tr>
            <tr><td>Total Tax</td><td><input type="text" value="0" name='total_tax' id='total_tax'   class='form-control' readonly="yes"></td></tr>
            <tr><td>Total Discount</td><td><input type="text" value="{{$data->discount}}" name='total_discount' id='total_discount'   class='form-control'readonly="yes" ></td></tr>
            <tr><td>Net Amount</td><td><input type="text" value="{{$data->net_amount}}" name='net_amount' id='net_amount'   class='form-control' readonly="yes"></td></tr>
            <tr><td>items Count</td><td><input type="text" value="{{$details_count}}" name='items_count' id='items_count'   class='form-control' readonly="yes"></td></tr>      
        </tfoot>
    </table>    
</div>











<div class="form-group">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-8">
        <input type="submit" class="btn btn-primary" value="{{trans('button.save')}}">         
        <a class="btn btn-danger pull-left" href="{{ route('sales_invoice.index') }}"> {{trans('button.cancel')}}</a>           


    </div>
</div>
{!! Form::close() !!}




<!-- End Section Main Content -->	
@endsection