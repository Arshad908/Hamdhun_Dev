@extends('master.webusers.body.index')
@section('website_title')
	CONTACT US
@endsection

@section('content_to_body')
<style type="text/css">
	.boxed_list1{
	text-align: center;
    padding: 30px;
    color: black;	
    border: 1px solid #000000;
    display: block;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
     margin-top: 50px;
	}

	.font_icon_image{
		font-size: 50px;
		margin-bottom: 5px;
	}

</style>
		<!-- <section class="hero_in contacts">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp"><span></span>Contact Us</h1>
				</div>
			</div>
		</section> -->
		<section class="hero_in tours">
      <div class="wrapper">
        <div class="container">
          <h1 class="fadeInUp"><span></span>
             
          </h1>
        </div>
      </div>
    </section>
		<!--/hero_in-->


	 <div class="bg_color_1" style="color: black">
      <div class="container margin_60_35">
        <!-- <div class="row">
          <div class="col-md-4">
            <a href="#0" class="boxed_list1">
              <i class="pe-7s-map-marker font_icon_image"></i>

						<h4>Address</h4>
						<span>PO Box 97845 Baker st. 567, Los Angeles<br>California - US.</span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="#0" class="boxed_list1">
              <i class="pe-7s-mail-open-file font_icon_image"></i>
						<h4>Email address</h4>
						<span>support@companyname.com - info@companyname.com<small>Monday to Friday 9am - 7pm</small></span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="#0" class="boxed_list1">
             <i class="pe-7s-phone font_icon_image"></i>
						<h4>Contacts info</h4>
						<span>+ 61 (2) 8093 3402 + 61 (2) 8093 3402<br><small>Monday to Friday 9am - 7pm</small></span>
            </a>
          </div>
        </div> -->
        <!-- row -->
      </div>
      <br>
      <!-- <br>
      <br> -->

      	<div class="main_title_2">
					<span><em></em></span>
					<h3>Questions</h3>
					<p>Send your ideas and new mades with us</p>
				</div>

				<div class="bg_color_1">
			<div class="container margin_80_55">
				<div class="row justify-content-between">
					<div class="col-lg-5" style="background-image: url('https://i.pinimg.com/originals/c9/92/db/c992dbf7eb6d323393f7b345717900aa.png');background-repeat: no-repeat;">
						<div class="map_contact">
						</div>
						<!-- /map -->
					</div>
					<div class="col-lg-6">
					
						<div id="message-contact"></div>
						<form method="post" action="assets/contact.php" id="contactform" autocomplete="off">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Name</label>
										<input class="form-control" type="text" id="name_contact" name="name_contact">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Last name</label>
										<input class="form-control" type="text" id="lastname_contact" name="lastname_contact">
									</div>
								</div>
							</div>
							<!-- /row -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Email</label>
										<input class="form-control" type="email" id="email_contact" name="email_contact">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Telephone</label>
										<input class="form-control" type="text" id="phone_contact" name="phone_contact">
									</div>
								</div>
							</div>
							<!-- /row -->
							<div class="form-group">
								<label>Message</label>
								<textarea class="form-control" id="message_contact" name="message_contact" style="height:150px;"></textarea>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Are you human? 3 + 1 =</label>
										<input class="form-control" type="text" id="verify_contact" name="verify_contact">
									</div>
								</div>
							</div>
							<p class="add_top_30"><input type="submit" value="Submit" class="btn_1 rounded" id="submit-contact"></p>
						</form>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_color_1 -->



@endsection