@extends('admin.app')

@section('page-info')
    <h3>Création d'un forum</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                @include('flash')
            </div>
            <div class="col-md-6">
                <div id="edit" class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">Création d'un forum</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <form action="{{ route('admin.forum.store') }}" method="post">
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
                                                    <option value="{{ $category->id }}" {{ isset($_GET['category']) ? $_GET['category'] == $category->id ? 'selected' : '' : '' }}>{{ $category->name }}</option>
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
        </div>
    </div>
@endsection