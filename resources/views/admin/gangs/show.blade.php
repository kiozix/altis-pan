@extends('admin.app')

@section('page-info')
    <h3>{{ $gang->name }}</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                @include('flash')
            </div>
            <div class="col-md-6">
                <div id="informations" class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">Informations</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <ul style="font-size: 15px">
                                <li>Nombres de membres maximum : {{ $gang->maxmembers }}</li>
                                <li>Compte en banque : <?php
                                    $money = $gang->bank;

                                    if ($money < 25000) {
                                        $argent = number_format($money, 2, ',', ' ');
                                        echo "<span class='label label-success'>". $argent ." $</span>";
                                    } elseif (150000 > $money) {
                                        $argent = number_format($money, 2, ',', ' ');
                                        echo "<span class='label label-warning'>". $argent ." $</span>";
                                    } else {
                                        $argent = number_format($money, 2, ',', ' ');
                                        echo "<span class='label label-danger'>". $argent ." $</span>";
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="members" class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">Membres</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <table class="table table-responsive group-members" data-group="{{ $gang->id }}" data-groupname="{{ $gang->name }}" data-callback="{{ route('deleteGangAdmin') }}">
                                <tr>
                                    <th>Nom du joueur</th>
                                    <th>Action</th>
                                </tr>

                                <tr>
                                    <form action="{{ route('addPlayerGangAdmin') }}" method="post">
                                        <td>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="groupId" value="{{ $gang->id }}">
                                            <select name="playerid" class="form-control player-gang">
                                                @foreach($allPlayers as $player)
                                                    <option value="{{ $player->playerid }}">{{ $player->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><button type="submit" class="btn btn-success gang-button"><i class="fa fa-check"></i></button></td>
                                    </form>
                                </tr>

                                @foreach($gangMembers as $member)
                                    <tr>
                                        <td><a href="#">{{ $member->name }}</a></td>
                                        <td>
                                            <a href="#" data-user="{{ $member->playerid }}" data-csrf="{{ csrf_token() }}" class="group-userlist"><i class="fa fa-close" style="color: #c0392b"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection