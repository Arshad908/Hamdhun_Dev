<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TUserAccountUploadPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //This is to use for insert data of posts ids. with company id. 
        //To find out out what are the posts are published by this company id.
        // this is used to get the data to : in home screen second section click on advertiser > get all posts

        Schema::create('t_user_post_upload_count_of_company', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';    
        //id AutoIncrement
            $table->bigIncrements('id');  
        //company id
            $table->bigInteger('company_id');
        //Auth Id
            $table->bigInteger('auth_user_id');
        //posts_id . this will get from the after insert to posts table. after confirm the post by admin.
            $table->bigInteger('post_count_published');
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
