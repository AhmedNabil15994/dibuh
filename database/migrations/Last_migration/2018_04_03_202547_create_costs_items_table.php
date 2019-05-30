<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cost_id');
            $table->integer('quantity');
            $table->unsignedTinyInteger('unit_id');
            $table->unsignedInteger('account_id');

            $table->string('product_name',255);

            $table->double('price',11,2);
            $table->double('discount',11,2);
            $table->float('amount',11,2);




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
        Schema::dropIfExists('costs_items');
    }
}
