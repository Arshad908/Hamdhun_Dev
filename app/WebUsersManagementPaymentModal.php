<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Redirector;


class WebUsersManagementPaymentModal extends Model
{
    public function check_user_has_pending_payment_on_posted_ads(){
    	
    	$select_all_posts_counts = DB::table("t_user_post_details")
    								->select(DB::raw('count(company_id) as post_count'),"company_id")
    								->groupBy("company_id")
    								->where("approved_status",95)
    								->where("active_state_post",110)
    								->get();
    	
    	if(count($select_all_posts_counts) > 0){
    		
    		foreach ($select_all_posts_counts as $key => $value) {
    			$to_pay = 0.00;
    			$com_id = $value->company_id;
    			if($value->post_count < 11){
    				$to_pay = 3;
    			}elseif($value->post_count > 10 && $value->post_count < 151){
    				$to_pay = 2.5;
    			}elseif($value->post_count > 150 && $value->post_count < 301){
    				$to_pay = 2;
    			}elseif($value->post_count > 300 && $value->post_count < 1501){
    				$to_pay = 1.5;
    			}elseif($value->post_count > 1500){
    				$to_pay = 1;
    			}
    			//t_user_make_payment
    			$data_insert = [
    				
    			];

    			$processd  = DB::table("t_user_make_payment")
    							->updateOrInsert(
    								["company_id" => $com_id ],
    								[   "active_posts_count" =>  $value->post_count,
					    				"payment_amount" => $to_pay,
					    				"paid_status" => 10,
					    				"promocode_offer" => 0,
					    				"refund_amount" => 0,
					    				"created_date" => date("Y-m-d h:i:s")
					    			] 
    							);

    		}
    	}							


    	// $any_pending = DB::table("t_user_make_payment")
    	// 				->select("paid_status as pdstate","payment_amount as pdtopay")
    	// 				->where("company_id",$company_id)
    	// 				->get();	

    	// $to_pay_status = 0; 
    	// $to_pay_amount = "";				
    	// if(count($any_pending) > 0 ){				
	    // 	foreach ($variable as $key => $value) {
	    // 		$to_pay_amount = $value->pdtopay;
	    // 		$to_pay_status = 1; 	
	    // 	}			
	    // }

	    // $return_data = [
	    // 	"status" => $to_pay_status,
	    // 	"amount" => $to_pay_amount,
	    // ];			

	    //return $return_data;	
    	
    }	
}
