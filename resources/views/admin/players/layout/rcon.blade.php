@if($Query && $Query != false)
    <?php
        $playersGame = $Query->GetPlayers();
        foreach($playersGame as $playerGame){
            if($playerGame['Name'] == $player->name){
                $id = $playerGame['Id'];
                $time = $playerGame['TimeF'];
            }
        }

        if(empty($id)){
            $id = null;
        }
    ?>
    @if($id && $id != null)
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

                    <a href="" class="btn btn-labeled btn-warning" id="kick" data-csrf="{{ csrf_token() }}" data-callback="{{ url('admin/rcon/kick') }}" data-id="{{ $id }}">
                        <span class="btn-label"><i class="fa fa-sign-out"></i></span>Kick
                    </a>

                    <a href="" class="btn btn-labeled btn-danger" id="ban" data-csrf="{{ csrf_token() }}" data-callback="{{ url('admin/rcon/ban') }}" data-id="{{ $player->playerid }}">
                        <span class="btn-label"><i class="fa fa-user-times"></i></span>Bannir
                    </a>
                </div>
            </div>
        </div>
    @endif
@endif
