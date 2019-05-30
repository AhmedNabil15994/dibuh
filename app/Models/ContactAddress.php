<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Config;
use Request;
use Illuminate\Support\Facades\Session;

class ContactAddress extends Model {

    //
    protected $table = 'contact_addresses';

 
    protected $fillable = array('user_id' ,'contact_id','address_type_id','name', 'country_id','governorate_id','city','house_no','street','address_additional','postal_code');    
    
 
    
    public function contact()
    {
        return $this->belongsTo('App\Models\Contact');
    }     
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }         
    
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    } 
    
    public function governorate()
    {
        return $this->belongsTo('App\Models\Governorate');
    }     

}
