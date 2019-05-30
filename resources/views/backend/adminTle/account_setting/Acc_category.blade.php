@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/account_category.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/account_category.title') }}
@endsection

@section('contentheader_description')
 

@endsection

<!--breadcrumb current page-->
@section('previous_breadcrumb')
{{ trans('backend/account.list') }}
@endsection

@section('current_breadcrumb')
{{ trans('backend/account_category.list') }}
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<!--****************************************************************************************************************************-->
<div id="acc-cat-modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">{{ trans('backend/account_category.create_new') }}</h4>
            </div>
          
            <div class="alert alert-danger hidden">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    <li class="error"></li>
                </ul>
            </div>
          
        {!! Form::open(['method' => 'POST','route' => ['admin::account_category.addAccCat'],'class'=>'add_acc_cat']) !!} 
            <div class="modal-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-5">
                            <strong>{{ trans('backend/account_category.code')}} :</strong>
                        </div>
                        {!! Form::number('acc-cat-code', null, array('placeholder' => trans('backend/account_category.code'),'class' => 'form-control acc-cat-code', 'min' => 0 )) !!}                                          
                    </div>
                </div>  
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-5">
                            <strong>{{ trans('backend/account_category.name')}} :</strong>
                        </div>
                        {!! Form::text('acc-cat-name', null, array('placeholder' => trans('backend/account_category.name'),'class' => 'form-control acc-cat-name' )) !!}                   
                    </div>
                </div> 
                
            </div>
            <div class="modal-footer" style="border-top: 0">
                <button type="button" class="btn btn-success" style="background-color: #449d44"><i class="fa fa-save"></i> {{ trans('button.create') }}</button>
                <button type="button" class="btn btn-danger btn-close" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<!--****************************************************************************************************************************-->
    <div class="item3">
            
            <div class="row">   
                <?php 
                    $id   = '';
                    if(count($acc_cat)<1){
                        $id = 0;
                    }else{
                        foreach ($acc_cat as $key => $value) {
                           $id   = $value->id;
                        }
                    }
                    ?>
                 <button type="button" class="btn btn-success btn-circle pull-right add-acc-cat" value="<?php echo $id; ?>"><i class="fa fa-plus"></i> <span>{{ trans('button.create') }}</span></button>
            </div>  
            <table class="table table-hover" id="acc-cat-table" style="width: 99%;border: 1px solid #DDD;">
                <thead>
                    <tr style="background-color: #f8f8f9;">
                        <th>{{ trans('master.no#') }}</th>
                        <th>{{ trans('backend/account_category.code') }}</th>
                        <th>{{ trans('backend/account_category.name') }}</th> 
                        <th>{{ trans('master.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; ?>
                    @foreach ($acc_cat as $key => $accountCategory)
                    <tr class="tab-row-acc-cat{{$accountCategory->id}}">

                        <td>{{ ++$i }}</td>
                        <td class="acc-cat-code">{{ $accountCategory->code }}</td>
                        <td class="acc-cat-name"><input style="text-align: center;border: 0;" type="text" name="acc_category_name" id="acc_category_name" disabled value="{{ $accountCategory->name }}"> <input type="hidden" id="acc_category_id" value="{{$accountCategory->id}}"></td>
                        <td class="cat-description hidden">{{$accountCategory->name}}</td>    
                        <td>
                            
                             
                            @permission('account-delete')                     
                                <button name="delete" class="btn btn-danger btn-xs  delete-acc-cat" value="{{$accountCategory->id}}" alt=" {{trans('button.delete')}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button> 
                            @endpermission
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="box-footer">
                <div class="pagination-wrapper">{!! $acc_cat->render() !!} </div>
            </div>
    </div>
<!--****************************************************************************************************************************-->
@endsection

@section('page-styles')
<meta name="csrf-token" content="{{ csrf_token() }}">   
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" href="plugins/select2/select2.min.css">  
<style type="text/css">
    .content-wrapper, .right-side , .wrapper{
        background-color: #FFF !important;
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

<!--****************************************************************************************************************************-->
@section('page-scripts')

@include(Config::get('back_theme').'.layouts.modals.comfirm_delete')  
<script src="plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
	$(function(){

        $('.breadcrumb .prev').toggle();
        $('.breadcrumb .prev a').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = "{{URL::to('backend/account_view')}}";
        });

		$(document).on('click','.pagination a',function(e){
            e.preventDefault();
            var page = $(this).attr('href');
            getItems(page);
            window.history.pushState("", "", page);
        });                

        function getItems(page){
            $.ajax({
                url:page
            }).done(function(data){
                $('.item.acc').html($(data).find(".pag"));
            });
        }
        $(".select2").select2();
/*****************************Modal Close Button Function*************************************************************/           
        function close(){
            $('.modal input').val('');
            $('select').prop('selectedIndex',-1);
            $('.modal .alert').addClass('hidden');
        }
/*****************************Modal Close Button Event*****************************************************************/        
        $('.btn-close, .close').on('click',function(){
            close();
        });

/**************************Delete Account Category Function*************************************************************/
        function delAccCategory(id){
            $('#confirm-delete').modal({ backdrop: 'static', keyboard: false });
            $('#confirm-delete #delete-btn').unbind('click');
            $('#confirm-delete #delete-btn').on('click',function(){
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/removeAccCat') }}',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id
                    },
                    success: function(data) {
                        $('.tab-row-acc-cat'+id).remove();
                        $('#confirm-delete').modal('toggle');
                    }
                });
            });                    
        }
/**************************Edit Account Category Function*************************************************************/     
         $('#acc_category_name').each(function(){
            $(document).on('dblclick','#acc_category_name',function(e){
                e.preventDefault();
                e.stopPropagation();
                selected = $(this);
                selected.removeAttr('disabled');
                $('#acc_category_name').unbind('keypress');
                $(document).on('keypress','#acc_category_name',function(e) {
                    if(e.which == 13) {
                       var id = selected.siblings('#acc_category_id').val();
                       var name = selected.val();
                       
                       e.preventDefault();
                        e.stopPropagation();
                        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                        $.ajax({
                            type: 'post',
                            url: '{{ URL::to('backend/editAccCat') }}',
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'id': id,
                                'name': name
                                
                            },
                            success: function(data) {
                                selected.attr('disabled',true);
                            }
                        });


                    }
                });

            });
        });
