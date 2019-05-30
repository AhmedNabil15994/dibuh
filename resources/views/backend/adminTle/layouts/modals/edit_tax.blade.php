<div class="modal fade" id="edit-tax">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-danger">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                
                <h4 class="modal-title"> <i class="fa fa-pencil"></i> {{ trans('backend/tax.edit')}}</h4>
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
                                <strong>Choose {{trans('backend/tax.tax')}} {{ trans('backend/tax.name')}} :</strong>
                            </div>                                           
                            <select class="taxes select2" id="taxes" class="form-control select2">
                                    <option>{{trans('master.select_item_from_list')}}</option>
                            </select>                 
                        </div>
                    </div>  
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group"> 

                            <div class="col-sm-4">                  
                                <strong>{{ trans('backend/tax.name')}} :</strong>
                            </div>                                           
                            <input class="form-control" class="tax_name" id="tax_name"></input>
                            <input type="hidden" name="tax_id" class="tax_id" id="tax_id">
                        </div>
                    </div>   

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group"> 

                            <div class="col-sm-4">                  
                                <strong>{{ trans('backend/tax.rate')}} :</strong>
                            </div>  
                            <input class="form-control" type="number" id="tax_rate" name="tax_rate" min="0">
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