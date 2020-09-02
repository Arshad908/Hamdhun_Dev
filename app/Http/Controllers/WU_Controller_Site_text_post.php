<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Blocktrail\CryptoJSAES\CryptoJSAES;
//use Defuse\Crypto\Crypto;
//use Defuse\Crypto\Key;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;

use Illuminate\Support\Facades\Hash;

require __DIR__.'/cryptojs-aes.php';

use Illuminate\Support\Facades\Mail;

//use Model
use App\UserAccountsModel;
use App\UserCommonModel;



class WU_Controller_Site_text_post extends Controller
{


    public function __construct(Request $req){
            if(session("user_location") == "" && session("user_currency") == ""){
                $commonModel = new UserCommonModel;
                $data = $commonModel->getLocationdetailseOfuser();
            }
    }


    public function make_new_user_registrations(Request $request)
    {

        $added_new_user = "";
    	$actual_values_from_view = ['first_name','last_name','email','password'];
    	$readable_values['first_name'] = "";
    	$readable_values['last_name'] = "";
    	$readable_values['email'] = "";
    	$readable_values['password'] = "";
	   	
    	$user_register_model = new UserAccountsModel();	

    	$user_data['first_name'] = $request->first_name;
    	$user_data['last_name'] = $request->last_name;
    	$user_data['email'] = $request->user_email;
    	$user_data['password'] = $request->user_password;
    	$token_aes_encryption = $request->user_sec_token;
 

			$cipher ="AES-256-CBC";
			$encoding_pattern = "ASCII";
		    $key = session('enc_key');
			$ivHex = $request->user_sec_token;
			$iv = hex2bin($ivHex);

			$readable_values_from_controller = array();

    		for ($i = 0 ; $i < sizeof($user_data) ; $i++) { 
    		        
                    $er = cryptoJsAesDecrypt($token_aes_encryption,$user_data[$actual_values_from_view[$i]]);  
            		array_push($readable_values_from_controller, $er);	

    		
    		}

    		$data_save_to_model = $user_register_model->user_registration($readable_values_from_controller);  
            
            if($data_save_to_model['status'] == 200){

                $added_new_user = [
                    "status" => 200,
                    "message" => "We will send you mail shortly" 
                ];

                $userData = "Arshad"; 
                $to = $readable_values_from_controller[2]; 
                $date = [
                    "firstName" => $readable_values_from_controller[0],
                    "enc_type_65" => $data_save_to_model["message_account_confirm"]["active_token"],
                    "enc_type_13" => $data_save_to_model["message_account_confirm"]["remember_token"],
                ];

                $mail = Mail::send('email_templates.accounts.user_register_site_confirmation2',["date"=>$date], function($message) use ($to)
                {
                    $message->subject('Verify account');
                    $message->from('helpmenewacc123@gmail.com', 'noyel.com');
                    $message->to($to);
                });  

            }else if($data_save_to_model['status'] == 320){

                $added_new_user = [
                    "status" => 500,
                    "message" => "Please try again" 
                ];

            }

            
        return $added_new_user;    
    }


    function ath_login_web_users(Request $request){
     
     //   $rules = array(
     // 'email' => 'required|email', // make sure the email is an actual email
     // 'password' => 'required|alphaNum|min:8'
     //  password has to be greater than 3 characters and can only be alphanumeric and);
     //  checking all field
     // $validator = Validator::make(Input::all() , $rules);
     
     // if the validator fails, redirect back to the form
      // if ($validator->fails())
      //  {
      //  return Redirect::to('login')->withErrors($validator) // send back all errors to the login form
      //  ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
      //  }
      //  else
      //  {

        $actual_values_from_view = ['email','password'];


        $user_data['email'] = $request->user_email;
        $user_data['password'] = $request->user_password;
        $token_aes_encryption = $request->user_sec_token;

        $readable_values_from_controller = array();

        for ($i = 0 ; $i < sizeof($user_data) ; $i++) { 
        
            $er = cryptoJsAesDecrypt($token_aes_encryption,$user_data[$actual_values_from_view[$i]]);  
           // var_dump("Data " .$er);
            array_push($readable_values_from_controller, $er);
        
        }        
        // create our user data for the authentication
       $send_user_login_data = array(
          // 'email' => Input::get('email') ,
          // 'password' => Input::get('password')
          // 'email' => $readable_values_from_controller[0],
         //  'password' => bcrypt($readable_values_from_controller[1])
            "email" =>  $readable_values_from_controller[0],
            "password" => $readable_values_from_controller[1]
        );
        $user_register_model = new UserAccountsModel(); 
        $return_login_results  =  $user_register_model->user_make_login_to_site($send_user_login_data);
        //$return_login_results  =  $user_register_model->user_make_login_to_site($readable_values_from_controller);
        //var_dump($return_login_results);
        //exit();
        // attempt to do the login
        $send_user_login_data1 = array(
            "email" =>  $readable_values_from_controller[0],
            "password" => bcrypt($readable_values_from_controller[1])
        );

        // Mail::raw('Sending emails with Mailgun  is easy!', function($message)
        // {
        //     $message->subject('Mailgun a are awesome!');
        //     $message->from('adleen786@gmail.com', 'Website Name');
        //     $message->to('helpmenewacc123@gmail.com');
        // });




        return json_encode($return_login_results);
        //Start : Auth function
        // if (Auth::attempt($send_user_login_data1)){
        //     var_dump($return_login_results);
        //   if($return_login_results)
        //   {
        //   //return Redirect::to('InitialSiteLoaded');
        //     return redirect()->route('InitialSiteLoaded');
        //   }
        //   else
        //   { 
        //   var_dump($return_login_results);  
        //   // validation not successful, send back to form
        //   return redirect()->route('site_login_ext');
        //   }
        // }else{
        //     $current_encoding = mb_detect_encoding($send_user_login_data["email"], 'auto');
        //     var_dump($current_encoding);
        //     $text = iconv($current_encoding, "UTF-8", $send_user_login_data["email"]);
        //     //$errr = mb_convert_encoding($send_user_login_data["email"],"UTF-8");
        //     var_dump(mb_detect_encoding($text, 'auto'));
        // }
        //End : Auth function

    }


