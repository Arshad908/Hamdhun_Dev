<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TUsersAccountHolder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
            id
            First name
            Last name
            Email
            password
            Account type   : 19 = Normal User   15 = Web Office can post user
            Account confirm status
            Account active status
            Remembertoken
            
            Created on
            Updated on
            Update by user/admin
            Approved By : Who have approved [ admin id or admin prevelage id behalf of superadmin ]
            Active flag : Account active or not [ 55: not confirm yet   48: Confirmed account by email  20: deactive  ]
        */
        Schema::create('t_users_account_holder', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
            $table->string('first_name',120);
            $table->string('last_name',120);
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('account_type');//18 (display as 9 [18/2]) is for Initial normal users , 52 (display as 26 [52/2]) is for admin , 158 (display as 40 [(40/4)+0.5]) id for master admin 
            $table->boolean('account_active_status');//0 for not active , 15 for activated , 29 account deleted [ this will update depend on profile table active status ]
            $table->string('security_code',150);
            $table->rememberToken();
            $table->timestamp('created_time')->nullable();
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
