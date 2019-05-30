<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    protected $fillable = array('user_id', 'first_name','last_name','company','company_type_id','phone','employees','country_id','governorate_id','postal_code','notes','address','district','fax','url','tax_no','comercial_no','tax_file_no','price_plan_id','expire_date','user_status_id');    
    
    
   
    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    
    public function Country()
    {
        return $this->belongsTo('App\Models\Country');
    }    
    
    
    public function Governorate()
    {
        return $this->belongsTo('App\Models\Governorate');
    }    
    
    
public function getFullNameAttribute()
{
    return $this->first_name . " " . $this->last_name;
}    
 
public function getIdFullNameAttribute()
{
    return $this->user_id . " : " .$this->first_name . " " . $this->last_name;
}            
}
