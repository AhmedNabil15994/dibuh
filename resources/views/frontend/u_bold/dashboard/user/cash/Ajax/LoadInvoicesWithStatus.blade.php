<table class="table table-hover">
    <thead>
    <tr>
        <th>الحاله</th>
        <th>رقم الفاتوره</th>
        <th>العميل</th>
        <th>التاريخ</th>
        <th>تاريخ الانتهاء</th>
        <th>الخصم</th>
        <th>المبلغ الصافي</th>
        <th></th>
    </tr>
    </thead>
    <div class="tableBody">
        <tbody>
        @if(count($data))
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->invoiceStatus->name }}</td>
                    <td>{{ $row->invoice_number    }}</td>
                    <td>{{ $row->contact_name      }}</td>
                    <td>{{ $row->invoice_date      }}</td>
                    <td>{{ $row->delivery_date     }}</td>
                    <td>{{ $row->discount          }}</td>
                    <td>{{ $row->net_amount        }}</td>
                    <td>
                        <a class="btn btn-default waves-effect waves-light" href="{{ route('sales_invoice.edit',$row->id) }}"><i class="fa fa-edit"></i> {{trans('button.edit')}} </a>
                        {!! Form::open(['method' => 'DELETE','route' => ['sales_invoice.destroy', $row->id],'style'=>'display:inline']) !!}
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