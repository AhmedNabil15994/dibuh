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
    <div class="pbody table-responsive">
        <div class="BoxContent">
            <table class="table table-hover daTatable dataTable demo-foo-filtering" id="demo-foo-filtering" >
                <thead>
                    <tr>
                        <th>النوع</th>
                        <th>تاريخ الافتتاح</th>
                        <th>أسم الخزنه او الحساب</th>
                        <th>رقم الحساب</th>
                        <th>الرصيد الحالى</th>
                        <th>العملة</th>
                        <th></th>
                    </tr>
                </thead>
                <div class="tableBody">
                    <tbody>
                        @if(count($data))
                        <?php $label_type=['warning','info','danger','success'];
                            $label_name = ['بنك','خزينة','كارت أئتمان'];
                        ?>
                            @foreach($data as $row)
                            <?php
                                $check_closed = \DB::table('closed')->where('finance_type','=',$row['type_id'])->where('finance_id','=',$row['id'])->get();
                            ?>
                            @if(count($check_closed) > 0)

                            @else
                                <tr>
                                    <td><span class="label label-{{$label_type[$row['type_id']-1]}} full-size"  type="{{$row['type_id']}}">{{ $label_name[$row['type_id']-1] }}</span></td>
                                    <td>{{$row['start_date']}}</td>
                                    <td>{{$row['owner_name']}}</td>
                                    <td>{{$row['serial_number']}}</td>
                                    <td>{{$row['balance']}}</td>
                                    <td>{{$row['currency']}}</td>

                                </tr>
                            @endif
                            @endforeach
                        @endif
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
