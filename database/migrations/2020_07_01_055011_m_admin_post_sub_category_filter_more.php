<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MAdminPostSubCategoryFilterMore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_admin_post_sub_category_filter_more', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->smallIncrements("filter_sub_id");
            $table->smallInteger("mastercat_id");
            $table->smallInteger("subcat_id");
            $table->char("filter_one_text",200);
            $table->smallInteger("created_by");
            $table->date("created_on");

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
