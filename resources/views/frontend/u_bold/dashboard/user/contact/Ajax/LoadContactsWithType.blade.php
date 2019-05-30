<table class="table table-hover table-striped-del daTatable demo-foo-filtering" id="" >
    <thead>
    <tr>
        <th>الرقم المحاسبي</th>
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
                <?php
                $phones='' ;
                $count = count($row->contacts->first()->phones);
                for ($i=0 ; $i<$count ; $i++){

                    $phones= $row->contacts->first()->phones[$i]->phone_number;
                    if (!$phones == null){
                        break;
                    }
                }
                ?>
                <tr>
                    <td>{{$row->display_id }}</td>
                    <td>{{$row->ContactType->name}}</td>
                    <td>{{$row->contacts->first()->first_name}}</td>
                    <td>{{$row->contacts->first()->last_name}}</td>
                    <td>{{$row->contacts->first()->company}}</td>
                    <?php
                        $contact_id = $row->contacts->first()->id;
                        $address = \DB::table('contact_addresses')->where('contact_id', '=' , $contact_id)->get();
                        $city = '';
                        foreach ($address as $key => $value) {
                            $city = $value->city;
                        }
                    ?>
                    <td><?php echo $city; ?></td>
                    <td>{!!$phones !='' ? $phones : '<span class="label label-info">لا يوجد رقم</span>'!!}</td>
                    <td>
                        <a class="btn btn-default waves-effect waves-light" href="{{route('contact.edit' , $row->contact_id )}}">
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
        $('.demo-foo-filtering').DataTable({
          dom: 'Bfrtip',
         buttons: [
       'csv', 'excel', 'pdf', 'print'
         ]
        });
    });
</script>
