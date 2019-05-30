<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Config;
use Request;
use Illuminate\Support\Facades\Session;

class TaxSalesInvoiceItem extends Model {
    protected $table = 'taxes_to_sales_invoice_items';
    protected $fillable = array('sales_invoice_item_id', 'tax_id','tax_name','tax_value','tax_sign','invoice_type','user_id','created_at','updated_at');
    //

    // public function tax() {
    //     return $this->belongsTo('App\Models\Tax');
    // }

    public function salesInvoiceItem() {
        return $this->belongsTo('App\Models\SalesInvoiceItem');
    }
}
