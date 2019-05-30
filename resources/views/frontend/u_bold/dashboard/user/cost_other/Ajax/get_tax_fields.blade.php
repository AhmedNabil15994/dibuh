<?php
$count_tax = isset($accounts) && $accounts != null ? count($accounts->taxes) : 0;

if ($count_tax > 0){$col = 12 / $count_tax;}
$counter = 1;
$i=1;
?>

@if( $count_tax > 0)
    @foreach($accounts->taxes as $tax)
        <!--        <div class="form-group has-feedback col-md-{{$col}}">-->
        <div class="form-group has-feedback col-md-12">
            <input class="form-control tax_txt" type="text" name="details[{{$rowNum}}][tax][tax_{{$counter}}][val]" id="tax_{{$rowNum}}_{{$counter}}" value="{{$tax->rate}}" data-taxTypeName="{{$tax->name}}" data-taxTypeid="{{$tax->id}}" data-taxTypeSign="{{$tax->sales_sign}}" placeholder="{{trans('frontend/sales_invoice.tax')}}" onkeyup="changeDetails({{$rowNum}})" >
            <input type="hidden" name="tax_id[{{$rowNum}}][{{$i}}]" id="tax_{{$rowNum}}_{{$counter}}_id" value="{{$tax->id}}">
            <input type="hidden" name="tax_rate[{{$rowNum}}][{{$i}}]" id="tax_{{$rowNum}}_{{$counter}}_id" value="{{$tax->rate}}">
            <input type="hidden" name="tax_name[{{$rowNum}}][{{$i}}]" id="tax_{{$rowNum}}_{{$counter}}_name" value="{{$tax->name}}">
            <input type="hidden" name="tax_sign[{{$rowNum}}][{{$i}}]" id="tax_{{$rowNum}}_{{$counter}}_sign" value="{{$tax->taxType->sales_sign}}">
           <input type="hidden" name='account_taxes[{{$i}}]' value="{{$tax->taxType->id}}">
        </div>
        <?php $counter++; $i++;?>
    @endforeach
@else
    <div class="form-group has-feedback col-md-12">
        <input class="form-control tax_txt" type="text" name="details[{{$rowNum}}][tax][tax-1][val]" id="tax_{{$rowNum}}_1" value="0.00" placeholder="{{trans('frontend/sales_invoice.tax')}}" onkeyup="changeDetails({{$rowNum}})" >
    </div>
@endif


