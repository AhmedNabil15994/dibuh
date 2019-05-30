<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SalaryItem extends Model {

    //
    protected $appends = ['account','amountAfterDiscount','taxes'];
    protected $table = 'salaries_items';
    protected $fillable = array('salary_id', 'product_id', 'product_name',
        'quantity', 'price', 'tax', 'discount','amount','unit_id','account_id');


    public function salary() {
        return $this->belongsTo('App\Models\Salary');
    }


    public function product() {

        return $this->belongsTo('App\Models\Product');
    }

    public function taxes()
    {
        return $this->belongsToMany('App\Models\Tax', 'taxes_to_salaries_items', 'salary_item_id', 'tax_id');
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
