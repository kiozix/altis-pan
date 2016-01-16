@extends('admin.app')

@section('page-info')
    <h3>PayPal</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="panelDemo1" class="panel panel-default">
                <div class="panel-heading">PayPal
                    <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                        <em class="fa fa-minus"></em>
                    </a>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <table class="table table-responsive table-striped">
                            <tr>
                                <th>Nom de l'objet boutique</th>
                                <th>Nom de l'utilisateur</th>
                                <th>Prix</th>
                                <th>Transaction id</th>
                            </tr>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $log->id_shop }}</td>
                                    <td>{{ $log->id_user }}</td>
                                    <td>{{ $log->price }} €</td>
                                    <td>{{ $log->id_transaction }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection