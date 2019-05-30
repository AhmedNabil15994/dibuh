<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbstractInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abstract_invoices', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8';
             $table->collate = 'utf8_unicode_ci';

            $table->increments('id');
            $table->unsignedBigInteger('invoice_number');
            $table->unsignedInteger('contact_id');
            $table->unsignedInteger('user_id');
            $table->tinyInteger('invoice_status_id');

            $table->string('contact_name',255);
            $table->string('address',255);
            $table->string('reference_number',255);

            $table->float('total_amount',11,2);
            $table->float('rest',11,2);
            $table->float('total_invoice',11,2);
            $table->double('total_discount',11,2);

            $table->date('invoice_date');
            $table->date('payment_day');
            $table->date('delivery_date');
            $table->date('due_date');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abstract_invoices');
    }
}
