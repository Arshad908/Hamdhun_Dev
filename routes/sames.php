        if(_name != "" && _id != ""){
            
          if(masterDarted == false){
              masterDarted = true;

              $.ajax({
                url:encodeURI('{{route('make_chamges_on_master_category')}}'),
                method:"POST",
                data:{
                  "data1" : _name,
                  "data2" : _id,
                  "data3" : _checked
                },
                beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
                },
                success:function(data){
                   masterDarted = false;
                   alert(data);
                },
                error:function(data,error){
                   masterDarted = false;
                   alert("E"); 
                }
              }); 

          }else{
            alert("Please wait");
          }

        }

foreach($subs as $key => $sdata1){
                              if($sdata1->mid == $mdata->mid){
                                echo "<tr><td rowspan='$mscolspan'>$sdata1->sid</td>";
                              }
                            }

                            

                            foreach($complementory as $key => $cdata1){
                              if($cdata1->sid == $now_sub_id && $mdata->mid == $cdata1->mid){
                                echo "<tr><td>$cdata1->cid</td>";
                              }
                            }
//site_category_load(); 
for ($i=0; $i < count($master_category); $i++) { 
                $mname = $master_category[$i]->m_c_name;
                $msname = $master_category[$i]->m_s_c_name;
                $comname = $master_category[$i]->m_s_c_com_name;
                $master_id = $master_category[$i]->m_c_id;
                $sub_master_id = $master_category[$i]->m_s_c_id;
                $sub_master_filter_1_id = $master_category[$i]->m_s_c_com_id;
                
                if($master_id != $now_going_master){
                    $now_going_master = $master_id;
                    array_push($masterArray, ["mid" => $master_id]);            
                }

        }
//Paypal

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
</head>

<body>
  <script
    src="https://www.paypal.com/sdk/js?client-id=AeIFaCYvS264x4qvukDDrPpvkw6OfTfBLVt8Nfe5pNEMh1L619hKsGWjUyI-2zdHbf4T5vR4ToB9OcVV"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
  </script>

  <div id="paypal-button-container"></div>

  <script>
    paypal.Buttons().render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.
  </script>
  <script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '20'
          }
        }]
      });
    }
  }).render('#paypal-button-container');
</script>
</body>
</html>


//End Paypal


contentType: "application/json; charset=utf-8",


var key = "<?=$key?>";
 var keyObj = CryptoJS.enc.Utf8.parse(key);
		        var encrypted = CryptoJS.AES.encrypt(plaintext, keyObj, {
		            iv: CryptoJS.enc.Hex.parse("<?=session('enc_key')?>"),
		        });
		        $('#noyel_sec_code').val(encrypted.iv.toString());
		        return  encrypted.toString();



		        			console.log(firstName);
				console.log(lastName);
					console.log(useremail);
						console.log(userpassword);
							console.log(userreconfirm);




switch(status){
    						case 200:
    							$('#error_on_login_page').css("display","none").animate(2500);
    							var url = "{{ route('InitialSiteLoaded')}}";
    							window.location.href = url;
    							break;
    						case 404:
    							$('#error_on_login_page').css("display","block");
    							break;
    						case 500:
    							$('#error_on_login_page').css("display","block");
    							break;		
    					}	

php artisan migrate --path=/database/migrations/fileName.php
php artisan migrate:rollback --path=/database/migrations/fileName.php
php artisan migrate:refresh --path=/database/migrations/fileName.php

    		



<div class="row col-md-8 col-sm-12 settings_data_saved_failed">
                    <p><b>OOPS !</b> Profile info not saved properly.</p>
                  </div>
                  <div class="row col-md-8 col-sm-12 settings_data_saved_success ">
                    <p><b>CONGARTZ !</b> Profile info saved success.</p>
                  </div>  
            


//Card save ajax
            $.ajax({
               url:"{{ route('update_user_profile_card_information') }}",
               method:"POST",
               data:{
                "card_info_data":sendData
               },
               beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
               },
               success:function(data)
               {
                  alert();
               },
               error:function(dd,data){
                  var data = dd.status;
                  console.log("Error");
               }
            });


let cardInfoLoad = new CardCPlCk("<?=session('card_encryption_key')?>",user_card_dt);
   sendData = cardInfoLoad.createCardInfoSend();

//card save ajax





  // event.preventDefault();
  // $.ajax({
  //  url:"{{ route('ajaxupload.action') }}",
  //  method:"POST",
  //  data:new FormData(this),
  //  dataType:'JSON',
  //  contentType: false,
  //  cache: false,
  //  processData: false,
  //  success:function(data)
  //  {
  //   $('#message').css('display', 'block');
  //   $('#message').html(data.message);
  //   $('#message').addClass(data.class_name);
  //   $('#uploaded_image').html(data.uploaded_image);
  //  }
  // })  

  

const countries =[
        {
            "name": "Andorra",
            "code": "AD",
            "states": null
        },
        {
            "name": "United Arab Emirates",
            "code": "AE",
            "states": null
        },
        {
            "name": "Afghanistan",
            "code": "AF",
            "states": null
        },
        {
            "name": "Antigua and Barbuda",
            "code": "AG",
            "states": null
        },
        {
            "name": "Anguilla",
            "code": "AI",
            "states": null
        },
        {
            "name": "Albania",
            "code": "AL",
            "states": null
        },
        {
            "name": "Armenia",
            "code": "AM",
            "states": null
        },
        {
            "name": "Netherlands Antilles",
            "code": "AN",
            "states": null
        },
        {
            "name": "Angola",
            "code": "AO",
            "states": null
        },
        {
            "name": "Antarctica",
            "code": "AQ",
            "states": null
        },
        {
            "name": "Argentina",
            "code": "AR",
            "states": null
        },
        {
            "name": "American Samoa",
            "code": "AS",
            "states": null
        },
        {
            "name": "Austria",
            "code": "AT",
            "states": null
        },
        {
            "name": "Australia",
            "code": "AU",
            "states": [
                {
                    "code": "ACT",
                    "name": "Australian Capital Territory"
                },
                {
                    "code": "NSW",
                    "name": "New South Wales"
                },
                {
                    "code": "NT",
                    "name": "Northern Territory"
                },
                {
                    "code": "QLD",
                    "name": "Queensland"
                },
                {
                    "code": "SA",
                    "name": "South Australia"
                },
                {
                    "code": "TAS",
                    "name": "Tasmania"
                },
                {
                    "code": "VIC",
                    "name": "Victoria"
                },
                {
                    "code": "WA",
                    "name": "Western Australia"
                }
            ]
        },
        {
            "name": "Aruba",
            "code": "AW",
            "states": null
        },
        {
            "name": "Azerbaijan",
            "code": "AZ",
            "states": null
        },
        {
            "name": "Bosnia and Herzegovina",
            "code": "BA",
            "states": null
        },
        {
            "name": "Barbados",
            "code": "BB",
            "states": null
        },
        {
            "name": "Bangladesh",
            "code": "BD",
            "states": null
        },
        {
            "name": "Belgium",
            "code": "BE",
            "states": null
        },
        {
            "name": "Burkina Faso",
            "code": "BF",
            "states": null
        },
        {
            "name": "Bulgaria",
            "code": "BG",
            "states": null
        },
        {
            "name": "Bahrain",
            "code": "BH",
            "states": null
        },
        {
            "name": "Burundi",
            "code": "BI",
            "states": null
        },
        {
            "name": "Benin",
            "code": "BJ",
            "states": null
        },
        {
            "name": "Bermuda",
            "code": "BM",
            "states": null
        },
        {
            "name": "Brunei Darussalam",
            "code": "BN",
            "states": null
        },
        {
            "name": "Bolivia",
            "code": "BO",
            "states": null
        },
        {
            "name": "Brazil",
            "code": "BR",
            "states": null
        },
        {
            "name": "Bahamas",
            "code": "BS",
            "states": null
        },
        {
            "name": "Bhutan",
            "code": "BT",
            "states": null
        },
        {
            "name": "Bouvet Island",
            "code": "BV",
            "states": null
        },
        {
            "name": "Botswana",
            "code": "BW",
            "states": null
        },
        {
            "name": "Belarus",
            "code": "BY",
            "states": null
        },
        {
            "name": "Belize",
            "code": "BZ",
            "states": null
        },
        {
            "name": "Canada",
            "code": "CA",
            "states": [
                {
                    "code": "AB",
                    "name": "Alberta"
                },
                {
                    "code": "BC",
                    "name": "British Columbia"
                },
                {
                    "code": "MB",
                    "name": "Manitoba"
                },
                {
                    "code": "NB",
                    "name": "New Brunswick"
                },
                {
                    "code": "NL",
                    "name": "Newfoundland and Labrador"
                },
                {
                    "code": "NS",
                    "name": "Nova Scotia"
                },
                {
                    "code": "NT",
                    "name": "Northwest Territories"
                },
                {
                    "code": "NU",
                    "name": "Nunavut"
                },
                {
                    "code": "ON",
                    "name": "Ontario"
                },
                {
                    "code": "PE",
                    "name": "Prince Edward Island"
                },
                {
                    "code": "QC",
                    "name": "Quebec"
                },
                {
                    "code": "SK",
                    "name": "Saskatchewan"
                },
                {
                    "code": "YT",
                    "name": "Yukon"
                }
            ]
        },
        {
            "name": "Cocos (Keeling) Islands",
            "code": "CC",
            "states": null
        },
        {
            "name": "Congo, the Democratic Republic of the",
            "code": "CD",
            "states": null
        },
        {
            "name": "Central African Republic",
            "code": "CF",
            "states": null
        },
        {
            "name": "Congo",
            "code": "CG",
            "states": null
        },
        {
            "name": "Switzerland",
            "code": "CH",
            "states": null
        },
        {
            "name": "Cote D'Ivoire",
            "code": "CI",
            "states": null
        },
        {
            "name": "Cook Islands",
            "code": "CK",
            "states": null
        },
        {
            "name": "Chile",
            "code": "CL",
            "states": null
        },
        {
            "name": "Cameroon",
            "code": "CM",
            "states": null
        },
        {
            "name": "China",
            "code": "CN",
            "states": null
        },
        {
            "name": "Colombia",
            "code": "CO",
            "states": null
        },
        {
            "name": "Costa Rica",
            "code": "CR",
            "states": null
        },
        {
            "name": "Cuba, Republic of",
            "code": "CU",
            "states": null
        },
        {
            "name": "Cape Verde",
            "code": "CV",
            "states": null
        },
        {
            "name": "Curacao",
            "code": "CW",
            "states": null
        },
        {
            "name": "Christmas Island",
            "code": "CX",
            "states": null
        },
        {
            "name": "Cyprus",
            "code": "CY",
            "states": null
        },
        {
            "name": "Czech Republic",
            "code": "CZ",
            "states": null
        },
        {
            "name": "Germany",
            "code": "DE",
            "states": null
        },
        {
            "name": "Djibouti",
            "code": "DJ",
            "states": null
        },
        {
            "name": "Denmark",
            "code": "DK",
            "states": null
        },
        {
            "name": "Dominica",
            "code": "DM",
            "states": null
        },
        {
            "name": "Dominican Republic",
            "code": "DO",
            "states": null
        },
        {
            "name": "Algeria",
            "code": "DZ",
            "states": null
        },
        {
            "name": "Ecuador",
            "code": "EC",
            "states": null
        },
        {
            "name": "Estonia",
            "code": "EE",
            "states": null
        },
        {
            "name": "Egypt",
            "code": "EG",
            "states": null
        },
        {
            "name": "Western Sahara",
            "code": "EH",
            "states": null
        },
        {
            "name": "Eritrea",
            "code": "ER",
            "states": null
        },
        {
            "name": "Spain",
            "code": "ES",
            "states": null
        },
        {
            "name": "Ethiopia",
            "code": "ET",
            "states": null
        },
        {
            "name": "Finland",
            "code": "FI",
            "states": null
        },
        {
            "name": "Fiji",
            "code": "FJ",
            "states": null
        },
        {
            "name": "Falkland Islands (Malvinas)",
            "code": "FK",
            "states": null
        },
        {
            "name": "Micronesia, Federated States of",
            "code": "FM",
            "states": null
        },
        {
            "name": "Faroe Islands",
            "code": "FO",
            "states": null
        },
        {
            "name": "France",
            "code": "FR",
            "states": null
        },
        {
            "name": "Gabon",
            "code": "GA",
            "states": null
        },
        {
            "name": "United Kingdom",
            "code": "GB",
            "states": null
        },
        {
            "name": "Grenada",
            "code": "GD",
            "states": null
        },
        {
            "name": "Georgia",
            "code": "GE",
            "states": null
        },
        {
            "name": "French Guiana",
            "code": "GF",
            "states": null
        },
        {
            "name": "Guernsey",
            "code": "GG",
            "states": null
        },
        {
            "name": "Ghana",
            "code": "GH",
            "states": null
        },
        {
            "name": "Gibraltar",
            "code": "GI",
            "states": null
        },
        {
            "name": "Greenland",
            "code": "GL",
            "states": null
        },
        {
            "name": "Gambia",
            "code": "GM",
            "states": null
        },
        {
            "name": "Guinea",
            "code": "GN",
            "states": null
        },
        {
            "name": "Guadeloupe",
            "code": "GP",
            "states": null
        },
        {
            "name": "Equatorial Guinea",
            "code": "GQ",
            "states": null
        },
        {
            "name": "Greece",
            "code": "GR",
            "states": null
        },
        {
            "name": "South Georgia and the South Sandwich Islands",
            "code": "GS",
            "states": null
        },
        {
            "name": "Guatemala",
            "code": "GT",
            "states": null
        },
        {
            "name": "Guam",
            "code": "GU",
            "states": null
        },
        {
            "name": "Guinea-Bissau",
            "code": "GW",
            "states": null
        },
        {
            "name": "Guyana",
            "code": "GY",
            "states": null
        },
        {
            "name": "Hong Kong",
            "code": "HK",
            "states": null
        },
        {
            "name": "Heard Island and Mcdonald Islands",
            "code": "HM",
            "states": null
        },
        {
            "name": "Honduras",
            "code": "HN",
            "states": null
        },
        {
            "name": "Croatia",
            "code": "HR",
            "states": null
        },
        {
            "name": "Haiti",
            "code": "HT",
            "states": null
        },
        {
            "name": "Hungary",
            "code": "HU",
            "states": null
        },
        {
            "name": "Indonesia",
            "code": "ID",
            "states": null
        },
        {
            "name": "Ireland",
            "code": "IE",
            "states": null
        },
        {
            "name": "Israel",
            "code": "IL",
            "states": null
        },
        {
            "name": "Isle of Man",
            "code": "IM",
            "states": null
        },
        {
            "name": "India",
            "code": "IN",
            "states": null
        },
        {
            "name": "British Indian Ocean Territory",
            "code": "IO",
            "states": null
        },
        {
            "name": "Iraq",
            "code": "IQ",
            "states": null
        },
        {
            "name": "Iran, Islamic Republic of",
            "code": "IR",
            "states": null
        },
        {
            "name": "Iceland",
            "code": "IS",
            "states": null
        },
        {
            "name": "Italy",
            "code": "IT",
            "states": null
        },
        {
            "name": "Jersey",
            "code": "JE",
            "states": null
        },
        {
            "name": "Jamaica",
            "code": "JM",
            "states": null
        },
        {
            "name": "Jordan",
            "code": "JO",
            "states": null
        },
        {
            "name": "Japan",
            "code": "JP",
            "states": [
                {
                    "code": "01",
                    "name": "Hokkaido"
                },
                {
                    "code": "02",
                    "name": "Aomori"
                },
                {
                    "code": "03",
                    "name": "Iwate"
                },
                {
                    "code": "04",
                    "name": "Miyagi"
                },
                {
                    "code": "05",
                    "name": "Akita"
                },
                {
                    "code": "06",
                    "name": "Yamagata"
                },
                {
                    "code": "07",
                    "name": "Fukushima"
                },
                {
                    "code": "08",
                    "name": "Ibaraki"
                },
                {
                    "code": "09",
                    "name": "Tochigi"
                },
                {
                    "code": "10",
                    "name": "Gunma"
                },
                {
                    "code": "11",
                    "name": "Saitama"
                },
                {
                    "code": "12",
                    "name": "Chiba"
                },
                {
                    "code": "13",
                    "name": "Tokyo"
                },
                {
                    "code": "14",
                    "name": "Kanagawa"
                },
                {
                    "code": "15",
                    "name": "Niigata"
                },
                {
                    "code": "16",
                    "name": "Toyama"
                },
                {
                    "code": "17",
                    "name": "Ishikawa"
                },
                {
                    "code": "18",
                    "name": "Fukui"
                },
                {
                    "code": "19",
                    "name": "Yamanashi"
                },
                {
                    "code": "20",
                    "name": "Nagano"
                },
                {
                    "code": "21",
                    "name": "Gifu"
                },
                {
                    "code": "22",
                    "name": "Shizuoka"
                },
                {
                    "code": "23",
                    "name": "Aichi"
                },
                {
                    "code": "24",
                    "name": "Mie"
                },
                {
                    "code": "25",
                    "name": "Shiga"
                },
                {
                    "code": "26",
                    "name": "Kyoto"
                },
                {
                    "code": "27",
                    "name": "Osaka"
                },
                {
                    "code": "28",
                    "name": "Hyogo"
                },
                {
                    "code": "29",
                    "name": "Nara"
                },
                {
                    "code": "30",
                    "name": "Wakayama"
                },
                {
                    "code": "31",
                    "name": "Tottori"
                },
                {
                    "code": "32",
                    "name": "Shimane"
                },
                {
                    "code": "33",
                    "name": "Okayama"
                },
                {
                    "code": "34",
                    "name": "Hiroshima"
                },
                {
                    "code": "35",
                    "name": "Yamaguchi"
                },
                {
                    "code": "36",
                    "name": "Tokushima"
                },
                {
                    "code": "37",
                    "name": "Kagawa"
                },
                {
                    "code": "38",
                    "name": "Ehime"
                },
                {
                    "code": "39",
                    "name": "Kochi"
                },
                {
                    "code": "40",
                    "name": "Fukuoka"
                },
                {
                    "code": "41",
                    "name": "Saga"
                },
                {
                    "code": "42",
                    "name": "Nagasaki"
                },
                {
                    "code": "43",
                    "name": "Kumamoto"
                },
                {
                    "code": "44",
                    "name": "Oita"
                },
                {
                    "code": "45",
                    "name": "Miyazaki"
                },
                {
                    "code": "46",
                    "name": "Kagoshima"
                },
                {
                    "code": "47",
                    "name": "Okinawa"
                }
            ]
        },
        {
            "name": "Kenya",
            "code": "KE",
            "states": null
        },
        {
            "name": "Kyrgyzstan",
            "code": "KG",
            "states": null
        },
        {
            "name": "Cambodia",
            "code": "KH",
            "states": null
        },
        {
            "name": "Kiribati",
            "code": "KI",
            "states": null
        },
        {
            "name": "Comoros",
            "code": "KM",
            "states": null
        },
        {
            "name": "Saint Kitts and Nevis",
            "code": "KN",
            "states": null
        },
        {
            "name": "Korea, Democratic People's Republic of",
            "code": "KP",
            "states": null
        },
        {
            "name": "Korea, Republic of",
            "code": "KR",
            "states": null
        },
        {
            "name": "Kuwait",
            "code": "KW",
            "states": null
        },
        {
            "name": "Cayman Islands",
            "code": "KY",
            "states": null
        },
        {
            "name": "Kazakhstan",
            "code": "KZ",
            "states": null
        },
        {
            "name": "Lao People's Democratic Republic",
            "code": "LA",
            "states": null
        },
        {
            "name": "Lebanon",
            "code": "LB",
            "states": null
        },
        {
            "name": "Saint Lucia",
            "code": "LC",
            "states": null
        },
        {
            "name": "Liechtenstein",
            "code": "LI",
            "states": null
        },
        {
            "name": "Sri Lanka",
            "code": "LK",
            "states": null
        },
        {
            "name": "Liberia",
            "code": "LR",
            "states": null
        },
        {
            "name": "Lesotho",
            "code": "LS",
            "states": null
        },
        {
            "name": "Lithuania",
            "code": "LT",
            "states": null
        },
        {
            "name": "Luxembourg",
            "code": "LU",
            "states": null
        },
        {
            "name": "Latvia",
            "code": "LV",
            "states": null
        },
        {
            "name": "Libyan Arab Jamahiriya",
            "code": "LY",
            "states": null
        },
        {
            "name": "Morocco",
            "code": "MA",
            "states": null
        },
        {
            "name": "Monaco",
            "code": "MC",
            "states": null
        },
        {
            "name": "Moldova, Republic of",
            "code": "MD",
            "states": null
        },
        {
            "name": "Montenegro",
            "code": "ME",
            "states": null
        },
        {
            "name": "Sint Maarten",
            "code": "MF",
            "states": null
        },
        {
            "name": "Madagascar",
            "code": "MG",
            "states": null
        },
        {
            "name": "Marshall Islands",
            "code": "MH",
            "states": null
        },
        {
            "name": "Macedonia, the Former Yugoslav Republic of",
            "code": "MK",
            "states": null
        },
        {
            "name": "Mali",
            "code": "ML",
            "states": null
        },
        {
            "name": "Myanmar",
            "code": "MM",
            "states": null
        },
        {
            "name": "Mongolia",
            "code": "MN",
            "states": null
        },
        {
            "name": "Macao",
            "code": "MO",
            "states": null
        },
        {
            "name": "Northern Mariana Islands",
            "code": "MP",
            "states": null
        },
        {
            "name": "Martinique",
            "code": "MQ",
            "states": null
        },
        {
            "name": "Mauritania",
            "code": "MR",
            "states": null
        },
        {
            "name": "Montserrat",
            "code": "MS",
            "states": null
        },
        {
            "name": "Malta",
            "code": "MT",
            "states": null
        },
        {
            "name": "Mauritius",
            "code": "MU",
            "states": null
        },
        {
            "name": "Maldives",
            "code": "MV",
            "states": null
        },
        {
            "name": "Malawi",
            "code": "MW",
            "states": null
        },
        {
            "name": "Mexico",
            "code": "MX",
            "states": null
        },
        {
            "name": "Malaysia",
            "code": "MY",
            "states": null
        },
        {
            "name": "Mozambique",
            "code": "MZ",
            "states": null
        },
        {
            "name": "Namibia",
            "code": "NA",
            "states": null
        },
        {
            "name": "New Caledonia",
            "code": "NC",
            "states": null
        },
        {
            "name": "Niger",
            "code": "NE",
            "states": null
        },
        {
            "name": "Norfolk Island",
            "code": "NF",
            "states": null
        },
        {
            "name": "Nigeria",
            "code": "NG",
            "states": null
        },
        {
            "name": "Nicaragua",
            "code": "NI",
            "states": null
        },
        {
            "name": "Netherlands",
            "code": "NL",
            "states": null
        },
        {
            "name": "Norway",
            "code": "NO",
            "states": null
        },
        {
            "name": "Nepal",
            "code": "NP",
            "states": null
        },
        {
            "name": "Nauru",
            "code": "NR",
            "states": null
        },
        {
            "name": "Niue",
            "code": "NU",
            "states": null
        },
        {
            "name": "New Zealand",
            "code": "NZ",
            "states": null
        },
        {
            "name": "Oman",
            "code": "OM",
            "states": null
        },
        {
            "name": "Panama",
            "code": "PA",
            "states": null
        },
        {
            "name": "Peru",
            "code": "PE",
            "states": null
        },
        {
            "name": "French Polynesia",
            "code": "PF",
            "states": null
        },
        {
            "name": "Papua New Guinea",
            "code": "PG",
            "states": null
        },
        {
            "name": "Philippines",
            "code": "PH",
            "states": null
        },
        {
            "name": "Pakistan",
            "code": "PK",
            "states": null
        },
        {
            "name": "Poland",
            "code": "PL",
            "states": null
        },
        {
            "name": "Saint Pierre and Miquelon",
            "code": "PM",
            "states": null
        },
        {
            "name": "Pitcairn",
            "code": "PN",
            "states": null
        },
        {
            "name": "Puerto Rico",
            "code": "PR",
            "states": null
        },
        {
            "name": "Palestinian Territory, Occupied",
            "code": "PS",
            "states": null
        },
        {
            "name": "Portugal",
            "code": "PT",
            "states": null
        },
        {
            "name": "Palau",
            "code": "PW",
            "states": null
        },
        {
            "name": "Paraguay",
            "code": "PY",
            "states": null
        },
        {
            "name": "Qatar",
            "code": "QA",
            "states": null
        },
        {
            "name": "Reunion",
            "code": "RE",
            "states": null
        },
        {
            "name": "Romania",
            "code": "RO",
            "states": null
        },
        {
            "name": "Serbia",
            "code": "RS",
            "states": null
        },
        {
            "name": "Russian Federation",
            "code": "RU",
            "states": null
        },
        {
            "name": "Rwanda",
            "code": "RW",
            "states": null
        },
        {
            "name": "Saudi Arabia",
            "code": "SA",
            "states": null
        },
        {
            "name": "Solomon Islands",
            "code": "SB",
            "states": null
        },
        {
            "name": "Seychelles",
            "code": "SC",
            "states": null
        },
        {
            "name": "Sudan",
            "code": "SD",
            "states": null
        },
        {
            "name": "Sweden",
            "code": "SE",
            "states": null
        },
        {
            "name": "Singapore",
            "code": "SG",
            "states": null
        },
        {
            "name": "Saint Helena",
            "code": "SH",
            "states": null
        },
        {
            "name": "Slovenia",
            "code": "SI",
            "states": null
        },
        {
            "name": "Svalbard and Jan Mayen",
            "code": "SJ",
            "states": null
        },
        {
            "name": "Slovakia",
            "code": "SK",
            "states": null
        },
        {
            "name": "Sierra Leone",
            "code": "SL",
            "states": null
        },
        {
            "name": "San Marino",
            "code": "SM",
            "states": null
        },
        {
            "name": "Senegal",
            "code": "SN",
            "states": null
        },
        {
            "name": "Somalia",
            "code": "SO",
            "states": null
        },
        {
            "name": "Suriname",
            "code": "SR",
            "states": null
        },
        {
            "name": "Sao Tome and Principe",
            "code": "ST",
            "states": null
        },
        {
            "name": "El Salvador",
            "code": "SV",
            "states": null
        },
        {
            "name": "Syrian Arab Republic",
            "code": "SY",
            "states": null
        },
        {
            "name": "Swaziland",
            "code": "SZ",
            "states": null
        },
        {
            "name": "Turks and Caicos Islands",
            "code": "TC",
            "states": null
        },
        {
            "name": "Chad",
            "code": "TD",
            "states": null
        },
        {
            "name": "French Southern Territories",
            "code": "TF",
            "states": null
        },
        {
            "name": "Togo",
            "code": "TG",
            "states": null
        },
        {
            "name": "Thailand",
            "code": "TH",
            "states": null
        },
        {
            "name": "Tajikistan",
            "code": "TJ",
            "states": null
        },
        {
            "name": "Tokelau",
            "code": "TK",
            "states": null
        },
        {
            "name": "Timor-Leste",
            "code": "TL",
            "states": null
        },
        {
            "name": "Turkmenistan",
            "code": "TM",
            "states": null
        },
        {
            "name": "Tunisia",
            "code": "TN",
            "states": null
        },
        {
            "name": "Tonga",
            "code": "TO",
            "states": null
        },
        {
            "name": "Turkey",
            "code": "TR",
            "states": null
        },
        {
            "name": "Trinidad and Tobago",
            "code": "TT",
            "states": null
        },
        {
            "name": "Tuvalu",
            "code": "TV",
            "states": null
        },
        {
            "name": "Taiwan",
            "code": "TW",
            "states": null
        },
        {
            "name": "Tanzania",
            "code": "TZ",
            "states": null
        },
        {
            "name": "Ukraine",
            "code": "UA",
            "states": null
        },
        {
            "name": "Uganda",
            "code": "UG",
            "states": null
        },
        {
            "name": "United States Minor Outlying Islands",
            "code": "UM",
            "states": null
        },
        {
            "name": "United States",
            "code": "US",
            "states": [
                {
                    "code": "AA",
                    "name": "Armed Forces Americas (except Canada)"
                },
                {
                    "code": "AE",
                    "name": "Armed Forces"
                },
                {
                    "code": "AK",
                    "name": "Alaska"
                },
                {
                    "code": "AL",
                    "name": "Alabama"
                },
                {
                    "code": "AP",
                    "name": "Armed Forces Pacific"
                },
                {
                    "code": "AR",
                    "name": "Arkansas"
                },
                {
                    "code": "AS",
                    "name": "American Samoa"
                },
                {
                    "code": "AZ",
                    "name": "Arizona"
                },
                {
                    "code": "CA",
                    "name": "California"
                },
                {
                    "code": "CO",
                    "name": "Colorado"
                },
                {
                    "code": "CT",
                    "name": "Connecticut"
                },
                {
                    "code": "DC",
                    "name": "District of Columbia"
                },
                {
                    "code": "DE",
                    "name": "Delaware"
                },
                {
                    "code": "FL",
                    "name": "Florida"
                },
                {
                    "code": "FM",
                    "name": "Federated States of Micronesia"
                },
                {
                    "code": "GA",
                    "name": "Georgia"
                },
                {
                    "code": "GU",
                    "name": "Guam"
                },
                {
                    "code": "HI",
                    "name": "Hawaii"
                },
                {
                    "code": "IA",
                    "name": "Iowa"
                },
                {
                    "code": "ID",
                    "name": "Idaho"
                },
                {
                    "code": "IL",
                    "name": "Illinois"
                },
                {
                    "code": "IN",
                    "name": "Indiana"
                },
                {
                    "code": "KS",
                    "name": "Kansas"
                },
                {
                    "code": "KY",
                    "name": "Kentucky"
                },
                {
                    "code": "LA",
                    "name": "Louisiana"
                },
                {
                    "code": "MA",
                    "name": "Massachusetts"
                },
                {
                    "code": "MD",
                    "name": "Maryland"
                },
                {
                    "code": "ME",
                    "name": "Maine"
                },
                {
                    "code": "MH",
                    "name": "Marshall Islands"
                },
                {
                    "code": "MI",
                    "name": "Michigan"
                },
                {
                    "code": "MN",
                    "name": "Minnesota"
                },
                {
                    "code": "MO",
                    "name": "Missouri"
                },
                {
                    "code": "MP",
                    "name": "Northern Mariana Islands"
                },
                {
                    "code": "MS",
                    "name": "Mississippi"
                },
                {
                    "code": "MT",
                    "name": "Montana"
                },
                {
                    "code": "NC",
                    "name": "North Carolina"
                },
                {
                    "code": "ND",
                    "name": "North Dakota"
                },
                {
                    "code": "NE",
                    "name": "Nebraska"
                },
                {
                    "code": "NH",
                    "name": "New Hampshire"
                },
                {
                    "code": "NJ",
                    "name": "New Jersey"
                },
                {
                    "code": "NM",
                    "name": "New Mexico"
                },
                {
                    "code": "NV",
                    "name": "Nevada"
                },
                {
                    "code": "NY",
                    "name": "New York"
                },
                {
                    "code": "OH",
                    "name": "Ohio"
                },
                {
                    "code": "OK",
                    "name": "Oklahoma"
                },
                {
                    "code": "OR",
                    "name": "Oregon"
                },
                {
                    "code": "PA",
                    "name": "Pennsylvania"
                },
                {
                    "code": "PR",
                    "name": "Puerto Rico"
                },
                {
                    "code": "PW",
                    "name": "Palau"
                },
                {
                    "code": "RI",
                    "name": "Rhode Island"
                },
                {
                    "code": "SC",
                    "name": "South Carolina"
                },
                {
                    "code": "SD",
                    "name": "South Dakota"
                },
                {
                    "code": "TN",
                    "name": "Tennessee"
                },
                {
                    "code": "TX",
                    "name": "Texas"
                },
                {
                    "code": "UT",
                    "name": "Utah"
                },
                {
                    "code": "VA",
                    "name": "Virginia"
                },
                {
                    "code": "VI",
                    "name": "Virgin Islands"
                },
                {
                    "code": "VT",
                    "name": "Vermont"
                },
                {
                    "code": "WA",
                    "name": "Washington"
                },
                {
                    "code": "WI",
                    "name": "Wisconsin"
                },
                {
                    "code": "WV",
                    "name": "West Virginia"
                },
                {
                    "code": "WY",
                    "name": "Wyoming"
                }
            ]
        },
        {
            "name": "Uruguay",
            "code": "UY",
            "states": null
        },
        {
            "name": "Uzbekistan",
            "code": "UZ",
            "states": null
        },
        {
            "name": "Vatican City",
            "code": "VA",
            "states": null
        },
        {
            "name": "Saint Vincent and the Grenadines",
            "code": "VC",
            "states": null
        },
        {
            "name": "Venezuela",
            "code": "VE",
            "states": null
        },
        {
            "name": "Virgin Islands, British",
            "code": "VG",
            "states": null
        },
        {
            "name": "Virgin Islands, U.S.",
            "code": "VI",
            "states": null
        },
        {
            "name": "Vietnam",
            "code": "VN",
            "states": null
        },
        {
            "name": "Vanuatu",
            "code": "VU",
            "states": null
        },
        {
            "name": "Wallis and Futuna",
            "code": "WF",
            "states": null
        },
        {
            "name": "Samoa",
            "code": "WS",
            "states": null
        },
        {
            "name": "Yemen",
            "code": "YE",
            "states": null
        },
        {
            "name": "Mayotte",
            "code": "YT",
            "states": null
        },
        {
            "name": "South Africa",
            "code": "ZA",
            "states": null
        },
        {
            "name": "Zambia",
            "code": "ZM",
            "states": null
        },
        {
            "name": "Zimbabwe",
            "code": "ZW",
            "states": null
        }
    ];
    var country_option;
    for(var i = 0 ; i < countries.length ; i++){
       var data = "<option value="+countries[i].code+">"+countries[i].name+"</option>";
       $("#nd_profile_company_base_country").append(data); 
    }


                                            user_card_dt[i] = user_card_type_q;



                                            @foreach($company_content_about_policy as $content_policy)
  <?php
    $about_us = "";
    if($content_policy["titile_of_content"] == "about_us"){
        $about_us = $content_policy["web_content"];
    } 
  ?>
