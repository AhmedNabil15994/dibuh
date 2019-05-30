          
<?php
$count_tax = isset($accounts) && $accounts != null ? count($accounts->taxes) : 0;

if ($count_tax > 0){$col = 12 / $count_tax;}
$counter = 1;
?>

@if( $count_tax > 0)
    @foreach($accounts->taxes as $tax)
        <!--        <div class="form-group has-feedback col-md-{{$col}}">-->
        <div class="form-group has-feedback col-md-12">
            {{--<input class="form-control tax_txt" type="text" name="details[{{$rowNum}}_{{$counter}}][tax]" id="tax_{{$rowNum}}_{{$counter}}" value="{{$tax->rate}}" data-taxTypeName="{{$tax->taxType->name}}" data-taxTypeid="{{$tax->taxType->id}}" data-taxTypeSign="{{$tax->taxType->sales_sign}}" placeholder="{{trans('frontend/sales_invoice.tax')}}" onkeyup="changeDetails({{$rowNum}})" >--}}
            <input class="form-control tax_txt" type="text" name="details[{{$rowNum}}][tax][tax_{{$counter}}][val]" id="tax_{{$rowNum}}_{{$counter}}" value="{{$tax->rate}}" data-taxTypeName="{{$tax->taxType->name}}" data-taxTypeid="{{$tax->taxType->id}}" data-taxTypeSign="{{$tax->taxType->sales_sign}}" placeholder="{{trans('frontend/sales_invoice.tax')}}" onkeyup="changeDetails({{$rowNum}})" >
            <input type="hidden" name="details[{{$rowNum}}][tax][tax_{{$counter}}][id]" id="tax_{{$rowNum}}_{{$counter}}_id" value="{{$tax->taxType->id}}">
            <input type="hidden" name="details[{{$rowNum}}][tax][tax_{{$counter}}][name]" id="tax_{{$rowNum}}_{{$counter}}_name" value="{{$tax->taxType->name}}">
            <input type="hidden" name="details[{{$rowNum}}][tax][tax_{{$counter}}][sign]" id="tax_{{$rowNum}}_{{$counter}}_sign" value="{{$tax->taxType->sales_sign}}">
        </div>
        <?php $counter++; ?>
    @endforeach
@else
    <div class="form-group has-feedback col-md-12">
        <input class="form-control tax_txt" type="text" name="details[{{$rowNum}}][tax][tax-1][val]" id="tax_{{$rowNum}}_1" value="0.00" placeholder="{{trans('frontend/sales_invoice.tax')}}" onkeyup="changeDetails({{$rowNum}})" >
    </div>
@endif
