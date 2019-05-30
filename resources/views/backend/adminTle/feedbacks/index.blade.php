@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/main.invoices') }}
@endsection

@section('contentheader_title')
{{ trans('backend/main.feedback') }}

@endsection

@section('contentheader_description')
{{ trans('backend/main.feedback') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/main.feedback') }}
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<ul class="nav nav-tabs">
  <li class="{{ active('admin::users.users_view') }}"><a  href="{{ route('admin::users.users_view') }}">{{ trans('backend/user.list') }}</a></li>
  <li class="{{ active('admin::users.users_settings') }}"><a  href="{{ route('admin::users.users_settings') }}">{{ trans('backend/user_settings.title') }}</a></li>
  <li class="{{ active('admin::invoices.*') }}"><a  href="{{ route('admin::invoices.index') }}">{{ trans('backend/main.invoices') }}</a></li>
    <li class="{{ active('admin::invoices.*') }}"><a  href="{{ route('admin::feedback.index') }}">{{ trans('backend/main.feedback') }}</a></li>
</ul>
<div class="tab-content">
    <div id="home" class="tab-pane active in">
        @if(Auth::user()->is_admin)
        <?php  $type="admin";?>
        @else
        <?php  $type="user";?>
        @endif

        <div class="pag">
              @if(count($feedbacks))
              {!! Form::open(['class'=>'check-form','method' => 'get','route' => ['admin::feedback.appearancs',$type],'style'=>'display:inline']) !!}

              <table class="table table-hover table-bordered daTatable dataTable deleteFormModal text-center demo-foo-filtering" data-form="deleteForm" id="users-table">
                    <thead>
                        <tr style="background-color: #EEE;">
                            <th style="padding: 0;"><input type="text" style="margin-bottom: 5px;" name="search" class="form-control" placeholder="{{ trans('backend/main.client') }}" id="search"></th>
                            <th>{{ trans('backend/main.feedback') }}</th>
                              <th>Appear on front</th>
                            <th colspan="2">{{ trans('master.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                      @if(Auth::user()->is_admin)
                      @foreach($feedbacks as $feedback)
                        <tr>
                          <?php $user=App\Models\User::find($feedback->user_id); ?>
                            <td>{{$user->name}}</td>
                            <td>{{$feedback->feedback}}</td>
                            <td style="width:10%">
                              {{Form::checkbox('appear[]',$feedback->id,$feedback->appear_status)}}

                            </td>
                            <td style="width:15%">

                               <button style="padding-right: 10px; padding-left: 5px;" type="button" value="{{$feedback->id}}" href="{{route('admin::feedback.destroy',$feedback->id)}}" class="btn btn-danger btn-circle pull-right user-edit delete_feedback"><i class="fa fa-close"></i> {{trans('frontend/sales_invoice.delete')}}</button>

                            <a  class="btn btn-success btn-circle pull-right user-edit"   data-toggle="modal" data-target="#FeedbackModal" data-feedback_user="{{$user->name}}" data-feedback_content="{{$feedback->feedback}}" data-feedback_id="{{$feedback->id}}" ><i class="fa fa-edit"> </i>{{trans('button.edit')}} </a>
                             </td>

                        </tr>

                        @endforeach
                        <tr><td style="text-align:center" colspan="4">
                          {!! Form::submit('Update appearance on front',['class'=>'btn btn-info btn-circle pull-right user-edit','style'=>'text-align:center']) !!}
                          {!! Form::close() !!}
                        </td></tr>

                     @else

                     <tr>
                       <?php $user=App\Models\User::find($feedbacks->user_id); ?>
                         <td>{{$user->name}}</td>
                         <td>{{$feedbacks->feedback}}</td>
                         <td style="width:10%">
                           {{Form::checkbox('appear',$feedbacks->id,$feedbacks->appear_status)}}
                           {{form::hidden('id',$feedbacks->id)}}

                         </td>

                         <td style="width:15%">
                           {!! Form::open(['method' => 'POST','route' => ['admin::feedback.destroy',$feedbacks->id],'style'=>'display:inline']) !!}
                           <button style="padding-right: 10px; padding-left: 5px;" type="submit" class="btn btn-danger btn-circle pull-right user-edit"><i class="fa fa-close"></i> {{trans('frontend/sales_invoice.delete')}}</button>
                           {!! Form::close() !!}
                         <a  class="btn btn-success btn-circle pull-right user-edit"   data-toggle="modal" data-target="#FeedbackModal" data-feedback_user="{{$user->name}}" data-feedback_content="{{$feedbacks->feedback}}" data-feedback_id="{{$feedbacks->id}}" ><i class="fa fa-edit"> </i>{{trans('button.edit')}} </a>
                          </td>


                     </tr>
                     <tr><td style="text-align:center" colspan="4">
                       {!! Form::submit('Update appearance on front',['class'=>'btn btn-info btn-circle pull-right user-edit','style'=>'text-align:center']) !!}
                       {!! Form::close() !!}
                     </td></tr>

                     @endif
                    </tbody>


                </table>


                @else
                <p> There is No Feedbacks</p>
                @endif

    </div>
</div>
</div>
<div id="FeedbackModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header modal-header-danger">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

              <h4 class="modal-title"> <i class="fa fa-pencil"></i>{{ trans('backend/main.feedback') }}  </h4>
          </div>
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
          @permission('account-edit')


            {{ Form::open(['route' =>'admin::feedback.update','style'=>'display:inline']) }}

              <div class="modal-body" id="taxes-body" style="margin-bottom: 40px;">



                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <p id="feedback-user" style="text-align:center">{{ trans('backend/main.feedback') }} </p>
                          <div class="col-sm-4">
                              <strong>{{ trans('backend/main.feedback') }} :</strong>
                          </div>
                          <textarea   id="feedback-content"name="feedback"  class="form-control"row="3"></textarea>
                          {{form::hidden('feedback_id',null,['id'=>'feedback-id'])}}

                      </div>
                  </div>

              <div class="modal-footer" style="border-top: 0; margin-top: 20px;">
                  <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-edit"></i> {{trans('button.edit')}}</button>
                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-home"></i>{{ trans('button.close') }}</button>
              </div>
              {!! Form::close() !!}

          @endpermission
             </div>
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
<link rel="stylesheet" type="text/css" href="{{URL::to('').Config::get('assets_frontend')}}/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<style type="text/css">
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        color: #666;
    }
    .pag{
        border: 1px solid #DDD;
        padding: 20px 20px;
        background-color: #FFF;
        border-radius: 5px;
        box-shadow: 5px 5px 5px #999;
    }
    table td{
        text-align: left !important;
    }
    table thead tr:first-of-type > th{
        width: 200px !important;
    }
    table thead tr:first-of-type > th:nth-of-type(2){
        width: 200px !important;
    }
    table thead tr:first-of-type > th:nth-of-type(2) input{
        width: 100% !important;
    }

    .table tbody tr > td{
        text-align: center !important;
    }
    .table tbody tr > td:nth-of-type(2){
        text-align: left !important;
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
    #form_search input.form-control{
        display: block;
        width: 100% !important;
        position: relative;
    }
    #form_search .input-group-btn{
        position: absolute;
        right: 0;
    }
    .row{
        margin-bottom: 20px;
    }
    button i{
        font-size: 13px;
        margin-right: 5px;
    }
    .table{
        color: #495060;
        border: 1px solid #DDD;
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
    .table tbody .selected_record:hover{
        cursor: pointer;
        -webkit-transition: all ease-in-out .3s;
        -moz-transition: all ease-in-out .3s;
        -o-transition: all ease-in-out .3s;
        transition: all ease-in-out .3s;
        background-color: #EBF7FF;
    }
    .table tbody .tab-row.active,.table tbody .selected_record:active{
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
    #datatable_paginate{
        text-align: left;
    }
    .dataTables_wrapper .row:first-of-type .col-sm-6:first-of-type{
        float: left;
    }
    #datatable_wrapper .row:last-of-type{
        margin-top: 30px;
    }
    .dataTables_filter{
        display: none;
    }
    .dataTables_length,
    .pagination{
        float: left;
    }
    .dataTables_wrapper .row .col-sm-5{
        float: right;
    }
    .dataTables_wrapper .row .col-sm-5 .dataTables_info{
        float: right;
    }
    #search{
        float: center;
    }
</style>
@endsection

@section('page-scripts')


<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript">
    $(function(){

/*********************************************** Pagination Code***********************************************/
        /*$(document).on('click','.pagination a',function(e){
            e.preventDefault();
            var page = $(this).attr('href');
            getItems(page);
            window.history.pushState("", "", page);
        });

        function getItems(page){
            $.ajax({
                url:page
            }).done(function(data){
                $('#home').html($(data).find(".pag"));
            });
        }*/



        $(".select2").select2();
         // $('#users-table').DataTable({
         //              "ordering": false
         //            } );
            var oTable= $('.demo-foo-filtering').DataTable({
                          "ordering": false
                        } );
        $('#search').on('keyup',function(){
            oTable.search( this.value ).draw();
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




    });
    $('#FeedbackModal').on('show.bs.modal',function(e){
      console.log($(e.relatedTarget).data('feedback_user'));

                   var feedback_name=$(e.relatedTarget).data('feedback_user');
                   var feedback_content=$(e.relatedTarget).data('feedback_content');
                   var feedback_id=$(e.relatedTarget).data('feedback_id');
                   $('#feedback-user').html(feedback_name);
                   $('#feedback-content').val(feedback_content);
                   $('#feedback-id').val(feedback_id);



    });
    $(".delete_feedback").on('click',function(){

      var id=$(this).val();
      $.get('/backend/feedbacks/delete/'+id,function(){
        window.location.href = "{{route('admin::feedback.index')}}";

      });
    });

    // $('form.check-form').submit(function(){
    //   var this_objct = this;
    //     console.log($(this).serialize());
    // console.log($(this).attr('action'));
    //   $.post($(this).attr('action'),$(this).serialize(),function(result){
    // console.log($(this).serialize());
    // //  window.location.href = "";
    //   },'json');
    //   return false;
    // });

</script>

@endsection
