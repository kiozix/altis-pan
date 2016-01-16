@extends('admin.app')

@section('page-info')
    <div class="content-wrapper">
        <h3>Ajouter une News
        </h3>
    </div>
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">News / Ajouter</div>
    <div class="panel-body">
        <form method="get" action="/" class="form-horizontal">
            <fieldset>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Titre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control">
                        <span class="help-block m-b-none">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Input groups</label>
                    <div class="col-sm-10">
                        <div class="input-group m-b">
                            <span class="input-group-addon">{{ url('new/') }}/</span>
                            <input type="text" placeholder="Username" class="form-control">
                        </div>

                    </div>
                </div>
            </fieldset>


        </form>
    </div>
</div>

@endsection