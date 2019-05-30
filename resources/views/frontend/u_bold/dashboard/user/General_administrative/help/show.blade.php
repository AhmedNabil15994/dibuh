@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/user_settings.help') }}
@endsection

@section('contentheader_title')
{{ trans('backend/user_settings.help') }}
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
            @if ($message = Session::get('flash_message'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif



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
                                        <th>User Name</th><th> Title </th><th> Message </th><th> Replay on it </th><th> Appear on front</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($helps as $item)
                                      <tr>
                                        <?php  $user_name=App\Models\User::where('id',$item->user_id)->first()->name; ?>
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




                                          <td>
                                            @permission('account-edit')
                                           <a class="btn btn-primary btn-xs"   data-toggle="modal" data-target="#EditModal" data-id="{{$item->id}}"><i class="fa fa-edit"></i> {{ trans('button.edit') }}</a>
                                            @endpermission

                                             @permission('account-delete')
                                                 {!! Form::open(['method' => 'DELETE','route' => ['admin::tax.destroy', $item->id], 'class' =>' form-delete','style'=>'display:inline']) !!}
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
            @permission('account-edit')
            <form class="form-horizontal" role="modal">
                <div class="modal-body" id="taxes-body" style="margin-bottom: 40px;">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <div class="col-sm-4">
                                <strong>Appear on front end :</strong>
                            </div>
                          {{Form::checkbox('appear',null,['class'=>"form-control"])}}
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
                    {{Form::hidden('help-id',null,['id'=>'help-id'])}}


                    <div id="ReplaySection "class="col-xs-12 col-sm-12 col-md-12" hidden >
                        <div class="form-group">

                            <div class="col-sm-4">
                                <h3>Previous Replays :</h3><br>
                            </div>
                            @foreach($replays as $replay)
                            <?php
                                  $admin_name=App\Models\User::where('id',$item->user_id)->first()->name;
                            ?>
                          <div>
                            <p>{{$admin_name}}</p>
                            <p>  {{$replay->replay}} </p></div>
                           @endforeach
                        </div>
                    </div>



                </div>
                {!! Form::open(['method' => 'POST','route' => ['admin::tax.editTax'],'style'=>'display:inline']) !!}
                <div class="modal-footer" style="border-top: 0; margin-top: 20px;">
                    <button type="button" class="btn btn-sm btn-success" data-dismiss="modal"><i class="fa fa-save"></i> {{ trans('button.edit') }}</button>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-home"></i>{{ trans('button.close') }}</button>
                </div>
                {!! Form::close() !!}
           </form>
            @endpermission
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
   jQuery(document).ready(function($) {
function previous_replays(id)
{
  console.log(id);
  var url = "{{ route('helps.replays')}}";
    //console.log(url);
  $.get(url+'/'+id,function(result){
  console.log(result.replays);
  $.each(result.replays,function(index,value){
    $('#FROM_DEALER').append('<option value="'+index+'">'+value+'</option>');
  });

  });
}

$('#EditModal').on('show.bs.modal',function(e){
var id=$(e.relatedTarget).data('id');
console.log(id);
$('#help-id').val(id);
//console.log(data);
previous_replays(id);
});
});


</script>
@endsection
