<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Config;
use Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Governorate extends Model
{
    protected $table = 'governorates';
    protected $fillable = array('id' ,'name_ar','name_en','name');
    protected $appends = ['name'];
    public $timestamps = false;

    public function getNameAttribute() {

        if (array_key_exists(Request::segment(1), Config::get('languages.available_locales'))) {
            $lang = Request::segment(1);
        } elseif (array_key_exists(Session::get('applocale'), Config::get('languages.available_locales'))) {
            $lang = Session::get('applocale');
        } else {
            $lang = Config::get('languages.default_locale');
        }
        if(!(array_key_exists($lang,$this->attributes)))
           $lang='ar';
        return $this->attributes['name_' . $lang];
    }
}
