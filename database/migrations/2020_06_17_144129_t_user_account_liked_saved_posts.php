<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TUserAccountLikedSavedPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //when display the liked and saved post in account page , plese check the active state of post

        Schema::create('t_user_account_liked_saved_posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci'; 

        //id
            $table->bigIncrements('id');
        //user id
            $table->bigInteger('user_id');
        //post id
            $table->bigInteger('advertiesment_id');
        //date time
            $table->dateTime('added_date');
        //post active status [ keep this cascade on update active> deative ] [ post active 85 , post removed from the system 99 ]
            $table->tinyInteger('post_available_or_not');
        //display_status   [user have removed this from my list ] [ 15 user removed  , 75 user not removed ]
            $table->tinyInteger("active_state_user");
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
