<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Config;
use Request;
use Illuminate\Support\Facades\Session;

class AccountTax extends Model {

    protected $table = 'accounts_to_taxes';
    protected $fillable = array('account_id', 'tax_id');
    //
    public $timestamps = true;

    public function account() {
        return $this->belongsTo('App\Models\Account');
    }    
    
    public function tax() {
        return $this->belongsTo('App\Models\Tax');
    }       
}
