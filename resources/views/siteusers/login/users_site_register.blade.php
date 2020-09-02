<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"> 
    <!--<meta http-equiv="Content-Type" content="application/json; charset=UTF-8" /> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="content-sec-id" id="content-sec-id" content="{{ csrf_token()}}">
    <meta name="author" content="Arshad_F">
    <meta name="keywords" content="web,design,html,css,html5,development">
    <link rel="copyright" href="copyright.html">
    <meta property="og:title" content="The best site">
	<meta property="og:image" content="link_to_image">
	<meta property="og:description" content="description goes here">
	<!-- <meta http-equiv="refresh" content="300"> -->
	<meta http-equiv="robots" content="5">

    <title>Noydl.Com | Needs Of Your Entire Life | REGISTER </title>

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
		.error_messages_register,.error_message_not_user_register{
			display: none;
			background-color: #fdf6f6;
			border-radius: 3px; 
			padding: 5px 0px 0px 0px; 
			border:1px solid #d88686;
		}
		.error_messages_register h6, .error_message_not_user_register h6{
			color: red;
		}
		.error_message_not_user_register_fashl{
			background-color: #fdf6f6;
			border-radius: 3px; 
			padding: 5px 0px 0px 0px; 
			border:1px solid #d88686;
		}
		.error_message_not_user_register_fashl h6{
			color: red;
		}
		.success_messages_register{
			display: none;
			background-color: #f7fdf6;
			border-radius: 3px; 
			padding: 5px 0px 0px 0px; 
			border:1px solid #a9d886;
		}
		.success_messages_register h6 {
			color: #287d1d;
		}
		.details_display_div{
			text-align: center;
		}
	</style>
</head>

