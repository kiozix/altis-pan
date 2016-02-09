@extends('admin.app')

@section('page-info')
    <h3>Rembousement de {{ $refund->name }}</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                @include('flash')
            </div>

            <div class="col-md-6">
                <div id="informations" class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">Informations</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <table class="table table-responsive table-striped">
                                <tr>
                                    <td>Nom</td>
                                    <td><a target="_blank" href="{{ route('player', ['id' => $refund->playerid]) }}">{{ $refund->name }} &nbsp;&nbsp; <i class="fa fa-external-link"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Montant</td>
                                    <td>{{ number_format($refund->amount, 2, ',', ' ') . ' $' }}</td>
                                </tr>
                                <td>{{ $refund->updated_at }}</td>
                                <td><?php
                                    if($refund->status == 0){
                                        echo '<span class="label label-warning">En cours de validation</span>';
                                    }elseif($refund->status == 1){
                                        echo '<span class="label label-danger">Refusé</span>';
                                    }elseif($refund->status == 2){
                                        echo '<span class="label label-success">Effectué</span>';
                                    }
                                    ?>
                                </td>
                            </table>
                            <br>
                            <hr>
                            <h3>Description :</h3>

                            <div id="content">
                                {!! $refund->content !!}
                            </div>

                            @if($refund->status == 0)

                            <hr>
                            <form action="{{ route('refund', ['id' => $refund->id]) }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="text-right">
                                    @if($ticket)
                                        @if($ticket->etat == 2)
                                            <button type="submit" class="btn btn-labeled btn-danger" name="status" value="1">
                                                <span class="btn-label"><i class="fa fa-close"></i></span>Refusé
                                            </button>

                                            <button type="submit" class="btn btn-labeled btn-success" name="status" value="2">
                                                <span class="btn-label"><i class="fa fa-check"></i></span>Accepté
                                            </button>
                                        @endif
                                    @else
                                        <button type="submit" class="btn btn-labeled btn-danger" name="status" value="1">
                                            <span class="btn-label"><i class="fa fa-close"></i></span>Refusé
                                        </button>

                                        <button type="submit" class="btn btn-labeled btn-success" name="status" value="2">
                                            <span class="btn-label"><i class="fa fa-check"></i></span>Accepté
                                        </button>
                                    @endif

                                    @if($ticket)
                                        @if($ticket->etat == 2)
                                            <a href="{{ url('admin/remboursement/reopen', ['id' => $ticket->id]) }}" class="btn btn-labeled btn-info">
                                                <span class="btn-label"><i class="fa fa-tag"></i></span>Réouvrir
                                            </a>
                                        @else
                                            <a href="{{ url('admin/remboursement/close', ['id' => $ticket->id]) }}" class="btn btn-labeled btn-danger">
                                                <span class="btn-label"><i class="fa fa-tag"></i></span>Fermer
                                            </a>
                                        @endif
                                    @else
                                        <button type="button" onclick="ticket('ticket');" class="btn btn-labeled btn-info">
                                            <span class="btn-label"><i class="fa fa-tag"></i></span>Ouvrit un ticket
                                        </button>
                                    @endif

                                </div>
                            </form>
                            @endif

                            @if($ticket)
                            @else
                                <div id="ticket" style="display:none;">
                                    <hr>
                                    <form action="{{ url('admin/remboursement/open', ['id' => $refund->id]) }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <textarea placeholder="Message..." rows="5" class="form-control" name="content"></textarea>
                                        <br>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-labeled btn-success">
                                                <span class="btn-label"><i class="fa fa-check"></i></span>Envoyer
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if($ticket)
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
                            }elseif($ticket->etat == 3){
                                echo '<div class="pull-right label label-info">En attente d\'une réponse du joueur</div>';
                            }
                            ?>
                            <div class="panel-title">{{ $ticket->title }}</div>
                        </div>

                        <div data-height="180" data-scrollable="" class="list-group">
                                <?php
                                foreach($Allusers as $user1){
                                    if($ticket->admin_refunds == $user1->id){
                                        $name = $user1->name;
                                        $id = $user1->id;
                                        $arma = $user1->arma;
                                    }
                                }
                                ?>
                                <a href="#" class="list-group-item">
                                    <div class="media-box">
                                        <div class="pull-left">
                                            <img src="{{ asset('/img/avatars/' . $ticket->admin_refunds . '.jpg') }}" alt="Image" class="media-box-object img-circle thumb32">
                                        </div>
                                        <div class="media-box-body clearfix">
                                            <small class="pull-right">{{ $ticket->created_at }}</small>
                                            <strong class="media-box-heading text-danger">
                                                <span class="circle circle-danger circle-lg text-left"></span>{{ $name }}</strong>
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

                            @if($ticket->etat != 2)
                                <div class="panel-footer clearfix">
                                    <form action="{{ url('admin/support/reply', ['id' => $ticket->id]) }}" method="post">
                                        <div class="input-group">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="text" placeholder="Message..." class="form-control input-sm" name="content" autocomplete="off">
                                            <span class="input-group-btn">
                                               <button type="submit" class="btn btn-default btn-sm" name="refunds" value="1"><i class="fa fa-arrow-right"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script type="text/javascript">
        function ticket(ticket) {
            var div = document.getElementById(ticket);
            if(div.style.display=="none") {
                div.style.display = "block";
            }else {
                div.style.display = "none";
            }
        }
    </script>
@endsection