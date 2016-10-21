@extends('app')
@section('html_title')
    Cambiar contraseña
@endsection
@section('main-content')
<div class="container">
	<div class="col-md-5 col-md-offset-2 col-sm-6 col-sm-offset-3">
		<h3 class="text-center">Cambiar Contraseña</h3><br>
		@include("partials.validation-errors")
		@include('partials.error-message')
		@include('partials.success-message')
		<div class="box box-primary">
			{!! Form::open(["route" => "user.post.change_password", "method" => "POST"]) !!}
			<div class="box-body">
				<div class="form-group">
					<label for="">Contraseña actual</label>
					<input type="password" name="current_password" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Nueva contraseña</label>
					<input type="password" name="password" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Confirmar ontraseña</label>
					<input type="password" name="confirm_password" class="form-control">
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Aceptar</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection