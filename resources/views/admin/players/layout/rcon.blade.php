@if($Query && $Query != false)
    <?php
        $playersGames = $Query->GetPlayers();
        $i = 0;
        foreach($playersGames as $playerGame){
            if($playerGame['Name'] == $player->name){
                $id = $i;
                $time = $playerGame['TimeF'];
            }
            $i++;
        }

    ?>
    @if(isset($id))
        <div id="rcon" class="panel panel-default">
            <div class="panel-heading">
                <span style="font-weight: bold;font-size: 20px !important;">Rcon</span>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>Temps de la session</td>
                            <td>{{ $time }}</td>
                        </tr>
                    </table>
                    <br>
                    <a href="" class="btn btn-labeled btn-info" id="mp" data-csrf="{{ csrf_token() }}" data-callback="{{ url('admin/rcon/mp') }}" data-id="{{ $id }}">
                        <span class="btn-label"><i class="fa fa-comment-o"></i></span>Message
                    </a>

                    <a href="" class="btn btn-labeled btn-warning" id="kick" data-csrf="{{ csrf_token() }}" data-callback="{{ url('admin/rcon/kick') }}" data-id="{{ $id }}" data-playerid="{{ $player->playerid }}">
                        <span class="btn-label"><i class="fa fa-sign-out"></i></span>Kick
                    </a>
                </div>
            </div>
        </div>
    @endif
@endif
