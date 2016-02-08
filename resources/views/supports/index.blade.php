@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Support
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
                        <table class="table table-striped table-responsive">
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
                                <th>Etat</th>
                                <th>Dernière action</th>
                                <th>Action</th>
                                <th><a href="{{ url('support/open') }}"><i class="fa fa-plus"></i></a></th>
                            </tr>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->title }}</td>
                                    <td><?php
                                        if($ticket->etat == 0){
                                            echo '<span class="label label-warning">En cours de résolution</span>';
                                        }elseif($ticket->etat == 2){
                                            echo '<span class="label label-danger">Fermer</span>';
                                        }elseif($ticket->etat == 1){
                                            echo '<span class="label label-success">Ouvert</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>{{ $ticket->updated_at }}</td>
                                    <td>
                                        <a href="{{ url('/support', ['id' => $ticket->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection