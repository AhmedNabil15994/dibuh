<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactsToContactType extends Model
{
    protected $table = 'contacts_to_contact_types';
    protected $guarded = array();  // Important
//    protected $fillable = array('id', 'contact_id', 'contact_type_id', 'display_id','reference_id','is_deleted', 'created_at','updated_at');
    protected $appends = ['name'];


//    public function contactType(){
//        return $this->hasOne('App\Models\ContactType');
//    }


    public function contacts(){
        return $this->hasMany('App\Models\Contact','id','contact_id');
    }
    public function ContactType(){
        return $this->belongsTo('App\Models\ContactType');
    }

    public function getNameAttribute() {

        if (array_key_exists(Request::segment(1), Config::get('languages.available_locales'))) {
            $lang = Request::segment(1);
        } elseif (array_key_exists(Session::get('applocale'), Config::get('languages.available_locales'))) {
            $lang = Session::get('applocale');
        } else {
            $lang = Config::get('languages.default_locale');
        }

        return $this->attributes['name_' . $lang];
    }
}


