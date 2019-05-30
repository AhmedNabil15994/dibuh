<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpingReplay extends Model
{
    protected $table="helpings_replays";
    protected $fillable=['id','helping_id','replay','user_id'];

    public function help()
    {
      return $this->hasMany('App\Models\Helping');
    }
}
