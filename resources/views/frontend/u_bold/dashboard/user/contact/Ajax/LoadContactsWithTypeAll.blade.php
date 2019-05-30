<table class="table table-hover table-striped-del daTatable demo-foo-filtering" id="" >
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
        @if(count($data))
            @foreach ($data as $row)
                <tr>
                    <td>{!! $row->customer_display_id  && $row->customer_display_id !=$row->supplier_display_id  ? $row->customer_display_id : '<span class="label label-inverse">ليس عميل</span>' !!}</td>
                    <td>{!! $row->supplier_display_id ? $row->supplier_display_id : '<span class="label label-inverse">ليس مورد</span>' !!}</td>
                    <td>{{$row->supplier_display_id !=null && $row->customer_display_id != null && $row->customer_display_id !=$row->supplier_display_id  ? $types[1] . " | " .$types[2] : $types[$row->contact_type_id] }}</td>
                    <td>{{$row->first_name}}</td>
                    <td>{{$row->last_name}}</td>
                    <td>{{$row->company}}</td>
                    <td>{{$row->city}}</td>
                    <td>{!!$row->phone !='' ? $row->phone : '<span class="label label-info">لا يوجد رقم</span>'!!}</td>

                    {{--                                        <td>{!!$row->phone_number != '' ? $row->phone_number  : '<span class="label label-info">لا يوجد رقم</span>'!!}</td>--}}
                    <td>
                        <a class="btn btn-default waves-effect waves-light" href="{{route('contact.edit',$row->contact_id)}}">
                            <i class="fa fa-edit"></i> {{trans('تعديل')}} </a>

                        <form method="POST" action="{{route('contact.destroy' , $row->contact_id)}}" style="display:inline">
                            {{ csrf_field() }} {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger waves-effect waves-light"><i class="fa fa-close"></i> {{trans('حذف')}}</button>
                        </form>
                    </td>
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
<script type="text/javascript">
    $(function(){
        $('.demo-foo-filtering').DataTable();
    });
</script>
