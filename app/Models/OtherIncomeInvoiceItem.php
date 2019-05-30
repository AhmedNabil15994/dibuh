<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OtherIncomeInvoiceItem extends Model {

    //
    protected $appends = ['account','amountAfterDiscount','taxes'];
    protected $table = 'other_income_invoice_items';
    protected $fillable = array('other_income_invoice_id', 'product_id', 'product_name',
        'quantity', 'price', 'tax', 'discount','amount','unit_id','account_id');

    public function otherIncomeInvoice() {
        return $this->belongsTo('App\Models\OtherIncomeInvoice');
    }


    public function product() {

        return $this->belongsTo('App\Models\Product');
    }

    public function taxes()
    {
        return $this->belongsToMany('App\Models\Tax', 'taxes_to_other_income_invoice_items', 'other_income_invoice_item_id', 'tax_id');
    }

    public function getAccountAttribute() {
//        dd($this->product_id);
        $accounts = Account::where('id', $this->account_id)->first();
      if($accounts!=null)
        return $accounts->full_desc;
    }

    public function getTaxesAttribute() {
//        dd($this->product_id);
        $accounts = Account::where('id', $this->account_id)->first();
      if($accounts!=null)
        return $accounts->taxes;
    }


    public function getAmountAfterDiscountAttribute() {
        $price =  $this->price  * $this-> quantity;
        $discount = $this->discount * $price / 100;
        return number_format($price - $discount , 2,'.','');
    }

}
