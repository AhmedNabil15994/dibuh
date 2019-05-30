<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(1);
            $table->integer('company_type_id');
            $table->unsignedInteger('country_id')->default(65);
            $table->unsignedInteger('governorate_id');
            $table->integer('price_plan_id');
            $table->unsignedInteger('user_status_id');


            $table->string('first_name',50);
            $table->string('last_name',100);
            $table->string('company',100);
            $table->string('district',50);
            $table->string('address',255);
            $table->string('phone',20);
            $table->string('employees',255);
            $table->string('fax',20);
            $table->string('postal_code',9);
            $table->string('url',75);
            $table->string('comercial_no',30);
            $table->string('tax_no',50);
            $table->string('tax_file_no',30);
            $table->text('notes');

            $table->date('expire_date')->nullable();

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
        Schema::dropIfExists('user_profiles');
    }
}
