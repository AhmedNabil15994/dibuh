<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Config;
use Request;
use Illuminate\Support\Facades\Session;

class ExpenseType extends Model {

    //
    protected $table = 'expense_types';
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
    
    
    public function expense() {

        return $this->hasMany('App\Models\Expense');
    }
    
 
}
