<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesToSalesInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes_to_sales_invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sales_invoice_item_id');
            $table->unsignedInteger('tax_id');
            $table->integer('tax_rate');
            $table->integer('invoice_type')->default(1);
            $table->integer('invoice_number');
            $table->integer('user_id');

            $table->string('tax_name',255);
            $table->string('tax_sign',255);

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
        Schema::dropIfExists('taxes_to_sales_invoice_items');
    }
}
