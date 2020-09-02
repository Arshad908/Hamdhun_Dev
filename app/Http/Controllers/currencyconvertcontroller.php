<?php

namespace App\Http\Controllers;
//namespace App\GeoIP\Services;

use Illuminate\Http\Request;
use Currency;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
//use ExchangeRate;
use Carbon\Carbon;
//use Torann\GeoIP\GeoIp;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use File;
use DB;


class currencyconvertcontroller extends Controller
{
    public function index(Request $req){
    	$value = $req->input('amount');
    	$from = $req->input('from');
    	$to = $req->input('to');
    	$valueLKR = Currency::conv($from = 'LKR', $to = 'USD', $value = 1000, $decimals = 2);

    	$exchangeRates = new ExchangeRate();
		$e = $exchangeRates->convert(1, 'USD', 'INR',Carbon::now());

    	echo $e;
    	//return ExchangeRate::currencies();
    }


    



    public function geo_ip(){

        //$client = new \GuzzleHttp\Client();
        //$request = $client->get('https://api.ipify.org');
        $realIP = file_get_contents("https://api.ipify.org");
        //$response = $request->getBody();
        $public_ip_address =  $_SERVER['REMOTE_ADDR'];

        //echo $realIP;

        //$data = [];
        $data = geoip()->getLocation($public_ip_address);
        echo $data["ip"]."<br/>";
        echo $data["iso_code"]."<br/>";
        echo $data["country"]."<br/>";
        echo $data["city"]."<br/>";
        echo $data["state"]."<br/>";
        echo $data["state_name"]."<br/>";
        echo $data["postal_code"]."<br/>";
        echo $data["lat"]."<br/>";
        echo $data["lon"]."<br/>";
        echo $data["timezone"]."<br/>";
        echo $data["currency"]."<br/>";
        

        //Currency
        $all_currencies = 
        [

"GBP",
// "AUD",
// "CAD",
// "JPY",
// "CHF",
// "KMF",
// "AFN",
// "ALL",
// "DZD",
// "AOA",
// "ARS",
// "AMD",
// "AWG",
// "AZN",
// "BSD",
// "BHD",
// "BDT",
// "BBD",
// "BYN",
// "BZD",
// "BOB",
// "BAM",
// "BWP",
// "BRL",
// "BND",
// "BGN",
// "BIF",
// "KHR",
// "CVE",
// "XAF",
// "XPF",
// "CLP",
// "CNY",
// "COP",
// "CDF",
// "CRC",
// "HRK",
// "CUP",
// "CZK",
// "DKK",
// "DJF",
// "DOP",
// "XCD",
// "EGP",
// "ERN",
// "ETB",
// "FJD",
// "GMD",
// "GEL",
// "GHS",
// "GIP",
// "GTQ",
// "GNF",
// "GYD",
// "HTG",
// "HNL",
// "HKD",
// "HUF",
// "ISK",
// "INR",
// "IDR",
// "IRR",
// "IQD",
// "ILS",
// "JMD",
// "JOD",
// "KZT",
// "KES",
// "KWD",
// "KGS",
// "LAK",
// "LVL",
// "LBP",
// "LSL",
// "LRD",
// "LYD",
// "LTL",
// "MOP",
// "MKD",
// "MGA",
// "MWK",
// "MYR",
// "MVR",
// "MRO",
// "MRU",
// "MUR",
// "MXN",
// "MDL",
// "MNT",
// "MAD",
// "MZN",
// "MMK",
// "NAD",
// "NPR",
// "ANG",
// "TWD",
// "TMT",
// "NZD",
// "NIO",
// "NGN",
// "NOK",
// "OMR",
// "PKR",
// "PAB",
// "PGK",
// "PYG",
// "PEN",
// "PHP",
// "PLN",
// "QAR",
// "RON",
// "RUB",
// "RWF",
// "SVC",
// "WST",
// "STN",
// "SAR",
// "RSD",
// "SCR",
// "SLL",
// "SGD",
// "SBD",
// "SOS",
// "ZAR",
// "KRW",
// "SSP",
// "LKR",
// "SDG",
// "SRD",
// "SZL",
// "SEK",
// "SYP",
// "TJS",
// "TZS",
// "THB",
// "TOP",
// "TTD",
// "TND",
// "TRY",
// "AED",
// "UGX",
// "UAH",
// "UYU",

        ];

        date_default_timezone_set('Asia/Colombo');
        echo date("h:i:sa")."<br/>";

        foreach ($all_currencies as $key ) {
            
            $_currency = file_get_contents("http://www.floatrates.com/daily/".$key.".json");
                
            $client = new \GuzzleHttp\Client();
            $request = $client->get("http://www.floatrates.com/daily/".$key.".json");
            //$realIP = file_get_contents("https://api.ipify.org");
            $response = $request->getBody();    
            //var_dump($response);
            $encode = json_decode($response);
            // //echo $response;
             $file = fopen('currency/'.$key.".json", "w");
            fwrite($file, $response);
            fclose($file);
            for ($i=0; $i < 250; $i++) { 
             // echo $_currency[$i];
            }
            //echo $_currency;
            // Get the contents of the JSON file 
            $strJsonFileContents = file_get_contents('currency/GBP.json');
            // Convert to array 
            //$arrMatches = explode('// ', $strJsonFileContents); // get uncommented json string
            $arrJson = json_decode($strJsonFileContents,true); // decode json
            $price = $arrJson;
            // foreach ($price as $key => $value){
            //   echo  $key . ':' . $value;
            // }
            // foreach ($arrJson as $character) {
            //     echo $character["name"] . '<br>';
            // }
             echo "<br/>";
            // var_dump($arrJson["usd"]["code"]);
             echo "<br/>";
            //$array = json_encode($strJsonFileContents, true);
            //var_dump($array); // print array



       $myFile = 'currency/GBP.json';
       $arr_data = array();      
             // 
                 //Get data from existing json file
       $jsondata = file_get_contents($myFile);

       // converts json data into array
       $arr_data = json_decode($jsondata, true);

       // Push user data to array
       array_push($arr_data,$jsondata);

       //Convert updated array to JSON
       $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);

       //write json data into data.json file
       if(file_put_contents($myFile, $jsondata)) {
          //  echo 'Data successfully saved';
        }
         


        $strJsonFileContentsNew = file_get_contents('currency/GBP.json'); 
        $endoce = json_decode($strJsonFileContentsNew,true);
        var_dump($endoce["usd"]['rate']);
        
        //fopen('./currency/'.$key.".txt", mode);

        

        echo date("h:i:sa")."<br/>";
        

    }

    }


    public function apicurrencyconverter(){
      // set API Endpoint, access key, required parameters
      //https://fixer.io/documentation
      $endpoint = 'latest';
      //$access_key = 'f2b2a5f2a25ecf0642e2f6302cbac282';
      $access_key = env('CC_FIXERIO_ACCESS_KEY');
      $from = 'USD';
      $to = 'EUR';
      $amount = 10;

      // initialize CURL:
      $ch = curl_init('http://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'&from='.$from.'&to='.$to.'&amount='.$amount.'');   
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      // get the JSON data:
      $json = curl_exec($ch);
      curl_close($ch);

      // Decode JSON response:
      $conversionResult = json_decode($json, true);

      // access the conversion result
      //var_dump($conversionResult);

      $file = 'currency_update.json';
      $destinationPath=public_path()."/common_includes/country/";
      
      if (!is_dir($destinationPath)) {  
        mkdir($destinationPath,0777,true);  
      }
      // $openCurrencyFile = fopen("./common_includes/country/".$file, 'a');
      // fwrite($openCurrencyFile, json_encode($conversionResult));
      // fclose($openCurrencyFile);
      File::put($destinationPath.$file,json_encode($conversionResult));

    }


    //Strinpe form view load
    public function form_pay_load(){
      return view('siteusers.user_subscription_form.user_subscription_form_fill');
    }

    //Stripe form submit
    public function paytheamount(Request $request){

    \Stripe\Stripe::setApiKey ( 'sk_test_KqtIvgGSM47kdseTpr6OKhQJ' );
    
        try {
            \Stripe\Charge::create ( array (
                    "amount" => 300 * 100,
                    "currency" => "usd",
                    "source" => $request->input ( 'stripeToken' ), // obtained with Stripe.js
                    "description" => "Test payment One." 
            ) );
            Session::flash ( 'success-message', 'Payment done successfully !' );
            return Redirect::back ();
        } catch ( \Exception $e ) {
            Session::flash ( 'fail-message', "Error! Please Try again." );
            return Redirect::back ();
        }

    }



    public function testing_commands(){
      $company_id = DB::table('t_user_account_profile_data')
                        ->max('company_id');

      echo __DIR__ ."<br/>". __FILE__ ."<br/>". __FUNCTION__ ."<br/>". __CLASS__ ."<br/>". __METHOD__ ."<br/>". __LINE__ ."<br/>". __NAMESPACE__;
      echo public_path()."<br>";                  

      return $company_id+1;                  
    }

}
