@extends('admin.app')

@section('page-info')
    <h3>Page</h3>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div id="informations" class="panel panel-default">
                <div class="panel-heading"><span style="font-weight: bold;font-size: 20px !important;">Modifier {{ $pages->name }}</span>
                    <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="" class="pull-right">
                        <em class="fa fa-minus"></em>
                    </a>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        @include('admin.pages.form', ['action'=> 'update'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

