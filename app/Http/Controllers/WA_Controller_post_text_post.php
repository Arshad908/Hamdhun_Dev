<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\WebUsersManagementModal;

use App\WebAdminCommonModel;

use Illuminate\Routing\Redirector;


require __DIR__.'/cryptojs-aes.php';


class WA_Controller_post_text_post extends Controller
{


    public function __construct(Request $req){
            if(session("user_location") == "" && session("user_currency") == "" ){
               $commonModel = new WebAdminCommonModel;
               $data = $commonModel->getLocationdetailseOfuser();
            }
    }


    public function upload_user_post_new_addintions(Request $rewqst){
    	
    	$this->validate($rewqst, [
            // 'ndl_make_files_post_of_post' => 'required',
            //'ndl_make_content_of_post' => 'required|max:1000',
            //'mstr_select_actegory' => 'required|max:4',
            //'sebs_select_catdry' => 'required|max:4',
           // 'ndl_make_price_chanrge_of_post' => 'required|max:10',
            'ndl_make_files_post_of_post.*' => "mimes:jpeg,png,jpg|max:512|required"
        ]);
    	// $this->validate($rewqst, [
     //            'ndl_make_files_post_of_post' => 'required',
     //            'ndl_make_files_post_of_post.*' => 'mimes:png,jpeg,jpg'
     //    ]);


        //image upload 
    	$images_post = $rewqst->file('ndl_make_files_post_of_post');
    	$user_id = rand();
    	$images_name_with_path = [];
        if($rewqst->hasfile('ndl_make_files_post_of_post')){
            
        	$destinationPath = './images_uploads/'.$user_id;    
            foreach($images_post as $image)
            {

            	//Display File Name
				$image_size = $image->getSize();				    
            	//$rewqst->file($image)->store("images");
                $imageName=$image->getClientOriginalName();
                $image->move($destinationPath, $imageName);

                array_push($images_name_with_path,$destinationPath."/".$imageName);

               // $insert['image'] = "$imageName";
            }
         }

       $model_web_user = new WebUsersManagementModal();  

       //Detailse of posts
        $post_uploaded_user_data = [
            "usr_post_title" => $rewqst->input("ndl_make_title_post"),
            "usr_post_content" => $rewqst->input("ndl_make_content_of_post"),
            "usr_check_condition" => $rewqst->input("nd_products_condition_detect"),
            "usr_post_advertisement_link" => $rewqst->input("ndl_make_urls_of_post"),
            "usr_post_company_link" => $rewqst->input("ndl_make_com_vst_links_of_post"),
            "usr_post_main_cat" => $rewqst->input("mstr_select_actegory"),
            "usr_post_an_offer_post" => $rewqst->input("ndl_make_this_offer_of_post"),
            "usr_post_offer_price" => $rewqst->input("ndl_make_offer_price_chanrge_of_post"),
            "usr_post_sub_cat" => $rewqst->input("sebs_select_catdry"),
            "usr_post_price" => $rewqst->input("ndl_make_price_chanrge_of_post"),
            "usr_post_expire_on" => $rewqst->input("ndl_make_expire_date_of_post"),
            "uploaded_post_image_more" => $images_name_with_path,
            "base_currency_type" => $rewqst->input("ndl_make_price_base_of_post"),
            "post_display_wordwide" => base64_decode($rewqst->input('ndl_make_visible_range_of_post'))-5789     
        ];  


        $post_upload_status = $model_web_user->webuser_site_save_posts($post_uploaded_user_data);

        return redirect()->back();
       //dd($rewqst->all());        
    
    }


    public function updated_user_profile_mk_changes(Request $que_request){
            
            $reset_my_first_name = 0;
            $reset_my_last_name = 0;
            $reset_my_email = 0;
            $reset_my_password = 0;

            $dataRequest = array(
                "firstname","lastname","advertiser","emailid","contactnumber","country","statedisc","city","passwordreset"
            );

            $data["firstname"] = $que_request->firstname;
            $data["lastname"] = $que_request->lastname;
            $data["advertiser"] = $que_request->advertiser;
            $data["emailid"] = $que_request->emailid;
            $data["contactnumber"] = $que_request->contactnumber;
            $data["country"] = $que_request->country;
            $data["statedisc"] = $que_request->statedisc;
            $data["city"] = $que_request->city;
            $data["passwordreset"] = $que_request->passwordreset;

        $enc_key = session('enc_key');

        $readable_values_from_controller = array();

        for ($i = 0 ; $i < count($dataRequest) ; $i++) {    
            $er = cryptoJsAesDecrypt($enc_key,$data[$dataRequest[$i]]);  
            array_push($readable_values_from_controller, $er);  

            
        }

        //var_dump($readable_values_from_controller);
        $model_web_user = new WebUsersManagementModal();  
        $data_save_to_model = $model_web_user->webuser_profile_registration_update($readable_values_from_controller);

        return json_encode($data_save_to_model);

    }

    //User make this post to update
    public function make_post_to_updated_(Request $rest){
        
        $post_id = base64_decode($rest->input('ndl_make_content_selected'))-105248549;
        $already_uploaded_image = base64_decode($rest->input('ndl_make_content_image_selected'));

        $this->validate($rest, [
            'ndl_make_files_post_of_post.*' => "mimes:jpeg,png,jpg|max:512"
        ]);

         //image upload 
        $images_post = $rest->file('ndl_make_files_post_of_post');
        $user_id = rand();
        $images_name_with_path = [];
        if($rest->hasfile('ndl_make_files_post_of_post')){
            
            $destinationPath = './images_uploads/'.$user_id;    
            foreach($images_post as $image)
            {

                //Display File Name
                $image_size = $image->getSize();                    

                $imageName=$image->getClientOriginalName();
                $image->move($destinationPath, $imageName);

                array_push($images_name_with_path,$destinationPath."/".$imageName);

            }
         }


         $model_web_user = new WebUsersManagementModal();  

       //Detailse of posts
        $post_uploaded_user_data = [
            "usr_posted_id" => $post_id,
            "usr_post_title" => $rest->input("ndl_make_title_post"),
            "usr_post_content" => $rest->input("ndl_make_content_of_post"),
            "usr_check_condition" => $rest->input("nd_products_condition_detect"),
            "usr_post_advertisement_link" => $rest->input("ndl_make_urls_of_post"),
            "usr_post_company_link" => $rest->input("ndl_make_com_vst_links_of_post"),
            "usr_post_main_cat" => $rest->input("mstr_select_actegory"),
            "usr_post_an_offer_post" => $rest->input("ndl_make_this_offer_of_post"),
            "usr_post_offer_price" => $rest->input("ndl_make_offer_price_chanrge_of_post"),
            "usr_post_sub_cat" => $rest->input("sebs_select_catdry"),
            "usr_post_price" => $rest->input("ndl_make_price_chanrge_of_post"),
            "usr_post_expire_on" => $rest->input("ndl_make_expire_date_of_post"),
            "uploaded_post_image_more" => $images_name_with_path,
            "allready_uploaded_image" => $already_uploaded_image, 
            "base_currency_type" => $rest->input("ndl_make_price_base_of_post"),
            "post_display_wordwide" => base64_decode($rest->input('ndl_make_visible_range_of_post'))-5789  
        ];  


        $post_upload_status = $model_web_user->webuser_site_update_changed_posts($post_uploaded_user_data);

        return redirect()->back();
    }


    //Company data profile infor save
    public function updated_user_profile_mk_changes_company_detailse(Request $ew_re_company){
            

            $image_send = $ew_re_company->file('nd_profile_company_logo_update');
            $image_upload_path = "" ;            
                $company_id = 1000000;
                $images_name_with_path = [];
                if($ew_re_company->hasfile('nd_profile_company_logo_update'))
                 {
                    
                    $destinationPath = './company_logo_uploads/'.$company_id;    

                        //Display File Name
                        $image_size = $image_send->getSize();                    
                        $imageName=$image_send->getClientOriginalName();
                        $image_send->move($destinationPath, $imageName);

                       $image_upload_path = $destinationPath."/".$imageName;

                 }                    


            $data["company_name"] = $ew_re_company->input('nd_profile_company_name');
            $data["company_domain"] = $ew_re_company->input('nd_profile_company_domain_name');
            $data["post_visibility"] = $ew_re_company->input('nd_profile_advertiestment_visibale');
            $data["logo_updated_path"] = $image_upload_path;
            $data["firstname"] = $ew_re_company->input('nd_profile_first_name');
            $data["lastname"] = $ew_re_company->input('nd_profile_last_name');
            $data["advertiser"] = $ew_re_company->input('select_account_type');
            $data["emailid"] = $ew_re_company->input('nd_profile_compnay_email');
            $data["contactnumber"] = $ew_re_company->input('nd_profile_contact_number');
            $data["country"] = $ew_re_company->input('nd_profile_company_base_country');
            $data["statedisc"] = $ew_re_company->input('nd_profile_company_base_state');
            $data["city"] = $ew_re_company->input('nd_profile_company_base_city');
            $data["passwordreset"] = $ew_re_company->input('nd_profile_forgort_pasweeord');


            $model_web_user = new WebUsersManagementModal();      
            $data_save_to_model = $model_web_user->webuser_company_profile_registration_update($data);

            return json_encode($data_save_to_model);     



 

    }    





    //Make user card info save to DB
    public function make_update_user_card_info(Request $user_amke_card){
        
        $enc_key = base64_decode($user_amke_card->base_code); //session('card_encryption_key');
        $retrive_data = $user_amke_card->card_info_data;
        
        $readable_values_from_controller = array();

         for ($i = 0 ; $i < count($retrive_data); $i++) {    
            $er = cryptoJsAesDecrypt($enc_key,$retrive_data[$i]);  
            array_push($readable_values_from_controller, $er);  
        } 

        $model_web_user = new WebUsersManagementModal();      
        $data_save_to_model = $model_web_user->webuser_company_card_inserttion($readable_values_from_controller);
        
        if($data_save_to_model){
            $data_success = [
                "status" => 255,
                "card Updated Success"
            ];    
        }else{
            $data_success = [
                "status" => 404,
                "card Updated Failed"
            ];
        }
        return json_encode($data_success);
    }


    public function card_make_primay_web_admin(Request $req){

        $card_number = $req->card_number;

        $model_web_user = new WebUsersManagementModal();      
        $data_save_to_model = $model_web_user->make_primary_selected_card_web_admin($card_number);

    }
















    public function files(){
    	  echo 'File Name: '.$file->getClientOriginalName();
			      echo '<br>';
			   
			      //Display File Extension
			      echo 'File Extension: '.$file->getClientOriginalExtension();
			      echo '<br>';
			   
			      //Display File Real Path
			      echo 'File Real Path: '.$file->getRealPath();
			      echo '<br>';
			   
			      //Display File Size
			      echo 'File Size: '.$file->getSize();
			      echo '<br>';
			   
			      //Display File Mime Type
			      echo 'File Mime Type: '.$file->getMimeType();

    }
}
