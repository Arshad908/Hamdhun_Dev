<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    return view('welcome');
});



//Web Users
//Route::get('/s/s/s','WU_Controller_Site_text@index');










//Web Admin
Route::get('/chblsapdost/nwcontcr/wbussummerize','WA_Controller_post_text@index')->middleware("webadmin")->name("loaddashboardscreen");
Route::get('/chblsapdost/nwconloguser/checkloggedinstatus','WA_Controller_post_text@check_user_loggedin')->middleware("webadmin")->name("userloggedinscreen");
Route::get('/chblsamakepdost/nwconlogoffcompanyuser/usermakepostmartink','WA_Controller_post_text@load_user_create_postPage')->middleware("webadmin")->name('loadwebadminCreatePostPage');
Route::get('/chblsamakepdost/nwmthdcheckcompanyuserinfo/suerprofileinfoupdateatr','WA_Controller_post_text@user_update_prodile_info')->middleware("webadmin")->name('updateuserprofiledatainweb');
Route::get('/sdmskmakepdost/checkcompanyuserpostedinfo/fulleprofileinfoupdatepost','WA_Controller_post_text@user_showall_posted_info')->middleware("webadmin")->name('checkmyuploadedlistpost');
Route::get('/Splolkshrsvpos/viewlikeswithsaved/uservisiblelikesaveposts','WA_Controller_post_text@load_liked_and_save_post')->middleware("webadmin")->name('webadminuserlikeandsaved');
Route::get('/hwhlpsptdwlid/checkvalidypost/guidlines to floow','WA_Controller_post_text@load_guidlines_post_other')->middleware("webadmin")->name('updateuserhowtopost_guidlines');
Route::get('/activation_helper/single_promotions/promocde_update','WA_Controller_post_text@activate_monthly_promocodes_wdmin')->name('user_activate_prmoto_code')->middleware("webadmin");
Route::get("/post_display/display_count/{user_have_to_pay}","WA_Controller_post_text@make_user_pending_monthly_rewn_charge")->name("payment.post_display_payment_pay")->middleware("webadmin");//user can use this url just for fun. So make some get inputs to validate actually have payments to pay
Route::get('/advertiestment/display_view/{operation_name}','WA_Controller_post_text@web_admin_uploaded_post_update')->name('webadmin_make_post_edit')->middleware('webadmin');
Route::get('/advertiestment/display_remove /{operation_name}','WA_Controller_post_text@web_admin_make_remove_liked_saved_post')->name('webadmin_make_post_liked_remove')->middleware('webadmin');


Route::post("/user_web/new_post_category/upload_new_post","WA_Controller_post_text_post@upload_user_post_new_addintions")->name("make_user_upload_posts_new_market")->middleware("webadmin");
Route::post("/user_web/user_profile/updtae_user_profile_information","WA_Controller_post_text_post@updated_user_profile_mk_changes")->name("update_user_profile_info")->middleware("webadmin");
Route::post("/user_web/user_profile/updtae_user_profile_infocrmation","WA_Controller_post_text_post@updated_user_profile_mk_changes_company_detailse")->name("update_user_profile_info_if_company")->middleware("webadmin");
Route::post("/user_web/user_profile/update_user-card_info","WA_Controller_post_text_post@make_update_user_card_info")->name("update_user_profile_card_information")->middleware("webadmin");
Route::post('/user_web/posts/updated_post',"WA_Controller_post_text_post@make_post_to_updated_")->name('make_user_upload_posts_updated_content_market')->middleware('webadmin');
Route::post("/payment/Card_payments/save_primary_card","WA_Controller_post_text_post@card_make_primay_web_admin")->name("make_selected_as_primary_card")->middleware("webadmin");


















//Master Admin
Route::get('/prdsoladmin/stsanmsfoldaccs/spramnlogin','MA_Controller_post_text@index')->name('stfprocromb980123%123Load');
Route::get('/prdsoladmin/stsanmsfoldaccssystlosg/spramnmake_dashboard_status','MA_Controller_post_text@loading_management_user_datashboard')->name('stfprocrombload_dashboard_amster_admin')->middleware("masteradmin");
Route::get('/prdsystrecadmin/stsanmsprosetlistedposts/sprssrslklitedposts','MA_Controller_post_text@loading_management_approvealled_postsed_list')->middleware("masteradmin")->name('stfprocromb_checkApprposts');
Route::get('/prdsystrecadmin/stsanmsprosetlistedinrowposts/sprssrslprocessposts','MA_Controller_post_text@loading_managent_not_yet_postsed_list')->middleware("masteradmin")->name('stfprocromb_checkprocessposts');
Route::get('/ssurswhtusaccnchk/stsmngvgnchkcuseraccount/parseuserdetailsecheck','MA_Controller_post_text@amster_managent_user_profiles_list')->middleware("masteradmin")->name('stftrckjik_checklistedallclients');
Route::get('/ssurswhtusaccnchk/stsmngvgnchkcusernewaccount/parseuserapproverlntdetailsecheck','MA_Controller_post_text@amster_managent_pending_profiles_list')->middleware("masteradmin")->name('stftrckjik_checklistedallnotyetapprovedclients');
Route::get('/schuked_all_/listed_users/view_normal_users','MA_Controller_post_text@all_listed_normal_users_lists')->name('stftrckjik_checklistedallormalusers')->middleware('masteradmin');
Route::get('/mastercurrecycheck/userstatecurrencyupdate/loadcountryupdate','MA_Controller_post_text@master_state_check_currency_list')->middleware("masteradmin")->name('stftrckchatclient_clients');
Route::get('/posts/sync_posts/howtoCreatePosts','MA_Controller_post_text@master_create_posting_rules_regsx')->middleware("masteradmin")->name('addNewRulesdanrexg');
Route::get('/posts/user_posts/mcategoryloadcreateposts','MA_Controller_post_text@master_create_post_category')->middleware("masteradmin")->name('addmastercategoryview');
Route::get("/posts/user_posts/mcategoryloadcreateposts_master","MA_Controller_post_text@load_listed_post_category")->middleware("masteradmin")->name("site_make_load_saved_categories");
Route::get('/posts/user_posts/make_content_update_guideanceandpoilicy',"MA_Controller_post_text@load_content_update_view_to_master_admin")->middleware("masteradmin")->name("web_site_user_content_updated");
Route::get("/posts/company_uploaded_posts/view/{id}","MA_Controller_post_text@view_master_admin_company_posts")->name("view_individual_load_post")->middleware("masteradmin");
Route::get('/users/make_easy_to_use/promotions_update','MA_Controller_post_text@get_load_view_poromo_codes')->name('loadview_.promocodeview')->middleware('masteradmin');
Route::get("/post/make_violance/delete_post","MA_Controller_post_text_post@make_post_remove_from_the_list")->name('single_delete_list_post_list')->middleware('masteradmin');
Route::get('/profile_info/check/advertiser',"MA_Controller_post_text@view_profile_info_to_admin_individual")->name('view_user_profile_info_to_MA')->middleware('masteradmin');
Route::get("/promocode/ checking_promocode/update","MA_Controller_post_text@remove_this_promocde_listed")->name("remove_this_promo_codes_from_lst")->middleware("masteradmin");
Route::get("/logout/checkPrams/makelogout","MA_Controller_post_text@master_admin_amke_logout_success")->name('master_user_make_log_out')->middleware("masteradmin");




Route::get("/KJHJKS&_3434","MA_Controller_post_currency@serch_save_currency");
Route::get("/KJHJKJHGJHKG6785675hgfhg65hggh","MA_Controller_post_currency@save_currency_iso_code_of_contry");



Route::post('/admin/post/admin_add_post_category','MA_Controller_post_text_post@add_category_list_dms')->middleware("masteradmin")->name("add_admin_category_ms_category");
Route::post('/noydlSolid_admin/MA_master_admin/check_user_login/{data}','MA_Controller_post_text_post@master_admin_make_user__login')->name("make_master_admin_login");
Route::post('/admin/post/single_admin_add_post_category','MA_Controller_post_text_post@add_category_list_dms_single_add')->middleware("masteradmin")->name("single_master_add_admin_category_ms_category");
Route::post("/admin/post_create/add_more_sub_more-category","MA_Controller_post_text_post@add_more_sub_more_category_data")->middleware("masteradmin")->name("add_admin_category_ms_more_category");
Route::post("/admin_make_/about-us/change","MA_Controller_post_text_post@about_us_content_change_admn")->middleware("masteradmin")->name("add_admin_about_us_content");
Route::post("/admin_make_/privacy_content-us/change","MA_Controller_post_text_post@privacy_content_update")->middleware("masteradmin")->name("add_admin_privacy_and_content");
Route::post("/admin/posts/how_to_make_a_post","MA_Controller_post_text_post@advertising_policy_how_to_update")->name('add_admin_advertising_poicy_update')->middleware('masteradmin');
Route::post("/admin_make/posts_update/update_posts","MA_Controller_post_text_post@make_post_approved_status")->name("make_adverttise_to_public")->middleware("masteradmin");
Route::post('use/promocodes/addnew','MA_Controller_post_text_post@make_user_promocode_creatd')->name('add_promocode.saveit')->middleware('masteradmin');
Route::post("/post_uploaded/check/approval/{operation_type}","MA_Controller_post_text_post@make_bulk_post_apporal_or_reject_check")->name("make_approval_bulk_checked")->middleware("masteradmin");
Route::post("category/master_category/makeChangesOnCategory","MA_Controller_post_text_post@make_changes_on_category_master")->name("make_chamges_on_master_category")->middleware("masteradmin");
Route::post("category/master_sub_category/makeChangesOnCategorySub","MA_Controller_post_text_post@make_changes_on_category_master_sub")->name("make_chamges_on_sub_master_category")->middleware("masteradmin");
Route::post("category/master_csub_category/makeChangesOnCategoryCSub","MA_Controller_post_text_post@make_changes_on_category_master_complementory")->name("make_chamges_on_csub_master_category")->middleware("masteradmin");












//Web Site
Route::get('/','WU_Controller_Site_text@initial_Home_loaded')->name('user_visit_homepage');
Route::get('/CHome_HandlingKase/advertiestments/search','WU_Controller_Site_text@initial_Home_loaded')->name('InitialSiteLoaded');
Route::get('/advertisers/MDLLatestupdate/selectionposts')->name('load_LDDTCM_home_page');
Route::get('/categoryselect_category/MDLcategoryselect/u_Categorymasterchoose/{master_id}','WU_Controller_Site_text@listed_category_page')->name('categorypage_LDDTCM_categoryposts_page');
Route::get('/advertisers_Select_advertiser/MDLadvistersselect/u_Advertiserschoose/{company_id}','WU_Controller_Site_text@site_load_company_advetiesments')->name('advertisers_LDDTCM_view_advertisers');
Route::get('/advertisers/MDLLatestupdate/selectionposts')->name('load_LDDTCM_home_page');
Route::get('/search_advertsisings/oprtions/searching_results')->name("search_LDDTCM_search_results_advertise");
Route::get('/advertisersList/category_post/check_post_example_name/{post_name_title}','WU_Controller_Site_text@view_single_post_adrvertise')->name('single_advetrtisers');
Route::get('/sietname_profile/detailse/aboutus','WU_Controller_Site_text@company_about_us')->name('aboutUsLoad');
Route::get('/sietname_profile/detailse/terms and condition','WU_Controller_Site_text@company_priv_pol_terms_condition')->name('termsandconprpLoad');
Route::get('/sietname_profile/detailse/contactuss','WU_Controller_Site_text@company_contact_us_saple')->name('aboutUsLoadContentsample');
Route::get('/sietname_profile/detailse/contactus','WU_Controller_Site_text@company_contact_us')->name('contactUsLoad');
Route::get('/sietname_profile/accounts/signup','WU_Controller_Site_text@ath_login')->name('site_login_ext');
Route::get('/sietname_profile/accounts/signout','WU_Controller_Site_text@ath_make_logout')->name('site_logout');
Route::get('/noyel%user_profile%/accounts/signin','WU_Controller_Site_text@ath_register')->name('site_register_nw');
Route::get('/noyel_user_profile/accounts/forgotpassword','WU_Controller_Site_text@forgot_password_load_view')->name('site_reset_password_view');
Route::get('/noyel_user_profile/accounts/iamsuretorest/{user}/{passPk}','WU_Controller_Site_text@reset_password_load_view')->name('site_reset_load_password_view');
Route::get('/noyel_user_profile/accounts/active_account/{userKey}/{passPrasePk}','WU_Controller_Site_text@user_make_account_active_after_registration')->name('site_make_confirm_account_active');
Route::get('/currency/transfer_load/{currency_type}',"WU_Controller_Site_text@load_type_currency_change")->name("select_currency_type");
//Paypal
Route::get('pay/paypal','Payamountpaypal@index_load_page')->name("paypalloadingpage");



