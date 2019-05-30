@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')

@section('module_breadcrumb')
<li><a href="{{ route('product.index') }}"> {{trans('frontend/dashboard.product')}} </a></li>            
<li class="active"> {{trans('frontend/product.create_new')}} </li>
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
<h3>{{trans('frontend/product.create_new')}}</h3>
<hr>    
{!! Form::open(array('route' => 'product.store','method'=>'POST')) !!}


<div class="form-group">
    <label class="col-lg-3 control-label">     {{ trans('frontend/product.product_code')}} :</label>
    <div class="col-lg-8">


        {!! Form::text('product_code', null, array('placeholder' => trans('frontend/product.product_code'),'class' => 'form-control' )) !!}                        

    </div>

</div>
<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/product.name')}} :</label>
    <div class="col-lg-8">

        {!! Form::text('name', null, array('placeholder' => trans('frontend/product.name'),'class' => 'form-control' )) !!}                        

    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">  {{ trans('frontend/product.price')}} :</label>
    <div class="col-lg-8">
        {!! Form::text('price', null, array('placeholder' => trans('frontend/product.price'),'class' => 'form-control' )) !!}                            
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/product.tax')}} :</label>
    <div class="col-lg-8">

        {!! Form::text('tax', null, array('placeholder' => trans('frontend/product.tax'),'class' => 'form-control' )) !!}      
    </div>
</div>


<div class="form-group">
    <label class="col-lg-3 control-label">           {{ trans('frontend/product.description')}} :</label>
    <div class="col-lg-8">


        {!! Form::text('description', null, array('placeholder' => trans('frontend/product.description'),'class' => 'form-control' )) !!}                        

    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">           {{ trans('frontend/product.comment')}} :</label>
    <div class="col-lg-8">


        {!! Form::text('comment', null, array('placeholder' => trans('frontend/product.comment'),'class' => 'form-control' )) !!}                        

    </div>
</div>


<div class="form-group">
    <label class="col-lg-3 control-label">     {{ trans('frontend/product.product_type')}}:</label>
    <div class="col-lg-8">

        {!! Form::select('product_type_id', 
        (['' =>  trans('master.select_item_from_list') ] + $product_type), 
        null, 
        ['class' => 'form-control select2']) !!}     
    </div>
</div>                    

<div class="form-group">
    <label class="col-lg-3 control-label">     {{ trans('frontend/product.unit')}}:</label>
    <div class="col-lg-8">

        {!! Form::select('unit_id', 
        (['' =>  trans('master.select_item_from_list') ] + $unit), 
        null, 
        ['class' => 'form-control select2']) !!}     
    </div>
</div>    

 

 


<div class="form-group">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-8">
        <input type="submit" class="btn btn-primary" value="{{trans('button.save')}}">         
        <a class="btn btn-danger pull-left" href="{{ route('product.index') }}"> {{trans('button.cancel')}}</a>           


    </div>
</div>
{!! Form::close() !!}




<!-- End Section Main Content -->	
@endsection