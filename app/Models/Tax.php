<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Config;
use Request;
use Illuminate\Support\Facades\Session;

class Tax extends Model {

    //
    //protected $table = 'taxes';
    public $timestamps = true;
    protected $fillable = array('name', 'full_desc', 'name_ar', 'name_en', 'rate', 'tax_type_id');
    protected $appends = ['name', 'full_desc'];

    public function getNameAttribute() {

        if (array_key_exists(Request::segment(1), Config::get('languages.available_locales'))) {
            $lang = Request::segment(1);
        } elseif (array_key_exists(Session::get('applocale'), Config::get('languages.available_locales'))) {
            $lang = Session::get('applocale');
        } else {
            $lang = Config::get('languages.default_locale');
        }

        return $this->attributes['name_' . $lang];
    }

    public function getFullDescAttribute() {

        if (array_key_exists(Request::segment(1), Config::get('languages.available_locales'))) {
            $lang = Request::segment(1);
        } elseif (array_key_exists(Session::get('applocale'), Config::get('languages.available_locales'))) {
            $lang = Session::get('applocale');
        } else {
            $lang = Config::get('languages.default_locale');
        }

        return $this->name . ' -  ' . $this->attributes['name_' . $lang].' - ' . $this->rate;
    }

    public function setNameAttribute($value) {

        if (array_key_exists(Request::segment(1), Config::get('languages.available_locales'))) {
            $lang = Request::segment(1);
        } elseif (array_key_exists(Session::get('applocale'), Config::get('languages.available_locales'))) {
            $lang = Session::get('applocale');
        } else {
            $lang = Config::get('languages.default_locale');
        }

        $this->attributes['name_' . $lang] = $value;
    }

    public function taxType() {

        return $this->belongsTo('App\Models\TaxType');
    }

    public function accounts() {
        return $this->belongsToMany('App\Models\Account', 'accounts_to_taxes', 'account_id', 'tax_id');
    }
    
    public function salesInvoiceItem()
    {
        return $this->belongsToMany('App\Models\SalesInvoiceItem', 'taxes_to_sales_invoice_items', 'tax_id', 'sales_invoice_item_id');
    }       

}
