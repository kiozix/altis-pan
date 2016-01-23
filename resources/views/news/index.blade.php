@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        News
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($news as $new)
                <div class="col-md-12 fh5co-post">
                    <a href="{{ url("/news/$new->slug ")}}">
                        <div class="fh5co-post-media"><img src="{{ asset('img/news.png') }}" alt="News"></div>
                        <div class="fh5co-post-blurb">
                            <h3 class="text-uppercase">{{ $new->name }}</h3>
                            {{--{!! substr($new->content,0,20) !!}--}}
                            <span class="fh5co-post-meta">{{ $new->updated_at }}</span>
                        </div>
                    </a>
                </div>
                @endforeach
                {!! $news->render() !!}
            </div>
        </div>
    </div>

@endsection