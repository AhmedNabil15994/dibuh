@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/payment.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/payment.list') }}
@endsection

@section('contentheader_description')
{{ trans('backend/payment.list') }}

@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/payment.list') }}
@endsection

@section('page-scripts')
@include(Config::get('back_theme').'.layouts.modals.js.comfirm_delete_js')
@show 

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-6">
                        {!! Form::open(array('method'=>'get','class'=>'')) !!}
                        <div class="input-group">
                            <input name="search" value="{{ old('search') }}" type="text" class="form-control" placeholder="Search : User Id , Full Name, Reciept Date , Payment">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Go!</button>
                            </span>
                        </div><!-- /input-group -->
                        {!! Form::close() !!}
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-3">
                        {!! Form::open(array('method'=>'get','class'=>'')) !!}
                        <div class="input-group">
                            <input name="searchYear" value="{{ old('searchYear') }}" type="text" class="form-control" placeholder="Search for Year">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Go!</button>
                            </span>
                        </div><!-- /input-group -->
                        {!! Form::close() !!}
                    </div><!-- /.col-lg-3 -->
                    <div class="col-lg-3">
                        {!! Form::open(array('method'=>'get','class'=>'')) !!}
                        <div class="input-group">
                            <input name="searchMonth" value="{{ old('searchMonth') }}" type="text" class="form-control" placeholder="Search for Month">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Go!</button>
                            </span>
                        </div><!-- /input-group -->
                        {!! Form::close() !!}
                    </div><!-- /.col-lg-3 -->                    
                </div><!-- /.row -->
            </div>
        </div>

        <table class="table table-bordered deleteFormModal" data-form="deleteForm">
            <tr>
                <th>{{ trans('master.no#') }}</th>
                <th>{{ trans('backend/payment.payment_id') }}</th> 
                <th>{{ trans('backend/payment.user_id') }}</th>                
                <th>{{ trans('backend/payment.user') }}</th>
                <th>{{ trans('backend/payment.receipt_date') }}</th>                
                <th>{{ trans('backend/payment.user_bank_account') }}</th>        
                <th>{{ trans('backend/payment.amount') }}</th>
                <th>{{ trans('backend/payment.created_by') }}</th>                
                <th width="280px">{{ trans('master.action') }}</th>
            </tr>
            @if(!empty($data))
                @foreach ($data as $key => $payment)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $payment->id }}</td>                    
                    <td>{{ $payment->user_id }}</td>                    
                    <td>{{ $payment->user->profile->FullName }}</td>
                    <td>{{ $payment->receipt_date }}</td>                    
                    <td>{{ $payment->user_bank_account_id }}</td>        
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->created_by .' ' .$payment->createdBy['FullName'] }}</td>                    
                    <td>

                        @permission('payment-edit')

                        @endpermission
                        @permission('payment-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['admin::payments.destroy', $payment->id], 'class' =>' form-delete','style'=>'display:inline']) !!}
                        <button type="submit" name="delete" class="btn btn-danger btn-xs  delete" alt=" {{trans('button.delete')}}"><i class="fa fa-trash"></i> {{ trans('button.delete') }}</button>                                
                        {!! Form::close() !!}
                        @endpermission
                    </td>
                </tr>
                @endforeach
            @endif
        </table>
        @if(!empty($data))
          
          {!! $data->appends(['search'=>Request::input('search'),'searchYear'=>Request::input('searchYear'),'searchMonth'=>Request::input('searchMonth')])->render() !!}          
        @endif
        <!--include modal for  Deleting Confirmation-->
        @include(Config::get('back_theme').'.layouts.modals.comfirm_delete')        
        @endsection