<table class="table table-hover">
    <thead>
    <tr>
        <th>{{trans('frontend/product.product_type_state')}}</th>
        <th>{{trans('frontend/product.product_code')}}</th>
        <th>{{trans('frontend/product.name')}}</th>
        <th>{{trans('frontend/product.price')}}</th>
        <th>{{trans('frontend/product.tax_type')}}</th>
        <th>{{trans('frontend/product.tax_rate')}}</th>
        
        <th></th>
    </tr>
    </thead>
    <div class="tableBody">
        <tbody>
        @if(count($data))
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->productType->name }}</td>
                    <td>{{ $row->product_code    }}</td>
                    <td>{{ $row->name      }}</td>
                    <td>{{ $row->price      }}</td>
                    <td>{{ $row->taxType['name']     }}</td>
                    <td>{{ $row->tax['rate']          }}</td>
                    
                    <td>
                        <a class="btn btn-default waves-effect waves-light" href="{{ route('product.edit',$row->id) }}"><i class="fa fa-edit"></i> {{trans('button.edit')}} </a>
                        {!! Form::open(['method' => 'DELETE','route' => ['product.destroy', $row->id],'style'=>'display:inline']) !!}
                        <button type="submit" class="btn btn-danger waves-effect waves-light"><i class="fa fa-close"></i> {{trans('button.delete')}}</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif()
        </tbody>
    </div>
</table>
@if(!count($data))
    <div id="overlayError">
        <div class="row" style="margin-top: 20px;">
            <div class="col-xs-6 text-right">
                <img style="width: 120px;" src="images/filter.svg">
            </div>
            <div class="col-xs-6">
                <div class="callout callout-info" style="margin-top: 50px;">
                    <h4>لا يوجد نتائج <i class="fa fa-exclamation fa-fw"></i></h4>
                    <p>لا يوجد نتائج مطابقه الان</p>
                </div>
            </div>
        </div>
    </div>
@endif
<div class="NewPagination" style="display: none;">{{$data->links()}}</div>