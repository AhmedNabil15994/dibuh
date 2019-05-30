@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/user.profile_details') }}
@endsection

@section('contentheader_title')
{{ trans('backend/user.profile_details') }}
@endsection

@section('contentheader_description')
{{ trans('backend/user.profile_details') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/user.profile_details') }}
@endsection

@section('page-scripts')
@include(Config::get('back_theme').'.layouts.modals.js.comfirm_delete_js')
@show


<!--breadcrumb current page-->
@section('current_breadcrumb')
All User Profiles Details
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
<!--                <img class="profile-user-img img-responsive img-circle" src="img/user8-128x128.jpg" alt="User profile picture">-->

                <h3 class="profile-username text-center">  {{ $user->profile->first_name }}  {{ $user->profile->last_name }}</h3>

                <p class="text-muted text-center">{{ $user->profile->company }}</p>

                <ul class="list-group list-group-unbordered">

                    <li class="list-group-item">
                        <b>{{ trans('backend/user.email') }}</b> <a class="pull-right"> {{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{ trans('backend/user.user_status') }}User Status</b> <a class="pull-right">  {{DB::table('user_statuses')->where('id', $user->profile->user_status_id)->first()->name}}</a>
                    </li>

                </ul>


            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('backend/user.roles') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <p>
                    @if(!empty($user->roles))
                    @foreach($user->roles as $v)
                    <span class="label label-warning">{{ $v->display_name }}</span>
                    @endforeach
                    @endif
                </p>


            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li  class="active"><a href="#user_account" data-toggle="tab">{{ trans('backend/user.user_account_details') }}</a></li>
                <li><a href="#user_profile" data-toggle="tab"> {{ trans('backend/user.user_profile_details') }}</a></li>
                <li><a href="#user_address" data-toggle="tab">{{ trans('backend/user.user_address_details') }}</a></li>
                <li><a href="#user_bank_account" data-toggle="tab">{{ trans('backend/user.user_bank_account_details') }}</a></li>
             @permission('account-delete')
                <li><a href="#user_delete_account" data-toggle="tab">{{ trans('backend/user.user_delete_account_details') }}</a></li>
            @endpermission
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="user_account">

                    <div class="box box-primary">
                        <div class="box-body box-profile">

                            @include(Config::get('back_theme').'.users.user_account_edit')

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="user_profile">
                    <div class="box box-primary">
                        <div class="box-body box-profile">

                            @include(Config::get('back_theme').'.users.user_profile_basic_edit')
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane deleteFormModal" id="user_address" data-form="deleteForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="box box-primary" style="padding-top: 5px;">
                                @foreach($user->address as $v)

                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">

                                        <div class="row">
                                            <div class="col-md-9">

                                                {{$v->name}}<br/>
                                                {{$v->street}} /  {{$v->house_no}}  / {{$v->address_additional}} <br/>
                                                {{$v->postal_code}}  /  {{$v->city}} <br/>
                                                {{$v->country->name}}

                                            </div>

                                            <div class="col-md-3">



                                                <span class="pull-right">
                                                    @permission('user-create')
                                                    <a class="btn btn-primary btn-xs" href="{{ route('admin::users.profile.address.edit',$v->id) }}"><i class="fa fa-edit"></i> {{ trans('button.edit') }}</a>
                                                    @endpermission

                                                    {!! Form::open(['method' => 'DELETE','route' => ['admin::users.profile.address.destroy', $v->id], 'class' =>'form-delete','style'=>'display:inline']) !!}
                                                    @permission('user-delete')
                                                    {!! Form::button('<i class="fa fa-trash"></i>'.trans('button.delete'), ['class' => 'btn btn-danger btn-xs delete', 'name' => 'delete_modal', 'role' => 'button', 'type' => 'submit']) !!}
                                                    @endpermission
                                                    {!! Form::close() !!}
                                                </span>
                                            </div>



                                        </div>

                                    </div>
                                    <!-- /.user-block -->

                                </div>
                                <!-- /.post -->

                                @endforeach
                                <hr>

                                @permission('user-create')
                                <a class="btn btn-success " href="{{ route('admin::users.profile.address.create',$user->id) }}"><i class="fa fa-plus"></i> {{ trans('button.create') }}</a>
                                @endpermission
                            </div></div></div>
                </div>
                <!-- /.tab-pane -->


                <div class="tab-pane deleteFormModal"  id="user_bank_account" data-form="deleteForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="box box-primary" style="padding-top: 5px;">
                                @foreach($user->bankAccounts as $v)
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <div class="row">
                                            <div class="col-md-9">


                                                {{$v->bankDataType['name']}}<br/>
                                                 {{$v->owner_name}}<br/>
                                                {{ $v->bank_name  }} <br/>
                                                {{ $v->id_number  }}<br/>
                                                 {{ $v->iban  }}<br/>
                                                 {{ $v->bic  }}
                                            </div>
                                            <div class="col-md-3">
                                        <span class="pull-right">

                                            @permission('user-create')
                                            <a class="btn btn-primary btn-xs" href="{{ route('admin::users.bankaccount.edit',$v->id) }}"><i class="fa fa-edit"></i> {{ trans('button.edit') }}</a>
                                            @endpermission

                                            {!! Form::open(['method' => 'DELETE','route' => ['admin::users.bankaccount.destroy', $v->id], 'class' =>'form-delete','style'=>'display:inline']) !!}
                                            @permission('user-delete')

                                                {!! Form::button('<i class="fa fa-trash"></i>      '.trans('button.delete'), ['class' => 'btn btn-danger btn-xs delete', 'name' => 'delete_modal', 'role' => 'button', 'type' => 'submit']) !!}

                                            @endpermission
                                            {!! Form::close() !!}

                                        </span>

                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.user-block -->

                                </div>
                                <!-- /.post -->

                                @endforeach
                                <hr>
                                @permission('user-create')
                                <a class="btn btn-success " href="{{ route('admin::users.bankaccount.create',$user->id) }}"><i class="fa fa-plus"></i> {{ trans('button.create') }}</a>
                                @endpermission

                            </div>
                            <!-- /.tab-pane -->
                        </div></div></div>
                   <!-- Tab Delete Account Details -->
                                        <div class="tab-pane deleteFormModal"  id="user_delete_account" >
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="box box-primary" style="padding-top: 5px;">
                                                      <div class="box-header with-border">
                                                          <h3 class="box-title">{{ trans('backend/user.delete_details') }}</h3>
                                                      </div>
                                                      <div class="box-body">
                                                      {{Form::open()}}
                                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                                          <div class="form-group">
                                                              <strong>{{ trans('backend/user.email') }}:</strong>
                                                              {!! Form::text('email', null, array('placeholder' => trans('backend/user.email'),'class' => 'form-control')) !!}
                                                          </div>
                                                      </div>


                                                      {{Form::close()}}
                                                    </div> <!--end body -->


                                                    </div>
                                                    <!-- /.tab-pane -->
                                                </div></div></div>
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@include(Config::get('back_theme').'.layouts.modals.comfirm_delete')
@endsection
