@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/main.temp') }}
@endsection

@section('contentheader_title')
{{ trans('backend/main.temp') }}

@endsection

@section('contentheader_description')
{{ trans('backend/main.temp') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/main.temp') }}
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div id="add-modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">{{ trans('backend/main.add_email') }}</h4>
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
            

                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/main.name')}} :</strong>
                            </div>
                            {!! Form::text('name', null, array('placeholder' => trans('backend/main.em_name'),'class' => 'form-control name' , 'required' => '' ,'style' => 'width:50%;' )) !!}                    
                            
                        </div>
                    </div>  
                </div>
            
            <div class="modal-footer" style="border-top: 0">
                <button type="submit" class="btn btn-success" style="background-color: #449d44"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>
            
        
        </div>
        
    </div>
</div>

        <div class="pag">
                <div class="row" style="margin-bottom: -35px;margin-right: 2px;">
                        <button type="button" class="btn btn-success btn-circle pull-right add"><i class="fa fa-plus"></i> <span>{{ trans('backend/main.add') }}</span></button>
                </div>
                 <table class="table table-hover table-bordered daTatable dataTable deleteFormModal text-center demo-foo-filtering" data-form="deleteForm" id="users-table">
                    <thead>
                        <tr style="background-color: #EEE;">
                            <th>{{ trans('master.no') }}</th>
                            <th>{{ trans('backend/main.name') }}</th>
                            <th>{{ trans('backend/main.subject') }}</th>
                            <th>{{ trans('backend/main.content') }}</th>
                            <th>{{ trans('backend/main.details') }}</th>
                            <th>{{ trans('master.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>      
                        <?php $i=0; $disabled='';?>
                        @foreach($data as $row)
                        <tr class="record{{$row->id}}">
                            <td>{{++$i}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->subject}}</td>
                            <td>-------</td>
                            <td>-------</td>
                            <td>
                                
                                <a style="padding-left: 8px;" class="btn show_btn  hidden btn-primary   detail-btn waves-effect waves-light" href="{{ route('admin::email.show' , ['id' => $row->id]) }}"><i class="fa fa-vcard"></i>  {{trans('frontend/sales_invoice.show')}}</a>

                                {!! Form::open(['method' => 'POST','route' => ['admin::email.destroy',$row->id],'style'=>'display:inline']) !!}
                                @if($row->id == 1 ||$row->id == 2 || $row->id == 3 || $row->id == 4 )
                                <?php $disabled = 'disabled'; ?>
                                @else
                                <?php $disabled = '';?>
                                @endif
                                <button style="padding-right: 10px; padding-left: 5px;" type="submit" class="btn btn-danger btn-xs delete" value="{{$row->id}}" link="{{route('admin::email.destroy' , $row->id)}}" {{$disabled}}><i class="fa fa-close"></i> {{trans('frontend/sales_invoice.delete')}}</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>         
                        @endforeach
                    </tbody>    
                    
                </table>
                
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
    .notifyjs-bootstrap-base.notifyjs-bootstrap-error{
        background-color: #d9534f !important;
        color: #FFF !important;
        border-color: #d43f3a !important;
    }
    .notifyjs-bootstrap-base.notifyjs-bootstrap-success{
        background-color: #449d44 !important;
        color: #FFF !important;
        border-color:#398439 !important;
    }
    .pag{
        border: 1px solid #DDD;
        padding: 20px 20px; 
        background-color: #FFF;
        border-radius: 5px;
        box-shadow: 5px 5px 5px #999;
        margin-top: 50px;
    }
    table td{
        text-align: left !important;
    }
    table tbody tr{
        cursor: pointer;
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
        float: left;
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
<script src="{{URL::to('').Config::get('assets_frontend')}}plugins/notifications/notify.min.js"></script>
<script type="text/javascript">
    $(function(){

        $(document).on('click','.add',function(){
            $('#add-modal').modal({ backdrop: 'static', keyboard: false });
        });    

        $('#add-modal .btn-success').on('click',function(){
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: 'post',
                url: "{{route('admin::email.new')}}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'name': $('#add-modal input[type="text"]').val()
                },
                success: function(data) {
                    if(isNaN (data)){
                    $.each(data['errors'], function(i, item) {
                        $.notify("Whoops \n"+item,{ position:"top right" ,className:"error"});
                    });
                            
                       
                    }else if(data==1){
                        $.notify("Saved successfully \n Email saved successfully In Emails",{ position:"top right" ,className:"success"});
                        location.reload();
                    }  
                },
                error: function(data){
                    $.notify("Whoops \n Error may be in connection to server",{ position:"top right" ,className:"error"});
                }
            });
        });

        $(document).on('click','.demo-foo-filtering tbody tr',function(){
              var route  = $(this).find('.show_btn').attr('href');
              window.location.href=route;
        });

        $(".select2").select2();
        var oTable = $('.demo-foo-filtering').DataTable({
                      "ordering": false
        });
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
        
        $(document).on('click','.delete',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).attr('value');
            var route = $(this).attr('link');
            $('#confirm-delete').modal({ backdrop: 'static', keyboard: false });
            $('#confirm-delete #delete-btn').unbind('click');
            $('#confirm-delete #delete-btn').on('click',function(){
                //$('.account-delete').submit();   
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'POST',
                    url: route,
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id
                    },
                    success: function(data) {
                        $('.record'+id).remove();
                        $.notify("Deleted successfully \n Email deleted successfully From Emails",{ position:"top right" ,className:"success"});
                        $('#confirm-delete').modal('toggle');
                    }
                });
            });
                                    
                                  
        }); 
    
    });
</script>
 
@endsection
