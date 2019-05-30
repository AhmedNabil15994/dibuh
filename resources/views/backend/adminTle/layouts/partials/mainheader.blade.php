<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('admin::dashboard') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini "> <small>{{ trans('master.company') }} </small> </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b> {{ trans('master.company') }} </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- newUsers: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-users"></i>
                        <span class="label label-warning">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"> New Users</li>
                        <li>
                            <!-- inner menu: contains the messages -->
                            <ul class="menu">
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <!-- User Image -->
                                            <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                                        </div>
                                        <!-- Message title and timestamp -->
                                        <h4>
                                            {{ trans('adminlte_lang::message.supteam') }}
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <!-- The message -->
                                        <p>{{ trans('adminlte_lang::message.awesometheme') }}</p>
                                    </a>
                                </li><!-- end message -->
                            </ul><!-- /.menu -->
                        </li>
                        <li class="footer"><a href="#">c</a></li>
                    </ul>
                </li><!-- /.newUsers-menu -->


                <!-- Bugs: style can be found in dropdown.less-->
                @if(Auth::check())
                <?php
                $helpings=App\Models\Helping::where('replay_status',0)->orderBy('created_at','desc')->get();

                ?>
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bug"></i>
                        <span class="label label-danger">
                            {{$helpings->count()}}
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"> Support And Help</li>
                        <li>
                            <!-- inner menu: contains the messages -->
                            <ul class="menu">
                              @foreach($helpings as $help)
                                <li><!-- start message -->
                                    <a href="{{route('admin::helps.show')}}">
                                        <div class="pull-left">
                                            <!-- User Image -->
                                            <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                                        </div>
                                        <!-- Message title and timestamp -->
                                        <h4>
                                          <?php $user_name=App\Models\User::where('id',$help->user_id)->first();
                                                $create= Carbon\Carbon::parse($help->created_at);
                                          ?>
                                            {{$user_name['name']}}
                                            <small><i class="fa fa-clock-o"></i> since {{$create->diffInDays(Carbon\Carbon::now())}}  day</small>
                                        </h4>
                                        <!-- The message -->
                                        <p>{{str_limit($help->title,50)}}</p>
                                    </a>
                                </li><!-- end message -->
                                @endforeach
                            </ul><!-- /.menu -->
                        </li>
                        <li class="footer"><a href="{{route('admin::helps.show')}}">كل الرسائل </a></li>
                    </ul>
                </li><!-- /.Bugs-menu -->
                @endif


                @if (Auth::guest())
                    <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                @else
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
<!--                            <img src="img/user2-160x160.jpg" class="user-image" alt="User Image"/>-->
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
<!--                                <img src="img/user2-160x160.jpg" class="img-circle" alt="User Image" />-->
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>{{ trans('master.last_login_at') }} : {{ Auth::user()->last_login_at }} </small>
                                </p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{   route('admin::users.show',Auth::user()->id ) }}" class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{   route('admin::logout') }}" class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.signout') }}</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Control Sidebar Toggle Button -->
<!--                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>-->
            </ul>
        </div>
    </nav>
</header>
