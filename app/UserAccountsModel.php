<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Collection;

use Session;

use DB;

class UserAccountsModel extends Model
{
    // create user user registration aes key
    public function create_aes_encryptiuon_key(){
  //   	$str = 200;
  //   	//$str = rand(50000,100000)*8/2; 
		// $whats_my_key = $str;
		// //$result = hash("sha256",$whats_my_key);
		// //$result = base64_encode($whats_my_key);
		

		$cipher ="AES-256-CBC";
        //$key = 'd41d8cd98f00b204e9800998ecf8427e';'adkfg87635984135sdgfjdsahjrgqqee';
        $findKey = $this->generateRandomString();
        $var = session(['enc_key' => $findKey]);
        $key = session('enc_key');
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
        $ivText = base64_encode($iv);

        $result = [
        	"encryption_key" => $key,
        	"ivText" => $ivText
        ];

		return  json_encode($result); 
    
    } 



    //user register
    public function user_registration($data){
        //var_dump("MODEL");
        //$r = iconv(mb_detect_encoding($data[0]), "UTF-8", $data[0]);
        //$d= Crypt::encrypt($data[0]);
       // $f= iconv("ASCII","UTF-8", Crypt::decrypt($d));

        //var_dump(mb_detect_encoding($r));

        $email_id_exist = DB::table('t_users_account_holder')
                            ->select('email')
                            ->where('email',$data[2])
                            ->count();

         $added_new_user;                   
                            
        if($email_id_exist < 1){                    
       
        $security_code = rand(99999999,10000000000000000);
        $remember_token = bin2hex(openssl_random_pseudo_bytes(12));     
        
        $user_data_saved = DB::table('t_users_account_holder')->insert([
    		"first_name" =>$data[0],
    		"last_name" => $data[1],
    		"email" => $data[2],
    		"password" => bcrypt($data[3]),
     		"account_type" => 18, // as default 18 is normal user
            "security_code"=>$security_code,
    		"account_active_status" => 0,
    		//"remember_token" => random_bytes(99),
            "remember_token" => $remember_token,
    		"created_time" => date('Y-m-d h:i:s'),
    		"updated_time" => date('Y-m-d h:i:s'),
    		"updated_by" => 0,
    		"approved_by" => 0, 
    		"active_flag" => 55
    	]);
            $added_new_user = array(
                "status" => 200,
                "message" => "User registered successfully",
                "message_account_confirm" => array(
                    "active_token" => base64_encode($security_code+1598278154965),
                    "remember_token" => base64_encode($remember_token)
                )
            );
        }elseif($email_id_exist == 1){
            $added_new_user = array(
                "status" => 320,
                "message" => "User already exist" 
            );
        }
        
        //$returnHTML = view('job.userjobs')->with('userjobs', $userjobs)->render();
        //return response()->json($added_new_user);

    	return $added_new_user;
    }


