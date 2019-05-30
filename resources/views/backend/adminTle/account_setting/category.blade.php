@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/category.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/category.title') }}
@endsection

@section('contentheader_description')
 

@endsection

<!--breadcrumb current page-->
@section('previous_breadcrumb')
{{ trans('backend/account.list') }}
@endsection

@section('current_breadcrumb')
{{ trans('backend/category.list') }}
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<!--****************************************************************************************************************************-->
<div id="cat-modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">{{ trans('backend/category.add') }}</h4>
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
        {!! Form::open(['method' => 'POST','route' => ['admin::category.addCat'],'class'=>'add_cat']) !!} 
            <div class="modal-body">
  
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/category.name')}} :</strong>
                        </div>
                        {!! Form::text('name', null, array('placeholder' => trans('backend/category.name'),'class' => 'form-control name' , 'required' => ''  )) !!}                    
                        
                    </div>
                </div>  
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/category.description')}} :</strong>
                        </div>
                        {!! Form::text('description', null, array('placeholder' => trans('backend/category.description'),'class' => 'form-control description' , 'required' => '' )) !!}                         
                        <input type="hidden" name="code" class="code">
                        <input type="hidden" name="i" class="i">
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
 <div class="item item2">
            
            <div class="row">   
               
                <?php 
                    $code = '';
                    $id   = '';
                    if(count($cat)<1){
                        $code = 0 ; 
                        $id = 0;
                    }else{
                        foreach ($cat as $key => $value) {
                           $code = $value->code;
                           $id   = $value->id;
                        }
                    }
                    ?>
                 <button type="button" class="btn btn-success btn-circle pull-right add-cat" value="<?php echo $code; ?>" value1="<?php echo $id; ?>"><i class="fa fa-plus"></i> <span>{{ trans('button.create') }}</span></button>
            </div>  
            <table class="table table-hover" id="cat-table" style="width: 99%;border: 1px solid #DDD;">
                <thead>
                    <tr style="background-color: #f8f8f9;">
                        <th>{{ trans('master.no#') }}</th>
                        <th>{{ trans('backend/category.code') }}</th>
                        <th>{{ trans('backend/category.name') }}</th> 
                        <th>{{ trans('master.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; ?>
                    @foreach ($cat as $key => $accountCategory)
                    <tr class="tab-row-cat{{$accountCategory->id}}">

                        <td>{{ ++$i }}</td>
                        <td class="cat-code">{{ $accountCategory->code }}</td>
                        <td class="cat-name"><input style="text-align: center;border: 0;" type="text" name="category_name" id="category_name" disabled value="{{ $accountCategory->name }}"> <input type="hidden" id="category_id" value="{{$accountCategory->id}}"></td>
                        <td class="cat-description hidden">{{$accountCategory->description}}</td>     
                        <td>
                            
                            @permission('account-delete')
                                
                                <button name="delete" class="btn btn-danger btn-xs  delete-cat" value="{{$accountCategory->id}}" alt=" {{trans('button.delete')}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button>
                                                       
                                
                            @endpermission
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="box-footer">
                <div class="pagination-wrapper">{!! $cat->render() !!} </div>
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
/*****************Delete  Category Function*****************************************************************************/
        function delCategory(id){
            $('#confirm-delete').modal({ backdrop: 'static', keyboard: false });
            $('#confirm-delete #delete-btn').unbind('click');
            $('#confirm-delete #delete-btn').on('click',function(){
                //$('.account-delete').submit();   

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/removeCat') }}',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id
                    },
                    success: function(data) {
                        $('.tab-row-cat'+id).remove();
                        $('#confirm-delete').modal('toggle');
                    }
                });
            });                    
        }
/******************************Edit Category Function*******************************************************************/        

        $('#category_name').each(function(){
            $(document).on('dblclick','#category_name',function(e){
                e.preventDefault();
                e.stopPropagation();
                selected = $(this);
                selected.removeAttr('disabled');
                $('#category_name').unbind('keypress');
                $(document).on('keypress','#category_name',function(e) {
                    if(e.which == 13) {
                       var id = selected.siblings('#category_id').val();
                       var name = selected.val();
                       
                       e.preventDefault();
                        e.stopPropagation();
                        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                        $.ajax({
                            type: 'post',
                            url: '{{ URL::to('backend/editCat') }}',
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


/*****************************************Delete  Category Function*****************************************************/
       $('.item2').on('click','.add-cat',function (){
            /**********Value 1 Code     Value 2 ID**************/
            var code = $(this).val();
            var id = $(this).attr('value1');
            id = ++id;
            code = ++code;
            $('.code').val(code);
            $('#cat-modal').modal({ backdrop: 'static', keyboard: false });
            //$('#cat-modal .btn-success').unbind('click');
            $('#cat-modal .btn-success').on('click',function(e){

                var rowCount = $('#cat-table tr').length;   
                e.preventDefault();
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                type: 'post',
                url: '{{ URL::to('backend/addCat') }}',
                data: {
                '_token': $('input[name=_token]').val(),
                'name': $('#cat-modal .name').val(),
                'description': $('#cat-modal .description').val(),
                'code': $('input[name=code]').val(),
                },
                success: function(data) {
                    $('#cat-table').append("<tr class='tab-row-cat" + id + "'><td>"+rowCount+"</td><td class='cat-code'>" + $('input[name=code]').val() + "</td><td class='cat-name'><input style='text-align: center;border: 0;' type='text' name='category_name' id='category_name' disabled value='"+$('#cat-modal .name').val()+"'> <input type='hidden' id='category_id' value='"+ id +"'></td><td class='cat-description hidden'>"+$('#cat-modal .description').val()+"</td><td><button name='delete' class='btn btn-danger btn-xs  delete-cat' value='"+id+"' alt=' {{trans('button.delete')}}'><i class='fa fa-trash'></i> {{ trans('button.delete') }}</button>   </td></tr>");
                    
                    $('#cat-modal').modal('toggle');
                    $('#cat-modal input').val(' ');
                    $('.add-cat').val(++id);
                    rowCount = ++rowCount;
                    close();
                   
                }
                });
            });
        });   
/**************************Delete Category Event************************************************************************/     
        $('.item2').on('click','.delete-cat',function(e){
                e.preventDefault();
                e.stopPropagation();
                var id = $(this).attr('value');
                delCategory(id);                                                 
        });

/************************Delete Category Event**************************************************************************/
       
});	



</script>

@endsection