    //Forgot password : check email exist
    public function check_user_email_exists(Request $requesting){
        $email  =  $requesting->forgot_email;
        $enc_token = $requesting->user_sec_token;

        $readable_values_from_controller = array();

        for ($i = 0 ; $i < 1 ; $i++) { 
        
            $er = cryptoJsAesDecrypt($enc_token,$email);  
           // var_dump("Data " .$er);
            array_push($readable_values_from_controller, $er);
        
        }

        $user_register_model = new UserAccountsModel(); 
        $return_login_results  =  $user_register_model->user_check_email_available_site($readable_values_from_controller);
        
        $message_about_forgot_password;
        
        if($return_login_results == false){
            $message_about_forgot_password = [
                "status" => 524,
                "message" => "User not valid." 
            ];
        }else{
            $message_about_forgot_password = [
                "status" => 246,
                "message" => "User valid." 
            ];

            //Reset password values
            $data_to_reset = [
                 "token" => $return_login_results[0],
                 "token2" => $return_login_results[1],   
            ];

            Mail::send('email_templates.accounts.user_register_site_forgot_password',["date"=>$data_to_reset], function($message)
            {
                    $message->subject('Forgot password');
                    $message->from('adleen786@gmail.com', 'noyel.com');
                    $message->to('helpmenewacc123@gmail.com');
            }); 

        }

        return json_encode($message_about_forgot_password);    
    }


    //Password reset screen
    public function confirm_user_email_register(Request $rewq){
        $email = $rewq->user_password;
        $enc_token = $rewq->user_sec_token;
        $source_path = $rewq->path;

        $readable_values_from_controller = array();

        for ($i = 0 ; $i < 1 ; $i++) { 
        
            $er = cryptoJsAesDecrypt($enc_token,$email);  

            array_push($readable_values_from_controller, $er);
            array_push($readable_values_from_controller, $source_path);
        
        }

        $user_register_model = new UserAccountsModel(); 
        $return_reset_password_results  =  $user_register_model->user_confirm_password_reseton_site($readable_values_from_controller);

        return $return_reset_password_results;
        

    }

    //Site user make posts like
    public function site_users_like_the_posts_update_posts(Request $Postsrequest){
        
        $data_get = $Postsrequest->like_update_post;
        $data_base = base64_decode($Postsrequest->base_code);

        $data = cryptoJsAesDecrypt($data_base,$data_get);
        
        $user_register_model = new UserAccountsModel(); 
        $liked_status  =  $user_register_model->make_user_like_this_posts_addvertise($data);  

        return json_encode($liked_status);

    }


    //User searching results
    public function searching_results_from_data(Request $reqSeaching){
        
        $input_data = $reqSeaching->input("product_searching");
        // var_dump($input_data);
        // exit();
        $user_register_model = new UserAccountsModel(); 
        $searching_status  =  $user_register_model->user_searching_data_from_filter($input_data);  
        $currency = $this->load_currency_site_users_view();
        $categories_side_bar = $this->load_categries_that_available_side_menue();
        return view('siteusers.posts.post_searching_results',compact('searching_status','currency','categories_side_bar'));


    }



    //This is not use. use to testing purpose.
    function user_registration1(){
        $ss = array("halo");
        $user_register_model = new UserAccountsModel(); 
        $user_register_model->user_registration($ss);
    }



    //Load currency info
    public function load_currency_site_users_view(){
        $path = '';
        $list_all_currency = file_get_contents("./common_includes/country/currency_update.json");
        $return_data = json_decode($list_all_currency,true);

        return $return_data;
    }
    //load cateorties to main side bar 
    public function load_categries_that_available_side_menue(){
        $commonModel = new UserAccountsModel();
        $data = $commonModel->load_categories_to_side_menue();
        return $data;
    }
}
