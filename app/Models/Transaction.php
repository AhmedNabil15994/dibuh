<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\UserScope;

class Transaction extends Model {

    //

    protected $fillable = array('transaction_type_id', 'source_id', 'destination_id', 'value', 'message','user_id', 'transaction_date');
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



    public function transactionType()
    {
        return $this->hasMany('App\Models\TransactionType');
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
