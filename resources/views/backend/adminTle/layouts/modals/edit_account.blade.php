
<div id="edit-account" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">{{ trans('backend/account.edit') }}</h4>
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
            
            {!! Form::open(array('route' => 'admin::account.editAccount','method'=>'POST')) !!}
            <div class="modal-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.parent_id')}} :</strong>
                        </div>    
                        <select class="form-control select2 parent_id" name="parent_id">
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
                        {!! Form::number('account_code', null, array('placeholder' => trans('backend/account.account_code'),'class' => 'form-control account_code' ,'min' => 0)) !!}                        
                        
                    </div>
                </div>  
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.is_major')}} :</strong>
                        </div>    
                         <select class="form-control select2 is_major" name="is_major">
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
                        {!! Form::text('name', null, array('placeholder' => trans('backend/account.name'),'class' => 'form-control name' )) !!}                        
                        
                       <input type="hidden" name="created_by" value="{{$created_by}}">
                    </div>
                </div>  
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.text')}} :</strong>
                        </div>
                        {!! Form::text('text', null, array('placeholder' => trans('backend/account.text'),'class' => 'form-control text' )) !!}                        
                        
                    </div>
                </div>   
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.description')}} :</strong>
                        </div>
                        {!! Form::text('description', null, array('placeholder' => trans('backend/account.description'),'class' => 'form-control description' )) !!}                        
                        
                    </div>
                </div>  
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <strong>{{ trans('backend/account.category')}} :</strong>
                        </div>    
                         <select class="form-control select2 cc" name="cc">
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
                        <select class="form-control select2 account_category" name="account_category">
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
                        <select class="form-control select2 account_type_id" name="account_type_id">
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
                        <select class="form-control select2 is_common" name="is_common">
                            <option>{{trans('master.select_item_from_list')}}</option>                             
                            
                            <option value="0">{{trans('master.no')}}</option>
                            <option value="1">{{trans('master.yes')}}</option>
                        </select>                              
                    </div>
                </div>       
            </div>
            <div class="modal-footer" style="border-top: 0">
                <button type="submit" class="btn btn-success" style="background-color: #449d44"><i class="fa fa-save"></i> {{ trans('button.edit') }}</button>
                <button type="button" class="btn btn-danger btn-close" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
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
@show 