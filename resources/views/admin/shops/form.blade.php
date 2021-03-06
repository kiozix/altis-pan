@include('flash')

{!! Form::model($shops, ['class' =>'form-horizontal', 'url' => action("ShopsController@$action", $shops), 'method' => $action == 'store' ? 'Post' : 'Put']) !!}

<div class="form-group">
    <label class="col-md-4 control-label">Titre</label>

    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Prix (€)</label>

    <div class="col-md-6">
        {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Ex : 10']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Durée (Jours) <br>
        <small>0 pour "A vie"</small>
    </label>
    <div class="col-md-6">
        {!! Form::text('time', null, ['class' => 'form-control', 'placeholder' => 'Ex : 30']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Level (Donatorlvl)</label>

    <div class="col-md-6">
        {!! Form::text('level', null, ['class' => 'form-control', 'placeholder' => 'Ex : 2']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Image</label>

    <div class="col-md-6">
        {!! Form::url('image', null, ['class' => 'form-control', 'placeholder' => 'Ex : http://site.fr/image.jpg']) !!}
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