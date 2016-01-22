@extends('admin.app')

@section('page-info')
    <div class="content-heading">
        Dashboard
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="panel widget bg-primary">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-primary-dark pv-lg">
                        <em class="icon-game-controller fa-3x"></em>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div class="h2 mt0">{{ $players }}</div>
                        <div class="text-uppercase">Joueurs</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="panel widget bg-purple">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-purple-dark pv-lg">
                        <em class="icon-people fa-3x"></em>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div class="h2 mt0">{{ $users }}</div>
                        <div class="text-uppercase">Utilisateurs</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="panel widget bg-green">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-green-dark pv-lg">
                        <em class="icon-book-open fa-3x"></em>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div class="h2 mt0">{{ $news }}</div>
                        <div class="text-uppercase">News</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="panel widget">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-green pv-lg">
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
                    <div id="panelChart9" class="panel panel-default panel-demo">
                        <div class="panel-heading">
                            <div class="panel-title">Dernier joueurs</div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-striped">
                                <tr>
                                    <th>Nom du joueur</th>
                                    <th>ID Arma</th>
                                    <th>Argent</th>
                                </tr>
                                @foreach($players_last as $player)
                                    <tr>
                                        <td><a href="{{ url('admin/player/'. $player->playerid) }}">{{ $player->name }}</a></td>
                                        <td>{{ $player->playerid }}</td>
                                        <td>
                                            <?php
                                            $money = $player->cash + $player->bankacc;

                                            if ($money < 500000) {
                                                $argent = number_format($money, 2, ',', ' ');
                                                echo "<span class='label label-success'>". $argent ." $</span>";
                                            } elseif (800000 > $money) {
                                                $argent = number_format($money, 2, ',', ' ');
                                                echo "<span class='label label-warning'>". $argent ." $</span>";
                                            } else {
                                                $argent = number_format($money, 2, ',', ' ');
                                                echo "<span class='label label-danger'>". $argent ." $</span>";
                                            }
                                            ?>
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
        </aside>

    </div>
@endsection