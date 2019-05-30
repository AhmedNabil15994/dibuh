@extends(Config::get('front_theme').'.dashboard.'.$userType.'.'.$module.'.partials.layout')

@section('module_breadcrumb')
<li><a href="{{ route('account.index') }}"> {{trans('frontend/dashboard.user_manager')}} </a></li>            
<li class="active"> {{trans('frontend/user.bank_account')}} </li>
@endsection


@section('content_dashboard')
<!-- right column -->


<h3>{{trans('frontend/user.bank_account')}} </h3>
<hr>
<div>

    <ul class="list-unstyled">
        @foreach ($data as $row)
        <li><label class="label-info"> {{trans('frontend/user.bank_name')}}:  </label>{{ $row->bank_name }} /
            <label class="label-info">{{trans('frontend/user.owner_name')}}:  </label>{{ $row->owner_name }} /
            <label class="label-info">{{trans('frontend/user.iban')}}:  </label>{{ $row->iban }} /
            <label class="label-info">{{trans('frontend/user.bic')}} :  </label>{{ $row->bic }} 
            <a class="btn btn-warning" href="{{ route('profile.bankaccount.edit',$row->id) }}">{{trans('button.edit')}}</a>

            {!! Form::open(['method' => 'DELETE','route' => ['profile.bankaccount.destroy', $row->id],'style'=>'display:inline']) !!}
            {!! Form::submit(trans('button.delete'), ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </li>
        <hr>

        @endforeach
    </ul>  
    <a class="btn btn-info" href="{{ route('profile.bankaccount.create') }}">   {{trans('button.create')}}  </a>    
</div>      



@endsection




