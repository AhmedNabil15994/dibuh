<!DOCTYPE html>
<html >

  <head>
<style>
table.result_table {
  direction: rtl; }
table.result_table caption, table.result_table th, table.result_table td {
  direction: rtl; }
.box{
  direction:rtl;
}
</style>
  </head>
  <body>
  <div class="box" style="direction:rtl;">
            <div  style="direction:rtl;">
                <table class="result_table" id="demo-foo-filtering" style="direction:rtl;" >
                    <thead>
                        <tr>
                            <th >الحاله</th>
                            <th >رقم الفاتوره</th>
                            <th >العميل</th>
                            <th>التاريخ</th>
                            <th>تاريخ الاستلام</th>
                            <th>الخصم</th>
                            <th>المبلغ الصافي</th>

                        </tr>
                    </thead>
                    <div class="tableBody">
                        <tbody>
                            @if(count($data))
                            <?php $label_type = ['warning', 'info', 'danger', 'success','success']; ?>
                            @foreach ($data as $row)
                            <tr style="">
                                <td>{{$row->invoiceStatus->name}}</td>
                                <td>{{ $row->invoice_number    }}</td>
                                <td>{{ $row->contact_name      }}</td>
                                <td>{{ $row->invoice_date      }}</td>
                                <td>{{ $row->delivery_date     }}</td>
                                <td>{{ $row->total_discount    }}</td>
                                <td>{{ $row->total_invoice     }}</td>

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
            </div>
        </div>
  </body>
</html>
