@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/tax_type.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/tax_type.list') }}
@endsection

@section('contentheader_description')
 

@endsection

<!--breadcrumb current page-->
@section('previous_breadcrumb')
{{ trans('backend/tax.list') }}
@endsection

@section('current_breadcrumb')
{{ trans('backend/tax_type.list') }}
@endsection



@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<!--***************************************************************************************************************************-->
<div id="tabs_type_modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="box-title">{{ trans('backend/tax_type.create_new') }}</h4>
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
        {!! Form::open(array('route' => 'admin::tax_type.addTaxType','method'=>'POST')) !!}                
                <div class="box-body">    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group"> 
                            <div class="col-sm-3">                  
                                <strong>{{ trans('backend/tax_type.name')}} :</strong>
                            </div>                                           
                            {!! Form::text('name', null, array('placeholder' => trans('backend/tax_type.name'),'class' => 'form-control name' , 'required' => '')) !!}    
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">                    
                        </div>
                    </div>      
                </div> 
            </div>     
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" style="margin: auto; background-color: #449d44"><i class="fa fa-save"></i> {{ trans('button.create') }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>     
 		</div>
 		{!! Form::close() !!}
    </div>
</div>  
<!--***************************************************************************************************************************-->

	<div class="tax_types">
        <div class="pag">
            <div class="row">   
                <button type="button" class="btn btn-success btn-circle pull-right tax-type-add" data-target="tabs_modal"><i class="fa fa-plus"></i> <span>{{ trans('backend/tax.add') }}</span></button>
            </div>  
            <table class="table table-hover col-sm-6" id="tax-type-table" style="width: 60%;margin-left: 20%; margin-right: 20% ; border: 1px solid #DDD;">
                <thead>
                    <tr style="background-color: #f8f8f9;">
                        <th style="width: 50px;">{{ trans('master.no#') }}</th>
                        <th class="edit"><div>{{ trans('backend/tax_type.name') }}</div></th>
                        <th>{{ trans('master.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach ($tax_types as $key)
                	@endforeach
                	<input type="hidden" name="test_id" id="test_id" class="test_id" value="{{$key->id}}">
                    <?php $i=0; ?>
                    @foreach($tax_types as $item)
                        <tr class="tab-row{{$item->id}} tab-row">
                            <td>{{ ++$i }}</td>
                             
                            <td class="td-name">{{$item->name}}</td>
                            <input type="hidden" id="taxtype_id" name="taxtype_id" value="{{$item->id}}">

                            <!--*******************************************Delete*************************************************-->
                            <td>
                            @permission('account-delete')

                            	<button type="button" class="btn btn-primary btn-small tax-type-edit" data-target="confirm-delete" value="{{$item->id}}"><i class="fa fa-pencil"></i>{{ trans('button.edit') }}</button>

                                {!! Form::open(['method' => 'POST','route' => ['admin::tax_type.removeTaxType'],'style'=>'display:inline-block']) !!}
                                    <button type="button" class="btn btn-danger btn-small tax-type-delete" data-target="confirm-delete" value="{{$item->id}}"><i class="fa fa-trash"></i>{{ trans('button.delete') }}</button>
                                {!! Form::close() !!}

                            @endpermission    
                            </td>
                            <!--*************************************************************************************************-->
                        </tr>
                              
                    @endforeach 
                       
                </tbody>
            </table>
            <div class="box-footer" style="border-top: 0">
                <div class="pagination-wrapper">{!! $tax_types->render() !!} </div>
            </div>
        </div>  
    </div>

<!--***************************************************************************************************************************-->

@endsection

@section('page-styles')
   
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
        padding: 10px 15px;
        height: 100%;
    }
    .table tbody tr > td{
        padding: 15px;
        text-align: center;
    }
    .table tbody tr:hover{
        cursor: pointer;
        -webkit-transition: all ease-in-out .3s;
        -moz-transition: all ease-in-out .3s;
        -o-transition: all ease-in-out .3s;
        transition: all ease-in-out .3s;
        background-color: #EBF7FF;
    }   
    .btn-primary , .tax_types .btn-danger{
        padding: 1px 5px;
        display: inline-block;
        font-size: 12px;
    }
    .tax-type-delete{
        padding: 0;
        font-size: 12px;
        padding: 1px 5px;
    }
    .taxs .text{
        border: 1px solid #e9eaec;
        background-color: #f7f7f7;
        padding: 0 5px;
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
@include(Config::get('back_theme').'.layouts.modals.edit_tax_type') 
<script src="plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
	$(function(){
        //Select Box

        $('.breadcrumb .prev').toggle();
        $('.breadcrumb .prev a').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = "{{URL::to('backend/tax_view')}}";
        });

       	$(".select2").select2();
                            
        function close(){
            $('.modal input').val('');
            $('select').prop('selectedIndex',-1);
            $('.modal .alert').addClass('hidden');
        }
        $('.tax_types').on('click','.tax-type-add' , function (e){
        	e.preventDefault();
        	e.stopPropagation();
        	var rowCount = $('#tax-type-table tr').length;
        	var id = $('#test_id').val();
        	id = ++id;
            $('#tabs_type_modal').modal({ backdrop: 'static', keyboard: false });
            //$('#tabs_type_modal .btn-success').unbind('click');
            $('#tabs_type_modal .btn-success').on('click',function(e){
            	e.preventDefault();
            	e.stopPropagation();
            	$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'POST',
                    url: '{{ URL::to('backend/addTaxType')}}',
                    data: {
	                    '_token': $('input[name=_token]').val(),
	                    'id': id,
	                    'name':$('#tabs_type_modal .name').val()
                    },
                    success: function(data) {
                    	$('#tax-type-table').append("<tr class='tab-row"+id+ " tab-row'><td>"+rowCount+"</td><td class='td-name'>" + $('#tabs_type_modal .name').val() +"<td><button class='btn btn-primary btn-xs tax-type-edit' value='"+id+"'><i class='fa fa-edit'></i> {{ trans('button.edit') }}</button>  <button type='button' class='btn btn-danger btn-small tax-type-delete' value='"+id+"'><i class='fa fa-trash'></i> {{ trans('button.delete') }}</button></td></tr>");
                    	//$('#tabs_type_modal').modal('toggle');
                        close();
                        id++;
                        rowCount++;
                    }
                });
            });
        });                        
        
        $('.tax_types').on('click','.tax-type-edit' , function (e){
        	e.preventDefault();
        	e.stopPropagation();
        	var id = $(this).val();
        	var name = $(this).parent().siblings('.td-name').text();
        	$('#edit-tax-type .name').val(name);
        	$('#edit-tax-type').modal({ backdrop: 'static', keyboard: false });
        	$('#edit-tax-type .btn-success').unbind('click');
        	$('#edit-tax-type .btn-success').on('click',function(e){
        		e.preventDefault();
        		e.stopPropagation();
        		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'POST',
                    url: '{{ URL::to('backend/editTaxType')}}',
                    data: {
	                    '_token': $('input[name=_token]').val(),
	                    'id': id,
	                    'name':$('#edit-tax-type .name').val()
                    },
                    success: function(data) {
                    	$('.tab-row'+id).children('.td-name').text($('#edit-tax-type .name').val());
                    	$('#edit-tax-type').modal('toggle');
                        close();
                        
                    }
                });

        	});
        });

        $('.tax_types').on('click','.tax-type-delete' , function (e){
        	e.preventDefault();
        	e.stopPropagation();
        	var id = $(this).val();
        	
        	$('#confirm-delete').modal({ backdrop: 'static', keyboard: false });
        	$('#confirm-delete #delete-btn').unbind('click');
        	$('#confirm-delete #delete-btn').on('click',function(e){
        		e.preventDefault();
        		e.stopPropagation();
        		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: 'POST',
                    url: '{{ URL::to('backend/removeTaxType')}}',
                    data: {
	                    '_token': $('input[name=_token]').val(),
	                    'id': id                  
                    },
                    success: function(data) {
                    	$('.tab-row'+id).remove();
                    	$('#confirm-delete').modal('toggle');
                        
                    }
                });

        	});
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
                $('.tax_types').html($(data).find(".pag"));
            });
        }



    });
</script>
 
@endsection
