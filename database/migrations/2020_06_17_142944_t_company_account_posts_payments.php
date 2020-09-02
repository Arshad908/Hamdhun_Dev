<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TCompanyAccountPostsPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //this is manage the posts are done the payment or not.. check this , is this suitable to add cronjob.
        Schema::create('t_user_make_payment', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        //id
            $table->bigIncrements('transaction_id');    
        //company id
            $table->bigInteger('company_id');
        //posts counts in active
            $table->integer('active_posts_count');
        //payment amount
            $table->decimal('payment_amount',4,2);
        //payment date
            $table->dateTime('payment_date')->nullable();
        //payment status [ 10 not paid  28 paid ]
            $table->smallInteger('paid_status')->default(10);
        //promo code offer
            $table->char('promocode_offer',10)->nullable();
        //refunded amount     this is if the user goes to the next level of uploading post. 1-3[3$] 4-6[2.5$] in between five days post uploaded in 1-3 category to 4-6 category refund [0.5$]
            $table->decimal('refund_amount',4,2);
            $table->dateTime('created_date');
            $table->dateTime('update_date')->nullable();
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
