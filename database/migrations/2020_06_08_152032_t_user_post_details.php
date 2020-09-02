<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TUserPostDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_user_post_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            //post id
            $table->bigIncrements('post_id');
            //post title
            $table->char('post_title', 150);
            //post KEYWORD
            $table->char('post_keywords', 255);
            //post content
            $table->longText('post_content');
            //post visit link
            $table->text('post_visit_link');
            //price
            $table->float('amount_price', 12, 2);
            //price base to upper case
            $table->char('location_base_price', 3);
            //Advertiesment is a promotion  [ 109 prmotion  110 not a promotion ]
            $table->tinyInteger('post_is_promotion');
            //Expire on
            $table->date('post_expire_on');
            //promotional price
            $table->float('post_promotion_price',12,2);
            //More images i have uploaded   [ 109 yes more uploaded    74 no more uploaded ]
            $table->tinyInteger('more_image_uploaded');
            //Display image path of advertiesment 
            $table->char('display_image_path',255);
            //post from ( get geo location )
            $table->char('location_base_from', 10);
            //common base price from currency to EUR
            $table->float('common_price_eur',12,2);
            //common base prmotional price from currency to EUR
            $table->float("common_promotional_price_eur",12,2);
            //post publish main category
            $table->smallInteger('post_main_category');
            //post publish sub category
            $table->smallInteger('post_sub_category');
            //post new 88 or old 75 
            $table->tinyInteger('product_conditions')->nullable();
            //post approve status // 0 pending for confirm  8 not approved  95 approved
            $table->tinyInteger('approved_status');
            //post approved on
            $table->dateTime('post_approved_at')->nullable();
            //post live status [ //29= pending  50= deleted 95= pending for payment 110=live]
            $table->tinyInteger('active_state_post');
            //post published by  [Auth id]
            $table->bigInteger('published_by');
            //post created on
            $table->dateTime('post_create_at');
            //Post published company     company_id: get from the profile table
            $table->bigInteger('company_id');
            //post update on 
            $table->dateTime('post_update_at')->nullable();
            //post payment id [this payment id generate from when dealing with stripe account]
            //post approved by
            $table->smallInteger('post_approved_by')->nullable();
            //post publish for locally or worlwide
            $table->tinyInteger('post_display_wordwide'); // 98 word wide : 115 nation wide : 120 post deleted

        });


        // Schema::table('t_user_post_details', function(Blueprint $table)
        // {
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');    
        // });  

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
