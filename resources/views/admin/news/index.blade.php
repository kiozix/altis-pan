@extends('admin.app')

@section('page-info')
    <h3>News</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="text-right">
                <a href="{{ action('NewsController@create') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp; Ajouter une News</a>
                <br><br>
            </div>
            <div id="streamer" class="panel panel-default">
                <div class="panel-heading">News
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
                            @foreach($news as $new)
                                <tr>
                                    <td>{{$new->name}}</td>
                                    <td>{{$new->slug}}</td>
                                    <td>{{$new->updated_at}}</td>
                                    <td>
                                        <a href="{{ url('/news/'. $new->slug) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{ action('NewsController@edit', $new) }}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                        <span style="display: inline-block">
                                            {!!Form::open(['url' => action("NewsController@destroy", $new), 'method' => 'delete']) !!}
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $news->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection