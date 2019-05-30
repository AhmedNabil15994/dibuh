<form role="form" id="product_form" method="POST" action="{{ route('cost.store_product') }}">
    {{ csrf_field() }}
    <input type="hidden" id="field_id">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="full-width-modalLabel">إضافة منتج جديد</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-md-6 col-xs-12">

                    <div class="form-group has-feedback ">
                        <label for="name" class="control-label">{{ trans('frontend/product.name')}} :</label>
                        {!! Form::text('name', null, array('placeholder' => trans('frontend/product.name'),'id' => 'name','class' => 'form-control' )) !!}
                        <span class="fa fa-tag fa-fw form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback ">
                        <label for="description" class="  control-label">           {{ trans('frontend/product.description')}} :</label>
                        {!! Form::textarea('description', null, array('placeholder' => trans('frontend/product.description'),'rows' => '12','style' => 'height: 175px;','id' => 'description','class' => 'form-control' )) !!}
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group has-feedback ">

                                <label for="account_id" class="control-label ">     {{ trans('frontend/product.account_id')}}:</label>
                               
                                {!! Form::select2('account_id',
                                (['' =>  trans('master.select_item_from_list') ] ),
                                
                                ['id' => 'account_id','class' => 'form-control ','style' => 'padding:0px',''=>'']
                                ,  $accounts_major) !!} 
                                
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">

                            <div class="form-group has-feedback ">
                                <label class="control-label">     {{ trans('frontend/product.product_code')}} :</label>
                                {!! Form::text('product_code', null, array('placeholder' => trans('frontend/product.product_code'),''=>'product_code','class' => 'form-control' )) !!}
                                <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="product_type" class="control-label">     {{ trans('frontend/product.product_type')}}:</label>
                                {!! Form::select('product_type_id',
                                (['' =>  trans('master.select_item_from_list') ] ),
                                null,
                                ['id' => 'product_type_id','class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>


                    <div class="row">


                        <div class="col-md-6 col-xs-12">
                            <div class="form-group has-feedback ">
                                <label for="price" class="control-label">  {{ trans('frontend/product.price')}} :</label>
                                {!! Form::text('price', null, array('placeholder' => trans('frontend/product.price'),'id' => 'price','class' => 'form-control' )) !!}
                                <span class="fa fa-money fa-fw form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">

                                <label for="unit" class="control-label">     {{ trans('frontend/product.unit')}}:</label>

                                {!! Form::select('unit_id',
                                (['' =>  trans('master.select_item_from_list') ]),
                                null,
                                ['id' => 'unit_id','class' => 'form-control']) !!}


                            </div>
                        </div>

                    </div>

                    <div class="form-group has-feedback ">
                        <label for="comment" class="  control-label">           {{ trans('frontend/product.comment')}} :</label>
                        {!! Form::textarea('comment', null, array('placeholder' => trans('frontend/product.comment'),'rows' => '8','style' => 'height: 103px;','id' => 'comment','class' => 'form-control' )) !!}

                    </div>

                    <div class="col-md-12 col-xs-12">
                        <div class="form-group   ">
                            <label for="tax" class="control-label">  {{ trans('frontend/product.tax')}} :</label>
                            <div id='tax_id'></div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button  name="submit" data-style="expand-left"  type="submit" class="btn btn-success waves-effect waves-light m-r-5 ladda-button ">
                    <span class="ladda-label"><i class="fa fa-floppy-o"></i> حفظ المنتج </span>
                    <span class="ladda-spinner"></span>
                </button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">الغاء</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</form>-->
