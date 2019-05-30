@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/account.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/account.title') }}
@endsection

@section('contentheader_description')
 

@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/account.list') }}
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


<div id="modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">{{ trans('backend/account.create_new') }}</h4>
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
            {!! Form::open(array('route' => 'admin::account.addAccount','method'=>'POST')) !!}
            <div class="modal-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.parent_id')}} :</strong>
                        </div>    
                        <select class="form-control select2" name="parent_id">
                            <option>{{trans('master.select_item_from_list')}}</option>   
                            @foreach($parent as $item)
                            <option value="{{ $item->id}}">{{ $item->name }}</option>
                            @endforeach 
                        </select>                     
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.account_code')}} :</strong>
                        </div>
                        {!! Form::number('account_code', null, array('placeholder' => trans('backend/account.account_code'),'class' => 'form-control' ,'min' => 0)) !!}                        
                        
                    </div>
                </div>  
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.is_major')}} :</strong>
                        </div>    
                         <select class="form-control select2" name="is_major">
                            <option>{{trans('master.select_item_from_list')}}</option>                             
                            
                            <option value="0">{{trans('master.no')}}</option>
                            <option value="1">{{trans('master.yes')}}</option>
                        </select>                       
                    </div>
                </div>                        
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.name')}} :</strong>
                        </div>
                        {!! Form::text('name', null, array('placeholder' => trans('backend/account.name'),'class' => 'form-control' )) !!}                        
                        
                       <input type="hidden" name="created_by" value="{{$created_by}}">
                    </div>
                </div>  
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.text')}} :</strong>
                        </div>
                        {!! Form::text('text', null, array('placeholder' => trans('backend/account.text'),'class' => 'form-control' )) !!}                        
                        
                    </div>
                </div>   

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.description')}} :</strong>
                        </div>
                        {!! Form::text('description', null, array('placeholder' => trans('backend/account.description'),'class' => 'form-control' )) !!}                        
                        
                    </div>
                </div>  
   
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.category')}} :</strong>
                        </div>    
                         <select class="form-control select2" name="category">
                            <option>{{trans('master.select_item_from_list')}}</option>                             
                            @foreach($category as $item)
                            <option value="{{ $item->id}}">{{ $item->name}}</option>
                            @endforeach 
                        </select>                        
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account_category.account_category')}} :</strong>
                        </div>
                        <select class="form-control select2" name="account_category">
                            <option>{{trans('master.select_item_from_list')}}</option>                             
                            @foreach($account_category as $item)
                            <option value="{{ $item->id}}">{{ $item->name}}</option>
                            @endforeach 
                        </select>                      
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.account_type')}} :</strong>
                        </div>    
                        <select class="form-control select2" name="account_type_id">
                            <option>{{trans('master.select_item_from_list')}}</option>                             
                            @foreach($account_type as $item)
                            <option value="{{ $item->id}}">{{ $item->name}}</option>
                            @endforeach 
                        </select>                       
                    </div>
                </div>
 

                
                <div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.is_common')}} :</strong>
                        </div>    
                        <select class="form-control select2" name="is_common">
                            <option>{{trans('master.select_item_from_list')}}</option>                             
                            
                            <option value="0">{{trans('master.no')}}</option>
                            <option value="1">{{trans('master.yes')}}</option>
                        </select>                              
                    </div>
                </div>       
            </div>
            <div class="modal-footer" style="border-top: 0">
                <button type="submit" class="btn btn-success" style="background-color: #449d44"><i class="fa fa-save"></i> {{ trans('button.create') }}</button>
                <button type="button" class="btn btn-danger btn-close" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<!--******************************************************************************************************************-->


    <!--************************************** Account View **************************************************-->            
