 
@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')
 
 
@section('module_breadcrumb')
  <li class="active">{{trans('frontend/dashboard.product')}}</li>
@endsection

@section('content_dashboard')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
            <!-- right column -->
            
 
                <h4>{{trans('frontend/dashboard.product')}}</h4>
<hr>
<div>

    <ul class="list-unstyled">
        @foreach ($data as $row)
        <li><label class="label-info"> {{trans('frontend/product.product_code')}}:  </label>{{ $row->product_code }} /
            <label class="label-info">{{trans('frontend/product.name')}}:  </label>{{ $row->name }} /
            <label class="label-info">{{trans('frontend/product.price')}}:  </label>{{ $row->price }} /
            <label class="label-info">{{trans('frontend/product.product_type')}} :  </label>{{ $row->productType->name }} 
            <a class="btn btn-warning" href="{{ route('product.edit',$row->id) }}">{{trans('button.edit')}}</a>

            {!! Form::open(['method' => 'DELETE','route' => ['product.destroy', $row->id],'style'=>'display:inline']) !!}
            {!! Form::submit(trans('button.delete'), ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </li>
        <hr>

        @endforeach
    </ul> 
    <div style="padding: 10px 0;">
        {!! $data->render() !!}
    </div>
    
    <a class="btn btn-info" href="{{ route('product.create') }}">   {{trans('button.create')}}  </a>    
</div>   
            
@endsection


 
 

 