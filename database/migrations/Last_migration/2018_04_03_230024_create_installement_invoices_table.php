<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallementInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installement_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_invoice_id');
            $table->double('paid');
            $table->integer('finance_id');
            $table->integer('finance_type');
            $table->integer('invoice_type');
            $table->integer('status');

            $table->string('finance_notes',255);

            $table->date('paid_date');
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
        Schema::dropIfExists('installement_invoices');
    }
}
