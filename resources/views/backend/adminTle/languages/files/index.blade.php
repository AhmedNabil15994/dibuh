@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/user.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/language.files') }} =>
{{$lang_name}}
@endsection

@section('contentheader_description')


@endsection


<!--breadcrumb current page-->
@section('previous_breadcrumb')
{{ trans('backend/user.list') }}
@endsection

@section('current_breadcrumb')
{{ trans('backend/language.files') }}

@endsection

@section('content')
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- Notification js -->


@if ($message = Session::get('success'))
<div  class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div  class="alert alert-success" hidden>
    <p class="message"></p>
</div>

<div class="col-sm-9 user-details">
  <a class="btn btn-primary" href="{{ route('admin::language.files',$id) }}"> {{ trans('backend/language.public') }}</a>
  <a class="btn btn-primary" href=" {{route('admin::language.files_front',$id) }}"> {{ trans('backend/language.frontend') }}</a>
  <a class="btn btn-primary" href=" {{route('admin::language.files_back',$id) }}"> {{ trans('backend/language.backend') }}</a>

	<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" data-target="#home">{{ trans('auth.title') }}</a></li>
	  <li><a data-toggle="tab" href="#menuButton" style="padding-left:10px; padding-right:10px;">{{ trans('button.title') }}</a></li>
	  <li><a data-toggle="tab" href="#menuMaster" style="padding-left:10px; padding-right:10px;">{{ trans('master.title') }}</a></li>
	  <li><a data-toggle="tab" href="#menuMessage" style="padding-left:10px; padding-right:10px;">{{ trans('message.title') }}</a></li>
    <li><a data-toggle="tab" href="#menuPagination" style="padding-left:10px; padding-right:10px;">{{ trans('pagination.title') }}</a></li>
    <li><a data-toggle="tab" href="#menuPassword" style="padding-left:10px; padding-right:10px;">{{ trans('password.title') }}</a></li>


	</ul>

	<div class="tab-content">

    <div id="home"  class="tab-pane active in">
  {!! Form::open(['route'=>['admin::language.save_file',$id,'public','auth.php']]) !!}
            <div class="row" style="padding: 0;margin: 0;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('auth.title')}}</h3>
                        </div>
                        <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example1" style="width: 99%;border: 1px solid #DDD;">
                          <thead>
                            <th>key</th>
                            <th>content</th>
                          </thead>
                          <tbody>

                          @foreach($content_auth as $key=>$item)
                              <tr>

                                       <td style="width:200px;"=>  <strong>{{$key}}:</strong></td>
                                      <!-- </div> -->
                                       <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                                  <!-- </div>
                              </div> -->
                            </tr>
                          @endforeach
                            </tbody>

                        </div>
                      </table>


                        <div class="box-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                    <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            {!! Form::close() !!}




  </div>
      <div id="menuButton" class="tab-pane fade">
        {!! Form::open(['route'=>['admin::language.save_file',$id,'public','button.php']]) !!}
                  <div class="row" style="padding: 0;margin: 0;">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="box box-solid">

                              <div class="box-header with-border">
                                  <h3 class="box-title">{{ trans('button.title')}}</h3>
                              </div>
                              <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example2" style="width: 99%;border: 1px solid #DDD;">
                                <thead>
                                  <th>key</th>
                                  <th>content</th>
                                </thead>
                                <tbody>
                              <!-- <div class="box-body"> -->
                                @foreach($content_button as $key=>$item)
                                    <tr>
                                             <td>  <strong>{{$key}}:</strong></td>
                                             <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                                  </tr>
                                @endforeach
                                  </tbody>

                              </div>
                            </table>

                              <div class="box-footer">
                                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                          <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                                  </div>

                              </div>

                          </div>

                      </div>
                  </div>
                  {!! Form::close() !!}


    </div>
    <div id="menuMaster" class="tab-pane fade">
      {!! Form::open(['route'=>['admin::language.save_file',$id,'public','master.php']]) !!}
                <div class="row" style="padding: 0;margin: 0;">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="box box-solid">

                            <div class="box-header with-border">
                                <h3 class="box-title">{{ trans('master.title')}}</h3>
                            </div>
                            <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example3" style="width: 99%;border: 1px solid #DDD;">
                              <thead>
                                <th>key</th>
                                <th>content</th>
                              </thead>
                              <tbody>
                            <!-- <div class="box-body"> -->
                              @foreach($content_master as $key=>$item)
                                  <tr>
                                           <td>  <strong>{{$key}}:</strong></td>
                                           <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                                </tr>
                              @endforeach
                                </tbody>

                            </div>
                          </table>

                            <div class="box-footer">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                        <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                {!! Form::close() !!}
                {!! $content_master->appends(Input::except('page'))->render() !!}

  </div>
  <div id="menuPagination" class="tab-pane fade">
    {!! Form::open(['route'=>['admin::language.save_file',$id,'public','pagination.php']]) !!}
              <div class="row" style="padding: 0;margin: 0;">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="box box-solid">

                          <div class="box-header with-border">
                              <h3 class="box-title">{{ trans('pagination.title')}}</h3>
                          </div>
                          <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example4" style="width: 99%;border: 1px solid #DDD;">
                            <thead>
                              <th>key</th>
                              <th>content</th>
                            </thead>
                            <tbody>
                          <!-- <div class="box-body"> -->
                            @foreach($content_pagination as $key=>$item)
                                <tr>
                                         <td>  <strong>{{$key}}:</strong></td>
                                         <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                              </tr>
                            @endforeach
                              </tbody>

                          </div>
                        </table>

                          <div class="box-footer">
                              <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                      <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                              </div>

                          </div>

                      </div>

                  </div>
              </div>
              {!! Form::close() !!}
              {!! $content_pagination->appends(Input::except('page'))->render() !!}

</div>
  <div id="menuMessage" class="tab-pane fade">
    {!! Form::open(['route'=>['admin::language.save_file',$id,'public','message.php']]) !!}
              <div class="row" style="padding: 0;margin: 0;">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="box box-solid">

                          <div class="box-header with-border">
                              <h3 class="box-title">{{ trans('message.title')}}</h3>
                          </div>
                          <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example5" style="width: 99%;border: 1px solid #DDD;">
                            <thead>
                              <th>key</th>
                              <th>content</th>
                            </thead>
                            <tbody>
                          <!-- <div class="box-body"> -->
                            @foreach($content_message as $key=>$item)
                                <tr>
                                         <td>  <strong>{{$key}}:</strong></td>
                                         <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                              </tr>
                            @endforeach
                              </tbody>

                          </div>
                        </table>

                          <div class="box-footer">
                              <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                      <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                              </div>

                          </div>

                      </div>

                  </div>
              </div>
              {!! Form::close() !!}
              {!! $content_message->appends(Input::except('page'))->render() !!}

</div>
<div id="menuPassword" class="tab-pane fade">
  {!! Form::open(['route'=>['admin::language.save_file',$id,'public','password.php']]) !!}
            <div class="row" style="padding: 0;margin: 0;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="box box-solid">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('password.title')}}</h3>
                        </div>
                        <table class="table table-hover daTatable dataTable demo-foo-filtering" id="example6" style="width: 99%;border: 1px solid #DDD;">
                          <thead>
                            <th>key</th>
                            <th>content</th>
                          </thead>
                          <tbody>
                        <!-- <div class="box-body"> -->
                          @foreach($content_password as $key=>$item)
                              <tr>
                                       <td>  <strong>{{$key}}:</strong></td>
                                       <td>   {!! Form::text($key,$item,array('placeholder' => '','class' => 'form-control')) !!}</td>
                            </tr>
                          @endforeach
                            </tbody>

                        </div>
                      </table>

                        <div class="box-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                    <button type="submit" class="btn btn-success pull-right user-profile-edit"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            {!! Form::close() !!}
            {!! $content_password->appends(Input::except('page'))->render() !!}

</div>






</div>
</div>
@endsection

