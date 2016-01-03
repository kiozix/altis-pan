@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Streams
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    <p class="text-right">
        <a href="{{ action('StreamsController@create') }}" class="btn btn-primary">Ajouter un stream </a>
    </p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Slug</th>
                <th>Content</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($streams as $stream)
            <tr>
                <th>{{ $stream->id }}</th>
                <th>{{ $stream->name }}</th>
                <th>{{ $stream->slug }}</th>
                <th>{{$stream->content }}</th>
                <th>
                    <a href="{{ action('StreamsController@edit', $stream) }}" class="btn btn-primary">Editer</a>
                    <a href="{{ action('StreamsController@destroy', $stream) }}" data-method="delete" data-confirm="Voulez vous vraiment suprimer cette enregistrement ?" class="btn btn-danger">Suprimmer</a>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection