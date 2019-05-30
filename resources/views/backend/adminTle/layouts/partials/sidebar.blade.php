<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel text-center">
<!--                <div class="pull-left image visible-lg">
                    <img src="img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                     Status
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('message.online') }}</a>
                </div>-->
<p style="color: #ffffff">{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('message.online') }}</a>
            </div>
        @endif

        <!-- search form (Optional) -->
<!--        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('backend/main.navigation') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ active('admin::dashboard') }}"><a href="{{ route('admin::dashboard') }}" style="text-decoration: none;"><i class='fa fa-home'></i> <span>{{ trans('backend/main.home') }}</span></a></li>

            
            @permission('language-menu')
            <li class="{{ active('admin::languages.*') }}"><a href="{{ route('admin::languages.index') }}" style="text-decoration: none;"><i class='fa fa-language'></i> <span>{{ trans('backend/language.title') }}</span></a></li>
            @endpermission

            @permission('setting-menu')
            <li class="{{ active('admin::settings.*') }}"><a href="{{ route('admin::settings.index') }}" style="text-decoration: none;"><i class='fa fa-connectdevelop'></i> <span>{{ trans('backend/main.settings') }}</span></a></li>

            <li class="{{ active('admin::email.*') }}"><a href="{{route('admin::email.index')}}" style="text-decoration: none;"><i class='fa fa-envelope-o'></i> <span>{{ trans('backend/main.temp') }}</span></a></li>
            @endpermission
           

            @permission('user-menu')

             <li class="treeview {{ active('admin::users.*') }} {{ active('admin::invoices.*') }} {{ active('admin::settings.*') }} {{ active('admin::payments.*') }}">
                <a href="#" style="text-decoration: none;"><i class='fa fa-user'></i> <span>{{ trans('backend/main.users') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                    <li class="{{ active('admin::users.users_view') }}"><a href="{{ route('admin::users.users_view') }}"><i class='fa fa-user'></i> <span>{{ trans('backend/main.users') }}</span></a></li>
                   
                    @permission('payment-menu')
                    <!--<li class="{{ active('admin::payments.index') }}"><a href="{{ route('admin::payments.index') }}"><i class='fa fa-link'></i> <span>{{ trans('backend/payment.title') }}</span></a></li>
                    <li class="{{ active('admin::payments.overview') }}"><a href="{{ route('admin::payments.overview') }}"><i class='fa fa-link'></i> <span>{{ trans('backend/payment.overview') }}</span></a></li>-->
                    <li class="{{ active('admin::payments.plans') }}"><a href="{{ route('admin::payments.plans') }}"><i class='fa fa-link'></i> <span>{{ trans('backend/payment.plans') }}</span></a></li>
                    @endpermission
                </ul>
            </li>
            
            
                                     
                
            <li class="{{ active('admin::helps.*') }}"><a href="{{ route('admin::helps.show') }}" style="text-decoration: none;"><i class='fa fa-question' style="font-size: 20px;"></i> <span>Help And Support</span></a></li>     

            @endpermission

            
            


            @permission('account-menu')
           <li class="treeview {{ active('admin::account_setting.*') }}">
                <a href="#" style="text-decoration: none;"><i class='fa fa-money'></i> <span>{{ trans('backend/dashboard.account_settings') }}</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">

                    <li class="{{ active(['admin::account_setting.tax','admin::account_setting.tax_type']) }}"><a href="{{ route('admin::account_setting.tax') }}"><i class='fa fa-tree'></i> <span>{{ trans('backend/tax.title') }}</span></a></li>

                     <li class="{{ active(['admin::account_setting.account','admin::account_setting.category','admin::account_setting.Acc_category']) }}"><a href="{{ route('admin::account_setting.account') }}"><i class='fa fa-tree'></i> <span>{{ trans('backend/account.title') }}</span></a></li>

                    <li class="{{ active('admin::account_setting.relation') }}"><a href="{{ route('admin::account_setting.relation') }}"><i class='fa fa-tree'></i> <span>{{ trans('backend/account.relation') }}</span></a></li>

                </ul>
            </li>


            @endpermission






<!--            @permission('setting-menu')

            @endpermission                         -->




        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
