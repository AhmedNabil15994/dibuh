@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/user.bank_account_edit') }}
@endsection

@section('contentheader_title')
{{ trans('backend/user.bank_account_edit') }}
@endsection

@section('contentheader_description')
{{ trans('backend/user.bank_account_edit') }}
@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/user.bank_account_edit') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">        
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('backend/user.bank_account_edit') }}</h3>
            </div>
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

            {!! Form::model($user, ['method' => 'PATCH','route' => ['admin::users.bankaccount.update', $user->id]]) !!}
            <div class="box-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.bank_data_type')}} :</strong>
                        {!! Form::select('bank_data_type_id', 
                        (['' => trans('master.select_item_from_list')] + $bank_data_types), 
                        $user->bank_data_type_id, 
                        ['class' => 'form-control']) !!}
                    </div>    
                </div>                          
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.bank_name')}}:</strong>
                        {!! Form::text('bank_name', null, array('placeholder' => trans('backend/user.bank_name'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.id_number')}} :</strong>
                        {!! Form::text('id_number', null, array('placeholder' => trans('backend/user.id_number'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.owner_name')}}:</strong>
                        {!! Form::text('owner_name', null, array('placeholder' =>trans('backend/user.owner_name'),'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.iban')}} :</strong>
                        {!! Form::text('iban', null, array('placeholder' => trans('backend/user.iban'),'class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ trans('backend/user.bic')}} :</strong>
                        {!! Form::text('bic', null, array('placeholder' => trans('backend/user.bic'),'class' => 'form-control')) !!}
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> {{ trans('button.save') }}</button>      
                    <a class="btn btn-danger pull-right" href="{{ route('admin::users.show',$user->user_id) }}"><i class="fa fa-home "></i>  {{ trans('button.cancel') }}</a>       
                </div>
            </div>    

            {!! Form::close() !!}
        </div>          
    </div>
</div>
@endsection