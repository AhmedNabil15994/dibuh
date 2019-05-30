
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
<!--<div class="form-group {{ $errors->has('company_type_id') ? 'has-error' : ''}}">
    {!! Form::label('company_type_id',trans('backend/account.company_type'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">

        {!! Form::select('company_types[]', $company_types, $selected_companytype, array('multiple')) !!}       
        {!! $errors->first('company_type_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>-->

<!--Snippet from create-user.blade.php-->
<div class='form-group'   >
    {!! Form::label('account_id', trans('backend/account.company_type'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        @foreach ($company_types as $key=>$val) <!--$role variable gets its data from the db-->
        {{ Form::label(trans('backend/account.company_type'), $val) }}
        @if(in_array($key, $selected_companytype))    
        {{ Form::checkbox("company_types[$key]", $val,true,['class'=>'icheckbox_flat','style'=>' ']) }}
        @else
        {{ Form::checkbox("company_types[$key]", $val,false,['class'=>'icheckbox_flat','style'=>' ']) }}
        @endif    
        @endforeach
    </div>
</div>





