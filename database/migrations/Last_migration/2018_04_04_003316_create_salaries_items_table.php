<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('salaries_items');
            $table->integer('quantity');
            $table->double('price',11,2);
            $table->double('discount',11,2);
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
        Schema::dropIfExists('salaries_items');
    }
}
