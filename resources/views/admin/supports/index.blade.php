@extends('admin.app')

@section('page-info')
    <h3>Supports</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="remboursements" class="panel panel-default">
                <div class="panel-heading">Supports
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
                                <th>Username</th>
                                <th>Titre</th>
                                <th>Dernière action</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>

                            @foreach($supports as $support)

                                <tr>
                                    <?php
                                    foreach($Allusers as $user2){
                                        if($support->id_author == $user2->id){
                                            $name = $user2->name;
                                        }
                                    }
                                    ?>

                                    <td>{{ $support->id }}</td>
                                    <td>{{ $name }}</td>
                                    <td>{{ $support->title }}</td>
                                    <td>{{ $support->updated_at }}</td>
                                    <td>
                                        <?php
                                        if($support->etat == 0){
                                            echo '<span class="label label-warning">En cours de résolution</span>';
                                        }elseif($support->etat == 2){
                                            echo '<span class="label label-danger">Fermer</span>';
                                        }elseif($support->etat == 1){
                                            echo '<span class="label label-success">Ouvert</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><a href="{{ url('admin/support', ['id' => $support->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
                                </tr>
                            @endforeach

                        </table>
                        {!! $supports->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection