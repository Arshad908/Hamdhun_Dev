<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TUserAccountProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //This is use to insert user profile data.
        Schema::create('t_user_account_profile_data', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        //id
            $table->bigIncrements("profile_id");
        //Auth ID
            $table->bigInteger("user_auth_id");
        //company account id [ this is not get by user. System will generate number. initiate with 100000 ] . this will used to insert in t_user_account_upload_posts table
            $table->bigInteger("company_id")->nullable();
        //company name
            $table->string("company_name");
            //$table->string("company_name")->change();
        //company account or normal user account [ normal = 96  company = 114 ]
            $table->tinyInteger("account_type");
        //if company : domain name   .. Used to check the if the insert the correct link to visit same posts on thire site.
            $table->string("my_real_domain");
        //contact number
            $table->char("contact_number",50);
        //email
            $table->char("company_email",200);
        //address
            $table->string("company_address");
        //base geo category : ex : LK = lanka
            $table->char("geo_base",4);
        //base sate or district
            $table->char("satedisct",255)->nullable();
        //base city
            $table->char("city",255)->nullable();   
        //Post publish visibility area ..  Word wide or nation wide [ NW = 1587  WW = 3859 ]
            $table->smallInteger("post_visibility");
        //
            $table->char("company_logo_upload")->nullable();            
        //active status  . if this deactivated user account table also update the status
            $table->tinyInteger("user_active_state");
        //added date
            $table->date("created_on");
        //data changed date
            $table->date("updated_on");
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