<body id="register_bg">

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
				<h4><b>Create Account</b></h4>
				<h6>Get started with your free account</h6>	
				
			</div>

			<form autocomplete="off" id="user_registration_form" autocomplete="off" target="_self">
				@if(Session::has('message'))
				<div class="panel panel-header error_message_not_user_register_fashl">
			  		<h6> &emsp;{{Session::get('message')}}</h6>
			 	</div>
				@endif

				<div class="panel panel-header success_messages_register" id="success_on_register_page">
			  		<h6> &emsp;Please check your mail <a href="#">Home</a></h6>
			 	</div>
			 	<div class="panel panel-header error_message_not_user_register" id="error_on_register_page_new_user">
			  		<h6> &emsp;Please try again</h6>
			 	</div>
				<input type="hidden" name="noyel_sec_code" id="noyel_sec_code" value="">
				<div class="form-group">
					<label>First Name</label>
					<input class="form-control" name="new_registration_form_firstname" id="new_registration_form_firstname" type="text">
					<i class="ti-user"></i>
				</div>
				<div class="panel panel-header error_messages_register" id="error_on_fn_register_page">
			  		<h6> &emsp;First name cannot be empty</h6>
			  	</div>
				<div class="form-group">
					<label>Last Name</label>
					<input class="form-control" name="new_registration_form_lastname" id="new_registration_form_lastname" type="text">
					<i class="ti-user"></i>
				</div>
				<div class="panel panel-header error_messages_register" id="error_on_ln_register_page">
			  		<h6> &emsp;Last name cannot be empty</h6>
			  	</div>
				<div class="form-group">
					<label>Email</label>
					<input class="form-control" id="new_registration_form_email" name="new_registration_form_email" type="email">
					<i class="ti-user"></i>
				</div>
				<div class="panel panel-header error_messages_register" id="error_on_em_register_page">
			  		<h6> &emsp;Please enter valid email</h6>
			 	</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" id="new_registration_form_password" name="new_registration_form_password" type="password">
					<i class="icon_lock_alt"></i>
				</div>
				<div class="form-group">
					<label>Confirm Password</label>
					<input class="form-control" type="password" name="password2" id="password2">
					<i class="icon_lock_alt"></i>
				</div>
				<div class="panel panel-header error_messages_register" id="error_on_password_register_page">
			  		<h6> &emsp;Please enter valid password</h6>
			  	</div>
			  	<br>
			  	<div class="clearfix add_bottom_30">
					<div class="checkboxes float-left">
						<label class="container_check">I agree to the <a href="{{route('termsandconprpLoad')}}">Terms and Conditions</a>
						  <input type="checkbox" id="i_have_accespted_the_terms">
						  <span class="checkmark"></span>
						</label>
					</div>
				</div>
				<div id="pass-info" class="clearfix"></div>
				<a href="javascript:(0)" id="register_new_user" class="btn_1 rounded full-width add_top_30">Register Now!</a>
				<div class="text-center add_top_10">Already have an acccount? <strong><a href="{{route('site_login_ext')}}">Sign In</a></strong></div>
			</form>
			<div class="copy">© Copyright &nbsp;<b>dardshadow.com</b>&nbsp; {{date('Y')}} | All right recerved <br> Powerd By <b>noydl.com</b> </div>
		</aside>
	</div>
	<!-- /login -->
	
	<!-- COMMON SCRIPTS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{asset('postAdvertisersLoad/js/common_scripts.js')}}"></script>
    <script src="{{asset('postAdvertisersLoad/js/main.js')}}"></script>
	<!-- <script src="{{asset('postAdvertisersLoad/assets/validate.js')}}"></script>	 -->

	<script src="{{asset('postAdvertisersLoad/js/wesite_loads.js')}}"></script>
	
	  <!-- Crypto JS -->
  	<script type="text/javascript" src="{{asset('postAdvertisersLoad/js/ClientCrt/rollups/aes.js')}}"></script>
  	<script type="text/javascript" src="{{asset('postAdvertisersLoad/js/ClientCrt/rollups/aes-json-format.js')}}"></script>
  	<script type="text/javascript" src="{{asset('postAdvertisersLoad/js/ClientCrt/rollups/pbkdf2.js')}}"></script>

	<!-- SPECIFIC SCRIPTS -->
	<script src="{{asset('postAdvertisersLoad/js/pw_strenght.js')}}"></script>
	<script >
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});	
	$(function(){
		$("#register_new_user").on("click",function(){
			let firstName,lastName,emailContent,userpassword,userreconfirm;
			firstName = checkFirstname();
			lastName = checkLastname();
			emailContent = checkEmail();
			userpassword = checkPassword();
			userreconfirm = checkPasswordConfirm();

			var checkAgreeTermsAndConditions = $("#i_have_accespted_the_terms").is(":checked");

			if(firstName && lastName && emailContent && userpassword && userreconfirm && checkAgreeTermsAndConditions){
				var user_html_id,user_create_id;
				user_html_id = [
					"new_registration_form_firstname",
					"new_registration_form_lastname",
					"new_registration_form_email",
					"new_registration_form_password"
					];
				user_create_id = [
					"new_registartion_form_firstname",
					"new_registartion_form_lastname",
					"new_registartion_form_email",
					"new_registartion_form_password"
				];
				var sec_code = $('#content-sec-id')[0].content;
				var $nofirst_name,$nolast_name,$nouser_password,$nouser_email;
				
    			
    			for (var i = 0; i < user_html_id.length ; i++) {
    				var load_value = data_trasfer($('#'+user_html_id[i]).val());
    				var input = document.createElement("input");
					input.type = "hidden";
					input.className = user_create_id[i];
					input.id = user_create_id[i]; 
	    			input.setAttribute("value",load_value);
	    			document.getElementById("user_registration_form").appendChild(input);	
    			}
    			
    			$.ajax({
    				url: "{{route('make_new_user_register')}}",
    				method: 'post',
    				async:false,
    				dataType:"json",
    				data: {
    					'first_name' : $('#'+user_create_id[0]).val(),
    					'last_name' : $('#'+user_create_id[1]).val(),
    					'user_email' : $('#'+user_create_id[2]).val(),
    					'user_password' : $('#'+user_create_id[3]).val(),
    					'user_sec_token' : "<?=$key?>",
    				},
    				beforeSend:function(request){
    					return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'))
    				},
    				success:function(registerStatus){
    					var data = registerStatus;
    					var status = data["status"];
    					switch(status){
    						case 200:
    							$("#success_on_register_page").css("display","block");
    							$("#error_on_register_page_new_user").css("display","none");
    							break;
    						case 500:
    							$("#success_on_register_page").css("display","none");
    							$("#error_on_register_page_new_user").css("display","block");
    							break;
    					}			
    					for (var i = 0; i < user_create_id.length; i++) {
    						$( "#"+user_create_id[i]).remove();
    					}
    				},
    				error:function(xhssd){
    					$("#success_on_register_page").css("display","none");
    					$("#error_on_register_page_new_user").css("display","block");
    					
    					for (var i = 0; i < user_create_id.length; i++) {
    						$( "#"+user_create_id[i]).remove();
    					}	
    				}
    				
    			});
    		}
		});

		function checkFirstname(){
			let name = $("#new_registration_form_firstname").val();
			if(name === ''){
				$("#error_on_fn_register_page").css("display","block");
				return false;
			}else{
				$("#error_on_fn_register_page").css("display","none");
				return true;
			} 	
			return false;
		}

		function checkLastname(){
			let name = $("#new_registration_form_lastname").val();
			if(name === ''){
				$("#error_on_ln_register_page").css("display","block");
				return false;
			}else{
				$("#error_on_ln_register_page").css("display","none");
				return true;
			} 	

			return false;
		}
		
		function checkEmail(){
			let email = $("#new_registration_form_email").val();
			let pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			if(email === ''){
				$("#error_on_em_register_page").css("display","block");
				return false;
			}else{
				if(pattern.test(email)){
					$("#error_on_em_register_page").css("display","none");
					return true;
				}else{
					$("#error_on_em_register_page").css("display","block");
					return false;
				}
			} 	
			return false;
		}

		function checkPassword(){
			let password = $("#new_registration_form_password").val();
			if(password === ''){
				$("#error_on_password_register_page").css("display","block");
				return false;
			}else{
				if(password.length > 5 ){
					$("#error_on_password_register_page").css("display","none");
					return true;
				}else{
					$("#error_on_password_register_page").css("display","none");
					return false;
				}
			} 	

			return false;
		}

		function checkPasswordConfirm(){
			let password = $("#new_registration_form_password").val();
			let password2 = $("#password2").val();
			if(password == password2){
				return true;
			}
			return false;
		}

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