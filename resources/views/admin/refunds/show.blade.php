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
                                    <button type="submit" class="btn btn-labeled btn-danger" name="status" value="1">
                                        <span class="btn-label"><i class="fa fa-close"></i></span>Refusé
                                    </button>

                                    <button type="submit" class="btn btn-labeled btn-success" name="status" value="2">
                                        <span class="btn-label"><i class="fa fa-check"></i></span>Accepté
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection