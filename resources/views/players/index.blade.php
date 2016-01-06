@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Joueurs
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($players as $player)
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="col-md-4">
                            <div class="col-md-12">
                                <i class="fa fa-server fa-5x"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Nom</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-lg" name="name" type="text" value="{{ $player->name }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Cash</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-lg" type="text" value="{{ number_format($player->cash, 2, ',', ' ') . ' $' }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Banque</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-lg" type="text" value="{{ number_format($player->bankacc, 2, ',', ' ') . ' $' }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Rang Pompier</label>
                                    <div class="col-md-8">

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Rang Policier</label>
                                    <div class="col-md-8">

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection