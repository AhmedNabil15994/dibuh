@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/user_settings.help') }}
@endsection

@section('contentheader_title')
{{ trans('backend/user_settings.help') }}
<a class="btn btn-primary "   data-toggle="modal" data-target="#FaqModal" ></i>{{trans('backend/main.faq')}} </a>

@endsection

@section('contentheader_description')


@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/user_settings.help') }}
@endsection
@section('page-styles')
<style type="text/css">
    .modal-header-success {
        color:#fff;
        padding:9px 15px;
        border-bottom:1px solid #eee;
        background-color: #5cb85c;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }
    .modal-header-warning {
        color:#fff;
        padding:9px 15px;
        border-bottom:1px solid #eee;
        background-color: #f0ad4e;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }
    .modal-header-danger {
        color:#fff;
        padding:9px 15px;
        border-bottom:1px solid #eee;
        background-color: #d9534f;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }
    .modal-header-info {
        color:#fff;
        padding:9px 15px;
        border-bottom:1px solid #eee;
        background-color: #5bc0de;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }
    .modal-header-primary {
        color:#fff;
        padding:9px 15px;
        border-bottom:1px solid #eee;
        background-color: #428bca;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }
</style>
@endsection



@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box box-info">
          <div class="alerts">

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




            <div class="box-header with-border">
                <div class="pull-left">

                     <h3 class="box-title">{{ trans('backend/user_settings.help') }}</h3>


                </div>

            </div>




                        <div class="table-responsive">
                        <div class="box-body">
                            <table class="table table-borderless deleteFormModal" data-form="deleteForm">
                                <thead>
                                    <tr>
                                        <th>User Name</th><th> Title </th><th> Message </th><th> Replay on it </th><th> Appear on front</th><th>FAQ؟</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($helps as $item)
                                      <tr>
                                        <?php  $user_name=App\Models\User::where('id',$item->user_id)->first()->name;
                                              $replays_count=App\Models\HelpingReplay::where('helping_id',$item->id)->count();
                                         ?>
                                          <td>{{ $user_name }}</td>
                                          <td>{{ $item->title }}</td>
                                          <td>{{ $item->subject }}</td>
                                           @if($item->replay_status)
                                               <td>تم الرد </td>
                                            @else
                                               <td> لم يتم الرد </td>
                                            @endif

                                            @if($item->appear_status)
                                              <td>تظهر </td>
                                             @else
                                               <td>لا تظهر </td>
                                             @endif
                                             @if($item->faq_status)
                                                 <td width="2%">نعم</td>
                                              @else
                                                 <td width="2%"> لا</td>
                                              @endif




                                          <td>
                                            @permission('account-edit')
                                           <a class="btn btn-primary btn-xs"   data-toggle="modal" data-target="#EditModal" data-id="{{$item->id}}" data-replay_count="{{$replays_count}}" data-status_appear="{{$item->appear_status}}"><i class="fa fa-share"></i>الرد على الرساله </a>
                                            @endpermission

                                             @permission('account-delete')
                                                 {!! Form::open(['method' => 'DELETE','route' => ['helps.destroy', $item->id], 'class' =>' form-delete','style'=>'display:inline']) !!}
                                                       <button type="submit" name="delete" class="btn btn-danger btn-xs  delete" alt=" {{trans('button.delete')}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button>
                                                 {!! Form::close() !!}
                                             @endpermission

                                          </td>
                                      </tr>
                                  @endforeach
                                </tbody>
                            </table>

                            <div class="box-footer">
    <div class="pagination-wrapper"> {!! $helps->render() !!} </div>
                            </div>
                        </div>


        </div>
    </div>
</div>
</div>
<!-- Modal Edit -->

	<div id="EditModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-danger">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                <h4 class="modal-title"> <i class="fa fa-pencil"></i>{{ trans('backend/user_settings.help') }} Rplay </h4>
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
              {{ Form::open(['route' =>'admin::helps_updates','style'=>'display:inline']) }}

                <div class="modal-body" id="taxes-body" style="margin-bottom: 40px;">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <div class="col-sm-4">
                                <strong>Appear on front end :</strong>
                            </div>

                          {{Form::checkbox('appear', "1","0",['id'=>'status_appear'])}}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <div class="col-sm-4">
                                <strong>Your Replay:</strong>
                            </div>
                            <textarea  name="replay"  class="form-control"row="3"></textarea>

                        </div>
                    </div>

                 {{Form::hidden('help_id',null,['id'=>'help-id'])}}

                    <div id="ReplaySection"class="col-xs-12 col-sm-12 col-md-12" hidden >
                          <strong>Previous replays:</strong>

                          <table class="table table-bordered" id="replaysTable">
                            <thead  class="tabel-head">
                               <tr>
                                      <th> اسم الادمن</th>
                                      <th>الرد</th>
                                      <th> مسح</th>
                               </tr>
                            </thead>
                            <tbody>

                            </tbody>

                          </table>



                    </div>



                <div class="modal-footer" style="border-top: 0; margin-top: 20px;">
                    <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> الرد</button>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-home"></i>{{ trans('button.close') }}</button>
                </div>
                {!! Form::close() !!}


               </div>
            </div>
        </div>
      </div>
        <!-- modal edit -->
        <!-- Modal FAQ -->

        	<div id="FaqModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-danger">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                        <h4 class="modal-title"> <i class="fa fa-pencil"></i>{{ trans('backend/main.faq') }} Rplay </h4>
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


                      {{ Form::open(['route' =>'admin::helps_faq','style'=>'display:inline']) }}

                        <div class="modal-body" id="taxes-body" style="margin-bottom: 40px;">
                          <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="form-group">
                                      <strong>The title:</strong>
                                      {{Form::text('title',null,null,[ "class"=>"form-control","style"=>"width:500px;"])}}

                              </div>
                          </div>

                          <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="form-group">

                                  <div class="col-sm-4">
                                      <strong>Your Message:</strong>
                                  </div>
                                  <textarea  name="message"  class="form-control"row="3"></textarea>

                              </div>
                          </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <div class="col-sm-4">
                                        <strong>Your Replay:</strong>
                                    </div>
                                    <textarea  name="replay"  class="form-control"row="3"></textarea>

                                </div>
                            </div>




                        <div class="modal-footer" style="border-top: 0; margin-top: 20px;">
                            <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> {{trans('button.save')}}</button>
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-home"></i>{{ trans('button.close') }}</button>
                        </div>
                        {!! Form::close() !!}

                    @endpermission
                       </div>
                    </div>
                </div>
                <!-- modal FAQ -->

@endsection

@section('page-scripts')
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>



    function deleteReplay(id)
    {
      var action = $("#deleteForm").attr('action');
      if(id!=0)
      {
        row = $('#' + id);
       $.get(action,function(result){
         console.log(this);
    //   $('#replaysTable').closest('tr').remove();
    //  $($(this).closest("tr")).remove()
      $(row).remove();
       },'json');
       return false;
     }
   }



  $(document).ready(function(){


  function previous_replays(id)
    {

      var url = "{{ route('admin::helps.replays')}}";
    //console.log(url);
      $.get(url+'/'+id,function(result){
      $('#replaysTable').empty();
      $('#ReplaySection').show();

      for(i=0;i<result.count;i++)
      $('#replaysTable').append("<tr id="+result.replays[i]['id']+">"+
                                    "<td>"+result.replays[i]['name']+"</td>"+
                                    "<td>"+result.replays[i]['replay']+"</td>"+
                                    "<td><form method='get'  id='deleteForm' onsubmit='event.preventDefault();deleteReplay("+result.replays[i]['id']+");'  action='/dashboard/helps/delete/replay/"+result.replays[i]['id']+"'>"+
                                              "<input type='hidden' name='_token'  id='csrf-token' value='{{ Session::token() }}' >"+
                                              "<button type='submit'id='delete-replay' class='fa fa-trash ' ></button>"+
                                         "</frorm></td>"
                              +"</tr>");
    //  $('#replaysTable > tbody:last-child').append('<tr>...</tr><tr>...</tr>');



  });
}
//==delete replay//

// $('#delete-replay').submit(function(){
//   var this_objct = this;
//   alert('ok');
//   $.post($(this).attr('action'),$(this).serialize(),function(result){
//   $(this_objct).closest('tr').remove();
//   },'json');
//   return false;
// });

$('#EditModal').on('show.bs.modal',function(e){
               var id=$(e.relatedTarget).data('id');
               var replay_count=$(e.relatedTarget).data('replay_count');
               var status_appear=$(e.relatedTarget).data('status_appear');
console.log(status_appear);
               $('#help-id').val(id);
                 if(status_appear==0)
                   $("#status_appear").prop('checked',false);
                 else
                     $("#status_appear").prop('checked',true);
            if(replay_count>0)
                     previous_replays(id);
           else
                     $('#ReplaySection').hide();


});

});


</script>
@endsection
