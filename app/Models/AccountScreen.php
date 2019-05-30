<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Config;
use Request;
use Illuminate\Support\Facades\Session;

class AccountScreen extends Model {

    protected $table = 'accounts_to_screens';
    protected $fillable = array('account_id', 'screen_id');
    //
    public $timestamps = false;

    public function account() {
        return $this->belongsTo('App\Models\Account');
    }    
    
    public function screen() {
        return $this->belongsTo('App\Models\Screen');
    }       
}
