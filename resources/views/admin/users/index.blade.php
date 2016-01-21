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
                                <th>Date d'inscription</th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td><a href="{{ route('user', ['id' => $user->id]) }}">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <?php
                                        $rang = $user->admin;

                                        if ($rang == 0) {
                                            echo "<span class='label label-success'>Utilisateur</span>";
                                        } elseif($rang == 1) {
                                            echo "<span class='label label-danger'>Administrateur</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>{{ $user->created_at }}</td>
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