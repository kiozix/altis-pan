@extends('admin.app')

@section('page-info')
    <h3>Joueurs connectés</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <?php
            if(env('RCON_INIT', false) == true) {
                $CurrentPlayers = $Query->GetPlayers();
                $info = $Query->GetInfo();
            }

            if(empty($CurrentPlayers)){
                $CurrentPlayers = null;
            }
            ?>
            <div id="list_players" class="panel panel-default">
                <div class="panel-heading">Joueurs connectés ({{ $info['Players']  }})
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
                            @foreach($CurrentPlayers as $CurrentPlayer)
                                <?php
                                    foreach($playersAll as $player_single) {
                                        if($CurrentPlayer['Name'] == $player_single->name){
                                            $playerid = $player_single->playerid;
                                            $name = $player_single->name;
                                            $cash = $player_single->cash;
                                            $bankacc = $player_single->bankacc;
                                        }
                                    }

                                    if(empty($playerid)){
                                        $playerid = null;
                                        $name = null;
                                        $cash = null;
                                        $bankacc = null;
                                    }
                                ?>
                                <tr>
                                    <td><a href="{{ url('admin/player/'. $playerid) }}">{{ $name }}</a></td>
                                    <td>{{ $playerid }}</td>
                                    <td>@if($user->rank == 1)
                                            <span class='label label-info'>Masqué</span>
                                        @else
                                            <?php
                                            $money = $cash + $bankacc;

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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection