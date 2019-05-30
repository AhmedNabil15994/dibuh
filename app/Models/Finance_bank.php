<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finance_bank extends Model
{
    protected $table = 'finance_banks';
    protected $appends = ['type'];
    protected $fillable = [
        'id', 'serial_number', 'account_owner', 'bank_balance', 'start_date', 'IBAN', 'swift_international',
        'account_number', 'swift_national', 'bank_name', 'branch_name', 'branch_code', 'branch_address',
        'city', 'governorate_id','currency_id','user_id','open_balance', 'created_at', 'updated_at'
    ];

    public function getTypeAttribute()
    {
        return 1;
    }
    public function installment()
   {
       return $this->belongsTo('App\Models\Finance_Bank','finance_id','finance_id');
   }
}
