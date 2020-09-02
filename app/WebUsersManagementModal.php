<?php

namespace App;

use Session;
use Illuminate\Routing\Redirector;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use DB;

date_default_timezone_set('America/Los_Angeles');

class WebUsersManagementModal extends Model
{

    public function webuser_site_save_posts($upload_posts_details){

        $posting_data = $upload_posts_details;

        //check_more_images if available
        $more_images_uploaded = 0;
        $advertisement_display_pics = '';
        if (sizeof($posting_data["uploaded_post_image_more"]) > 0 ){
            $more_images_uploaded = 109;
            $advertisement_display_pics =  $posting_data["uploaded_post_image_more"][0];   
        }else{
            $more_images_uploaded = 74;
            $advertisement_display_pics =  "https://bitsofco.de/content/images/2018/12/broken-1.png";
        }

        $post_title = explode(" ", $posting_data["usr_post_title"]);

        $data_post_key_words = '';

        for ($i=0; $i < count($post_title) ; $i++) { 
            $key_word = metaphone($post_title[$i]);
            $data_post_key_words .=  " ".$key_word; 

        }

        $get_all_currency_rates = file_get_contents('./common_includes/country/currency_update.json');
        $currency_information_update_1 = json_decode($get_all_currency_rates,true);
        $convertion_price = $currency_information_update_1["rates"][base64_decode(session('user_currency'))];


        //Offer posts
        $this_is_offer_post = 110;
        $offer_price = 0.0;
        $offer_price_eur = 0;
        if($posting_data["usr_post_an_offer_post"]){
            $this_is_offer_post = 109;
            $offer_price = $posting_data["usr_post_offer_price"];
            $offer_price_eur = $posting_data["usr_post_offer_price"]/$convertion_price; 
        }



        $product_condition = $posting_data['usr_check_condition'];

        $post_saving_table_data = array(
            "post_title" => $posting_data["usr_post_title"],
            "product_conditions" =>  ($product_condition === "new") ? 88 : 75,
            "post_title_keywords" => $data_post_key_words,
            "post_content" => $posting_data["usr_post_content"],
            "post_visit_link" => $posting_data["usr_post_advertisement_link"],
            "amount_price" => $posting_data["usr_post_price"],
            "location_base_price" => $posting_data["base_currency_type"],
            "post_expire_on" => $posting_data["usr_post_expire_on"],
            "post_promotion_price" => $offer_price,
            "post_is_promotion" => $this_is_offer_post,
            "more_image_uploaded" => $more_images_uploaded,
            "display_image_path" => $advertisement_display_pics,
            "location_base_from" => base64_decode(session('user_location')),
            "common_price_eur" => number_format($posting_data["usr_post_price"]/$convertion_price,2,'.',''),
            "common_promotional_price_eur" => $offer_price_eur,
            "post_main_category" => $posting_data["usr_post_main_cat"]-524,
            "post_sub_category" => $posting_data["usr_post_sub_cat"],
            "approved_status" => 0, // 0 is for pending // 8 is rejected   // 95 approved
            "active_state_post" => 29, //29= pending  50= deleted 95= pending for payment 110=live
            "published_by" => base64_decode(session("user_authentic_id"))-10598152458,
            "post_create_at" => date("Y-m-d h:i:s"),
            "company_id" => session("company_id"),
            "post_display_wordwide" => $posting_data['post_display_wordwide']
        );

        $post_id = DB::table('t_user_post_details')->insertGetId(
            $post_saving_table_data
        );

        //If uploaded more images thne insert to post_file table with post_table id
        if($more_images_uploaded == 109 ){
            $insert_file_data = [];
            foreach ($posting_data["uploaded_post_image_more"] as $keyValue => $valsue) {
                $data = [
                    "post_id" => $post_id,
                    "file_path_uploaded" => $posting_data["uploaded_post_image_more"][$keyValue]       
                ];
                array_push($insert_file_data, $data);
            }
            $imageSaved = DB::table("t_user_post_upload_more_files_to_post")
                ->insert($insert_file_data);
    
        }

        //Check post saved in table
        if($post_id != "" ){
            Session::flash('post_uploade_status', 200); 
        }else{
            Session::flash('post_uploade_status',400); 
        }
        

    }




    //Update post
    public function webuser_site_update_changed_posts($post_info_receved){
        $company_id = session("company_id");


        //check is this post related this user
        $post_id = $post_info_receved['usr_posted_id'];
        $user_id = base64_decode(session("user_authentic_id"))-10598152458;

        $is_this_advertiesment_by_me = DB::table('t_user_post_details')
                                        ->select('post_id')
                                        ->where('post_id',$post_id)
                                        ->where('published_by',$user_id)
                                        ->get();

        if(sizeof($is_this_advertiesment_by_me) > 0){

            //Check this post approve or pending
            $is_this_approved_or_not = DB::table('t_user_post_details')
                                        ->select('approved_status','active_state_post')
                                        ->where('post_id',$post_id)
                                        ->get();                
            
            foreach($is_this_approved_or_not as $info){

                $approved_state = $info->approved_status;
                $active_state = $info->active_state_post;
            
            }



            //check_more_images if available
                $more_images_uploaded = 74;
                $advertisement_display_pics = '';
                if (sizeof($post_info_receved["uploaded_post_image_more"]) > 0 ){
                    $more_images_uploaded = 109;
                    $advertisement_display_pics =  $post_info_receved["uploaded_post_image_more"][0];   
                }else{
                    $more_images_uploaded = ($post_info_receved['allready_uploaded_image'] == "https://bitsofco.de/content/images/2018/12/broken-1.png") ? 74 : 109;
                    $advertisement_display_pics =  $post_info_receved['allready_uploaded_image'];
                }                    

                $post_title = explode(" ", $post_info_receved["usr_post_title"]);

                $data_post_key_words = '';

                for ($i=0; $i < count($post_title) ; $i++) { 
                    $key_word = metaphone($post_title[$i]);
                    $data_post_key_words .=  " ".$key_word; 

                }                    

                $get_all_currency_rates = file_get_contents('./common_includes/country/currency_update.json');
                $currency_information_update_1 = json_decode($get_all_currency_rates,true);
                $convertion_price = $currency_information_update_1["rates"][base64_decode(session('user_currency'))] ;                    


                //Offer posts
                $this_is_offer_post = 110;
                $offer_price = 0.0;
                $offer_price_eur = 0;
                if($post_info_receved["usr_post_an_offer_post"]){
                    $this_is_offer_post = 109;
                    $offer_price = $post_info_receved["usr_post_offer_price"];
                    $offer_price_eur = $post_info_receved["usr_post_offer_price"]/$convertion_price; 
                }                    


                $product_condition = $post_info_receved['usr_check_condition'];




            //if approved
            if($approved_state == 95){

                //update post count
                $post_make_count_update = DB::table("t_user_post_upload_count_of_company")
                                    ->where("company_id" , $company_id)
                                    ->update(
                                        [
                                            "post_count_published" => DB::raw("post_count_published - 1")
                                        ]
                                    );


                
                //update post info
                $post_updating_table_data = DB::table('t_user_post_details')
                    ->where("published_by" , base64_decode(session("user_authentic_id"))-10598152458)
                    ->where("company_id" , session("company_id") )
                    ->where('post_id',$post_id)
                    ->update([
                    
                    "post_title" => $post_info_receved["usr_post_title"],
                    "product_conditions" =>  ($product_condition === "new") ? 88 : 75,
                    "post_title_keywords" => $data_post_key_words,
                    "post_content" => $post_info_receved["usr_post_content"],
                    "post_visit_link" => $post_info_receved["usr_post_advertisement_link"],
                    "amount_price" => str_replace(",", "", $post_info_receved["usr_post_price"]),
                    "location_base_price" => $post_info_receved["base_currency_type"],
                    "post_expire_on" => $post_info_receved["usr_post_expire_on"],
                    "post_promotion_price" => $offer_price,
                    "post_is_promotion" => $this_is_offer_post,
                    "more_image_uploaded" => $more_images_uploaded,
                    "display_image_path" => $advertisement_display_pics,
                    "common_price_eur" => number_format(str_replace(",", "", $post_info_receved["usr_post_price"])/$convertion_price,2,'.',''),
                    "common_promotional_price_eur" => $offer_price_eur,
                    "post_main_category" => $post_info_receved["usr_post_main_cat"]-524,
                    "post_sub_category" => $post_info_receved["usr_post_sub_cat"],
                    "approved_status" => 0, // 0 is for pending // 8 is rejected   // 95 approved
                    "active_state_post" => 29, //29= pending  50= deleted 95= pending for payment 110=live
                    "post_update_at" => date("Y-m-d h:i:s"),
                    "post_display_wordwide" => $post_info_receved['post_display_wordwide']  
                    
                    ]);  
            

                    //If uploaded more images thne insert to post_file table with post_table id
                    if($more_images_uploaded == 109 ){
                        $insert_file_data = [];
                        foreach ($post_info_receved["uploaded_post_image_more"] as $keyValue => $valsue) {
                            $data = [
                                "post_id" => $post_id,
                                "file_path_uploaded" => $post_info_receved["uploaded_post_image_more"][$keyValue]       
                            ];
                            array_push($insert_file_data, $data);
                        }
                        $imageSaved = DB::table("t_user_post_upload_more_files_to_post")
                            ->insert($insert_file_data);
                
                    }


                    //Check post saved in table
                    if($post_updating_table_data != "" ){
                        Session::flash('post_uploade_status', 200); 
                    }else{
                        Session::flash('post_uploade_status',400); 
                    }

                    //Post not approved
            }else if($approved_state == 0){
                    //update post info
                $post_updating_table_data = DB::table('t_user_post_details')
                    ->where("published_by" , base64_decode(session("user_authentic_id"))-10598152458)
                    ->where("company_id" , session("company_id") )
                    ->where('post_id',$post_id)
                    ->update([
                    
                    "post_title" => $post_info_receved["usr_post_title"],
                    "product_conditions" =>  ($product_condition === "new") ? 88 : 75,
                    "post_title_keywords" => $data_post_key_words,
                    "post_content" => $post_info_receved["usr_post_content"],
                    "post_visit_link" => $post_info_receved["usr_post_advertisement_link"],
                    "amount_price" => str_replace(",", "", $post_info_receved["usr_post_price"]),
                    "location_base_price" => $post_info_receved["base_currency_type"],
                    "post_expire_on" => $post_info_receved["usr_post_expire_on"],
                    "post_promotion_price" => $offer_price,
                    "post_is_promotion" => $this_is_offer_post,
                    "more_image_uploaded" => $more_images_uploaded,
                    "display_image_path" => $advertisement_display_pics,
                    "common_price_eur" => number_format(str_replace(",", "", $post_info_receved["usr_post_price"])/$convertion_price,2,'.',''),
                    "common_promotional_price_eur" => $offer_price_eur,
                    "post_main_category" => $post_info_receved["usr_post_main_cat"]-524,
                    "post_sub_category" => $post_info_receved["usr_post_sub_cat"],
                    "approved_status" => 0, // 0 is for pending // 8 is rejected   // 95 approved
                    "active_state_post" => 29, //29= pending  50= deleted 95= pending for payment 110=live
                    "post_update_at" => date("Y-m-d h:i:s"),
                    "post_display_wordwide" => $post_info_receved['post_display_wordwide']  
                    
                    ]);  
            

                    //If uploaded more images thne insert to post_file table with post_table id
                    if($more_images_uploaded == 109 ){
                        $insert_file_data = [];
                        foreach ($post_info_receved["uploaded_post_image_more"] as $keyValue => $valsue) {
                            $data = [
                                "post_id" => $post_id,
                                "file_path_uploaded" => $post_info_receved["uploaded_post_image_more"][$keyValue]       
                            ];
                            array_push($insert_file_data, $data);
                        }
                        $imageSaved = DB::table("t_user_post_upload_more_files_to_post")
                            ->insert($insert_file_data);
                
                    }


                    //Check post saved in table
                    if($post_updating_table_data != "" ){
                        Session::flash('post_uploade_status', 200); 
                    }else{
                        Session::flash('post_uploade_status',400); 
                    }

            }

            //If not approve then ok. If it is approve then re-update the process

        }else{
            $error_page = [
                "page" => "Error Page",
                "status" => 404,
                "message" => "Please check info." 
            ];
            return json_encode($error_page);
            //error page. this post not related to you.
       
        }

   

    }



    public function load_main_and_sub_category(){

    	// $ms_category = DB::table("m_admin_post_main_category")
    	// 				->select("m_admin_post_sub_category.ndl_scategory_id as sid","m_admin_post_main_category.ndl_category_id as mid","m_admin_post_main_category.ndl_category_name as mname","m_admin_post_sub_category.ndl_scategory_name as msname")
    	// 				->join("m_admin_post_sub_category","m_admin_post_sub_category.ndl_s_mcategory_id","=","m_admin_post_main_category.ndl_category_id")
    	// 				->where("m_admin_post_main_category.ndl_active_flag",78)
    	// 				->where("m_admin_post_sub_category.ndl_sactive_flag",78)
    	// 				->get();
    	$m_category = DB::table("m_admin_post_main_category")
    					->select("ndl_category_id as mid","ndl_category_name as mname")
    					->where("ndl_active_flag",78)
    					->get();
    	$s_category = DB::table("m_admin_post_sub_category")
    					->select("ndl_scategory_id as sid","ndl_scategory_name as sname","ndl_s_mcategory_id as msid")
    					->where("ndl_sactive_flag",78)
    					->orderBy("ndl_s_mcategory_id","ASC")
    					->get();						

    	$data = [];
    	array_push($data, $m_category);
    	array_push($data, $s_category);				

    	return json_encode($data);				

    }

    //load currency data
    public function load_curency_data(){
        $s_currency = DB::table("m_admin_currency_code_country")
                        ->select("country as sid","country_code as sname","currency_id as sd")
                        ->orderBy("country","ASC")
                        ->get();
       return $s_currency;                         
    }


    //create encryption key
    public function loadind_encrtp_key(){
        $cipher ="AES-256-CBC";
        //$key = 'd41d8cd98f00b204e9800998ecf8427e';'adkfg87635984135sdgfjdsahjrgqqee';
        $findKey = $this->generateRandomString();
        $card_info_enc_key = $this->generateRandomString();
        $var = session(['enc_key' => $findKey,"card_encryption_key" => $card_info_enc_key]);
        $key = session('enc_key');

        

        return  json_encode($key); 
    }


    //dashboard detailse load
    public function listed_all_lastest_post_detailse_dash(){
        $user_auth_id = base64_decode(session("user_authentic_id"))-10598152458;
        $user_company_id = session("company_id");

        $user_post_data = DB::table("t_user_post_details") 
                       ->select("post_id  as pid","post_title as ptitle","post_create_at as pcreatedon","approved_status as papproved","active_state_post as plivestatus","display_image_path as imagelive")
                       //->join("t_users_account_holder","t_users_account_holder.id","=","t_user_account_profile_data.")
                       ->where("company_id",session('company_id'))
                       ->where("published_by",$user_auth_id)
                       ->get();  

        return $user_post_data;
    }

    //dashboard detailse load
    public function dash_listed_all_post_wishlisted_detailse(){
        
        $user_auth_id = base64_decode(session("user_authentic_id"))-10598152458;

        $wishlistd_post = DB::table('t_user_account_liked_saved_posts')
                            ->select(
                                "t_user_post_details.post_title as ptitle","t_user_post_details.display_image_path as pimage","t_user_post_details.post_id as pid","t_user_post_details.approved_status as pstatus","t_user_post_details.active_state_post as pactives",
                                "t_user_account_liked_saved_posts.added_date as pdate","t_user_account_liked_saved_posts.active_state_user as pactive"
                            )
                            ->join("t_user_post_details","t_user_post_details.post_id","=","t_user_account_liked_saved_posts.advertiesment_id")
                            ->where("t_user_account_liked_saved_posts.user_id",$user_auth_id)
                            ->get();    
        
        return $wishlistd_post;
    
    }


    //latest viewed posts display in dashboard
    public function viewed_ltest_viewed_posts(){
        
        $currenctDate = Carbon::create(date("Y"), date("m"), date("d"), 0);
        $one_month_back = $currenctDate->subMonth();

        $user_auth_id = base64_decode(session("user_authentic_id"))-10598152458;

        $viewed_posts = DB::table("t_user_post_viewed_count")
                            ->select(
                                "t_user_post_details.post_title as ptitle","t_user_post_details.display_image_path as pimage","t_user_post_details.post_id as pid","t_user_post_details.approved_status as pstatus","t_user_post_details.active_state_post as pactives",
                                "t_user_post_viewed_count.viewed_date as pdate"
                            )
                            ->join("t_user_post_details","t_user_post_details.post_id","=","t_user_post_viewed_count.post_id")
                            ->where("t_user_post_viewed_count.user_id",$user_auth_id)
                            ->where("t_user_post_viewed_count.viewed_date",">",$one_month_back)
                            ->get();

        return $viewed_posts;                    
    }



    //Load profile user data
    public function UserDetailseLoadToProfile(){
        $user_auth_id = base64_decode(session("user_authentic_id"))-10598152458;

        $user_data = DB::table("t_user_account_profile_data") 
                       ->select("account_type as atype","company_name as acompanyname","my_real_domain as adomain","contact_number as acontact","company_email as acompanyemail","company_address as acompanyaddress","geo_base as ageobase","satedisct as state","city as acity","post_visibility as apostvisibility","company_logo_upload as acompanyloago")
                       //->join("t_users_account_holder","t_users_account_holder.id","=","t_user_account_profile_data.")
                       ->where("user_auth_id",$user_auth_id)
                       ->get();  

        return $user_data;                 
    }


    //List all posts data
    public function WebAdminPostDetailseLoad(){

        $user_auth_id = base64_decode(session("user_authentic_id"))-10598152458;
        $user_company_id = session("company_id");

        $user_post_data = DB::table("t_user_post_details") 
                       ->select("post_id  as pid","post_title as ptitle","post_create_at as pcreatedon","approved_status as papproved","active_state_post as plivestatus","display_image_path as imagelive")
                       //->join("t_users_account_holder","t_users_account_holder.id","=","t_user_account_profile_data.")
                       ->where("company_id",session('company_id'))
                       ->where("published_by",$user_auth_id)
                       ->get();  

        return $user_post_data;
        
    }


    //list all webadmin saved all posts
    public function WebAdminSavedPostDetailse(){
        $user_auth_id = base64_decode(session("user_authentic_id"))-10598152458;

        $user_post_data = DB::table("t_user_account_liked_saved_posts") 
                       ->select("t_user_post_details.post_id as pid","t_user_account_liked_saved_posts.added_date as saved_on","t_user_account_liked_saved_posts.post_available_or_not as is_in_system","t_user_account_liked_saved_posts.active_state_user as is_active_to_user",
                           "t_user_post_details.post_title as ptitle","t_user_post_details.display_image_path as imagelive")
                       ->join("t_user_post_details","t_user_post_details.post_id",'=','t_user_account_liked_saved_posts.advertiesment_id')
                       ->where("t_user_account_liked_saved_posts.user_id",$user_auth_id)
                       ->where("t_user_account_liked_saved_posts.post_available_or_not",85)
                       ->where("t_user_account_liked_saved_posts.active_state_user",75)
                       ->get();

        return $user_post_data;               
    }



    //Remove wish list post info
    public function WebAdminRemoveSavedPostDetailseFromlist($post_id){

        $post_wish_list_remove = DB::table("t_user_account_liked_saved_posts")
                                ->where("advertiesment_id" , $post_id)
                                ->update([
                                    "active_state_user" => 15                                        
                                ]);
        return $post_wish_list_remove;                        
    }



    //Load profile user data
    public function UserCardDetailseLoadToProfile(){
        $user_auth_id = base64_decode(session("user_authentic_id"))-10598152458;

        $user_data = DB::table("t_user_company_account_card_details") 
                       ->select("card_number_final as pcfinalnumber","card_type as pccard","primary_card as pkasid")
                       //->join("t_users_account_holder","t_users_account_holder.id","=","t_user_account_profile_data.")
                       ->where("user_id",$user_auth_id)
                       ->get();  

        return $user_data;                 
    }



    //User wants to amount get
    public function check_all_pending_payment_status_of_this_user(){
        
        $user_auth_id = base64_decode(session("user_authentic_id"))-10598152458;
        $company_id = session("company_id");

        $any_pending = DB::table("t_user_make_payment")
                        ->select("paid_status as pdstate","payment_amount as pdtopay")
                        ->where("company_id",$company_id)
                        ->get();    

        $to_pay_status = 0; 
        $to_pay_amount = "";                
        if(count($any_pending) > 0 ){               
            foreach ($any_pending as $key => $value) {
                $to_pay_amount = $value->pdtopay;
                $to_pay_status = 1;     
            }           
        }

        $return_data = [
            "status" => $to_pay_status,
            "amount" => $to_pay_amount
        ];          

        return $return_data;    

    }



    //save user profile info (if user in normal account. this is not related to company account)
    public function webuser_profile_registration_update($data_profie_indo){
        $first_name = $data_profie_indo[0];
        $last_name = $data_profie_indo[1];
        $account_type = $data_profie_indo[2];
        $email_id = $data_profie_indo[3];
        $contact_number = $data_profie_indo[4];
        $country = $data_profie_indo[5];
        $state = $data_profie_indo[6];
        $city = $data_profie_indo[7];
        $password = $data_profie_indo[8];
        $user_auth_id = base64_decode(session("user_authentic_id"))-10598152458;
        
        $insert_profile_table_data = [ 
            "user_auth_id" => $user_auth_id,
            "company_id" => 000000000,
            "company_name" => "check_about_no",
            "account_type" =>  ($account_type) ? 96 : 114,
            "my_real_domain" => "no",
            "contact_number" => $contact_number,
            "company_email" => $email_id,
            "company_address" => "no",
            "geo_base" => $country,
            "satedisct" => $state,
            "city" => $city,
            "post_visibility" => 9000,
            "company_logo_upload" => "",
            "user_active_state" => 1,
            "created_on" => now(),
            "updated_on" => now()    
        ];

        $daat_update_status = DB::table("t_user_account_profile_data")
                                ->updateOrInsert(
                                    ["user_auth_id" => $user_auth_id],
                                    [
                                        "user_auth_id" => $user_auth_id,
                                        "company_id" => 000000000,
                                        "company_name" => "check_about_no",
                                        "account_type" =>  96,
                                        "my_real_domain" => "no",
                                        "contact_number" => $contact_number,
                                        "company_email" => $email_id,
                                        "company_address" => "no",
                                        "geo_base" => $country,
                                        "satedisct" => $state,
                                        "city" => $city,
                                        "post_visibility" => 9000,
                                        "company_logo_upload" => "",
                                        "user_active_state" => 1,
                                        "created_on" => now(),
                                        "updated_on" => now()
                                    ]
                                );

        if($daat_update_status){
            $data = ["account_type"=>($account_type) ? 96 : 114];
            session($data);
        }                        

        return $daat_update_status;

    }

    //save user profile info ( this is not related to normal accunt )
    public function webuser_company_profile_registration_update($data_profie_indo_compnu){
        
        //select max company id
        $company_id = DB::table('t_user_account_profile_data')
                        ->max('company_id');


        $company_name = $data_profie_indo_compnu["company_name"];
        $company_domain = $data_profie_indo_compnu["company_domain"];
        $post_visibility = $data_profie_indo_compnu["post_visibility"];//
        $logo_updated_path = $data_profie_indo_compnu["logo_updated_path"];//
        $firstname = $data_profie_indo_compnu["firstname"];
        $lastname = $data_profie_indo_compnu["lastname"];
        $advertiser = $data_profie_indo_compnu["advertiser"];
        $emailid = $data_profie_indo_compnu["emailid"];
        $contactnumber = $data_profie_indo_compnu["contactnumber"];
        $country = $data_profie_indo_compnu["country"];
        $statedisc = $data_profie_indo_compnu["statedisc"];//
        $city = $data_profie_indo_compnu["city"];//
        $passwordreset = $data_profie_indo_compnu["passwordreset"];

        $user_auth_id = base64_decode(session("user_authentic_id"))-10598152458;

        $insert_profile_table_data = [
            "user_auth_id" => $user_auth_id,
            "company_id" => $company_id+1, // this is get by getting in session . if this is new then increment one
            "company_name" => $company_name,
            "account_type" =>  ($advertiser) ? 96 : 114,
            "my_real_domain" => $company_domain,
            "contact_number" => $contactnumber,
            "company_email" => $emailid,
            "company_address" => "no",
            "geo_base" => $country,
            "satedisct" => $statedisc,
            "city" => $city,
            "post_visibility" => $post_visibility,
            "company_logo_upload" => $logo_updated_path,
            "user_active_state" => 1,
            "created_on" => now(),
            "updated_on" => now()    
        ];

        $daat_update_status = DB::table("t_user_account_profile_data")
                                ->updateOrInsert(
                                    ["user_auth_id" => $user_auth_id],
                                    [
                                        // "user_auth_id" => $user_auth_id,
                                        "company_id" => $company_id+1,
                                        "company_name" => $company_name,
                                        "account_type" =>  114,
                                        "my_real_domain" => $company_domain,
                                        "contact_number" => $contactnumber,
                                        "company_email" => $emailid,
                                        "company_address" => "no",
                                        "geo_base" => $country,
                                        "satedisct" => $statedisc,
                                        "city" => $city,
                                        "post_visibility" => $post_visibility,
                                        "company_logo_upload" => $logo_updated_path,
                                        "user_active_state" => 1,
                                        "created_on" => now(),
                                        "updated_on" => now() 
                                    ]
                                );

        if($daat_update_status){
            $data = [
                "account_type" => 114,
                "company_image" => $logo_updated_path,
                "company_id" => $company_id+1,//change this hard coded value
            ];
            session($data);
        }                        

        return $daat_update_status;

    }



