<div id="edit-acctax-modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">{{ trans('backend/account_to_company_type.update_new') }}</h4>
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

                <div class="modal-body">
      
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>Account Id :</strong>
                            </div>
                            {!! Form::text('account_id', null, array('class' => 'form-control account_id' , 'required' => '' , 'disabled' => ''  )) !!}                    
                            
                        </div>
                    </div>  
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <strong>{{ trans('backend/account.company_type')}} :</strong>
                            </div>
                            
                            <div class="col-sm-8">       
                                @foreach ($taxs as $key=>$val) <!--$role variable gets its data from the db-->
                                 <div class="row" style="margin-bottom: 10px;">   
                                    <div class="col-sm-9" style="display: inline-block;">
                                        <label>{{$val->name}} --> {{$val->rate}}</label>
                                    </div>    
                                        <input type="checkbox" name="tax" value1="{{$val->id}}" value2="{{$val->name}}" value3="{{$val->rate}}" class="icheckbox_flat">
                                 </div>  
                                @endforeach
                            </div>         
                            
                        </div>
                    </div> 
                    
                </div>
            {!! Form::open(['method' => 'POST','route' => ['admin::account_to_tax.editAccTax'], 'style'=>'display:inline']) !!} 
            <div class="modal-footer" style="border-top: 0">
                <button type="button" class="btn btn-success" style="background-color: #449d44"><i class="fa fa-save"></i> {{ trans('button.edit') }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-home "></i> {{ trans('button.cancel') }}</button>
            </div>
            {!! Form::close() !!}
        
        @endpermission
        </div>
        
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