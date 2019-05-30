<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Config;
use Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Screen extends Model {

    //
    protected $table = 'screens';
    protected $fillable = array('name', 'name_ar', 'name_en');        
    public $timestamps = false;
    protected $appends = ['name'];

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
    
    
    public function accounts()
    {
        return $this->belongsToMany('App\Models\Account', 'accounts_to_screens', 'screen_id', 'account_id');
    }        

}
