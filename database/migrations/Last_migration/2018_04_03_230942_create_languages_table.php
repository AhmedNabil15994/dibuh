<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('is_active')->default(0);
            $table->tinyInteger('is_default')->default(0);
            $table->enum('dir', ['rtl', 'ltr'])->default('ltr');
            $table->enum('txt_dir', ['right', 'left'])->default('left');
            $table->tinyInteger('can_delete')->default(1);

            $table->string('code',2);
            $table->string('name',255);
            $table->string('native_name',255);
            $table->string('flag',255);
            $table->string('regional',15);

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
        Schema::dropIfExists('languages');
    }
}
