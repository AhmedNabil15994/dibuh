<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    //
    protected $fillable = array('user_id' ,'address_type_id','user_type','name', 'country_id','city','company','house_no','street','address_additional','postal_code');    
    
    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }    
    
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }        
}
