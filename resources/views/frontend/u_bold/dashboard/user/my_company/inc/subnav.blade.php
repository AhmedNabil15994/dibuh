<li>
    <a class="{{Active('mycompany.index')}} {{Active('mycompany.create')}}"
       href="{{Active('mycompany.index') ? 'javascript:void(0)' :  route('mycompany.index')}}">{{trans(' شركتي')}}</a>
</li>
<li>
    <a class="{{Active('mycompany.invoices')}}"
       href="{{Active('mycompany.invoices') ? 'javascript:void(0)' :  route('mycompany.invoices')}}">{{trans(' جميع الفواتير المستلمة')}}</a>
</li>