/*********************Delete Account Category Event*******************************************************************/
        $('.item3').on('click','.delete-acc-cat',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).attr('value');
            delAccCategory(id);     
            
        });
/****************************Edit Account Category Event**************************************************************/
        $('.item3').on('click','.edit-acc-cat',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).attr('value');
            var name = $(this).parent().siblings('.acc-cat-name').text();
            var description = $(this).parent().siblings('.acc-cat-code').text(); 
            editAccCategory(id,name,description);                                      

        });        
/************************Add Account Category Event*******************************************************************/
        $('.item3').on('click','.add-acc-cat',function(){
            var id = $(this).val();
            id = ++id;
            var rowCount = $('#acc-cat-table tr').length;
            $('#acc-cat-modal').modal({ backdrop: 'static', keyboard: false });
            $('#acc-cat-modal .btn-success').unbind('click');
            $('#acc-cat-modal .btn-success').on('click',function(e){
                e.preventDefault();
                 
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'POST',
                    url: '{{ URL::to('backend/addAccCat') }}',
                    data: {
                    '_token': $('input[name=_token]').val(),
                    'name': $('#acc-cat-modal .acc-cat-name').val(),
                    'code': $('#acc-cat-modal .acc-cat-code').val()                  
                    },
                    success: function(data) {
                        $('#acc-cat-table').append("<tr class='tab-row-acc-cat" + id + "'><td>"+rowCount+"</td><td class='acc-cat-code'>" + $('.acc-cat-code').val() + "</td><td class='acc-cat-name'><input style='text-align: center;border: 0;' type='text' name='acc_category_name' id='acc_category_name' disabled value='"+ $('.acc-cat-name').val() + "'> <input type='hidden' id='acc_category_id' value='"+ id +"'></td><td><button name='delete' class='btn btn-danger btn-xs  delete-acc-cat' value='"+id+"' alt=' {{trans('button.delete')}}'><i class='fa fa-trash'></i> {{ trans('button.delete') }}</button>   </td></tr>");
                        $('#acc-cat-modal').modal('toggle');
                        $('.add-acc-cat').val(++id);
                        $('#acc-cat-modal input').val('');

                        rowCount = ++rowCount;
                        close();
                        /*$('.item3').on('click','.delete-acc-cat',function(e){
                            e.preventDefault();
                            e.stopPropagation();
                            var id = $(this).attr('value');
                            delAccCategory(id);     
                            
                        });
                        $('.item3').on('click','.edit-acc-cat',function(e){
                            e.preventDefault();
                            e.stopPropagation();
                            var id = $(this).attr('value');
                            var name = $(this).parent().siblings('.acc-cat-name').text();
                            var description = $(this).parent().siblings('.acc-cat-code').text(); 
                            editAccCategory(id,name,description);                                      

                        });      */  
                    },
                    error: function(data){
                        var errors = data.responseJSON;
                        $('#acc-cat-modal .alert').removeClass('hidden');
                        $('#acc-cat-modal .error').text(errors['code'] || errors['name']); 
                    }
                });
            });
        });

/*********************************************************************************************************************/ 
	});
</script>
@endsection
