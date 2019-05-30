<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bank_balance')->default(0);
            $table->unsignedInteger('governorate_id');
            $table->unsignedInteger('currency_id');
            $table->unsignedInteger('open_balance');
            $table->unsignedInteger('user_id');

            $table->string('serial_number',12);
            $table->string('account_owner',255);
          //  $table->string('bank_balance',);
            $table->string('IBAN',14)->nullable();
            $table->string('swift_international',11)->nullable();
            $table->string('account_number',20)->nullable();
            $table->string('swift_national',9)->nullable();
            $table->string('bank_name',255);
            $table->string('branch_name',255)->nullable();
            $table->string('branch_code',20)->nullable();
            $table->string('branch_address',255)->nullable();
            $table->string('city',30)->nullable();

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
        Schema::dropIfExists('finance_banks');
    }
}
