<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finance_credit extends Model
{
    protected $table = 'finance_credit';
    protected $appends = ['type'];
    protected $fillable = [
        'id', 'serial_number', 'credit_owner', 'credit_balance', 'credit_start_date',
        'credit_end_date', 'credit_bank_name', 'credit_number', 'credit_type',
        'user_id','open_balance' ,'created_at', 'updated_at'
    ];

    public function getTypeAttribute()
    {
        return 3;
    }

}
