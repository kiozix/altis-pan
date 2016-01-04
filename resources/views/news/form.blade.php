{!! Form::model($news, ['class' =>'form-horizontal', 'url' => action("NewsController@$action", $news), 'method' => $action == 'store' ? 'Post' : 'Put']) !!}

<div class="form-group">
    <label class="col-md-4 control-label">Titre</label>

    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Slug</label>

    <div class="col-md-6">
        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Description</label>

    <div class="col-md-6">
        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            Sauvegarder
        </button>
    </div>
</div>

{!! Form::close() !!}