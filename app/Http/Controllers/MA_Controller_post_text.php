<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AdminAccountsModel;
use App\AdminCommonModel;

use URL;

use Session;

class MA_Controller_post_text extends Controller
{
 
	
	public function index(Request $request){
		$request->session()->put('select_menu', 'masteradmin_login');
		return view('mainadmin.loggedin.loginscreen');
	}

	public function loading_management_user_datashboard(Request $request){
		$request->session()->put('select_menu', 'masteradmin_dashboard');
		$AdminModel = new AdminAccountsModel;
		$available_summery = $AdminModel->Load_summery_of_all_info();
		return view('mainadmin.dashboard.dashboard',compact('available_summery')); 
	}

	//Load all posted posts
	public function loading_management_approvealled_postsed_list(Request $request){
		$request->session()->put('select_menu', 'masteradmin_listallposts');
		$AdminModel = new AdminAccountsModel;
		$available_listed_posts = $AdminModel->Load_listed_all_posts();
		return view('mainadmin.postsAdvertisers.listedallposts',compact("available_listed_posts"));
	}

	//Pending posts display
	public function loading_managent_not_yet_postsed_list(Request $request){
		$request->session()->put('select_menu', 'masteradmin_makeapprovalposts');

		$AdminModel = new AdminAccountsModel;
		$available_listed_posts_not_approved = $AdminModel->Load_listed_all_posts_which_not_confirm();

		return view('mainadmin.postsAdvertisers.makeapprovalposts',compact('available_listed_posts_not_approved'));
	}

	//All profiles without new acceptables
	public function amster_managent_user_profiles_list(Request $request){
		$request->session()->put('select_menu', 'masteradmin_useraccounts');

		$AdminModel = new AdminAccountsModel;
		$available_listed_advertisers = $AdminModel->Load_listed_all_advertisers_toadmin();

		return view('mainadmin.userprofiles.useraccounts',compact('available_listed_advertisers'));
	}



	//view all listed normal users to master admin
	public function all_listed_normal_users_lists(Request $rquest){

		$rquest->session()->put('select_menu', 'masteradmin_webuseraccounts');

		$AdminModel = new AdminAccountsModel;
		$available_listed_normalusers = $AdminModel->Load_listed_all_normalusers_toadmin();

		return view('mainadmin.userprofiles.normal_users_view',compact('available_listed_normalusers'));	

	}



	//All new user profiles
	public function amster_managent_pending_profiles_list(Request $request){
		$request->session()->put('select_menu', 'masteradmin_newprofilecreate');
		return view('mainadmin.userprofiles.newprofilecreate');
	}

	//All currency data
	public function master_state_check_currency_list(Request $request){
		
		$request->session()->put('select_menu', 'master_state_check_currency_list');
		$get_currency_data_from_file = file_get_contents(public_path().'/common_includes/country/currency_update.json');
		$currency_cotent_make_readable = json_decode($get_currency_data_from_file,true); 
 		
 		$base_country = $currency_cotent_make_readable["base"];
 		$countries_rates = $currency_cotent_make_readable;
 		// var_dump($countries_rates);
 		// exit();
	 	// 	$adminModel = new AdminAccountsModel;
		// $list_all_countries = $adminModel->list_all_countries_110();
 		
		// $country_with_currency = [];

		// foreach ($list_all_countries as $key) {
			
		// }

		// exit();

 		return view('mainadmin.currencydata.currencydata',compact('base_country','countries_rates'));
	}


	//Posting Rules And regulations
	public function master_create_posting_rules_regsx(Request $request){
		$request->session()->put('select_menu', 'masteradmin_rulesandregs');
		return view('mainadmin.postsAdvertisers.rulesMakeRegs');
	}

	//load Add category view
	public function master_create_post_category(Request $request){
		$adminModel = new AdminAccountsModel;
		$enc_key = $adminModel->create_aes_encryptiuon_key();
		$request->session()->put('select_menu', 'masteradmin_addcategory');
		$master_category = $adminModel->List_all_master_categories();
		$master_category_pageall = $adminModel->List_all_master_categories_master_controllerPage();
		//$master_category1 = $adminModel->List_all_categories_to_admin();
		// $master_category = json_decode($master_category1);		
		
		// for ($i=0; $i < count($master_category); $i++) { 
		// 		echo $master_category[$i]->m_c_name."<br/>";
		// 		echo $master_category[$i]->m_s_c_name."<br/>";
		// 		echo $master_category[$i]->m_s_c_com_name."<br/>";
		// 		echo $master_category[$i]->m_c_id."<br/>";
		// 		echo $master_category[$i]->m_s_c_id."<br/>";
		// 		echo $master_category[$i]->m_s_c_com_id."<br/><br/>";
		// }

		// $masterArray = [];$subMasterArray = [];$complementoryCat = [];	
		// $now_going_master = 0;$now_going_sub_master = 0;$now_going_sub_master_filter_1 = 0;					

		// foreach($master_category as $key => $value) {
		// 	$mname = $value->m_c_name;
		// 	$msname = $value->m_s_c_name;
		// 	$comname = $value->m_s_c_com_name;
		// 	$master_id = $value->m_c_id;
		// 	$sub_master_id = $value->m_s_c_id;
		// 	$sub_master_filter_1_id = $value->m_s_c_com_id;
		// 	if($master_id != $now_going_master){
		// 		$now_going_master = $master_id;
		// 		array_push($masterArray, ["mid" => $master_id]);			
		// 	}
		// 	//dd($master_id);
		// }	

		// exit();
		
		return view('mainadmin.category.master_add_category',compact("enc_key","master_category","master_category_pageall"));	
	
	}


