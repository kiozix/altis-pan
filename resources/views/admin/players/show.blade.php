@extends('admin.app')

@section('page-info')
    <h3>{{ $player->name }}</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div id="joueur-info" class="panel panel-default">
                    <div class="panel-heading">
                        <span style="font-weight: bold;font-size: 20px !important;">Joueurs</span>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            @include('flash')
                            <form action="{{ url('admin/player/'. $player->playerid) }}" method="post">
                                <table class="table table-responsive table-striped">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="playerid" value="{{ $player->playerid }}">
                                    <tr>
                                        <td>Nom du joueur</td>
                                        <td>{{ $player->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Portes-monnaie</td>
                                        <td>
                                            <?php
                                                $money = $player->cash;
                                                if ($money < 150000) {
                                                    $argent = number_format($money, 2, ',', ' ');
                                                    echo "<span class='label label-success'>". $argent ." $</span>";
                                                } elseif (200000 > $money) {
                                                    $argent = number_format($money, 2, ',', ' ');
                                                    echo "<span class='label label-warning'>". $argent ." $</span>";
                                                } else {
                                                    $argent = number_format($money, 2, ',', ' ');
                                                    echo "<span class='label label-danger'>". $argent ." $</span>";
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Compte Banque</td>
                                        <td>
                                            <?php
                                            $money = $player->bankacc;
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
                                    @if($gang)
                                    <tr>
                                        <td>Gang</td>
                                        <td><a href="{{ route('gang', ['id' => $gang->id ]) }}">{{ $gang->name }}</a></td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Grade Admin</td>
                                        <td>
                                            <select name="admin" class="form-control"> {{ $player->adminlevel == 0 ? 'selected' : '' }}
                                                @foreach($ranks_admin as  $admin)
                                                    <option value="{{ $admin->value_associated }}" {{ $player->adminlevel == $admin->value_associated ? 'selected' : '' }}>{{ $admin->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Grade Policier</td>
                                        <td>
                                            <select name="policier" class="form-control">
                                                <option value="0"{{ $player->coplevel == 0 ? 'selected' : '' }}>Non admis</option>
                                                @foreach($ranks_cop as $cop)
                                                    <option value="{{ $cop->value_associated }}" {{ $player->coplevel == $cop->value_associated ? 'selected' : '' }}>{{ $cop->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Grade Pompier</td>
                                        <td>
                                            <select name="medic" class="form-control">
                                                <option value="0"{{ $player->mediclevel == 0 ? 'selected' : '' }}>Non admis</option>
                                                @foreach($ranks_medic as $medic)
                                                    <option value="{{ $medic->value_associated }}" {{ $player->coplevel == $medic->value_associated ? 'selected' : '' }}>{{ $medic->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Grade Donateur</td>
                                        <td>
                                            <div class="col-md-3">
                                                <select name="donator" class="form-control">
                                                    <option value="0"{{ $player->donatorlvl == 0 ? 'selected' : '' }}>0</option>
                                                    <option value="1"{{ $player->donatorlvl == 1 ? 'selected' : '' }}>1</option>
                                                    <option value="2"{{ $player->donatorlvl == 2 ? 'selected' : '' }}>2</option>
                                                    <option value="3"{{ $player->donatorlvl == 3 ? 'selected' : '' }}>3</option>
                                                    <option value="4"{{ $player->donatorlvl == 4 ? 'selected' : '' }}>4</option>
                                                    <option value="5"{{ $player->donatorlvl == 5 ? 'selected' : '' }}>5</option>
                                                </select>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="number" name="duredon" placeholder="Nombre de jours" class="form-control" value="{{ $player->duredon }}">
                                            </div>

                                        </td>
                                    </tr>
                                </table>

                                <hr />

                                <label>Inventaire civil</label>
                                <pre>{{ $player->civ_gear }}</pre>

                                <hr />

                                <div class="text-right">
                                    <button type="submit" class="btn btn-labeled btn-success">
                                    <span class="btn-label"><i class="fa fa-check"></i></span>Valider
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if($user_show)
                    <div id="account" class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-weight: bold;font-size: 20px !important;">Compte associé</span>
                        </div>
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <form action="{{ url('admin/user/update/' . $player->playerid) }}" method="post">
                                    <table class="table table-responsive table-striped">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $user_show->id }}">
                                        <tr>
                                            <td>Nom d'utilisateur</td>
                                            <td>{{ $user_show->name }}</td>
                                        </tr>
                                        @if($user_show->firstname)
                                            <tr>
                                                <td>Prénom</td>
                                                <td>{{ $user_show->firstname }}</td>
                                            </tr>
                                        @endif
                                        @if($user_show->lastname)
                                            <tr>
                                                <td>Nom de famille</td>
                                                <td>{{ $user_show->lastname }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>E-mail</td>
                                            <td>{{ $user_show->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Grade</td>
                                            <td>
                                                <select name="rank_website" class="form-control">
                                                    <option value="0" {{ $user_show->admin == 0 ? 'selected' : '' }} >Utilisateur</option>
                                                    <option value="1" {{ $user_show->admin == 1 ? 'selected' : '' }} >Administrateur</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                    <hr />
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-labeled btn-success">
                                            <span class="btn-label"><i class="fa fa-check"></i></span>Valider
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                @if($offenses)
                    <div id="offenses" class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-weight: bold;font-size: 20px !important;">Casier judiciare</span>
                        </div>
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">
                                    <table class="table table-responsive table-striped">
                                        <tr>
                                            <th>Auteur</th>
                                            <th>Infraction</th>
                                            <th>Sanction</th>
                                        </tr>
                                        @foreach($offenses as $offense)
                                        <tr>
                                            <td>{{ $offense->author }}</td>
                                            <td>{{ $offense->content }}</td>
                                            <td>{{ $offense->sanction }}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <div id="vehicules" class="panel panel-default">
                    <div class="panel-heading">
                        <span style="font-weight: bold;font-size: 20px !important;">Véhicules</span>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div id="accordion" role="tablist" aria-multiselectable="true" class="panel-group">
                                <div class="panel panel-default">
                                    <div id="headingOne" role="tab" class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="">Terrestre</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" role="tabpanel" aria-labelledby="headingOne" class="panel-collapse collapse in" aria-expanded="true">
                                        <div class="panel-body">
                                            <table class="table table-striped table-responsive">
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Emplacement du garage</th>
                                                    <th>Type</th>
                                                    @if($insure && $insure->value_associated == 1)
                                                        <th>Assurance</th>
                                                    @endif
                                                    <th>Active</th>
                                                    <th>Action</th>
                                                </tr>
                                                @foreach($vehicles_cars as $vehicle_car)
                                                    <tr>
                                                        <td>{{ $vehicle_car->classname }}</td>
                                                        <td>{{ $vehicle_car->side }}</td>
                                                        <td>{{ $vehicle_car->type }}</td>
                                                        @if($insure && $insure->value_associated == 1)
                                                            <td>
                                                                @if($vehicle_car->insure == 1)
                                                                    <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                                @elseif($vehicle_car->insure == 0)
                                                                    <i class="fa fa-close" style="color: #c0392b;"></i>
                                                                @endif
                                                            </td>
                                                        @endif
                                                        <td>
                                                            @if($vehicle_car->active == 1)
                                                                <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                            @elseif($vehicle_car->active == 0)
                                                                <i class="fa fa-close" style="color: #c0392b;"></i>
                                                            @endif
                                                        </td>
                                                        <td><a href="{{ url('admin/vehicule', ['id' => $vehicle_car->id]) }}"><i class="fa fa-exchange" style="color: #4aa3df;"></i></a></td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div id="headingTwo" role="tab" class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="collapsed">Aérien</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
                                            <table class="table table-striped table-responsive">
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Emplacement du garage</th>
                                                    <th>Type</th>
                                                    @if($insure && $insure->value_associated == 1)
                                                        <th>Assurance</th>
                                                    @endif
                                                    <th>Active</th>
                                                    <th>Action</th>
                                                </tr>
                                                @foreach($vehicles_airs as $vehicle_air)
                                                    <tr>
                                                        <td>{{ $vehicle_air->classname }}</td>
                                                        <td>{{ $vehicle_air->side }}</td>
                                                        <td>{{ $vehicle_air->type }}</td>
                                                        @if($insure && $insure->value_associated == 1)
                                                            <td>
                                                                @if($vehicle_air->insure == 1)
                                                                    <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                                @elseif($vehicle_air->insure == 0)
                                                                    <i class="fa fa-close" style="color: #c0392b;"></i>
                                                                @endif
                                                            </td>
                                                        @endif
                                                        <td>
                                                            @if($vehicle_air->active == 1)
                                                                <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                            @elseif($vehicle_air->active == 0)
                                                                <i class="fa fa-close" style="color: #c0392b;"></i>
                                                            @endif
                                                        </td>
                                                        <td><a href="{{ url('admin/vehicule', ['id' => $vehicle_air->id]) }}"><i class="fa fa-exchange" style="color: #4aa3df;"></i></a></td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div id="headingThree" role="tab" class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="collapsed">Aquatique</a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" role="tabpanel" aria-labelledby="headingThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
                                            <table class="table table-striped table-responsive">
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Emplacement du garage</th>
                                                    <th>Type</th>
                                                    @if($insure && $insure->value_associated == 1)
                                                        <th>Assurance</th>
                                                    @endif
                                                    <th>Active</th>
                                                    <th>Action</th>
                                                </tr>
                                                @foreach($vehicles_ships as $vehicle_ship)
                                                    <tr>
                                                        <td>{{ $vehicle_ship->classname }}</td>
                                                        <td>{{ $vehicle_ship->side }}</td>
                                                        <td>{{ $vehicle_ship->type }}</td>
                                                        @if($insure && $insure->value_associated == 1)
                                                            <td>
                                                                @if($vehicle_ship->insure == 1)
                                                                    <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                                @elseif($vehicle_ship->insure == 0)
                                                                    <i class="fa fa-close" style="color: #c0392b;"></i>
                                                                @endif
                                                            </td>
                                                        @endif
                                                        <td>
                                                            @if($vehicle_ship->active == 1)
                                                                <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                            @elseif($vehicle_ship->active == 0)
                                                                <i class="fa fa-close" style="color: #c0392b;"></i>
                                                            @endif
                                                        </td>
                                                        <td><a href="{{ url('admin/vehicule', ['id' => $vehicle_ship->id]) }}"><i class="fa fa-exchange" style="color: #4aa3df;"></i></a></td>
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

            <div class="col-md-6">
                <div id="money-give" class="panel panel-default">
                    <div class="panel-heading">
                        <span style="font-weight: bold;font-size: 20px !important;">Ajouter de l'argent</span>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <form action="{{url('admin/player/'. $player->playerid)}}" method="post">
                                <div class="input-group">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="number" placeholder="Montant à ajouter" class="form-control" name="give" autocomplete="off">
                                    <div class="input-group-addon">$</div>
                                </div>

                                <br>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-labeled btn-success">
                                        <span class="btn-label"><i class="fa fa-check"></i></span>Ajouter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="money-take" class="panel panel-default">
                    <div class="panel-heading">
                        <span style="font-weight: bold;font-size: 20px !important;">Enlever de l'argent</span>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <form action="{{url('admin/player/'. $player->playerid)}}" method="post">
                                <div class="input-group">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="number" placeholder="Montant à ajouter" class="form-control" name="take" autocomplete="off">
                                    <div class="input-group-addon">$</div>
                                </div>

                                <br>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-labeled btn-danger">
                                        <span class="btn-label"><i class="fa fa-check"></i></span>Enlever
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="licenses-civ" class="panel panel-default">
                    <div class="panel-heading">
                        <span style="font-weight: bold;font-size: 20px !important;">Licences civiles</span>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <table class="table table-striped table-responsive licenses" data-callback="{{ route('setLicenses') }}">
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
                                ?>
                                @for($i = 1; $y < $totarrayLicenses; $i++)
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
                                                <a href="#" data-group="civ" data-csrf="{{ csrf_token() }}" data-user="{{ $player->playerid }}" data-type="{{ $arrayLicenses[$i] }}" data-id="{{ $n }}" class="licenses-list"><i class="fa fa-check" style="color: #2cc36b;"></i></a>
                                            @else
                                                <a href="#" data-group="civ" data-csrf="{{ csrf_token() }}" data-user="{{ $player->playerid }}" data-type="{{ $arrayLicenses[$i] }}" data-id="{{ $n }}" class="licenses-list"><i class="fa fa-close" style="color: #c0392b;"></i></a>
                                            @endif
                                        </td>
                                    </tr>

                                    <?php
                                    $y = $y + 2;
                                    $i = $i + 1;
                                    $n = $n + 1;
                                    ?>
                                @endfor
                            </table>

                        </div>
                    </div>
                </div>

                @if($player->coplevel >= 1)
                <div id="licenses-cop" class="panel panel-default">
                    <div class="panel-heading">
                        <span style="font-weight: bold;font-size: 20px !important;">Licences policier</span>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <table class="table table-striped table-responsive licenses" data-callback="{{ route('setLicenses') }}">
                                <tr>
                                    <th>Nom</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                $suppr = array("\"", "`", "[", "]");
                                $lineLicenses = str_replace($suppr, "", $player->cop_licenses);
                                $arrayLicenses = preg_split("/,/", $lineLicenses);
                                $totarrayLicenses = count($arrayLicenses);
                                $y = 0;
                                $n = 0;
                                ?>
                                @for($i = 1; $y < $totarrayLicenses; $i++)
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
                                                <a href="#" data-group="cop" data-csrf="{{ csrf_token() }}" data-user="{{ $player->playerid }}" data-type="{{ $arrayLicenses[$i] }}" data-id="{{ $n }}" class="licenses-list"><i class="fa fa-check" style="color: #2cc36b;"></i></a>
                                            @else
                                                <a href="#" data-group="cop" data-csrf="{{ csrf_token() }}" data-user="{{ $player->playerid }}" data-type="{{ $arrayLicenses[$i] }}" data-id="{{ $n }}" class="licenses-list"><i class="fa fa-close" style="color: #c0392b;"></i></a>
                                            @endif
                                        </td>
                                    </tr>

                                    <?php
                                    $y = $y + 2;
                                    $i = $i + 1;
                                    $n = $n + 1;
                                    ?>
                                @endfor
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                @if($player->mediclevel >= 1)
                <div id="licenses-med" class="panel panel-default">
                    <div class="panel-heading">
                        <span style="font-weight: bold;font-size: 20px !important;">Licences pompier</span>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <table class="table table-striped table-responsive licenses" data-callback="{{ route('setLicenses') }}">
                                <tr>
                                    <th>Nom</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                $suppr = array("\"", "`", "[", "]");
                                $lineLicenses = str_replace($suppr, "", $player->med_licenses);
                                $arrayLicenses = preg_split("/,/", $lineLicenses);
                                $totarrayLicenses = count($arrayLicenses);
                                $y = 0;
                                $n = 0;
                                ?>
                                @for($i = 1; $y < $totarrayLicenses; $i++)
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
                                                <a href="#" data-group="med" data-csrf="{{ csrf_token() }}" data-user="{{ $player->playerid }}" data-type="{{ $arrayLicenses[$i] }}" data-id="{{ $n }}" class="licenses-list"><i class="fa fa-check" style="color: #2cc36b;"></i></a>
                                            @else
                                                <a href="#" data-group="med" data-csrf="{{ csrf_token() }}" data-user="{{ $player->playerid }}" data-type="{{ $arrayLicenses[$i] }}" data-id="{{ $n }}" class="licenses-list"><i class="fa fa-close" style="color: #c0392b;"></i></a>
                                            @endif
                                        </td>
                                    </tr>

                                    <?php
                                    $y = $y + 2;
                                    $i = $i + 1;
                                    $n = $n + 1;
                                    ?>
                                @endfor
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
@endsection