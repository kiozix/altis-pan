@if($user_show)
    <div id="user-info" class="panel panel-default">
        <div class="panel-heading">
            <span style="font-weight: bold;font-size: 20px !important;">Compte associé</span>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                <form action="{{ url('admin/user/update/' . $player->playerid) }}" method="post">
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
                        <tr>
                            <td>E-mail</td>
                            <td>{{ $user_show->email }}</td>
                        </tr>
                        <tr>
                            <td>Grade</td>
                            <td>
                                <select name="rank_website" class="form-control">
                                    <option value="0" {{ $user_show->admin == 0 ? 'selected' : '' }} >Utilisateur</option>
                                    <option value="1" {{ $user_show->admin == 1 ? 'selected' : '' }} >Administrateur</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <hr />
                    <div class="text-right">
                        <button type="submit" class="btn btn-labeled btn-success">
                            <span class="btn-label"><i class="fa fa-check"></i></span>Valider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif