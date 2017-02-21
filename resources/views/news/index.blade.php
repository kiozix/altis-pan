@extends('app')

@section('content')
    <div class="container" style="margin-top: 77px">
        <h1>News</h1>
        <div class="row">
            <div class="col-md-12" style="margin-top: 5px">
                @foreach($news as $new)
                <div class="col-md-12 post">
                    <a href="{{ url("/news/$new->slug ")}}">
                        <div class="post-media"><img src="{{ asset('img/news.png') }}" alt="News"></div>
                        <div class="post-blurb">
                            <h3 class="text-uppercase">{{ $new->name }}</h3>
                            <span class="post-meta">{{ $new->updated_at }}</span>
                        </div>
                    </a>
                </div>
                @endforeach
                {!! $news->render() !!}
            </div>
        </div>
    </div>

@endsection