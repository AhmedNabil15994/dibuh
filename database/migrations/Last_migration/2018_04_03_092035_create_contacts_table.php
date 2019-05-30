<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('title_id');
            $table->tinyInteger('contact_type_id')->nullabe();
            $table->unsignedInteger('user_id');

            $table->string('first_name',50)->nullable();
            $table->string('last_name',100)->nullable();
            $table->string('company',100)->nullable();
            $table->string('contact_number',30)->nullable();
            $table->string('phone',30)->nullable();
            $table->string('email',100)->nullable();
            $table->string('website',100)->nullable();
            $table->text('comment');
            $table->string('job',150)->nullable();
            $table->string('bank_number',20)->nullable();
            $table->string('iban',14)->nullable();
            $table->string('bic',14)->nullable();
            $table->string('notes',25)->nullable();
            $table->string('bank_name',100)->nullable();


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
        Schema::dropIfExists('contacts');
    }
}
