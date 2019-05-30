           <div class="col-md-2">
                    <ul class="nav nav-pills nav-stacked well">
                        <li  class="dashboard_title"><a  href="{{ route('account.index') }}" class="dashboard_title"><i class="fa fa-dashboard"></i> {{trans('frontend/dashboard.user_manager')}}</a></li>

                        <li><a href="{{ route('profile.basic.index') }}"><i class="fa fa-user"></i>  {{trans('frontend/user.profile')}}</a></li>
                        <li><a href="{{ route('profile.address.index') }}"><i class="fa fa-location-arrow"></i>  {{trans('frontend/user.address')}}</a></li>
                        <li><a href="{{ route('profile.bankaccount.index') }}"><i class="fa fa-bank"></i>  {{trans('frontend/user.bank_account')}}</a></li>                 
                        <li><a href="{{ route('users.changepassword') }}"><i class="fa fa-key"></i> {{trans('frontend/user.change_password')}}</a></li>                
                        
                    </ul>
                </div>