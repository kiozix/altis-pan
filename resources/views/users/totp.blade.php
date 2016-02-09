@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Activer l'authentification à 2 facteurs
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12">
                            @include('flash')
                        </div>
                        <form action="{{ url('profil/totp') }}" method="post" class="form-horizontal">

                            <div class="col-md-4">
                                <div class="qrcode">
                                    <img src="{{ $qrcode }}" alt="QrCode">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <input type="text" name="code" class="form-control" placeholder="Entrer le code...">
                            </div>

                            <div class="col-md-12">
                                <div class="text-right">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection