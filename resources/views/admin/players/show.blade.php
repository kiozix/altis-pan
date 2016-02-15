@extends('admin.app')

@section('page-info')
    <h3>{{ $player->name }}</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                @include('admin.players.layout.joueur-info')

                @include('admin.players.layout.user-info')

                @include('admin.players.layout.offenses')

                @include('admin.players.layout.vehicules')
            </div>

            <div class="col-md-6">
                @include('admin.players.layout.money')

                @include('admin.players.layout.houses')

                @include('admin.players.layout.licenses')
            </div>
        </div>
    </div>
@endsection