<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbstractInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abstract_invoice_items', function (Blueprint $table) {
              $table->increments('id');
              $table->unsignedInteger('abstract_invoice_id');
              $table->integer('quantity');
              $table->unsignedTinyInteger('unit_id');
              $table->unsignedInteger('account_id');

              $table->string('product_name',255);

              $table->float('amount',11,2);
              $table->double('price',11,2);
              $table->double('discount',11,2);


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
        Schema::dropIfExists('abstract_invoice_items');
    }
}
