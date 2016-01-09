@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Paiement Accepté
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    <div class="container">
        <div class="row">
            <span class="fa-stack fa-lg center-block" style="font-size: 15rem; color:#198764">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
            </span><br />
            <div class="alert alert-success col-md-8 col-md-offset-2" role="alert">Votre paiement a été acceptée, vous pouvez maintenant profiter de votre achat sur notre serveur!  Merci a vous !</div>
            <div class="col-md-12 text-center">
                <a href="{{ url('/') }}" class="btn btn-outline"><i class="fa fa-home"></i> Retouner à l'accueil</a>
            </div>
        </div>
    </div>
@endsection