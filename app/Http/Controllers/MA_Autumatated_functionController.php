<?php

namespace App\Http\Controllers;

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

class MA_Autumatated_functionController extends Controller
{
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
}
