@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        News
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    <p class="text-right">
        <a href="{{ action('NewsController@create') }}" class="btn btn-primary">Ajouter un stream </a>
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
        @foreach($news as $new)
            <tr>
                <th>{{ $new->id }}</th>
                <th>{{ $new->name }}</th>
                <th>{{ $new->slug }}</th>
                <th>{{ $new->content }}</th>
                <th>
                    <a href="{{ action('NewsController@edit', $new) }}" class="btn btn-primary">Editer</a>
                    <a href="{{ action('NewsController@destroy', $new) }}" data-method="delete" data-confirm="Voulez vous vraiment suprimer cette enregistrement ?" class="btn btn-danger">Suprimmer</a>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection