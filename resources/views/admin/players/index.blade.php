@extends('admin.app')

@section('page-info')
    <h3>Joueurs</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="list_players" class="panel panel-default">
                <div class="panel-heading">Joueurs ({{ $numberPlayers }})
                    <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                        <em class="fa fa-minus"></em>
                    </a>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <table class="table table-responsive table-striped">
                            <tr>
                                <th>Nom du joueur</th>
                                <th>ID Arma</th>
                                <th>Argent</th>
                            </tr>
                            @foreach($players as $player)
                                <tr>
                                    <td><a href="{{ route('player', ['id' => $player->playerid]) }}">{{ $player->name }}</a></td>
                                    <td>{{ $player->playerid }}</td>
                                    <td>
                                        @if($user->rank == 1)
                                            <span class='label label-info'>Masqué</span>
                                        @else
                                            <?php
                                            $money = $player->cash + $player->bankacc;

                                            if ($money < env('MONEY_WARNING', 500000)) {
                                                $argent = number_format($money, 2, ',', ' ');
                                                echo "<span class='label label-success'>". $argent ." $</span>";
                                            } elseif (env('MONEY_DANGER', 5000000) >= $money) {
                                                $argent = number_format($money, 2, ',', ' ');
                                                echo "<span class='label label-warning'>". $argent ." $</span>";
                                            } else {
                                                $argent = number_format($money, 2, ',', ' ');
                                                echo "<span class='label label-danger'>". $argent ." $</span>";
                                            }
                                            ?>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $players->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection