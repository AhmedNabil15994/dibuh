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
            <table class="table table-hover table-striped-del daTatable dataTable demo-foo-filtering" id="demo-foo-filtering" >
                <thead>
                    <tr>
                        <th>رقم العميل</th>
                        <th>رقم المورد</th>
                        <th>نوع العميل</th>
                        <th>الاسم الاول</th>
                        <th>الاسم الاخير</th>
                        <th>اسم الشركة</th>
                        <th>المدينة</th>
                        <th>رقم التليفون</th>
                        <th></th>
                    </tr>
                </thead>
                <div class="tableBody">
                    <tbody>
                      <?php //dd($data);?>
                        @if(count($data))
                            @foreach ($data as $row)
                                <tr>
                                  <td>{!! $row->customer_display_id  && $row->customer_display_id !=$row->supplier_display_id  ? $row->customer_display_id : '<span class="label label-inverse">ليس عميل</span>' !!}</td>
                                   <td>{!! $row->supplier_display_id ? $row->supplier_display_id : '<span class="label label-inverse">ليس مورد</span>' !!}</td> -->
                                   <td>{{$row->supplier_display_id !=null && $row->customer_display_id != null && $row->customer_display_id !=$row->supplier_display_id  ? $types[1] . " | " .$types[2] : $types[$row->contact_type_id] }}</td>
                                    <td>{{$row->first_name}}</td>
                                    <td>{{$row->last_name}}</td>
                                    <td>{{$row->company}}</td>
                                    <td>{{$row->city}}</td>
                                    <td>{!!$row->phone !='' ? $row->phone : '<span class="label label-info">لا يوجد رقم</span>'!!}</td>

{{--                                        <td>{!!$row->phone_number != '' ? $row->phone_number  : '<span class="label label-info">لا يوجد رقم</span>'!!}</td>--}}

                                </tr>
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
