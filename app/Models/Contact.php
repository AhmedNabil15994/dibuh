<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\UserScope;

class Contact extends Model {

    //

    protected $fillable = array('id', 'title_id', 'first_name', 'last_name', 'company','region', 'contact_type_id', 'contact_number', 'phone', 'email', 'website', 'comment', 'user_id');
    protected $appends = ['full_name'];
    
    
    public function getFullNameAttribute() {
        return $this->first_name . " " . $this->last_name;
    }
    
 
    

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function profile() {
        return $this->belongsTo('App\Models\UserProfile');
    }

    public function contactType() {
        return $this->belongsToMany('App\Models\ContactType','contacts_to_contact_types','contact_id','contact_type_id');
    }

    public function addresses() {
        return $this->hasMany('App\Models\ContactAddress');
    }

    public function phones() {
        return $this->hasMany('App\Models\Contact_phone');
    }


    public function contact_type()
    {
        return $this->hasMany('App\Models\ContactsToContactType');
//        return $this->belongsToMany('App\Models\ContactType','contacts_to_contact_types','contact_id','contact_type_id');
    }

    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope);
    }    

}
