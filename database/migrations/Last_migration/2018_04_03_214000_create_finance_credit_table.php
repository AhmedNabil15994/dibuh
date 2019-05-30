<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceCreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_credit', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('credit_balance')->default(0);
            $table->tinyInteger('credit_type');
            $table->unsignedInteger('user_id');
            $table->integer('open_balance');

            $table->string('serial_number',255);
            $table->string('credit_owner',255);
            $table->string('credit_bank_name',255);
            $table->string('credit_number',255);


            $table->date('credit_start_date');
            $table->date('credit_end_date');
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
        Schema::dropIfExists('finance_credit');
    }
}
