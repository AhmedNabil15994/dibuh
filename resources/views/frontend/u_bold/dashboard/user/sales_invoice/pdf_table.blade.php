<html><body>
  <?php   dd($d);?>
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
            @if(count($data))
                <?php $label_type = ['warning', 'info', 'danger', 'success','success']; ?>
                @foreach ($data as $row)
                    <tr style="">

  <?php $text = '';
//dd($row->invoiceStatus->id);
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

                    </tr>
                @endforeach
            @endif()
        </tbody>
    </div>
</table>
</body></html>
