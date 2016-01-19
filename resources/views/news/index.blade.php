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
                @if (Auth::guest())
                @else
                    @if (Auth::user()->admin == 1)
                        <p class="text-right">
                            <a href="{{ action('NewsController@create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                                Ajouter une News </a>
                        </p>
                    @endif
                @endif
            </div>
            <div class="col-md-12">
                @foreach($news as $new)
                <div class="col-md-12 fh5co-post">
                    <a href="{{ url("/news/$new->slug ")}}">
                        <div class="fh5co-post-media"><img src="{{ asset('img/news.png') }}" alt="News"></div>
                        <div class="fh5co-post-blurb">
                            <h3 class="text-uppercase">{{ $new->name }}</h3>
                            {!! $new->content !!}
                            <span class="fh5co-post-meta">{{ $new->updated_at }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-12">
                    @if (Auth::guest())
                    @else
                        @if (Auth::user()->admin == 1)
                            <div class="col-md-12">
                                <div class="col-md-3 col-md-push-6 col-sm-6">
                                    <a href="{{ action('NewsController@edit', $new) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Editer</a>
                                </div>
                                <div class="col-md-3 col-md-push-6 col-sm-6">
                                    <a href="{{ action('NewsController@destroy', $new) }}" data-method="delete" data-confirm="Voulez vous vraiment suprimer cette enregistrement ?" class="btn btn-danger"><i class="fa fa-trash"></i> Supprimer</a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                @endforeach
            </div>
        </div>

    </div>

@endsection