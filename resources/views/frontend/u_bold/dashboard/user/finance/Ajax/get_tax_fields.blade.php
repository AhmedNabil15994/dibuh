          
<?php
$count_tax = isset($accounts) && $accounts != null ? count($accounts->taxes) : 0;

if ($count_tax > 0)
    $col = 12 / $count_tax;
$counter = 1;
?>

@if( $count_tax > 0)

@foreach($accounts->taxes as $tax)
<!--        <div class="form-group has-feedback col-md-{{$col}}">-->
<div class="form-group has-feedback col-md-12">
    <input class="form-control tax_txt" type="text" name="details[{{$rowNum}}_{{$counter}}][tax]" id="tax_{{$rowNum}}_{{$counter}}" value="{{$tax->rate}}" data-taxTypeName="{{$tax->taxType->name}}" data-taxTypeid="{{$tax->taxType->id}}" data-taxTypeSign="{{$tax->taxType->sales_sign}}" placeholder="{{trans('frontend/sales_invoice.tax')}}" onkeyup="changeDetails({{$rowNum}})" >
</div>
<?php $counter++; ?>
@endforeach

@else
<div class="form-group has-feedback col-md-12">
    <input class="form-control tax_txt" type="text" name="details[{{$rowNum}}_1][tax]" id="tax_{{$rowNum}}_1" value="0.00" placeholder="{{trans('frontend/sales_invoice.tax')}}" onkeyup="changeDetails({{$rowNum}})" >
</div>
@endif
