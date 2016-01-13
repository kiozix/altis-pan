@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        {{ $shops->name }}
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    <pre>{{ var_dump(Session::all()) }}</pre>

    <div class="container">
        <div class="col-md-12">
            <div class="col-md-6">
                <img src="{{ $shops->image }}" alt="{{ $shops->name }}" class="img-reponsive img-thumbnail" width="400px" height="400px">
            </div>
            <div class="col-md-6">
                <div class="text-center">
                    <span class="shop-currency">€</span>
                    <span class="shop-price">{{ $shops->price }}</span>
                    @if($shops->time != 0)
                        <span class="shop-duration">/{{ $shops->time }}Jours</span>
                    @else
                        <span class="shop-duration">/A vie</span>
                    @endif
                </div>

                <a href="{{ $paypal }}" class="btn btn-success">Payer</a>


            </div>
        </div>
    </div>

@endsection