<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   	<meta name="description" content="">
   	<meta name="csrf-token" content="{{ csrf_token() }}" />
   	<meta name="content-sec-id" id="content-sec-id" content="{{ csrf_token()}}">
    <meta name="author" content="Arshad_F">
    <title>Noydl.Com | Needs Of Your Entire Life | Forgot Password</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- BASE CSS -->
    <link href="{{asset('postAdvertisersLoad/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('postAdvertisersLoad/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('postAdvertisersLoad/css/vendors.css')}}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('postAdvertisersLoad/css/custom.css')}}" rel="stylesheet">
    	<style type="text/css">
		@font-face {
		    font-family: "Abel";
		    src: url({{asset('postAdvertisersLoad/assets/fonts/login_page_font.ttf')}}) format("truetype");
		}
		body{
			font-family: "Abel";
		}
		#error_on_forgot_password_page{
			display: none;
			background-color: #fdf6f6;
			border-radius: 3px; 
			padding: 5px 0px 0px 0px; 
			border:1px solid #d88686;
		}
		#error_on_forgot_password_page h6{
			color: red;
		}
		.details_display_div{
			text-align: center;
		}
		#success_on_forgot_password_page{
			display: none;
			background-color: #f7fdf6;
			border-radius: 3px; 
			padding: 5px 0px 0px 0px; 
			border:1px solid #a9d886;
		}
		#success_on_forgot_password_page h6 {
			color: #287d1d;
		}
	</style>
</head>

<body id="login_bg">
	
	<nav id="menu" class="fake_menu"></nav>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	<!-- End Preload -->
	
	<div id="login">
		<aside>
			<figure>
				<a href="{{route('user_visit_homepage')}}"><img src="{{asset('common_includes/blg/noyel_masters_logo_dark.png')}}" width="100" height="36" data-retina="true" alt="" class="logo_sticky"></a>
			</figure>
			  <div class="details_display_div">
				<h4><b>Forgot Password</b></h4>
				
			  </div>	
			  
			  <div class="panel panel-header" id="error_on_forgot_password_page">
			  		<h6> &emsp;Could not find this email. <a href="{{route('site_register_nw')}}"><b>Register</b></a> </h6>
			  </div>
			  <div class="panel panel-header" id="success_on_forgot_password_page">
			  		<h6> &emsp;Reset password link sended to your mail.&emsp;</h6>
			  </div>	
			  <br>
			  <form id="user_forgot_password_form" method="post" action="{{route('make_user_register_loging')}}" autocomplete="off" target="_self" enctype="application/json">
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="forget_form_email" id="forget_form_email">
					<i class="icon_mail_alt"></i>
				</div>
				 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				
				<button  class="btn_1 rounded full-width" type="button" id="usermake_reset">Check</button>

			</form>
			<div class="copy">© Copyright &nbsp;<b>dardshadow.com</b>&nbsp; {{date('Y')}} | All right recerved <br> Powerd By <b>noydl.com</b> </div>
		</aside>
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{asset('postAdvertisersLoad/js/common_scripts.js')}}"></script>
    <script src="{{asset('postAdvertisersLoad/js/main.js')}}"></script>
	<script src="{{asset('postAdvertisersLoad/assets/validate.js')}}"></script>		
	<script type="text/javascript" src="{{asset('postAdvertisersLoad/js/ClientCrt/rollups/aes.js')}}"></script>
  	<script type="text/javascript" src="{{asset('postAdvertisersLoad/js/ClientCrt/rollups/aes-json-format.js')}}"></script>

  	<script>
		$("#user_forgot_password_form #usermake_reset").on("click",function(){
			let userName;

			var user_html_id,user_create_id;
				user_html_id = [
					"forget_form_email"
					];
				user_create_id = [
					"forget_from_email"
				];
			var sec_check_code = $('#content-sec-id')[0].content;
			var $nouser_email;
				
    			for (var i = 0; i < user_html_id.length ; i++) {

    				var load_value = data_trasfer($('#'+user_html_id[i]).val());
    				var input = document.createElement("input");
					input.type = "hidden";
					input.className = user_create_id[i];
					input.id = user_create_id[i]; 
	    			input.setAttribute("value",load_value);
	    			document.getElementById("user_forgot_password_form").appendChild(input);	

    			}
    			
    			$.ajax({
    				url: "{{route('check_email_availabily_reset')}}",
    				method: 'post',
    				async:false,
    				data: {
    					'forgot_email' : $('#'+user_create_id[0]).val(),
    					'user_sec_token' : "<?=$key?>",
    				},
    				beforeSend:function(request){
    					return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'))
    				},
    				success:function(registerStatus){
    					var dd = JSON.parse(registerStatus);
    					var status = dd.status;
    					for (var i = 0; i < 1; i++) {
    						$( "#"+user_create_id[i]).remove();
    					}
    					switch(status){
    						case 246:
    							$('#error_on_forgot_password_page').css("display","none").animate(2500);
    							$('#success_on_forgot_password_page').css("display","block");
    							break;
    						case 524:
    							$('#error_on_forgot_password_page').css("display","block");
    							$('#success_on_forgot_password_page').css("display","none");
    							break;		
    					}		
    				},
    				error:function(xh,xr){
    					for (var i = 0; i < 1; i++) {
    						$( "#"+user_create_id[i]).remove();
    					}
    					$('#error_on_forgot_password_page').css("display","block");
    					$('#success_on_forgot_password_page').css("display","none");
    				}
    				
    			});	
		});
	</script>
		<script type="text/javascript">
			var key = "<?=$key?>";
			function data_trasfer(form_input_value){ 
				var plaintext = form_input_value;
		       	encrypted = CryptoJS.AES.encrypt(JSON.stringify(plaintext), key, {format: CryptoJSAesJson}).toString();
		        return encrypted;
			}
		
	</script>
</body>
</html>