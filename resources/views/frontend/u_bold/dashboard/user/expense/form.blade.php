<div class="col-md-6 col-xs-12">

    <div class="form-group has-feedback ">
        <label for="name" class="control-label">{{ trans('frontend/expense.name')}} :</label>
        {!! Form::text('name', null, array('placeholder' => trans('frontend/expense.name'),'id' => 'name','class' => 'form-control' )) !!}                        
        <span class="fa fa-tag fa-fw form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback ">
        <label for="description" class="  control-label">           {{ trans('frontend/expense.description')}} :</label>
        {!! Form::textarea('description', null, array('placeholder' => trans('frontend/expense.description'),'rows' => '12','style' => 'height: 175px;','id' => 'description','class' => 'form-control' )) !!}                        
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group has-feedback ">

                <label for="account_id" class="control-label ">     {{ trans('frontend/expense.account')}}:</label>
               <?php $acc= isset($data->account_id)? $acc= $data->account_id:null ;?>
  
                
                <select class="form-control select2" name="account_id" id="account_id" class="">
                            @foreach($accounts as $item)
                                <?php 
                                
                                  //dd($item->id);
                               $is_major= \App\Models\Account::find($item->id)->is_major==0?$style="background:green;color:white":$style="" ;
                                $is_major_val= \App\Models\Account::find($item->id)->is_major  ;
                                if($is_major_val == 1){
                                    $disabled="disabled";
                                    $class_disable="colr_disabled";
                                    $style="background:green;color:white";
                                }  else {
                                    $disabled="";
                                    $class_disable="";
                                }
 

                                        
                                $level= \App\Models\Account::find($item->id)->depth;
                                //$dash=[];
                                $dash=' ';
                                for($i=1;$i< $level;$i++){
                                    $dash.='--';
                                }
//                              dd($is_major);
                                        
                                ?>
                            <option value="{{$item->id}}" style="{{$style}}" {{ $disabled }} class="{{$class_disable }}" > {{$dash}}  {{$item->account_code}} - {{$item->name}}</option>
                            @endforeach
              </select>               
            </div>
        </div>          
 
    </div>
</div>

<div class="col-md-6 col-xs-12">
    <div class="row">
        <div class="col-md-12 col-xs-12">

            <div class="form-group has-feedback ">
                <label class="control-label">     {{ trans('frontend/expense.expense_code')}} :</label>
                {!! Form::text('expense_code', null, array('placeholder' => trans('frontend/expense.expense_code'),''=>'expense_code','class' => 'form-control' )) !!}                        
                <span class="fa fa-hashtag fa-fw form-control-feedback"></span>
            </div>                                
        </div>
        <div class="col-md-12 col-xs-12">
            <div class="form-group has-feedback ">

                <label for="expense_type" class="control-label">     {{ trans('frontend/expense.expense_type')}}:</label>
                {!! Form::select('expense_type_id', 
                (['' =>  trans('master.select_item_from_list') ] + $expense_type), 
                null, 
                ['id' => 'expense_type_id','class' => 'form-control select2']) !!}     
                <span class="fa fa-calendar fa-fw form-control-feedback"></span>
            </div>
        </div>                        
    </div> 


    <div class="row">

 


    </div>

 
    
         
</div>