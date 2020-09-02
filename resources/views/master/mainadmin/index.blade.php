<!DOCTYPE html>
<html lang="en">
<head>
	<title>MRTK | @yield('title_of_page')</title>
	@include('master.mainadmin.header')
</head>
<body class="app sidebar-mini rtl">
	@if(Session::get("select_menu") == "masteradmin_addcategory" || Session::get("select_menu") == "masteradmin_listallposts" || Session::get("select_menu") == "masteradmin_makeapprovalposts" || Session::get("select_menu") == "masteradmin_policyguidlinece")
		@include('master.mainadmin.includejs')
	@endif

	@include('master.mainadmin.sidemenu')
	@yield('content_to_body')
	

	@if(Session::get("select_menu") != "masteradmin_addcategory" && Session::get("select_menu") != "masteradmin_listallposts" && Session::get("select_menu") != "masteradmin_makeapprovalposts" )
		@include('master.mainadmin.includejs')
	@endif
	@include('master.mainadmin.footer')	
</body>
</html>