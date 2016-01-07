@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        {{ $players->name }}
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nom</label>
                                <div class="col-md-8">
                                    <input class="form-control input-lg" name="name" type="text"
                                           value="{{ $players->name }}" disabled>
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
                                    <label class="col-md-4 control-label">Rang Pompier</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control input-lg"
                                               value="{{ $mediclevel }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <br /><br />
                        @endif

                        @if($players->coplevel > 0)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Rang Policier</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control input-lg"
                                               value="{{ $coplevel }}" disabled>
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
        </div>
    </div>
    </div>

@endsection