@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Réinitialiser votre mot de passe
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @if (session('status'))
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> Il y a un problème !<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-6 col-md-offset-3">
                            <div class="row">
                                <form role="form" method="POST" action="{{ url('/password/email') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="sr-only">Email</label>
                                            <input placeholder="Adresse Email" id="email" name="email" type="email" class="form-control input-lg" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary col-md-12" value="Envoyer">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
