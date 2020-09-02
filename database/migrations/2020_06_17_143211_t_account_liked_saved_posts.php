<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TAccountLikedSavedPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Liked count
        //saved count
        //Clicked count
        //this is use to update the count of like, saved and clicked count of selected post

        Schema::create('t_user_post_count_clicked', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        //id
            $table->bigIncrements('row_id');
        //postid
            $table->bigInteger('post_id');
        //cliked_count
            $table->bigInteger('clicked_count');
        //liked_count
            $table->bigInteger('liked_count');
        //Saved count
            $table->bigInteger('saved_count');
        //Searching count
            $table->bigInteger('searching_count');        
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
