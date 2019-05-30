<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact_phone extends Model
{
    protected $table = 'contact_phones';
    protected $fillable = array('id', 'contact_id', 'phone_number','user_id','created_at','updated_at');

    public function contact() {
        return $this->belongsTo('App\Models\Contact');
    }

}
