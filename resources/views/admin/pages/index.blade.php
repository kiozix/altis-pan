@extends('admin.app')

@section('page-info')
    <h3>Pages</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="text-right">
                <a href="{{ action('PagesController@create') }}" class="btn btn-success"><i class="fa fa-plus">&nbsp;&nbsp; Ajouter une pages</i></a>
                <br><br>
            </div>
            <div id="streamer" class="panel panel-default">
                <div class="panel-heading">Pages
                    <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                        <em class="fa fa-minus"></em>
                    </a>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        @include('flash')
                        <table class="table table-responsive table-striped">
                            <tr>
                                <th>Nom</th>
                                <th>Slug</th>
                                <th>Dernière édition</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{$page->name}}</td>
                                    <td>{{$page->slug}}</td>
                                    <td>{{$page->updated_at}}</td>
                                    <td>
                                        <a href="{{ url('/page/'. $page->slug) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{ action('PagesController@edit', $page) }}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                        <span style="display: inline-block">
                                            {!!Form::open(['url' => action("PagesController@destroy", $page), 'method' => 'delete']) !!}
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $pages->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection