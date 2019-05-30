<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable {

    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'is_activated', 'created_by', 'last_login_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile() {
        return $this->hasOne('App\Models\UserProfile');
    }

    public function address() {
        return $this->hasMany('App\Models\UserAddress');
    }

    public function bankAccounts() {
        return $this->hasMany('App\Models\UserBankAccount');
    }

    public function payments() {
        return $this->hasMany('App\Models\Payment');
    }

    public function contacts() {
        return $this->hasMany('App\Models\Contact');
    }

    public function files() {
        return $this->hasMany('App\Models\UserFile');
    }

    public function accounts() {
        return $this->belongsToMany('App\Models\Account', 'accounts_to_users');
    }

}
