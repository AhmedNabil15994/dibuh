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

<li class="subnav-item" style="float: right;"><a class="{{Active('sales_invoice.index')}} {{Active('sales_invoice.create')}} {{Active('sales_invoice.edit')}} {{Active('sales_invoice.show')}}" href="{{Active('sales_invoice.index') ? 'javascript:void(0)' :  route('sales_invoice.index')}}">{{trans('frontend/dashboard.invoices')}}</a></li>
<li class="subnav-item" style="float: right;"><a class="{{Active('abstract.index')}} {{Active('abstract.create')}} {{Active('abstract.edit')}}" href="{{Active('abstract.index') ? 'javascript:void(0)' :  route('abstract.index')}}">{{trans('frontend/dashboard.abstracts')}}</a></li>
<li class="subnav-item" style="float: right;"><a class="{{Active('other_income.index')}} {{Active('other_income.create')}} {{Active('other_income.edit')}}"  href="{{Active('other_income.index') ? 'javascript:void(0)' :  route('other_income.index')}}"> {{trans('frontend/dashboard.revenue_other')}}  </a></li>
