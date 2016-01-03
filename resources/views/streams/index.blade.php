@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Streams
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    <div class="container stream">

        <p class="text-right">
            <a href="{{ action('StreamsController@create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter un stream </a>
        </p>

        <table width="100%" color="black" class="table table-striped">
            <tbody>
            @foreach($streams as $stream)
                <tr>
                    <td>&nbsp; &nbsp;
                        <span class="stream__title">
                            <a href="{{ $stream->slug }}">{{ $stream->name }}</a>
                        </span>
                        <span class="stream__action">
                            <a href="{{ action('StreamsController@edit', $stream) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Editer</a>
                            <a href="{{ action('StreamsController@destroy', $stream) }}" data-method="delete" data-confirm="Voulez vous vraiment suprimer cette enregistrement ?" class="btn btn-danger"><i class="fa fa-trash"></i> Suprimmer</a>
                        </span>
                        <hr class="stream__hr"/>

                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top">
                                        <iframe src="http://player.twitch.tv/?channel={{ $stream->name }}" frameborder="0" scrolling="no" height="242" width="360"></iframe>
                                    </td>
                                    <td valign="top">
                                        <p class="stream__content">{{$stream->content }}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection