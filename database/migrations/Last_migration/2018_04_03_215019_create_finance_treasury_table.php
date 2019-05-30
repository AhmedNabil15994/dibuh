<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceTreasuryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_treasury', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('start_balance')->default(0);
            $table->unsignedInteger('currency_id');
            $table->unsignedInteger('user_id');
            $table->integer('open_balance');

            $table->string('serial_number',12);
            $table->string('treasury_name',255);

            $table->date('start_date');
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
        Schema::dropIfExists('finance_treasury');
    }
}