@section('page-styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">
<style type="text/css">
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        color: #666;
    }
    .user-info>div{
    	background-color: #EEE;
    	padding: 10px;
    	border-radius: 5px;
    	border-top: 4px solid #3C8DBC;
    	margin-bottom: 20px;
    }
    .user-info .row {
    	padding: 0;
    	margin: 0;
    	border-top: 1px dashed #777;
    }
    .user-info .row span{
    	padding: 10px 0;
    	display: inline-block;
    }
    .user-info .row span:first-of-type{
    	font-weight: bold;
    	width: 78px;
    }
    .user-info .row span:nth-of-type(2){
    	color:#044e22;
    	float: right;
    }
    .user-info .row:last-of-type{
    	border-bottom: 1px dashed #777;
    	margin-bottom: 15px;
    }
    .roles{
    	padding-top: 5px !important;
    }
    .roles h4{
    	border-bottom: 1px dashed #777;
    	padding-bottom: 5px;
    }
    .roles .row{
    	border: 0 !important;
    	margin-bottom: 0 !important;
    }
    .roles .row span{
    	padding: 3px;
    	display: inline-block;
    	float: left;
    	margin-bottom: 5px;
    }
    .content-wrapper, .right-side , .wrapper{
        background-color: #FFF !important;
    }
    .label{
        background-color: #358eda;
        padding: 5px;
        margin-bottom: 10px;
        display: inline-block;
    }
  	.content{
  		min-height: 670px;
  	}
    .row{
        padding-right: 50px;
        margin-bottom: 20px;
    }
    button i{
        font-size: 13px;
        margin-right: 5px;
    }
    .table{
        color: #495060;
    }
    .table thead tr > th{
        text-align: center;
        padding: 12px 5px;
    }
    .table tbody tr > td{
        text-align: center;
        padding: 10px 7px;
        font-size: 14px;
    }
    .table tbody tr:hover{
        cursor: pointer;
        -webkit-transition: all ease-in-out .3s;
        -moz-transition: all ease-in-out .3s;
        -o-transition: all ease-in-out .3s;
        transition: all ease-in-out .3s;
        background-color: #EBF7FF;
    }
    .table tbody .tab-row.active,.table tbody tr:active{
        background-color: #DDD;
    }
    .btn-warning{
        background-color: #FFAD33;
        padding: 6px 5px;
        padding-left: 10px;
        display: inline-block;
        font-size: 12px;
    }
    .btn-warning:hover{
        opacity: .8;
    }
    .tax-delete{
        padding: 0;
        font-size: 12px;
        padding: 2px 7px;
        background-color: #ed3f14;
    }
    .taxs .text{
        border: 1px solid #e9eaec;
        background-color: #f7f7f7;
        padding: 5px;
        display: block;
        width: fit-content;
        margin: auto;
        margin-bottom: 10px;
    }
    .taxs .rate{
        min-width: 40px;
    }
    th.edit{
        position: relative;
    }
    th.edit div{
        position: absolute;
        top: 0;
        left: 0;
        padding: 5px 15px;
        display: block;
        width: 100%;
        text-align: center;
    }
    td .btn{
        margin-bottom: 5px;
    }
    .tab-pane{
        padding: 15px;
        border: 1px solid #DDD;
        border-top: 0;
    }
    .select2,.form-control{
        width: 50% !important;
        display: inline-block;
    }
</style>
@endsection

@section('page-scripts')

@include(Config::get('back_theme').'.layouts.modals.comfirm_delete')

<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript">
    $(function(){
      $('#example1,#example2,#example3,#example4,#example5,#example6').DataTable({
        "pageLength": 7
      });


/***********************************************************************************************************/
        $(".select2").select2();

        var selected=[];
            $('#home .test').each(function(){
                selected.push($(this).val());
            });

            option = document.getElementById("roles").options;
            for (var i = selected.length - 1; i >= 0; i--) {
                var sel = i-1;
                option[selected[i] - 1].setAttribute('selected', 'selected');
            }

        $("input[type=checkbox]").iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_minimal-blue'
        });

        function close(){
            $('.modal input').val('');
            $('select').prop('selectedIndex',-1);
            $('.modal .alert').addClass('hidden');
            $('input[type=checkbox]').each(function(){
                    $(this).iCheck('uncheck');
            });
        }
        $('.modal .btn-danger , .modal .close').on('click',function(){
                close();
           });
        var activate = $('#menu1 input[name="activate"]').val();
        $('#menu1 .select2').val(activate).trigger('change');

        $("#home .roles").select2({
            placeholder: "Select Roles"
        });

        $("#menu1 .select2").select2({
            placeholder: "Select Status"
        });

        $('.breadcrumb .prev').toggle();
        $('.breadcrumb .prev a').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = "{{URL::to('backend/users_view')}}";
        });
