<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TCompanyAccountCardDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //this is to used to insert card detailse

        Schema::create('t_user_company_account_card_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        //id
            $table->bigIncrements("id");
        //user id
            $table->bigInteger("user_id");
        //company id
            $table->bigInteger("company_id");
        //card name
            $table->char("card_user_name")->nullable();
        //card type
            $table->char("card_type",4);
        //card number
            $table->char("card_number",16);
        //card number
            $table->char("card_expire_date",5);    
        //final four numbers
            $table->char("card_number_final",4);
        //card no:3 values
            $table->char("card_cvv_number",3);
        //card primary state
            $table->integer("primary_card",3);    
        //active status    [ before active card just check is available atleast one dollar ]
            $table->boolean("card_active_sattus");
        //added on
            $table->date("added_date");
        //updated date on
            $table->date("updated_date")->nullable();    
        //base currency : ex LKR. to make the payment
            $table->char("base_currency_payment_by",4);
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
