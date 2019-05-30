
<div class="form-group {{ $errors->has('account_id') ? 'has-error' : ''}}">
    {!! Form::label('account_id', 'Account Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('id', 
        (['' =>  trans('master.select_item_from_list') ] + $accounts), 
        null, 
        ['class' => 'form-control select2','disabled'=>'disabled' ]) !!} 
        {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
 

<!--Snippet from create-user.blade.php-->
<div class='form-group list-seperator'>
    {!! Form::label('account_id', trans('backend/account.tax'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6 ">
        
        @foreach ($taxes as $key=>$val) <!--$role variable gets its data from the db-->
        <div class="col-md-12  ">
            {{ Form::label(trans('backend/account.tax'), $val ,['class'=>'col-md-8']) }}
            @if(in_array($key, $selected_taxes))    
            {{ Form::checkbox("taxes[$key]", $val,true,['class'=>'icheckbox_flat ']) }}
            @else
            {{ Form::checkbox("taxes[$key]", $val,false,['class'=>'icheckbox_flat  ']) }}
            @endif    
        </div>
        @endforeach
        
    </div>
</div>





