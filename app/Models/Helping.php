<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Helping extends Model
{

    protected $fillable=['id','title','subject','status','user_id'];
    public function replays()
    {
      return $this->belongsTo('App\Models\HelpingReplay');
    }
}