    //Make web admin user save card
    public function webuser_company_card_inserttion($data_card_info){

        $insert_profile_table_data = [
            "user_id" => base64_decode(session("user_authentic_id"))-10598152458,
            "company_id" => session("company_id"), // this is get by getting in session . if this is new then increment one
            "card_user_name" => $data_card_info[1],
            "card_type" =>  $data_card_info[0],
            "card_number" => $data_card_info[2],
            "card_expire_date" => $data_card_info[3] ,
            "card_number_final" => substr($data_card_info[2], 12,17),
            "card_cvv_number" => $data_card_info[4],
            "card_active_sattus" => 1,
            "added_date" => date("Y-m-d"),
            "base_currency_payment_by" => base64_decode(session('user_currency'))    
        ];

        $daat_update_status = DB::table("t_user_company_account_card_details")
                                ->insert($insert_profile_table_data);

        if($daat_update_status){
            $data= [
                "card_info_saved" => true
            ];    
            session($data);
        }                        

        return $daat_update_status;



    }


    //Post edit delete view function by web admin
    public function web_admin_make_post_detailse($operation_type,$company_id,$user_auth_id,$post_id){

        //operation type : view or delete or edit
        $op_type = $operation_type;
        $post = $post_id;

        //edit
        if($op_type == "edit"){
            $posts_data = DB::table("t_user_post_details")
                        ->select("t_user_post_details.post_id as pid","t_user_post_details.post_title as ptitle","t_user_post_details.location_base_price as plocationprice","t_user_post_details.display_image_path as pdisplaypic","t_user_post_details.product_conditions as pcondition","t_user_post_details.post_content as pcontent","t_user_post_details.post_visit_link as pvisitlink","t_user_post_details.amount_price as pprice","t_user_post_details.post_is_promotion as pispromotion","t_user_post_details.post_promotion_price as promotionprice","t_user_post_details.post_expire_on as pexpire","t_user_post_details.post_display_wordwide as pdisplaytype","t_user_post_details.post_sub_category as psubcategory","t_user_post_details.post_main_category as pmaincategory","t_user_post_details.post_display_wordwide as display_word_wide")
                        ->where("t_user_post_details.post_id",$post)
                        ->where("t_user_post_details.company_id",$company_id)
                        ->where("t_user_post_details.published_by",$user_auth_id)
                        ->get();


            return $posts_data;            

        }

        //view
        if($op_type == "view"){
            
            $posts_data = DB::table("t_user_post_details")
                        ->select("t_user_post_details.post_id as pid","t_user_post_details.post_title as ptitle","t_user_post_details.location_base_price as plocationprice","t_user_post_details.product_conditions as pcondition","t_user_post_details.post_content as pcontent","t_user_post_details.post_visit_link as pvisitlink","t_user_post_details.amount_price as pprice","t_user_post_details.post_is_promotion as pispromotion","t_user_post_details.post_promotion_price as promotionprice","t_user_post_details.post_expire_on as pexpire","t_user_post_details.more_image_uploaded as pimages","m_admin_post_main_category.ndl_category_name as pmcategory","t_user_post_details.approved_status as papprooved","t_user_post_details.active_state_post as pactivestate","t_user_post_details.post_display_wordwide as pdisplaytype","t_user_account_profile_data.company_name as pcompanyname","t_user_account_profile_data.company_id as pcid","m_admin_post_sub_category.ndl_scategory_name as psubcategory")
                        ->join("t_user_account_profile_data","t_user_account_profile_data.company_id","=","t_user_post_details.company_id")
                        ->join("m_admin_post_main_category","m_admin_post_main_category.ndl_category_id","=","t_user_post_details.post_main_category")
                        ->join("m_admin_post_sub_category","m_admin_post_sub_category.ndl_scategory_id","=","t_user_post_details.post_sub_category")
                        ->where("t_user_post_details.post_id",$post)
                        ->where("t_user_post_details.company_id",$company_id)
                        ->where("t_user_post_details.published_by",$user_auth_id)
                        ->get();

            return $posts_data;
        }

        //delete
        if($op_type == "delete"){
            
            $operation_make_post_delete = DB::table("t_user_post_details")
                                               ->where("post_id",$post)
                                               ->where("company_id",$company_id)
                                               ->where("published_by",$user_auth_id)
                                               ->update(
                                                [
                                                    "active_state_post" => 50
                                                ]
                                               ); 
            return $operation_make_post_delete;                                   
        }


    }




    //Activate user promo codes by web admin monthly activation
    public function web_user_activate_promotion_code_by_url($promocode){
        
        $promo_code = $promocode;
        $company_id = session("company_id");

        $today = date("Y-m-d");
        $now =  Carbon::create(date("Y"),date("m"),date("d"),0);
        $data = DB::table("t_company_promocode_archives")
                    ->select("id","description_date")
                    ->where("company_id",$company_id)
                    ->where("promo_code",$promo_code)
                    ->where("entry_expire",">",$today)
                    ->where("subscribe_status",90)
                    ->where("active_status",1)
                    ->where("used_status",10)
                    ->where("offer_type",85)
                    ->get();
        $update_data = 0;            

        foreach ($data as $key) {
        
        $update_data = DB::table("t_company_promocode_archives")
                        ->where("id",$key->id)
                        ->update([
                            "subscribe_status" => 95,
                            "expire_on" => $now->addMonths($key->description_date),
                            "active_status" =>0,
                            "used_status" => 29,
                            "used_on" => date("Y-m-d h:i:s")
                        ]);            

        }


        return $update_data;



    }


    //Live post_count on dashboard
    public function listed_all_post_web_admin_approved(){
        $live_post_count = DB::table('t_user_post_details')
                        ->where("approved_status",95)
                        ->where("active_state_post",110)
                        ->where("company_id",session('company_id'))
                        ->count();
        return $live_post_count;   
    }

    //wish list_count on dashboard
    public function listed_all_post_web_admin_wishlisted(){
        $wishlist_post_count = DB::table('t_user_account_liked_saved_posts')
                        ->where("user_id",base64_decode(session('user_authentic_id'))-10598152458)
                        ->count();
        return $wishlist_post_count;   
    }


    //load guidance to create post
    public function WebAdminLoadGuidanceToPostDetailse(){
        $guidance = DB::table('t_admin_company_content_update')
                        ->select('content as cont')
                        ->where("title","advertising_policy")
                        ->get();
        return $guidance;                
    }


    //Save primary card
    public function make_primary_selected_card_web_admin($cardNumber){
        $cNumber = $cardNumber-(15.5+0.25*1596-25);
        $u_id = base64_decode(session('user_authentic_id'))-10598152458;
        //select all card related to this user
        $all_cards = DB::table("t_user_company_account_card_details")
                        ->select("card_number_final","id","primary_card")
                        ->where("user_id",$u_id)
                        ->where("company_id",session('company_id') )
                        ->get();

        $already_primary_id = 0;                
        $new_updated_number = 0;
        if(count($all_cards) > 0){                
            foreach ($all_cards as $key => $value) {
                 if($value->primary_card == 195){
                    $already_primary_id = $value->id;
                 }
                 if($value->card_number_final == $cNumber){
                    $new_updated_number = $value->id;
                 }      
            }    
        }

        if($new_updated_number != 0){
            if($new_updated_number != $already_primary_id){
                
                if($already_primary_id != 0){
                
                    $all_cards = DB::table("t_user_company_account_card_details")
                        ->where("id",$already_primary_id)
                        ->where("user_id",$u_id)
                        ->where("company_id",session('company_id') )
                        ->update(
                            [
                                "primary_card" => 0
                            ]
                        );
                }

                $all_cards1 = DB::table("t_user_company_account_card_details")
                        ->where("id",$new_updated_number)
                        ->where("user_id",$u_id)
                        ->where("company_id",session('company_id') )
                        ->update(
                            [
                                "primary_card" => 195
                            ]
                        );                     
            }
        }




    }




    // This random string for create $key for eancryption
    public function generateRandomString($length = 32) {
        $characters = '0123456789abcdeffABCDEF197356428001956458234582151235845658754569582abcdeffbadcde';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    //get all countries
    public function listed_all_countriesy_create_profile(){
        $file_path_listed_countries = public_path()."/common_includes/country/available_countries.json";
        $listed_all_countries = file_get_contents($file_path_listed_countries);
        $data = json_decode($listed_all_countries);
        return $data->country;
    }



    //get geo location user
    public function user_type_get_user_geo_loct($value='')
    {
        $realIP = file_get_contents("https://api.ipify.org");
        $data = geoip()->getLocation($realIP);
       
        $user_session_data_geo_location = [

            "user_iso_code_" => $data["iso_code"],  
            "user_country_name_" => $data["country"],
            "user_local_time_zone_" => $data["timezone"],
            "user_local_currency_type" => $data["currency"],
        
        ];

        session($user_session_data_geo_location);
        
    } 


}