<div class="item acc item1 active">
            <div class="pag">
            <div class="row">   
                
                 <button type="button" style="display: inline-block;" class="btn btn-success btn-circle pull-right add-account" data-target="tabs_modal"><i class="fa fa-plus"></i> <span>{{ trans('button.create') }}</span></button>
            </div>  
            
            <table class="table table-hover" id="acc-table" style="width: 99%;border: 1px solid #DDD;">
                <thead>
                    <tr style="background-color: #f8f8f9;">
                        
                        <th style="width: 15%;">
                            <form action="#" method="get" id="form_search" class="form-horizontal  col-sm-4" style="display: block; width: 100%; padding: 0;">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="{{ trans('backend/account.account_code') }}" id="search">
                                    
                                </div>
                            </form>
                        </th>
                        <th style="width: 15%;">{{ trans('backend/account.name') }}</th>        
                        <th style="width: 15%;">{{ trans('backend/account.text') }}</th>
                        <th style="width: 10%;">{{ trans('backend/account.parent_id') }}</th>         
                        <th style="width: 10%;">{{ trans('backend/account.account_type') }}</th>
                        <th style="width: 15%;">{{ trans('backend/account.category') }} <a href="{{ route('admin::account_setting.category') }}" class="btn btn-primary btn-small btn-icon-only btn-inverse edit-cat" style="padding: 3px 8px;"><i class="fa fa-pencil"></i></a></th>   
                        <th style="width: 20%;">{{ trans('backend/account_category.title') }} <a href="{{ route('admin::account_setting.Acc_category') }}" class="btn btn-primary btn-small btn-icon-only btn-inverse edit-cat" style="padding: 3px 8px;"><i class="fa fa-pencil"></i></a></th>  
                        <th>{{ trans('master.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; ?>
                    @foreach ($data as $key => $account)
                    <tr class="tab-row-acc{{$account->id}}">
                        
                       
                        <td class="account_code">{{ $account->account_code }}</td>
                        <td class="name">{{ $account->name }}</td>        
                        <td class="text">{{ $account->text }}</td>
                        <td class="parent">{{ $account->parent['name']}}</td>
                        <td class="account_type">{{ $account->accountType['name'] }}</td>   
                        <td class="category">{{$account->category['name']}} </td>
                        <td class="account_category">{{$account->accountCategory['name']}}</td> 
                        <input type="hidden" name="parent_id" id="parent_id" value="{{$account->parent['id']}}">
                        <input type="hidden" name="is_major" id="is_major" value="{{$account->is_major}}"> 
                        <input type="hidden" name="is_common" id="is_common"  value="{{$account->is_common}}">  
                        <input type="hidden" name="description" id="description" value="{{$account->description}}"> 
                        <input type="hidden" name="ct" id="ct" value="{{$account->company_type_id}}">
                        <input type="hidden" name="cc" id="cc" value="{{$account->category_id}}"> 
                        <input type="hidden" name="account_category_id" id="account_category_id" value="{{$account->account_category_id}}">
                        <input type="hidden" name="account_type_id" id="account_type_id" value="{{$account->account_type_id}}">   
                        <td>

                            @permission('account-edit')
                                <button type="button" class="btn btn-primary btn-xs edit-account"  value="{{$account->id}}"><i class="fa fa-edit"></i> {{ trans('button.edit') }}</button>
                            @endpermission
                 
                            @permission('account-delete')
                                
                                    <button type="button" name="delete" class="btn btn-danger btn-xs  delete-account" value="{{$account->id}}" alt=" {{trans('button.delete')}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button>                                
                                
                            @endpermission
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>        
                
            <div class="box-footer">
                <div class="pagination-wrapper">{!! $data->render() !!} </div>
            </div>
        </div>      
</div>
    <!--***************************************************************************************************-->

    <!--************************************************ Category View **************************************-->
       
    <!--****************************************************************************************************-->

    <!--******************************************* Account Category View ******************************************-->
       
    <!--****************************************************************************************************-->
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
@include(Config::get('back_theme').'.layouts.modals.edit_account')

<script src="plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
    $(function(){

        /***************************** Pagination Code******************************/
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
/*****************************Add Account Event*************************************************************************/        
        $('.item1').on('click','.add-account', function (e){
            var rowCount = $('#acc-table tr').length;
            rowCount = ++rowCount;
            e.preventDefault();
            $('#modal').modal({ backdrop: 'static', keyboard: false });
            $('#modal .btn-success').unbind('click');
            $('#modal .btn-success').on('click',function(e){
                e.preventDefault();    
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'post',
                    url: '{{ URL::to('backend/addAccount') }}',
                    data: {
                        '_token': $('#modal input[name=_token]').val(),
                        'parent_id':$('#modal select[name=parent_id]').val(),
                        'account_code': $('#modal input[name=account_code]').val(),
                        'is_major':$('#modal select[name=is_major]').val(),
                        'name': $('#modal input[name=name]').val(),
                        'text': $('#modal input[name=text]').val(),
                        'description': $('#modal input[name=description]').val(),
                        'category_id':$('#modal select[name=category]').val(),
                        'account_category_id':$('#modal select[name=account_category]').val(),
                        'account_type_id':$('#modal select[name=account_type_id]').val(),
                        'is_common':$('#modal select[name=is_common]').val(),
                        'created_by':$('#modal input[name=created_by]').val()
                    },
                    success: function(data) {   
                        $('#modal').modal('toggle');
                        close();
                        location.reload();

                    },
                    error: function(data){
                        var errors = data.responseJSON;
                        $('#acc-cat-modal .alert').removeClass('hidden');
                        $('#acc-cat-modal .error').text(errors['account_code'] || errors['name'] || errors['text'] || errors['description'] || errors['account_type_id']); 
                    }

                });
   
            });
        });    
/*****************************Delete Account Event**********************************************************************/        
        $('.item1').on('click','.delete-account',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).val();
            $('#confirm-delete').modal({ backdrop: 'static', keyboard: false });
            $('#confirm-delete #delete-btn').unbind('click');
            $('#confirm-delete #delete-btn').on('click',function(){
                //$('.account-delete').submit();   
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'POST',
                    url: '{{ URL::to('backend/removeAccount') }}',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id
                    },
                    success: function(data) {
                        $('.tab-row-acc' + id).remove();
                        $('#confirm-delete').modal('toggle');
                    }
                });
            });
                                    
                                  
        });    
/************************************Search Account*********************************************************************/

        $('.item1').on('keyup','#search',function(){
 
            $value=$(this).val();
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 
            $.ajax({ 
                type : 'POST',          
                url: '{{URL::to('backend/searchAccount')}}',
                data:{
                    '_token': $('input[name=_token]').val(),
                    'search':$value
                }, 
                success:function(data){
                   $('#acc-table tbody').html(data); 
                }   
             
            });
             
 
 
        });
 

/**************************Edit Account Event***************************************************************************/
        $('.item1').on('click','.edit-account',function(e){
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).val();
            //
            $('#edit-account .parent_id').val($(this).parent().siblings('#parent_id').val()).trigger('change');
            $('#edit-account .account_code').val($(this).parent().siblings('.account_code').text());
            $('#edit-account .is_major').val($(this).parent().siblings('#is_major').val()).trigger('change');
            $('#edit-account .name').val($(this).parent().siblings('.name').text());
            $('#edit-account .text').val($(this).parent().siblings('.text').text());
            $('#edit-account .description').val($(this).parent().siblings('#description').val());
            $('#edit-account .cc').val($(this).parent().siblings('#cc').val()).trigger('change');
            $('#edit-account .account_category').val($(this).parent().siblings('#account_category_id').val()).trigger('change');
            $('#edit-account .account_type_id').val($(this).parent().siblings('#account_type_id').val()).trigger('change');
            $('#edit-account .is_common').val($(this).parent().siblings('#is_common').val()).trigger('change');
            


            $('#edit-account').modal({ backdrop: 'static', keyboard: false });
            $('#edit-account .btn-success').unbind('click');
            $('#edit-account .btn-success').on('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                var category = '';
                var account_category = '';
                var options = $("#edit-account .account_category option");
                if(options.index($("#edit-account .account_category option:first")) == options.index($("#edit-account .account_category option:selected")))
                {
              
                    account_category = '';
                }else{
                    account_category = $('#edit-account .account_category option:selected').text();
                }
                var options2 = $("#edit-account .cc option");
                if(options2.index($("#edit-account .cc option:first")) == options2.index($("#edit-account .cc option:selected")))
                {
              
                    category = '';
                }else{
                    category = $('#edit-account .cc option:selected').text();
                }

                //$('.account-delete').submit();   
                console.log(category);
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'POST',
                    url: '{{ URL::to('backend/editAccount') }}',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id,
                        'parent_id':$('#edit-account .parent_id').val(),
                        //'account_code': $('#edit-account .account_code').val(),
                        'is_major':$('#edit-account .is_major').val(),
                        'name': $('#edit-account .name').val(),
                        'text': $('#edit-account .text').val(),
                        'description': $('#edit-account .description').val(),
                        'category_id':$('#edit-account .cc').val(),
                        'account_category_id':$('#edit-account .account_category').val(),
                        'account_type_id':$('#edit-account .account_type_id').val(),
                        'is_common':$('#edit-account .is_common').val()
                    
                    },
                    success: function(data) {

                       
                        

                        $('.tab-row-acc' + id).children('.account_code').text($('#edit-account .account_code').val());
                        $('.tab-row-acc' + id).children('.name').text($('#edit-account .name').val());
                        $('.tab-row-acc' + id).children('.text').text($('#edit-account .text').val());
                        $('.tab-row-acc' + id).children('.parent').text($('#edit-account .parent_id option:selected').text());
                        $('.tab-row-acc' + id).children('.account_type').text($('#edit-account .account_type_id option:selected').text());
                        $('.tab-row-acc' + id).children('.category').text(category);
                        $('.tab-row-acc' + id).children('.account_category').text(account_category);
                        $('#edit-account').modal('toggle');
                        close();
                    }
                });
            });
                                    
                                  
        });     


    });
</script>
 
@endsection
