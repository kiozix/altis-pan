@extends('admin.app')

@section('page-info')
    <h3>Streamers</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div id="informations" class="panel panel-default">
                    <div class="panel-heading"><span
                                style="font-weight: bold;font-size: 20px !important;">Informations</span>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            @include('admin.streams.form', ['action'=> 'store'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection