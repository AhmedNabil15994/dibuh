<table class="table table-hover daTatable demo-foo-filtering" id="demo-foo-filtering" >
    <thead>
    <tr>
        <th>{{trans('frontend/expense.expense_type_state')}}</th>
        <th>{{trans('frontend/expense.expense_code')}}</th>
        <th>{{trans('frontend/expense.name')}}</th>
        <th></th>
    </tr>
    </thead>
    <div class="tableBody">
        <tbody>
        @if(count($data))
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->expenseType->name }}</td>
                    <td>{{ $row->expense_code    }}</td>
                    <td>{{ $row->name      }}</td>
                    <td>
                        <a class="btn btn-default waves-effect waves-light" href="{{ route('expense.edit',$row->id) }}"><i class="fa fa-edit"></i> {{trans('تعديل')}} </a>
                        {!! Form::open(['method' => 'DELETE','route' => ['expense.destroy', $row->id],'style'=>'display:inline']) !!}
                        <button type="submit" class="btn btn-danger waves-effect waves-light"><i class="fa fa-close"></i> {{trans('حذف')}}</button>
                        {!! Form::close() !!}
                    </td>
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
                    <p>iii لا يوجد نتائج مطابقه الان</p>
                </div>
            </div>
        </div>
    </div>
@endif
<script type="text/javascript">
    $(function(){
        $('#demo-foo-filtering').DataTable();
    });
//     jQuery(document).ready(function($) {
//
//          $('#demo-foo-filtering').DataTable(
//            {
//              dom: 'Bfrtip',
//             buttons: [
//                'csv', 'excel', 'pdf', 'print'
//                     ]
//                } );
// } );
</script>
