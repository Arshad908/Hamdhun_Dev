<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirector;
use Carbon\Carbon;
require __DIR__.'/cryptojs-aes.php';

use Illuminate\Support\Facades\Mail;

use Session;

use App\AdminAccountsModel;

class MA_Controller_post_text_post extends Controller
{

    public function __construct(){
        
    }


    public function add_category_list_dms(Request $requset){

    	$adminModel = new AdminAccountsModel;

    	$dataRequest = array(
    		"mastr_data","scat_data"
    	);

    	$data["mastr_data"] = $requset->master_cat; 
    	$data["scat_data"] = $requset->submast_cat;
    	$enc_key = $requset->ad_key;

    	$readable_values_from_controller = array();

    	for ($i = 0 ; $i < 2 ; $i++) {    
            $er = cryptoJsAesDecrypt($enc_key,$data[$dataRequest[$i]]);  
            array_push($readable_values_from_controller, $er);	

    		
    	}

    	$data_save_to_model = $adminModel->webuser_category_registration($readable_values_from_controller);

    	return $data_save_to_model;


    }


    public function about_us_content_change_admn(Request $req_about_us){

        $about_us_content = $req_about_us->master_cat;

        $adminModel = new AdminAccountsModel;

        $data_saved = $adminModel->update_web_content_abt_us($about_us_content);

        return json_encode($data_saved);

    }



    public function add_category_list_dms_single_add(Request $reqw){
    	$adminModel = new AdminAccountsModel;

    	$dataRequest = array(
    		"mastr_data"
    	);

    	$data["mastr_data"] = $reqw->master_cat; 	

    	if($data["mastr_data"] == "get_new"){

    	$all_data = $adminModel->List_all_master_categories();
    	$all_data_js = json_decode($all_data);
    	
    	$results = [];	
	    	
	    	foreach ($all_data_js as $value) {
	    		
	    		$make_data = [
	    			"categoryname" => ucfirst($value->ndl_category_name),
	    			"categoryid"   => $value->ndl_category_id
	    		];		
	    		
	    		array_push($results, $make_data);	
	    	
	    	};

	    return $results;			

    	}else{	

    	

    	$enc_key = session('ivText');

    	$readable_values_from_controller = array();

    	for ($i = 0 ; $i < 1 ; $i++) {    
            $er = cryptoJsAesDecrypt($enc_key,$data[$dataRequest[$i]]);  
            array_push($readable_values_from_controller, $er);	

    		
    	}

    	$data_save_to_model = $adminModel->webuser_category_registration_only_single($readable_values_from_controller);

    	return $data_save_to_model;
    
    	}	

    }


    //Add privacy content
    public function privacy_content_update(Request $privacy_data){
        $data_priv = $privacy_data->master_cat;
        $data_priv_id = $privacy_data->mode_id;

        $adminModel = new AdminAccountsModel;

        $data_saved = $adminModel->update_web_content_privacy_content_update($data_priv,$data_priv_id);

        return json_encode($data_saved);

    }

    //Add advertising how to make post
    public function advertising_policy_how_to_update(Request $reqData){
        $data_priv = $reqData->master_cat;
        $data_priv_id = $reqData->mode_id;

        $adminModel = new AdminAccountsModel;

        $data_saved = $adminModel->update_web_content_advertisers_guidance_update($data_priv,$data_priv_id);

        return json_encode($data_saved);        
    }


    //Add sub more category
    public function add_more_sub_more_category_data(Request $req_sub_more_cat){
        $reqsuest_m_data = $req_sub_more_cat->master_cat;
        $reqsuest_s_data = $req_sub_more_cat->submast_cat;
        $reqsuest_sm_data = $req_sub_more_cat->submore_cat;

        $submorecategory = [
            "more" => $reqsuest_m_data,
            "sub" => $reqsuest_s_data,
            "moresub" => $reqsuest_sm_data
        ];

        $adminModel = new AdminAccountsModel;

        $data_saved = $adminModel->user_add_more_sub_category($submorecategory);

        return $data_saved;

    }


    //Company post make approve
    public function make_post_approved_status(Request $requestData){

        $data_posts = explode("_",$requestData->dataParse);
        $data_post_id = $data_posts[5];
        $data_post_operation = $data_posts[4];
        $data_post_company_id = $data_posts[6];


        $adminModel = new AdminAccountsModel;
        $post_status = $adminModel->AdminMakePostsApproval($data_post_id,$data_post_operation,$data_post_company_id);
            
         if($post_status){
            return 200;
         }else{
            return 400;
         }    


    }



    //Make remove the post from the list by master admin
    public function make_post_remove_from_the_list(){
        
        $data_post_id = $_GET["cq"];
        $data_post_company_id = $_GET["co"];


        $adminModel = new AdminAccountsModel;
        $post_status = $adminModel->AdminMakePostsApproval($data_post_id,'25',$data_post_company_id);
            
         if($post_status){
            Session::flash('post_update_status',200);
            return redirect()->back();
         }else{
            Session::flash('post_update_status',400);
            return redirect()->back();
         }        
    } 


    //make bulk post approval or reject
    public function make_bulk_post_apporal_or_reject_check(Request $reqsw, $operation_type){
        $op_type = base64_decode($operation_type)/500;
        $post_ids = $reqsw->data;    
        // dd($post_ids);
        $newPostIds = array();
        foreach ($post_ids as $key => $value) {
            $data = $value-4625;
            array_push($newPostIds, $data);
        }

        $adminModel = new AdminAccountsModel;

        if($op_type > 49 && $op_type < 101){
            //accept posts
            $make_admin_approval_post = $adminModel->bulkApprovalPostMake($newPostIds);
            return $make_admin_approval_post;
        }

        if($op_type > 109 && $op_type < 121){
            //reject post
            $make_admin_reject_post = $adminModel->bulkReject_KlPostMake($newPostIds);
            return $make_admin_reject_post;   
        }

        
    }



    //Create new pot-promotion codes
    public function make_user_promocode_creatd(Request $codeData){
        
        $data['social'] = $codeData->social_s;
        $data['company'] = $codeData->company;
        $data['promocode'] = $codeData->promocode;
        $data['offertype'] = $codeData->offertype;
        $data['description'] = $codeData->description;
        $data['lastdate'] = $codeData->lastdate;

        $adminModel = new AdminAccountsModel;
        $save_new_promoc = $adminModel->save_new_user_promocodes_updated($data);

        foreach ($save_new_promoc["all_companies"] as $value) {
            $sending_email = $value->company_email;
            $promodata["promocodetouser"] =  base64_encode(rand(10,100).".".$data['promocode']."."."A".".".rand());
            $promodata["promooffertype"] =  base64_encode($save_new_promoc["offer_type"]);
            Mail::send('email_templates.promotion.user_admin_promotion_temp',['prodata'=>$promodata],function($message) use ($sending_email)
                {
                    $message->subject('Offer!');
                    $message->from('helpmenewacc123@gmail.com', 'noyel.com');
                    $message->to($sending_email);
                }); 
        }

        return true;

    }


    //master category update
    public function make_changes_on_category_master(Request $request){
        $category_id = base64_decode($request->data3)-(155040-355);
        $category_name = $request->data1; 
        $operation_type = $request->data2;

        $adminModel = new AdminAccountsModel;
        $make_category_to_update = $adminModel->makeAdminToUpdateCategory($category_id,$category_name,$operation_type);

    }

    //sub category update
    public function make_changes_on_category_master_sub(Request $request){
        $category_id = base64_decode($request->data3)-(155040-355);
        $category_name = $request->data1; 
        $operation_type = $request->data2;

        $adminModel = new AdminAccountsModel;
        $make_category_to_update = $adminModel->makeAdminToUpdateSub_Category($category_id,$category_name,$operation_type);

    }


    //update complementory actegory
    public function make_changes_on_category_master_complementory(Request $request){
        $category_id = base64_decode($request->data3)-(155040-355);
        $category_name = $request->data1; 
        $operation_type = $request->data2;

        $adminModel = new AdminAccountsModel;
        $make_category_to_update = $adminModel->makeAdminToUpdateSubComplementory_Category($category_id,$category_name,$operation_type);
    }




    //master admin make login
    public function master_admin_make_user__login(Request $requestMaster,$data){

        $requestMaster->validate([
                'noydl_make_password' => 'required|min:7',
                'noydl_make_email' => 'required|email'
            ], [
                'noydl_make_email.required' => 'Email is required',
                'noydl_make_password.required' => 'Password is required'
            ]);


        $req_user_email = $requestMaster->input("noydl_make_email");
        $req_user_passw = $requestMaster->input("noydl_make_password");

        $adminModel = new AdminAccountsModel;
        $make_user_loggin = $adminModel->makeAdminTologgedInAdnPnl($req_user_email,$req_user_passw);


        if($make_user_loggin["status"] == 200){
            return redirect()->route("stfprocrombload_dashboard_amster_admin");
        }elseif($make_user_loggin["status"] == 404 || $make_user_loggin["status"] == 500){
            return redirect()->back();
        }


    }


}
