<form role="form" id="product_form" method="POST" action="{{ route('sales_invoice.store_product') }}">
    {{ csrf_field() }}
    <input type="hidden" id="field_id">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="full-width-modalLabel">{{ trans('frontend/product.add_new_product')}} </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-md-6 col-xs-12">

                    <div class="form-group has-feedback ">
                        <label for="name" class="control-label"> modal{{ trans('frontend/product.name')}} :</label>
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
                                

                                 <select class="form-control"  name='account_id' id='account_id'>
                                                    <option>{{trans('frontend/sales_invoice.account')}}</option>
													<?php $category= \App\Models\Category::get(); ?>
                                                   @foreach($category as $row)
                                                        
                                                        <?php 
                                                            $accountszx= \DB::table('accounts')->where('category_id' , '=', $row->id)->orderBy('lineage','ASC')->where('is_major','=',0)->get();  
                                                        ?>
                                                    @if(!empty($accountszx))     

                                                        <option disabled style="background-color: green">{{$row->name}}</option>
                                                    @foreach($accountszx as $item)
                                                        <?php
                                                                $disabled= '';
                                                                $class_disable = '';
                                                                $style = '';
                                                                if($item->is_major === 1){
                                                                    $disabled="";
                                                                    $class_disable="colr_disabled";
                                                                    $style="background:green;color:white;";
                                                                }  else {
                                                                    $disabled="";
                                                                    $class_disable="";
                                                                    $style= "";
                                                                }
                                                                    
                                                                $level= \App\Models\Account::find($item->id)->depth;
                                                                $dash=' ';
                                                                for($i=1;$i< $level;$i++){
                                                                    $dash.='--';
                                                                } 
                                                                $screen_id = \DB::table('accounts_to_screens')->where('account_id', '=' , $item->id)->where('screen_id' , '=' ,'13')->get();
                                                                if(!empty($screen_id) ){

                                                                ?>                                                           
                                                                
                                                                <option value="{{$item->id}}" style="{{$style}}" class="{{$class_disable }}" >{{$dash}}  {{$item->account_code}} - {{$item->name}}</option>
                                
                                                        <?php }?>
                                                    @endforeach      
                                                    @endif  
                                                    @endforeach
                                                    <?php
                                                        $accounts2= \DB::table('accounts')->orderBy('lineage','ASC')->where('category_id' , '=' , '0' )->where('is_major','=',0)->get();  
                                                        if(!empty($accounts2)){
                                                    ?>
                                                        <option disabled style="background-color: green">Uncategorized</option>
                                                    @foreach($accounts2 as $item)

                                                        <?php
                                                                $disabled= '';
                                                                $class_disable = '';
                                                                $style = '';
                                                                if($item->is_major === 1){
                                                                    $disabled="";
                                                                    $class_disable="colr_disabled";
                                                                    $style="background:green;color:white";
                                                                }  else {
                                                                    $disabled="";
                                                                    $class_disable="";
                                                                }
                                                                    
                                                                $level= \App\Models\Account::find($item->id)->depth;
                                                                $dash=' ';
                                                                for($i=1;$i< $level;$i++){
                                                                    $dash.='--';
                                                                } 
                                                                $screen_id = \DB::table('accounts_to_screens')->where('account_id', '=' , $item->id)->where('screen_id' , '=' ,'13')->get();
                                                                if(!empty($screen_id) ){

                                                                ?>                                                           
                                                                
                                                                <option value="{{$item->id}}" style="{{$style}}" class="{{$class_disable }}" >{{$dash}}  {{$item->account_code}} - {{$item->name}}</option>
                                
                                                        <?php }?>
                                                    @endforeach   
                                                    <?php } ?>         
                                                </select>
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
                                (['' =>  trans('master.select_item_from_list') ] + $product_type),
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
                                (['' =>  trans('master.select_item_from_list') ] + $unit),
                                null,
                                ['id' => 'unit_id','class' => 'form-control']) !!}


                            </div>
                        </div>

                    </div>

                    <div class="form-group has-feedback ">
                        <label for="comment" class="  control-label">           {{ trans('frontend/product.comment')}} :</label>
                        {!! Form::textarea('comment', null, array('placeholder' => trans('frontend/product.comment'),'rows' => '8','style' => 'height: 103px;','id' => 'comment','class' => 'form-control' )) !!}

                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback ">
                            <label for="price" class="control-label">  {{ trans('frontend/product.time_no')}} :</label>
                            {!! Form::checkbox('time_no',null,null, array('id' => 'time_no' )) !!}

                        </div>
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
                    <span class="ladda-label"><i class="fa fa-floppy-o"></i> {{ trans('button.save_product')}} </span>
                    <span class="ladda-spinner"></span>
                </button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">{{ trans('button.close')}}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</form>