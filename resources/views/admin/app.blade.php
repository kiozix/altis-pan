<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Site réalisée avec AltisPan, CMS dédiée au Mod multijoueur Altis Life. Réalisation : Lucas GRELAUD, Emile LEPTIT."/>
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

    <link rel="stylesheet" href="{{ asset('/vendor/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/whirl/dist/whirl.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/weather-icons/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}" id="bscss">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" id="maincss">
    <link rel="stylesheet" href="{{ asset('/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}">
</head>

<body>
<div class="wrapper">

    <header class="topnavbar-wrapper">
        <nav role="navigation" class="navbar topnavbar">
            <div class="navbar-header">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <div class="brand-logo">
                        <img src="{{ asset('/img/logo.png') }}" alt="App Logo" class="img-responsive" style="width:120px">
                    </div>
                    <div class="brand-logo-collapsed">
                        <img src="{{ asset('/img/logo-single.png') }}" alt="App Logo" class="img-responsive" style="width:40px">
                    </div>
                </a>
            </div>
            <div class="nav-wrapper">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                            <em class="fa fa-navicon"></em>
                        </a>
                        <a href="#" data-toggle-state="aside-toggled" data-no-persist="true"
                           class="visible-xs sidebar-toggle">
                            <em class="fa fa-navicon"></em>
                        </a>
                    </li>
                    <li>
                        <a id="user-block-toggle" href="#user-block" data-toggle="collapse">
                            <em class="icon-user"></em>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/auth/logout') }}" title="Déconnexion">
                            <em class="icon-logout"></em>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(env('RCON_INIT', false) == true)
                        <li>
                            <a id="say" data-callback="{{ url('admin/rcon/say') }}" data-csrf="{{ csrf_token() }}" href="">
                                <em class="icon-speech"></em>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="#" data-search-open="">
                            <em class="icon-magnifier"></em>
                        </a>
                    </li>
                    <li class="visible-lg">
                        <a href="#" data-toggle-fullscreen="">
                            <em class="fa fa-expand"></em>
                        </a>
                    </li>
                </ul>
            </div>
            <form method="get" action="{{ url('admin/search') }}" class="navbar-form">
                <div class="form-group has-feedback">
                    <input name="q" type="text" placeholder="Rechercher un joueur..." class="form-control" autocomplete="off">
                    <div data-search-dismiss="" class="fa fa-times form-control-feedback"></div>
                </div>
            </form>
        </nav>
    </header>

    <aside class="aside">
        <div class="aside-inner">
            <nav data-sidebar-anyclick-close="" class="sidebar">
                <ul class="nav">
                    <li class="has-user-block">
                        <div id="user-block" class="collapse in" aria-expanded="true">
                            <div class="item user-block">
                                <div class="user-block-picture">
                                    <div class="user-block-status">
                                        @if($user->avatar)
                                            <img src="{{ url($user->avatar) }}" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                                        @else
                                            <img src="{{ asset('/img/user_default.png') }}" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                                        @endif
                                        <div class="circle circle-success circle-lg"></div>
                                    </div>
                                </div>

                                <div class="user-block-info">
                                    <span class="user-block-name">Bonjour, {{ $user->name }}</span>
                                    <span class="user-block-role">
                                        <?php
                                        if($user->rank == 1) {
                                            echo 'Support';
                                        }elseif($user->rank == 2) {
                                            echo 'Modérateur';
                                        }elseif($user->rank == 3) {
                                            echo 'Administrateur';
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-heading ">
                        <span>Menu</span>
                    </li>
                    <li class="{{ Request::is('admin') ? 'active' : '' }}">
                        <a title="Dashboard" href="{{ url('admin') }}">
                            <em class="icon-speedometer"></em>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/user') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'admin/user')) echo "active"; ?>">
                        <a title="Utilisateurs" href="{{ url('admin/user') }}">
                            <em class="icon-people"></em>
                            <span>Utilisateurs</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/player') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'admin/player')) echo "active"; ?>">
                        <a title="Joueurs" href="{{ url('admin/player') }}">
                            <em class="icon-game-controller"></em>
                            <span>Joueurs</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/house') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'admin/house')) echo "active"; ?>">
                        <a title="Maisons" href="{{ url('admin/house') }}">
                            <em class="icon-home"></em>
                            <span>Maisons</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/gang') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'admin/gang')) echo "active"; ?>">
                        <a title="Gangs" href="{{ url('admin/gang') }}">
                            <em class="icon-tag"></em>
                            <span>Gangs</span>
                        </a>
                    </li>
                    @if($user->rank != 1)
                        <li class="{{ Request::is('admin/remboursement') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'admin/remboursement')) echo "active"; ?>">
                            <a title="Remboursements" href="{{ url('admin/remboursement') }}">
                                <em class="icon-credit-card"></em>
                                <span>Remboursements</span>
                            </a>
                        </li>
                    @endif
                    <li class="{{ Request::is('admin/offense') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'admin/offense')) echo "active"; ?>">
                        <a title="Casier Judiciaires" href="{{ url('admin/offense') }}">
                            <em class="icon-paper-clip"></em>
                            <span>Casier Judiciaires</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/support') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'admin/support')) echo "active"; ?>">
                        <a title="Support" href="{{ url('admin/support') }}">
                            <em class="icon-support"></em>
                            <span>Support</span>
                        </a>
                    </li>
                    @if($user->rank == 3)
                        <li class="{{ Request::is('admin/page') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'admin/page')) echo "active"; ?>">
                            <a title="Pages" href="{{ url('admin/page') }}">
                                <em class="icon-doc"></em>
                                <span>Pages</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/stream') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'admin/stream')) echo "active"; ?>">
                            <a title="Stream" href="{{ url('admin/stream') }}">
                                <em class="icon-control-play"></em>
                                <span>Stream</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/news') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'admin/news')) echo "active"; ?>">
                            <a title="News" href="{{ url('admin/news') }}">
                                <em class="icon-book-open"></em>
                                <span>News</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/shop') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'admin/shop')) echo "active"; ?>">
                            <a title="Boutique" href="{{ url('admin/shop') }}">
                                <em class="icon-basket"></em>
                                <span>Boutique</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/paypal') ? 'active' : '' }}">
                            <a title="PayPal" href="{{ url('admin/paypal') }}">
                                <em class="icon-paypal"></em>
                                <span>PayPal</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                            <a title="Paramètres" href="{{ url('admin/settings') }}">
                                <em class="icon-wrench"></em>
                                <span>Paramètres</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </aside>

    <section>
        <div class="content-wrapper">
            @yield('page-info')

            @yield('content')
        </div>
    </section>

    <footer>
        <span>&copy; 2016 - AltisPan</span>
    </footer>
</div>

<script src="{{ asset('/vendor/modernizr/modernizr.custom.js') }}"></script>
<script src="{{ asset('/vendor/matchMedia/matchMedia.js') }}"></script>
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('/vendor/jQuery-Storage-API/jquery.storageapi.js') }}"></script>
<script src="{{ asset('/vendor/jquery.easing/js/jquery.easing.js') }}"></script>
<script src="{{ asset('/vendor/animo.js/animo.js') }}"></script>
<script src="{{ asset('/vendor/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('/vendor/screenfull/dist/screenfull.js') }}"></script>
<script src="{{ asset('/vendor/jquery-localize-i18n/dist/jquery.localize.js') }}"></script>
<script src="{{ asset('/vendor/sparkline/index.js') }}"></script>
<script src="{{ asset('/vendor/Flot/jquery.flot.js') }}"></script>
<script src="{{ asset('/vendor/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('/vendor/Flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('/vendor/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('/vendor/Flot/jquery.flot.time.js') }}"></script>
<script src="{{ asset('/vendor/Flot/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('/vendor/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
<script src="{{ asset('/vendor/jquery-classyloader/js/jquery.classyloader.min.js') }}"></script>
<script src="{{ asset('/vendor/moment/min/moment-with-locales.min.js') }}"></script>

<script src="{{ asset('/js/app.js')}}"></script>
<script src="{{ asset('/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/js/altispan.js') }}"></script>
<script src="{{ asset('/js/licenses.js') }}"></script>
<script src="{{ asset('/js/rcon.js') }}"></script>
</body>

</html>