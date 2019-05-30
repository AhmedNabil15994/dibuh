@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')

@section('module_breadcrumb')
<li><a href="{{ route($module.'.index') }}"> {{trans('frontend/dashboard.contact_manager')}} </a></li>    
<li><a href="{{ route($module.'.address.index',$id) }}"> {{trans('frontend/'.$module.'.address')}}</a> </li>
<li class="active"> {{trans('frontend/'.$module.'.address_edit')}} </li>
@endsection





@section('content_dashboard')
<!-- right column -->

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
<h3>{{trans('frontend/'.$module.'.address_edit')}}</h3>
<hr>    
    {!! Form::model($data, ['method' => 'PATCH','route' => ['contact.address.update', $data->id]]) !!}

    <input type="hidden" name="contact_id"  value="{{$data->contact_id}}" >
<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/'.$module.'.name')}}:</label>
    <div class="col-lg-8">
        {!! Form::text('name', null, ['placeholder' => trans('frontend/'.$module.'.name'),'class' => 'form-control']) !!}     
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/'.$module.'.street')}}:</label>
    <div class="col-lg-8">
        {!! Form::text('street', null, ['placeholder' => trans('frontend/'.$module.'.street'),'class' => 'form-control']) !!}     
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/'.$module.'.house_no')}}:</label>
    <div class="col-lg-8">
        {!! Form::text('house_no', null, ['placeholder' =>  trans('frontend/'.$module.'.house_no')  ,'class' => 'form-control']) !!}     
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label"> {{trans('frontend/'.$module.'.address_additional')}} :</label>
    <div class="col-lg-8">
        {!! Form::text('address_additional', null, ['placeholder' => trans('frontend/'.$module.'.address_additional')  ,'class' => 'form-control']) !!}     
    </div>
</div> 

<div class="form-group">
    <label class="col-lg-3 control-label"> {{trans('frontend/'.$module.'.postal_code')}}     :</label>
    <div class="col-lg-8">
        {!! Form::text('postal_code', null, ['placeholder' => trans('frontend/'.$module.'.postal_code')  ,'class' => 'form-control']) !!}     
    </div>
</div>                    



<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/'.$module.'.city')}} :</label>
    <div class="col-lg-8">
        {!! Form::text('city', null, ['placeholder' => trans('frontend/'.$module.'.city')  ,'class' => 'form-control']) !!}     
    </div>
</div>


<div class="form-group">
    <label class="col-lg-3 control-label">{{trans('frontend/'.$module.'.country')}}:</label>
    <div class="col-lg-8">
        {!! Form::select('country_id', 
        (['' => trans('master.select_item_from_list')] + $countries), 
        null, 
        ['class' => 'form-control']) !!} 
    </div>

</div>
           



<div class="form-group">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-8">
        <input type="submit" class="btn btn-primary" value="{{trans('button.save')}}">         
        <a class="btn btn-danger pull-left" href="{{ route('contact.address.index',$data->contact_id) }}"> {{trans('button.cancel')}}</a>           
    </div>
</div>
{!! Form::close() !!}
 
<!-- End Section Main Content -->	
@endsection
        
 