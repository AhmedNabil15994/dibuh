 
@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')
 
 
@section('module_breadcrumb')
  <li class="active">{{trans('frontend/dashboard.cost')}}</li>
@endsection

@section('content_dashboard')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
            <!-- right column -->
            
 
                <h4>{{trans('frontend/dashboard.cost')}}</h4>
<hr>
<div>

    <ul class="list-unstyled">
        @foreach ($data as $row)
        <li><label class="label-info"> {{trans('frontend/cost.receipt_number')}}:  </label>{{ $row->receipt_number }} /
            <label class="label-info">{{trans('frontend/cost.contact_name')}}:  </label>{{ $row->contact_name }} /
            <label class="label-info">{{trans('frontend/cost.price')}}:  </label>{{ $row->price }} /
            <label class="label-info">{{trans('frontend/cost.document')}} :  </label><img src="{{url('/images/' . $row->user_file_id )}}"/>{{ $row->userFile->file }} 
            {{ Html::image( $row->userFile->file ) }}
            <a class="btn btn-warning" href="{{ route('cost.edit',$row->id) }}">{{trans('button.edit')}}</a>

            {!! Form::open(['method' => 'DELETE','route' => ['cost.destroy', $row->id],'style'=>'display:inline']) !!}
            {!! Form::submit(trans('button.delete'), ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </li>
        <hr>

        @endforeach
    </ul> 
    <div style="padding: 10px 0;">
        {!! $data->render() !!}
    </div>
    
    <a class="btn btn-info" href="{{ route('cost.create') }}">   {{trans('button.create')}}  </a>    
</div>   
            
@endsection


 
 

 