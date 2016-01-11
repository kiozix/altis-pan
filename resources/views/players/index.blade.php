@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        {!! $players->name !!}
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="tabbable ">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#a" data-toggle="tab">Informations</a></li>
                        <li><a href="#b" data-toggle="tab">Véhicules</a></li>
                        <li><a href="#c" data-toggle="tab">Gangs</a></li>
                        <li><a href="#d" data-toggle="tab">Temporaire</a></li>
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
                                                <input class="form-control input-lg" name="name" type="text"
                                                       value="{!! $players->name !!}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <br/><br/>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Rang</label>
                                            <div class="col-md-8">
                                                <input class="form-control input-lg" name="name" type="text"
                                                       value="{!! $rank !!}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <br/><br/>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Cash</label>
                                            <div class="col-md-8">
                                                <input class="form-control input-lg" type="text"
                                                       value="{{ number_format($players->cash, 2, ',', ' ') . ' $' }}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <br/><br/>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Banque</label>
                                            <div class="col-md-8">
                                                <input class="form-control input-lg" type="text"
                                                       value="{{ number_format($players->bankacc, 2, ',', ' ') . ' $' }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <br /><br />
                                    @if($players->mediclevel > 0)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Rang Pompier <a type="button" data-toggle="modal" data-target="#pompier">(?)</a></label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control input-lg"
                                                           value="{!! $mediclevel !!}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <br /><br />
                                    @endif

                                    @if($players->coplevel > 0)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Rang Policier <a type="button" data-toggle="modal" data-target="#police">(?)</a></label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control input-lg"
                                                           value="{!! $coplevel !!}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <br /><br />
                                    @endif


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Rang donateur</label>
                                            <div class="col-md-8">
                                                @if($players->donatorlvl > 0)
                                                    <span class="donatorlvl"><i class="fa fa-check"></i> Vous êtes donateur</span>
                                                @else
                                                    <span class="donatorlvl"><i class="fa fa-close"></i> Vous n'êtes pas donateur</span>
                                                    <br>
                                                    <a href="">Le devenir ?</a>
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
                                    <table class="table table-striped table-responsive">
                                        <tr>
                                            <th>Nom</th>
                                            <th>Coté</th>
                                            <th>Type</th>
                                            <th>Active</th>
                                        </tr>
                                        @foreach($vehicles as $vehicle)
                                            <tr>
                                                <td>{!! $vehicle->classname !!}</td>
                                                <td>{!! $vehicle->side !!}</td>
                                                <td>{!! $vehicle->type !!}</td>
                                                <td>
                                                    @if($vehicle->active == 1)
                                                        <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                    @elseif($vehicle->active == 0)
                                                        <i class="fa fa-close" style="color: #c0392b;"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="c">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Votre Gang : {!! $gang->name !!}</h3>
                                </div>
                                <div class="panel-body">
                                    <h3>Information :</h3>
                                    <ul>
                                        <li>Nombres de membres maximum : {!! $gang->maxmembers !!}</li>
                                        <li>Compte en banque : {{ number_format($gang->bank, 2, ',', ' ') . ' $' }}</li>
                                    </ul>

                                    <h4>Membres</h4>

                                    <pre>{!! $gang->members !!}</pre>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="d">
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
                                                <div class="panel-body">
                                                    faire liste
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingTwo">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Aquatique
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                <div class="panel-body">
                                                   faire liste
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingThree">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        Aérien
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                <div class="panel-body">
                                                    faire liste
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('players.modal')

@endsection