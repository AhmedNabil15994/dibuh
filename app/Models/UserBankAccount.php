<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class UserBankAccount extends Model {

    use Encryptable;
    //
    protected $fillable = array('user_id', 'bank_data_type_id', 'bank_name', 'id_number', 'owner_name', 'iban', 'bic');
    
    protected $encryptable = ['bank_name','id_number','owner_name','iban','bic', ]; // date to be ecryptable/decryptable
    
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function bankDataType() {
        return $this->belongsTo('App\Models\BankDataType');
    }

}
