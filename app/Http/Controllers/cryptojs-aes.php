<?php
/**
* Helper library for CryptoJS AES encryption/decryption
* Allow you to use AES encryption on client side and server side vice versa
*
* @author BrainFooLong (bfldev.com)
* @link https://github.com/brainfoolong/cryptojs-aes-php
*/

/**
* Decrypt data from a CryptoJS json encoding string
*
* @param mixed $passphrase
* @param mixed $jsonString
* @return mixed
*/
function cryptoJsAesDecrypt($passphrase, $jsonString){
    //$passphrase = "AF050505AF050505AF050505AF050505";
    //$passphrase = "AF050505AF050505AF050505AF050505";
    //$jsonString = json_encode((array("ct"=>"l+t6fhDTEAuQFv8ARBvsxE2AUcUMU56MHu1FxtuaBxpY8GS4Cixv8qj/JclNx+1d","iv"=>"952b5edaa6688f8cf473ac171c8b02c6","s"=>"193730844dfbb4c4")));
    //{"ct":"zKocPC226MHVP/2fQUPPTg==","iv":"aa4e4645902fcace27dcd82e6e864374","s":"d042e583807373c0"}
    //array("ct"=>"zKocPC226MHVP/2fQUPPTg==","iv"=>"aa4e4645902fcace27dcd82e6e864374","s"=>"d042e583807373c0")
    //{"ct":"spD3lPpeaQv5sNZozrdazg==","iv":"a8366990ca8058fb891d03fcd7ef2408","s":"4b2d0595ca48a0dd"}
   // $jsonString = json_encode((array("ct"=>"spD3lPpeaQv5sNZozrdazg==","iv"=>"a8366990ca8058fb891d03fcd7ef2408","s"=>"4b2d0595ca48a0dd")));
    $jsondata = json_decode($jsonString, true);
    //var_dump($jsondata["iv"]);
    try {
        $salt = hex2bin($jsondata["s"]);
        $iv  = hex2bin($jsondata["iv"]);
    } catch(Exception $e) {  return null; }
    $ct = base64_decode($jsondata["ct"]);
    $concatedPassphrase = $passphrase.$salt;
    $md5 = array();
    $md5[0] = md5($concatedPassphrase, true);
    $result = $md5[0];
    for ($i = 1; $i < 3; $i++) {
        $md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
        $result .= $md5[$i];
    }
    $key = substr($result, 0, 32);
    $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
    return json_decode($data, true);
}

/**
* Encrypt value to a cryptojs compatiable json encoding string
*
* @param mixed $passphrase
* @param mixed $value
* @return string
*/
function cryptoJsAesEncrypt($passphrase, $value){
    $salt = openssl_random_pseudo_bytes(8);
    $salted = '';
    $dx = '';
    while (strlen($salted) < 48) {
        $dx = md5($dx.$passphrase.$salt, true);
        $salted .= $dx;
    }
    $key = substr($salted, 0, 32);
    $iv  = substr($salted, 32,16);
    $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
    $data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
    return json_encode($data);
}
