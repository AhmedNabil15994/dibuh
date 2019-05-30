<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contact_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('address_type_id');
            $table->integer('country_id')->nullable();
            $table->unsignedInteger('governorate_id');

            $table->string('name',100)->nullable();
            $table->string('city',50)->nullable();
            $table->string('house_no',30)->nullable();
            $table->string('street',255)->nullable();
            $table->string('address_additional',255)->nullable();
            $table->string('postal_code',10)->nullable();

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
        Schema::dropIfExists('contact_addresses');
    }
}
