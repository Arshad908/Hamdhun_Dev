<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MAdminPostSubCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('m_admin_post_sub_category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        //post category id
             $table->bigIncrements('ndl_scategory_id');
        //post main category id
             $table->unsignedSmallInteger("ndl_s_mcategory_id");
        //post category main category id [This will make the foriegn key with master id]
             $table->foreign('ndl_s_mcategory_id')->references('ndl_category_id')->on('m_admin_post_main_category');     
        //post category name
             $table->text('ndl_scategory_name');
        //post category added on
             $table->dateTime('ndl_screated_on');
        //post category update on
             $table->dateTime('ndl_supdated_on')->nullable();
        //post category added by
             $table->integer('ndl_sadded_by');
        //post category updated by
             $table->integer('ndl_supdated_by')->nullable();
        //post category active status : 78 active , 95 not active [ this is a cascade update ]
             $table->integer('ndl_sactive_flag');
        //post category active status : 78 active , 95 not active [ this is a cascade update ]
             $table->foreign('ndl_sactive_flag')->references('ndl_active_flag')->on('m_admin_post_main_category')->onUpdate('cascade');
        

        


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
