<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //

    public function price_plan(){
      return $this->hasOne("App\Models\PricePlan");
    }
}
