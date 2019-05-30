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
                    
                <select class="form-control account_id select2" value1="1" type="text" name="account" id="account_id1" style="position: relative; padding-right: 25px;">
                </select>    
                <button class="btn btn-xs choose" value1="1" style="position: absolute;top: 28px;right: 5px; width: 20px;"><i class="fa fa-ellipsis-v"></i>
                </button>
                <input type="hidden" name="account_id" class="checkID1">
                

            </div>
        </div>          
 
    </div>
</div>

<div class="col-md-6 col-xs-12">
    <div class="row">
        <div class="col-md-6 col-xs-12">

            <div class="form-group has-feedback ">
                <label class="control-label">     {{ trans('frontend/product.product_code')}} :</label>
                <input class="form-control" type="text" name="product_code" id="product_code"  placeholder="{{ trans('frontend/product.product_code')}}">
                <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
                
            </div>                                
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="form-group has-feedback ">

                <label for="product_type" class="control-label">     {{ trans('frontend/product.product_type')}}:</label>
                {!! Form::select('product_type_id', 
                (['' =>  trans('master.select_item_from_list') ] + $product_type), 
                null, 
                ['id' => 'product_type_id','class' => 'form-control select2']) !!}     
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
            <div class="form-group has-feedback ">

                <label for="unit" class="control-label">     {{ trans('frontend/product.unit')}}:</label>                                 

                {!! Form::select('unit_id', 
                (['' =>  trans('master.select_item_from_list') ] + $unit), 
                null, 
                ['id' => 'unit_id','class' => 'form-control select2']) !!}                                                         
                <span class="fa fa-ul fa-fw form-control-feedback"></span>
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

