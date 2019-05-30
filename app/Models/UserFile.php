<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Config;
use Request;
use Illuminate\Support\Facades\Session;

class UserFile extends Model {

    //
    protected $table = 'user_files';
    public $timestamps = true;

    protected $fillable = array( 'file', 'file_name', 'user_id');


}
