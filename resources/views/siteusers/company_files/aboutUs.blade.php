@extends('master.webusers.body.index')
@section('website_title')
	ABOUT US
@endsection

@section('content_to_body')
<style type="text/css">
	::-webkit-scrollbar {
    width: 12px;
}

::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
</style>

	<section class="hero_in tours">
      <div class="wrapper">
        <div class="container">
          <h1 class="fadeInUp"><span></span>
             
          </h1>
        </div>
      </div>
    </section>
		<!--/hero_in-->



				<div class="bg_color_1">
			<div class="container margin_80_55">
				<div class="main_title_2">
					<span><em></em></span>
					<h2>Our Origins and Story</h2>
					<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
				</div>
				<div class="row justify-content-between">
					<div class="col-lg-6 wow" data-wow-offset="150">
						<figure class="block-reveal">
							<div class="block-horizzontal"></div>
							<img src="https://cdn.pixabay.com/photo/2018/02/02/22/49/background-3126537__340.jpg" class="img-fluid" alt="">
						</figure>
					</div>
					<div class="col-lg-5" >
						{!!nl2br($load_my_aboyt_us[0]['value'])!!}
						<!-- <iframe src="{{route('aboutUsLoadContentsample')}}" class="scrollbar" seamless style="border:1px solid white">
						</iframe> -->
					</div>
				</div>
				<!--/row-->
			</div>
			<!--/container-->
		</div>
		<!--/bg_color_1-->

				<div class="container margin_80_55">
			<div class="main_title_2">
				<span><em></em></span>
				<h2>Why Choose Noydl.com</h2>
				<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<a class="box_feat" href="#0">
						<i class="pe-7s-medal"></i>
						<h3>Worldwide Customers</h3>
						<p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris, cum no alii option, cu sit mazim libris.</p>
					</a>
				</div>
				<div class="col-lg-4 col-md-6">
					<a class="box_feat" href="#0">
						<i class="pe-7s-credit"></i>
						<h3>Secure Payments</h3>
						<p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris, cum no alii option, cu sit mazim libris.</p>
					</a>
				</div>
				<div class="col-lg-4 col-md-6">
					<a class="box_feat" href="#0">
						<i class="pe-7s-chat"></i>
						<h3>Support via Chat</h3>
						<p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris, cum no alii option, cu sit mazim libris. </p>
					</a>
				</div>
			</div>
			<!--/row-->
		</div>
		<!-- /container -->
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script type="text/javascript">
	
</script>		
@endsection