<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Session;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use File;

class AdminAccountsModel extends Model
{
    // create user user registration aes key
    public function create_aes_encryptiuon_key(){

		$cipher ="AES-256-CBC";
        
        $findKey = $this->generateRandomString();
        $secFirstKey = $this->generateRandomString();
        $var = session(['enc_key' => $findKey,'ivText' => $secFirstKey]);
        $key = session('enc_key');
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
        $ivText = base64_encode($iv);

        $result = [
        	 "enc_key" => $key,
        	 "ivText" => $secFirstKey
        ];

		return  $result; 
    
    } 

        // This random string for create $key for eancryption
    public function generateRandomString($length = 32) {
        $characters = '0123456789abcdeffABCDEF1973564280019564582348923450973240509234ABD582151235845658754569582abcdeffbadcde';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    //Save new category by admin
    public function webuser_category_registration($dataCategory){

        $masterId = $dataCategory[0];    

        $status = [];

        // if($dataCategory[0] != null ){
        //     $receM_Data = explode("|", $dataCategory[0]);
        //     $saveData = [];
        //     for ($i=0; $i < count($receM_Data) ; $i++) { 
        //         $data = [
        //             "ndl_category_name" => strtolower(trim($receM_Data[$i])),
        //             "ndl_created_on" => now(),
        //             "ndl_added_by" =>   1,//Add here the admin id
        //             "ndl_active_flag" => 78,
        //         ];
        //         array_push($saveData, $data);      
        //     }  
        //     $dataMaster = DB::table("m_admin_post_main_category")->insert($saveData);
        //     array_push($status, $dataMaster);
        // }

        if($dataCategory[1] != null ){
           $receS_Data = explode("|", $dataCategory[1]);
            $saveData = [];
            for ($i=0; $i < count($receS_Data) ; $i++) { 
                if(trim($receS_Data[$i]) != ""){ 
                $data = [
                    "ndl_s_mcategory_id" => $masterId ,
                    "ndl_scategory_name" => strtolower(trim($receS_Data[$i])),
                    "ndl_screated_on" => now(),
                    "ndl_sadded_by" =>   1, // add here the admin id
                    "ndl_sactive_flag" => 78,
                ];
                array_push($saveData, $data);
                }      
            }  
            $dataMaster = DB::table("m_admin_post_sub_category")->insert($saveData);    
            array_push($status, $dataMaster);
        }

      //  public function downloadJSONFile(){

      $data = DB::table("m_admin_post_sub_category")
                ->select("ndl_scategory_id as sid","ndl_s_mcategory_id as smid","ndl_scategory_name as sname")
                ->get();
      $file = 'subcategory_category_file.json';
      $destinationPath=public_path()."/category_data/";
      if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
      File::put($destinationPath.$file,json_encode($data));
    //  return response()->download($destinationPath.$file);
    

        return json_encode($status);

    }

    /*
        Register only single main categories
    */
    public function webuser_category_registration_only_single($mainCats){
        
        $data = $mainCats;
        
        //this status for main category save or not
        $status = [];

        if($data != null ){
            $receM_Data = explode("|", $data[0]);
            $saveData = [];
            for ($i=0; $i < count($receM_Data) ; $i++) {
                if(trim($receM_Data[$i]) != null){ 
                $data = [
                    "ndl_category_name" => strtolower(trim($receM_Data[$i])),
                    "ndl_created_on" => now(),
                    "ndl_added_by" =>   1,//Add here the admin id
                    "ndl_active_flag" => 78,
                ];
                array_push($saveData, $data);      
                }
            }  
            $dataMaster = DB::table("m_admin_post_main_category")->insert($saveData);
            array_push($status, $dataMaster);
        }

        $data = DB::table("m_admin_post_main_category")
                ->select("ndl_category_name as mcname","ndl_category_id as mid")
                ->get();
              $file = 'mcategory_category_file.json';
              $destinationPath=public_path()."/category_data/";
              if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
              File::put($destinationPath.$file,json_encode($data));


        return json_encode($status);

    }    


    /*
        Add More Sub category
    */
    public function user_add_more_sub_category($req_data){
        $sub_more_category = explode("|", $req_data["moresub"]);
        $main_cat = $req_data["more"];
        $sub_cat = $req_data["sub"];
        $all_more_sub_categorues = [];
        for ($i=0; $i < count($sub_more_category) ; $i++) { 
            if(!empty($sub_more_category[$i])){
                $data = [
                    "mastercat_id" => $main_cat,
                    "subcat_id" => $sub_cat,
                    "filter_one_text" => $sub_more_category[$i],
                    //"created_by" => session("master_admin_user_id"),   add here mastre admin user id
                    "created_by" => 10,
                    "created_on" => date("Y-m-d")
                ];
                array_push($all_more_sub_categorues, $data);
            }
        }
        $dataMaster = DB::table("m_admin_post_sub_category_filter_more")->insert($all_more_sub_categorues);

        if($dataMaster){

              $data = DB::table("m_admin_post_sub_category_filter_more")
                            ->select("mastercat_id as mcid","subcat_id as smcid","filter_one_text as sfmname","filter_sub_id as fid")
                            ->get();
              $file = 'subcategoryfilter1_category_file.json';
              $destinationPath=public_path()."/category_data/";
              if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
              File::put($destinationPath.$file,json_encode($data));


            return json_encode([
                 "status" => 203,
                 "message" => "Updated success"   
            ]);
        }else{
            return json_encode([
                 "status" => 403,
                 "message" => "Updated failur"   
            ]);
        }
    }     


    public function bulkApprovalPostMake($postIds){
        
        $post_info = DB::table("t_user_post_details")
                    ->select("post_id","approved_status","active_state_post","company_id")
                    ->whereIn("post_id",$postIds)
                    ->get();

        $count = 0;
        $effected = 0;            
        foreach ($post_info as $key => $value) {
            $count++;
            //check approved_status
            if($value->approved_status == 0){
                //check active-state_post
                if($value->active_state_post == 29){
                    $effected++;

                    //table update with post approved  [ "approved_status" ]
                    $approved =  95 ; 
                    //table update with post live
                    $postlive = 110;

                    $admin_id = base64_decode(session("ac_user_id"))-(+52-0.589-1524);
                    $comp_id = $value->company_id;

                    $update_data = [
                        "approved_status" => $approved,  
                        "active_state_post" => $postlive,
                        "post_approved_at" => gmdate("Y-m-d h:i:s"),
                        "post_approved_by" => $admin_id 
                    ];

                    //Make post approval
                    $post_table_update = DB::table("t_user_post_details")
                                            ->where("post_id",$value->post_id)
                                            ->update($update_data);


                    //make count increase post
                    $data_insert = DB::table("t_user_post_upload_count_of_company")
                            ->updateOrInsert(
                                ["company_id" => $comp_id],
                                [
                                    "auth_user_id" => 0,
                                    "post_count_published" => DB::raw("post_count_published + 1")
                                ]
                            );                        

                }
            } 


        }            
                    
        $dataReturn  =  [
            "returnRows" => $count."|".$effected
        ];

        return json_encode($dataReturn);


    }


    //Bulk reject advertiesment
    public function bulkReject_KlPostMake($postIds){
        $post_info = DB::table("t_user_post_details")
                    ->select("post_id","approved_status","active_state_post","company_id")
                    ->whereIn("post_id",$postIds)
                    ->get();

        $count = 0;
        $effected = 0; 


        foreach ($post_info as $key => $postdata) {
            
            $count++;
            $comp_id = $postdata->company_id;
            //if approved post
            if($postdata->approved_status == 95 && $postdata->active_state_post > 50 ){
                $effected++;
                // var_dump("Approved");
                //update post info table
                    $admin_id = base64_decode(session("ac_user_id"))-(+52-0.589-1524);
                    $comp_id = $postdata->company_id;

                    $update_data = [
                        "approved_status" => 8,  
                        "active_state_post" => 50,
                        "post_approved_at" => gmdate("Y-m-d h:i:s"),
                        "post_approved_by" => $admin_id 
                    ];

                    $post_table_update = DB::table("t_user_post_details")
                                            ->where("post_id",$postdata->post_id)
                                            ->update($update_data);



                //update count table
                $data_insert = DB::table("t_user_post_upload_count_of_company")
                            ->updateOrInsert(
                                ["company_id" => $comp_id],
                                [
                                    "auth_user_id" => 0,
                                    "post_count_published" => DB::raw("post_count_published - 1")
                                ]
                            );                            
            }

            //if pending post
            if($postdata->approved_status == 0 && $postdata->active_state_post == 29 ){
                $effected++;
                // var_dump("Pending");
                //update post info table
                    $admin_id = base64_decode(session("ac_user_id"))-(+52-0.589-1524);
                    $comp_id = $postdata->company_id;

                    $update_data = [
                        "approved_status" => 8,  
                        "active_state_post" => 50,
                        "post_approved_at" => gmdate("Y-m-d h:i:s"),
                        "post_approved_by" => $admin_id 
                    ];

                    $post_table_update = DB::table("t_user_post_details")
                                            ->where("post_id",$postdata->post_id)
                                            ->update($update_data);

                            
            }


        }


        $dataReturn  =  [
            "returnRows" => $count."|".$effected
        ];

        return json_encode($dataReturn);


    }





    /*
        Select all master ctegories from database
    */
    public function List_all_master_categories(){
        $data = DB::table("m_admin_post_main_category")
                ->select("ndl_category_name","ndl_category_id")
                ->where("ndl_active_flag",78)
                ->orderby('ndl_category_name', 'ASC')
                ->get();    
        
        return json_encode($data);        
    }    


    //Load all categories to master category page
    public function List_all_master_categories_master_controllerPage(){
        $Mdata = DB::table("m_admin_post_main_category")
                ->select("ndl_category_name as mname","ndl_category_id as mid")
                ->orderby('ndl_category_id', 'ASC')
                ->get();
        $Sdata = DB::table("m_admin_post_sub_category")
                ->select("ndl_scategory_id as sid","ndl_s_mcategory_id as mid","ndl_scategory_name as sname")
                ->orderby('ndl_scategory_id', 'ASC')
                ->orderby('ndl_s_mcategory_id', 'ASC')
                ->get();
        $Cdata = DB::table("m_admin_post_sub_category_filter_more")
                ->select("filter_sub_id as cid","mastercat_id  as mid","subcat_id as sid","filter_one_text as cname")
                ->orderby('filter_sub_id', 'ASC')
                ->orderby('mastercat_id', 'ASC')
                ->orderby('subcat_id', 'ASC')
                ->get();
        $groupCountData = DB::table("m_admin_post_sub_category_filter_more")
                ->select("subcat_id as sid",DB::raw('count("subcat_id") as total'))
                ->groupBy('subcat_id')
                ->get();         


        // dd($groupCountData);
        // exit();        

        // $data = [];        

        // foreach ($Mdata as $key1 => $value1) {
        //     array_push($data, [$value1->mid => $value1->mname]);
        // }

        
       $data = [
        $Mdata,$Sdata,$Cdata,$groupCountData
       ];         
        
        return json_encode($data); 
    } 



    /*
        Admin load all category
    */    
    public function List_all_categories_to_admin(){
        // $data = DB::table("m_admin_post_sub_category")
        //         ->select("m_admin_post_main_category.ndl_category_name as m_c_name",
        //                  "m_admin_post_sub_category.ndl_scategory_name as m_s_c_name",
        //                  "m_admin_post_sub_category_filter_more.filter_one_text as m_s_c_com_name",
        //                  "m_admin_post_main_category.ndl_category_id as m_c_id",
        //                  "m_admin_post_sub_category.ndl_scategory_id as m_s_c_id",
        //                  "m_admin_post_sub_category_filter_more.filter_sub_id as m_s_c_com_id"
        //                 )
        //         ->join('m_admin_post_main_category','m_admin_post_main_category.ndl_category_id', '=', 'm_admin_post_sub_category.ndl_s_mcategory_id')
        //         ->join('m_admin_post_sub_category_filter_more','m_admin_post_sub_category_filter_more.mastercat_id','=','m_admin_post_sub_category.ndl_scategory_id')
        //         ->where("m_admin_post_sub_category.ndl_sactive_flag",78)
        //         ->orderBy("m_admin_post_main_category.ndl_category_id","ASC")
        //         ->get();    
        
        // return json_encode($data); 
        $Mdata = DB::table("m_admin_post_main_category")
                ->select("ndl_category_name as mname","ndl_category_id as mid")
                ->orderBy('ndl_category_id', 'ASC')
                ->get();
        $Sdata = DB::table("m_admin_post_sub_category")
                ->select("ndl_scategory_id as sid","ndl_s_mcategory_id as mid","ndl_scategory_name as sname")
                ->orderBy('ndl_scategory_id', 'ASC')
                ->orderBy('ndl_s_mcategory_id', 'ASC')
                ->get();
        $Cdata = DB::table("m_admin_post_sub_category_filter_more")
                ->select("filter_sub_id as cid","mastercat_id  as mid","subcat_id as sid","filter_one_text as cname")
                ->orderBy('filter_sub_id', 'ASC')
                ->orderBy('mastercat_id', 'ASC')
                ->orderBy('subcat_id', 'ASC')
                ->get();

       $data = [
        $Mdata,$Sdata,$Cdata
       ];         
        
        return json_encode($data); 
    }    


    //about us content change
    public function update_web_content_abt_us($req_about_us){
        
        $data = DB::table('t_admin_company_content_update')
                    ->updateOrInsert(
                        ['title' => 'about_us'],
                        ['content' => $req_about_us, 'updated_by' => 109, "create_at" => date("Y-m-d")]
                        
                    );
               
        if($data){
            return $results = [
                "status" => 222
            ];
        }else{
            return $results = [
                "status" => 450
            ];
        }            
    }


    //Dashboard data load
    public function Load_summery_of_all_info(){
        $summ_advertisers = DB::table('t_user_account_profile_data')
                                ->select('profile_id')
                                ->get()
                                ->count();
        $summ_advertiseall = DB::table('t_user_post_details')
                                ->select('post_id')
                                ->where('approved_status',95)
                                ->where('active_state_post',110) 
                                ->get()
                                ->count();
        $pending_advertiesments =  DB::table('t_user_post_details')
                                ->select('post_id')
                                ->where('approved_status',0)
                                ->where('active_state_post',29) 
                                ->get()
                                ->count();    


        $promo_code_detailse = DB::table("t_company_promocode_archives")
                                ->select('promo_code as dash_pcode','promcode_type as dash_pcodetype','created_on as dash_cpreaded')    
                                ->orderBy('id','desc')
                                ->limit(10)
                                ->get(); 


        $new_users_registered = DB::table("t_user_account_profile_data")
                                ->select("t_user_account_profile_data.account_type as dash_acc_type","t_user_account_profile_data.created_on as dash_created_on","m_admin_iso_code_country.country as dash_chosed_country","t_user_account_profile_data.company_email as dash_compnymail")
                                ->join("m_admin_iso_code_country","m_admin_iso_code_country.iso_code","=","t_user_account_profile_data.geo_base")
                                ->orderby('profile_id',"desc")
                                ->limit(10)
                                ->get();                                    

        
        $load_all_currency = [];                        
        $get_all_currency_rates = file_get_contents('./common_includes/country/currency_update.json');
        $currency_information_update_1 = json_decode($get_all_currency_rates,true);
        array_push($load_all_currency,$currency_information_update_1["rates"]["USD"]);
        array_push($load_all_currency,$currency_information_update_1["rates"]["LKR"]);
        array_push($load_all_currency,$currency_information_update_1["rates"]["INR"]);
        array_push($load_all_currency,$currency_information_update_1["rates"]["JEP"]);
        array_push($load_all_currency,$currency_information_update_1["rates"]["IQD"]);
        array_push($load_all_currency,$currency_information_update_1["rates"]["IMP"]);
        array_push($load_all_currency,$currency_information_update_1["rates"]["PKR"]);
        array_push($load_all_currency,$currency_information_update_1["rates"]["PGK"]);
        array_push($load_all_currency,$currency_information_update_1["rates"]["ZMW"]);
        array_push($load_all_currency,$currency_information_update_1["rates"]["XPF"]);



        // $mosted_used_category = DB::table("t_user_post_details")
        //                            ->select(
        //                             "post_main_category",DB::raw('count(post_main_category) as total'),
        //                             "post_sub_category",DB::raw('count(post_sub_category) as total2')
        //                             )
                                   
        //                            ->groupBy("post_main_category")
        //                            ->groupBy("post_sub_category")
        //                            ->get() ;

        // var_dump($mosted_used_category);
        // exit();                           


        $all_coount = [
                $summ_advertisers,
                $summ_advertiseall,
                $pending_advertiesments,
                $promo_code_detailse,
                $new_users_registered,
                $load_all_currency
            ];                                               
        return $all_coount;
    }




    public function update_web_content_privacy_content_update($content,$id){
        $i_d = base64_decode($id);
        $data = DB::table('t_admin_company_content_update')
                    ->updateOrInsert(
                        ['title' => "privacy_content"],
                        ['content' => $content, 'updated_by' => 109, "create_at" => date("Y-m-d")]
                        
                    );
               
        if($data){
            return $results = [
                "status" => 222
            ];
        }else{
            return $results = [
                "status" => 450
            ];
        }    
    }

    //advertisers gudance to how to make a post
    public function update_web_content_advertisers_guidance_update($contents,$id){
        $i_d = base64_decode($id);
        $data = DB::table('t_admin_company_content_update')
                    ->updateOrInsert(
                        ['title' => $i_d],
                        ['content' => $contents, 'updated_by' => 109, "create_at" => date("Y-m-d")]
                        
                    );
               
        if($data){
            return $results = [
                "status" => 222
            ];
        }else{
            return $results = [
                "status" => 450
            ];
        }
    }



    //master admin make logged in
    public function makeAdminTologgedInAdnPnl($email,$password){
        
        $email = $email;
        $password = $password;

         $data_login_found = DB::table('m_admin_account_holder')
            ->select('password','id','first_name','last_name','account_active_status','account_type','active_flag')
            ->where('email',$email)
            ->get();
         if(count($data_login_found) == 1){
            foreach ($data_login_found as $key) {
                  if(Hash::check($password , $key->password)){
                    //session(["user_permission_token"=>$key->id]);
                    if($key->account_active_status == 1 && $key->account_type == 119 && $key->active_flag == 68 ){
                        $loagin_status = [
                            "status" => 200,
                            "message" => "You have successfully logged in"
                        ];
                        $update_session = $this->update_session_data(1,119,68,$key->id,$key->first_name,$key->last_name,null,null);
                    }
                  }else{
                    $loagin_status = [
                            "status" => 404,
                            "message" => "You have failed in logged in"
                    ];
                  }      
            }   
         }else{
            $loagin_status = [
                "status" => 500,
                "message" => "please enter valid email id"
            ];
         }   
         return $loagin_status;

    }

    //Admin listed all posts
    public function Load_listed_all_posts(){
        $data = DB::table("t_user_post_details")
                    ->select("t_user_post_details.post_id as pid","t_user_post_details.post_title as ptitle","t_user_post_details.post_create_at as pcreated","t_user_post_details.location_base_price as plocation","t_user_post_details.approved_status as papproved","t_user_post_details.company_id as pacompanyid","t_user_post_details.active_state_post as plive","t_user_post_details.display_image_path as imagelive",
                        "t_user_account_profile_data.company_name as pcompany",
                        "m_admin_iso_code_country.country as pcountry")
                    ->join("t_user_account_profile_data","t_user_account_profile_data.company_id","=","t_user_post_details.company_id")
                    ->join("m_admin_iso_code_country","m_admin_iso_code_country.iso_code","=","t_user_post_details.location_base_from")
                    ->get();
              

        return $data;            

    }


    //View the single post
    public function getPostsInfoViewAdmin($post_is){
        
        $posts_data = DB::table("t_user_post_details")
                        ->select("t_user_post_details.post_id as pid","t_user_post_details.post_title as ptitle","t_user_post_details.location_base_price as plocationprice","t_user_post_details.product_conditions as pcondition","t_user_post_details.post_content as pcontent","t_user_post_details.post_visit_link as pvisitlink","t_user_post_details.amount_price as pprice","t_user_post_details.post_is_promotion as pispromotion","t_user_post_details.post_promotion_price as promotionprice","t_user_post_details.post_expire_on as pexpire","t_user_post_details.more_image_uploaded as pimages","m_admin_post_main_category.ndl_category_name as pmcategory","t_user_post_details.approved_status as papprooved","t_user_post_details.active_state_post as pactivestate","t_user_post_details.post_display_wordwide as pdisplaytype","t_user_account_profile_data.company_name as pcompanyname","t_user_account_profile_data.company_id as pcid","m_admin_post_sub_category.ndl_scategory_name as psubcategory")
                        ->join("t_user_account_profile_data","t_user_account_profile_data.company_id","=","t_user_post_details.company_id")
                        ->join("m_admin_post_main_category","m_admin_post_main_category.ndl_category_id","=","t_user_post_details.post_main_category")
                        ->join("m_admin_post_sub_category","m_admin_post_sub_category.ndl_scategory_id","=","t_user_post_details.post_sub_category")
                        ->where("t_user_post_details.post_id",$post_is)
                        ->get();
    
        return $posts_data;

    }


    //List all country currencies
    public function list_all_countries_110(){
        $countries = DB::table('m_admin_currency_code_country')
                        ->select('country_code as ccode','country as cname')
                        ->whereNotNull('country_code') 
                        ->get();

        return $countries;                   
    }


    //view all not confirmed posts
    public function Load_listed_all_posts_which_not_confirm(){
        $data = DB::table("t_user_post_details")
                    ->select("t_user_post_details.post_id as pid","t_user_post_details.post_title as ptitle","t_user_post_details.post_create_at as pcreated","t_user_post_details.location_base_price as plocation","t_user_post_details.approved_status as papproved","t_user_post_details.active_state_post as plive","t_user_post_details.display_image_path as imagelive",
                        "t_user_account_profile_data.company_name as pcompany",
                        "m_admin_iso_code_country.country as pcountry")
                    ->join("t_user_account_profile_data","t_user_account_profile_data.company_id","=","t_user_post_details.company_id")
                    ->join("m_admin_iso_code_country","m_admin_iso_code_country.iso_code","=","t_user_post_details.location_base_from")
                    ->where("t_user_post_details.approved_status",0)
                    ->where("t_user_post_details.active_state_post",29)
                    ->get();

        return $data;               
    }



    //Make post approval
    public function AdminMakePostsApproval($post_is,$operation,$company_id){
        
        //Operation 10 is make approval and 11 is rejected
        $post_operation = $operation;
        
        //Same function used in pending_post_approval_delete and list_all_post_delete button
        if($company_id != "check"){
        //Company id
            $companyid = (base64_decode($company_id)-0.25)*2/5; 
        }
        
        //table update with post approved  [ "approved_status" ]
        $approved = ($post_operation == 10 ) ? 95 : 8 ; 
        //table update with post live
        $postlive = ($approved > 90 ) ? 110 : 50;

        $post_id = base64_decode($post_is)/5*2;
        $admin_id = base64_decode(session("ac_user_id"))-(+52-0.589-1524);

        $update_data = [
            "approved_status" => $approved,  
            "active_state_post" => $postlive,
            "post_approved_at" => gmdate("Y-m-d h:i:s"),
            "post_approved_by" => $admin_id 
        ];

        $post_table_update = DB::table("t_user_post_details")
                                ->where("post_id",$post_id)
                                ->update($update_data);

        //if this post is approved insert to company post count table. update the live post count
        if($post_operation == 10 && $company_id != "check"){

            $data_insert = DB::table("t_user_post_upload_count_of_company")
                            ->updateOrInsert(
                                ["company_id" => $companyid],
                                [
                                    "company_id" => $companyid,
                                    "auth_user_id" => 0,
                                    "post_count_published" => DB::raw("post_count_published + 1")
                                ]
                            );


        }                                

        return $post_table_update;

    }


    //view all advertisers to admin
    public function Load_listed_all_advertisers_toadmin(){
        $data_advertisers = DB::table("t_user_account_profile_data")
                               ->select("t_user_account_profile_data.company_name as adcompanyname","t_user_account_profile_data.profile_id as adcompanyid","t_user_account_profile_data.my_real_domain as adrealdomain","t_user_account_profile_data.contact_number as adcontact","t_user_account_profile_data.company_email as adcompanyemail","t_user_account_profile_data.user_active_state as adactive",
                                   "m_admin_iso_code_country.country as adcountry"
                                )
                               ->join("m_admin_iso_code_country","m_admin_iso_code_country.iso_code","=","t_user_account_profile_data.geo_base")
                               ->where('t_user_account_profile_data.account_type',114)
                               ->get();

        return $data_advertisers;                        
    }


    //load only name and id from profile table to promocode generate screen [ only companies ]
    public function Get_companies_name_id_promocodeScreen(){
        $data_advertisers = DB::table("t_user_account_profile_data")
                               ->select("company_name as adcompanyname","company_id as company")
                               ->where('account_type',114)
                               ->get();

        return $data_advertisers;   
    }


    //view all normal users to admin
    public function Load_listed_all_normalusers_toadmin(){
        $data_normal_users = DB::table("t_user_account_profile_data")
                               ->select("t_user_account_profile_data.profile_id as adcompanyid","t_user_account_profile_data.contact_number as adcontact","t_user_account_profile_data.company_email as adcompanyemail","t_user_account_profile_data.user_active_state as adactive",
                                   "t_user_account_profile_data.satedisct as statte",
                                   "t_user_account_profile_data.city as norcirty", 
                                   "m_admin_iso_code_country.country as adcountry"
                                )
                               ->join("m_admin_iso_code_country","m_admin_iso_code_country.iso_code","=","t_user_account_profile_data.geo_base")
                               ->where('t_user_account_profile_data.account_type',96)
                               ->get();

        return $data_normal_users;    
    }


    //update_session
    public function update_session_data($account_active_status,$account_type,$active_flag,$auth_user_id,$first_name,$last_name,$m0,$m1){

        $ac_active_status = $account_active_status; 
        $ac_acc_type = $account_type;
        $ac_active_flag = $active_flag;
        $ac_user_id = $auth_user_id;
        $first_name = $first_name;
        $last_name = $last_name;
        $m0 = $m0;
        $m1 = $m1;
        //+(105820-1022+(150240-59)+0.26584)
        //*105-20/2*5+0.2+98
        $data = [
            "ac_active_status" => $ac_active_status,
            "ac_acc_type" => base64_encode($ac_acc_type+(15200-854+0.254)), // decode +(-15200-0.254+854)
            "active_flag" => $ac_active_flag,
            "ac_user_id" => base64_encode($ac_user_id+(1524-52+0.589)),
            "first_name" => $first_name,
            "last_name" => $last_name,
            "m0" => $m0,
            "m1" => $m1
        ]; 

        session($data);

    }


    //save new promo codes
    public function save_new_user_promocodes_updated($codeData){
  
        $date = Carbon::create(2012, 1, 31, 0);    
        $company_all_ids = [];
        $promo_all_detailse = [];
        

        $social_marketing = $codeData['social']; 
        $all_companies = $codeData['company'];
        $promo = $codeData['promocode'];
        $offer = $codeData['offertype'];
        $description = $codeData['description'];
        $expire = $codeData['lastdate'];
        
        //if social promo code
        if($social_marketing === "social"){
            // var_dump("expression");
            // exit();
        $promo_all_detailse = [
                "promcode_type" => 185 ,
                "promo_code"=> strtoupper($promo),
                "company_id"=> 0,
                "offer_type"=> ($offer == 11) ? 85 : 106,
                "description_percentage"=>($offer == 12) ? $description : 0,
                "description_date"=>($offer == 11) ? $description : 0,
                "used_status"=>10,
                "active_status"=>1,
                "subscribe_status"=>90,
                "created_on"=> date('Y-m-d h:i:s'),
                "entry_expire" => $expire
        ];    


        //insert the promotions
        $insert_promotions = DB::table('t_company_promocode_archives')
                                ->insert($promo_all_detailse);


         return   $insert_promotions;                     




        }elseif(count($all_companies) > 0){


        foreach ($all_companies as $key => $value) {
            
            $company_counting = $value+15849-1058885489;
            

            //description date will change after company subscribe the promotion. For now its display only how many months its valid.

            $data = [
                "promcode_type" => 114 ,
                "promo_code"=> strtoupper($promo),
                "company_id"=>$company_counting,
                "offer_type"=> ($offer == 11) ? 85 : 106,
                "description_percentage"=>($offer == 12) ? $description : 0,
                "description_date"=>($offer == 11) ? $description : 0,
                "used_status"=>10,
                "active_status"=>1,
                "subscribe_status"=>90,
                "created_on"=> date('Y-m-d h:i:s'),
                "entry_expire" => $expire
            ];

            array_push($company_all_ids, $company_counting);
            array_push($promo_all_detailse, $data);
        
        }


        //insert the promotions
        $insert_promotions = DB::table('t_company_promocode_archives')
                                ->insert($promo_all_detailse);  



        if($insert_promotions){
            $all_comapny_email = DB::table("t_user_account_profile_data")
                                    ->select("company_email")
                                    ->whereIn("company_id",$company_all_ids)
                                    ->get();
        }                          

        $data_process = [
            "all_companies" => $all_comapny_email,
            "offer_type" => ($offer == 11) ? 85 : 106
        ];

        return $data_process;


        }

    }



    //View data profile info to admin
    public function Load_profile_info_on_to_see_admin($ckid,$valid,$txtid,$proid){
        if($txtid == "view_info" && $ckid > 14 && $ckid < 101 && $valid > 9998 && $valid < 100001  ){
        $profile_data = DB::table("t_user_account_profile_data")
                    ->select(
                        "t_user_account_profile_data.company_name as pdcomname","t_user_account_profile_data.account_type as pdacctype",
                        "t_user_account_profile_data.my_real_domain as pdrealDomain","t_user_account_profile_data.contact_number as pdcontdeta",
                        "t_user_account_profile_data.company_email as pdcomemail","t_user_account_profile_data.company_address as pdcompanyadd",
                        "m_admin_iso_code_country.country as pdimwhere","t_user_account_profile_data.satedisct as pdstate","t_user_account_profile_data.city as pdcity",
                        "t_user_account_profile_data.company_logo_upload as pdlogo",                                   "t_user_account_profile_data.user_active_state as pdactive",
                        "t_users_account_holder.first_name as pdfirstnm","t_users_account_holder.last_name as pdlastnm"
                    )
                    ->join("t_users_account_holder","t_users_account_holder.id","=","t_user_account_profile_data.user_auth_id")
                    ->join("m_admin_iso_code_country","m_admin_iso_code_country.iso_code","=","t_user_account_profile_data.geo_base")
                    ->where("t_user_account_profile_data.profile_id",$proid)
                    ->get();

         
        $listed_of_list = [];

        array_push($listed_of_list, $profile_data);
        
        return $listed_of_list;

        }else{
            return "Error";
        }            


    }



    //Load the the single promo state
    public function make_load_all_single_promo_state(){


        $topListedAllPromocodes = [];

        $data_companies = DB::table("t_company_promocode_archives")
                    ->select("t_company_promocode_archives.id as posted_promo_id","t_company_promocode_archives.promo_code as prpromocode","t_company_promocode_archives.offer_type as proffertype","t_company_promocode_archives.description_percentage as prprecentage","t_company_promocode_archives.description_date as prpromodate","t_company_promocode_archives.used_status as prused","t_company_promocode_archives.used_on as prusedon","t_company_promocode_archives.active_status as practived","t_user_account_profile_data.company_name as prcname")
                    ->join("t_user_account_profile_data","t_user_account_profile_data.company_id","=","t_company_promocode_archives.company_id")
                    ->get();


        $social_marketings =  DB::table("t_company_promocode_archives")
                    ->select("id as pro_id","promo_code as pro_codes","social_used_count as pro_usedsocialcount","offer_type as pro_offertype","description_percentage as pro_precent","description_date as pro_datemonths","entry_expire as pro_enty_exp")
                    ->where("promcode_type",185)
                    ->get();             
                        
    

        array_push($topListedAllPromocodes, $data_companies);
        array_push($topListedAllPromocodes, $social_marketings);            

        return $topListedAllPromocodes;            

    }



    //make user master logout
    public function make_master_logout_from_system(){
        
        $admin_id = base64_decode(session("ac_user_id"))-(+52-0.589-1524);
        if($admin_id == base64_decode(session("ac_user_id"))-(+52-0.589-1524)){
            Session::flush();
            return true;
        }
    }




    //Remove selected promocode
    public function remove_this_promocode_promo_fom_list($check1,$delete,$promocode){

        $check_code = $check1;
        
        //official_delete
        if($check_code > 49 && $check_code < 61 && $delete){
            
            $pro_code_id = $promocode-(200.285+0.951);
            $status = DB::table("t_company_promocode_archives")
                        ->where("id",$pro_code_id)
                        ->delete();
            if($status){
                Session::flash('delete_promocode_official', 200);
            }else{
                Session::flash('delete_promocode_official', 202);
            }            
                         
            return $status;                
        }

        //Social delete
        if($check_code > 149 && $check_code < 161 && $delete){
            
            $pro_code_id = $promocode-(385.764+0.254);
            $status = DB::table("t_company_promocode_archives")
                        ->where("id",$pro_code_id)
                        ->delete();
            
            if($status){
                Session::flash('delete_promocode_social', 200);
            }else{
                Session::flash('delete_promocode_social', 202);
            }            

            return $status;
        }


    }


    public function local_load_all_web_content_of_company(){
        $data = DB::table("t_admin_company_content_update")
                ->select("title as titile_of_content", "content as web_content")
                ->get();    
        
        $array_of_data =  [];
        for ($i=0; $i < count($data) ; $i++) { 
            if($data[$i]->titile_of_content === "about_us"){
                $content = [
                    "key" => 1,
                    "value" => $data[$i]->web_content 
                ];
                array_push($array_of_data, $content);
            }elseif ($data[$i]->titile_of_content === "privacy_content") {
                $content = [
                    "key" => 2,
                    "value" => $data[$i]->web_content 
                ];
                array_push($array_of_data, $content);
            }elseif ($data[$i]->titile_of_content === "advertising_policy") {
                $content = [
                    "key" => 3,
                    "value" => $data[$i]->web_content 
                ];
                array_push($array_of_data, $content);
            }            
        }        

        return $array_of_data; 
    }




    public function makeAdminToUpdateCategory($cid,$cname,$op_type){
    
        $changingId = $cid;
        $cahngingName = $cname;
        $changingOperation = $op_type;
        $admin_id = base64_decode(session("ac_user_id"))-(+52-0.589-1524);

        //edit master category
        if($changingOperation == 1){

            $update_this_category = DB::table("m_admin_post_main_category")
                                    ->where("ndl_category_id",$changingId)
                                    ->update(
                                        [ 
                                            "ndl_category_name" => $cahngingName, 
                                            "ndl_updated_on" => date("Y-m-d h:i:s"),
                                            "ndl_updated_by" => $admin_id
                                        ]
                                        
                                    );

            if($update_this_category){
                return true;
            }else{
                return false;
            }    


        }            


        //master category remove
        if($changingOperation == 2){
            //check the master_id in post_table
            $check = DB::table("t_user_post_details")
                    ->where("post_main_category",$changingId)
                    ->count("post_main_category");
        
            if($check == 0){
                $update_this_category = DB::table("m_admin_post_main_category")
                                    ->where("ndl_category_id",$changingId)
                                    ->update(
                                        [ 
                                            "ndl_active_flag" => 95, 
                                            "ndl_updated_on" => date("Y-m-d h:i:s"),
                                            "ndl_updated_by" => $admin_id
                                        ]
                                        
                                    );
                
                $remove_sub_category_related_to_master = DB::table("m_admin_post_sub_category")
                                                        ->where("ndl_s_mcategory_id",$changingId)
                                                        ->update([
                                                           "ndl_supdated_on" =>  date("Y-m-d h:i:s"),
                                                           "ndl_supdated_by" => $admin_id,
                                                           "ndl_sactive_flag" => 95   
                                                        ]);
                
                $remove_complementory_category_related_to_master = DB::table("m_admin_post_sub_category_filter_more")
                                                        ->where("mastercat_id",$changingId)
                                                        ->delete();

                return true;                                                                                                    
            }else{
                return false;
            }        


        }

    }



    //update sub category
    public function makeAdminToUpdateSub_Category($cid,$cname,$op_type){
    
        $changingId = $cid;
        $cahngingName = $cname;
        $changingOperation = $op_type;
        $admin_id = base64_decode(session("ac_user_id"))-(+52-0.589-1524);

        //edit master category
        if($changingOperation == 1){

            $update_this_category = DB::table("m_admin_post_sub_category")
                                    ->where("ndl_scategory_id",$changingId)
                                    ->update(
                                        [ 
                                            "ndl_scategory_name" => $cahngingName, 
                                            "ndl_supdated_on" => date("Y-m-d h:i:s"),
                                            "ndl_supdated_by" => $admin_id
                                        ]
                                        
                                    );

            if($update_this_category){
                return true;
            }else{
                return false;
            }    


        }            


        //master category remove
        if($changingOperation == 2){
            //check the master_id in post_table
            $check = DB::table("t_user_post_details")
                    ->where("post_sub_category",$changingId)
                    ->count("post_sub_category");
        
            if($check == 0){

                $update_this_category = DB::table("m_admin_post_sub_category")
                                    ->where("ndl_scategory_id",$changingId)
                                    ->update(
                                        [ 
                                            "ndl_active_flag" => 95, 
                                            "ndl_updated_on" => date("Y-m-d h:i:s"),
                                            "ndl_updated_by" => $admin_id
                                        ]
                                        
                                    );
                
                
                $remove_complementory_category_related_to_master = DB::table("m_admin_post_sub_category_filter_more")
                                                        ->where("subcat_id",$changingId)
                                                        ->delete();

                return true;                                                                                                    
            }else{
                return false;
            }        


        }

    }


    //update complementory category
    public function makeAdminToUpdateSubComplementory_Category($cid,$cname,$op_type){
    
        $changingId = $cid;
        $cahngingName = $cname;
        $changingOperation = $op_type;
        $admin_id = base64_decode(session("ac_user_id"))-(+52-0.589-1524);

        //edit master category
        if($changingOperation == 1){

            $update_this_category = DB::table("m_admin_post_sub_category_filter_more")
                                    ->where("filter_sub_id",$changingId)
                                    ->update(
                                        [ 
                                            "filter_one_text" => $cahngingName
                                        ]
                                    );

            if($update_this_category){
                return true;
            }else{
                return false;
            }    


        }            


        //master category remove
        if($changingOperation == 2){
            //check the master_id in post_table
            $check = DB::table("t_user_post_details")
                    ->where("post_sub_category",$changingId)
                    ->count("post_sub_category");
        
            if($check == 0){
        
                $remove_complementory_category_related_to_master = DB::table("m_admin_post_sub_category_filter_more")
                                                        ->where("filter_sub_id",$changingId)
                                                        ->delete();

                return true;                                                                                                    
            }else{
                return false;
            }        


        }

    }


}
