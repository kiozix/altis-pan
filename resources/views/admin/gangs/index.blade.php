@extends('admin.app')

@section('page-info')
    <h3>Gang</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="Gangs" class="panel panel-default">
                <div class="panel-heading">Gangs
                    <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                        <em class="fa fa-minus"></em>
                    </a>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <table class="table table-responsive table-striped">
                            <tr>
                                <th>Nom</th>
                                <th>Fondateur</th>
                                <th>Argent</th>
                            </tr>
                            @foreach($gangs as $gang)
                                <?php
                                foreach($PlayersName as $player){
                                    if($gang->owner == $player->playerid){
                                        $name = $player->name;
                                    }
                                }
                                ?>

                                <tr>
                                    <td><a href="{{ url('admin/gang/'. $gang->id) }}">{{ $gang->name }}</a></td>
                                    <td><a href="{{ route('player', ['id' => $gang->owner]) }}">{{ $name }}</a></td>
                                    <td>
                                        @if($user->rank == 1)
                                            <span class='label label-info'>Masqué</span>
                                        @else
                                            <?php
                                            $money = $gang->bank;

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
                        {!! $gangs->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection