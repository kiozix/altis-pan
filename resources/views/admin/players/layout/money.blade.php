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