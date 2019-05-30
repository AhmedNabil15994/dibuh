<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesInvoicesReturnItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoices_return_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sales_invoice_return_id');
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
        Schema::dropIfExists('sales_invoices_return_items');
    }
}
