@extends('admin.app')

@section('page-info')
    <h3>Casier Judiciaires</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="text-right">
                <a href="{{ action('OffensesController@create') }}" class="btn btn-success"><i class="fa fa-plus">&nbsp;&nbsp; Ajouter une infraction</i></a>
                <br><br>
            </div>
            <div id="streamer" class="panel panel-default">
                <div class="panel-heading">Casier Judiciaires
                    <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                        <em class="fa fa-minus"></em>
                    </a>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        @include('flash')
                        <table class="table table-responsive table-striped">
                            <tr>
                                <th>Arma ID</th>
                                <th>Raison</th>
                                <th>Auteur</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($offenses as $offense)
                                <?php
                                foreach($PlayersName as $player){
                                    if($offense->arma_id == $player->playerid){
                                        $name = $player->name;
                                    }
                                }
                                ?>
                                <tr>
                                    <td><a href="{{ url('admin/player/' . $offense->arma_id) }}">{{ $name }}</a></td>
                                    <td>{{$offense->content}}</td>
                                    <td>{{$offense->author}}</td>
                                    <td>
                                        <a href="{{ action('OffensesController@edit', $offense) }}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                        <span style="display: inline-block">
                                            {!!Form::open(['url' => action("OffensesController@destroy", $offense), 'method' => 'delete']) !!}
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $offenses->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection