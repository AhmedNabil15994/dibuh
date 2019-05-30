<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    //
    protected $table = 'user_settings';
    protected $fillable = array('key', 'value', 'name', 'description', 'field', 'is_active', 'user_setting_type_id', 'user_id');        
    public $timestamps = false;
    protected $appends = ['name'];
    

    public function userSettingType()
    {
        return $this->belongsTo('App\Models\UserSettingType');      
    }
        
}