/***********************************************Account Details**************************************************/
		$('#home').on('click','.user-acc-edit',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id =$('.user_id').val();
            var email = $('input[name=email]').val();
            var password = $('input[name=password]').val();
            var confirm_password = $('.confirm_password').val();
            var is_admin = '';
            if ($('input[name=is_admin]').is(':checked')) {
                is_admin=1;
            }else{
                is_admin=0;
            }
            var roles=[];
            $('#home #roles option:selected').each(function(){
                roles.push($(this).val());
            });

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: 'post',
                url: '{{ URL::to('backend/editUserAcc') }}',
                data: {
                    '_token': $('#modal input[name=_token]').val(),
                    'id':id,
                    'email':email,
                    'password':password,
                    'confirm_password':confirm_password,
                    'is_admin':is_admin,
                    'roles':roles
                    },
                success: function(data) {
                    location.reload();
                },

            });
      	});
/***********************************************Profile Details***************************************************/
        $('#menu1').on('click','.user-profile-edit',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id =$('.user_id').val(),
                fname = $('input[name="first_name"]').val(),
                lname = $('input[name="last_name"]').val(),
                company = $('input[name="company"]').val(),
                mobile = $('input[name="mobile"]').val(),
                fax = $('input[name="fax"]').val(),
                tax_no = $('input[name="tax_no"]').val(),
                url = $('input[name="url"]').val(),
                expire_date = $('input[name="expire_date"]').val(),
                user_status_id = $('#menu1 .select2 option:selected').val();

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: 'post',
                url: '{{ URL::to('backend/editUserProfile') }}',
                data: {
                    '_token': $('#modal input[name=_token]').val(),
                    'id':id,
                    'first_name':fname,
                    'last_name':lname,
                    'company':company,
                    'mobile':mobile,
                    'fax':fax,
                    'tax_no':tax_no,
                    'url':url,
                    'expire_date':expire_date,
                    'user_status_id':user_status_id

                    },
                success: function(data) {
                    location.reload();
                },

            });
        });
/***********************************************Address Add*******************************************************/
        $('#menu2').on('click','.address-add',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $('.user_id').val();
            $('#add-user-address').modal({ backdrop: 'static', keyboard: false });
            $('#add-user-address .btn-success').unbind('click');
            $('#add-user-address .btn-success').on('click',function(e){
                var name = $('input[name="name"]').val(),
                    street = $('input[name="street"]').val(),
                    house_no = $('input[name="house_no"]').val(),
                    address_additional = $('input[name="address_additional"]').val(),
                    postal_code = $('input[name="postal_code"]').val(),
                    city = $('input[name="city"]').val(),
                    country_id = $('#add-user-address .select2 option:selected').val();
                e.preventDefault();
                e.stopPropagation();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/addUserAddress') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'user_id':id,
                        'name':name,
                        'street':street,
                        'house_no':house_no,
                        'address_additional':address_additional,
                        'postal_code':postal_code,
                        'city':city,
                        'country_id':country_id
                        },
                    success: function(data) {
                        location.reload();
                    },

                });
            });

        });
/**********************************************Address Remove****************************************************/
        $('#menu2').on('click','.btn-danger',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).val();
            $('#confirm-delete').modal({ backdrop: 'static', keyboard: false });
            $('#confirm-delete .btn-danger').unbind('click');
            $('#confirm-delete .btn-danger').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/removeUserAddress') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'id':id,
                        },
                    success: function(data) {
                        $('#confirm-delete').modal('toggle');
                        $('.test'+id).remove();
                    },

                });
            });

        });
/**********************************************Address Edit*****************************************************/
        $('#menu2').on('click','.btn-primary',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).val();
                name = $(this).attr('name'),
                street = $(this).attr('street'),
                house_no = $(this).attr('house_no'),
                address_additional = $(this).attr('address_additional'),
                postal_code = $(this).attr('postal_code'),
                city = $(this).attr('city'),
                country_id = $(this).attr('country');
            $('#edit-user-address input[name="name"]').val(name);
            $('#edit-user-address input[name="street"]').val(street);
            $('#edit-user-address input[name="house_no"]').val(house_no);
            $('#edit-user-address input[name="address_additional"]').val(address_additional);
            $('#edit-user-address input[name="postal_code"]').val(postal_code);
            $('#edit-user-address input[name="city"]').val(city);
            $('#edit-user-address .select2').val(country_id).trigger('change');

            $('#edit-user-address').modal({ backdrop: 'static', keyboard: false });
            $('#edit-user-address .btn-success').unbind('click');
            $('#edit-user-address .btn-success').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                var name = $('#edit-user-address input[name="name"]').val();
                    street = $('#edit-user-address input[name="street"]').val();
                    house_no = $('#edit-user-address input[name="house_no"]').val();
                    address_additional = $('#edit-user-address input[name="address_additional"]').val();
                    postal_code = $('#edit-user-address input[name="postal_code"]').val();
                    city = $('#edit-user-address input[name="city"]').val();
                    country_id = $('#edit-user-address .select2 option:selected').val();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/editUserAddress') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'id':id,
                        'name':name,
                        'street':street,
                        'house_no':house_no,
                        'address_additional':address_additional,
                        'postal_code':postal_code,
                        'city':city,
                        'country_id':country_id
                        },
                    success: function(data) {
                        location.reload();
                    },

                });
            });

        });
