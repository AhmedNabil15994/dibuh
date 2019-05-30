 
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
    @foreach($accountTax as $row)
    <div class="col-md-5">

        {{$row->name}}  
    </div>
    <div class="col-md-2">

       {{$row->rate}}
    </div>
    <div class="col-md-5">

        {{$row->taxType->name}}
    </div>    

    @endforeach
    @else
    لم يتم تعريف ضريبة لهذا الحساب
    @endif
</div>  

