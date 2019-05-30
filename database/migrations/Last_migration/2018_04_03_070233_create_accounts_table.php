<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_t', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->default(0);
            $table->integer('rgt');
            $table->integer('lft');
            $table->tinyInteger('depth');
            $table->unsignedTinyInteger('company_type_id');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('account_category_id');
            $table->tinyInteger('account_type_id');
            $table->unsignedInteger('created_by');
            $table->tinyInteger('is_major');
            $table->tinyInteger('is_common')->default(0);

            $table->string('account_code',15);
            $table->string('lineage',255);
            $table->string('name',255);
            $table->string('text',255);
            $table->string('description',255);

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
        Schema::dropIfExists('accounts_t');
    }
}
