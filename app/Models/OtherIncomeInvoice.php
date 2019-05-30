<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\UserScope;

class OtherIncomeInvoice extends Model {

    //

    protected $fillable = array('invoice_number', 'contact_id', 'contact_name', 'address', 'total_value',
        'total_discount', 'invoice_date',  'due_date' ,'payment_day', 'delivery_date', 'reference_number', 'user_id','invoice_status_id');


    public function otherIncomeInvoiceItems() {
        return $this->hasMany('App\Models\OtherIncomeInvoiceItem');
    }   
    
    
    public function detail()
    {
        return $this->hasMany('App\Models\OtherIncomeInvoiceItem','other_income_invoice_id','id');
    }   
    
    
    public function getDetailsCountAttribute()
    {
        return $this->hasMany('App\Models\OtherIncomeInvoiceItem','other_income_invoice_id','id')->count();
    }      
    


    
    public function contact() {

        return $this->belongsTo('App\Models\Contact');
    }
    
    public function createdBy() {

        return $this->belongsTo('App\Models\UserProfile');
    }
    public function invoiceStatus() {

        return $this->belongsTo('App\Models\InvoiceStatus');
    }


    public static function boot()
    {
        parent::boot();    

        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function($invoice)
        {
            $invoice->detail()->delete();
        });
        static::addGlobalScope(new UserScope);// get all invoices for current user
        
    }        
        
    
 
    

}
