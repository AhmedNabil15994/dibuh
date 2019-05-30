<table class="table table-hover daTatable dataTable demo-foo-filtering" id="demo-foo-filtering" >
                    <thead>
                        <tr>
                            <th>الحاله</th>
                            <th>رقم الفاتوره</th>
                            <th>العميل</th>
                            <th>التاريخ</th>
                            <th>تاريخ الاستلام</th>
                            <th>الخصم</th>
                            <th>المبلغ الصافي</th>
                            <th></th>
                        </tr>
                    </thead>
                    <div class="tableBody">
                        <tbody>
                            @if(count($data))
                            <?php $label_type = ['warning', 'info', 'danger', 'success','success']; ?>
                            @foreach ($data as $row)
                            <tr style="">
                                <td><span class="label label-{{$label_type[$row->invoiceStatus->id-1]}} full-size">{{$row->invoiceStatus->name}}</span></td>
                                <td>{{ $row->invoice_number    }}</td>
                                <td>{{ $row->contact_name      }}</td>
                                <td>{{ $row->invoice_date      }}</td>
                                <td>{{ $row->delivery_date     }}</td>
                                <td>{{ $row->total_discount    }}</td>
                                <td>{{ $row->total_invoice     }}</td>
                                <td>
                                    <div class="btns">
                                    <a class="btn btn-primary waves-effect hidden show_btn detail-btn waves-light" href="{{ route('cost.show' ,$row->id) }}"><i class="fa fa-vcard"></i>  {{trans('frontend/sales_invoice.show')}}</a>

                                    <a class="btn btn-default waves-effect detail-btn waves-light" href="{{ route('cost.edit',$row->id) }}"><i class="fa fa-edit"></i> تعديل  </a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['cost.destroy', $row->id],'style'=>'display:inline']) !!}
                                    <button type="submit" class="btn btn-danger del detail-btn waves-effect waves-light"><i class="fa fa-close"></i> حذف </button>
                                    {!! Form::close() !!}
                                </td>
                                    </div>
                            </tr>
                            @endforeach

                            @endif()
                        </tbody>
                    </div>
                </table>
@if(!count($data))
<style type="text/css">
    tbody,
    .dataTables_wrapper .row:last-of-type,
    .dataTables_wrapper .row:first-of-type{
        display: none;
    }
</style>
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
<script type="text/javascript">
    $(function(){
        var oTable = $('.demo-foo-filtering').DataTable();
        $('#start_date, #end_date').change( function() {
            oTable.draw();
        } );
    });
</script>
