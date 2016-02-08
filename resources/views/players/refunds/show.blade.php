@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Remboursement #{{ $refund->id }}
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <table class="table table-responsive table-striped">
                    <tr>
                        <td>Etat</td>
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
                    </tr>
                    <tr>
                        <td>Montant</td>
                        <td>{{ number_format($refund->amount, 2, ',', ' ') . ' $' }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{!! $refund->content !!}</td>
                    </tr>
                </table>
                @if($ticket)
                    <hr>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                {{ $ticket->title }}
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div class="thread">
                                <?php
                                foreach($users as $user){
                                    if($ticket->admin_refunds == $user->id){
                                        $name = $user->name;
                                        $avatar = $user->avatar;
                                    }
                                }
                                ?>
                                <div class="col-md-2">
                                    @if($avatar)
                                        <img src="{{ asset('/img/avatars/' . $avatar . '.jpg') }}" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                                    @else
                                        <img src="{{ asset('/img/user_default.png') }}" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                                    @endif

                                    <span class="username">
                                        <br> <span class="label label-danger">{{ $name }}</span>
                                    </span>
                                </div>
                                <div class="col-md-9">
                                    <div class="message">
                                        {{ $ticket->content }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>

                            @foreach($responses as $response)
                                <div class="thread">
                                    <?php
                                    foreach($users as $user){
                                        if($response->id_author == $user->id){
                                            $name = $user->name;
                                            $avatar = $user->avatar;
                                        }
                                    }
                                    ?>
                                    <div class="col-md-2">
                                        @if($avatar)
                                            <img src="{{ asset('/img/avatars/' . $response->id_author . '.jpg') }}" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                                        @else
                                            <img src="{{ asset('/img/user_default.png') }}" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                                        @endif

                                        <span class="username label {{ $response->id_author == $ticket->id_author ? 'label-info' : 'label-danger'}}">
                                        <br> {{ $name }}
                                        </span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="message">
                                            {{ $response->content }}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                            @endforeach

                            @if($ticket->etat != 2)
                                <div class="thread">
                                    <div class="col-md-2">
                                        @if(Auth::user()->avatar)
                                            <img src="{{ url(Auth::user()->avatar) }}" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                                        @else
                                            <img src="{{ asset('/img/user_default.png') }}" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                                        @endif

                                        <span class="username">
                                            <br> <span class="label label-info">{{ Auth::user()->name }}</span>
                                        </span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="message">
                                            <form action="{{ url('remboursement/reply', ['id' => $ticket->id]) }}" method="post">
                                                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                                @include('flash')
                                                <textarea name="content" id="" rows="5" class="form-control" placeholder="Ecrivez votres réponse"></textarea> <br>
                                                <button type="submit" class="btn btn-success">Répondre</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="thread">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">
                                            <i class="fa fa-close"></i>&nbsp;&nbsp;Le ticket est fermer !
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
@endsection