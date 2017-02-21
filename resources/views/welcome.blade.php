@extends('app')

@section('header')
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">{{ env('SITE_NAME') }}</h1>
                <hr>
                <p>Serveur arma 3 Altis Life non moddé !</p>
                <a href="{{ url('/auth/register') }}" class="btn btn-primary btn-xl page-scroll">S'inscrire</a>
                <a href="{{ url('/auth/login') }}" class="btn btn-default btn-xl page-scroll">Se connecter</a>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Rejoignez nous</h2>
                    <hr class="light">
                    <p class="text-faded">Un système de ticket / remboursement est mis en place sur le site, vous pouvez aussi posez vos questions sur le TeamSpeak 3 du serveur dans les cannaux d'aide.</p>
                    <a href="steam://connect/79.137.59.248:2302" class="page-scroll btn btn-default btn-xl sr-button">Se connecter au serveur</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Notre serveur</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-dashboard text-primary sr-icons"></i>
                        <h3>Rapide</h3>
                        <p class="text-muted">Nous sommes hébergé chez un hébergeur professionel, la qualité et donc au rendez-vous.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-users text-primary sr-icons"></i>
                        <h3>RolePlay</h3>
                        <p class="text-muted">Le RolePlay du serveur est poussé afin d'avoir un gameplay le plus réaliste.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                        <h3>Mise à jour</h3>
                        <p class="text-muted">Le serveur est mis à jours régulièrement pour équilibrer le gameplay.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-lock text-primary sr-icons"></i>
                        <h3>Securisé</h3>
                        <p class="text-muted">Le serveur est protégé par l'antihack InfiStar & Battleye</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Un TeamSpeak 3 est à votre disposition</h2>
                <a href="ts3server://ts.weed4life.fr" class="btn btn-default btn-xl sr-button">Se connecter au TeamSpeak</a>
            </div>
        </div>
    </aside>
@endsection