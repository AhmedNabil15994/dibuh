@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/payment.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/payment.list') }}
@endsection

@section('contentheader_description')
 

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
        <div class="pull-left">

            {{ trans('backend/payment.list') }} 

        </div>
        <div class="pull-right">
            @permission('payment-create')
            <a class="btn btn-success btn-md" href="{{ route('admin::payments.create') }}"><i class="fa fa-plus"></i> {{ trans('button.create') }}</a> 
            @endpermission
        </div>
    </div>
</div>
<table class="table table-bordered deleteFormModal" data-form="deleteForm">
    <tr>
        <th>{{ trans('master.no#') }}</th>
        <th>{{ trans('backend/payment.user') }}</th>
        <th>{{ trans('backend/payment.user_bank_account') }}</th>        
        <th>{{ trans('backend/payment.amount') }}</th>
        <th width="280px">{{ trans('master.action') }}</th>
    </tr>
    @foreach ($data as $key => $payment)
    <tr>
        <td>{{ ++$i }}</td>
        <?php 
            $profile = \DB::table('user_profiles')->where('user_id','=',$payment->user_id)->first();
        ?>
        <td><?php echo $profile->first_name ." ". $profile->last_name; ?></td>
        <td>{{ $payment->user_bank_account_id }}</td>        
        <td>{{ $payment->amount }}</td>
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
</table>
{!! $data->render() !!}

<!--include modal for  Deleting Confirmation-->
@include(Config::get('back_theme').'.layouts.modals.comfirm_delete')        
@endsection