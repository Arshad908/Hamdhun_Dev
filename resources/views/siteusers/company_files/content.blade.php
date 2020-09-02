<!DOCTYPE html>
<html>
<head>
	<style>
		@font-face {
		    font-family: "Abel";
		    src: url({{asset('postAdvertisersLoad/assets/fonts/login_page_font.ttf')}}) format("truetype");
		}
		body{
			font-family: "Abel";
			overflow-wrap: "anywhere";
		}
		p{
			margin: 0px;
			padding: 0px;
		}
	</style>
	<title></title>
</head>
<body style="overflow-wrap: anywhere;height: auto;">
{!!nl2br($load_my_aboyt_us[0]['value'])!!}
</body>
</html>