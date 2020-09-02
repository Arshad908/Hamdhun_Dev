<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

use Session;

class AdminCommonModel extends Model
{
    public function getLocationdetailseOfuser(){
    	
    	$realIP = file_get_contents("https://api.ipify.org");
       
        $data = geoip()->getLocation($realIP);
       
       $data = [
       	"user_location"=>base64_encode($data["iso_code"]),
       	"user_currency"=>base64_encode($data["currency"]) 
       ];

        session($data);
        // echo $data["ip"]."<br/>";
        // echo $data["iso_code"]."<br/>";
        // echo $data["city"]."<br/>";
        // echo $data["state"]."<br/>";
        // echo $data["state_name"]."<br/>";
        // echo $data["postal_code"]."<br/>";
        // echo $data["lat"]."<br/>";
        // echo $data["lon"]."<br/>";
        // echo $data["timezone"]."<br/>";
        // echo $data["currency"]."<br/>";
    }
}
