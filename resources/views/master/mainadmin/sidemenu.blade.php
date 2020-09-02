  <header class="app-header"><a class="app-header__logo" href="#"><img src="{{asset('common_includes/blg/noyel_masters_logo_dark.png')}}" width="100" height="30" style="margin-top: -8px"></a>
       <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <ul class="app-nav">

        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user-o fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="{{route('master_user_make_log_out',['qa'=>base64_encode(rand(1500,1550)+(0.254+15985+981)),'logout'=>true,'tst'=>true])}}"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>


      </ul>

    </header>


  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img width="30" height="30" class="app-sidebar__user-avatar" src="https://icons-for-free.com/iconfiles/png/512/avatar+circle+male+profile+user+icon-1320196710301016992.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{session('first_name')}}</p>
          <p class="app-sidebar__user-designation"></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item @if (session()->get('select_menu') == 'masteradmin_dashboard') active @endif" href="{{route('stfprocrombload_dashboard_amster_admin')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview @if (session()->get('select_menu') == 'masteradmin_listallposts' || session()->get('select_menu') == 'masteradmin_makeapprovalposts' || session()->get('select_menu') == 'masteradmin_rulesandregs') is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file"></i><span class="app-menu__label">Posts</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item  @if (session()->get('select_menu') == 'masteradmin_listallposts') active @endif" href="{{route('stfprocromb_checkApprposts')}}"><i class="icon fa fa-circle-o"></i>Listed Posts</a></li>
            <li><a class="treeview-item  @if (session()->get('select_menu') == 'masteradmin_makeapprovalposts') active @endif" href="{{route('stfprocromb_checkprocessposts')}}"><i class="icon fa fa-circle-o"></i>Pending To Confirm</a></li>
          <!--   <li><a class="treeview-item  @if (session()->get('select_menu') == 'masteradmin_rulesandregs') active @endif" href="{{route('addNewRulesdanrexg')}}" target="_blank" rel="noopener"><i class="icon fa fa-circle-o"></i>
             Rules and Regulations {{session()->get('select_menu')}}
            </a></li> -->
          </ul>
        </li>
        <li class="treeview @if (session()->get('select_menu') == 'masteradmin_webuseraccounts' || session()->get('select_menu') == 'masteradmin_useraccounts' ) is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-address-book"></i><span class="app-menu__label">Profiles</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item  @if (session()->get('select_menu') == 'masteradmin_useraccounts') active @endif" href="{{route('stftrckjik_checklistedallclients')}}"><i class="icon fa fa-circle-o"></i>Advertisers</a></li>
            <li><a class="treeview-item  @if (session()->get('select_menu') == 'masteradmin_webuseraccounts') active @endif" href="{{route('stftrckjik_checklistedallormalusers')}}"><i class="icon fa fa-circle-o"></i>Normal Users</a></li>
          </ul>
        </li>
        <li><a class="app-menu__item @if (session()->get('select_menu') == 'master_state_check_currency_list') active @endif" href="{{route('stftrckchatclient_clients')}}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Currency rates</span></a></li>
        <li class="treeview @if (session()->get('select_menu') == 'masteradmin_policyguidlinece' || session()->get('select_menu') == 'masteradmin_addcategory' || session()->get('select_menu') == 'masteradmin_post_promo_code' ) is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span class="app-menu__label">Settings</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item  @if (session()->get('select_menu') == 'masteradmin_policyguidlinece') active @endif" href="{{route('web_site_user_content_updated')}}"><i class="icon fa fa-circle-o"></i>Web content</a></li>
            <li><a class="treeview-item  @if (session()->get('select_menu') == 'masteradmin_addcategory') active @endif" href="{{route('addmastercategoryview')}}"><i class="icon fa fa-circle-o"></i>Manage category</a></li>
            <li><a class="treeview-item  @if (session()->get('select_menu') == 'masteradmin_post_promo_code') active @endif" href="{{route('loadview_.promocodeview')}}"><i class="icon fa fa-circle-o"></i>Promo-code</a></li>
          </ul>
        </li>
      </ul>
    </aside>