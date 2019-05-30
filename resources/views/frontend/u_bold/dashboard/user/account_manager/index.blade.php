 
@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')
 
 


@section('content_dashboard')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
            <!-- right column -->
            
 
                <h4>{{trans('frontend/dashboard.account_manager')}}</h4>
<hr>
<div>

    <ul class="list-unstyled">
        @foreach ($data as $row)
        <li><label class="label-info"> {{trans('frontend/account.account_code')}}:  </label>{{ $row->account_code }} /
            <label class="label-info">{{trans('frontend/account.name')}}:  </label>{{ $row->name }} /
            <label class="label-info">{{trans('frontend/account.text')}}:  </label>{{ $row->text }} /
            <label class="label-info">{{trans('frontend/account.account_type')}} :  </label>{{ $row->accountType->name }} 
            <a class="btn btn-warning" href="{{ route('account.edit',$row->id) }}">{{trans('button.edit')}}</a>

            {!! Form::open(['method' => 'DELETE','route' => ['account.destroy', $row->id],'style'=>'display:inline']) !!}
            {!! Form::submit(trans('button.delete'), ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </li>
        <hr>

        @endforeach
    </ul> 
    <div style="padding: 10px 0;">
        {!! $data->render() !!}
    </div>
    
    <a class="btn btn-info" href="{{ route('account.create') }}">   {{trans('button.create')}}  </a>    
</div>   
            
@endsection



 

 