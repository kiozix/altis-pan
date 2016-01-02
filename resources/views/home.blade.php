@extends('app')

@section('content')
    <div class="fh5co-slider">
        <div class="owl-carousel owl-carousel-fullwidth">
            <!-- Slide type 1 -->
            <div class="item" style="background-image:url(http://altisforlife.fr/wp-content/themes/zerif-lite/images/bg3.jpg)">
                <div class="fh5co-overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="fh5co-owl-text-wrap">
                                <div class="fh5co-owl-text text-center to-animate">
                                    <h1 class="fh5co-lead">Bienvenue sur AltisForLife</h1>
                                    <h2 class="fh5co-sub-lead">Pour vous connecter sur le serveur cliquer <a href="#">ici</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide type 2 -->
            <div class="item" style="background-image:url(http://puu.sh/mfQOq/6f0e3420bb.jpg);" >
                <div class="fh5co-overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fh5co-owl-text-wrap">
                                <div class="fh5co-owl-text text-center to-animate">
                                    <div class="col-md-4">
                                        <img class="img-responsive" src="http://cdn.akamai.steamstatic.com/steam/apps/107410/header.jpg">
                                    </div>
                                    <div class="col-md-8">
                                        <h1 class="fh5co-lead">Mise a jours !</h1>
                                        <h2 class="fh5co-sub-lead">Grace a la dernière mise a jours d'Arma 3 découvrez nos nouveaux vehicules !</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="fh5co-main">
        <!-- Features -->

        <div id="fh5co-features">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="fh5co-section-lead">Quelques informations</h2>
                        <h3 class="fh5co-section-sub-lead">Afin que ce serveur reste agréable, convivial et où règne une athmosphère paisible, nous vous prions de bien vouloir suivre ces quelques règles.
                            <br />Pour plus d'informations, merci de contacter les modérateurs sur le teamspeak.</h3>
                    </div>
                    <div class="fh5co-spacer fh5co-spacer-md"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 fh5co-feature-border">
                        <div class="fh5co-feature">
                            <div class="fh5co-feature-icon to-animate">
                                <i class="icon-lock"></i>
                            </div>
                            <div class="fh5co-feature-text">
                                <h3>Verouillez vos véhicules</h3>
                                <p>Quoi de pire que d'allez faire une course et se retrouvez sans véhicule après vos achats ? </p>
                                <p><br /></p>
                            </div>
                        </div>
                        <div class="fh5co-feature no-border">
                            <div class="fh5co-feature-icon to-animate">
                                <i class="icon-star"></i>
                            </div>
                            <div class="fh5co-feature-text">
                                <h3>Avis ?</h3>
                                <p>Votre avis nous intéresse, dites nous vos remarques, vos envies sur le forum!</p>
                                <p><a href="#">Forum</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="fh5co-feature">
                            <div class="fh5co-feature-icon to-animate">
                                <i class="icon-microphone"></i>
                            </div>
                            <div class="fh5co-feature-text">
                                <h3>Parlez vous !</h3>
                                <p>Un serveur vocal est a votre disposition, alors pourquoi ne pas nous rejoindre aussi dessus ? </p>
                                <p><a href="#">Teamspeak</a></p>
                            </div>
                        </div>
                        <div class="fh5co-feature no-border">
                            <div class="fh5co-feature-icon to-animate">
                                <i class="icon-clock"></i>
                            </div>
                            <div class="fh5co-feature-text">
                                <h3>Un problème ?</h3>
                                <p>En cas de besoin, n'hésitez pas a contactez les modérateurs, ils sont la pour vous aider .</p>
                                <p><a href="#">Le Support</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Features -->
    </div>
@endsection