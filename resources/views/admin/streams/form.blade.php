@include('flash')

{!! Form::model($streams, ['class' =>'form-horizontal', 'url' => action("StreamsController@$action", $streams), 'method' => $action == 'store' ? 'Post' : 'Put']) !!}


<div class="form-group">
    <label class="col-md-4 control-label">Nom du streamer</label>

    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'http://www.twitch.tv/...']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Lien tips</label>

    <div class="col-md-6">
        {!! Form::url('tips', null, ['class' => 'form-control', 'placeholder'=> 'http://...']) !!}
    </div>
</div>


<div class="form-group">
    <label class="col-md-4 control-label">Description</label>

    <div class="col-md-6">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'required']) !!}
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
