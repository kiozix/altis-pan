@if($user->rank != 1)
    <div id="money-give" class="panel panel-default">
        <div class="panel-heading">
            <span style="font-weight: bold;font-size: 20px !important;">Argent</span>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                <form action="{{url('admin/player/'. $player->playerid)}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <select name="account" class="form-control">
                        <option value="1">Compte en banque</option>
                        <option value="2">Porte-monnaie</option>
                    </select>
                    <br>
                    <div class="input-group">
                        <input type="number" placeholder="Montant" class="form-control" name="money" autocomplete="off">
                        <div class="input-group-addon">$</div>
                    </div>
                    <br>
                    <div class="text-right">
                        <button type="submit" class="btn btn-labeled btn-danger" name="take" value="1">
                            <span class="btn-label"><i class="fa fa-check"></i></span>Enlever
                        </button>
                        @if($user->rank == 3)
                            <button type="submit" class="btn btn-labeled btn-success" name="give" value="1">
                                <span class="btn-label"><i class="fa fa-check"></i></span>Ajouter
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif