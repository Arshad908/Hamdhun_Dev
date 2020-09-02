<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TCompanyPostPromoCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Add promo code // in here to expire the promo code , run a cron job.

        Schema::create('t_company_promocode_archives', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

        //id
            $table->bigIncrements('id'); 
        //promo code type [ to categorize is this for social media promo or company promo or promo without company or social ] [185 = social media, 114 = company ]
            $table->tinyInteger('promcode_type');   
        //promo code [ keep this as encrypt]
            $table->char('promo_code',10);
        //promo code [ keep this as encrypt]
            // $table->char('promo_code',10);    
        //which company
            $table->bigInteger('company_id');
        //Offer type [ 85 for Monthly  |  106 for Pay offer ]
            $table->smallInteger('offer_type');
        //poromode description if single
            $table->tinyInteger('description_percentage')->default(0);
        //poromode description if monthly
            $table->dateTime('description_date')->nullable();        
        //used status  [10 pending | 29 used]
            $table->smallInteger('used_status');
        //active status 
            $table->boolean('active_status')->default(1);
        //user activated this code . This will activate the code if the promotion type is monthly escape. After mail confirmation auto this will activated. if not display in his web_admin_payment page. [90 not yet  95 subscribed]
            $table->smallInteger('subscribe_status');    
        //used count [this is use to update count if promo code for social media / without company select issued promocode]
            $table->bigInteger("social_used_count")->default(0);
        //used date
            $table->dateTime('used_on')->nullable();
        //expire status 
            $table->dateTime('expire_on')->nullable();
        //generated date
            $table->dateTime('created_on');    
        //Last date that user can activate this code
            $table->date("entry_expire");    

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
