<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricePlan extends Model
{
    protected $table="price_plans";

    
    public function invoice(){
      return $this->belongsTo("App\Models\Invoice");
    }
}
