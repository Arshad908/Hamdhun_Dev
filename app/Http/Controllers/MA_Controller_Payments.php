<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\WebUsersmanagementPaymentModal;


class MA_Controller_Payments extends Controller
{

	//check the pending payment state of companies
    public function check_what_are_the_pending_post_companies(){
    	
    	$webuserpaymentmodal = new WebUsersmanagementPaymentModal();
    	$check_pending_state = $webuserpaymentmodal->check_user_has_pending_payment_on_posted_ads();

    	return $check_pending_state; 

    }
}
