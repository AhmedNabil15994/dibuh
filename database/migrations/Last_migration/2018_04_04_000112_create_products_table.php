<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price',11,2);
            $table->unsignedInteger('account_id');
            $table->tinyInteger('time_no');
            $table->tinyInteger('product_type_id');
            $table->tinyInteger('unit_id');
            $table->unsignedInteger('user_id');

            $table->string('product_code',255);
            $table->string('name',255);
            $table->string('description',255);
            $table->string('comment',255);


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
        Schema::dropIfExists('products');
    }
}
