@extends('admin.app')

@section('page-info')
    <h3>Maisons</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="remboursements" class="panel panel-default">
                <div class="panel-heading">Maisons
                    <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                        <em class="fa fa-minus"></em>
                    </a>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        @include('flash')
                        <table class="table table-responsive table-striped">
                            <tr>
                                <th>#</th>
                                <th>Propriétaire</th>
                                <th>Position</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($houses as $house)
                                <?php
                                foreach($PlayersName as $player){
                                    if($house->pid == $player->playerid){
                                        $name = $player->name;
                                    }
                                }
                                ?>

                                <tr>
                                    <td>{{ $house->id }}</td>
                                    <td>{{ $name }}</td>
                                    <td>{{ $house->pos }}</td>
                                    <td><a href="{{ route('player', ['id' => $house->pid]) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $houses->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection