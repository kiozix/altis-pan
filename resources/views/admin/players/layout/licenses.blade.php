@if($player->civ_licenses)
    @if($player->civ_licenses != '"[]"')
        @if($player->civ_licenses != '[]')
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
        @endif
    @endif
@endif

@if($player->coplevel >= 1 && $player->cop_licenses)
    @if($player->cop_licenses != '"[]"')
        @if($player->cop_licenses != '[]')
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
    @endif
@endif

@if($player->mediclevel >= 1 && $player->med_licenses)
    @if($player->med_licenses != '"[]"')
        @if($player->med_licenses != '[]')
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
    @endif
@endif