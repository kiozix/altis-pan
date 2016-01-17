<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description"
          content="Site réalisée avec AltisPan, CMS dédiée au Mod multijoueur Altis Life. Réalisation : Lucas GRELAUD, Emile LEPTIT."/>
    <meta name="keywords" content="altis life, cms, altispan, arma, 3, serveur"/>
    <meta name="author" content="Lucas GRELAUD, Emile LEPETIT"/>

    <title>{{ env('SITE_NAME', 'AltisPan') }} - Admin</title>

    <!-- Don't modify the web_author meta , only the author meta please -->
    <meta name="web_author" content="Lucas GRELAUD, Emile LEPETIT">
    <meta name="contact" content="">
    <meta name="revisit-after" content="7 days">
    <meta name="copyright" content="AltisPan">
    <meta name="language" content="French">

    <link rel="shortcut icon" href="{{ asset('/img/favicon.ico') }}">

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
                <a href="{{ url('/') }}" class="navbar-brand">
                    <div class="brand-logo">
                        <img src="{{ asset('/img/logo.png') }}" alt="App Logo" class="img-responsive">
                    </div>
                    <div class="brand-logo-collapsed">
                        <img src="{{ asset('/img/logo-single.png') }}" alt="App Logo" class="img-responsive">
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
                        <a href="#" data-toggle-state="aside-toggled" data-no-persist="true"
                           class="visible-xs sidebar-toggle">
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
                        <a href="{{ url('/auth/logout') }}" title="Déconnexion">
                            <em class="icon-logout"></em>
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
            <form method="get" action="{{ url('admin/search') }}" class="navbar-form">
                <div class="form-group has-feedback">
                    <input name="q" type="text" placeholder="Rechercher un joueur..." class="form-control">
                    <div data-search-dismiss="" class="fa fa-times form-control-feedback"></div>
                </div>
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
                                        @if($user->avatar)
                                            <img src="{{ url($user->avatar) }}" alt="Avatar" width="60" height="60"
                                                 class="img-thumbnail img-circle">
                                        @else
                                            <img src="{{ asset('/img/user_default.png') }}" alt="Avatar" width="60"
                                                 height="60" class="img-thumbnail img-circle">
                                        @endif
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
                    <li class="{{ Request::is('admin') ? 'active' : '' }}">
                        <a title="Dashboard" href="{{ url('admin') }}">
                            {{--<div class="pull-right label label-success">30</div>--}}
                            <em class="icon-speedometer"></em>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/players') ? 'active' : '' }}">
                        <a title="Jouers" href="{{ url('admin/players') }}">
                            <em class="icon-game-controller"></em>
                            <span>Joueurs</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/paypal') ? 'active' : '' }}">
                        <a title="PayPal" href="{{ url('admin/paypal') }}">
                            <em class="icon-paypal"></em>
                            <span>PayPal</span>
                        </a>
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
                        <h3 class="text-center text-thin">Paramètres</h3>
                        <div class="p">
                            <h4 class="text-muted text-thin">Themes</h4>
                            <div class="table-grid mb">
                                <div class="col mb">
                                    <div class="setting-color">
                                        <label data-load-css="{{ asset('/css/theme-a.css') }}">
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
                                        <label data-load-css="{{ asset('/css/theme-b.css') }}">
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
                                        <label data-load-css="{{ asset('/css/theme-c.css') }}">
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
                                        <label data-load-css="{{ asset('/css/theme-d.css') }}">
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
                                        <label data-load-css="{{ asset('/css/theme-e.css') }}">
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
                                        <label data-load-css="{{ asset('/css/theme-f.css') }}">
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
                                        <label data-load-css="{{ asset('/css/theme-g.css') }}">
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
                                        <label data-load-css="{{ asset('/css/theme-h.css') }}">
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
                                        <input id="chk-hover" type="checkbox" data-toggle-state="show-scrollbar"
                                               data-target=".sidebar">
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
                                 <img src="" alt="Image" class="media-box-object img-circle thumb48">
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
                            </li>
                        </ul>
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
            @yield('page-info')

            @yield('content')

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

<!-- =============== APP SCRIPTS ===============-->
<script src="{{ asset('/js/app.js')}}"></script>
</body>

</html>