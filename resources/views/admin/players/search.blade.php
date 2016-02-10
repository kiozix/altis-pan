@extends('admin.app')

@section('page-info')
    <h3>Résultat de la recherche pour {{ $q }}</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach($players as $player)
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;"><a href="{{ url('admin/player/'. $player->playerid) }}">{{ $player->name }}</a></span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <table class="table table-responsive table-striped">
                                <tr>
                                    <td>Nom du joueur</td>
                                    <td>{{ $player->name }}</td>
                                </tr>
                                <tr>
                                    <td>Portes-monnaie</td>
                                    <td>
                                        @if($user->rank == 1)
                                            <span class='label label-info'>Masqué</span>
                                        @else
                                            <?php
                                            $money = $player->cash;

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
                                <tr>
                                    <td>Banque</td>
                                    <td>
                                        @if($user->rank == 1)
                                            <span class='label label-info'>Masqué</span>
                                        @else
                                            <?php
                                            $money = $player->bankacc;

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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {!! $players->appends(['q' => $q])->render() !!}
        </div>
    </div>
@endsection