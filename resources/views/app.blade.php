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
    <title>AltisPan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Site réalisée avec AltisPan, CMS dédiée au Mod multijoueur Altis Life. Réalisation : Lucas GRELAUD, Emile LEPTIT."/>
    <meta name="keywords" content="altis life, cms, altispan, arma, 3, serveur"/>
    <meta name="author" content="Lucas GRELAUD, Emile LEPETIT"/>
    <!-- Don't modify the web_author meta , only the author meta please -->
    <meta name="web_author" content="Lucas GRELAUD, Emile LEPETIT">
    <meta name="contact" content="">
    <meta name="revisit-after" content="7 days">
    <meta name="copyright" content="AltisPan">
    <meta name="language" content="French">
    <
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
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Google Webfonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('/css/animate.css') }}">
    <!-- Feather font -->
    <link rel="stylesheet" href="{{ asset('/css/feather.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/owl.theme.default.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('/css/magnific-popup.css') }}">
    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <!-- Modernizr JS -->
    <script src="{{ asset('/js/modernizr-2.6.2.min.js') }}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="{{ asset('/js/respond.min.js') }}"></script>
    <![endif]-->

</head>
<body>

<header id="fh5co-header" role="banner">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <!-- Mobile Toggle Menu Button -->
                <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse"
                   data-target="#fh5co-navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
                <a class="navbar-brand" href="{{ url('/') }}"><img class="img-responsive" src="http://placehold.it/350x50?text=AltisPan"</a>
            </div>
            <div id="fh5co-navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="{{ url('/') }}"><span>Accueil<span class="border"></span></span></a></li>
                    <li><a href="#"><span>Blog<span class="border"></span></span></a></li>
                    <li><a href="#"><span>Forum<span class="border"></span></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Le Serveur<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Page 1<span class="border"></a></li>
                            <li><a href="#">Page 2</a></li>
                            <li><a href="#">Page 3</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span>Boutique<span class="border"></span></span></a></li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}"><span>Connexion<span class="border"></span></span></a></li>
                        <li><a href="{{ url('/auth/register') }}"><span>Inscription<span class="border"></span></span></a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Mon Compte<span class="caret"></span><span class="border"></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profil') }}">Mon compte<span class="border"></a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url('/auth/logout') }}">Déconnexion</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- END .header -->

@yield('content')
<hr/>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="fh5co-footer-widget">
                <h2 class="fh5co-footer-logo">AltisPan</h2>

                <p>Site réalisée avec AltisPan, CMS dédiée au Mod multijoueur Altis Life. Réalisation : Lucas GRELAUD,
                    Emile LEPTIT.</p><!-- Correspond a la meta "description" -->
                <p> &copy; Copyright <a href="#">AltisPan</a>, site par <a href="http://emix-dev.fr/">EmixDev</a>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="fh5co-footer-widget top-level">
                <h4 class="fh5co-footer-lead ">Liens utiles</h4>
                <ul>
                    <li><a href="#">A propos</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Forum</a></li>
                    <li><a href="http://arma3.com">Arma 3</a></li>
                </ul>
            </div>
        </div>

        <div class="visible-sm-block clearfix"></div>

        <div class="col-md-3 col-sm-6">
            <div class="fh5co-footer-widget top-level">
                <h4 class="fh5co-footer-lead">Nous suivre</h4>
                <ul class="fh5co-list-check">
                    <li><a href="http://steamcommunity.com/">Steam</a></li>
                    <li><a href="http://steamcommunity.com/">Youtube</a></li>
                    <li><a href="https://www.facebook.com/">FaceBook</a></li>
                    <li><a href="https://twitter.com/">Twitter</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</footer>

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
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


</body>
</html>