@endforeach












{
    "countries": {
        "country": [
            {
                "countryCode": "AD",
                "countryName": "Andorra",
                "currencyCode": "EUR",
                "population": "84000",
                "capital": "Andorra la Vella",
                "continentName": "Europe"
            },
            {
                "countryCode": "AE",
                "countryName": "United Arab Emirates",
                "currencyCode": "AED",
                "population": "4975593",
                "capital": "Abu Dhabi",
                "continentName": "Asia"
            },
            {
                "countryCode": "AF",
                "countryName": "Afghanistan",
                "currencyCode": "AFN",
                "population": "29121286",
                "capital": "Kabul",
                "continentName": "Asia"
            },
            {
                "countryCode": "AG",
                "countryName": "Antigua and Barbuda",
                "currencyCode": "XCD",
                "population": "86754",
                "capital": "St. John's",
                "continentName": "North America"
            },
            {
                "countryCode": "AI",
                "countryName": "Anguilla",
                "currencyCode": "XCD",
                "population": "13254",
                "capital": "The Valley",
                "continentName": "North America"
            },
            {
                "countryCode": "AL",
                "countryName": "Albania",
                "currencyCode": "ALL",
                "population": "2986952",
                "capital": "Tirana",
                "continentName": "Europe"
            },
            {
                "countryCode": "AM",
                "countryName": "Armenia",
                "currencyCode": "AMD",
                "population": "2968000",
                "capital": "Yerevan",
                "continentName": "Asia"
            },
            {
                "countryCode": "AO",
                "countryName": "Angola",
                "currencyCode": "AOA",
                "population": "13068161",
                "capital": "Luanda",
                "continentName": "Africa"
            },
            {
                "countryCode": "AQ",
                "countryName": "Antarctica",
                "currencyCode": "",
                "population": "0",
                "capital": "",
                "continentName": "Antarctica"
            },
            {
                "countryCode": "AR",
                "countryName": "Argentina",
                "currencyCode": "ARS",
                "population": "41343201",
                "capital": "Buenos Aires",
                "continentName": "South America"
            },
            {
                "countryCode": "AS",
                "countryName": "American Samoa",
                "currencyCode": "USD",
                "population": "57881",
                "capital": "Pago Pago",
                "continentName": "Oceania"
            },
            {
                "countryCode": "AT",
                "countryName": "Austria",
                "currencyCode": "EUR",
                "population": "8205000",
                "capital": "Vienna",
                "continentName": "Europe"
            },
            {
                "countryCode": "AU",
                "countryName": "Australia",
                "currencyCode": "AUD",
                "population": "21515754",
                "capital": "Canberra",
                "continentName": "Oceania"
            },
            {
                "countryCode": "AW",
                "countryName": "Aruba",
                "currencyCode": "AWG",
                "population": "71566",
                "capital": "Oranjestad",
                "continentName": "North America"
            },
            {
                "countryCode": "AX",
                "countryName": "Åland",
                "currencyCode": "EUR",
                "population": "26711",
                "capital": "Mariehamn",
                "continentName": "Europe"
            },
            {
                "countryCode": "AZ",
                "countryName": "Azerbaijan",
                "currencyCode": "AZN",
                "population": "8303512",
                "capital": "Baku",
                "continentName": "Asia"
            },
            {
                "countryCode": "BA",
                "countryName": "Bosnia and Herzegovina",
                "currencyCode": "BAM",
                "population": "4590000",
                "capital": "Sarajevo",
                "continentName": "Europe"
            },
            {
                "countryCode": "BB",
                "countryName": "Barbados",
                "currencyCode": "BBD",
                "population": "285653",
                "capital": "Bridgetown",
                "continentName": "North America"
            },
            {
                "countryCode": "BD",
                "countryName": "Bangladesh",
                "currencyCode": "BDT",
                "population": "156118464",
                "capital": "Dhaka",
                "continentName": "Asia"
            },
            {
                "countryCode": "BE",
                "countryName": "Belgium",
                "currencyCode": "EUR",
                "population": "10403000",
                "capital": "Brussels",
                "continentName": "Europe"
            },
            {
                "countryCode": "BF",
                "countryName": "Burkina Faso",
                "currencyCode": "XOF",
                "population": "16241811",
                "capital": "Ouagadougou",
                "continentName": "Africa"
            },
            {
                "countryCode": "BG",
                "countryName": "Bulgaria",
                "currencyCode": "BGN",
                "population": "7148785",
                "capital": "Sofia",
                "continentName": "Europe"
            },
            {
                "countryCode": "BH",
                "countryName": "Bahrain",
                "currencyCode": "BHD",
                "population": "738004",
                "capital": "Manama",
                "continentName": "Asia"
            },
            {
                "countryCode": "BI",
                "countryName": "Burundi",
                "currencyCode": "BIF",
                "population": "9863117",
                "capital": "Bujumbura",
                "continentName": "Africa"
            },
            {
                "countryCode": "BJ",
                "countryName": "Benin",
                "currencyCode": "XOF",
                "population": "9056010",
                "capital": "Porto-Novo",
                "continentName": "Africa"
            },
            {
                "countryCode": "BL",
                "countryName": "Saint Barthélemy",
                "currencyCode": "EUR",
                "population": "8450",
                "capital": "Gustavia",
                "continentName": "North America"
            },
            {
                "countryCode": "BM",
                "countryName": "Bermuda",
                "currencyCode": "BMD",
                "population": "65365",
                "capital": "Hamilton",
                "continentName": "North America"
            },
            {
                "countryCode": "BN",
                "countryName": "Brunei",
                "currencyCode": "BND",
                "population": "395027",
                "capital": "Bandar Seri Begawan",
                "continentName": "Asia"
            },
            {
                "countryCode": "BO",
                "countryName": "Bolivia",
                "currencyCode": "BOB",
                "population": "9947418",
                "capital": "Sucre",
                "continentName": "South America"
            },
            {
                "countryCode": "BQ",
                "countryName": "Bonaire",
                "currencyCode": "USD",
                "population": "18012",
                "capital": "Kralendijk",
                "continentName": "North America"
            },
            {
                "countryCode": "BR",
                "countryName": "Brazil",
                "currencyCode": "BRL",
                "population": "201103330",
                "capital": "Brasília",
                "continentName": "South America"
            },
            {
                "countryCode": "BS",
                "countryName": "Bahamas",
                "currencyCode": "BSD",
                "population": "301790",
                "capital": "Nassau",
                "continentName": "North America"
            },
            {
                "countryCode": "BT",
                "countryName": "Bhutan",
                "currencyCode": "BTN",
                "population": "699847",
                "capital": "Thimphu",
                "continentName": "Asia"
            },
            {
                "countryCode": "BV",
                "countryName": "Bouvet Island",
                "currencyCode": "NOK",
                "population": "0",
                "capital": "",
                "continentName": "Antarctica"
            },
            {
                "countryCode": "BW",
                "countryName": "Botswana",
                "currencyCode": "BWP",
                "population": "2029307",
                "capital": "Gaborone",
                "continentName": "Africa"
            },
            {
                "countryCode": "BY",
                "countryName": "Belarus",
                "currencyCode": "BYR",
                "population": "9685000",
                "capital": "Minsk",
                "continentName": "Europe"
            },
            {
                "countryCode": "BZ",
                "countryName": "Belize",
                "currencyCode": "BZD",
                "population": "314522",
                "capital": "Belmopan",
                "continentName": "North America"
            },
            {
                "countryCode": "CA",
                "countryName": "Canada",
                "currencyCode": "CAD",
                "population": "33679000",
                "capital": "Ottawa",
                "continentName": "North America"
            },
            {
                "countryCode": "CC",
                "countryName": "Cocos [Keeling] Islands",
                "currencyCode": "AUD",
                "population": "628",
                "capital": "West Island",
                "continentName": "Asia"
            },
            {
                "countryCode": "CD",
                "countryName": "Democratic Republic of the Congo",
                "currencyCode": "CDF",
                "population": "70916439",
                "capital": "Kinshasa",
                "continentName": "Africa"
            },
            {
                "countryCode": "CF",
                "countryName": "Central African Republic",
                "currencyCode": "XAF",
                "population": "4844927",
                "capital": "Bangui",
                "continentName": "Africa"
            },
            {
                "countryCode": "CG",
                "countryName": "Republic of the Congo",
                "currencyCode": "XAF",
                "population": "3039126",
                "capital": "Brazzaville",
                "continentName": "Africa"
            },
            {
                "countryCode": "CH",
                "countryName": "Switzerland",
                "currencyCode": "CHF",
                "population": "7581000",
                "capital": "Bern",
                "continentName": "Europe"
            },
            {
                "countryCode": "CI",
                "countryName": "Ivory Coast",
                "currencyCode": "XOF",
                "population": "21058798",
                "capital": "Yamoussoukro",
                "continentName": "Africa"
            },
            {
                "countryCode": "CK",
                "countryName": "Cook Islands",
                "currencyCode": "NZD",
                "population": "21388",
                "capital": "Avarua",
                "continentName": "Oceania"
            },
            {
                "countryCode": "CL",
                "countryName": "Chile",
                "currencyCode": "CLP",
                "population": "16746491",
                "capital": "Santiago",
                "continentName": "South America"
            },
            {
                "countryCode": "CM",
                "countryName": "Cameroon",
                "currencyCode": "XAF",
                "population": "19294149",
                "capital": "Yaoundé",
                "continentName": "Africa"
            },
            {
                "countryCode": "CN",
                "countryName": "China",
                "currencyCode": "CNY",
                "population": "1330044000",
                "capital": "Beijing",
                "continentName": "Asia"
            },
            {
                "countryCode": "CO",
                "countryName": "Colombia",
                "currencyCode": "COP",
                "population": "47790000",
                "capital": "Bogotá",
                "continentName": "South America"
            },
            {
                "countryCode": "CR",
                "countryName": "Costa Rica",
                "currencyCode": "CRC",
                "population": "4516220",
                "capital": "San José",
                "continentName": "North America"
            },
            {
                "countryCode": "CU",
                "countryName": "Cuba",
                "currencyCode": "CUP",
                "population": "11423000",
                "capital": "Havana",
                "continentName": "North America"
            },
            {
                "countryCode": "CV",
                "countryName": "Cape Verde",
                "currencyCode": "CVE",
                "population": "508659",
                "capital": "Praia",
                "continentName": "Africa"
            },
            {
                "countryCode": "CW",
                "countryName": "Curacao",
                "currencyCode": "ANG",
                "population": "141766",
                "capital": "Willemstad",
                "continentName": "North America"
            },
            {
                "countryCode": "CX",
                "countryName": "Christmas Island",
                "currencyCode": "AUD",
                "population": "1500",
                "capital": "Flying Fish Cove",
                "continentName": "Asia"
            },
            {
                "countryCode": "CY",
                "countryName": "Cyprus",
                "currencyCode": "EUR",
                "population": "1102677",
                "capital": "Nicosia",
                "continentName": "Europe"
            },
            {
                "countryCode": "CZ",
                "countryName": "Czechia",
                "currencyCode": "CZK",
                "population": "10476000",
                "capital": "Prague",
                "continentName": "Europe"
            },
            {
                "countryCode": "DE",
                "countryName": "Germany",
                "currencyCode": "EUR",
                "population": "81802257",
                "capital": "Berlin",
                "continentName": "Europe"
            },
            {
                "countryCode": "DJ",
                "countryName": "Djibouti",
                "currencyCode": "DJF",
                "population": "740528",
                "capital": "Djibouti",
                "continentName": "Africa"
            },
            {
                "countryCode": "DK",
                "countryName": "Denmark",
                "currencyCode": "DKK",
                "population": "5484000",
                "capital": "Copenhagen",
                "continentName": "Europe"
            },
            {
                "countryCode": "DM",
                "countryName": "Dominica",
                "currencyCode": "XCD",
                "population": "72813",
                "capital": "Roseau",
                "continentName": "North America"
            },
            {
                "countryCode": "DO",
                "countryName": "Dominican Republic",
                "currencyCode": "DOP",
                "population": "9823821",
                "capital": "Santo Domingo",
                "continentName": "North America"
            },
            {
                "countryCode": "DZ",
                "countryName": "Algeria",
                "currencyCode": "DZD",
                "population": "34586184",
                "capital": "Algiers",
                "continentName": "Africa"
            },
            {
                "countryCode": "EC",
                "countryName": "Ecuador",
                "currencyCode": "USD",
                "population": "14790608",
                "capital": "Quito",
                "continentName": "South America"
            },
            {
                "countryCode": "EE",
                "countryName": "Estonia",
                "currencyCode": "EUR",
                "population": "1291170",
                "capital": "Tallinn",
                "continentName": "Europe"
            },
            {
                "countryCode": "EG",
                "countryName": "Egypt",
                "currencyCode": "EGP",
                "population": "80471869",
                "capital": "Cairo",
                "continentName": "Africa"
            },
            {
                "countryCode": "EH",
                "countryName": "Western Sahara",
                "currencyCode": "MAD",
                "population": "273008",
                "capital": "Laâyoune / El Aaiún",
                "continentName": "Africa"
            },
            {
                "countryCode": "ER",
                "countryName": "Eritrea",
                "currencyCode": "ERN",
                "population": "5792984",
                "capital": "Asmara",
                "continentName": "Africa"
            },
            {
                "countryCode": "ES",
                "countryName": "Spain",
                "currencyCode": "EUR",
                "population": "46505963",
                "capital": "Madrid",
                "continentName": "Europe"
            },
            {
                "countryCode": "ET",
                "countryName": "Ethiopia",
                "currencyCode": "ETB",
                "population": "88013491",
                "capital": "Addis Ababa",
                "continentName": "Africa"
            },
            {
                "countryCode": "FI",
                "countryName": "Finland",
                "currencyCode": "EUR",
                "population": "5244000",
                "capital": "Helsinki",
                "continentName": "Europe"
            },
            {
                "countryCode": "FJ",
                "countryName": "Fiji",
                "currencyCode": "FJD",
                "population": "875983",
                "capital": "Suva",
                "continentName": "Oceania"
            },
            {
                "countryCode": "FK",
                "countryName": "Falkland Islands",
                "currencyCode": "FKP",
                "population": "2638",
                "capital": "Stanley",
                "continentName": "South America"
            },
            {
                "countryCode": "FM",
                "countryName": "Micronesia",
                "currencyCode": "USD",
                "population": "107708",
                "capital": "Palikir",
                "continentName": "Oceania"
            },
            {
                "countryCode": "FO",
                "countryName": "Faroe Islands",
                "currencyCode": "DKK",
                "population": "48228",
                "capital": "Tórshavn",
                "continentName": "Europe"
            },
            {
                "countryCode": "FR",
                "countryName": "France",
                "currencyCode": "EUR",
                "population": "64768389",
                "capital": "Paris",
                "continentName": "Europe"
            },
            {
                "countryCode": "GA",
                "countryName": "Gabon",
                "currencyCode": "XAF",
                "population": "1545255",
                "capital": "Libreville",
                "continentName": "Africa"
            },
            {
                "countryCode": "GB",
                "countryName": "United Kingdom",
                "currencyCode": "GBP",
                "population": "62348447",
                "capital": "London",
                "continentName": "Europe"
            },
            {
                "countryCode": "GD",
                "countryName": "Grenada",
                "currencyCode": "XCD",
                "population": "107818",
                "capital": "St. George's",
                "continentName": "North America"
            },
            {
                "countryCode": "GE",
                "countryName": "Georgia",
                "currencyCode": "GEL",
                "population": "4630000",
                "capital": "Tbilisi",
                "continentName": "Asia"
            },
            {
                "countryCode": "GF",
                "countryName": "French Guiana",
                "currencyCode": "EUR",
                "population": "195506",
                "capital": "Cayenne",
                "continentName": "South America"
            },
            {
                "countryCode": "GG",
                "countryName": "Guernsey",
                "currencyCode": "GBP",
                "population": "65228",
                "capital": "St Peter Port",
                "continentName": "Europe"
            },
            {
                "countryCode": "GH",
                "countryName": "Ghana",
                "currencyCode": "GHS",
                "population": "24339838",
                "capital": "Accra",
                "continentName": "Africa"
            },
            {
                "countryCode": "GI",
                "countryName": "Gibraltar",
                "currencyCode": "GIP",
                "population": "27884",
                "capital": "Gibraltar",
                "continentName": "Europe"
            },
            {
                "countryCode": "GL",
                "countryName": "Greenland",
                "currencyCode": "DKK",
                "population": "56375",
                "capital": "Nuuk",
                "continentName": "North America"
            },
            {
                "countryCode": "GM",
                "countryName": "Gambia",
                "currencyCode": "GMD",
                "population": "1593256",
                "capital": "Bathurst",
                "continentName": "Africa"
            },
            {
                "countryCode": "GN",
                "countryName": "Guinea",
                "currencyCode": "GNF",
                "population": "10324025",
                "capital": "Conakry",
                "continentName": "Africa"
            },
            {
                "countryCode": "GP",
                "countryName": "Guadeloupe",
                "currencyCode": "EUR",
                "population": "443000",
                "capital": "Basse-Terre",
                "continentName": "North America"
            },
            {
                "countryCode": "GQ",
                "countryName": "Equatorial Guinea",
                "currencyCode": "XAF",
                "population": "1014999",
                "capital": "Malabo",
                "continentName": "Africa"
            },
            {
                "countryCode": "GR",
                "countryName": "Greece",
                "currencyCode": "EUR",
                "population": "11000000",
                "capital": "Athens",
                "continentName": "Europe"
            },
            {
                "countryCode": "GS",
                "countryName": "South Georgia and the South Sandwich Islands",
                "currencyCode": "GBP",
                "population": "30",
                "capital": "Grytviken",
                "continentName": "Antarctica"
            },
            {
                "countryCode": "GT",
                "countryName": "Guatemala",
                "currencyCode": "GTQ",
                "population": "13550440",
                "capital": "Guatemala City",
                "continentName": "North America"
            },
            {
                "countryCode": "GU",
                "countryName": "Guam",
                "currencyCode": "USD",
                "population": "159358",
                "capital": "Hagåtña",
                "continentName": "Oceania"
            },
            {
                "countryCode": "GW",
                "countryName": "Guinea-Bissau",
                "currencyCode": "XOF",
                "population": "1565126",
                "capital": "Bissau",
                "continentName": "Africa"
            },
            {
                "countryCode": "GY",
                "countryName": "Guyana",
                "currencyCode": "GYD",
                "population": "748486",
                "capital": "Georgetown",
                "continentName": "South America"
            },
            {
                "countryCode": "HK",
                "countryName": "Hong Kong",
                "currencyCode": "HKD",
                "population": "6898686",
                "capital": "Hong Kong",
                "continentName": "Asia"
            },
            {
                "countryCode": "HM",
                "countryName": "Heard Island and McDonald Islands",
                "currencyCode": "AUD",
                "population": "0",
                "capital": "",
                "continentName": "Antarctica"
            },
            {
                "countryCode": "HN",
                "countryName": "Honduras",
                "currencyCode": "HNL",
                "population": "7989415",
                "capital": "Tegucigalpa",
                "continentName": "North America"
            },
            {
                "countryCode": "HR",
                "countryName": "Croatia",
                "currencyCode": "HRK",
                "population": "4284889",
                "capital": "Zagreb",
                "continentName": "Europe"
            },
            {
                "countryCode": "HT",
                "countryName": "Haiti",
                "currencyCode": "HTG",
                "population": "9648924",
                "capital": "Port-au-Prince",
                "continentName": "North America"
            },
            {
                "countryCode": "HU",
                "countryName": "Hungary",
                "currencyCode": "HUF",
                "population": "9982000",
                "capital": "Budapest",
                "continentName": "Europe"
            },
            {
                "countryCode": "ID",
                "countryName": "Indonesia",
                "currencyCode": "IDR",
                "population": "242968342",
                "capital": "Jakarta",
                "continentName": "Asia"
            },
            {
                "countryCode": "IE",
                "countryName": "Ireland",
                "currencyCode": "EUR",
                "population": "4622917",
                "capital": "Dublin",
                "continentName": "Europe"
            },
            {
                "countryCode": "IL",
                "countryName": "Israel",
                "currencyCode": "ILS",
                "population": "7353985",
                "capital": "",
                "continentName": "Asia"
            },
            {
                "countryCode": "IM",
                "countryName": "Isle of Man",
                "currencyCode": "GBP",
                "population": "75049",
                "capital": "Douglas",
                "continentName": "Europe"
            },
            {
                "countryCode": "IN",
                "countryName": "India",
                "currencyCode": "INR",
                "population": "1173108018",
                "capital": "New Delhi",
                "continentName": "Asia"
            },
            {
                "countryCode": "IO",
                "countryName": "British Indian Ocean Territory",
                "currencyCode": "USD",
                "population": "4000",
                "capital": "",
                "continentName": "Asia"
            },
            {
                "countryCode": "IQ",
                "countryName": "Iraq",
                "currencyCode": "IQD",
                "population": "29671605",
                "capital": "Baghdad",
                "continentName": "Asia"
            },
            {
                "countryCode": "IR",
                "countryName": "Iran",
                "currencyCode": "IRR",
                "population": "76923300",
                "capital": "Tehran",
                "continentName": "Asia"
            },
            {
                "countryCode": "IS",
                "countryName": "Iceland",
                "currencyCode": "ISK",
                "population": "308910",
                "capital": "Reykjavik",
                "continentName": "Europe"
            },
            {
                "countryCode": "IT",
                "countryName": "Italy",
                "currencyCode": "EUR",
                "population": "60340328",
                "capital": "Rome",
                "continentName": "Europe"
            },
            {
                "countryCode": "JE",
                "countryName": "Jersey",
                "currencyCode": "GBP",
                "population": "90812",
                "capital": "Saint Helier",
                "continentName": "Europe"
            },
            {
                "countryCode": "JM",
                "countryName": "Jamaica",
                "currencyCode": "JMD",
                "population": "2847232",
                "capital": "Kingston",
                "continentName": "North America"
            },
            {
                "countryCode": "JO",
                "countryName": "Jordan",
                "currencyCode": "JOD",
                "population": "6407085",
                "capital": "Amman",
                "continentName": "Asia"
            },
            {
                "countryCode": "JP",
                "countryName": "Japan",
                "currencyCode": "JPY",
                "population": "127288000",
                "capital": "Tokyo",
                "continentName": "Asia"
            },
            {
                "countryCode": "KE",
                "countryName": "Kenya",
                "currencyCode": "KES",
                "population": "40046566",
                "capital": "Nairobi",
                "continentName": "Africa"
            },
            {
                "countryCode": "KG",
                "countryName": "Kyrgyzstan",
                "currencyCode": "KGS",
                "population": "5776500",
                "capital": "Bishkek",
                "continentName": "Asia"
            },
            {
                "countryCode": "KH",
                "countryName": "Cambodia",
                "currencyCode": "KHR",
                "population": "14453680",
                "capital": "Phnom Penh",
                "continentName": "Asia"
            },
            {
                "countryCode": "KI",
                "countryName": "Kiribati",
                "currencyCode": "AUD",
                "population": "92533",
                "capital": "Tarawa",
                "continentName": "Oceania"
            },
            {
                "countryCode": "KM",
                "countryName": "Comoros",
                "currencyCode": "KMF",
                "population": "773407",
                "capital": "Moroni",
                "continentName": "Africa"
            },
            {
                "countryCode": "KN",
                "countryName": "Saint Kitts and Nevis",
                "currencyCode": "XCD",
                "population": "51134",
                "capital": "Basseterre",
                "continentName": "North America"
            },
            {
                "countryCode": "KP",
                "countryName": "North Korea",
                "currencyCode": "KPW",
                "population": "22912177",
                "capital": "Pyongyang",
                "continentName": "Asia"
            },
            {
                "countryCode": "KR",
                "countryName": "South Korea",
                "currencyCode": "KRW",
                "population": "48422644",
                "capital": "Seoul",
                "continentName": "Asia"
            },
            {
                "countryCode": "KW",
                "countryName": "Kuwait",
                "currencyCode": "KWD",
                "population": "2789132",
                "capital": "Kuwait City",
                "continentName": "Asia"
            },
            {
                "countryCode": "KY",
                "countryName": "Cayman Islands",
                "currencyCode": "KYD",
                "population": "44270",
                "capital": "George Town",
                "continentName": "North America"
            },
            {
                "countryCode": "KZ",
                "countryName": "Kazakhstan",
                "currencyCode": "KZT",
                "population": "15340000",
                "capital": "Astana",
                "continentName": "Asia"
            },
            {
                "countryCode": "LA",
                "countryName": "Laos",
                "currencyCode": "LAK",
                "population": "6368162",
                "capital": "Vientiane",
                "continentName": "Asia"
            },
            {
                "countryCode": "LB",
                "countryName": "Lebanon",
                "currencyCode": "LBP",
                "population": "4125247",
                "capital": "Beirut",
                "continentName": "Asia"
            },
            {
                "countryCode": "LC",
                "countryName": "Saint Lucia",
                "currencyCode": "XCD",
                "population": "160922",
                "capital": "Castries",
                "continentName": "North America"
            },
            {
                "countryCode": "LI",
                "countryName": "Liechtenstein",
                "currencyCode": "CHF",
                "population": "35000",
                "capital": "Vaduz",
                "continentName": "Europe"
            },
            {
                "countryCode": "LK",
                "countryName": "Sri Lanka",
                "currencyCode": "LKR",
                "population": "21513990",
                "capital": "Colombo",
                "continentName": "Asia"
            },
            {
                "countryCode": "LR",
                "countryName": "Liberia",
                "currencyCode": "LRD",
                "population": "3685076",
                "capital": "Monrovia",
                "continentName": "Africa"
            },
            {
                "countryCode": "LS",
                "countryName": "Lesotho",
                "currencyCode": "LSL",
                "population": "1919552",
                "capital": "Maseru",
                "continentName": "Africa"
            },
            {
                "countryCode": "LT",
                "countryName": "Lithuania",
                "currencyCode": "EUR",
                "population": "2944459",
                "capital": "Vilnius",
                "continentName": "Europe"
            },
            {
                "countryCode": "LU",
                "countryName": "Luxembourg",
                "currencyCode": "EUR",
                "population": "497538",
                "capital": "Luxembourg",
                "continentName": "Europe"
            },
            {
                "countryCode": "LV",
                "countryName": "Latvia",
                "currencyCode": "EUR",
                "population": "2217969",
                "capital": "Riga",
                "continentName": "Europe"
            },
            {
                "countryCode": "LY",
                "countryName": "Libya",
                "currencyCode": "LYD",
                "population": "6461454",
                "capital": "Tripoli",
                "continentName": "Africa"
            },
            {
                "countryCode": "MA",
                "countryName": "Morocco",
                "currencyCode": "MAD",
                "population": "33848242",
                "capital": "Rabat",
                "continentName": "Africa"
            },
            {
                "countryCode": "MC",
                "countryName": "Monaco",
                "currencyCode": "EUR",
                "population": "32965",
                "capital": "Monaco",
                "continentName": "Europe"
            },
            {
                "countryCode": "MD",
                "countryName": "Moldova",
                "currencyCode": "MDL",
                "population": "4324000",
                "capital": "Chişinău",
                "continentName": "Europe"
            },
            {
                "countryCode": "ME",
                "countryName": "Montenegro",
                "currencyCode": "EUR",
                "population": "666730",
                "capital": "Podgorica",
                "continentName": "Europe"
            },
            {
                "countryCode": "MF",
                "countryName": "Saint Martin",
                "currencyCode": "EUR",
                "population": "35925",
                "capital": "Marigot",
                "continentName": "North America"
            },
            {
                "countryCode": "MG",
                "countryName": "Madagascar",
                "currencyCode": "MGA",
                "population": "21281844",
                "capital": "Antananarivo",
                "continentName": "Africa"
            },
            {
                "countryCode": "MH",
                "countryName": "Marshall Islands",
                "currencyCode": "USD",
                "population": "65859",
                "capital": "Majuro",
                "continentName": "Oceania"
            },
            {
                "countryCode": "MK",
                "countryName": "Macedonia",
                "currencyCode": "MKD",
                "population": "2062294",
                "capital": "Skopje",
                "continentName": "Europe"
            },
            {
                "countryCode": "ML",
                "countryName": "Mali",
                "currencyCode": "XOF",
                "population": "13796354",
                "capital": "Bamako",
                "continentName": "Africa"
            },
            {
                "countryCode": "MM",
                "countryName": "Myanmar [Burma]",
                "currencyCode": "MMK",
                "population": "53414374",
                "capital": "Naypyitaw",
                "continentName": "Asia"
            },
            {
                "countryCode": "MN",
                "countryName": "Mongolia",
                "currencyCode": "MNT",
                "population": "3086918",
                "capital": "Ulan Bator",
                "continentName": "Asia"
            },
            {
                "countryCode": "MO",
                "countryName": "Macao",
                "currencyCode": "MOP",
                "population": "449198",
                "capital": "Macao",
                "continentName": "Asia"
            },
            {
                "countryCode": "MP",
                "countryName": "Northern Mariana Islands",
                "currencyCode": "USD",
                "population": "53883",
                "capital": "Saipan",
                "continentName": "Oceania"
            },
            {
                "countryCode": "MQ",
                "countryName": "Martinique",
                "currencyCode": "EUR",
                "population": "432900",
                "capital": "Fort-de-France",
                "continentName": "North America"
            },
            {
                "countryCode": "MR",
                "countryName": "Mauritania",
                "currencyCode": "MRO",
                "population": "3205060",
                "capital": "Nouakchott",
                "continentName": "Africa"
            },
            {
                "countryCode": "MS",
                "countryName": "Montserrat",
                "currencyCode": "XCD",
                "population": "9341",
                "capital": "Plymouth",
                "continentName": "North America"
            },
            {
                "countryCode": "MT",
                "countryName": "Malta",
                "currencyCode": "EUR",
                "population": "403000",
                "capital": "Valletta",
                "continentName": "Europe"
            },
            {
                "countryCode": "MU",
                "countryName": "Mauritius",
                "currencyCode": "MUR",
                "population": "1294104",
                "capital": "Port Louis",
                "continentName": "Africa"
            },
            {
                "countryCode": "MV",
                "countryName": "Maldives",
                "currencyCode": "MVR",
                "population": "395650",
                "capital": "Malé",
                "continentName": "Asia"
            },
            {
                "countryCode": "MW",
                "countryName": "Malawi",
                "currencyCode": "MWK",
                "population": "15447500",
                "capital": "Lilongwe",
                "continentName": "Africa"
            },
            {
                "countryCode": "MX",
                "countryName": "Mexico",
                "currencyCode": "MXN",
                "population": "112468855",
                "capital": "Mexico City",
                "continentName": "North America"
            },
            {
                "countryCode": "MY",
                "countryName": "Malaysia",
                "currencyCode": "MYR",
                "population": "28274729",
                "capital": "Kuala Lumpur",
                "continentName": "Asia"
            },
            {
                "countryCode": "MZ",
                "countryName": "Mozambique",
                "currencyCode": "MZN",
                "population": "22061451",
                "capital": "Maputo",
                "continentName": "Africa"
            },
            {
                "countryCode": "NA",
                "countryName": "Namibia",
                "currencyCode": "NAD",
                "population": "2128471",
                "capital": "Windhoek",
                "continentName": "Africa"
            },
            {
                "countryCode": "NC",
                "countryName": "New Caledonia",
                "currencyCode": "XPF",
                "population": "216494",
                "capital": "Noumea",
                "continentName": "Oceania"
            },
            {
                "countryCode": "NE",
                "countryName": "Niger",
                "currencyCode": "XOF",
                "population": "15878271",
                "capital": "Niamey",
                "continentName": "Africa"
            },
            {
                "countryCode": "NF",
                "countryName": "Norfolk Island",
                "currencyCode": "AUD",
                "population": "1828",
                "capital": "Kingston",
                "continentName": "Oceania"
            },
            {
                "countryCode": "NG",
                "countryName": "Nigeria",
                "currencyCode": "NGN",
                "population": "154000000",
                "capital": "Abuja",
                "continentName": "Africa"
            },
            {
                "countryCode": "NI",
                "countryName": "Nicaragua",
                "currencyCode": "NIO",
                "population": "5995928",
                "capital": "Managua",
                "continentName": "North America"
            },
            {
                "countryCode": "NL",
                "countryName": "Netherlands",
                "currencyCode": "EUR",
                "population": "16645000",
                "capital": "Amsterdam",
                "continentName": "Europe"
            },
            {
                "countryCode": "NO",
                "countryName": "Norway",
                "currencyCode": "NOK",
                "population": "5009150",
                "capital": "Oslo",
                "continentName": "Europe"
            },
            {
                "countryCode": "NP",
                "countryName": "Nepal",
                "currencyCode": "NPR",
                "population": "28951852",
                "capital": "Kathmandu",
                "continentName": "Asia"
            },
            {
                "countryCode": "NR",
                "countryName": "Nauru",
                "currencyCode": "AUD",
                "population": "10065",
                "capital": "Yaren",
                "continentName": "Oceania"
            },
            {
                "countryCode": "NU",
                "countryName": "Niue",
                "currencyCode": "NZD",
                "population": "2166",
                "capital": "Alofi",
                "continentName": "Oceania"
            },
            {
                "countryCode": "NZ",
                "countryName": "New Zealand",
                "currencyCode": "NZD",
                "population": "4252277",
                "capital": "Wellington",
                "continentName": "Oceania"
            },
            {
                "countryCode": "OM",
                "countryName": "Oman",
                "currencyCode": "OMR",
                "population": "2967717",
                "capital": "Muscat",
                "continentName": "Asia"
            },
            {
                "countryCode": "PA",
                "countryName": "Panama",
                "currencyCode": "PAB",
                "population": "3410676",
                "capital": "Panama City",
                "continentName": "North America"
            },
            {
                "countryCode": "PE",
                "countryName": "Peru",
                "currencyCode": "PEN",
                "population": "29907003",
                "capital": "Lima",
                "continentName": "South America"
            },
            {
                "countryCode": "PF",
                "countryName": "French Polynesia",
                "currencyCode": "XPF",
                "population": "270485",
                "capital": "Papeete",
                "continentName": "Oceania"
            },
            {
                "countryCode": "PG",
                "countryName": "Papua New Guinea",
                "currencyCode": "PGK",
                "population": "6064515",
                "capital": "Port Moresby",
                "continentName": "Oceania"
            },
            {
                "countryCode": "PH",
                "countryName": "Philippines",
                "currencyCode": "PHP",
                "population": "99900177",
                "capital": "Manila",
                "continentName": "Asia"
            },
            {
                "countryCode": "PK",
                "countryName": "Pakistan",
                "currencyCode": "PKR",
                "population": "184404791",
                "capital": "Islamabad",
                "continentName": "Asia"
            },
            {
                "countryCode": "PL",
                "countryName": "Poland",
                "currencyCode": "PLN",
                "population": "38500000",
                "capital": "Warsaw",
                "continentName": "Europe"
            },
            {
                "countryCode": "PM",
                "countryName": "Saint Pierre and Miquelon",
                "currencyCode": "EUR",
                "population": "7012",
                "capital": "Saint-Pierre",
                "continentName": "North America"
            },
            {
                "countryCode": "PN",
                "countryName": "Pitcairn Islands",
                "currencyCode": "NZD",
                "population": "46",
                "capital": "Adamstown",
                "continentName": "Oceania"
            },
            {
                "countryCode": "PR",
                "countryName": "Puerto Rico",
                "currencyCode": "USD",
                "population": "3916632",
                "capital": "San Juan",
                "continentName": "North America"
            },
            {
                "countryCode": "PS",
                "countryName": "Palestine",
                "currencyCode": "ILS",
                "population": "3800000",
                "capital": "",
                "continentName": "Asia"
            },
            {
                "countryCode": "PT",
                "countryName": "Portugal",
                "currencyCode": "EUR",
                "population": "10676000",
                "capital": "Lisbon",
                "continentName": "Europe"
            },
            {
                "countryCode": "PW",
                "countryName": "Palau",
                "currencyCode": "USD",
                "population": "19907",
                "capital": "Melekeok",
                "continentName": "Oceania"
            },
            {
                "countryCode": "PY",
                "countryName": "Paraguay",
                "currencyCode": "PYG",
                "population": "6375830",
                "capital": "Asunción",
                "continentName": "South America"
            },
            {
                "countryCode": "QA",
                "countryName": "Qatar",
                "currencyCode": "QAR",
                "population": "840926",
                "capital": "Doha",
                "continentName": "Asia"
            },
            {
                "countryCode": "RE",
                "countryName": "Réunion",
                "currencyCode": "EUR",
                "population": "776948",
                "capital": "Saint-Denis",
                "continentName": "Africa"
            },
            {
                "countryCode": "RO",
                "countryName": "Romania",
                "currencyCode": "RON",
                "population": "21959278",
                "capital": "Bucharest",
                "continentName": "Europe"
            },
            {
                "countryCode": "RS",
                "countryName": "Serbia",
                "currencyCode": "RSD",
                "population": "7344847",
                "capital": "Belgrade",
                "continentName": "Europe"
            },
            {
                "countryCode": "RU",
                "countryName": "Russia",
                "currencyCode": "RUB",
                "population": "140702000",
                "capital": "Moscow",
                "continentName": "Europe"
            },
            {
                "countryCode": "RW",
                "countryName": "Rwanda",
                "currencyCode": "RWF",
                "population": "11055976",
                "capital": "Kigali",
                "continentName": "Africa"
            },
            {
                "countryCode": "SA",
                "countryName": "Saudi Arabia",
                "currencyCode": "SAR",
                "population": "25731776",
                "capital": "Riyadh",
                "continentName": "Asia"
            },
            {
                "countryCode": "SB",
                "countryName": "Solomon Islands",
                "currencyCode": "SBD",
                "population": "559198",
                "capital": "Honiara",
                "continentName": "Oceania"
            },
            {
                "countryCode": "SC",
                "countryName": "Seychelles",
                "currencyCode": "SCR",
                "population": "88340",
                "capital": "Victoria",
                "continentName": "Africa"
            },
            {
                "countryCode": "SD",
                "countryName": "Sudan",
                "currencyCode": "SDG",
                "population": "35000000",
                "capital": "Khartoum",
                "continentName": "Africa"
            },
            {
                "countryCode": "SE",
                "countryName": "Sweden",
                "currencyCode": "SEK",
                "population": "9828655",
                "capital": "Stockholm",
                "continentName": "Europe"
            },
            {
                "countryCode": "SG",
                "countryName": "Singapore",
                "currencyCode": "SGD",
                "population": "4701069",
                "capital": "Singapore",
                "continentName": "Asia"
            },
            {
                "countryCode": "SH",
                "countryName": "Saint Helena",
                "currencyCode": "SHP",
                "population": "7460",
                "capital": "Jamestown",
                "continentName": "Africa"
            },
            {
                "countryCode": "SI",
                "countryName": "Slovenia",
                "currencyCode": "EUR",
                "population": "2007000",
                "capital": "Ljubljana",
                "continentName": "Europe"
            },
            {
                "countryCode": "SJ",
                "countryName": "Svalbard and Jan Mayen",
                "currencyCode": "NOK",
                "population": "2550",
                "capital": "Longyearbyen",
                "continentName": "Europe"
            },
            {
                "countryCode": "SK",
                "countryName": "Slovakia",
                "currencyCode": "EUR",
                "population": "5455000",
                "capital": "Bratislava",
                "continentName": "Europe"
            },
            {
                "countryCode": "SL",
                "countryName": "Sierra Leone",
                "currencyCode": "SLL",
                "population": "5245695",
                "capital": "Freetown",
                "continentName": "Africa"
            },
            {
                "countryCode": "SM",
                "countryName": "San Marino",
                "currencyCode": "EUR",
                "population": "31477",
                "capital": "San Marino",
                "continentName": "Europe"
            },
            {
                "countryCode": "SN",
                "countryName": "Senegal",
                "currencyCode": "XOF",
                "population": "12323252",
                "capital": "Dakar",
                "continentName": "Africa"
            },
            {
                "countryCode": "SO",
                "countryName": "Somalia",
                "currencyCode": "SOS",
                "population": "10112453",
                "capital": "Mogadishu",
                "continentName": "Africa"
            },
            {
                "countryCode": "SR",
                "countryName": "Suriname",
                "currencyCode": "SRD",
                "population": "492829",
                "capital": "Paramaribo",
                "continentName": "South America"
            },
            {
                "countryCode": "SS",
                "countryName": "South Sudan",
                "currencyCode": "SSP",
                "population": "8260490",
                "capital": "Juba",
                "continentName": "Africa"
            },
            {
                "countryCode": "ST",
                "countryName": "São Tomé and Príncipe",
                "currencyCode": "STD",
                "population": "175808",
                "capital": "São Tomé",
                "continentName": "Africa"
            },
            {
                "countryCode": "SV",
                "countryName": "El Salvador",
                "currencyCode": "USD",
                "population": "6052064",
                "capital": "San Salvador",
                "continentName": "North America"
            },
            {
                "countryCode": "SX",
                "countryName": "Sint Maarten",
                "currencyCode": "ANG",
                "population": "37429",
                "capital": "Philipsburg",
                "continentName": "North America"
            },
            {
                "countryCode": "SY",
                "countryName": "Syria",
                "currencyCode": "SYP",
                "population": "22198110",
                "capital": "Damascus",
                "continentName": "Asia"
            },
            {
                "countryCode": "SZ",
                "countryName": "Swaziland",
                "currencyCode": "SZL",
                "population": "1354051",
                "capital": "Mbabane",
                "continentName": "Africa"
            },
            {
                "countryCode": "TC",
                "countryName": "Turks and Caicos Islands",
                "currencyCode": "USD",
                "population": "20556",
                "capital": "Cockburn Town",
                "continentName": "North America"
            },
            {
                "countryCode": "TD",
                "countryName": "Chad",
                "currencyCode": "XAF",
                "population": "10543464",
                "capital": "N'Djamena",
                "continentName": "Africa"
            },
            {
                "countryCode": "TF",
                "countryName": "French Southern Territories",
                "currencyCode": "EUR",
                "population": "140",
                "capital": "Port-aux-Français",
                "continentName": "Antarctica"
            },
            {
                "countryCode": "TG",
                "countryName": "Togo",
                "currencyCode": "XOF",
                "population": "6587239",
                "capital": "Lomé",
                "continentName": "Africa"
            },
            {
                "countryCode": "TH",
                "countryName": "Thailand",
                "currencyCode": "THB",
                "population": "67089500",
                "capital": "Bangkok",
                "continentName": "Asia"
            },
            {
                "countryCode": "TJ",
                "countryName": "Tajikistan",
                "currencyCode": "TJS",
                "population": "7487489",
                "capital": "Dushanbe",
                "continentName": "Asia"
            },
            {
                "countryCode": "TK",
                "countryName": "Tokelau",
                "currencyCode": "NZD",
                "population": "1466",
                "capital": "",
                "continentName": "Oceania"
            },
            {
                "countryCode": "TL",
                "countryName": "East Timor",
                "currencyCode": "USD",
                "population": "1154625",
                "capital": "Dili",
                "continentName": "Oceania"
            },
            {
                "countryCode": "TM",
                "countryName": "Turkmenistan",
                "currencyCode": "TMT",
                "population": "4940916",
                "capital": "Ashgabat",
                "continentName": "Asia"
            },
            {
                "countryCode": "TN",
                "countryName": "Tunisia",
                "currencyCode": "TND",
                "population": "10589025",
                "capital": "Tunis",
                "continentName": "Africa"
            },
            {
                "countryCode": "TO",
                "countryName": "Tonga",
                "currencyCode": "TOP",
                "population": "122580",
                "capital": "Nuku'alofa",
                "continentName": "Oceania"
            },
            {
                "countryCode": "TR",
                "countryName": "Turkey",
                "currencyCode": "TRY",
                "population": "77804122",
                "capital": "Ankara",
                "continentName": "Asia"
            },
            {
                "countryCode": "TT",
                "countryName": "Trinidad and Tobago",
                "currencyCode": "TTD",
                "population": "1228691",
                "capital": "Port of Spain",
                "continentName": "North America"
            },
            {
                "countryCode": "TV",
                "countryName": "Tuvalu",
                "currencyCode": "AUD",
                "population": "10472",
                "capital": "Funafuti",
                "continentName": "Oceania"
            },
            {
                "countryCode": "TW",
                "countryName": "Taiwan",
                "currencyCode": "TWD",
                "population": "22894384",
                "capital": "Taipei",
                "continentName": "Asia"
            },
            {
                "countryCode": "TZ",
                "countryName": "Tanzania",
                "currencyCode": "TZS",
                "population": "41892895",
                "capital": "Dodoma",
                "continentName": "Africa"
            },
            {
                "countryCode": "UA",
                "countryName": "Ukraine",
                "currencyCode": "UAH",
                "population": "45415596",
                "capital": "Kiev",
                "continentName": "Europe"
            },
            {
                "countryCode": "UG",
                "countryName": "Uganda",
                "currencyCode": "UGX",
                "population": "33398682",
                "capital": "Kampala",
                "continentName": "Africa"
            },
            {
                "countryCode": "UM",
                "countryName": "U.S. Minor Outlying Islands",
                "currencyCode": "USD",
                "population": "0",
                "capital": "",
                "continentName": "Oceania"
            },
            {
                "countryCode": "US",
                "countryName": "United States",
                "currencyCode": "USD",
                "population": "310232863",
                "capital": "Washington",
                "continentName": "North America"
            },
            {
                "countryCode": "UY",
                "countryName": "Uruguay",
                "currencyCode": "UYU",
                "population": "3477000",
                "capital": "Montevideo",
                "continentName": "South America"
            },
            {
                "countryCode": "UZ",
                "countryName": "Uzbekistan",
                "currencyCode": "UZS",
                "population": "27865738",
                "capital": "Tashkent",
                "continentName": "Asia"
            },
            {
                "countryCode": "VA",
                "countryName": "Vatican City",
                "currencyCode": "EUR",
                "population": "921",
                "capital": "Vatican City",
                "continentName": "Europe"
            },
            {
                "countryCode": "VC",
                "countryName": "Saint Vincent and the Grenadines",
                "currencyCode": "XCD",
                "population": "104217",
                "capital": "Kingstown",
                "continentName": "North America"
            },
            {
                "countryCode": "VE",
                "countryName": "Venezuela",
                "currencyCode": "VEF",
                "population": "27223228",
                "capital": "Caracas",
                "continentName": "South America"
            },
            {
                "countryCode": "VG",
                "countryName": "British Virgin Islands",
                "currencyCode": "USD",
                "population": "21730",
                "capital": "Road Town",
                "continentName": "North America"
            },
            {
                "countryCode": "VI",
                "countryName": "U.S. Virgin Islands",
                "currencyCode": "USD",
                "population": "108708",
                "capital": "Charlotte Amalie",
                "continentName": "North America"
            },
            {
                "countryCode": "VN",
                "countryName": "Vietnam",
                "currencyCode": "VND",
                "population": "89571130",
                "capital": "Hanoi",
                "continentName": "Asia"
            },
            {
                "countryCode": "VU",
                "countryName": "Vanuatu",
                "currencyCode": "VUV",
                "population": "221552",
                "capital": "Port Vila",
                "continentName": "Oceania"
            },
            {
                "countryCode": "WF",
                "countryName": "Wallis and Futuna",
                "currencyCode": "XPF",
                "population": "16025",
                "capital": "Mata-Utu",
                "continentName": "Oceania"
            },
            {
                "countryCode": "WS",
                "countryName": "Samoa",
                "currencyCode": "WST",
                "population": "192001",
                "capital": "Apia",
                "continentName": "Oceania"
            },
            {
                "countryCode": "XK",
                "countryName": "Kosovo",
                "currencyCode": "EUR",
                "population": "1800000",
                "capital": "Pristina",
                "continentName": "Europe"
            },
            {
                "countryCode": "YE",
                "countryName": "Yemen",
                "currencyCode": "YER",
                "population": "23495361",
                "capital": "Sanaa",
                "continentName": "Asia"
            },
            {
                "countryCode": "YT",
                "countryName": "Mayotte",
                "currencyCode": "EUR",
                "population": "159042",
                "capital": "Mamoudzou",
                "continentName": "Africa"
            },
            {
                "countryCode": "ZA",
                "countryName": "South Africa",
                "currencyCode": "ZAR",
                "population": "49000000",
                "capital": "Pretoria",
                "continentName": "Africa"
            },
            {
                "countryCode": "ZM",
                "countryName": "Zambia",
                "currencyCode": "ZMW",
                "population": "13460305",
                "capital": "Lusaka",
                "continentName": "Africa"
            },
            {
                "countryCode": "ZW",
                "countryName": "Zimbabwe",
                "currencyCode": "ZWL",
                "population": "13061000",
                "capital": "Harare",
                "continentName": "Africa"
            }
        ]
    }
}









