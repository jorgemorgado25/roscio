@extends('app')
@section('main-content')
	<h3>
		<a href="{{ route('user.pdf', $user) }}" class="btn btn-primary pull-right" target = "_blank"><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;Imprimir</a>
		Editar Usuario</h3>
	<br>
	@include('partials.validation-errors')
	@include('partials.success-message')
	{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}
	<div class="box box-primary">
		<div class="box-body">
			<div class="col-md-6">
				<div class="form-group">
					<label for="first_name" class="control_label">@lang('validation.attributes.first_name')</label>

					{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Escribe el nombre']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="last_name" class="control_label">@lang('validation.attributes.last_name')</label>
					{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Escribe el apellido']) !!}
				</div>				
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('role', 'Tipo de Usuario') !!}
					{!! Form::select('role', ['user' => 'Usuario', 'admin' => 'Administrador'], null, ['class' => 'form-control']) !!}
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control_label">Login</label>
					{!! Form::text('login', null, ['class' => 'form-control']) !!}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Cargo o Descripción</label>
					{!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Cargo o descripción']) !!}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<input type="hidden" name="active" value="0">
					<label for="" class="control_label">Activo</label><br>
					{!! Form::checkbox('active', 1, $user->active, ['class' => 'minimal']) !!}

				</div>
			</div>

			<div class="col-md-12">
				<p><b>Acceso a módulos: </b></p>
			</div>
			
			<div class="col-md-12">
				<input name="role_inscripciones" class="minimal" type="checkbox" {{ $user->hasRole('Inscripciones') ? 'checked' : '' }}>&nbsp; Inscripciones
			</div>
			<div class="col-md-12">
				<input name="role_comedor" class="minimal" type="checkbox" {{ $user->hasRole('Comedor') ? 'checked' : '' }}>  &nbsp; Comedor
			</div> 
			

		</div>
		{!! Form::close() !!}

		<div class="box-footer">
			<div class="col-md-12">

				<button style="display:inline" class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar</button>
				&nbsp;
				{!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE', 'style' => 'display:inline', 'id' => 'frm-enviar']) !!}
					<button id="btn-eliminar" type="button" style="display: inline" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> &nbsp;Eliminar</button>
				{!! Form::close() !!}

			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script src="{{ asset('/js/users-edit.js') }}" type="text/javascript"></script>
@endsection