<li><a class="{{Active('cash.index')}} {{Active('cash.create')}}" href="{{Active('cash.index') ? 'javascript:void(0)' :  route('cash.index')}}">{{trans('frontend/dashboard.cash')}}</a></li>
<li><a class="{{Active('bank.index')}}" href="{{Active('bank.index') ? 'javascript:void(0)' :  route('bank.index')}}">{{trans('frontend/dashboard.bank')}}</a></li>
<li><a class="{{Active('bank_settings.index')}}" href="{{Active('bank_settings.index') ? 'javascript:void(0)' :  route('bank_settings.index')}}"> {{trans('frontend/dashboard.bank_settings')}}  </a></li>

