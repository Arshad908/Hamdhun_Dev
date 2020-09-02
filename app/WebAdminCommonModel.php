<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

use Session;

class WebAdminCommonModel extends Model
{
    public function getLocationdetailseOfuser(){
    	
    	$realIP = file_get_contents("https://api.ipify.org");
       
        $data = geoip()->getLocation($realIP);
       
       $data = [
       	"user_location"=>base64_encode($data["iso_code"]),
       	"user_currency"=>base64_encode($data["currency"]) 
       ];

        session($data);
    }
}
