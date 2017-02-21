@extends('app')

@section('content')
    <div class="container" style="margin-top: 70px">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">Blog Post Title</h1>
                <hr>
                {!! $news->content !!}
            </div>
        </div>
    </div>
@endsection