    public function user_make_login_to_site($login_data){
         $loagin_status;
         $email = $login_data["email"];
         $password = $login_data["password"];//$login_data[1]
         //var_dump($email, $login_data[1]);
         $data_login_found = DB::table('t_users_account_holder')
            ->select('password','id','first_name','last_name','account_active_status','active_flag')
            ->where('email',$email)
            ->get();
         if(count($data_login_found) == 1){
            foreach ($data_login_found as $key) {
                  if(Hash::check($password , $key->password)){
                    //session(["user_permission_token"=>$key->id]);
                    if($key->account_active_status == 15 && $key->active_flag == 68 ){
                    $loagin_status = [
                        "status" => 200,
                        "message" => "You have successfully logged in"
                    ];

                    //update_session_with_user_data. this is to use if the user is new then cannot get company details. So check
                    $add_data_to_session = $this->check_user_new_or_older($key->id,$key->first_name,$key->last_name);
                    }else{
                      $loagin_status = [
                            "status" => 404,
                            "message" => "Account not activated"
                    ];      
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



    //Forgot password : check email is available
    public function user_check_email_available_site($data){
        
        $data_email_available_status = DB::table('t_users_account_holder')
                                        ->select("security_code","remember_token")
                                        ->where('email',$data[0])
                                        ->get();    
        if(count($data_email_available_status) == 1){
            $reset_password_data = array();
            foreach ($data_email_available_status as $value) {
                array_push($reset_password_data, base64_encode($value->security_code));
                array_push($reset_password_data, base64_encode($value->remember_token));
            }
            return $reset_password_data; 
        }else{
            
            return false;
        }                                

    }


    //REset confirm pasword
    public function user_confirm_password_reseton_site($dataToReset){
        $url = $dataToReset[1];
        $email = bcrypt($dataToReset[0]);
        $my_url_tokens = explode("/", $url);

        $token1 = base64_decode($my_url_tokens[4]);
        $token2 = base64_decode($my_url_tokens[5]);

        $data_updated = DB::table("t_users_account_holder")
                            ->where('security_code',$token1)
                            ->where('remember_token',$token2)
                            ->update([
                                'password'=>$email,
                                "security_code"=>rand(99999999,10000000000000000),
                                "remember_token" => bin2hex(openssl_random_pseudo_bytes(12)),
                                "updated_time" => date('Y-m-d h:i:s')
                            ]);
        
        $reset_password="";
        if($data_updated){  
            $reset_password = [
                "success" => 200,
                "message" => "Password reset success"
            ];
        }else{
            $reset_password = [
                "success" => 400,
                "message" => "Password reset failed"
            ]; 
        }                    

        return $reset_password;
    }



    //Active user account 
    public function make_user_account_active($data1,$data2){
        $data_updated = DB::table("t_users_account_holder")
                        ->where('security_code',$data1)
                        ->where('remember_token',$data2)
                        ->update([
                                'account_active_status'=>15,
                                'active_flag'=>68,
                                "security_code"=>rand(99999999,10000000000000000),
                                "remember_token" => bin2hex(openssl_random_pseudo_bytes(12)),
                                "updated_time" => date('Y-m-d h:i:s')
                        ]);
        return $data_updated;               
    }


    // user new or not. if sexits can update to session. if not, cannot update the session 
    public function check_user_new_or_older($data_user_auth_id,$user_first_nme,$user_last_name){
            $data_user_id = $data_user_auth_id; 
            $data_user_first_name = $user_first_nme;
            $data_user_last_name = $user_last_name;
            $account_type = "";
            $company_id = "";
            $company_image = "";
            
            //Check user auth id is available in card details table and profile table
            // $user_data = DB::table()
            //                 ->select()
            //                 ->join()
            //                 ->join()
            //                 ->where()
            //                 ->get();


            //Check user create own profile account  
            $user_data = DB::table("t_user_account_profile_data")
                            ->select("account_type","company_id as cid","company_logo_upload as cimage")
                            ->where("user_auth_id",$data_user_id)
                            ->get();

            if(count($user_data) > 0 ){
                foreach ($user_data as $key) {
                    $account_type = $key->account_type;
                    $company_id = $key->cid;
                    $company_image = $key->cimage; 
                }
            }                

            $card_info_saved = false;

            if($account_type == 114){
                //Check user create own profile account  
                $card_data = DB::table("t_user_company_account_card_details")
                            ->select("user_id")
                            ->where("user_id",$data_user_id)
                            ->get();

                if(count($card_data) > 0 ){
                    $card_info_saved = true;
                }
            }

            $user_data_info = array(
                "user_authentic_id" => base64_encode($data_user_id+10598152458),
                "account_type"  => $account_type,
                "company_id" => $company_id,
                "company_image" => $company_image,
                "card_info_saved" => $card_info_saved,
                "account_logged_in"  => base64_encode(150),
                "user_first_name" => $data_user_first_name,
                "user_last_name" => $data_user_last_name
            );

            session($user_data_info);

    }


    //Load about us content
    public function load_company_about_us(){
        $data = DB::table("t_admin_company_content_update")
                ->select("title as titile_of_content", "content as web_content")
                ->where('title',"about_us")
                ->get();    
        
        $array_of_data =  [];
        for ($i=0; $i < count($data) ; $i++) { 
               $content = [
                    "key" => 1,
                    "value" => $data[$i]->web_content 
                ];
                array_push($array_of_data, $content);            
        }        

        return $array_of_data; 
    }


    //Home page category_maser_load
    public function User_category_load_home_page(){
        $category_data = DB::table("m_admin_post_main_category")
                            ->select("m_admin_post_main_category.ndl_category_id as number","m_admin_post_main_category.ndl_category_name as master_name")
                            ->join("t_user_post_details","t_user_post_details.post_main_category","=","m_admin_post_main_category.ndl_category_id")
                            ->distinct()
                            ->where("m_admin_post_main_category.ndl_active_flag",78)
                            ->where("t_user_post_details.active_state_post",110)
                            ->where("t_user_post_details.approved_status",95)
                            ->get();

        return $category_data;                    

    }

    //Advertisers load to home page
    public function Post_published_companies_load_home_page(){
        $company_data = DB::table("t_user_post_upload_count_of_company")
                            ->select("t_user_account_profile_data.company_name as cname","t_user_post_upload_count_of_company.company_id as cid","t_user_account_profile_data.company_logo_upload as cimage")
                            ->join("t_user_account_profile_data","t_user_account_profile_data.company_id","=","t_user_post_upload_count_of_company.company_id")
                            // ->join("t_user_account_profile_data as profileTable","profileTable.user_auth_id","=","t_user_post_upload_count_of_company.auth_user_id")
                            ->where("t_user_account_profile_data.user_active_state",1)
                            ->where("t_user_account_profile_data.geo_base",base64_decode(session("user_location")) )
                            ->get();

        return $company_data;            
    }


    //load all subcategory to post category page
    public function load_all_subcategory_of_master_cata($master_id){
        // var_dump($master_id);
        // exit();
        $subcategory_data = DB::table("m_admin_post_sub_category")
                                ->select("ndl_scategory_id as sid","ndl_scategory_name as sname")
                                ->where("ndl_s_mcategory_id",$master_id)
                                ->get();     

        return $subcategory_data;                           

    }


    //load company display advertiesments
    public function Load_all_company_posts_in_all($companyid){
         //Company id
         $company_id = $companyid;
         //Geo Location
         $location = base64_decode(session("user_location"));

         $data = DB::table("t_user_post_details")
                        ->select(   "t_user_post_details.post_id  as pid",
                                    "t_user_post_details.post_title as ptitle",
                                    "t_user_post_details.post_is_promotion as pispromotion",
                                    "t_user_post_details.post_promotion_price as ppromotionprice",
                                    "t_user_post_details.amount_price as ppostprice",
                                    "t_user_post_details.post_create_at as pcreated",
                                    "t_user_post_details.post_main_category as pmaster",
                                    "t_user_post_details.post_sub_category as psubmaster",
                                    "m_admin_post_main_category.ndl_category_name as pmname",
                                    "t_user_post_details.post_main_category as pmid",
                                    "t_user_post_details.post_sub_category as psmid",
                                    "t_user_post_details.display_image_path as pimagedisplay",
                                    "m_admin_post_sub_category.ndl_scategory_name as psname")
                        ->join("m_admin_post_main_category","m_admin_post_main_category.ndl_category_id","=","t_user_post_details.post_main_category")
                        ->join("m_admin_post_sub_category","m_admin_post_sub_category.ndl_scategory_id","=","t_user_post_details.post_sub_category")
                        ->where("t_user_post_details.company_id",$company_id)
                        ->where("t_user_post_details.location_base_from",$location)
                        ->where("t_user_post_details.active_state_post",110)
                        ->where("t_user_post_details.approved_status",95)
                        ->orderBy("t_user_post_details.post_main_category","DESC")
                        ->orderBy("t_user_post_details.post_sub_category","DESC")
                        ->get();

         return $data;               

    }

    //load master category display advertiesment
    public function Load_all_master_category_posts_in_all($master_category){
        
        $mcat = $master_category;

        //Geo Location
        $location = base64_decode(session("user_location"));

        $data = DB::table("t_user_post_details")
                        ->select("t_user_post_details.post_id  as pid","t_user_post_details.post_title as ptitle","t_user_post_details.post_is_promotion as pispromotion","t_user_post_details.post_promotion_price as ppromotionprice","t_user_post_details.amount_price as ppostprice","t_user_post_details.post_create_at as pcreated","t_user_post_details.post_sub_category as psubmasterid","t_user_post_details.display_image_path as pimagedisplay",
                            "m_admin_post_sub_category.ndl_scategory_name as psubname")
                            //"m_admin_post_sub_category.ndl_scategory_name as psname"
                        ->join("m_admin_post_sub_category","m_admin_post_sub_category.ndl_scategory_id","=","t_user_post_details.post_sub_category")
                        ->where("t_user_post_details.location_base_from",$location)
                        ->where("t_user_post_details.post_main_category",$mcat)
                        ->where("t_user_post_details.active_state_post",110)
                        ->where("t_user_post_details.approved_status",95)
                        ->get();

         return $data;

    }




    //user searching results
    public function user_searching_data_from_filter($input_data){
        
        //Geo Location
        $location = base64_decode(session("user_location"));

        $user_input = $input_data;
        
        $data = explode(" ", $user_input);
        //var_dump($data);
        //$key_words = [];

        $key_words[1] = "NOKEYWORD";
        $key_words[2] = "NOKEYWORD"; 
        $key_words[3] = "NOKEYWORD";
        $key_words[4] = "NOKEYWORD";
        $key_words[5] = "NOKEYWORD";
        $key_words[6] = "NOKEYWORD";
        $key_words[7] = "NOKEYWORD";
        $key_words[8] = "NOKEYWORD";
        $key_words[9] = "NOKEYWORD";

        for ($i=0; $i <count($data) ; $i++) { 
            $key_wrd = metaphone(strtoupper($data[$i]));
            $count = 1;
            $key_words[$count] = $key_wrd;
            $count++;
        }
        //$make_con = join(" ",$key_words);
        // $day = 1;
         // echo $key_words[1];
         // exit();

        // $key_words1 = "NOKEYWORD";
        // $key_words2 = "NOKEYWORD"; 
        // $key_words3 = "NOKEYWORD";
        // $key_words4 = "NOKEYWORD";
        // $key_words5 = "NOKEYWORD";
        // $key_words6 = "NOKEYWORD";
        // $key_words7 = "NOKEYWORD";
        // $key_words8 = "NOKEYWORD";
        // $key_words9 = "NOKEYWORD";

        // $search_data = explode(" ",$make_con);
        
        // for ($i=0; $i < count($search_data); $i++) {
        //    $count = 1;  
        //    $key_words.[$count] = ($key_words[$i] == "") ? "NOKEYWORD" : $key_words[$i];                
        //    $count++; 
        // }

        // $ds = [
        //     "t_user_post_details.post_title_keywords" => $key_words[1],
        //     "t_user_post_details.post_title_keywords" => $key_words[2], 
        //     "t_user_post_details.post_title_keywords" => $key_words[3],
        //     "t_user_post_details.post_title_keywords" => $key_words[4],
        //     "t_user_post_details.post_title_keywords" => $key_words[5],
        //     "t_user_post_details.post_title_keywords" => $key_words[6],
        //     "t_user_post_details.post_title_keywords" => $key_words[7],
        //     "t_user_post_details.post_title_keywords" => $key_words[8],
        //     "t_user_post_details.post_title_keywords" => $key_words[9],
        // ];

        if( $key_words[1] === "" ){    
            
        $results = DB::table("t_user_post_details")
                        ->select("t_user_post_details.post_id  as pid","t_user_post_details.post_title as ptitle","t_user_post_details.post_is_promotion as pispromotion","t_user_post_details.post_title_keywords as kw","t_user_post_details.post_promotion_price as ppromotionprice","t_user_post_details.amount_price as ppostprice","t_user_post_details.post_create_at as pcreated","t_user_post_details.post_sub_category as psubmasterid","t_user_post_details.display_image_path as pimagedisplay","m_admin_post_main_category.ndl_category_name as pmname","t_user_post_details.post_main_category as pmid")
                            //"m_admin_post_sub_category.ndl_scategory_name as psname"
                        ->join("m_admin_post_main_category","m_admin_post_main_category.ndl_category_id","=","t_user_post_details.post_main_category")
                        ->where('t_user_post_details.post_title','like', '%'.$user_input.'%')
                        // ->orWhere(function($query){
                        //         $query->where('t_user_post_details.post_title_keywords','like', '%'.$key_words[2].'%');
                        // })      
                        // ->whereIn('t_user_post_details.post_title_keywords',['APL','N'])
                        ->where("t_user_post_details.location_base_from",$location)
                        ->where("t_user_post_details.active_state_post",110)
                        ->where("t_user_post_details.approved_status",95)
                        ->get();



        // $data1 = collect([$results]);                
        // $dd = $data1->whereIn('ptitle', ['new','Drink'] );
        // var_dump($dd->all());
        // exit();

        return $results;               


        }else{

             $results = DB::table("t_user_post_details")
                        ->select("t_user_post_details.post_id  as pid","t_user_post_details.post_title as ptitle","t_user_post_details.post_is_promotion as pispromotion","t_user_post_details.post_title_keywords as kw","t_user_post_details.post_promotion_price as ppromotionprice","t_user_post_details.amount_price as ppostprice","t_user_post_details.post_create_at as pcreated","t_user_post_details.post_sub_category as psubmasterid","t_user_post_details.display_image_path as pimagedisplay","m_admin_post_main_category.ndl_category_name as pmname","t_user_post_details.post_main_category as pmid")
                            //"m_admin_post_sub_category.ndl_scategory_name as psname"
                        ->join("m_admin_post_main_category","m_admin_post_main_category.ndl_category_id","=","t_user_post_details.post_main_category")
                        ->where('t_user_post_details.post_title_keywords','like', '%'.$key_words[1].'%')
                        ->orWhere('t_user_post_details.post_title_keywords','like', '%'.$key_words[2].'%')
                        ->orWhere('t_user_post_details.post_title_keywords','like', '%'.$key_words[3].'%')
                        ->orWhere('t_user_post_details.post_title_keywords','like', '%'.$key_words[4].'%')
                        ->orWhere('t_user_post_details.post_title_keywords','like', '%'.$key_words[5].'%')
                        ->orWhere('t_user_post_details.post_title_keywords','like', '%'.$key_words[6].'%')
                        ->orWhere('t_user_post_details.post_title_keywords','like', '%'.$key_words[7].'%')
                        // ->orWhere(function($query){
                        //         $query->where('t_user_post_details.post_title_keywords','like', '%'.$key_words[2].'%');
                        // })      
                        // ->whereIn('t_user_post_details.post_title_keywords',['APL','N'])
                        ->where("t_user_post_details.location_base_from",$location)
                        ->where("t_user_post_details.active_state_post",110)
                        ->where("t_user_post_details.approved_status",95)
                        ->get();    


            return $results;            

        }    

    }



    //Load singal post
    public function load_singal_posts_on_view_post_page($post_id,$searching){

        $from_searching = $searching;    
        $postid = $post_id;

        if($from_searching == false || $from_searching == 0){    
        $update_count = DB::table("t_user_post_count_clicked")
                            ->updateOrInsert(
                                ["post_id" => $postid ],
                                [ 
                                    "clicked_count" => DB::raw("clicked_count + 1"),
                                    "liked_count" => DB::raw("liked_count + 0"),
                                    'saved_count' => DB::raw("saved_count + 0"),
                                    'searching_count' => DB::raw("searching_count + 0"),
                                ]    
                            ); 
        }else{
        $update_count = DB::table("t_user_post_count_clicked")
                            ->updateOrInsert(
                                ["post_id" => $postid ],
                                [ 
                                    "clicked_count" => DB::raw("clicked_count + 0"),
                                    "liked_count" => DB::raw("liked_count + 0"),
                                    'saved_count' => DB::raw("saved_count + 0"),
                                    'searching_count' => DB::raw("searching_count + 1"),
                                ]    
                            );     
        }   

        if(session('account_logged_in') != ""  && base64_decode(session('account_logged_in')) == 150 ){
            $viewed_user = DB::table("t_user_post_viewed_count")
                            ->insert(
                               [
                                    "post_id" => $postid,
                                    "user_id" => base64_decode(session('user_authentic_id'))-10598152458,
                                    "viewed_date" => date("Y-m-d")
                               ]     
                            );                 
        }                    

        $post_info = DB::table("t_user_post_details")
                        ->select("t_user_post_details.post_id as pid","t_user_post_details.post_title as ptitle","t_user_post_details.product_conditions as pcondition","t_user_post_details.post_content as pcontent","t_user_post_details.post_visit_link as pvisits","t_user_post_details.amount_price as pamountprice","t_user_post_details.post_is_promotion as pispromotion","t_user_post_details.post_promotion_price as promotionprice","t_user_post_details.post_expire_on as pexpireon","t_user_post_details.post_approved_at as pliveatposed",
                            "m_admin_post_main_category.ndl_category_name as pmaincategory",
                            "m_admin_post_sub_category.ndl_scategory_name as psubcategory",
                            "t_user_account_profile_data.company_name as pcompany_name"
                        )
                        ->join("m_admin_post_sub_category","m_admin_post_sub_category.ndl_scategory_id","=","t_user_post_details.post_sub_category")
                        ->join("m_admin_post_main_category","m_admin_post_main_category.ndl_category_id","=","t_user_post_details.post_main_category")
                        ->join("t_user_account_profile_data","t_user_account_profile_data.company_id","=","t_user_post_details.company_id")
                        ->where("t_user_post_details.post_id",$postid)
                        ->get();
         $image_info =  DB::table("t_user_post_upload_more_files_to_post")
                        ->select("file_path_uploaded as pfiles")
                        ->where("post_id",$postid)
                        ->get();              

         $data = [
            "post_info" => $post_info,
            "post_images" => $image_info
         ];               

         return $data;               

    }

    //load the T&C and privacy and policy update
    public function load_company_privacy_polivy_tc(){
        $data = DB::table("t_admin_company_content_update")
                ->select("content as web_content")
                ->where('title',"privacy_content")
                ->get();

        return $data;        
    }


    //load all searched post info display in home page
    public function Post_published_searched_results(){

        //Geo Location
        $location = base64_decode(session("user_location"));

        $data = DB::table("t_user_post_details")
                        ->select("t_user_post_details.post_id  as pid","t_user_post_details.post_title as ptitle","t_user_post_details.post_is_promotion as pispromotion","t_user_post_details.post_promotion_price as ppromotionprice","t_user_post_details.amount_price as ppostprice","t_user_post_details.post_create_at as pcreated","t_user_post_details.post_sub_category as psubmasterid",
                            "t_user_post_details.location_base_price as pcurrencytype",
                            "t_user_post_details.common_price_eur as pcommoneur",
                            "t_user_post_details.common_promotional_price_eur as pcommonpromeur",
                            "t_user_post_details.display_image_path as pimagedisplay","t_user_account_profile_data.company_logo_upload as cimage","t_user_account_profile_data.company_name as cname")
                            //"m_admin_post_sub_category.ndl_scategory_name as psname"
                        ->join("t_user_post_count_clicked","t_user_post_count_clicked.post_id","=","t_user_post_details.post_id")
                        ->join("t_user_account_profile_data","t_user_account_profile_data.company_id","=","t_user_post_details.company_id")
                        ->where("t_user_post_details.location_base_from",$location)
                        ->where("t_user_post_count_clicked.searching_count",">",0)
                        ->where("t_user_post_details.active_state_post",110)
                        ->where("t_user_post_details.approved_status",95)
                        ->get();

         return $data;
    }

    //User liked this post
    public function make_user_like_this_posts_addvertise($data_post){
        $data = explode("_", $data_post);
        $data_operation = $data[0];
        $post_id = substr($data[2],2);

        if($data_operation == "looking"){

        $update_count = DB::table("t_user_post_count_clicked")
                            ->updateOrInsert(
                                ["post_id" => $post_id ],
                                [
                                    "clicked_count" => DB::raw("clicked_count + 0"),
                                    "liked_count" => DB::raw("liked_count + 1"),
                                    'saved_count' => DB::raw("saved_count + 0"),
                                    'searching_count' => DB::raw("searching_count + 0"),
                                ]    
                            );

        return $update_count;                

        }else if($data_operation == "saving"){
            
            if(!empty(session("account_logged_in"))){

                $update_count = DB::table("t_user_post_count_clicked")
                                ->updateOrInsert(
                                    ["post_id" => $post_id ],
                                    [ 
                                        "clicked_count" => DB::raw("clicked_count + 0"),
                                        "liked_count" => DB::raw("liked_count + 0"),
                                        'saved_count' => DB::raw("saved_count + 1"),
                                        'searching_count' => DB::raw("searching_count + 0"),
                                    ]    
                                ); 


                $data_save_posts_user = [
                    "user_id" => base64_decode(session('user_authentic_id'))-10598152458,
                    "advertiesment_id" => $post_id,
                    "added_date" => date('Y-m-d H:i:s'),
                    "post_available_or_not" => 85,
                    "active_state_user" => 75
                ];                
                $advertiesments_update = DB::table('t_user_account_liked_saved_posts')
                                            ->insert($data_save_posts_user);


                return $update_count;                           
            
            }
        }                    
    }


    //load available ctegoryies to side menu
    public function load_categories_to_side_menue(){

        $country = base64_decode(session("user_location"));

        $dataCategory = DB::table("t_user_post_details")
                            ->select( "t_user_post_details.post_main_category as postmainCId",
                                      "t_user_post_details.post_sub_category as postsubmainCId",
                                      // "t_user_post_details.post_main_category as postcomsubmainCId",
                                      "m_admin_post_main_category.ndl_category_name as postmainCName",
                                      "m_admin_post_sub_category.ndl_scategory_name as postsubmainCName"
                                    )
                            ->join("m_admin_post_main_category","m_admin_post_main_category.ndl_category_id","=","t_user_post_details.post_main_category")
                            ->join("m_admin_post_sub_category","m_admin_post_sub_category.ndl_scategory_id","=","t_user_post_details.post_sub_category")
                            // ->join("m_admin_post_sub_category_filter_more",
                            //         "m_admin_post_sub_category_filter_more.filter_sub_id","=","t_user_post_details.fil")
                            ->where("t_user_post_details.active_state_post",110)
                            ->where("t_user_post_details.approved_status",95)
                            ->where("t_user_post_details.location_base_from",$country)
                            ->where("t_user_post_details.post_display_wordwide",98)
                            ->orderBy("t_user_post_details.post_main_category","ASC")
                            ->orderBy("t_user_post_details.post_sub_category","ASC")
                            //->distinct()
                            ->get();

        return $dataCategory;    

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


}
