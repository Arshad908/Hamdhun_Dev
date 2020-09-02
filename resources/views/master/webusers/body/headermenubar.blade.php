<style>
  ul#top_menu li a.cart-menu-btn {
    top: 0px;
    color: #d0d0d0;
  } 
  #menu ul li span a{
    color: white;
  }
  #post_add_style{
    /*color: white;
    background-color: #fc5b62;
    margin: 0px 0px 14px 0px;
    padding: 2px 17px 4px 14px;
    border-radius: 4px;*/
    background-color: #ffffff;
    margin: 0px 0px 14px 0px;
    padding: 7px 30px 8px 28px;
    /* padding: 3px 17px 4px 14px; */
    border-radius: 4px;
  }  
  #header_loago_fix_top_1{
    margin: -6px 0px 0px 0px;
  }
  #header_loago_fix_top_2{
    margin: 7px 47px 7px 13px; 
  }
  #currency_loago_load_show{
    width: 40px;height: 20px;padding-top: 0px;margin-top: -2px;
  }
  @media (max-width: 991px) {
    #currency_loago_load_show{
      width: 50px;
      height: 30px;
      padding-top: 0px;
      margin-top: -23px;
      margin-left: -30px;
    }
  }
</style>

<!-- Header -->
<header class="header menu_fixed">
    <div id="preloader"><div data-loader="circle-side"></div></div><!-- /Page Preload -->
    <div id="logo">
      <a href="/">
        <img src="{{asset('common_includes/blg/noyel_masters_logo_dark.png')}}" width="170" height="60" data-retina="true" alt="" class="logo_normal" id="header_loago_fix_top_1">
        <img src="{{asset('common_includes/blg/noyel_masters_logo_dark.png')}}" width="100" height="30" data-retina="true" alt="" class="logo_sticky" id="header_loago_fix_top_2">
      </a>
    </div>
    <ul id="top_menu">
      <!-- <li>
        <a href="#sign-in-dialsog" id="sign-isn" class="cart-menu-btn1" title="">
          
        </a>
      </li> -->
       <li>
        <a href="#" >
        </a>
      </li>
      <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal" class="select_rate_class cart-menu-btn">
          <img src="{{asset('./country_rate/h240/'.strtolower(substr(session('user_convert_currency_type'),0,2)).'.png')}}" id="currency_loago_load_show">
        </a>
      </li>

    </ul>
    <!-- /top_menu -->
    <a href="#menu" class="btn_mobile">
      <div class="hamburger hamburger--spin" id="hamburger">
        <div class="hamburger-box">
          <div class="hamburger-inner"></div>
        </div>
      </div>
    </a>
    <nav id="menu" class="main-menu">
      <ul style="margin: -5px 0px -3px 0px;">
        <li><span><a href="{{route('user_visit_homepage')}}">Home</a></span></li>
        <li><span><a href="{{route('aboutUsLoad')}}">About Us</a></span></li>
        <li><span><a href="{{route('contactUsLoad')}}">Contact Us</a></span>
          <!-- <ul>
            <li><a href="restaurants-grid-isotope.html">Restaurant grid isotope</a></li>
            <li><a href="restaurants-grid-sidebar.html">Restaurant grid sidebar</a></li>
            <li>
              <span><a href="#0">Third level right</a></span>
              <ul>
                <li><a href="#0">Submenu</a></li>
                <li><a href="#0">Submenu</a></li>
                <li><a href="#0">Submenu</a></li>
                <li><a href="#0">Submenu</a></li>
              </ul>
            </li>
            <li>
              <span><a href="#0">Third level left</a></span>
              <ul class="third_level_left">
                <li><a href="#0">Submenu</a></li>
                <li><a href="#0">Submenu</a></li>
                <li><a href="#0">Submenu</a></li>
                <li><a href="#0">Submenu</a></li>
              </ul>
            </li>
          </ul> -->
        </li>
        <li><span><a id="post_add_style" style="font-weight: bold;color: black" href="{{route('loadwebadminCreatePostPage')}}">Post Your Ad</a></span></li>
        @if( base64_decode(session('account_logged_in')) == 150)
          <li><span><a href="{{route('site_logout')}}">Sign Out</a></span></li>
        @else
          <li><span><a href="{{route('site_login_ext')}}">Sign In</a></span></li>
        @endif
      </ul>
    </nav>
    
  </header>
  <!-- /header -->