@extends(Config::get('back_theme').'.layouts.app')

@section('htmlheader_title')
{{ trans('backend/account_to_tax.list') }}
@endsection

@section('contentheader_title')
{{ trans('backend/account_to_tax.list') }}
@endsection

@section('contentheader_description')
 

@endsection

<!--breadcrumb current page-->
@section('current_breadcrumb')
{{ trans('backend/account_to_tax.list') }}
@endsection

@section('page-scripts')
@include(Config::get('back_theme').'.layouts.modals.js.comfirm_delete_js')
@show 


@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">        
        <div class="box box-info">  
            @if ($message = Session::get('flash_message'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

 

            <div class="box-header with-border">
                <div class="pull-left">

                     <h3 class="box-title">{{ trans('backend/account_to_tax.list') }}</h3> 

                </div>
<!--                <div class="pull-right">
                    @permission('account-create')
                    <a class="btn btn-success btn-md" href="{{ route('admin::account_to_companytype.create') }}"><i class="fa fa-plus"></i> {{ trans('button.create') }}</a> 
                    @endpermission
                </div>-->
            </div>



                
                        <div class="table-responsive">
                        <div class="box-body">
                            <table class="table table-borderless deleteFormModal" data-form="deleteForm">
                                <thead>
                                    <tr>
                                        <th width="10%">ID</th>

                                        <th width="35%"> {{ trans('backend/account_to_tax.account') }} </th>
                                        <th width="45%">
                                          
                                <div class="col-md-5">{{ trans('backend/account_to_tax.tax_type') }}</div>
                                <div class="col-md-5">  {{ trans('backend/account_to_tax.tax') }}</div>
                                <div class="col-md-2">  {{ trans('backend/account_to_tax.rate') }}</div>
                    
                                       
                            
                            </th>
                                        <th width="10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($accounts  as $item)
                                <?php
                                    if ($item->is_major == 1){
                                        $bgcolor='green';$color='white';$font_size='bolder';
                                    }else{
                                        $bgcolor='';$color='';$font_size='';
                                    }
                                ?>
                                    <tr>
                                        <td>{{ $item->account_code }}</td>
                                        <td style="background:{{  $bgcolor }};color:{{  $color }};font-size:{{  $font_size }}">{{ $item->name }}</td>
                                        <td  class="button    " >
                                            @foreach($item->taxes as $tax)
                                                   <div class="col-md-5   btn-microsoft btn-md "><span class=" ">{{$tax->taxType->name}}</span></div>
                                                   <div class="col-md-5  btn-info  btn-md">  <span class="  "> {{$tax->name}}</span></div>
                                                  <div class="col-md-2 btn-default  btn-md">   <span class="  "> {{$tax->rate}}</span>  </div>        
                                                  
                                         

                                            
                                            </div>  
                                            @endforeach
                                        
                                        </td>
                                        <td>
                                        
                                            @permission('account-edit')
<!--                                                <a href="{{ url('/backend/account_to_companytype/' . $item->id) }}" class="btn btn-success btn-sm" title="View account_to_companytype"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>-->

                                                <a href="{{ route('admin::account_to_tax.edit',$item->id)  }}" class="btn btn-primary btn-sm" title="Edit account_to_companytype"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            @endpermission

                                            @permission('account-delete')
                                                {!! Form::open([
                                                'method'=>'DELETE',
                                                'route' => ['admin::account_to_tax.destroy', $item->id],
                                                'style' => 'display:inline',
                                                'class'=>'form-delete'
                                                ]) !!}
<!--                                                   {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete account_to_companytype" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm delete',
                                                        'title' => 'Delete account_to_companytype',
                                                        'name' => 'delete',
                                                        'alt'=>trans('button.delete')
                                                     )) !!}-->
                                                {!! Form::close() !!}
                                            @endpermission
                                           
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            
                            <div class="box-footer">
                                <div class="pagination-wrapper"> {!! $accounts->render() !!} </div>
                            </div>                            
                        </div>

                    
        </div>
    </div>
</div> 
</div> 
 <!--include modal for  Deleting Confirmation-->
@include(Config::get('back_theme').'.layouts.modals.comfirm_delete')         
@endsection




 

 