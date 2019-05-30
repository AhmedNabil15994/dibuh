<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finance_treasury extends Model
{
    protected $table = 'finance_treasury';
    protected $appends = ['type'];
    protected $fillable = [
        'id', 'serial_number', 'treasury_name', 'start_date', 'start_balance',
        'user_id','currency_id','open_balance' ,'created_at', 'updated_at'
    ];


    public function getTypeAttribute()
    {
        return 2;
    }
}
