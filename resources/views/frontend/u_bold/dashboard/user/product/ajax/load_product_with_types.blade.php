<table class="table table-hover daTatable demo-foo-filtering" id="demo-foo-filtering" >
    <thead>
    <tr>
        <th>{{trans('frontend/product.product_type_state')}}</th>
        <th>{{trans('frontend/product.product_code')}}</th>
        <th>{{trans('frontend/product.name')}}</th>
        <th>{{trans('frontend/product.price')}}</th>
        <th>{{trans('frontend/product.tax_type')}}</th>
        <th>{{trans('frontend/product.tax_rate')}}</th>

        <th></th>
    </tr>
    </thead>
    <div class="tableBody">
        <tbody>
        @if(count($data))
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->productType->name }}</td>
                    <td>{{ $row->product_code    }}</td>
                    <td>{{ $row->name      }}</td>
                    <td>{{ $row->price      }}</td>
                    <td>
                        <?php
                            $tax_types = \DB::table('products_to_taxtypes')->where('product_code' , '=' , $row->product_code)->pluck('tax_type_id');

                        ?>
                         @foreach($tax_types as $record)
                            <?php
                                $tax_type_name = \DB::table('tax_types')->where('id', '=', $record)->get();

                            ?>
                            @foreach($tax_type_name as $val)
                                <h6>{{$val->name_ar}}</h6>
                            @endforeach

                         @endforeach

                    </td>
                    <td>
                         <?php
                            $taxes = \DB::table('products_to_taxes')->where('product_code' , '=' , $row->product_code)->pluck('tax_id');

                        ?>
                         @foreach($taxes as $record)
                            <?php
                                $tax_name = \DB::table('taxes')->where('id', '=', $record)->get();

                            ?>
                            @foreach($tax_name as $val)
                                <h6>{{$val->rate}}</h6>
                            @endforeach

                         @endforeach

                    </td>

                    <td>
                        <a class="btn btn-default waves-effect waves-light" href="{{ route('product.edit',$row->id) }}"><i class="fa fa-edit"></i> {{trans('تعديل')}} </a>
                        {!! Form::open(['method' => 'DELETE','route' => ['product.destroy', $row->id],'style'=>'display:inline']) !!}
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
