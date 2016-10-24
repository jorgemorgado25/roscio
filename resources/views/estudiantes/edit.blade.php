@extends('app')
@section('css')
	<style type="text/css">
		input
		{
			text-transform: uppercase;
		}
	</style>
@endsection
@section('title')
	Editar Estudiante
@endsection
@section('main-content')
<h3>Editar Estudiante</h3><br>
@include('partials.validation-errors')
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Datos del Estudiante</h3>
	</div>
	{!! Form::model($estudiante, ['route' => ['estudiantes.update', $estudiante->id], 'method' => 'PUT']) !!}
	<div class="box-body">

		<div class="col-md-6">
			<div class="form-group">
				<label for="">Nacionalidad</label>
				{!! Form::select('nac', ['V' => 'V', 'E' => 'E'], null, ['class' => 'form-control', 'required' => 'required']) !!}
			</div>
		</div>
		<div class="col-md-6">			
			<div id="div-cedula" class="form-group">
				<label for="">Cédula</label>
				{!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Escribe la cedula', 'required' => 'required', 'id' => 'txt-cedula']) !!}
				@if ($errors->has('cedula'))
					<span class="help-block">La cédula se encuentra registrada</span>
				@endif
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="">Nombres</label>
				{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Escribe el nombre', 'required' => 'required', 'id' => 'txt-nombre']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Apellido</label>
				{!! Form::text('apellido', null, ['class' => 'form-control', 'placeholder' => 'Escribe el apellido', 'required' => 'required', 'id' => 'txt-apellido']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Género</label>
				{!! Form::select('nac', ['m' => 'Masculino', 'f' => 'Femenino'], null, ['class' => 'form-control', 'required' => 'required']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-fecha_nac">
				<label for="" class="control_label">Fecha de Nacimiento</label>
				<div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input value="{{ $estudiante->fecha_normal }}" name="fecha_nac" id="txt-fecha_nac" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>
                </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-estado_nac">
				<label for="" class="control_label">Estado de Nacimiento</label>
				{!! Form::select('estado_nac', $estados, null, ['class' => 'form-control', 'id' => 'txt-estado_nac']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-lugar_nac">
				<label for="" class="control_label">Lugar de Nacimiento</label>
				{!! Form::text('lugar_nac', null, ['class' => 'form-control', 'placeholder' => 'Escriba el lugar de nacimiento', 'id' => 'txt-lugar_nac', 'maxlength' => 80, 'required' => 'required']) !!}
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group" id="div-direccion">
				<label for="" class="control_label">Dirección de Habitación</label>
				{!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Escriba la dirección', 'id' => 'txt-direccion', 'maxlength' => 80, 'required' => 'required']) !!}
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="" class="control_label">Vive con la Madre</label>
				<br>
				<input type="hidden" name="vive_con_madre" value=0>
				{!! Form::checkbox('vive_con_madre', 1, $estudiante->vive_con_madre, ['class' => '']) !!}
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="" class="control_label">Vive con el Padre</label>
				<br>
				<input type="hidden" name="vive_con_padre" value=0>
				{!! Form::checkbox('vive_con_padre', 1, $estudiante->vive_con_padre, ['class' => '']) !!}
			</div>
		</div>
	</div>
	<div class="box-header with-border">
		<h3 class="box-title">Información Médica</h3>
	</div>

	<div class="box-body">
		<div class="col-md-6">
			<div class="form-group" id="div-peso">
				<label for="" class="control_label">Peso</label>
				{!! Form::text('peso', null, ['class' => 'form-control', 'placeholder' => 'Escribe el paso en kilos', 'id' => 'txt-peso', 'maxlength' => 6]) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-talla">
				<label for="" class="control_label">Talla</label>
				{!! Form::text('talla', null, ['class' => 'form-control', 'placeholder' => 'Escribe la talla', 'id' => 'txt-talla', 'maxlength' => 4]) !!}
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group" id="div-grupo_sanguineo">
				<label for="" class="control_label">Grupo Sanguíneo</label>
				{!! Form::select('grupo_sanguineo', ['A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'O+' => 'O+', 'O-' => 'O-'], null, ['class' => 'form-control', 'placeholder' => 'Selecciona el grupo sanguineo', 'id' => 'txt-grupo_sanguineo']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Enfermedades o alérgias</label>
				{!! Form::text('enf_aler', null, ['class' => 'form-control', 'placeholder' => 'Escribe enfermedades o alérgias', 'maxlength' => 80]) !!}
			</div>
		</div>
	</div>
	<div class="box-footer">
		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Cambios</button>
		<a href="{{ URL::previous() }}" class="btn btn-danger">Cancelar</a>
	</div>
	{!! Form::close() !!}
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$("#txt-fecha_nac").inputmask("dd/mm/yyyy", {"placeholder": "DD/MM/AAAA"});
	$(document).ready(function()
	{
		@if ($errors->has('cedula'))
			$('#div-cedula').addClass('has-error');
		@endif
	});
</script>
@endsection