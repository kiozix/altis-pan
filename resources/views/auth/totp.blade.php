@extends('app')

@section('content')

    <aside class="fh5co-page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="fh5co-page-heading-lead">
                        Connexion
                        <span class="fh5co-border"></span>
                    </h1>
                </div>
            </div>
        </div>
    </aside>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('flash')
                        <br/><br/><br/>
                        <form action="" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Code</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="code">
                                </div>
                                <br><br><br>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Se connecter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
