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
                                        <td><input type="text" name="username" value="{{ $user_show->name }}" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Prénom</td>
                                        <td><input type="text" name="firstname" value="{{ $user_show->firstname }}" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Nom de famille</td>
                                        <td><input type="text" name="lastname" value="{{ $user_show->lastname }}" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>E-mail</td>
                                        <td><input type="text" name="email" value="{{ $user_show->email }}" class="form-control"></td>
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
                                    <tr>
                                        <td>Banni</td>
                                        <td>
                                            <select name="ban" class="form-control">
                                                <option value="0" {{ $user_show->ban == 0 ? 'selected' : '' }} >Non banni</option>
                                                <option value="1" {{ $user_show->ban == 1 ? 'selected' : '' }} >banni</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ID Arma @if($user_show->arma) <a target="_blank" href="{{ route('player', ['id' => $user_show->arma]) }}"><i class="fa fa-external-link"></i></a>@endif</td>
                                        <td><input type="text" name="arma" value="{{ $user_show->arma }}" class="form-control" maxlength="17"></td>
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
            </div>
        </div>
    </div>
@endsection