//Create web admin post

        $("#mstr_select_actegory").on("change",function(data){
          loadcategory();
        });


                         <!--  <?php $master_id= "0"; ?>
                  @foreach($data_j[1] as $emails)
                    
                    @if($master_id == $emails->msid)
                    <option class="{{$emails->msid+524}}" value="{{$emails->sid+1042}}">{{ucfirst($emails->sname)}}{{$master_id}}</option>
                    @else
                    <optgroup disabled label=" d" class="{{$emails->msid+524}}"></optgroup>  
                    <option class="{{$emails->msid+524}}" value="{{$emails->sid+1042}}">{{ucfirst($emails->sname)}}</option>
                    <?php $master_id = $emails->msid; ?>
                    @endif
                  @endforeach   -->

//create web admin post





//Filter by company post


@foreach($load_company_advertiesments as $company_posts_data)
                    
                  @if(!array_key_exists($company_posts_data->pmid, $checked_categoryies))
                      <?php array_push( $checked_categoryies,array($company_posts_data->pmid => $company_posts_data->pmname) ); ?>
                  @endif
                            <div class="col-sm-2 padding_5555">
                                  <a href="{{route('single_advetrtisers')}}">   
                                  <div class="card text-left post_ad_color post_ad_color" >
                                    <img src="https://fdn.gsmarena.com/imgroot//reviews/16/apple-iphone-se/gal/-1024x768w1/gsmarena_003.jpg" style="width: 100%;height: 140px;">
                                    <div class="card-body">
                                      <p class="card-text" style="font-size: 15px;color: black;margin-bottom: 0px;text-transform: capitalize;">
                        {{$company_posts_data->ptitle}}   
                      </p>
                                      <p class="card-text" style="margin-bottom: 4px"><small class="text-muted">
                          {{\Carbon\Carbon::create($company_posts_data->pcreated)->diffForHumans()}}        
                      </small><small style="float: right;padding-top: 4px;">Limited Offer</small>
                       <br>
                       <p style="display: flex;"><span class="offer_load_spinner" style="background-color: white;">$10.00</span><span class="offer_load_spinner_1" style="background-color: white"></span><span class="offer_load_spinner_2" style="background-color: white">$8.00</span></p> 
                      </p>

                                    </div>
                                  </div>
                                  </a>
                            </div>
                  @endforeach


.// end of filter by company post



//Summer note master admin

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
      $(document).ready(function () {
          $('#summernote_policy_update ,#summernote_advertiestment_policy , #summernote_about_us').summernote({
            placeholder: 'Please enter your content',
            tabsize: 2,
            height: 100
          });
      });
</script>


//end of Summer note master admin                  