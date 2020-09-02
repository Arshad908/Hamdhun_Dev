<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\WebUsersManagementModal;
use App\WebAdminCommonModel;

use Carbon\Carbon;

use Redirector;

use Session;

class WA_Controller_post_text extends Controller
{

    public function __construct(Request $req){
            if(session("user_location") == "" && session("user_currency") == ""){
                $commonModel = new WebAdminCommonModel;
                $data = $commonModel->getLocationdetailseOfuser();
            }
    }


    public function index(Request $request){
        $request->session()->put('select_menu', 'webadmin_dashboard');

        $webAdminModel = new WebUsersManagementModal();
        $listed_all_onlive = $webAdminModel->listed_all_post_web_admin_approved();
        $listed_all_wishlisted = $webAdminModel->listed_all_post_web_admin_wishlisted();
        // $latest_upload_dash = $webAdminModel->listed_all_lastest_post_detailse_dash();
        $listed_all_wishlisted_details = $webAdminModel->dash_listed_all_post_wishlisted_detailse();
        $latest_viewed_posts = $webAdminModel->viewed_ltest_viewed_posts();


    	return view('webuseradmin.dashboard.dashboard',compact('listed_all_onlive','listed_all_wishlisted','latest_viewed_posts','listed_all_wishlisted_details'));
        
    }


    //Loging screen check
    public function check_user_loggedin(){
    	return view('webuseradmin.loggedin.loginscreen'); 
    }

    //Load create post view
    public function load_user_create_postPage(Request $request){

        $request->session()->put('select_menu', 'webadmin_createpost');

        if(!empty(session("account_logged_in"))){
            if( !empty(session("account_type")) && session("account_type") == 114){
                // this function is ok. as below , continue the process
                //var_dump("s");                
            }else{
                //this is not a company
                if(session("account_type") == 96){
                   $request->session()->flash('user_profile_data_saved', 400); 
                }
                //even not regiter the profile
                else if(empty(session("account_type"))){
                   $request->session()->flash('user_profile_data_saved', 400); 
                }
                //this company not saved card info
                else if(!empty(session("account_type")) && session("card_info_saved") == false){
                    //$request->session()->flash('user_profile_data_saved', 401);   
                }
                
                //return redirect()->route("updateuserprofiledatainweb");
            }
        }else{
             return redirect()->route("site_login_ext");
        }
        
        $webModal = new WebUsersManagementModal;
        $data_Category = $webModal->load_main_and_sub_category();
        $data_currency_nfo = $webModal->load_curency_data();    

    	return view('webuseradmin.posts.createposts',compact("data_Category","data_currency_nfo"));
    }


    //view user profile
    public function user_update_prodile_info(Request $request){
        $request->session()->put('select_menu', 'webadmin_userprofile');

        //get the data Bill info

        //Get the data card info

        //get the profile details
        $webModal = new WebUsersManagementModal;
        $profile_data = $webModal->UserDetailseLoadToProfile();
        $profile_card_data = $webModal->UserCardDetailseLoadToProfile();
        $pendingPayment_Status = $webModal->check_all_pending_payment_status_of_this_user();
        $available_countries = $webModal->listed_all_countriesy_create_profile();
        // var_dump($available_countries);
        // exit();   
        $key = $webModal->loadind_encrtp_key();
    	return view('webuseradmin.userprofile.userprofile',compact("key","profile_data","profile_card_data","pendingPayment_Status","available_countries"));
    }


    //user make pending payment
    public function make_user_pending_monthly_rewn_charge(){

       $base_value = base64_decode($_GET["based"])-109;
       $date_value = base64_decode($_GET["tec"]);
       
       $date_sum = date("Y")+date("m")+date("d")+$base_value-1;

       if($date_value == $date_sum){
            return "Done";
       }else{
            return "No";
       }

       return "Came";     
    }


    //View for list all posts
    public function user_showall_posted_info(Request $request){
        $request->session()->put('select_menu', 'webadmin_listedallposts');
        $webModal = new WebUsersManagementModal;
        $all_listed_posts = $webModal->WebAdminPostDetailseLoad();
    	return view('webuseradmin.posts.listedallposts',compact("all_listed_posts"));
    } 

