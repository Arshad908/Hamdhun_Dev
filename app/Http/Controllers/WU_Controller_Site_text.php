<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Routing\Redirector;
//use Model
use App\UserAccountsModel;
use App\UserCommonModel;
use Illuminate\Support\Collection;

use DB;
use File;

class WU_Controller_Site_text extends Controller
{

    public function __construct(Request $req){
            // if(session()->get("user_location") == "" && session()->get("user_currency") == ""){
            //      $commonModel = new UserCommonModel;
            //      $data = $commonModel->getLocationdetailseOfuser();
            //      //dd(Session::all());    
            //      // echo "Ss";
            //  }
             //else{
                 
            //      echo "No";
            // }

            //var_dump( session("user_location") );

    }


    public function index(){
    	$loadConstructorFunction = $this->callAutoLoadFunctionConstructor();
    	
        return view('master.webusers.body.index');
    }

    //Load home page
    public function initial_Home_loaded(){
    	//return view('siteusers.homepage.testing_home_page_ui');
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();
        $currency = $this->load_currency_site_users_view();

        $UserAccountModel = new UserAccountsModel();
        $category_data = $UserAccountModel->User_category_load_home_page();
        $company_post_uploads = $UserAccountModel->Post_published_companies_load_home_page();
        $company_post_searchings = $UserAccountModel->Post_published_searched_results();
        $categories_side_bar = $this->load_categries_that_available_side_menue();

    	return view('siteusers.homepage.homepage',compact("category_data","company_post_uploads","currency","company_post_searchings","categories_side_bar"));
    }


    //Register User
    public function ath_register(){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();
        //create encryption key
        $userModel =   new UserAccountsModel();
        $aes_key = $userModel->create_aes_encryptiuon_key();  

        /*
        *
        Encryption
        *
        */

        // Setting
        $decode_the_aes_key = json_decode($aes_key);
        $key = $decode_the_aes_key->encryption_key;
        $ivText = $decode_the_aes_key->ivText;

        // $chiperRaw = openssl_encrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        // $ciphertext = trim(base64_encode($chiperRaw));
        // $cipherHex = bin2hex($chiperRaw);

    	//return view('siteusers.login.users_site_register',compact('aes_key'));




        return view('siteusers.login.users_site_register',compact('ivText','key')); 
    }

    //Login User
    public function ath_login(){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();

        $userModel =   new UserAccountsModel();
        $aes_key = $userModel->create_aes_encryptiuon_key();  

        /*
        *
        Encryption
        *
        */

        // Setting
        $decode_the_aes_key = json_decode($aes_key);
        $key = $decode_the_aes_key->encryption_key;
        $ivText = $decode_the_aes_key->ivText;
    	
        return view('siteusers.login.users_site_login',compact('ivText','key'));		
    }

    //load reset password screen
    public function forgot_password_load_view(){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();

        $userModel =   new UserAccountsModel();
        $aes_key = $userModel->create_aes_encryptiuon_key();  

        $decode_the_aes_key = json_decode($aes_key);
        $key = $decode_the_aes_key->encryption_key;
        $ivText = $decode_the_aes_key->ivText;

        return view('siteusers.login.user_site_forgot_password',compact('ivText','key'));
    }


    //Load screen to reset password
    public function reset_password_load_view(){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();
        $userModel =   new UserAccountsModel();
        $aes_key = $userModel->create_aes_encryptiuon_key();  

        $decode_the_aes_key = json_decode($aes_key);
        $key = $decode_the_aes_key->encryption_key;
        $ivText = $decode_the_aes_key->ivText;
        return view('siteusers.login.user_site_reset_password',compact('ivText','key'));   
    }


    //User make account active by after mail
    public function user_make_account_active_after_registration(){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();
        $request_url = $_SERVER["REQUEST_URI"];
        $result_of_data = explode("/", $request_url);
        if(sizeof($result_of_data) == 6){

            $s_code_1 = (int)base64_decode($result_of_data[4])-1598278154965;
            $s_code_2 = base64_decode($result_of_data[5]);    

            $userModel =   new UserAccountsModel();
            $account_active = $userModel->make_user_account_active($s_code_1,$s_code_2);      

            if($account_active){
                Session::flash('message', 'Account activated');
                return  redirect()->route('site_login_ext');
            }else{
                Session::flash('message', 'Please try again');
                return  redirect()->route('site_register_nw');
            }
        }else{
            Session::flash('message', 'Please check url again'); 
            return  redirect()->route('site_register_nw');
        }
         
    }


    //Load category page
    public function listed_category_page(Request $requestData){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();
        $currency = $this->load_currency_site_users_view();


        $url  = $requestData->url();
        $parameter_select = array_reverse(explode("/", $url));
        $category_name = $_GET['category'];
        $master_category_id = base64_decode($parameter_select[0])-15482657816458;

        $userModel =   new UserAccountsModel();

        $load_sub_category = $userModel->load_all_subcategory_of_master_cata($master_category_id);
        $load_master_category_advertiesments = $userModel->Load_all_master_category_posts_in_all($master_category_id);
        $categories_side_bar = $this->load_categries_that_available_side_menue();    
        return view('siteusers.posts.post_category',compact('load_sub_category','load_master_category_advertiesments','category_name','currency','categories_side_bar'));
    }


