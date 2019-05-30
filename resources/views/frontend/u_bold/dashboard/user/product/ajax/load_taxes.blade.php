 
@if(count($accountTax) >0)
<div class="col-md-12  "style="border-bottom: 1px solid #999;padding-bottom: 3px;margin-bottom: 4px;" >
    <div class="col-md-5">    
        الضريبة
    </div>
    <div class="col-md-2" >
        النسبة
    </div>  
    <div class="col-md-5" >
        النوع
    </div>  



</div>    
<div class="col-md-12" >
    <?php  $i = 0 ;?>
    @foreach($accountTax as $row)
    <div class="col-md-5">

        {{$row->name}}  
        <input type="hidden" name="tax_id[<?php echo $i; ?>]" value="{{$row->id}}">
    </div>
    <div class="col-md-2">

       {{$row->rate}}   
       <input type="hidden" name="tax_rate[<?php echo $i; ?>]" value="{{$row->rate}}">
    </div>
    <div class="col-md-5">

        {{$row->taxType->name}}
        <input type="hidden" name="taxType_id[<?php echo $i; ?>]" value="{{$row->taxType->id}}">
        <?php $user_id  = Auth::user()->id; ?>
        <input type="hidden" name="user_id" value="{{$user_id}}">
    </div>    
    <?php ++$i; ?>
    @endforeach
    @else
    لم يتم تعريف ضريبة لهذا الحساب
    @endif
</div>  

