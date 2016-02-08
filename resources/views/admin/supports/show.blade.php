@extends('admin.app')

@section('page-info')
    <h3>{{ $ticket->title }}</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                @include('flash')
            </div>

            <div class="col-md-6">
                <div id="informations" class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">
                            Ticket #{{ $ticket->id }}</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <table class="table table-responsive table-striped">
                                <tr>
                                    <td>Titre</td>
                                    <td>{{ $ticket->title }}</td>
                                </tr>
                                <tr>
                                    <td>Auteur</td>
                                    <?php
                                    foreach($Allusers as $user1){
                                        if($ticket->id_author == $user1->id){
                                            $name = $user1->name;
                                            $id = $user1->id;
                                            $avatar = $user1->avatar;
                                            $arma = $user1->arma;
                                        }
                                    }
                                    ?>
                                    <td><a target="_blank" href="{{ empty($arma) ? route('user', ['id' => $id]) : route('player', ['id' => $arma]) }}">{{ $name }} &nbsp; <i class="fa fa-external-link"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <?php
                                        if($ticket->etat == 0){
                                            echo '<span class="label label-warning">En cours de résolution</span>';
                                        }elseif($ticket->etat == 2){
                                            echo '<span class="label label-danger">Fermer</span>';
                                        }elseif($ticket->etat == 1){
                                            echo '<span class="label label-success">Ouvert</span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <div class="text-right">
                                @if($ticket->etat == 2)
                                    <a href="{{ url('admin/support/open', ['id' => $ticket->id]) }}" class="btn btn-labeled btn-success">
                                        <span class="btn-label"><i class="fa fa-check"></i></span>Réouvrir
                                    </a>
                                @else
                                    <a href="{{ url('admin/support/close', ['id' => $ticket->id]) }}" class="btn btn-labeled btn-danger">
                                        <span class="btn-label"><i class="fa fa-close"></i></span>Fermer
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php
                        if($ticket->etat == 0){
                            echo '<div class="pull-right label label-warning">En cours de résolution</div>';
                        }elseif($ticket->etat == 2){
                            echo '<div class="pull-right label label-danger">Fermer</div>';
                        }elseif($ticket->etat == 1){
                            echo '<div class="pull-right label label-success">Ouvert</div>';
                        }
                        ?>
                        <div class="panel-title">{{ $ticket->title }}</div>
                    </div>

                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 180px;"><div data-height="180" data-scrollable="" class="list-group" style="overflow: hidden; width: auto; height: 180px;">

                            <a href="#" class="list-group-item">
                                <div class="media-box">
                                    <div class="pull-left">
                                        <img src="{{ asset('/img/avatars/' . $avatar . '.jpg') }}" alt="Image" class="media-box-object img-circle thumb32">
                                    </div>
                                    <div class="media-box-body clearfix">
                                        <small class="pull-right">{{ $ticket->created_at }}</small>
                                        <strong class="media-box-heading text-primary">
                                            <span class="circle circle-info circle-lg text-left"></span>{{ $name }}</strong>
                                        <p class="mb-sm">
                                            <small>{{ $ticket->content }}</small>
                                        </p>
                                    </div>
                                </div>
                            </a>

                            @foreach($responses as $response)

                                <?php
                                foreach($Allusers as $user1){
                                    if($response->id_author == $user1->id){
                                        $name = $user1->name;
                                        $id = $user1->id;
                                        $avatar = $user1->avatar;
                                    }
                                }
                                ?>

                                <a href="#" class="list-group-item">
                                    <div class="media-box">
                                        <div class="pull-left">
                                            @if($avatar)
                                                <img src="{{ asset('/img/avatars/' . $response->id_author . '.jpg') }}" alt="Image" class="media-box-object img-circle thumb32">
                                            @else
                                                <img src="{{ asset('/img/user_default.png') }}" alt="Image" class="media-box-object img-circle thumb32">
                                            @endif
                                        </div>
                                        <div class="media-box-body clearfix">
                                            <small class="pull-right">{{ $response->created_at }}</small>
                                            <strong class="media-box-heading text-primary">
                                                <span class="circle {{ $response->id_author == $ticket->id_author ? 'circle-info' : 'circle-danger'}} circle-lg text-left"></span>{{ $name }}</strong>
                                            <p class="mb-sm">
                                                <small>{{ $response->content }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>

                            @endforeach

                        </div>
                        <div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 104.18px; background: rgb(0, 0, 0);"></div>
                        <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
                    </div>

                    @if($ticket->etat != 2)
                        <div class="panel-footer clearfix">
                            <form action="{{ url('admin/support/reply', ['id' => $ticket->id]) }}" method="post">
                            <div class="input-group">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="text" placeholder="Message..." class="form-control input-sm" name="content" autocomplete="off">
                                <span class="input-group-btn">
                                   <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-arrow-right"></i></button>
                                </span>
                            </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection