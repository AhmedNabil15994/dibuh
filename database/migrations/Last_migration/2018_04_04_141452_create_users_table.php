<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('is_activated')->default(0);
            $table->tinyInteger('is_admin')->default(0);
            $table->integer('created_by')->nullable();


            $table->string('name',255);
            $table->string('email',255);
            $table->string('password',255);
            $table->string('remember_token',100);

             $table->date('last_login_at');
             $table->date('last_login_front')->nullable();
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
        Schema::dropIfExists('users');
    }
}
