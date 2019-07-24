<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name') }} - @yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/skins/_all-skins.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/pace/pace.min.css">
  <link rel="stylesheet" href="{{ asset('') }}css/hover-min.css">

  <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

  @yield('cssAssets')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Maven+Pro&display=swap" rel="stylesheet">

  <style>
    .profile-header {
      position:relative;
      text-align: center;
      padding-top:0px;
    }
    .profile-header .img-circle {
      width: 240px;
      height: 240px;
      object-fit: cover;
    }
    .profile-description .profile-status .active{
      color:green
    }
    .profile-description .profile-status .inactive{
      color:red
    }
    /*.profile-header .profile-createddate {
      margin-top:160px;
      padding:10px;
    }*/
    .profile-description{
      margin-top:10px;
      text-align:center;
    }
    .profile-description .profile-name{
      font-size:30px;
      font-family: 'Maven Pro', sans-serif;
      font-weight:600;
    }
    .profile-description  .usertype{
      background-image: linear-gradient(to right, #f4c354, #fba850, #fd8d55, #f8725f, #ed5a6d);
      padding:5px 25px;
      color:white;
      border-radius:20px;
    }
    

    body{
      font-size:15.5px;
      font-family: 'Maven Pro', sans-serif;
    }
    .error{
      color:red;
    }
    .content-wrapper {
      min-height: 100%;
      background-color: #f7f7f7;
      z-index: 800;
    }
    .main-header .logo {
      -webkit-transition: width .3s ease-in-out;
      -o-transition: width .3s ease-in-out;
      transition: width .3s ease-in-out;
      display: block;
      float: left;
      height: 52px;
      font-size: 20px;
      line-height: 50px;
      text-align: center;
      width: 230px;
      font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
      padding: 0 15px;
      font-weight: 300;
      overflow: hidden;
    }
    .box {
        position: relative;
        border-radius: 10px;
        background: #ffffff;
        border: 1px solid #dddddd;
        margin-bottom: 20px;
        width: 100%;
        box-shadow: 0 1px 6px rgba(0,0,0,0.2);
    }
    .skin-purple-light .main-header .navbar {
        background: -moz-linear-gradient(45deg, rgba(255,79,79,1) 0%, rgba(96,92,168,1) 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left bottom, right top, color-stop(0%, rgba(255,79,79,1)), color-stop(100%, rgba(96,92,168,1))); /* safari4+,chrome */
        background: -webkit-linear-gradient(45deg, rgba(255,79,79,1) 0%, rgba(96,92,168,1) 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(45deg, rgba(255,79,79,1) 0%, rgba(96,92,168,1) 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(45deg, rgba(255,79,79,1) 0%, rgba(96,92,168,1) 100%); /* ie10+ */
        background: linear-gradient(45deg, rgba(255,79,79,1) 0%, rgba(96,92,168,1) 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#605ca8', endColorstr='#FF4F4F',GradientType=1 ); /* ie6-9 */
        background-color: #605ca8;
    }
    .skin-purple-light .main-header .logo {
        background-color: #ffffff;
        color: #383838;
        border-bottom: 0 solid transparent;
    }
    .skin-purple-light .main-sidebar {
        border: none;
    }
    .skin-purple-light .wrapper, .skin-purple-light .main-sidebar, .skin-purple-light .left-side {
        background-color: #ffffff;
        box-shadow: 0 1px 6px rgba(0,0,0,0.2);
    }
    .skin-purple-light .sidebar a {
        color: #565656;
    }
    .skin-purple-light .sidebar-menu>li>a {
        border-left: 3px solid transparent;
        font-weight: 600;
    }
    
    /* ====================== alert messages ==================================*/
    .bg-red, .callout.callout-danger, .alert-danger, .alert-error, .label-danger, .modal-danger .modal-body {
      background-image: linear-gradient(to right, #e13838, #e2433a, #e24c3c, #e3553e, #e35d41);
        background-color: #dd4b39 !important;
    }
    .bg-green, .callout.callout-success, .alert-success, .label-success, .modal-success .modal-body {
        background-image: linear-gradient(to left, #7ecd27, #65b625, #4ea022, #378a1e, #217419);
        background-color: #00a65a !important;
    }

    /* ====================== btn ==================================*/
    .btn{
        border-radius:20px;
        padding:6px 30px;
        font-size:18px;
        box-shadow:0px 3px 10px #afafaf;
    }
    .btn-sm{
        border-radius:20px;
        padding:5px 15px;
        font-size:12px;
        box-shadow:0px 3px 10px #afafaf;
    }
    .btn-primary {
        background-image: linear-gradient(to right, #f4545b, #e14776, #c3478c, #9c4c99, #6f509b);
        border: 0px !important;
    }
    .btn-success {
        background-image: linear-gradient(to right, #71cf0b, #5bb816, #46a119, #338a1a, #217419);
        border: 0px !important;
    }
    .btn-info {
        background-image: linear-gradient(to right, #54f4df, #00d9de, #00bcd7, #00a0c9, #1083b5);
        border: 0px !important;
    }
    .btn-danger {
        background-image: linear-gradient(to right, #f4c354, #fba850, #fd8d55, #f8725f, #ed5a6d);
        border: 0px !important;
    }

      /* ====================== pagination ==================================*/
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
        z-index: 3;
        color: #fff;
        cursor: default;
        border-radius:20px;
        background: -moz-linear-gradient(45deg, rgba(255,79,79,1) 0%, rgba(96,92,168,1) 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left bottom, right top, color-stop(0%, rgba(255,79,79,1)), color-stop(100%, rgba(96,92,168,1))); /* safari4+,chrome */
        background: -webkit-linear-gradient(45deg, rgba(255,79,79,1) 0%, rgba(96,92,168,1) 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(45deg, rgba(255,79,79,1) 0%, rgba(96,92,168,1) 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(45deg, rgba(255,79,79,1) 0%, rgba(96,92,168,1) 100%); /* ie10+ */
        background: linear-gradient(45deg, rgba(255,79,79,1) 0%, rgba(96,92,168,1) 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#605ca8', endColorstr='#FF4F4F',GradientType=1 ); /* ie6-9 */
        border: 0px !important;
    }
    .pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>span:hover {
        border-radius:20px;
        color: #777;
        cursor: not-allowed;
        background: -moz-linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(214,214,214,1) 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left bottom, right top, color-stop(0%, rgba(255,255,255,1)), color-stop(100%, rgba(214,214,214,1))); /* safari4+,chrome */
        background: -webkit-linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(214,214,214,1) 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(214,214,214,1) 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(214,214,214,1) 100%); /* ie10+ */
        background: linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(214,214,214,1) 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#D6D6D6', endColorstr='#FFFFFF',GradientType=1 ); /* ie6-9 */
        border: 0px !important;
    }
    .pagination>li>a {
        border-radius:20px;
        
        background: -moz-linear-gradient(45deg, rgba(255,230,230,1) 0%, rgba(180,181,214,1) 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left bottom, right top, color-stop(0%, rgba(255,230,230,1)), color-stop(100%, rgba(180,181,214,1))); /* safari4+,chrome */
        background: -webkit-linear-gradient(45deg, rgba(255,230,230,1) 0%, rgba(180,181,214,1) 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(45deg, rgba(255,230,230,1) 0%, rgba(180,181,214,1) 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(45deg, rgba(255,230,230,1) 0%, rgba(180,181,214,1) 100%); /* ie10+ */
        background: linear-gradient(45deg, rgba(255,230,230,1) 0%, rgba(180,181,214,1) 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#B4B5D6', endColorstr='#FFE6E6',GradientType=1 ); /* ie6-9 */
        border: 0px !important;
        color: #666;
    }
        
    </style>
</head>
<body class="hold-transition sidebar-mini skin-light skin-purple-light">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('admin/dashboard') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>U</b>Blog</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Users</b>Blog</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="{{asset('images/user.png')}}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="@if(Auth::user()->profile_image) {{asset('images/profile_images')}}/{{ Auth::user()->profile_image }} @else {{asset('images/user.png')}} @endif" class="img-circle" alt="User Image" style="width:25px; height:25px">
              
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                 <img src="@if(Auth::user()->profile_image) {{asset('images/profile_images')}}/{{ Auth::user()->profile_image }} @else {{asset('images/user.png')}} @endif" class="img-circle" alt="User Image" >
                <p>
                  {{ Auth::user()->name }}
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/admin/users/{{ Auth::id() }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="@if(Auth::user()->profile_image) {{asset('images/profile_images')}}/{{ Auth::user()->profile_image }} @else {{asset('images/user.png')}} @endif" class="img-circle" alt="User Image" style="width:40px; height:40px">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i></a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree" style="overflow:hidden">
        <li class="header">MAIN NAVIGATION</li>
        <li @if ($pageId==1) class="active"  @endif><a class="hvr-forward" href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> <span >Dashboard</span></a></li>
        <li @if ($pageId==2) class="active"  @endif><a class="hvr-forward" href="{{ url('admin/users') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
        <li @if ($pageId==3) class="active"  @endif><a class="hvr-forward" href="{{ url('admin/posts') }}"><i class="fa fa-newspaper-o"></i> <span>Posts</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('pageTitle')
        <small>@yield('pageDesc')</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Pace page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
     @yield('content')
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="http://padmanaban-parthiban.me">Padmanaban</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="{{ asset('adminlte') }}/bower_components/PACE/pace.min.js"></script>
<!-- SlimScroll -->
<script src="{{ asset('adminlte') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte') }}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte') }}/dist/js/demo.js"></script>

@yield('jsAssets')
<!-- page script -->
<script type="text/javascript">
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function () {
    Pace.restart()
  })
  $('.ajax').click(function () {
    $.ajax({
      url: '#', success: function (result) {
        $('.ajax-content').html('<hr>Ajax Request Completed !')
      }
    })
  })
</script>

</body>
</html>
