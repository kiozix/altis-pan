@extends('admin.app')

@section('page-info')
    <h3>{{ $user_show->name }}</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div id="informations" class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">Informations</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            @include('flash')
                            <form action="{{ route('user', ['id' => $user_show->id]) }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <table class="table table-responsive table-responsive">
                                    <tr>
                                        <td>Nom d'utilisateur</td>
                                        <td><input type="text" name="username" value="{{ $user_show->name }}" class="form-control" {{ $user->rank == 3 ? '' : 'disabled' }}></td>
                                    </tr>
                                    <tr>
                                        <td>Date d'inscription</td>
                                        <td>{{ $user_show->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <td>Prénom</td>
                                        <td><input type="text" name="firstname" value="{{ $user_show->firstname }}" class="form-control" {{ $user->rank == 3 ? '' : 'disabled' }}></td>
                                    </tr>
                                    <tr>
                                        <td>Nom de famille</td>
                                        <td><input type="text" name="lastname" value="{{ $user_show->lastname }}" class="form-control" {{ $user->rank == 3 ? '' : 'disabled' }}></td>
                                    </tr>
                                    @if($user->rank != 1)
                                        <tr>
                                            <td>E-mail</td>
                                            <td><input type="text" name="email" value="{{ $user_show->email }}" class="form-control" {{ $user->rank == 3 ? '' : 'disabled' }}></td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Grade</td>
                                        <td>
                                            <select name="rank_website" class="form-control" {{ $user->rank == 3 ? '' : 'disabled' }}>
                                                <option value="0" {{ $user_show->rank == 0 ? 'selected' : '' }} >Utilisateur</option>
                                                <option value="1" {{ $user_show->rank == 1 ? 'selected' : '' }} >Support</option>
                                                <option value="2" {{ $user_show->rank == 2 ? 'selected' : '' }} >Modérateur</option>
                                                <option value="3" {{ $user_show->rank == 3 ? 'selected' : '' }} >Administrateur</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Banni</td>
                                        <td>
                                            <select name="ban" class="form-control" {{ $user->rank == 1 ? 'disabled' : '' }}>
                                                <option value="0" {{ $user_show->ban == 0 ? 'selected' : '' }} >Non banni</option>
                                                <option value="1" {{ $user_show->ban == 1 ? 'selected' : '' }} >banni</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ID Arma @if($user_show->arma) <a target="_blank" href="{{ route('player', ['id' => $user_show->arma]) }}"><i class="fa fa-external-link"></i></a>@endif</td>
                                        <td><input type="text" name="arma" value="{{ $user_show->arma }}" class="form-control" maxlength="17" {{ $user->rank == 1 ? 'disabled' : '' }}></td>
                                    </tr>
                                </table>

                                <hr />

                                <div class="text-right">
                                    @if($user_show->totp_key && $user->rank != 1)
                                        <a href="{{ url('admin/totp', ['id' => $user_show->id]) }}" class="btn btn-labeled btn-info">
                                            <span class="btn-label"><i class="fa fa-trash"></i></span>Supprimer l'authentification à 2 facteurs
                                        </a>
                                    @endif
                                    @if($user->rank != 1)
                                        <button type="submit" class="btn btn-labeled btn-success">
                                            <span class="btn-label"><i class="fa fa-check"></i></span>Valider
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection