<style>

 @media (max-width:690px){
        .subnav li a{
            padding-left:6px !important;
            padding-right:6px !important;
         /*content:none !important;*/
     }
    }
    @media (max-width:611px){
   
    .subnav li {
        float:right !important;
        width:25%;
     }
      .subnav li a:before{
         content:none !important;
     }
        .subnav li a{
           font-size:13px !important;
         /*content:none !important;*/
     }
    }
   
</style>

<li class="subnav-item" style="float: right;"><a class="{{Active('cost.index')}} {{Active('cost.create')}} {{Active('cost.edit')}} {{Active('cost.show')}}" href="{{Active('cost.index') ? 'javascript:void(0)' :  route('cost.index')}}">{{trans('frontend/sales_invoice.purchase')}}</a></li>
<li class="subnav-item" style="float: right;"><a class="{{Active('sales_invoice_return.index')}} {{Active('sales_invoice_return.create')}} {{Active('sales_invoice_return.edit')}} {{Active('sales_invoice_return.show')}}" href="{{Active('sales_invoice_return.index') ? 'javascript:void(0)' :  route('sales_invoice_return.index')}}">{{trans('frontend/sales_invoice.bills_return')}}</a></li>
<li class="subnav-item" style="float: right;"><a class="{{Active('cost_other.index')}} {{Active('cost_other.create')}} {{Active('cost_other.edit')}} {{Active('cost_other.show')}}"  href="{{Active('cost_other.index') ? 'javascript:void(0)' :  route('cost_other.index')}}"> {{trans('frontend/sales_invoice.expenses')}}  </a></li>
<li class="subnav-item" style="float: right;"><a class="{{Active('salary.index')}} {{Active('salary.create')}} {{Active('salary.edit')}} {{Active('salary.show')}}"  href="{{Active('salary.index') ? 'javascript:void(0)' :  route('salary.index')}}"> {{trans('frontend/sales_invoice.salaries')}}  </a></li>
