@extends('app')

@section('content')
    <div class="container" style="margin-top: 70px">
        <h1>Boutique</h1>
        @include('flash')
        <div class="row">
            @foreach($shops as $shop)
            <div class="col-md-4 panel panel-danger">
                <div class="panel-body">
                    <h2 class="text-center">{{ $shop->name }}</h2>
                    <h3 class="text-center" style="font-size: 15px;">Level : {{ $shop->level }}</h3>
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
                    <p class="text-center">{{ $shop->content }}</p>
                    <div class="text-center">
                        <a class="btn btn-danger btn-lg" href="{{ action('ShopsController@show', $shop) }}">Achetter</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        {!! $shops->render() !!}
    </div>
@endsection