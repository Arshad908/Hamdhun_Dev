  <header class="app-header"><a class="app-header__logo" href="#"><img src="{{asset('common_includes/blg/noyel_masters_logo_dark.png')}}" width="100" height="30" style="margin-top: -10px"></a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">

        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="{{route('loaddashboardscreen')}}" data-toggle="dropdown" aria-label="Open Profile Menu"><img src="{{(session('company_image') != '') ? asset(session('company_image')) : 'https://abk.lt/wp-content/uploads/2020/04/Deafult-Profile-Pitcher.png'}}" style="width: 36px"></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="{{route('webadminuserlikeandsaved')}}"><i class="fa fa-heart fa-lg"></i>Wish List</a></li>
            <li><a class="dropdown-item" href="{{route('site_logout')}}"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>




             <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" width="60" height="55" src="{{(session('company_image') != '') ? asset(session('company_image')) : 'https://abk.lt/wp-content/uploads/2020/04/Deafult-Profile-Pitcher.png'}}" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{session('user_first_name')}}</p>
          <!-- <p class="app-sidebar__user-designation">Company Name</p> -->
        </div>
      </div>
      <ul class="app-menu">
        @if(session("account_type") == 114)
          
          <li><a class="app-menu__item @if (session()->get('select_menu') == 'webadmin_dashboard') active @endif" href="{{route('loaddashboardscreen')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
          
        @endif
        <li class="treeview @if (session()->get('select_menu') == 'webadmin_createpost' || session()->get('select_menu') == 'webadmin_listedallposts' || session()->get('select_menu') == 'webadmin_likessavedpost') is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Posts</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item @if (session()->get('select_menu') == 'webadmin_createpost') active @endif" href="{{route('loadwebadminCreatePostPage')}}"><i class="icon fa fa-file-o"></i>&nbsp;Create Post</a></li>
            @if(session("account_type") == 114)
            <li><a class="treeview-item  @if (session()->get('select_menu') == 'webadmin_listedallposts') active @endif" href="{{route('checkmyuploadedlistpost')}}"><i class="icon fa fa-upload"></i>&nbsp;My Post/s</a></li>
            @endif
            <li><a class="treeview-item  @if (session()->get('select_menu') == 'webadmin_likessavedpost') active @endif" href="{{route('webadminuserlikeandsaved')}}"  rel="noopener"><i class="icon fa fa-heart-o fa-sm"></i>&nbsp;
              Wish List
            </a></li>
          </ul>
        </li>
        <li><a class="app-menu__item  @if (session()->get('select_menu') == 'webadmin_userprofile') active @endif" href="{{route('updateuserprofiledatainweb')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Profile</span></a></li>
        @if(session("account_type") == 114)
        <li><a class="app-menu__item  @if (session()->get('select_menu') == 'webadmin_guidlines') active @endif" href="{{route('updateuserhowtopost_guidlines')}}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Guide Lines</span></a></li>
        @endif
        
      </ul>
    </aside>