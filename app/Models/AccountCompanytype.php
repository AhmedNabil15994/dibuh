<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Config;
use Request;
use Illuminate\Support\Facades\Session;

class AccountCompanytype extends Model {

    protected $table = 'accounts_to_company_types';
    protected $fillable = array('account_id', 'company_type_id');
    //
    public $timestamps = true;

    public function account() {
        return $this->belongsTo('App\Models\Account');
    }    
    
    public function companyType() {
        return $this->belongsTo('App\Models\CompanyType');
    }       
}
