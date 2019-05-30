<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostsOtherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs_other', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('invoice_number')->nullable();
            $table->unsignedInteger('contact_id');
            $table->unsignedInteger('user_id');
            $table->unsignedTinyInteger('invoice_status_id');

            $table->string('contact_name',255);
            $table->string('address',255);
            $table->string('reference_number',255);


            $table->float('total_amount',11,2);
            $table->float('rest',11,2);
            $table->float('total_invoice',11,2);

            $table->double('total_discount',11,2);

            $table->date('invoice_date');
            $table->date('payment_day');
            $table->date('delivery_date');
            $table->date('due_date');

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
        Schema::dropIfExists('costs_other');
    }
}