/*********************************************Bank Account Add**************************************************/
        $('#menu3').on('click','.bank-add',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $('.user_id').val();
            $('#add-bank-account').modal({ backdrop: 'static', keyboard: false });
            $('#add-bank-account .btn-success').unbind('click');
            $('#add-bank-account .btn-success').on('click',function(e){
                var bank_name = $('input[name="bank_name"]').val(),
                    id_number = $('input[name="id_number"]').val(),
                    owner_name = $('input[name="owner_name"]').val(),
                    iban = $('input[name="iban"]').val(),
                    bic = $('input[name="bic"]').val(),
                    bank_data_type_id = $('#add-bank-account .select2 option:selected').val();

                e.preventDefault();
                e.stopPropagation();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/addUserBankAccount') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'user_id':id,
                        'bank_name':bank_name,
                        'id_number':id_number,
                        'owner_name':owner_name,
                        'iban':iban,
                        'bic':bic,
                        'bank_data_type_id':bank_data_type_id
                        },
                    success: function(data) {
                        location.reload();
                    },

                });
            });

        });
/**********************************************Bank Account Remove**********************************************/
        $('#menu3').on('click','.btn-danger',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).val();
            $('#confirm-delete').modal({ backdrop: 'static', keyboard: false });
            $('#confirm-delete .btn-danger').unbind('click');
            $('#confirm-delete .btn-danger').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/removeUserBankAccount') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'id':id,
                        },
                    success: function(data) {
                        $('#confirm-delete').modal('toggle');
                        $('.test'+id).remove();
                    },

                });
            });

        });
/**********************************************Bank Account Edit************************************************/
        $('#menu3').on('click','.btn-primary',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).val();
                bankDataType = $(this).attr('bankDataType'),
                owner_name = $(this).attr('owner_name'),
                bank_name = $(this).attr('bank_name'),
                id_number = $(this).attr('id_number'),
                iban = $(this).attr('iban'),
                bic = $(this).attr('bic');

            $('#edit-bank-account .select2').val(bankDataType).trigger('change');
            $('#edit-bank-account input[name="bank_name"]').val(bank_name);
            $('#edit-bank-account input[name="id_number"]').val(id_number);
            $('#edit-bank-account input[name="owner_name"]').val(owner_name);
            $('#edit-bank-account input[name="iban"]').val(iban);
            $('#edit-bank-account input[name="bic"]').val(bic);

            $('#edit-bank-account').modal({ backdrop: 'static', keyboard: false });
            $('#edit-bank-account .btn-success').unbind('click');
            $('#edit-bank-account .btn-success').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/editUserBankAccount') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'id' : id,
                        'bank_name' : $('#edit-bank-account input[name="bank_name"]').val(),
                        'owner_name' : $('#edit-bank-account input[name="owner_name"]').val(),
                        'id_number' : $('#edit-bank-account input[name="id_number"]').val(),
                        'iban' : $('#edit-bank-account input[name="iban"]').val(),
                        'bic'  : $('#edit-bank-account input[name="bic"]').val(),
                        'bank_data_type_id' :  $('#edit-bank-account .select2 option:selected').val()
                        },
                    success: function(data) {
                        location.reload();
                    },

                });
            });

        });
/***************************************************************************************************************/

    $('form.menu4Delete').submit(function(){
      $(this).serialize();
      var this_objct = this;
      $.post($(this).attr('action'),$(this).serialize(),function(result){

      $("#menu4").notify(result.success,{ position:"top" ,className:"success"});

      },


      'json');

      return false;
    });

// });

/***********************************/


    });
</script>

@endsection
