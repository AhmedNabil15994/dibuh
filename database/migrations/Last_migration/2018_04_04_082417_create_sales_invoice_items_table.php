<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sales_invoice_id');
            $table->unsignedInteger('product_id');
            $table->integer('quantity');
            $table->double('price');
            $table->double('discount');
            $table->unsignedTinyInteger('unit_id');
            $table->float('amount',11,2);
            $table->unsignedInteger('account_id');


            $table->string('product_name',255);

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
        Schema::dropIfExists('sales_invoice_items');
    }
}
