<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\UserScope;

class Expense extends Model {

    //
    // id(pkey), product_code(varchar), user_id(fkey), 
    // name (varchar), price (float), tax (float), unit(fkey), 
    // description (varchar), comment(varchar), product_type(fkey)
    protected $fillable = array('expense_code', 'name','account_id', 'description','expense_type_id', 'user_id');

 

    public function user() {

        return $this->belongsTo('App\Models\User');
    }

 
    public function account() {

        return $this->belongsTo('App\Models\Account');
    }
    
        public function expenseType() {

        return $this->belongsTo('App\Models\ExpenseType');
    }
    
    
 
            
        
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }        

}