Route::post('/nltocomplay','WU_Controller_Site_text_post@make_new_user_registrations')->name('make_new_user_register');
Route::post('/nltogetuserlaod','WU_Controller_Site_text_post@ath_login_web_users')->name('make_user_register_loging');
Route::post('/checkuser/available_user','WU_Controller_Site_text_post@check_user_email_exists')->name('check_email_availabily_reset');
Route::post('/checkuser/available_user_reset/password','WU_Controller_Site_text_post@confirm_user_email_register')->name('confirm_user_password_reset');
Route::post("/advertisers/posts_update/like_select_post","WU_Controller_Site_text_post@site_users_like_the_posts_update_posts")->name("site_user_liked_this_post");
Route::post('products/searching/filter_data',"WU_Controller_Site_text_post@searching_results_from_data")->name('userFilterResultsSesarching');
//Paypal
Route::post("/payment/add-funds/paypal","Payamountpaypal@payWithpaypal")->name("paywithpaypal");


Route::get('/get',function(){
	return "Done";
})->name('payment.success');
Route::get('/no',function(){
	return "Failed";
})->name('payment.cancel');
Route::get('/pass','Payamountpaypal@payment')->name('payment.cancel');



//Some external urls {Very important}

/*Add a middle where check auth,id, and some other to vallidate only can do for master admin*/
Route::get('/check/site_user__pending_post/payments_get_pending','MA_Controller_Payments@check_what_are_the_pending_post_companies')->name('company.pending_payment_check');










//Cron jobs

/*
	Needed cron job for 
		1. Currency update : done
		2. Payment check : pending
		3. Expired post finding : pending
		4. Monthly check how much wanted to pay : pending
*/
Route::get('/price_calculation/currency/latest_update','MA_Autumatated_functionController@apicurrencyconverter')->name('currency.load_updated_currency_info')->middleware("masteradmin");










































Route::post('/convert','currencyconvertcontroller@index');
Route::get('/geo','currencyconvertcontroller@geo_ip');
Route::get('/current','currencyconvertcontroller@apicurrencyconverter');
Route::get('/pay','currencyconvertcontroller@form_pay_load');
Route::post('/makepayment','currencyconvertcontroller@paytheamount')->name('payamount');
Route::get('/test_the_codes','currencyconvertcontroller@testing_commands')->name('testingRoute');





Route::get('/reg','WU_Controller_Site_text_post@user_registration1');
Route::get('/1234', function () {
    return view('email_templates.promotion.user_admin_promotion_temp');
});

