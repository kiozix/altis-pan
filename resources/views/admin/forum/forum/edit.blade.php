@extends('admin.app')

@section('page-info')
    <h3>{{ $forum->name }}</h3>
@endsection

@section('content')
    <style>
        .input-group-addon.beautiful input[type="checkbox"],
        .input-group-addon.beautiful input[type="radio"] {
            display: none;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                @include('flash')
            </div>
            <div class="col-md-6">
                <div id="edit" class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">Edition</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <form action="{{ route('admin.forum.update', $forum) }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <table class="table table-responsive table-striped">
                                    <tr>
                                        <td>Titre</td>
                                        <td>
                                            <input type="text" name="name" placeholder="Titre" value="{{ $forum->name }}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>
                                            <input type="text" name="description" placeholder="Description" value="{{ $forum->description }}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Icon</td>
                                        <td>
                                            <input type="text" name="icon" placeholder="fa fa-" value="{{ $forum->icon }}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Catégories</td>
                                        <td>
                                            <select name="category" id="category" class="form-control">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ordre</td>
                                        <td>
                                            <input type="number" name="order" placeholder="Ordre" value="{{ $forum->order }}" class="form-control">
                                        </td>
                                    </tr>
                                </table>
                                <div class="pull-right">
                                    <button class="btn btn-success" type="submit">Savegarder</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div id="edit" class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">Permissions</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <form action="{{ route('admin.forum.update.permissions', $forum) }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <h5>Voir le forum</h5>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon beautiful">
                                            <input type="checkbox" name="moderator_see" value="1" {{ $forum->moderator_see == true ? 'checked' : '' }}>
                                        </span>
                                        <input type="text" class="form-control" value="Modérateur" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon beautiful">
                                            <input type="checkbox" name="support_see" value="1" {{ $forum->support_see == true ? 'checked' : '' }}>
                                        </span>
                                        <input type="text" class="form-control" value="Support" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon beautiful">
                                            <input type="checkbox" name="cop_see" value="1" {{ $forum->cop_see == true ? 'checked' : '' }}>
                                        </span>
                                        <input type="text" class="form-control" value="Policier" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon beautiful">
                                            <input type="checkbox" name="medic_see" value="1" {{ $forum->medic_see == true ? 'checked' : '' }}>
                                        </span>
                                        <input type="text" class="form-control" value="Pompier" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon beautiful">
                                            <input type="checkbox" name="gang_see" value="1" {{ $forum->gang_see ? 'checked' : '' }}>
                                        </span>
                                        <select name="gang_id_see" id="gang_id_see" class="form-control">
                                            @foreach($gangs as $gang)
                                                <option value="{{ $gang->id }}" {{ $gang->id == $forum->gang_see ? 'selected' : '' }}>{{ $gang->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <h5>Publier dans le forum</h5>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon beautiful">
                                            <input type="checkbox" name="moderator_post" value="1" {{ $forum->moderator_post == true ? 'checked' : '' }}>
                                        </span>
                                        <input type="text" class="form-control" value="Modérateur" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon beautiful">
                                            <input type="checkbox" name="support_post" value="1" {{ $forum->support_post == true ? 'checked' : '' }}>
                                        </span>
                                        <input type="text" class="form-control" value="Support" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon beautiful">
                                            <input type="checkbox" name="cop_post" value="1" {{ $forum->cop_post == true ? 'checked' : '' }}>
                                        </span>
                                        <input type="text" class="form-control" value="Policier" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon beautiful">
                                            <input type="checkbox" name="medic_post" value="1" {{ $forum->medic_post == true ? 'checked' : '' }}>
                                        </span>
                                        <input type="text" class="form-control" value="Pompier" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon beautiful">
                                            <input type="checkbox" name="gang_post" value="1" {{ $forum->gang_post ? 'checked' : '' }}>
                                        </span>
                                        <select name="gang_id_post" id="gang_id_post" class="form-control">
                                            @foreach($gangs as $gang)
                                                <option value="{{ $gang->id }}" {{ $gang->id == $forum->gang_post ? 'selected' : '' }}>{{ $gang->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="pull-right">
                                    <button class="btn btn-success" type="submit">Savegarder</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection