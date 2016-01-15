<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Bootstrap Admin App + jQuery">
    <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
    <title>Angle - Bootstrap Admin Template</title>
    <!-- =============== VENDOR STYLES ===============-->
    <!-- FONT AWESOME-->
    <link rel="stylesheet" href="{{ asset('/vendor/fontawesome/css/font-awesome.min.css') }}">
    <!-- SIMPLE LINE ICONS-->
    <link rel="stylesheet" href="{{ asset('/vendor/simple-line-icons/css/simple-line-icons.css') }}">
    <!-- ANIMATE.CSS-->
    <link rel="stylesheet" href="{{ asset('/vendor/animate.css/animate.min.css') }}">
    <!-- WHIRL (spinners)-->
    <link rel="stylesheet" href="{{ asset('/vendor/whirl/dist/whirl.css') }}">
    <!-- =============== PAGE VENDOR STYLES ===============-->
    <!-- WEATHER ICONS-->
    <link rel="stylesheet" href="{{ asset('/vendor/weather-icons/css/weather-icons.min.css') }}">
    <!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}" id="bscss">
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" id="maincss">
</head>

<body>
<div class="wrapper">
    <!-- top navbar-->
    <header class="topnavbar-wrapper">
        <!-- START Top Navbar-->
        <nav role="navigation" class="navbar topnavbar">
            <!-- START navbar header-->
            <div class="navbar-header">
                <a href="#/" class="navbar-brand">
                    <div class="brand-logo">
                        <img src="img/logo.png" alt="App Logo" class="img-responsive">
                    </div>
                    <div class="brand-logo-collapsed">
                        <img src="img/logo-single.png" alt="App Logo" class="img-responsive">
                    </div>
                </a>
            </div>
            <!-- END navbar header-->
            <!-- START Nav wrapper-->
            <div class="nav-wrapper">
                <!-- START Left navbar-->
                <ul class="nav navbar-nav">
                    <li>
                        <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                        <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                            <em class="fa fa-navicon"></em>
                        </a>
                        <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                        <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                            <em class="fa fa-navicon"></em>
                        </a>
                    </li>
                    <!-- START User avatar toggle-->
                    <li>
                        <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                        <a id="user-block-toggle" href="#user-block" data-toggle="collapse">
                            <em class="icon-user"></em>
                        </a>
                    </li>
                    <!-- END User avatar toggle-->
                    <!-- START lock screen-->
                    <li>
                        <a href="lock.html" title="Lock screen">
                            <em class="icon-lock"></em>
                        </a>
                    </li>
                    <!-- END lock screen-->
                </ul>
                <!-- END Left navbar-->
                <!-- START Right Navbar-->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Search icon-->
                    <li>
                        <a href="#" data-search-open="">
                            <em class="icon-magnifier"></em>
                        </a>
                    </li>
                    <!-- Fullscreen (only desktops)-->
                    <li class="visible-lg">
                        <a href="#" data-toggle-fullscreen="">
                            <em class="fa fa-expand"></em>
                        </a>
                    </li>
                    <!-- START Offsidebar button-->
                    <li>
                        <a href="#" data-toggle-state="offsidebar-open" data-no-persist="true">
                            <em class="icon-notebook"></em>
                        </a>
                    </li>
                    <!-- END Offsidebar menu-->
                </ul>
                <!-- END Right Navbar-->
            </div>
            <!-- END Nav wrapper-->
            <!-- START Search form-->
            <form role="search" action="search.html" class="navbar-form">
                <div class="form-group has-feedback">
                    <input type="text" placeholder="Type and hit enter ..." class="form-control">
                    <div data-search-dismiss="" class="fa fa-times form-control-feedback"></div>
                </div>
                <button type="submit" class="hidden btn btn-default">Submit</button>
            </form>
            <!-- END Search form-->
        </nav>
        <!-- END Top Navbar-->
    </header>
    <!-- sidebar-->
    <aside class="aside">
        <!-- START Sidebar (left)-->
        <div class="aside-inner">
            <nav data-sidebar-anyclick-close="" class="sidebar">
                <!-- START sidebar nav-->
                <ul class="nav">
                    <!-- START user info-->
                    <li class="has-user-block">
                        <div id="user-block" class="collapse">
                            <div class="item user-block">
                                <!-- User picture-->
                                <div class="user-block-picture">
                                    <div class="user-block-status">
                                        <img src="{{ url($user->avatar) }}" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                                        <div class="circle circle-success circle-lg"></div>
                                    </div>
                                </div>
                                <!-- Name and Job-->
                                <div class="user-block-info">
                                    <span class="user-block-name">Bonjour, {{ $user->name }}</span>
                                    <span class="user-block-role">Administrateur</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- END user info-->
                    <!-- Iterates over all sidebar items-->
                    <li class="nav-heading ">
                        <span data-localize="sidebar.heading.HEADER">Menu</span>
                    </li>
                    <li class=" ">
                        <a href="#dashboard" title="Dashboard" data-toggle="collapse">
                            <div class="pull-right label label-info">3</div>
                            <em class="icon-speedometer"></em>
                            <span data-localize="sidebar.nav.DASHBOARD">Dashboard</span>
                        </a>
                        <ul id="dashboard" class="nav sidebar-subnav collapse">
                            <li class="sidebar-subnav-header">Dashboard</li>
                            <li class=" active">
                                <a href="dashboard.html" title="Dashboard v1">
                                    <span>Dashboard v1</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="dashboard_v2.html" title="Dashboard v2">
                                    <span>Dashboard v2</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- END sidebar nav-->
            </nav>
        </div>
        <!-- END Sidebar (left)-->
    </aside>
    <!-- offsidebar-->
    <aside class="offsidebar hide">
        <!-- START Off Sidebar (right)-->
        <nav>
            <div role="tabpanel">
                <!-- Nav tabs-->
                <ul role="tablist" class="nav nav-tabs nav-justified">
                    <li role="presentation" class="active">
                        <a href="#app-settings" aria-controls="app-settings" role="tab" data-toggle="tab">
                            <em class="icon-equalizer fa-lg"></em>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#app-chat" aria-controls="app-chat" role="tab" data-toggle="tab">
                            <em class="icon-user fa-lg"></em>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes-->
                <div class="tab-content">
                    <div id="app-settings" role="tabpanel" class="tab-pane fade in active">
                        <h3 class="text-center text-thin">Settings</h3>
                        <div class="p">
                            <h4 class="text-muted text-thin">Themes</h4>
                            <div class="table-grid mb">
                                <div class="col mb">
                                    <div class="setting-color">
                                        <label data-load-css="css/theme-a.css">
                                            <input type="radio" name="setting-theme" checked="checked">
                                            <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-info"></span>
                                       <span class="color bg-info-light"></span>
                                    </span>
                                            <span class="color bg-white"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col mb">
                                    <div class="setting-color">
                                        <label data-load-css="css/theme-b.css">
                                            <input type="radio" name="setting-theme">
                                            <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-green"></span>
                                       <span class="color bg-green-light"></span>
                                    </span>
                                            <span class="color bg-white"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col mb">
                                    <div class="setting-color">
                                        <label data-load-css="css/theme-c.css">
                                            <input type="radio" name="setting-theme">
                                            <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-purple"></span>
                                       <span class="color bg-purple-light"></span>
                                    </span>
                                            <span class="color bg-white"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col mb">
                                    <div class="setting-color">
                                        <label data-load-css="css/theme-d.css">
                                            <input type="radio" name="setting-theme">
                                            <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-danger"></span>
                                       <span class="color bg-danger-light"></span>
                                    </span>
                                            <span class="color bg-white"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="table-grid mb">
                                <div class="col mb">
                                    <div class="setting-color">
                                        <label data-load-css="css/theme-e.css">
                                            <input type="radio" name="setting-theme">
                                            <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-info-dark"></span>
                                       <span class="color bg-info"></span>
                                    </span>
                                            <span class="color bg-gray-dark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col mb">
                                    <div class="setting-color">
                                        <label data-load-css="css/theme-f.css">
                                            <input type="radio" name="setting-theme">
                                            <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-green-dark"></span>
                                       <span class="color bg-green"></span>
                                    </span>
                                            <span class="color bg-gray-dark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col mb">
                                    <div class="setting-color">
                                        <label data-load-css="css/theme-g.css">
                                            <input type="radio" name="setting-theme">
                                            <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-purple-dark"></span>
                                       <span class="color bg-purple"></span>
                                    </span>
                                            <span class="color bg-gray-dark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col mb">
                                    <div class="setting-color">
                                        <label data-load-css="css/theme-h.css">
                                            <input type="radio" name="setting-theme">
                                            <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-danger-dark"></span>
                                       <span class="color bg-danger"></span>
                                    </span>
                                            <span class="color bg-gray-dark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p">
                            <h4 class="text-muted text-thin">Layout</h4>
                            <div class="clearfix">
                                <p class="pull-left">Fixed</p>
                                <div class="pull-right">
                                    <label class="switch">
                                        <input id="chk-fixed" type="checkbox" data-toggle-state="layout-fixed">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="clearfix">
                                <p class="pull-left">Boxed</p>
                                <div class="pull-right">
                                    <label class="switch">
                                        <input id="chk-boxed" type="checkbox" data-toggle-state="layout-boxed">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="clearfix">
                                <p class="pull-left">RTL</p>
                                <div class="pull-right">
                                    <label class="switch">
                                        <input id="chk-rtl" type="checkbox">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="p">
                            <h4 class="text-muted text-thin">Aside</h4>
                            <div class="clearfix">
                                <p class="pull-left">Collapsed</p>
                                <div class="pull-right">
                                    <label class="switch">
                                        <input id="chk-collapsed" type="checkbox" data-toggle-state="aside-collapsed">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="clearfix">
                                <p class="pull-left">Float</p>
                                <div class="pull-right">
                                    <label class="switch">
                                        <input id="chk-float" type="checkbox" data-toggle-state="aside-float">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="clearfix">
                                <p class="pull-left">Hover</p>
                                <div class="pull-right">
                                    <label class="switch">
                                        <input id="chk-hover" type="checkbox" data-toggle-state="aside-hover">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="clearfix">
                                <p class="pull-left">Show Scrollbar</p>
                                <div class="pull-right">
                                    <label class="switch">
                                        <input id="chk-hover" type="checkbox" data-toggle-state="show-scrollbar" data-target=".sidebar">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="app-chat" role="tabpanel" class="tab-pane fade">
                        <h3 class="text-center text-thin">Connections</h3>
                        <ul class="nav">
                            <!-- START list title-->
                            <li class="p">
                                <small class="text-muted">ONLINE</small>
                            </li>
                            <!-- END list title-->
                            <li>
                                <!-- START User status-->
                                <a href="#" class="media-box p mt0">
                              <span class="pull-right">
                                 <span class="circle circle-success circle-lg"></span>
                              </span>
                              <span class="pull-left">
                                 <!-- Contact avatar-->
                                 <img src="img/user/05.jpg" alt="Image" class="media-box-object img-circle thumb48">
                              </span>
                                    <!-- Contact info-->
                              <span class="media-box-body">
                                 <span class="media-box-heading">
                                    <strong>Juan Sims</strong>
                                    <br>
                                    <small class="text-muted">Designeer</small>
                                 </span>
                              </span>
                                </a>
                                <!-- END User status-->
                                <!-- START User status-->
                                <a href="#" class="media-box p mt0">
                              <span class="pull-right">
                                 <span class="circle circle-success circle-lg"></span>
                              </span>
                              <span class="pull-left">
                                 <!-- Contact avatar-->
                                 <img src="img/user/06.jpg" alt="Image" class="media-box-object img-circle thumb48">
                              </span>
                                    <!-- Contact info-->
                              <span class="media-box-body">
                                 <span class="media-box-heading">
                                    <strong>Maureen Jenkins</strong>
                                    <br>
                                    <small class="text-muted">Designeer</small>
                                 </span>
                              </span>
                                </a>
                                <!-- END User status-->
                                <!-- START User status-->
                                <a href="#" class="media-box p mt0">
                              <span class="pull-right">
                                 <span class="circle circle-danger circle-lg"></span>
                              </span>
                              <span class="pull-left">
                                 <!-- Contact avatar-->
                                 <img src="img/user/07.jpg" alt="Image" class="media-box-object img-circle thumb48">
                              </span>
                                    <!-- Contact info-->
                              <span class="media-box-body">
                                 <span class="media-box-heading">
                                    <strong>Billie Dunn</strong>
                                    <br>
                                    <small class="text-muted">Designeer</small>
                                 </span>
                              </span>
                                </a>
                                <!-- END User status-->
                                <!-- START User status-->
                                <a href="#" class="media-box p mt0">
                              <span class="pull-right">
                                 <span class="circle circle-warning circle-lg"></span>
                              </span>
                              <span class="pull-left">
                                 <!-- Contact avatar-->
                                 <img src="img/user/08.jpg" alt="Image" class="media-box-object img-circle thumb48">
                              </span>
                                    <!-- Contact info-->
                              <span class="media-box-body">
                                 <span class="media-box-heading">
                                    <strong>Tomothy Roberts</strong>
                                    <br>
                                    <small class="text-muted">Designer</small>
                                 </span>
                              </span>
                                </a>
                                <!-- END User status-->
                            </li>
                            <!-- START list title-->
                            <li class="p">
                                <small class="text-muted">OFFLINE</small>
                            </li>
                            <!-- END list title-->
                            <li>
                                <!-- START User status-->
                                <a href="#" class="media-box p mt0">
                              <span class="pull-right">
                                 <span class="circle circle-lg"></span>
                              </span>
                              <span class="pull-left">
                                 <!-- Contact avatar-->
                                 <img src="img/user/09.jpg" alt="Image" class="media-box-object img-circle thumb48">
                              </span>
                                    <!-- Contact info-->
                              <span class="media-box-body">
                                 <span class="media-box-heading">
                                    <strong>Lawrence Robinson</strong>
                                    <br>
                                    <small class="text-muted">Developer</small>
                                 </span>
                              </span>
                                </a>
                                <!-- END User status-->
                                <!-- START User status-->
                                <a href="#" class="media-box p mt0">
                              <span class="pull-right">
                                 <span class="circle circle-lg"></span>
                              </span>
                              <span class="pull-left">
                                 <!-- Contact avatar-->
                                 <img src="img/user/10.jpg" alt="Image" class="media-box-object img-circle thumb48">
                              </span>
                                    <!-- Contact info-->
                              <span class="media-box-body">
                                 <span class="media-box-heading">
                                    <strong>Tyrone Owens</strong>
                                    <br>
                                    <small class="text-muted">Designer</small>
                                 </span>
                              </span>
                                </a>
                                <!-- END User status-->
                            </li>
                            <li>
                                <div class="p-lg text-center">
                                    <!-- Optional link to list more users-->
                                    <a href="#" title="See more contacts" class="btn btn-purple btn-sm">
                                        <strong>Load more..</strong>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <!-- Extra items-->
                        <div class="p">
                            <p>
                                <small class="text-muted">Tasks completion</small>
                            </p>
                            <div class="progress progress-xs m0">
                                <div role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-success progress-80">
                                    <span class="sr-only">80% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="p">
                            <p>
                                <small class="text-muted">Upload quota</small>
                            </p>
                            <div class="progress progress-xs m0">
                                <div role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-warning progress-40">
                                    <span class="sr-only">40% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- END Off Sidebar (right)-->
    </aside>
    <!-- Main section-->
    <section>
        <!-- Page content-->
        <div class="content-wrapper">
            <div class="content-heading">
                <!-- END Language list    -->
                Dashboard
                <small data-localize="dashboard.WELCOME"></small>
            </div>
            <!-- START widgets box-->
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <!-- START widget-->
                    <div class="panel widget bg-primary">
                        <div class="row row-table">
                            <div class="col-xs-4 text-center bg-primary-dark pv-lg">
                                <em class="icon-cloud-upload fa-3x"></em>
                            </div>
                            <div class="col-xs-8 pv-lg">
                                <div class="h2 mt0">1700</div>
                                <div class="text-uppercase">Uploads</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <!-- START widget-->
                    <div class="panel widget bg-purple">
                        <div class="row row-table">
                            <div class="col-xs-4 text-center bg-purple-dark pv-lg">
                                <em class="icon-globe fa-3x"></em>
                            </div>
                            <div class="col-xs-8 pv-lg">
                                <div class="h2 mt0">700
                                    <small>GB</small>
                                </div>
                                <div class="text-uppercase">Quota</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <!-- START widget-->
                    <div class="panel widget bg-green">
                        <div class="row row-table">
                            <div class="col-xs-4 text-center bg-green-dark pv-lg">
                                <em class="icon-bubbles fa-3x"></em>
                            </div>
                            <div class="col-xs-8 pv-lg">
                                <div class="h2 mt0">500</div>
                                <div class="text-uppercase">Reviews</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <!-- START date widget-->
                    <div class="panel widget">
                        <div class="row row-table">
                            <div class="col-xs-4 text-center bg-green pv-lg">
                                <!-- See formats: https://docs.angularjs.org/api/ng/filter/date-->
                                <div data-now="" data-format="MMMM" class="text-sm"></div>
                                <br>
                                <div data-now="" data-format="D" class="h2 mt0"></div>
                            </div>
                            <div class="col-xs-8 pv-lg">
                                <div data-now="" data-format="dddd" class="text-uppercase"></div>
                                <br>
                                <div data-now="" data-format="h:mm" class="h2 mt0"></div>
                                <div data-now="" data-format="a" class="text-muted text-sm"></div>
                            </div>
                        </div>
                    </div>
                    <!-- END date widget    -->
                </div>
            </div>
            <!-- END widgets box-->
            <div class="row">
                @yield('content')
            </div>
        </div>
    </section>
    <!-- Page footer-->
    <footer>
        <span>&copy; 2015 - AltisPan</span>
    </footer>
</div>
<!-- =============== VENDOR SCRIPTS ===============-->
<!-- MODERNIZR-->
<script src="{{ asset('/vendor/modernizr/modernizr.custom.js') }}"></script>
<!-- MATCHMEDIA POLYFILL-->
<script src="{{ asset('/vendor/matchMedia/matchMedia.js') }}"></script>
<!-- JQUERY-->
<script src="{{ asset('/vendor/jquery/dist/jquery.js') }}"></script>
<!-- BOOTSTRAP-->
<script src="{{ asset('/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
<!-- STORAGE API-->
<script src="{{ asset('/vendor/jQuery-Storage-API/jquery.storageapi.js') }}"></script>
<!-- JQUERY EASING-->
<script src="{{ asset('/vendor/jquery.easing/js/jquery.easing.js') }}"></script>
<!-- ANIMO-->
<script src="{{ asset('/vendor/animo.js/animo.js') }}"></script>
<!-- SLIMSCROLL-->
<script src="{{ asset('/vendor/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- SCREENFULL-->
<script src="{{ asset('/vendor/screenfull/dist/screenfull.js') }}"></script>
<!-- LOCALIZE-->
<script src="{{ asset('/vendor/jquery-localize-i18n/dist/jquery.localize.js') }}"></script>
<!-- RTL demo-->
<script src="{{ asset('js/demo/demo-rtl.js') }}"></script>
<!-- =============== PAGE VENDOR SCRIPTS ===============-->
<!-- SPARKLINE-->
<script src="{{ asset('/vendor/sparkline/index.js') }}"></script>
<!-- FLOT CHART-->
<script src="{{ asset('/vendor/Flot/jquery.flot.js') }}"></script>
<script src="{{ asset('/vendor/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('/vendor/Flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('/vendor/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('/vendor/Flot/jquery.flot.time.js') }}"></script>
<script src="{{ asset('/vendor/Flot/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('/vendor/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
<!-- CLASSY LOADER-->
<script src="{{ asset('/vendor/jquery-classyloader/js/jquery.classyloader.min.js') }}"></script>
<!-- MOMENT JS-->
<script src="{{ asset('/vendor/moment/min/moment-with-locales.min.js') }}"></script>
<!-- DEMO-->
<script src="{{ asset('/js/demo/demo-flot.js') }}"></script>
<!-- =============== APP SCRIPTS ===============-->
<script src="{{ asset('/js/app.js')}}"></script>
</body>

</html>