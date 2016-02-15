@extends('admin.app')

@section('page-info')
    <div class="content-heading">
        Dashboard
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="panel widget bg-purple">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-purple-dark pv-lg">
                        <em class="icon-game-controller fa-3x"></em>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <?php
                            if(env('RCON_INIT', false) == true) {
                                $info = $Query->GetInfo();
                                $CurrentPlayers = $Query->GetPlayers();
                            }

                            if(empty($info)){
                                $info = null;
                            }

                            if(empty($CurrentPlayers)){
                                $CurrentPlayers = null;
                            }
                        ?>
                        <div class="h2 mt0">{{ $players }}</div>
                        <div class="text-uppercase">Joueurs</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="panel widget bg-primary">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-primary-dark pv-lg">
                        <em class="icon-tag fa-3x"></em>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div class="h2 mt0">{{ $support }}</div>
                        <div class="text-uppercase">Ticket Ouvert</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="panel widget bg-info">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-info-dark pv-lg">
                        <em class="icon-credit-card fa-3x"></em>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div class="h2 mt0">{{ $refunds }}</div>
                        <div class="text-uppercase">Remboursement Ouvert</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="panel widget">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-inverse-light pv-lg">
                        <div data-now="" data-format="MMMM" class="text-sm"></div>
                        <br>
                        <div data-now="" data-format="D" class="h2 mt0"></div>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div data-now="" data-format="dddd" class="text-uppercase"></div>
                        <br>
                        <div data-now="" data-format="h:mm" class="h2 mt0"></div>
                        <div data-now="" data-format="a" class="text-muted text-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9">
            @include('flash')
            <div class="row">
                <div class="col-lg-12">
                    <div id="money-player" class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">Joueur les plus riche</div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-striped">
                                <tr>
                                    <th>Nom du joueur</th>
                                    <th>ID Arma</th>
                                    <th>Argent</th>
                                </tr>
                                @foreach($players_money as $player)
                                    <tr>
                                        <td><a href="{{ url('admin/player/'. $player->playerid) }}">{{ $player->name }}</a></td>
                                        <td>{{ $player->playerid }}</td>
                                        <td>@if($user->rank == 1)
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <aside class="col-lg-3">
            @if(env('RCON_INIT', false) == true && $CurrentPlayers && $info['Players'] < 5)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Joueurs connectés</div>
                    </div>
                    @foreach($CurrentPlayers as $CurrentPlayer)
                        <?php
                            foreach($playersAll as $player_single) {
                                if($CurrentPlayer['Name'] == $player_single->name){
                                    $playerid = $player_single->playerid;
                                }
                            }

                            if(empty($playerid)){
                                $playerid = null;
                            }
                        ?>
                        <div class="list-group">
                            <div class="list-group-item">
                                <div class="media-box">
                                    <div class="pull-left">
                                <span class="fa-stack">
                                   <em class="fa fa-circle fa-stack-2x text-success"></em>
                                   <em class="fa fa-male fa-stack-1x fa-inverse text-white"></em>
                                </span>
                                    </div>
                                    <div class="media-box-body clearfix">
                                        <small class="text-muted pull-right ml">{{ $CurrentPlayer['TimeF'] }}</small>
                                        <div class="media-box-heading"><a href="{{ url('admin/player/'. $playerid) }}" class="text-info m0">{{ $CurrentPlayer['Name'] }}</a>
                                        </div>
                                        <p class="m0">
                                            <small><a href="{{ url('admin/player/'. $playerid) }}">Afficher</a></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="panel-footer clearfix">
                        <small>{{ $info['Players'] . '/' . $info['MaxPlayers'] }}</small>
                    </div>
                </div>
            @endif

            @if(env('RCON_INIT', false) == true && $CurrentPlayers && $info['Players'] >= 5)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="panel-title">Remplissage du serveur</div>
                        <canvas data-classyloader="" data-percentage="{{ $info['Players'] / $info['MaxPlayers'] * 100 }}" data-speed="20" data-font-size="40px" data-diameter="70" data-line-color="#23b7e5" data-remaining-line-color="rgba(200,200,200,0.4)" data-line-width="10" data-rounded-line="true" class="center-block js-is-in-view" width="200" height="200"></canvas>
                    </div>
                    <div class="panel-footer clearfix">
                        <a href="{{ url('admin/player/connected') }}" class="pull-left">
                            <small>Voir plus</small>
                        </a>
                    </div>
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Dernier Joueurs</div>
                </div>
                @foreach($players_last as $player)
                <div class="list-group">
                    <div class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                <span class="fa-stack">
                                   <em class="fa fa-circle fa-stack-2x text-info"></em>
                                   <em class="fa fa-male fa-stack-1x fa-inverse text-white"></em>
                                </span>
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="text-muted pull-right ml">{{ $player->playerid }}</small>
                                <div class="media-box-heading"><a href="{{ url('admin/player/'. $player->playerid) }}" class="text-info m0">{{ $player->name }}</a>
                                </div>
                                <p class="m0">
                                    <small><a href="{{ url('admin/player/'. $player->playerid) }}">Afficher</a></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="panel-footer clearfix">
                    <a href="{{ url('admin/player') }}" class="pull-left">
                        <small>Voir plus</small>
                    </a>
                </div>
            </div>

            @if($paypal && $user->rank == 3)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Dernier Achat</div>
                    </div>
                    @foreach($paypal as $achat)
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="media-box">
                                <div class="pull-left">
                                    <span class="fa-stack">
                                       <em class="fa fa-circle fa-stack-2x text-info"></em>
                                       <em class="fa fa-file-text-o fa-stack-1x fa-inverse text-white"></em>
                                    </span>
                                </div>
                                <div class="media-box-body clearfix">
                                    <small class="text-muted pull-right ml">{{ $achat->created_at }}</small>
                                    <div class="media-box-heading"><a href="{{ url('admin/paypal') }}" class="text-info m0">{{ $achat->id_shop }}</a>
                                    </div>
                                    <p class="m0">
                                        <small><a href="{{ url('admin/player/'. $achat->id_arma) }}">{{ $achat->id_user }}</a></small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="panel-footer clearfix">
                        <a href="{{ url('admin/paypal') }}" class="pull-left">
                            <small>Voir plus</small>
                        </a>
                    </div>
                </div>
            @endif
        </aside>

    </div>
@endsection