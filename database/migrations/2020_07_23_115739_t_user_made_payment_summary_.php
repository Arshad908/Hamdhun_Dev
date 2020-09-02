<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TUserMadePaymentSummary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_user_made_payment_summary', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            //id
                $table->bigIncrements('record_id');   
            //company_id
                $table->bigInteger('company_id');   
            //customer_id
                $table->bigInteger('user_id');
            //paid_amount
                $table->decimal('user_paid_in_doll',4,2);
            //refund amount
                $table->decimal('refund_amount_in_doll',4,2);
            //refund_state [ if there is any refunds to make by company. On company post a post within 5 days after payment . 1 means there are to refund, 0 means No to refund]
                $table->boolean('refund_state')->default(0);
            //created date
                $table->dateTime('created_on');
            //updated date [ if nt refunds goes on, then update here]
                $table->dateTime('update_on')->nullable();
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
