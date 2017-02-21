<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('SITE_NAME', 'AltisPan') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ env('DESCRIPTION', 'Site réalisé avec AltisPan, CMS dédiée au Mod multijoueur Altis Life. Réalisation : Lucas GRELAUD, Emile LEPETIT.') }}"/>
    <meta name="keywords" content="altis life, cms, altispan, arma, 3, serveur, {{ env('SITE_NAME', 'AltisPan') }}"/>
    <meta name="author" content="Lucas GRELAUD, Emile LEPETIT"/>
    <!-- Don't modify the web_author meta , only the author meta please -->
    <meta name="web_author" content="Lucas GRELAUD, Emile LEPETIT">
    <meta name="contact" content="emile.lepetit@gmail.com">
    <meta name="revisit-after" content="7 days">
    <meta name="copyright" content="AltisPan">
    <meta name="language" content="French">

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="{{ env('SITE_NAME', 'AltisPan') }}"/>
    <meta property="og:image" content="{{ asset('/img/logo-single.png') }}"/>
    <meta property="og:url" content="{{ url('/') }}"/>
    <meta property="og:site_name" content="{{ env('SITE_NAME', 'AltisPan') }}"/>
    <meta property="og:description" content="Bienvenue sur {{ env('SITE_NAME', 'AltisPan') }}, un serveur AltisLife qui n'attend que vous !"/>

    <meta name="twitter:title" content="{{ env('SITE_NAME', 'AltisPan') }}"/>
    <meta name="twitter:image" content="{{ asset('/img/logo-single.png') }}"/>
    <meta name="twitter:url" content="{{ url('/') }}"/>
    <meta name="twitter:description" content="Bienvenue sur {{ env('SITE_NAME', 'AltisPan') }}, un serveur AltisLife qui n'attend que vous !"/>
    <meta name="twitter:card" content="summary"/>

    <link rel="shortcut icon" href="{{ asset('/img/favicon.ico') }}">

    <!-- Google Webfonts -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
-->
    <!-- BootStrap -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <!-- FontAwesome font -->
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
    <!-- SumerNote -->
    <link rel="stylesheet" href="{{ asset('/vendor/summernote/summernote.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('/css/magnific-popup.css') }}">
    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

<nav id="mainNavs" class="navbar navbar-default navbar-fixed-top affix">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="{{ url('/') }}">{{ env('SITE_NAME', 'AltisPan') }}</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li <?php if (Request::is('home') OR Request::is('/')) { echo 'class="active"'; } ?>>
                    <a href="{{ url('/') }}"><span><i class="fa fa-home"></i> Accueil<span class="border"></span></span></a>
                </li>

                <li class="{{ Request::is('news') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'news/')) echo "active"; ?>">
                    <a href="{{ url('/news') }}"><span><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;News<span class="border"></span></span></a>
                </li>

                <li class="{{ Request::is('forum') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'forum/')) echo "active"; ?>">
                    <a href="{{ url('/forum') }}"><span><i class="fa fa-comment-o"></i>&nbsp;&nbsp;Forum<span class="border"></span></span></a>
                </li>

                <li class="{{ Request::is('bourse') ? 'active' : '' }} <?php $path = Route::getCurrentRoute()->getPath(); if (starts_with($path, 'bourse/')) echo "active"; ?>">
                    <a href="{{ url('/bourse') }}"><span><i class="fa fa-line-chart"></i>&nbsp;&nbsp;Bourse<span class="border"></span></span></a>
                </li>

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
                            @if (Auth::user()->rank != 0)
                                <li>
                                    <a href="{{ url('admin') }}"><i class="fa fa-wrench"></i>&nbsp;&nbsp;Admin<span class="border"></span></a>
                                </li>
                                <li role="separator" class="divider"></li>
                            @endif
                                <li>
                                    <a href="{{ route('profil') }}"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Paramètres<span class="border"></span></a>
                                </li>
                            @if(Auth::user()->arma)
                                <li>
                                    <a href="{{ url('/player') }}"><i class="fa fa-server"></i>&nbsp;&nbsp;AltisLife<span class="border"></span></a>
                                </li>
                            @endif
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ url('/support') }}"><i class="fa fa-life-ring"></i>&nbsp;&nbsp;Support<span class="border"></span></a>
                            </li>
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

@yield('header')
@yield('content')

<footer id="footer">
    <hr/>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="footer-widget">
                    <h2 class="footer-logo">{{ env('SITE_NAME', 'AltisPan') }}</h2>
                    <p>{{ env('DESCRIPTION', 'Site réalisé avec AltisPan, CMS dédiée au Mod multijoueur Altis Life. Réalisation : Lucas GRELAUD, Emile LEPETIT.') }}</p>
                    <p>&copy; Copyright <a href="#">AltisPan</a>, site par <a href="http://emile-lepetit.fr/" target="_blank">Emile LEPETIT</a>.</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-widget top-level">
                    <h4 class="footer-lead ">Liens utiles</h4>
                    <ul>
                        <li><a href="{{ url('forum') }}">Forum</a></li>
                        <li><a href="{{ url('news') }}">News</a></li>
                        <li><a href="{{ url('shop') }}">Boutique</a></li>
                        <li><a href="{{ url('stream') }}">Stream</a></li>
                    </ul>
                </div>
            </div>

            <div class="visible-sm-block clearfix"></div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-widget top-level">
                    <h4 class="footer-lead">Nous suivre</h4>
                    <ul class="list-check">
                        <li><a href="{{ env('LINK_STEAM') }}">Steam</a></li>
                        <li><a href="{{ env('LINK_TWITCH') }}">Twitch</a></li>
                        <li><a href="{{ env('LINK_FACEBOOK') }}">FaceBook</a></li>
                        <li><a href="{{ env('LINK_GAMETRACKER') }}">GameTracker</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<!-- scrollreveal -->
<script src="{{ asset('/js/scrollreveal.min.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('/js/jquery.magnific-popup.min.js') }}"></script>
<!-- SummerNote JS -->
<script src="{{ asset('/vendor/summernote/summernote.js') }}"></script>
<script src="{{ asset('/vendor/summernote/lang/summernote-fr-FR.js') }}"></script>
<!-- Toastr JS -->
<script src="{{ asset('/vendor/toastr/toastr.min.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('/js/main.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
@yield('js')
</body>

</html>
