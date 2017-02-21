@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        {{ $player->name }}
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('flash')
                <div class="tabbable ">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#a" data-toggle="tab">Informations</a></li>
                        <li><a href="#b" data-toggle="tab">Véhicules</a></li>
                        <li><a href="#d" data-toggle="tab">Licences</a></li>
                    @if($gang)<li><a href="#c" data-toggle="tab">Gangs</a></li>@endif
                    <li><a href="#e" data-toggle="tab">Demande de remboursement</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="a">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Votre personnage :</h3>
                                </div>
                                <div class="panel-body">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Nom</label>
                                            <div class="col-md-8">
                                                <input class="form-control input-lg" name="name" type="text" value="{{ $player->name }}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <br/><br/>

                                    @if($ranks->where('side', 'ADMIN')->where('value_associated', $player->adminlevel)->first())
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Rang</label>
                                                <div class="col-md-8">
                                                    <input class="form-control input-lg" name="name" type="text" value="{{ $ranks->where('side', 'ADMIN')->where('value_associated', $player->adminlevel)->first()->name }}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <br/><br/>
                                    @endif

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Cash</label>
                                            <div class="col-md-8">
                                                <input class="form-control input-lg" type="text" value="{{ number_format($player->cash, 2, ',', ' ') . ' $' }}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <br/><br/>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Compte Banque</label>
                                            <div class="col-md-8">
                                                <input class="form-control input-lg" type="text" value="{{ number_format($player->bankacc, 2, ',', ' ') . ' $' }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <br /><br />

                                    @if($player->mediclevel > 0 && $ranks->where('side', 'MEDIC')->where('value_associated', $player->mediclevel)->first())
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Rang Pompier <a type="button" data-toggle="modal" data-target="#pompier">(?)</a></label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control input-lg" value="{{ $ranks->where('side', 'MEDIC')->where('value_associated', $player->mediclevel)->first()->name }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <br /><br />
                                    @endif

                                    @if($player->coplevel > 0 && $ranks->where('side', 'COP')->where('value_associated', $player->coplevel)->first())
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Rang Policier <a type="button" data-toggle="modal" data-target="#police">(?)</a></label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control input-lg" value="{{ $ranks->where('side', 'COP')->where('value_associated', $player->coplevel)->first()->name }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <br /><br />
                                    @endif


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Rang donateur</label>
                                            <div class="col-md-8">
                                                @if($player->donorlevel > 0)
                                                    <span class="donatorlvl"><i class="fa fa-check"></i> Vous êtes donateur jusqu'au</span>
                                                    {{ date("d-m-Y à H:i:s", $player->timestamp + (60 * 60 * 24 * $player->duredon)) }}
                                                @else
                                                    <span class="donatorlvl"><i class="fa fa-close"></i> Vous n'êtes pas donateur</span>
                                                    <br>
                                                    <a href="{{ url('shop/') }}">Le devenir ?</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="b">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Véhicules :</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Terrestre
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                <table class="table table-striped table-responsive">
                                                    <tr>
                                                        <th>Nom</th>
                                                        <th>Emplacement du garage</th>
                                                        <th>Type</th>
                                                        @if($insure && $insure->value_associated == 1)
                                                            <th>Assurance</th>
                                                        @endif
                                                        <th>Active</th>
                                                    </tr>
                                                    @foreach($vehicles->where('type', 'Car') as $car)
                                                        <tr>
                                                            <td>{{ $car->classname }}</td>
                                                            <td>{{ $car->side }}</td>
                                                            <td>{{ $car->type }}</td>
                                                            @if($insure && $insure->value_associated == 1)
                                                                <td>
                                                                    @if($car->insure == 1)
                                                                        <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                                    @elseif($car->insure == 0)
                                                                        <i class="fa fa-close" style="color: #c0392b;"></i>
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            <td>
                                                                @if($car->active == 1)
                                                                    <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                                @elseif($car->active == 0)
                                                                    <i class="fa fa-close" style="color: #c0392b;"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingTwo">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Aérien
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                <table class="table table-striped table-responsive">
                                                    <tr>
                                                        <th>Nom</th>
                                                        <th>Emplacement du garage</th>
                                                        <th>Type</th>
                                                        @if($insure && $insure->value_associated == 1)
                                                            <th>Assurance</th>
                                                        @endif
                                                        <th>Active</th>
                                                    </tr>
                                                    @foreach($vehicles->where('type', 'Air') as $air)
                                                        <tr>
                                                            <td>{{ $air->classname }}</td>
                                                            <td>{{ $air->side }}</td>
                                                            <td>{{ $air->type }}</td>
                                                            @if($insure && $insure->value_associated == 1)
                                                                <td>
                                                                    @if($air->insure == 1)
                                                                        <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                                    @elseif($air->insure == 0)
                                                                        <i class="fa fa-close" style="color: #c0392b;"></i>
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            <td>
                                                                @if($air->active == 1)
                                                                    <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                                @elseif($air->active == 0)
                                                                    <i class="fa fa-close" style="color: #c0392b;"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingThree">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        Aquatique
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                <table class="table table-striped table-responsive">
                                                    <tr>
                                                        <th>Nom</th>
                                                        <th>Emplacement du garage</th>
                                                        <th>Type</th>
                                                        @if($insure && $insure->value_associated == 1)
                                                            <th>Assurance</th>
                                                        @endif
                                                        <th>Active</th>
                                                    </tr>
                                                    @foreach($vehicles->where('type', 'Ship') as $ship)
                                                        <tr>
                                                            <td>{{ $ship->classname }}</td>
                                                            <td>{{ $ship->side }}</td>
                                                            <td>{{ $ship->type }}</td>
                                                            @if($insure && $insure->value_associated == 1)
                                                                <td>
                                                                    @if($ship->insure == 1)
                                                                        <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                                    @elseif($ship->insure == 0)
                                                                        <i class="fa fa-close" style="color: #c0392b;"></i>
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            <td>
                                                                @if($ship->active == 1)
                                                                    <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                                @elseif($ship->active == 0)
                                                                    <i class="fa fa-close" style="color: #c0392b;"></i>
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
                        </div>

                        <div class="tab-pane" id="d">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Vos Licences</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped table-responsive">
                                        <tr>
                                            <th>Nom</th>
                                            <th>Status</th>
                                        </tr>
                                        <?php
                                        $suppr = array("\"", "`", "[", "]");
                                        $lineLicenses = str_replace($suppr, "", $player->civ_licenses);
                                        $arrayLicenses = preg_split("/,/", $lineLicenses);
                                        $totarrayLicenses = count($arrayLicenses);
                                        $y = 0;
                                        $n = 0;
                                         for($i = 1; $y < $totarrayLicenses; $i++){
                                        ?>
                                        <tr>
                                            <?php
                                            foreach($licensesName as $license){
                                                if($arrayLicenses[$y] == $license->value_associated){
                                                    $arrayLicenses[$y]= $license->name;
                                                }
                                            }
                                            ?>
                                            <td>{{ $arrayLicenses[$y] }}</td>
                                            <td>
                                                @if($arrayLicenses[$i] == 1)
                                                    <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                @else
                                                    <i class="fa fa-close" style="color: #c0392b;"></i>
                                                @endif
                                            </td>
                                        </tr>

                                        <?php
                                            // Pair
                                            $y = $y + 2;
                                            // Impair
                                            $i = $i + 1;
                                            // normal
                                            $n = $n + 1;

                                            }
                                        ?>

                                    </table>
                                </div>
                            </div>
                        </div>

                        @if($gang)
                        <div class="tab-pane" id="c">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Votre Gang : {{ $gang->name }}</h3>
                                </div>
                                <div class="panel-body">
                                    <h3>Informations :</h3>
                                    <ul>
                                        <li>Nombres de membres maximum : {{ $gang->maxmembers }}</li>
                                        <li>Compte en banque : {{ number_format($gang->bank, 2, ',', ' ') . ' $' }}</li>
                                    </ul>

                                    <h4>Membres</h4>

                                    <table class="table table-responsive group-members" data-group="{{ $gang->id }}" data-groupname="{{ $gang->name }}" data-callback="{{ route('deleteGang') }}">
                                        <tr>
                                            <th>Nom du joueur</th>
                                            <th>Actions</th>
                                        </tr>

                                        <tr>
                                            <form action="{{ route('addPlayerGang') }}" method="post" class="form-horizontal">
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
                                                    @if($member->playerid != $gang->owner)
                                                        <a href="#" data-user="{{ $member->playerid }}" data-csrf="{{ csrf_token() }}" class="group-userlist"><i class="fa fa-close" style="color: #c0392b"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>

                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="tab-pane" id="e">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Demande de remboursement :</h3>
                                    <div class="text-right">
                                        <a href="{{ url('remboursement') }}">
                                            <em class="fa fa-plus"></em>
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-responsive table-striped">
                                        <tr>
                                            <th>#</th>
                                            <th>Montant</th>
                                            <th>Dernière action</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach($refunds as $refund)
                                            <tr>
                                                <td>{{ $refund->id }}</td>
                                                <td>{{ number_format($refund->amount, 2, ',', ' ') . ' $' }}</td>
                                                <td>{{ $refund->updated_at }}</td>
                                                <td><?php
                                                    if($refund->status == 0){
                                                        echo '<span class="label label-warning">En cours de validation</span>';
                                                    }elseif($refund->status == 1){
                                                        echo '<span class="label label-danger">Refusé</span>';
                                                    }elseif($refund->status == 2){
                                                        echo '<span class="label label-success">Effectué</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td><a href="{{ url('remboursement', ['id' => $refund->id]) }}"><i class="fa fa-eye"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('players.modal')

    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
@endsection