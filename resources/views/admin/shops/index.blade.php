@extends('admin.app')

@section('page-info')
    <h3>Boutiques</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="text-right">
                <a href="{{ action('ShopsController@create') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp; Ajouter une offre</a>
                <br><br>
            </div>
            <div id="streamer" class="panel panel-default">
                <div class="panel-heading">Boutique
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
                                <th>Prix</th>
                                <th>Level</th>
                                <th>Dernière édition</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($shops as $shop)
                                <tr>
                                    <td>{{$shop->name}}</td>
                                    <td>{{$shop->price}}</td>
                                    <td>{{$shop->level}}</td>
                                    <td>{{$shop->updated_at}}</td>
                                    <td>
                                        <a href="{{ url('/shop/'. $shop->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{ action('ShopsController@edit', $shop) }}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                        <span style="display: inline-block">
                                            {!!Form::open(['url' => action("ShopsController@destroy", $shop), 'method' => 'delete']) !!}
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection