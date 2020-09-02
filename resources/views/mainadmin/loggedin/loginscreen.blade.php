<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('adminposts/css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>NOYDL.COM | Log In</title>
  </head>
  <body>

    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>noydl.com</h1>
      </div>
      <div class="login-box">
      
        <form class="login-form" method="post" action="{{route('make_master_admin_login',['data'=>'changethis'])}}">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
          <div class="form-group">
            @csrf
            <label class="control-label">EMAIL</label>
            <input class="form-control" type="text" placeholder="Email" autocomplete name="noydl_make_email" id="noydl_make_email" autofocus>
            @if ($errors->has('noydl_make_email'))
                <span class="text-danger">{{ $errors->first('noydl_make_email') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" type="password" placeholder="Password" name="noydl_make_password" id="noydl_make_password">
            @if ($errors->has('noydl_make_password'))
                <span class="text-danger">{{ $errors->first('noydl_make_password') }}</span>
            @endif
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label style="display: none">
                  <input type="checkbox"><span class="label-text">Stay Signed in</span>
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip"></a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
          </div>
        </form>
      </div>
    </section>
 <!-- Essential javascripts for application to work-->
    <script src="{{asset('adminposts/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('adminposts/js/popper.min.js')}}"></script>
    <script src="{{asset('adminposts/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('adminposts/js/main.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{asset('adminposts/js/plugins/pace.min.js')}}"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>