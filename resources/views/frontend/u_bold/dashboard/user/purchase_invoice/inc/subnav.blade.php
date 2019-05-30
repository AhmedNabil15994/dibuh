<li><a class="{{Active('sales_invoice.index')}} {{Active('sales_invoice.create')}}" href="{{Active('sales_invoice.index') ? 'javascript:void(0)' :  route('sales_invoice.index')}}">{{trans('frontend/dashboard.invoices')}}</a></li>
<li><a class="{{Active('abstract.index')}}" href="{{Active('abstract.index') ? 'javascript:void(0)' :  route('abstract.index')}}">{{trans('frontend/dashboard.abstracts')}}</a></li>
<li><a class="{{Active('other_income.index')}}" href="{{Active('other_income.index') ? 'javascript:void(0)' :  route('other_income.index')}}"> {{trans('frontend/dashboard.revenue_other')}}  </a></li>

