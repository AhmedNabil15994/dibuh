@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/tax.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/tax.list') }}
@endsection

@section('contentheader_description')
 

@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/tax.list') }}
@endsection



@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<!--*********************************************************** Create Modal ************************************************-->
<div id="tabs_modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">{{ trans('backend/tax.add') }}</h4>
            </div>
            <div class="modal-body">
                <h4 class="box-title">{{ trans('backend/tax.create_new') }}</h4>
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
                    
                    <div class="box-body">    
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <strong>{{ trans('backend/tax.tax_type')}} :</strong>
                                </div>    
                                <select name="tax_type_id" id="tax_type_id" class="form-control select2">
                                    <option>{{trans('master.select_item_from_list')}}</option>   
                                    @foreach($tax_types as $item)
                                        <option value="{{ $item->id}}">{{ $item->name }}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-sm-3">      
                                    <strong>{{ trans('backend/tax.name')}} :</strong>
                                </div>    
                                {!! Form::text('name', null, array('placeholder' => trans('backend/tax.name'),'class' => 'form-control name' , 'required' => '')) !!}                        
                                        
                            </div>
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <strong>{{ trans('backend/tax.rate')}} :</strong>
                                </div>    
                                {!! Form::number('rate', null, array('placeholder' => trans('backend/tax.rate'),'class' => 'form-control rate' , 'required' => '','min' => 0)) !!}                             
                            </div>
                        </div>  
                        
                    </div>   
            </div>      
            {!! Form::open(array('route' => 'admin::tax.addTax','method'=>'POST')) !!}        
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="margin: auto; background-color: #449d44"><i class="fa fa-save"></i> {{ trans('button.create') }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>    
<!--************************************************************************************************************************-->

<!--********************************************************* Carousel View ************************************************-->
       
            <!--************************************** Taxs View **************************************************-->            
            <div class="taxs">
                <div class="pag">
                    <div class="row">   
                        <button type="button" class="btn btn-success btn-circle pull-right tax-add" data-target="tabs_modal"><i class="fa fa-plus"></i> <span>{{ trans('backend/tax.add') }}</span></button>
                    </div>  
                    <table class="table table-hover" id="tax-table" style="width: 99%;border: 1px solid #DDD;">
                        <thead>
                          <tr style="background-color: #f8f8f9;">
                            <th style="width: 50px;">{{ trans('master.no#') }}</th>
                            <th class="edit"><div>{{ trans('backend/tax.tax_type') }} <a href="{{ route('admin::account_setting.tax_type') }}" class="btn btn-primary btn-small btn-icon-only btn-inverse edit-tax"><i class="fa fa-pencil"></i></a></div></th>
                            <th>{{ trans('backend/tax.name') }}</th>
                            <th class="edit"><div>{{ trans('backend/tax.rate') }} </div></th>
                            <th>{{ trans('master.action') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>
                        @foreach($tax_types as $item)
                          <tr class="tab-row{{$item->id}} tab-row">
                            <td>{{ ++$i }}</td>
                             
                            <td class="td-name">{{$item->name}}</td>
                            <input type="hidden" id="taxtype_id" name="taxtype_id" value="{{$item->id}}">

                            <td>@foreach($item->tax as $tax)<span class="text sel{{$tax->id}} name" id="{{$tax->name}}" id2="{{$tax->id}}" value="{{$tax->name}}" value1="{{$tax->id}}">{{$tax->name}}</span>@endforeach</td>
                            <td>@foreach($item->tax as $tax)<span class="text sel{{$tax->id}} rate" id="{{$tax->rate}}" value="{{$tax->rate}}" value1="">{{$tax->rate}}</span>@endforeach</td>
                            @foreach($item->tax as $tax)<input type="hidden" value="{{$tax->id}}">@endforeach

                            <!--*******************************************Delete*************************************************-->
                            <td>
                            @permission('account-delete')
                            @foreach($item->tax as $tax)
                                {!! Form::open(['method' => 'POST','route' => ['admin::tax.removeTax'], 'class' =>' taxes-delete','style'=>'display:block']) !!}
                                    <button type="button" style="margin-bottom: 10px;" class="btn btn-danger btn-small btn{{$tax->id}} tax-delete" data-target="confirm-delete" value="{{$tax->id}}"><i class="fa fa-trash"></i>{{ trans('button.delete') }}</button>
                                {!! Form::close() !!}
                            @endforeach
                            @endpermission    
                            </td>
                            <!--*************************************************************************************************-->
                          </tr>
                              
                        @endforeach 
                       
                        </tbody>
                      </table>
                      <div class="box-footer">
                            <div class="pagination-wrapper">{!! $tax_types->render() !!} </div>
                      </div>
                </div>  
            </div>
            <!--***************************************************************************************************-->

<!--************************************************************************************************************************-->    

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
    .btn-primary{
        padding: 6px 10px;
        display: inline-block;
        font-size: 12px;
    }
    .tax-delete{
        padding: 0;
        font-size: 12px;
        padding: 2px 7px;
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
@include(Config::get('back_theme').'.layouts.modals.edit_tax')   
<script src="plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
                        $(function(){
                            //Select Box
                            $(".select2").select2();
                            
                            function close(){
                                $('.modal input').val('');
                                $('select').prop('selectedIndex',1);
                                $('.modal .alert').addClass('hidden');
                                names = [];
                                rates = [];
                                IDs   = [];  
                                console.log(IDs);
                                $('.select2').find('option').not(":first").remove();
                                $('.select2').append("<option class='hidden'>{{trans('master.select_item_from_list')}}</option>");
                                $('.select2').val(1).trigger('change.select2');
                                //$('.select2').attr('placeholder',"{{trans('master.select_item_from_list')}}");
                            }
                            // Displaying No
                            $("tr td").each(function() { 
                                var valueOfCell = $(this).html();                          
                                if (valueOfCell == ''){                 
                                  $(this).parent().addClass('hidden');
                                }             
                            });   

                                var names = [];
                                var rates = [];
                                var IDs   = [];
                            $('.close , .modal .btn-danger').on('click',function(){
                                close();
                            });    

/************************************************Edit*****************************************************************/

                            $('.taxs').on('click','.tab-row',function(e){
                                e.preventDefault();
                                //e.stopPropagation();
                                
                                var parent =$(this);
                                parent.find(".name").each(function(){ names.push(this.id); });
                                parent.find(".name").each(function(){ IDs.push($(this).attr('id2')); });
                                parent.find(".rate").each(function(){ rates.push(this.id); });
                                for (var i = 0 ; i < names.length ;  i++) {
                                    for (var i = 0 ; i < rates.length ; i++) {
                                        for (var i = 0 ; i < IDs.length ; i++) {
                                        $('#edit-tax .taxes').append('<option value='+rates[i]+' value1=' +IDs[i]+ '>'+names[i]+'</option>');
                                        }
                                    }
                                }
                               
                                $('#edit-tax .taxes').on("change", function(e) {
                                    var data =$('#edit-tax .taxes option:selected').text();
                                    $("#edit-tax #tax_name").val(data);
                                    $("#edit-tax #tax_rate").val($('#edit-tax .taxes').select2("val"));
                                    $("#edit-tax #tax_id").val($('#edit-tax .taxes option:selected').attr("value1"));
                                 });
                                
                                $('#edit-tax').modal({ backdrop: 'static', keyboard: false });
                                $('#edit-tax .btn-success').unbind('click');
                                $('#edit-tax .btn-success').on('click',function(){
                                      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                                        $.ajax({
                                            type: 'POST',
                                            url:"{{ URL::to('backend/editTax')}}",
                                            data:{
                                                '_token': $('input[name=_token]').val(),
                                                'id': $('#edit-tax #tax_id').val(),
                                                'name': $('#edit-tax #tax_name').val(),
                                                'rate': $('#edit-tax #tax_rate').val()
                                            },
                                            success:function(data){
                                               //$('.tab-row' + id).children('.td-name').text($('#edit-tax .name').val());
                                               $('.text.sel'+$("#edit-tax #tax_id").val()).text($('#edit-tax #tax_name').val());
                                               $('.rate.sel'+$("#edit-tax #tax_id").val()).text($('#edit-tax #tax_rate').val());
                                               //$('#edit-tax .taxes').empty();
                                               close();                       
                                               location.reload();                        
                                            }
                                        });     
                                });
                            });
  
       
                            
/******************************************************Delete**********************************************************/
                            $('.taxs').on('click','.tax-delete',function(e){
                                e.preventDefault(); 
                                e.stopPropagation();                            
                                var id = $(this).val();
                                $('#confirm-delete').modal({ backdrop: 'static', keyboard: false });
                                $('#confirm-delete #delete-btn').unbind('click');
                                $('#confirm-delete #delete-btn').on('click',function(e){
                                    //$('.taxes-delete').submit();   
                                    e.preventDefault();
                                    e.stopPropagation();
                                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{ URL::to('backend/removeTax')}}',
                                        data: {
                                            '_token': $('input[name=_token]').val(),
                                            'id': id
                                        },
                                        success: function(data) {
                                            $('.sel'+id).remove();
                                            $('.btn'+id).remove();
                                            $('#confirm-delete').modal('toggle');
                                            $("tr td").each(function() { 
                                                var valueOfCell = $(this).html();                          
                                                if (valueOfCell == ''){                 
                                                  $(this).parent().addClass('hidden');
                                                }             
                                            });
                                        }
                                    });
                                });
                                    
                                  
                            });
/******************************************************Insert**********************************************************/                       $('.taxs').on('click','.tax-add',function(e){
                                e.preventDefault();
                                e.stopPropagation();
                                $('#tabs_modal').modal({ backdrop: 'static', keyboard: false });
                                $('#tabs_modal .btn-success').unbind('click');
                                $('#tabs_modal .btn-success').on('click',function(e){
                                    e.preventDefault();
                                    e.stopPropagation(); 
                                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{ URL::to('backend/addTax')}}',
                                        data: {
                                            '_token': $('input[name=_token]').val(),
                                            'tax_type_id': $('#tabs_modal .select2 option:selected').val(),
                                            'name'       : $('#tabs_modal .name').val(),
                                            'rate'       : $('#tabs_modal .rate').val()  
                                        },
                                        success: function(data) {
                                           location.reload();
                                        }
                                    });
                                });
                            });
/***************************************************Pagination*********************************************************/

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
                                    $('.taxs').html($(data).find(".pag"));
                                });
                            }

                        });
</script>
 
@endsection
