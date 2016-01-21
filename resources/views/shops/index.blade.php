@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Boutique
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    @if (Auth::guest())
    @else
        @if (Auth::user()->admin == 1)
            <p class="text-right">
                <a href="{{ action('ShopsController@create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter une offre </a>
            </p>
        @endif
    @endif

    <div class="container">
        @include('flash')
        <div class="row">
            @foreach($shops as $shop)
            <div class="col-md-4 panel panel-danger">
                <div class="panel-body">
                    <h2 class="fh5co-sidebox-lead text-center">{{ $shop->name }}</h2>
                    <h3 class="fh5co-sidebox-lead text-center" style="font-size: 15px;">Level : {{ $shop->level }}</h3>
                    <hr />
                    <div class="text-center">
                      <span class="shop-currency">€</span>
                      <span class="shop-price">{{ $shop->price }}</span>
                      @if($shop->time != 0)
                      <span class="shop-duration">/{{ $shop->time }}Jours</span>
                      @else
                          <span class="shop-duration">/A vie</span>
                      @endif
                    </div>
                    <br />
                    <img class="img-responsive img-rounded" src="{{ $shop->image }}">
                    <br />
                    <p>{{ $shop->content }}</p>
                    <a class="btn btn-outline" href="{{ action('ShopsController@show', $shop) }}">Achetter</a>
                    @if (Auth::guest())
                    @else
                        @if (Auth::user()->admin == 1)
                            <a href="{{ action('ShopsController@edit', $shop) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <a href="{{ action('ShopsController@destroy', $shop) }}" data-method="delete" data-confirm="Voulez vous vraiment suprimer cette enregistrement ?" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        @endif
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection