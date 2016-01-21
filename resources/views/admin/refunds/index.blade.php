@extends('admin.app')

@section('page-info')
    <h3>Remboursements</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="remboursements" class="panel panel-default">
                <div class="panel-heading">Remboursements
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
                                <th>Nom du joueur</th>
                                <th>Montant</th>
                                <th>Dernière action</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($refunds as $refund)
                                <tr>
                                    <td>{{ $refund->id }}</td>
                                    <td>{{ $refund->name }}</td>
                                    <td>{{ number_format($refund->amount, 2, ',', ' ') . ' $' }}</td>
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
                                    <td><a href="{{ route('refund', ['id' => $refund->id]) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $refunds->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection