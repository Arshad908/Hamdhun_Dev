<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
<head>
	<title>Noydl.com | @yield('title_of_page')</title>
	@include('master.webadmin.header')
</head>
<body class="app sidebar-mini rtl">
	@include('master.webadmin.sidemenu')
	@include('master.webadmin.includejs')
	@yield('content_to_body')
	
	@yield('content_to_body_scripts')	
</body>
</html>