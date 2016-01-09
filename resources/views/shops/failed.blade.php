@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Paiement Refusé
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    <div class="container">
        <div class="row">
            <span class="fa-stack fa-lg center-block" style="font-size: 15rem; color:#D43F3A">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-thumbs-down fa-stack-1x fa-inverse"></i>
            </span><br />
            <div class="alert alert-danger col-md-8 col-md-offset-2" role="alert">Une erreur est survenue, votre transaction a échouée merci de réesayer Si le problème persistecontactez le support.</div>
            <div class="col-md-12 text-center">
                <a href="{{ url('/') }}" class="btn btn-outline"><i class="fa fa-home"></i> Retouner à l'accueil</a>
            </div>
        </div>
    </div>
@endsection