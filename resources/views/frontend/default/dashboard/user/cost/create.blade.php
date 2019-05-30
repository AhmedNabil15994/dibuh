@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')

@section('module_breadcrumb')
<li><a href="{{ route('cost.index') }}"> {{trans('frontend/dashboard.cost')}} </a></li>            
<li class="active"> {{trans('frontend/cost.create_new')}} </li>
@endsection


@section('page-scripts')
<script>
 


        $('#contact_id').on('change', function (e) {
            var contactID = e.target.value

            $('#contact_name').empty();

            $.ajax({
                url: "{{route('cost.get_contact_data')}}",
                data: {contactID: contactID},
                dataType: "json",
            }).done(function (response) {

                obj = response[0];
                $("#contact_name").val(obj.full_name);
            });
        });

 
 
    //================================================================================================
</script>	
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
<h3>{{trans('frontend/cost.create_new')}}</h3>
<hr>    
{!! Form::open(array('route' => 'cost.store','method'=>'POST')) !!}


<div class="form-group">
    <label class="col-lg-3 control-label">     {{ trans('frontend/cost.contact')}}:</label>
    <div class="col-lg-8">

        {!! Form::select('contact_id', 
        (['' =>  trans('master.select_item_from_list') ] + $contacts), 
        null, 
        ['id'=>'contact_id','class' => 'form-control select2']) !!}     
    </div>
</div>    

<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/cost.contact_name')}} :</label>
    <div class="col-lg-8">

        {!! Form::text('contact_name', null, array('placeholder' => trans('frontend/cost.contact_name'),'id'=>'contact_name','class' => 'form-control' )) !!}                        

    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">           {{ trans('frontend/cost.description')}} :</label>
    <div class="col-lg-8">
        {!! Form::text('description', null, array('placeholder' => trans('frontend/cost.description'),'class' => 'form-control' )) !!}                        
    </div>
</div>


<div class="form-group">
    <label class="col-lg-3 control-label">     {{ trans('frontend/cost.account')}}:</label>
    <div class="col-lg-8">

        {!! Form::select('account_id', 
        (['' =>  trans('master.select_item_from_list') ] + $accounts), 
        null, 
        ['class' => 'form-control select2']) !!}     
    </div>
</div>    

<div class="form-group">
    <label class="col-lg-3 control-label">  {{ trans('frontend/cost.price')}} :</label>
    <div class="col-lg-8">
        {!! Form::text('price', null, array('placeholder' => trans('frontend/cost.price'),'class' => 'form-control' )) !!}                            
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/cost.tax')}} :</label>
    <div class="col-lg-8">

        {!! Form::text('tax', null, array('placeholder' => trans('frontend/cost.tax'),'class' => 'form-control' )) !!}      
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/cost.receipt_date')}} :</label>
    <div class="col-lg-8">

        {!! Form::text('receipt_date', null, array('placeholder' => trans('frontend/cost.receipt_date'),'class' => 'form-control' )) !!}      
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/cost.receipt_number')}} :</label>
    <div class="col-lg-8">
        {!! Form::text('receipt_number', null, array('placeholder' => trans('frontend/cost.receipt_number'),'class' => 'form-control' )) !!}      
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/cost.document')}} :</label>
    <div class="col-lg-8">
        {!! Form::file('user_file_id', null, array('placeholder' => trans('frontend/cost.document'),'class' => 'form-control' )) !!}      
    </div>
</div>



<div class="form-group">
    <label class="col-lg-3 control-label">{{ trans('frontend/cost.status')}}  :</label>   

    {!! Form::select('invoice_status_id', 
    (['' =>  trans('master.select_item_from_list') ] + $invoice_status), 
    null, 
    ['id'=>'invoice_status_id', 'class' => 'form-control col-lg-9 select2','style'=>'width:180px;margin-right:18px']) !!}            


</div>

<div class="form-group">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-8">
        <input type="submit" class="btn btn-primary" value="{{trans('button.save')}}">         
        <a class="btn btn-danger pull-left" href="{{ route('cost.index') }}"> {{trans('button.cancel')}}</a>           


    </div>
</div>
{!! Form::close() !!}




<!-- End Section Main Content -->	
@endsection