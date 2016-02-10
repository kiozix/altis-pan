@if($user_show)
    <div id="user-info" class="panel panel-default">
        <div class="panel-heading">
            <span style="font-weight: bold;font-size: 20px !important;">Compte associé</span>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
            <table class="table table-responsive table-striped">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ $user_show->id }}">
                <tr>
                    <td>Nom d'utilisateur</td>
                    <td>{{ $user_show->name }}</td>
                </tr>
                @if($user_show->firstname)
                    <tr>
                        <td>Prénom</td>
                        <td>{{ $user_show->firstname }}</td>
                    </tr>
                @endif
                @if($user_show->lastname)
                    <tr>
                        <td>Nom de famille</td>
                        <td>{{ $user_show->lastname }}</td>
                    </tr>
                @endif
                @if($user->rank != 1)
                    <tr>
                        <td>E-mail</td>
                        <td>{{ $user_show->email }}</td>
                    </tr>
                @endif
                <tr>
                    <td>Grade</td>
                    <td>
                        <?php
                            if($user_show->rank == 0) {
                                echo 'Utilisateur';
                            }elseif($user_show->rank == 1) {
                                echo 'Support';
                            }elseif($user_show->rank == 2) {
                                echo 'Modérateur';
                            }elseif($user_show->rank == 3) {
                                echo 'Administrateur';
                            }
                        ?>
                    </td>
                </tr>
            </table>
                <hr />
                <div class="text-right">
                    <a href="{{ route('user', ['id' => $user_show->id]) }}" class="btn btn-labeled btn-info" target="_blank">
                        <span class="btn-label"><i class="fa fa-eye"></i></span>Voir
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif