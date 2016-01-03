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
                    @include('flash')
                    <div class="col-md-12">
                        <form role="form" method="POST" class="form-horizontal" action="{{ url('/password/email') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Adresse Email</label>
                                    <div class="col-md-6">
                                        <input placeholder="Adresse Email" id="email" name="email" type="email"
                                               class="form-control input-lg" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Se connecter
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
