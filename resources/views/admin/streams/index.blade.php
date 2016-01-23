@extends('admin.app')

@section('page-info')
    <h3>Streamers</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="text-right">
                <a href="{{ action('StreamsController@create') }}" class="btn btn-success"><i class="fa fa-plus">&nbsp;&nbsp; Ajouter un Streamer</i></a>
                <br><br>
            </div>
            <div id="streamer" class="panel panel-default">
                <div class="panel-heading">Streamers
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
                            @foreach($streams as $stream)
                                <tr>
                                    <td>{{$stream->name}}</td>
                                    <td>{{$stream->slug}}</td>
                                    <td>{{$stream->updated_at}}</td>
                                    <td>
                                        <a href="{{ url('/stream/'. $stream->slug) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{ action('StreamsController@edit', $stream) }}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                        {!!Form::open(['url' => action("StreamsController@destroy", $stream), 'method' => 'delete']) !!}
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $streams->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection