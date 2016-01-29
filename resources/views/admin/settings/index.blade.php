@extends('admin.app')

@section('page-info')
    <h3>Paramètres</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                @include('flash')
            </div>
            <div class="col-md-6">
                <div id="cop" class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">Grade policier</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <table class="table table-striped table-responsive">
                                @foreach($ranks_cop as $cop)
                                <tr>
                                    <td><input type="text" class="form-control" value="{{ $cop->value_associated}}" disabled></td>
                                    <td><input type="text" class="form-control" value="{{ $cop->name}}" disabled></td>
                                    <td>
                                        {!!Form::open(['url' => action("AdminController@settingDestroy", $cop->id), 'method' => 'delete']) !!}
                                        <button class="btn btn-danger" type="submit"><i class="fa fa-close"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <hr>
                            <form action="{{ url('/admin/settings') }}" method="post" class="form-horizontal">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="side" value="COP">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" name="value_associated" placeholder="Numéro DB">
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="name" placeholder="Nom sur le panel">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-labeled btn-success">
                                        <span class="btn-label"><i class="fa fa-plus"></i></span>Ajouter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="admin" class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">Grade Administrateur</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <table class="table table-striped table-responsive">
                                @foreach($ranks_admin as $admin)
                                    <tr>
                                        <td><input type="text" class="form-control" value="{{ $admin->value_associated}}" disabled></td>
                                        <td><input type="text" class="form-control" value="{{ $admin->name}}" disabled></td>
                                        <td>
                                            {!!Form::open(['url' => action("AdminController@settingDestroy", $admin->id), 'method' => 'delete']) !!}
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-close"></i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <hr>
                            <form action="{{ url('/admin/settings') }}" method="post" class="form-horizontal">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="side" value="ADMIN">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" name="value_associated" placeholder="Numéro DB">
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="name" placeholder="Nom sur le panel">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-labeled btn-success">
                                        <span class="btn-label"><i class="fa fa-plus"></i></span>Ajouter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div id="medic" class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">Grade medic</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <table class="table table-striped table-responsive">
                                @foreach($ranks_medic as $medic)
                                    <tr>
                                        <td><input type="text" class="form-control" value="{{ $medic->value_associated}}" disabled></td>
                                        <td><input type="text" class="form-control" value="{{ $medic->name}}" disabled></td>
                                        <td>
                                            {!!Form::open(['url' => action("AdminController@settingDestroy", $medic->id), 'method' => 'delete']) !!}
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-close"></i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <hr>
                            <form action="{{ url('/admin/settings') }}" method="post" class="form-horizontal">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="side" value="MEDIC">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" name="value_associated" placeholder="Numéro DB">
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="name" placeholder="Nom sur le panel">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-labeled btn-success">
                                        <span class="btn-label"><i class="fa fa-plus"></i></span>Ajouter
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