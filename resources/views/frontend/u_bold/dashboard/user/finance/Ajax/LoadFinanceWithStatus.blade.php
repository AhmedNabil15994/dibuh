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
                                        $check_closed = \DB::table('closed')->where('finance_type','=',$row['type'])->where('finance_id','=',$row['id'])->get();
                                    ?>
                                    @if(count($check_closed) > 0)

                                    @else
                                        <tr>
                                            <td><span class="label label-{{$label_type[$row['type']-1]}} full-size"  type="{{$row['type']}}">{{ $label_name[$row['type']-1] }}</span></td>
                                            <td>{{$row['start_date']}}</td>
                                            <td>{{$row['owner_name']}}</td>
                                            <td>{{$row['serial_number']}}</td>
                                            <td>{{$row['balance']}}</td>
                                            <td>{{$row['currency']}}</td>
                                            <td>
                                            <div class="btns">
                                                <a class="btn detail-btn hidden show_btn btn-primary waves-effect waves-light" href="{{route('finance.show',['id' => $row['id'] , 'type'=>$row['type']])}}"><i class="fa fa-vcard"></i> {{trans('button.show')}} </a>
                                                <a class="btn detail-btn btn-default waves-effect waves-light" href="{{route('finance.edit',['id' => $row['id'] , 'type'=>$row['type']])}}"><i class="fa fa-edit"></i> تعديل </a>
                                                <form method="POST" action="{{route('finance.destroy', $row['id'])}}" accept-charset="UTF-8" style="display:inline">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    {{csrf_field()}}
                                                    <input name="type" type="hidden" value="{{$row['type']}}">
                                                    <button type="submit" class="btn del detail-btn btn-danger waves-effect waves-light"><i class="fa fa-close"></i> {{trans('button.delete')}}</button>
                                                </form>
                                                </div>
                                            </td>
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

<script type="text/javascript">
    $(function(){
        var oTable = $('.demo-foo-filtering').DataTable();
        $('#start_date, #end_date').change( function() {
            oTable.draw();
        } );
    });
</script>
