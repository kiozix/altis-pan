@extends('admin.app')

@section('page-info')
    <h3>Création d'une catégorie</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                @include('flash')
            </div>
            <div class="col-md-6">
                <div id="edit" class="panel panel-default">
                    <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">Création d'une catégorie</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <form action="{{ route('admin.forum.category.store', $category) }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <table class="table table-responsive table-striped">
                                    <tr>
                                        <td>Titre</td>
                                        <td>
                                            <input type="text" name="name" placeholder="Titre" value="{{ $category->name }}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ordre</td>
                                        <td>
                                            <input type="number" name="order" placeholder="Ordre" value="{{ $category->order }}" class="form-control">
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