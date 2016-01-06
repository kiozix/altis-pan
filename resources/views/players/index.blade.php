@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Joueurs
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

<div class="container">
    <table class="table table-striped table-responsive">
        @foreach($players as $player)
            <tr>{{ $player->name }}</tr>
            <tr>{{ $player->coplevel }}</tr>
            <tr>{{ $player->mediclevel }}</tr>
        @endforeach
    </table>
</div>

@endsection