<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MAdminAccountHolder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_admin_account_holder', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
            $table->string('first_name',120);
            $table->string('last_name',120);
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('account_type');//119 = 119*15-25+105200-102*5*852  
            $table->boolean('account_active_status');//
            $table->string('security_code_one',250);
            $table->string('security_code_two',250);
            $table->rememberToken();
            $table->timestamp('created_time');
            $table->timestamp('updated_time')->nullable();
            $table->integer('updated_by')->defult(0); // user id
            $table->integer('approved_by')->defult(0); // master admin id
            $table->integer('active_flag')->defult(55);// 55 if for registered but not yet active, 68 for registered   , 19 for account deactive
        });
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
