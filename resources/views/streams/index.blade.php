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
        <div class="container">
            <div class="row">
                @foreach($streams as $stream)
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <h3 class="text-uppercase"><a
                                        href="{{ url("/stream/$stream->slug ")}}">{{ $stream->name }}</a></h3>
                            <div class="embed-responsive embed-responsive-4by3">
                                <iframe src="http://player.twitch.tv/?channel={{ $stream->name }}" frameborder="0" crolling="no" class="embed-responsive-item" height="150px"></iframe>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <p class="stream-text">{{ $stream->content }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
            {!! $streams->render() !!}
        </div>
    </div>
@endsection