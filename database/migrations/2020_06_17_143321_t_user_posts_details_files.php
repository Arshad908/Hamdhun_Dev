<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TUserPostsDetailsFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //this is used to insert file path wich user uploaded to posts more images. if the file select is empty not effect to this table.
        Schema::create('t_user_post_upload_more_files_to_post', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        //Id
            $table->bigIncrements('file_id');    
        //foreign = post id
            $table->bigInteger('post_id');
        // file path
            $table->text('file_path_uploaded', 750);
        //is this post deleted
            $table->boolean('is_active')->default(1);
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
