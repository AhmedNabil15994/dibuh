 
@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')
 
 
@section('module_breadcrumb')
  <li class="active">{{trans('frontend/dashboard.sales_invoice')}}</li>
@endsection

@section('content_dashboard')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
            <!-- right column -->
            
 
                <h4>{{trans('frontend/dashboard.sales_invoice')}}</h4>
<hr>
<div>

    <ul class="list-unstyled">
        @foreach ($data as $row)
        <li><label class="label-info"> {{trans('frontend/sales_invoice.sales_invoice_number')}}:  </label>{{ $row->invoice_number }} /
            <label class="label-info">{{trans('frontend/sales_invoice.contact_name')}}:  </label>{{ $row->contact_name }} /
            <label class="label-info">{{trans('frontend/sales_invoice.net_amount')}}:  </label>{{ $row->net_amount}} /
            <label class="label-info">{{trans('frontend/sales_invoice.reference_number')}} :  </label>{{ $row->reference_number }} 
            <a class="btn btn-warning" href="{{ route('sales_invoice.edit',$row->id) }}">{{trans('button.edit')}}</a>

            {!! Form::open(['method' => 'DELETE','route' => ['sales_invoice.destroy', $row->id],'style'=>'display:inline']) !!}
            {!! Form::submit(trans('button.delete'), ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </li>
        <hr>

        @endforeach
    </ul> 
    <div style="padding: 10px 0;">
        {!! $data->render() !!}
    </div>
    
    <a class="btn btn-info" href="{{ route('sales_invoice.create') }}">   {{trans('button.create')}}  </a>    
</div>   
            
@endsection


 
 

 