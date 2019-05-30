<li>
    <a class="{{Active('product.index')}} {{Active('account.create')}}"
       href="{{Active('product.index') ? 'javascript:void(0)' :  route('product.index')}}">{{trans('frontend/dashboard.product')}}</a>
</li>

<li>
    <a class="{{Active('account.main')}} {{Active('account.create')}}"
       href="{{Active('account.index') ? 'javascript:void(0)' :  route('account.main')}}">{{trans('frontend/dashboard.account_manager')}}</a>
</li>

 

