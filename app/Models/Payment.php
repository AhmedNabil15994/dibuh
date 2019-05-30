<?php

namespace App\Models;

use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

    //
    use Eloquence;

    protected $fillable = array('user_id', 'user_bank_account_id', 'receipt_date', 'amount', 'paid_days', 'created_by');
    protected $searchableColumns = ['user.profile.first_name', 'user.profile.last_name', 'user_id', 'receipt_date'];

//    protected $casts = [
//        'receipt_date' => 'integer',
//    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function UserBankAccount() {
        return $this->belongsTo('App\Models\UserBankAccount');
    }
    

    public function getMonth() {
        return ['receipt_date'];
    }

    public function getMonthAttribute($value) {
        return ['receipt_date'];
    }
    
    public function createdBy()
    {
    
        return $this->belongsTo('App\Models\UserProfile','created_by','user_id');
        
    }
    
    
 
    
  

}