	//load view : update user guidanc,privacy and policy detailse
	public function load_content_update_view_to_master_admin(Request $request){
		$adminModel = new AdminAccountsModel;
		$company_content_about_policy = $adminModel->local_load_all_web_content_of_company();
		$request->session()->put('select_menu', 'masteradmin_policyguidlinece');
		$dds = $company_content_about_policy;
	
		return view('mainadmin.company_common_files.policy_and_guidlines_edit',compact('dds'));	
	}

	//Load individual posts
	public function view_master_admin_company_posts(Request $request, $id){
		$post_title = base64_decode($_GET["q"]);
		$post_id = base64_decode($_GET["co"])-15480;

		if($post_id == $id){
			
			$adminModel = new AdminAccountsModel;
			$get_post_info = $adminModel->getPostsInfoViewAdmin($post_id);

			return view('mainadmin.postsAdvertisers.posts_view_page',compact('get_post_info'));

		}
		else{
			return redirect(url()->previous());
		}

	}


	//make master admin logged out
	public function master_admin_amke_logout_success(Request $daat){
		$checking_id = base64_decode($_GET["qa"])-(0.254+15985+981);
		$isLogout = $_GET["logout"];//true
		$isTrue = $_GET["tst"];//true
	
		//make logout
		if($checking_id > 1499 && $checking_id < 1551 && $isLogout && $isTrue){

		$adminModel = new AdminAccountsModel;
		$make_master_logout = $adminModel->make_master_logout_from_system();

		if($make_master_logout){
			return redirect()->route("stfprocromb980123%123Load");
		}

		}else{
			return redirect()->back();
		}

	}



	//load single profile info to master admin
	public function view_profile_info_to_admin_individual(Request $data){
		$data->session()->put('select_menu', 'masteradmin_useraccounts');
		$checking_id  = base64_decode($_GET['id']);
		$valid_id  = base64_decode($_GET['ck']);
		$text_id  = $_GET['prom'];
		$profile_id  = $_GET['gt'];


		$adminModel = new AdminAccountsModel;
		$loadprofile_info = $adminModel->Load_profile_info_on_to_see_admin($checking_id,$valid_id,$text_id,$profile_id);


		return view('mainadmin.userprofiles.single_advertisers_view',compact('loadprofile_info'));

		
	}




	//get view of promocodes
	public function get_load_view_poromo_codes(Request $request){

		$request->session()->put('select_menu', 'masteradmin_post_promo_code');

		$adminModel = new AdminAccountsModel;
		$listed_all_compnies = $adminModel->Get_companies_name_id_promocodeScreen();
		$listed_all_promos = $adminModel->make_load_all_single_promo_state();
		return view('mainadmin.promotions.promo_coded_disaply',compact('listed_all_compnies','listed_all_promos'));	
	
	}



	//Remove promo code
	public function remove_this_promocde_listed(Request $request){

		$request->session()->put('select_menu', 'masteradmin_post_promo_code');
		$adminModel = new AdminAccountsModel;
		$promocode = base64_decode($_GET["check"]);
		$delete_true = $_GET["delete"];
		$checking_code = $_GET["usck"];
		$remove_cehckd_promocode = $adminModel->remove_this_promocode_promo_fom_list($checking_code,$delete_true,$promocode);	

		return redirect()->back();

	}


	//list all categories
	public function load_listed_post_category(){

		$adminModel = new AdminAccountsModel;
		
		$all_categoruy_data = $adminModel->List_all_categories_to_admin();
    	$all_data_js = json_decode($all_categoruy_data);
    	
    	$results = [];	
	    	
	    	// foreach ($all_data_js as $value) {
	    		
	    	// 	$make_data = [
	    	// 		"categoryname" => ucfirst($value->ndl_category_name),
	    	// 		"categoryid"   => $value->ndl_category_id
	    	// 	];		
	    		
	    	// 	array_push($results, $make_data);	
	    	
	    	// };

	    return $all_data_js;		
	}

}
