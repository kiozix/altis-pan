@extends('app')

@section('content')
    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Demande de remboursement
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('flash')
                <div class="alert alert-warning">
                    Conditions :
                    <ul>
                        <li>La descrition doit être complète et au minimum de 10caractères</li>
                        <li>La description doit ce munir d'un screen ou d'une vidéo</li>
                    </ul>
                </div>
                <form action="{{ url('player')}}" method="post" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label for="amount">Montant</label>
                    <div class="input-group">
                        <input type="number" id="amount" placeholder="Ex : 250000" class="form-control" name="amount" autocomplete="off">
                        <div class="input-group-addon">$</div>
                    </div>
                    <br>
                    <label for="content">Description</label>
                    <textarea id="content" name="content" cols="30" rows="10" class="ckeditor form-control"></textarea>
                    <br>
                    {!! app('captcha')->display() !!}
                    <br>
                    <div class="text-right">
                        <button type="submit" class="btn btn-labeled btn-success">
                            <i class="fa fa-check"></i>&nbsp;&nbsp;Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
@endsection