<!DOCTYPE html>
<html>
<head>
	<title>MKTNG @yield('website_title')</title>
	@include('master.webusers.body.header')

</head>
<body >
<div class="site-wrap">		
@include('master.webusers.body.headermenubar')
<main>
@yield('content_to_body')
</main>
@include('master.webusers.body.footer')
</div>
</body>
</html>