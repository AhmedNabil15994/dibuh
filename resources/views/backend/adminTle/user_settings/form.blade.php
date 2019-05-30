
<div class="form-group {{ $errors->has('key') ? 'has-error' : ''}}">
    {!! Form::label('key', 'Key', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('key', null, ['class' => 'form-control']) !!}
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    {!! Form::label('value', 'Value', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('value', null, ['class' => 'form-control']) !!}
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('field') ? 'has-error' : ''}}">
    {!! Form::label('field', 'Field', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('field', null, ['class' => 'form-control']) !!}
        {!! $errors->first('field', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('user_setting_type_id') ? 'has-error' : ''}}">
    {!! Form::label('user_setting_type_id', 'User Setting Type Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        
        {!! Form::select('user_setting_type_id', 
                        (['' =>  trans('master.select_item_from_list') ] + $UserSettingType ), 
                        null, 
                        ['class' => 'form-control select2']) !!}             
        {!! $errors->first('user_setting_type_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'User Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('user_id', 
                        (['' =>  trans('master.select_item_from_list') ] + $users ), 
                        null, 
                        ['class' => 'form-control select2']) !!}            
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('is_active') ? 'has-error' : ''}}">
    {!! Form::label('is_active', 'Is Active', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
                    <div class="checkbox">
                <label>{!! Form::radio('is_active', '1') !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('is_active', '0', true) !!} No</label>
            </div>
        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>





