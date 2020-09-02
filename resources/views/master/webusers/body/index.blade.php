<!DOCTYPE html>
<html>
<head>
	<title>NOYDL.COM | Needs Of Your Entire Life | @yield('website_title') </title>
	@include('master.webusers.body.header') 
	<style>
		@font-face {
		    font-family: "Abel";
		    src: url({{asset('postAdvertisersLoad/assets/fonts/login_page_font.ttf')}}) format("truetype");
		}
		body{
			font-family: "Abel";
		}
	</style>	
</head>
<body >	
<div id="page" class="theia-exception">		
@include('master.webusers.body.headermenubar')
<main>
@include('master.webusers.body.includejs')	
@yield('content_to_body')
@include('master.webusers.body.includejs')
</main>
@include('master.webusers.body.footer')
<div id="toTop" class="Make_loaded_context_to_top"></div>
</div>

	<!-- Sign In Popup -->
	<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="small-dialog-header">
			<h3>Sign In</h3>
		</div>
		<form>
			<div class="sign-in-wrapper">
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" id="email">
					<i class="icon_mail_alt"></i>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" id="password" value="">
					<i class="icon_lock_alt"></i>
				</div>
				<div class="clearfix add_bottom_15">
					<div class="checkboxes float-left">
						<label class="container_check">Remember me
						  <input type="checkbox">
						  <span class="checkmark"></span>
						</label>
					</div>
					<div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
				</div>
				<div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
				<div class="text-center">
					Don’t have an account? <a href="{{route('site_register_nw')}}">Sign up</a>
				</div>
				<div id="forgot_pw">
					<div class="form-group">
						<label>Please confirm login email below</label>
						<input type="email" class="form-control" name="email_forgot" id="email_forgot">
						<i class="icon_mail_alt"></i>
					</div>
					<p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
					<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
				</div>
			</div>
		</form>
		<!--form -->
	</div>
	<!-- /Sign In Popup -->

		<!-- Sign In Popup -->
	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Currency</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group" style="height: 75vh;overflow-x: auto;">
        	<?php
        		foreach ($currency['rates'] as $key => $data ){
        		$currency_type = $key;	
        		$image_name = substr(strtolower($key), 0,2) .'.png'; 		
        	?>
        	
        	<a href="{{route('select_currency_type',['currency_type'=>$currency_type])}}" style="padding: 5px"><li><img src="{!! asset('./country_rate/h240/'.$image_name) !!}" style="width: 10%;height: 20px;">&emsp; | &emsp;{{$key}}</li></a>

        	<?php
        		}
        	?>
		</ul>
      </div>
    </div>
  </div>
</div>
	<!-- /Sign In Popup -->

<!-- Back to top button -->

<script>
		$(".Make_loaded_context_to_top").on("click",function(){
			$("html, body").animate({ scrollTop: 0 }, "slow");
  			return false;
		});	
</script>



</body>
</html>