    //Activate user promotion code
    public function activate_monthly_promocodes_wdmin(){
        $all_code = base64_decode($_GET["check"]);
        $exac_data = explode(".",$all_code);
        $check_sec_code = base64_decode($_GET["follow"]);
    
        if($check_sec_code >= 15000 && $check_sec_code <= 25000){
            $webModal = new WebUsersManagementModal;
            $activted_promo_code = $webModal->web_user_activate_promotion_code_by_url($exac_data[1]);

            if($activted_promo_code){
                 return redirect()->route("updateuserprofiledatainweb")->with('promocodestatus', 'Promo Code Added Successfully');   
            }else{
                return redirect()->route("updateuserprofiledatainweb")->with('promocodestatus', 'Error occure while adding promocode');
            }

        }else{
            return redirect()->route("updateuserprofiledatainweb")->with('promocodestatus', 'Error occure while adding promocode');
        }

    }


    //web admin make post update delete view stage
    public function web_admin_uploaded_post_update(){
        
        //operation type : 
        /*
            Less 100 : edit the post
            between 101-999 : view the post
            Greater than 1000 : delete post    
        */
        $operation_type = $_GET["prom"];
        $state = $_GET["state"];
        $post_id = base64_decode($_GET["def"]);     
        
        $company_id = session('company_id');
        $user_auth_id = base64_decode(session('user_authentic_id'))-10598152458;

        $webModal = new WebUsersManagementModal;

        //if edit post
        if($operation_type < 101 && $state == true){

            //check this post related to logged in user
            
            $post_data = $webModal->web_admin_make_post_detailse('edit',$company_id,$user_auth_id,$post_id);
            $data_Category = $webModal->load_main_and_sub_category();
            $data_currency_nfo = $webModal->load_curency_data();
            return  view('webuseradmin.posts.createposts_edit',compact('post_data','data_Category','data_currency_nfo'));
        }


        //if delete post
        if($operation_type > 100 && $operation_type < 1001 && $state == false){
            //check this post related to logged in user
            $post_data = $webModal->web_admin_make_post_detailse('delete',$company_id,$user_auth_id,$post_id);
            
            if($post_data){
                Session::flash('post_uploade_status', 200); 
            }else{
                Session::flash('post_uploade_status',400); 
            }

            return redirect()->back();

        }

        //view post
        if($operation_type > 1001 && $operation_type < 10001 && $state == false){
            //check this post related to logged in user
            $post_view_data = $webModal->web_admin_make_post_detailse('view',$company_id,$user_auth_id,$post_id);
            
            return  view('webuseradmin.posts.posts_view_page',compact('post_view_data'));

        }

        return redirect()->back();
    }


    // Load view like and saved post screen
    public function load_liked_and_save_post(Request $request){
        $webModal = new WebUsersManagementModal;
        $saved_posts_by_user = $webModal->WebAdminSavedPostDetailse();
        $request->session()->put('select_menu', 'webadmin_likessavedpost');
        return view('webuseradmin.posts.liked_and_saved_posts',compact('saved_posts_by_user')); 
    }


    //Remove advertiesment from the wish list
    public function web_admin_make_remove_liked_saved_post(Request $request){
        $post_id = base64_decode($_GET["def"])/158;
        $check_confirm = $_GET["prom"]/25; 
        
        if($check_confirm < 1000){
            $webModal = new WebUsersManagementModal;
            $saved_posts_by_user = $webModal->WebAdminRemoveSavedPostDetailseFromlist($post_id);
        }
        $request->session()->put('select_menu', 'webadmin_likessavedpost');
        return redirect()->back();

    }


    //guid lines to follow
    public function load_guidlines_post_other(Request $request){
        $request->session()->put('select_menu', 'webadmin_guidlines');
        $webModal = new WebUsersManagementModal;
        $guidance_to_create_ppost = $webModal->WebAdminLoadGuidanceToPostDetailse();
        return view('webuseradmin.guidlines.guidlines_loaded_admin',compact('guidance_to_create_ppost')); 
    }


}
