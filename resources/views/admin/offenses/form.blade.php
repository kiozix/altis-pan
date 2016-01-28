@include('flash')

{!! Form::model($offenses, ['class' =>'form-horizontal', 'url' => action("OffensesController@$action", $offenses), 'method' => $action == 'store' ? 'Post' : 'Put']) !!}

<div class="form-group">
    <label class="col-md-4 control-label">Nom du joueur</label>

    <div class="col-md-6">
        <select name="arma_id" class="form-control player-gang">
            @foreach($allPlayers as $player)
                <option value="{{ $player->playerid }}">{{ $player->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Raison</label>

    <div class="col-md-6">
        {!! Form::text('content', null, ['class' => 'form-control', 'placeholder' => 'FreeKill, Troll, Insultes']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Sanction</label>

    <div class="col-md-6">
        {!! Form::text('sanction', null, ['class' => 'form-control', 'placeholder' => 'BAN | 24H']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <input type="hidden" name="author" value="{{ $user->name }}">
        <input type="hidden" name="author_id" value="{{ $user->id }}">
        <button type="submit" class="btn btn-primary">
            Sauvegarder
        </button>
    </div>
</div>

{!! Form::close() !!}