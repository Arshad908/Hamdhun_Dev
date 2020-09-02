<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

use Session;

class UserCommonModel extends Model
{
    public function getLocationdetailseOfuser(){
    	
    	 $realIP = file_get_contents("https://api.ipify.org");
       
       //$realIP = $_SERVER['REMOTE_ADDR'];
       //var_dump("expression");
       $data = geoip()->getLocation($realIP);


       $codeCurrency = $data["currency"];
        
        $list_all_currency = file_get_contents("./common_includes/country/currency_update.json");
        $return_data = json_decode($list_all_currency,true);   
        $currencyrate = $return_data["rates"][$codeCurrency];

       $sessiondata = [
       	"user_location"=>base64_encode($data["iso_code"]),
       	"user_currency"=>base64_encode($data["currency"]),
        "user_convert_currency_type" => $data["currency"],  
        "this_translated_currency_value" => $currencyrate
       ];

        Session::put($sessiondata);
    }
}
