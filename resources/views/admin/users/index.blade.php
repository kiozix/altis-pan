@extends('admin.app')

@section('page-info')
    <h3>Utilisateurs</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="panelDemo1" class="panel panel-default">
                <div class="panel-heading">Utilisateurs
                    <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                        <em class="fa fa-minus"></em>
                    </a>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <table class="table table-responsive table-striped">
                            <tr>
                                <th>Nom d'utilisateur</th>
                                <th>Adresse e-mail</th>
                                <th>Grade</th>
                                <th>Arma ID</th>
                                <th>Date d'inscription</th>
                            </tr>
                            @foreach($users as $user1)
                                <tr>
                                    <td><a href="{{ route('user', ['id' => $user1->id]) }}">{{ $user1->name }}</a></td>
                                    <td>{{ $user1->email }}</td>
                                    <td>
                                        <?php
                                        $rang = $user1->admin;

                                        if ($rang == 0) {
                                            echo "<span class='label label-success'>Utilisateur</span>";
                                        } elseif($rang == 1) {
                                            echo "<span class='label label-danger'>Administrateur</span>";
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        @if($user1->arma)
                                            <i class="fa fa-check" style="color: #2cc36b;"></i>
                                        @else

                                            <i class="fa fa-close" style="color: #c0392b;"></i>
                                        @endif
                                    </td>
                                    <td>{{ $user1->created_at }}</td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $users->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection