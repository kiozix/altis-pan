@extends('admin.app')

@section('page-info')
    <h3>Transfère de véhicule</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                @include('flash')
            </div>
            <div class="col-md-6">
                <div id="informations" class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">Transfère de véhicule</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <form action="" method="post">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                <table class="table table-striped table-responsive">
                                    <tr>
                                        <td>Nom</td>
                                        <td>{{ $vehicule->classname }}</td>
                                    </tr>
                                    <tr>
                                        <td>Emplacement du garage</td>
                                        <td>{{ $vehicule->side }}</td>
                                    </tr>
                                    <tr>
                                        <td>Type</td>
                                        <td>{{ $vehicule->type }}</td>
                                    </tr>
                                    <tr>
                                        <td>Propriétaire</td>
                                        <td>{{ $owner->name }}</td>
                                    </tr>
                                </table>
                                <hr>
                                <div class="form-group">
                                    <label for="allplayers">Transféré à</label>
                                    <select name="playerid" class="form-control player-gang" id="allplayers">
                                        @foreach($allPlayers as $player)
                                            <option value="{{ $player->playerid }}">{{ $player->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-labeled btn-info">
                                        <span class="btn-label"><i class="fa fa-exchange"></i></span>Transérer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection