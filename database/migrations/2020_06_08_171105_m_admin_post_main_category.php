<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MAdminPostMainCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('m_admin_post_main_category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        //post category id
            $table->bigIncrements('ndl_category_id');
        //post category name
            $table->text('ndl_category_name');
        //post category added on
            $table->dateTime('ndl_created_on');
        //post category update on
            $table->dateTime('ndl_updated_on')->nullable();
        //post category added by
            $table->integer('ndl_added_by');
        //post category updated by
            $table->integer('ndl_updated_by')->nullable();
        //post category active status : 78 active , 95 not active
            $table->integer('ndl_active_flag');
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
