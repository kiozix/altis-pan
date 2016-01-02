@extends('app')

@section('content')
	<aside class="fh5co-page-heading">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="fh5co-page-heading-lead">
						Réinitialiser votre mot de passe
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
						@if (count($errors) > 0)
							<div class="col-md-12">
								<div class="alert alert-danger">
									<strong>Whoops!</strong> Il y a un problème !<br><br>
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							</div>
						@endif
						<br/><br/><br/>
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="token" value="{{ $token }}">

							<div class="form-group">
								<label class="col-md-4 control-label">Nom d'utilisateur ou Email</label>

								<div class="col-md-6">
									{!! Form::text('name', null, ['class' => 'form-control']) !!}
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Mot de passe</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="password">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Confirmer mote de passe</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="password_confirmation">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Envoyer
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
