@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Créer un ticket
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
                        <form action="{{ url('support/open') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input placeholder="Titre" type="text" name="title" class="form-control">
                            <br>
                            <textarea placeholder="Description" class="form-control" name="content" rows="5"></textarea>
                            <br>
                            <button class="btn btn-success">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection