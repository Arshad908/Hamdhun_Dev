@extends('master.webusers.body.index')
@section('website_title')
	T&C AND Privacy Policy
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

		<section class="hero_in contacts">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp"><span></span>T&C - Privacy policy</h1>
				</div>
			</div>
		</section>
		<!--/hero_in-->



				<div class="bg_color_1">
			<div class="container margin_80_55">
				
				<div class="row justify-content-between">
					<div class="col-lg-12 col-sm-12 col-md-12" >
					  @forelse($load_my_aboyt_us as $data)
		              {!!nl2br($data->web_content)!!}
		              @empty
		              Updating content
		              @endforelse
					</div>
				</div>
				<!--/row-->
			</div>
			<!--/container-->
		</div>
		<!--/bg_color_1-->
		<!-- /container -->
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>

<script type="text/javascript">
	
</script>		
@endsection