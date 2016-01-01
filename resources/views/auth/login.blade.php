@extends('app')

@section('content')

    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Connexion
                        <span class="fh5co-border"></span>
                    </h1>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <br/><br/><br/>
                        {!! Form::open(['class' => 'form-horizontal']) !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nom d'utilisateur ou Email</label>

                            <div class="col-md-6">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Mot de passe</label>

                            <div class="col-md-6">
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Se connecter
                                </button>
                                <a class="btn btn-link" href="{{ url('/password/email') }}">Mot de passe oublié ?</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </aside>
@endsection
