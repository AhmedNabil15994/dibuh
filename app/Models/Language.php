<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $fillable =  ['code','name','native_name','flag','regional','is_active','is_default','dir','txt_dir'];    
}
