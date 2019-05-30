<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Config;
use Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CompanyType extends Model {

    //
    protected $table = 'company_types';
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
        if(!(array_key_exists($lang,$this->attributes)))
           $lang='ar';
        return $this->attributes['name_' . $lang];
    }

}
