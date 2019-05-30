<tr>
    <td><span>1</span></td>
    <td><select multiple class='product form-control' name='product[1]' id='product'></select></td>
    <td>
        <div class='form-group has-feedback '>
            <input class='form-control' type='text' name='details[1][quantity]' id='quantity_1' value='1' placeholder='{{trans('frontend/sales_invoice.quantity')}}'>
        </div>
    </td>
    <td>
        <div class='form-group has-feedback '>
            <select class='form-control select2' name='details[1][unit_id]'>

            </select>
        </div>
    </td>
    <td>
        <div class='form-group has-feedback '>
            <input class='form-control' type='text' name='details[1][price]' id='price_1' value='0.00' placeholder='{{trans('frontend/sales_invoice.price')}}' onchange='calculateSum(1);'>
        </div>
    </td>

    <td>
        <div class='form-group has-feedback '>
            <input class='form-control row_price_txt' type='text' name='details[1][row_price]' id='row_price_1' value='0.00' placeholder='{{trans('frontend/sales_invoice.price')}}' onchange='calculateSum(1);' readonly>
        </div>
    </td>
    <td>
        <div class='form-group has-feedback '>
            <input class='form-control tax_txt' type='text' name='details[1][tax]' id='tax_1' value='0.00' placeholder='{{trans('frontend/sales_invoice.tax')}}' onchange='calculateSum(1);'>
        </div>
    </td>
    <td>
        <div class='form-group has-feedback '>
            <input class='form-control discount_txt' type='text' name='details[1][discount]' id='discount_1' value='0.00' placeholder='{{trans('frontend/sales_invoice.discount')}}' onchange='calculateSum(1);'>
        </div>
    </td>

    <td>
        <div class='form-group has-feedback '>
            <input class='form-control amount_txt' type='text' name='details[1][amount]' id='amount_1' value='0.00' placeholder='{{trans('frontend/sales_invoice.amount')}}' readonly>
        </div>
    </td>
    <td>
        {{--<a href='javascript:void(0);' id='addCF'><i class='fa fa-plus-circle fa-2x '></i></a>--}}
    </td>

</tr>