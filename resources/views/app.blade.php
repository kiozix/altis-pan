<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="fr"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('SITE_NAME', 'AltisPan') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site réalisée avec AltisPan, CMS dédiée au Mod multijoueur Altis Life. Réalisation : Lucas GRELAUD, Emile LEPTIT."/>
    <meta name="keywords" content="altis life, cms, altispan, arma, 3, serveur"/>
    <meta name="author" content="Lucas GRELAUD, Emile LEPETIT"/>
    <!-- Don't modify the web_author meta , only the author meta please -->
    <meta name="web_author" content="Lucas GRELAUD, Emile LEPETIT">
    <meta name="contact" content="">
    <meta name="revisit-after" content="7 days">
    <meta name="copyright" content="AltisPan">
    <meta name="language" content="French">

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content=""/>
    <meta name="twitter:image" content=""/>
    <meta name="twitter:url" content=""/>
    <meta name="twitter:card" content=""/>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('/img/favicon.ico') }}">

    <!-- Google Webfonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('/css/animate.css') }}">
    <!-- Feather font -->
    <link rel="stylesheet" href="{{ asset('/css/feather.css') }}">
    <!-- FontAwesome font -->
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/owl.theme.default.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('/css/magnific-popup.css') }}">
    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <!-- SweetAlert-->
    <link rel="stylesheet" href="{{ asset('/css/sweetalert.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}">
    <!-- Modernizr JS -->
    <script src="{{ asset('/js/modernizr-2.6.2.min.js') }}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="{{ asset('/js/respond.min.js') }}"></script>
    <![endif]-->

</head>
<body>
<div class="content">
    <header id="fh5co-header" role="banner">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!-- Mobile Toggle Menu Button -->
                    <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse"
                       data-target="#fh5co-navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
                    <a class="navbar-brand" href="{{ url('/') }}">{{ env('SITE_NAME', 'AltisPan') }}</a>
                </div>
                <div id="fh5co-navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li <?php if (Request::is('home') OR Request::is('/')) { echo 'class="active"'; } ?>>
                            <a href="{{ url('/') }}"><span><i class="fa fa-home"></i> Accueil<span class="border"></span></span></a>
                        </li>

                        <li class="{{ Request::is('news') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'news/')) echo "active"; ?>">
                            <a href="{{ url('/news') }}"><span><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;News<span class="border"></span></span></a>
                        </li>

                        <!--<li><a href="#"><span><i class="fa fa-comments-o"></i>&nbsp;&nbsp;Forum<span class="border"></span></span></a></li>-->

                        <li class="{{ Request::is('shop') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'shop/')) echo "active"; ?>">
                            <a href="{{ url('/shop') }}"><span><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Boutique<span class="border"></span></span></a>
                        </li>

                        <li class="{{ Request::is('stream') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'stream/')) echo "active"; ?>">
                            <a href="{{ url('/stream') }}"><span><i class="fa fa-video-camera"></i>&nbsp;&nbsp;Stream<span class="border"></span></span></a>
                        </li>

                        @if (Auth::guest())
                            <li class="{{ Request::is('auth/login') ? 'active' : '' }}">
                                <a href="{{ url('/auth/login') }}"><span><i class="fa fa-unlock"></i>&nbsp;&nbsp;Connexion<span class="border"></span></span></a>
                            </li>

                            <li class="{{ Request::is('auth/register') ? 'active' : '' }}">
                                <a href="{{ url('/auth/register') }}"><span><i class="fa fa-pencil"></i>&nbsp;&nbsp;Inscription<span class="border"></span></span></a>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>&nbsp;&nbsp;Mon Compte<span class="caret"></span><span class="border"></span></a>
                                <ul class="dropdown-menu">
                                    @if (Auth::user()->admin == 1)
                                        <li>
                                            <a href="{{ url('admin') }}"><i class="fa fa-wrench"></i>&nbsp;&nbsp;Admin<span class="border"></span></a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                    @endif
                                    <li>
                                        <a href="{{ route('profil') }}"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Mon compte<span class="border"></span></a>
                                    </li>
                                    @if(Auth::user()->arma)
                                    <li>
                                        <a href="{{ url('/player') }}"><i class="fa fa-server"></i>&nbsp;&nbsp;AltisLife<span class="border"></span></a>
                                    </li>
                                    @endif
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{ url('/auth/logout') }}"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;&nbsp;Déconnexion</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
</div>

<footer id="footer">
    <hr/>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="fh5co-footer-widget">
                    <h2 class="fh5co-footer-logo">{{ env('SITE_NAME', 'AltisPan') }}</h2>
                    <p>Site réalisé avec AltisPan, CMS dédiée au Mod multijoueur Altis Life. Réalisation : Lucas
                        GRELAUD, Emile LEPETIT.</p><!-- Correspond a la meta "description" -->
                    <p> &copy; Copyright <a href="#">AltisPan</a>, site par <a href="https://madebyhost.com/" target="_blank">MadeByhost</a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="fh5co-footer-widget top-level">
                    <h4 class="fh5co-footer-lead ">Liens utiles</h4>
                    <ul>
                        <li><a href="{{ url('news') }}">News</a></li>
                        <li><a href="{{ url('shop') }}">Boutique</a></li>
                        <li><a href="{{ url('stream') }}">Stream</a></li>
                        <li><a href="http://arma3.com">Arma 3</a></li>
                    </ul>
                </div>
            </div>

            <div class="visible-sm-block clearfix"></div>

            <div class="col-md-3 col-sm-6">
                <div class="fh5co-footer-widget top-level">
                    <h4 class="fh5co-footer-lead">Nous suivre</h4>
                    <ul class="fh5co-list-check">
                        <li><a href="#">Steam</a></li>
                        <li><a href="#">Twitch</a></li>
                        <li><a href="#">FaceBook</a></li>
                        <li><a href="#">GameTracker</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<!-- SweetAlert -->
<script src="{{ asset('/js/sweetalert.min.js') }}"></script>
<!-- jQuery Easing -->
<script src="{{ asset('/js/jquery.easing.1.3.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<!-- Owl carousel -->
<script src="{{ asset('/js/owl.carousel.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('/js/jquery.waypoints.min.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('/js/main.js') }}"></script>

<script src="{{ asset('/js/laravel.js') }}"></script>
<!-- Select 2 -->
<script src="{{ asset('/js/select2.full.min.js') }}"></script>
<!-- AltisPan -->
<script src="{{ asset('/js/altispan.js') }}"></script>



</body>
</html>