    //Load Company all posts
    public function site_load_company_advetiesments(Request $data){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();
        $currency = $this->load_currency_site_users_view();

        $userModel =   new UserAccountsModel();
        $link = explode("/", $_SERVER["REQUEST_URI"]);
        $company_name = $_GET["company"];
        
        //Load company id
        $data1 = explode("?",$link[4]);
        $company_link = base64_decode($data1[0])-1954658223564;
        $load_company_advertiesments = $userModel->Load_all_company_posts_in_all($company_link);
        $categories_side_bar = $this->load_categries_that_available_side_menue();        
        // dd($load_company_advertiesments);
        // exit();    

        return view('siteusers.posts.post_advertisers',compact("load_company_advertiesments","company_name","currency","categories_side_bar"));
    }


    //View Single Post
    public function view_single_post_adrvertise(){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();
        $currency = $this->load_currency_site_users_view();

        $post_is = base64_decode($_GET["sec"],true)-1502154-58254282;
        $from_searching = ($_GET["sect"] == 1 || $_GET["sect"] == true) ? true : false;    
        if( is_int($post_is) ){

            $userModel =   new UserAccountsModel();
            $aes_key = $userModel->create_aes_encryptiuon_key();  
            $decode_the_aes_key = json_decode($aes_key);
            $key = $decode_the_aes_key->encryption_key;
            
            $get_post_informations = $userModel->load_singal_posts_on_view_post_page($post_is,$from_searching);
            $post_basic_info = $get_post_informations["post_info"];
            $post_basic_images = $get_post_informations["post_images"];

            

            return view('siteusers.posts.post_single',compact('post_basic_info','post_basic_images','key','currency'));
        }


        //var_dump($post_is);
        //exit();

        return redirect()->route("/");
        
    }



    //Go to about us page
    public function company_about_us(){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();
        $currency = $this->load_currency_site_users_view();

        $userModel =   new UserAccountsModel();
        $load_my_aboyt_us = $userModel->load_company_about_us();

        

        return view('siteusers.company_files.aboutUs',compact('load_my_aboyt_us','currency' ));
    } 

    public function company_contact_us_saple(){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();
        $currency = $this->load_currency_site_users_view();

        $userModel =   new UserAccountsModel();
        $load_my_aboyt_us = $userModel->load_company_about_us();
        
      return view('siteusers.company_files.content',compact('load_my_aboyt_us') );  
    }

    //Load view with new currency
    public function load_type_currency_change(Request $url){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();

        $url = explode("/", url()->full());
        $currency_new_select = collect($url)->last();

        $data = [
            "user_convert_currency_type" => $currency_new_select
        ];

        $currency_trasnlated_value = $this->load_currency_equal_translate_value($currency_new_select);    
        
        session($data);

        return redirect()->back();

    }


    public function ath_make_logout(Request $request){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor(); 

        $request->session()->flush();
        return redirect()->route("user_visit_homepage");
    }


    //Go to contact us page
    public function company_contact_us(){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();
        $currency = $this->load_currency_site_users_view();

        return view('siteusers.company_files.contactUs',compact('currency'));
    } 
        
    //go to privay concat page privacy policy page
    public function company_priv_pol_terms_condition(){
        $loadConstructorFunction = $this->callAutoLoadFunctionConstructor();
        $currency = $this->load_currency_site_users_view();
        
        $userModel =   new UserAccountsModel();
        $load_my_aboyt_us = $userModel->load_company_privacy_polivy_tc();
        return view('siteusers.company_files.privay_content_terms_condition',compact('currency','load_my_aboyt_us'));
    } 


    //Category data  




    //Load currency info
    public function load_currency_site_users_view(){
        $path = '';
        $list_all_currency = file_get_contents("./common_includes/country/currency_update.json");
        $return_data = json_decode($list_all_currency,true);

        return $return_data;
    }
    //load constructor function
    public function callAutoLoadFunctionConstructor(){
        if(session()->get("user_location") == "" && session()->get("user_currency") == ""){
                 $commonModel = new UserCommonModel;
                 $data = $commonModel->getLocationdetailseOfuser();
                 //dd(Session::all());    
        }
    }
    //Load new currency values
    public function load_currency_equal_translate_value($newCurrencyCode){
        
        $codeCurrency = $newCurrencyCode;
        
        $list_all_currency = file_get_contents("./common_includes/country/currency_update.json");
        $return_data = json_decode($list_all_currency,true);   
        $currencyrate = $return_data["rates"][$codeCurrency];

        //create session to store the tanslate value
        $data = [
            "this_translated_currency_value" => $currencyrate 
        ]; 

        session::put($data);
    }
    //load cateorties to main side bar 
    public function load_categries_that_available_side_menue(){
        $commonModel = new UserAccountsModel();
        $data = $commonModel->load_categories_to_side_menue();
        return $data;
    }

    

}
