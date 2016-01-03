@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Ajouter une nouvelle espèce
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

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

    @include('streams.form', ['action'=> 'store'])
@endsection