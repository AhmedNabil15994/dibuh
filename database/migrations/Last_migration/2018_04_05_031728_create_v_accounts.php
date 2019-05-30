<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TABLE `v_accounts` (
        `account_id` int(10) unsigned
        ,`name` varchar(255)
        ,`displayname` varchar(255)
        ,`account_code` varchar(15)
        ,`company_type_id` text
        ,`user_id` int(10) unsigned
        ,`in_use` int(1)
      )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
