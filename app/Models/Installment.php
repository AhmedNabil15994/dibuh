<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Installment extends Model {

    protected $fillable = array('id', 'invoice_number', 'paid','paid_date','finance_id','finance_type','status');
    protected $table="installement_invoices";



    public function saleinvoice() {

        return $this->belongsTo('App\Models\SalesInvoice');
    }

    public function finance_bank_name($id) {
         $theBank=Finance_bank::find($id);
         if($theBank!=null)
             return $theBank->account_owner;
          else
             return trans('message.deleted');
     }

    public function finance_treasury_name($id) {
         $theTreasury=Finance_treasury::find($id);
         if($theTreasury!=null)
            return $theTreasury->treasury_name;
          else
           return trans('message.deleted');
     }

    public function finance_credit_name($id) {
        $theCredit=Finance_credit::find($id);
        if($theCredit!=null)
           return $theCredit->credit_owner;
        else
           return trans('message.deleted');
     }

}
