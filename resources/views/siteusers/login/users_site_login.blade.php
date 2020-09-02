<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   	<meta name="description" content="">
   	<link rel="	canonical" href="">
   	<meta name="robots" content="index, follow">
   	<meta property="og:type" content="article" />
	<meta property="og:title" content="TITLE OF YOUR POST OR PAGE" />
	<meta property="og:description" content="DESCRIPTION OF PAGE CONTENT" />
	<meta property="og:image" content="LINK TO THE IMAGE FILE" />
	<meta property="og:url" content="PERMALINK" />
	<meta property="og:site_name" content="SITE NAME" />

   	<meta name="csrf-token" content="{{ csrf_token() }}" />
   	<meta name="content-sec-id" id="content-sec-id" content="{{ csrf_token()}}">
    <meta name="author" content="Arshad_F">
    <title>Noydl.Com | Needs Of Your Entire Life | LOGIN</title>

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
		#account_active_on_login_page{
			background-color: #f7fdf6;
			border-radius: 3px; 
			padding: 5px 0px 0px 0px; 
			border:1px solid #a9d886;
		}

		#account_active_on_login_page h6{
			color: #287d1d;
		}
		#error_on_login_page{
			display: none;
			background-color: #fdf6f6;
			border-radius: 3px; 
			padding: 5px 0px 0px 0px; 
			border:1px solid #d88686;
		}
		#error_on_login_page h6{
			color: red;
		}
		.details_display_div{
			text-align: center;
		}
		#usermake_login_loading{
			display: none;
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
				<h4><b>Member Login</b></h4>
				
			  </div>
			  @if(Session::has('message'))
				<div class="panel panel-header" id="account_active_on_login_page">
			  		<h6> &emsp;{{Session::get('message')}}</h6>
			  	</div>
			  @endif	
			  <div class="panel panel-header" id="error_on_login_page">
			  		<h6> &emsp;Invalid username or password entered</h6>
			  </div>	
			  <br>
			  <form id="user_login_form" >
				<!--method="post" autocomplete="off" target="_blank" enctype="application/json" onsubmit="return false;"  action="{{route('make_user_register_loging')}}" -->
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="loggin_form_email" id="loggin_form_email">
					<i class="icon_mail_alt"></i>
				</div>
				 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="loggin_form_password" id="loggin_form_password" value="">
					<i class="icon_lock_alt"></i>
				</div>
				<div class="clearfix add_bottom_30">
					<div class="checkboxes float-left">
						<label class="container_check">Remember me
						  <input type="checkbox">
						  <span class="checkmark"></span>
						</label>
					</div>
					<div class="float-right mt-1"><a id="forgot" href="{{route('site_reset_password_view')}}">Forgot Password?</a></div>
				</div>
				<button  class="btn_1 rounded full-width" type="button" id="usermake_login"><i class="icon-spin3 animate-spin" id="usermake_login_loading"> &emsp;Please wait</i><span id="usermake_login_text">Login</span> </button>
				<div class="text-center add_top_10">New to noyel.com <strong><a href="{{route('site_register_nw')}}">Sign up!</a></strong></div>
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
  		$(document).ready(function(){
		$("#user_login_form #usermake_login").on("click",function(e){
			$("#usermake_login").attr("disabled",true);
			var w =  $("#usermake_login").is(":disabled");
			$("#usermake_login").removeAttr("id");
			$("#usermake_login_loading").show();
			e.preventDefault(); 
			e.stopPropagation();
			if(w){
				adding_new_checked();
			}
		});

		});		
  		
		function adding_new_checked(){
			console.log("d");
			let userName,password;
			
			
			var user_html_id,user_create_id;
				user_html_id = [
					"loggin_form_email",
					"loggin_form_password"
					];
				user_create_id = [
					"loging_form_email",
					"loging_form_password"
				];
			var sec_check_code = $('#content-sec-id')[0].content;
			var $nouser_password,$nouser_email;
				
    			for (var i = 0; i < user_html_id.length ; i++) {

    				var load_value = data_trasfer($('#'+user_html_id[i]).val());
    				var input = document.createElement("input");
					input.type = "hidden";
					input.className = user_create_id[i];
					input.id = user_create_id[i]; 
	    			input.setAttribute("value",load_value);
	    			document.getElementById("user_login_form").appendChild(input);	

    			}

    		

    			$("#usermake_login_loading").css("display","block");
    			
    			$.ajax({
    				url: "{{route('make_user_register_loging')}}",
    				method: 'post',
    				async:false,
    				data: {
    					'user_email' : $('#'+user_create_id[0]).val(),
    					'user_password' : $('#'+user_create_id[1]).val(),
    					'user_sec_token' : "<?=$key?>",
    				},
    				beforeSend:function(request){
    					return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
    				},
    				success:function(registerStatus){
    					let loggin_status= JSON.parse(registerStatus);
    					let status = loggin_status.status;
    					$("#usermake_login").attr("disabled",false);
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
    					for (var i = 0; i < 2; i++) {
    						$( "#"+user_create_id[i]).remove();
    					}
    					$(".full-width").attr("id","usermake_login");	
    					$("#usermake_login").attr("disabled",false);
    					$("#usermake_login_loading").css("display","none");
    					
    				},
    				error:function(xh,xr){
    					$("#usermake_login").attr("disabled",false);
    					$("#usermake_login_loading").css("display","none");
    				}
    				
    			});		
	
		}
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