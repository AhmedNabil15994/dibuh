<table class="table table-hover daTatable dataTable demo-foo-filtering" id="demo-foo-filtering" >
                        <thead>
                            <tr>
                                <th>{{trans('frontend/sales_invoice.status')}}</th>
                                <th>{{trans('frontend/sales_invoice.invoice_number')}}</th>
                                <th>{{trans('frontend/sales_invoice.customer')}}</th>
                                <th>{{trans('frontend/sales_invoice.date')}}</th>
                                <th>{{trans('frontend/sales_invoice.received_date')}}</th>
                                <th>{{trans('frontend/sales_invoice.discount')}}</th>
                                <th>{{trans('frontend/sales_invoice.final_cost')}}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <div class="tableBody">
                            <tbody>

                                @if(!empty($data))
                                    <?php $label_type = ['warning', 'info', 'danger', 'success','success']; ?>
                                    @foreach ($data as $row)
                                        <tr>

                                            <?php $text = '';
                                                if($row->invoiceStatus->id==4){
                                                    $text = $row->invoiceStatus->name;
                                                }else{
                          $text = $row->invoiceStatus->name;
                        }
                                            ?>
                                            <td><span class="label label-{{$label_type[$row->invoiceStatus->id-1]}} full-size"><?php echo $text; ?></span></td>



                                            <td>{{ $row->invoice_number    }}</td>
                                            <td>{{ $row->contact_name      }}</td>
                                            <td>{{ $row->invoice_date      }}</td>
                                            <td>{{ $row->delivery_date     }}</td>
                                            <td>{{ $row->total_discount    }}</td>
                                            <td>{{ $row->total_amount    }}</td>
                                            <td>
                                             <div class="btns">

                                            <a class="btn btn-default  detail-btn waves-effect waves-light detail-btn" href="{{ route('sales_invoice.edit',$row->id) }}"><i class="fa fa-edit"></i> {{trans('frontend/sales_invoice.edit')}}</a>

                                             <a style="padding-left: 8px;" class="btn show_btn  hidden btn-primary   detail-btn waves-effect waves-light" href="{{ route('sales_invoice.show' ,$row->id) }}"><i class="fa fa-vcard"></i>  {{trans('frontend/sales_invoice.show')}}</a>

                                            {!! Form::open(['method' => 'DELETE','route' => ['sales_invoice.destroy', $row->id],'style'=>'display:inline']) !!}
                                            <button style="padding-right: 10px; padding-left: 5px;" type="submit" class="btn btn-danger detail-btn waves-effect detail-btn waves-light"><i class="fa fa-close"></i> {{trans('frontend/sales_invoice.delete')}}</button>
                                             {!! Form::close() !!}
                                            </td>
                                            </div>
                                        </tr>
                                    @endforeach
                                @endif()
                            </tbody>
                        </div>
                    </table>
@if(empty($data))
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
