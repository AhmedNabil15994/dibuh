@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/payment.plans') }}
@endsection

@section('contentheader_title')
{{ trans('backend/payment.plans') }}
@endsection

@section('contentheader_description')
 

@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/payment.plans') }}
@endsection



@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<!--************************************** Create Modal ***********************************************-->
<div id="tabs_modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">{{ trans('backend/payment.addPricePlan') }}</h4>
            </div>
            <div class="modal-body">
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
                                <div class="col-sm-5">
                                    <strong>{{ trans('backend/payment.price')}} :</strong>
                                </div>    
                               {!! Form::number('price', null, array('placeholder' => trans('backend/payment.price'),'class' => 'form-control price' , 'required' => '' , 'min' => 0)) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-sm-5">      
                                    <strong>{{ trans('backend/payment.period')}} :</strong>
                                </div>    
                                <select class="form-control select2 period" name="period" required>
                                    <option value="1"> شهر</option>
                                    <option value="2"> 3 اشهر</option>
                                    <option value="3"> سنة </option>
                                </select>
                                                 
                                        
                            </div>
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <strong>Name :</strong>
                                </div>    
                                {!! Form::text('end_products', null, array('placeholder' => 'Name','class' => 'form-control end_products' , 'required' => '')) !!}                             
                            </div>
                        </div>  
                        
                    </div>   
            </div>      
            {!! Form::open(array('route' => 'admin::payments.addPlan','method'=>'POST')) !!}        
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="margin: auto; background-color: #449d44"><i class="fa fa-save"></i> {{ trans('button.create') }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>  

<div id="edit_modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">{{ trans('backend/payment.editPricePlan') }}</h4>
            </div>
            <div class="modal-body">
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
                                <div class="col-sm-5">
                                    <strong>{{ trans('backend/payment.price')}} :</strong>
                                </div>    
                               {!! Form::number('price', null, array('class' => 'form-control price' , 'required' => '' , 'min' => 0)) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-sm-5">      
                                    <strong>{{ trans('backend/payment.period')}} :</strong>
                                </div>    
                                <select class="form-control select2 period" name="period" required>
                                    <option value="1"> شهر</option>
                                    <option value="2"> 3 اشهر</option>
                                    <option value="3"> سنة </option>
                                </select>                       
                                        
                            </div>
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <strong>Name :</strong>
                                </div>    
                                {!! Form::text('end_products', null, array('class' => 'form-control end_products' , 'required' => '')) !!}                             
                            </div>
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <strong>{{ trans('backend/payment.support')}} :</strong>
                                </div>    
                               {!! Form::text('support', null, array('class' => 'form-control support' , 'required' => '')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-sm-5">      
                                    <strong>{{ trans('backend/payment.updates')}} :</strong>
                                </div>    
                                {!! Form::text('updates', null, array('class' => 'form-control updates' , 'required' => '')) !!}                        
                                        
                            </div>
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <strong>{{ trans('backend/payment.avail_support')}} :</strong>
                                </div>    
                                {!! Form::text('avail_support', null, array('class' => 'form-control avail_support' , 'required' => '','min' => 0)) !!}                             
                            </div>
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <strong>{{ trans('backend/payment.discount')}} :</strong>
                                </div>    
                                {!! Form::text('discount', null, array('class' => 'form-control discount' , 'required' => '','min' => 0)) !!}                             
                            </div>
                        </div>  
                    </div>   
            </div>      
            {!! Form::open(array('route' => 'admin::payments.addPlan','method'=>'POST')) !!}        
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="margin: auto; background-color: #449d44"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>   
<!--***************************************************************************************************-->
<!--************************************** Plans View **************************************************-->            
            <div class="plans">
                <div class="pag">
                    <div class="row">   
                        <button type="button" class="btn btn-success btn-circle pull-right add" data-target="tabs_modal"><i class="fa fa-plus"></i> <span>{{ trans('button.create') }}</span></button>
                    </div>  
                    <table class="table table-hover" id="tax-table" style="width: 99%;border: 1px solid #DDD;">
                        <thead>
                          <tr style="background-color: #f8f8f9;">
                            <th style="width: 50px;">{{ trans('master.no#') }}</th>
                            <th>{{ trans('backend/payment.period') }}</th>
                            <th>{{ trans('backend/payment.price') }}</th>
                            <th>Name</th>
                            <th>{{ trans('backend/payment.support') }}</th>
                            <th>{{ trans('backend/payment.updates') }}</th>
                            <th>{{ trans('backend/payment.avail_support') }}</th>
                            <th>{{ trans('master.action') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>
                        @foreach($plans as $item)
                          <tr class="tab-row{{$item->id}} tab-row">
                           
                            <td><?php echo ++$i ;?></td>
                            <td class="period" value1="{{$item->period_id}}">{{$item->period}}</td>
                            <td class="price">{{$item->price}}</td>
                            <td class="end_products">{{$item->name}}</td>
                            <td class="support">{{$item->support}}</td>
                            <td class="updates">{{$item->updates}}</td>
                            <td class="avail_support">{{$item->avail_support}}</td>
                            <input type="hidden" name="discount" class="discount" value="{{$item->discount}}">

                            <!--*******************************************Delete*************************************************-->
                            <td>
                            @permission('account-edit')
                                <button type="button" class="btn btn-primary btn-small btn edit btn-form" value="{{$item->id}}"><i class="fa fa-pencil"></i>{{ trans('button.edit') }}</button>
                            @endpermission    
                            @permission('account-delete')
                           
                                {!! Form::open(['method' => 'POST','route' => ['admin::tax.removeTax'], 'class' =>' taxes-delete','style'=>'display:inline-block']) !!}
                                    <button type="button" class="btn btn-danger btn-small btn delete btn-form" data-target="confirm-delete" value="{{$item->id}}"><i class="fa fa-trash"></i>{{ trans('button.delete') }}</button>
                                {!! Form::close() !!}
                            @endpermission    
                            </td>
                            <!--*************************************************************************************************-->
                          </tr>
                              
                        @endforeach 
                       
                        </tbody>
                      </table>
                      <div class="box-footer">
                            <div class="pagination-wrapper"></div>
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
    .plans .btn-form{
        padding: 3px 7px;
        font-size: 12px;
    }
</style>
@endsection

@section('page-scripts')

@include(Config::get('back_theme').'.layouts.modals.comfirm_delete')  
<script src="plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
                        $(function(){
                            $('#tabs_modal .select2-selection__placeholder').text('Select Period');
                            //Select Box
                            $(".period.select2").select2({
                                placeholder: "Select Period"
                            });
                            
                            function close(){
                                $('.modal input').val('');
                                $('.select2').prop('selectedIndex',-1);
                                $('.modal .alert').addClass('hidden');
                                names = [];
                                rates = [];
                                IDs   = [];                                  
                            }

                            $('.close , .modal .btn-danger').on('click',function(){
                                close();
                            });    

/************************************************Edit*****************************************************************/

                            $('.plans').on('click','.edit',function(e){
                                e.preventDefault();
                                e.stopPropagation();
                                var id = $(this).val();
                                $('#edit_modal .price').val($('.tab-row'+id+ ' td.price').text());
                                $('#edit_modal .period').val($('.tab-row'+id+ ' td.period').attr('value1')).trigger('change');
                                $('#edit_modal .end_products').val($('.tab-row'+id+ ' td.end_products').text());
                                $('#edit_modal .support').val($('.tab-row'+id+ ' td.support').text());
                                $('#edit_modal .updates').val($('.tab-row'+id+ ' td.updates').text());
                                $('#edit_modal .avail_support').val($('.tab-row'+id+ ' td.avail_support').text());
                                $('#edit_modal .discount').val($('.tab-row'+id+ ' .discount').val());
                                
                                $('#edit_modal').modal({ backdrop: 'static', keyboard: false });
                                $('#edit_modal .btn-success').unbind('click');
                                $('#edit_modal .btn-success').on('click',function(){
                                      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                                        $.ajax({
                                            type: 'POST',
                                            url:"{{ URL::to('backend/editPlan')}}",
                                            data:{
                                                '_token': $('input[name=_token]').val(),
                                                'id': id,
                                                'price': $('#edit_modal .price').val(),
                                                'period': $('#edit_modal .period option:selected').text(),
                                                'period_id': $('#edit_modal .period option:selected').val(),
                                                'end_products': $('#edit_modal .end_products').val(),
                                                'support': $('#edit_modal .support').val(),
                                                'updates': $('#edit_modal .updates').val(),
                                                'avail_support': $('#edit_modal .avail_support').val(),
                                                'discount': $('#edit_modal .discount').val()
                                            },
                                            success:function(data){
                                                $('#edit_modal').modal('toggle'),

                                                $('.tab-row'+id+ ' td.price').text($('#edit_modal .price').val());
                                                $('.tab-row'+id+ ' td.period').text($('#edit_modal .period option:selected').val());
                                                $('.tab-row'+id+ ' td.end_products').text($('#edit_modal .end_products').val());
                                                $('.tab-row'+id+ ' td.support').text($('#edit_modal .support').val());
                                                $('.tab-row'+id+ ' td.updates').text($('#edit_modal .updates').val());
                                                $('.tab-row'+id+ ' td.avail_support').text($('#edit_modal .avail_support').val());
                                                $('.tab-row'+id+ ' .discount').val($('#edit_modal .discount').val());

                                                close();  
                                                //location.reload();                     
                                            }
                                        });     
                                });
                            });
  
       
                            
/******************************************************Delete**********************************************************/
                            $('.plans').on('click','.delete',function(e){
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
                                        url: '{{ URL::to('backend/removePlan')}}',
                                        data: {
                                            '_token': $('input[name=_token]').val(),
                                            'id': id
                                        },
                                        success: function(data) {
                                            $('#confirm-delete').modal('toggle');
                                            $('.tab-row'+id).remove();
                                            
                                        }
                                    });
                                });
                                    
                                  
                            });
/******************************************************Insert**********************************************************/                       $('.plans').on('click','.add',function(e){
                                $('#tabs_modal').modal({ backdrop: 'static', keyboard: false });
                                $('#tabs_modal .btn-success').unbind('click');
                                $('#tabs_modal .btn-success').on('click',function(e){
                                    e.preventDefault();
                                    e.stopPropagation(); 
                                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{ URL::to('backend/addPlan')}}',
                                        data: {
                                            '_token': $('input[name=_token]').val(),
                                            'period': $('#tabs_modal .period option:selected').text(),
                                            'period_id': $('#tabs_modal .period option:selected').val(),
                                            'price'       : $('#tabs_modal .price').val(),
                                            'end_products'       : $('#tabs_modal .end_products').val()  
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
                                    $('.plans').html($(data).find(".pag"));
                                });
                            }

                        });
</script>
 
@endsection
