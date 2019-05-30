<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\UserScope;

class Product extends Model {

    //
    // id(pkey), product_code(varchar), user_id(fkey),
    // name (varchar), price (float), tax (float), unit(fkey),
    // description (varchar), comment(varchar), product_type(fkey)
    protected $appends = ['account'];
    protected $fillable = array('product_code', 'name', 'price','account_id','tax_type_id', 'tax_id', 'description', 'comment','time_no', 'account_category_id', 'product_type_id', 'unit_id', 'user_id', 'is_common');

    public function productType() {

        return $this->belongsTo('App\Models\ProductType');
    }

    public function user() {

        return $this->belongsTo('App\Models\User');
    }

    public function createdBy() {

        return $this->belongsTo('App\Models\UserProfile', 'user_id', 'user_id');
    }

    public function account() {

        return $this->belongsTo('App\Models\Account');
    }


    public function taxType() {

        return $this->belongsTo('App\Models\TaxType');
    }

    public function tax() {

        return $this->belongsTo('App\Models\Tax');
    }

    public function getAccountAttribute() {
        $accounts = Account::where('id', '=', $this->id)->first();
        if($accounts!=null)
        return $accounts->full_desc;
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }

}
