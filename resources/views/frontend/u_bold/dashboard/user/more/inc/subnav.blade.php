<li>
    <a class="{{Active('product.index')}} {{Active('account.create')}}"
       href="{{Active('product.index') ? 'javascript:void(0)' :  route('product.index')}}">{{trans(' المنتجات والخدمات')}}</a>
</li>
<li>
    <a class="{{Active('expense.index')}} {{Active('account.create')}}"

       href="{{Active('expense.index') ? 'javascript:void(0)' :  route('expense.index')}}">{{trans('  تصنيف المصروفات')}}</a>    
</li>
<li>
    <a class="{{Active('account.main')}} {{Active('account.create')}}"
       href="{{Active('account.index') ? 'javascript:void(0)' :  route('account.main')}}">{{trans(' الاكواد الحسابيه')}}</a>
</li>



 

