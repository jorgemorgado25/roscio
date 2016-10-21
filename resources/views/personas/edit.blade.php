@extends('app')
@section('title')
	Editar Persona
@endsection
@section('main-content')
<h3>Editar Persona</h3><br>
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Datos de la Persona</h3>
	</div>
	{!! Form::model($persona, ['route' => ['personas.update', $persona->id], 'method' => 'PUT']) !!}
	<div class="box-body">
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Nacionalidad</label>
				{!! Form::select('nac', ['V' => 'V', 'E' => 'E'], null, ['class' => 'form-control']) !!}
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-cedula-representante">
				<label for="" class="control_label">Cédula</label>
				{!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Escribe la cédula', 'id' => 'txt-cedula-representante', 'maxlength' => 8]) !!}
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-nombre-representante">
				<label for="" class="control_label">Nombres</label>
				{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Escribe el nombre', 'id' => 'txt-nombre-representante', 'maxlength' => 80]) !!}
			</div>		
		</div>	
		<div class="col-md-6">
			<div class="form-group" id="div-apellido-representante">
				<label for="" class="control_label">Apellidos</label>
				{!! Form::text('apellido', null, ['class' => 'form-control', 'placeholder' => 'Escribe el apellido', 'id' => 'txt-apellido-representante', 'maxlength' => 80]) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-genero-representante">
				<label for="" class="control_label">Género</label>
				{!! Form::select('genero', ['m' => 'Masculino', 'f' => 'Femenino'], null, ['class' => 'form-control', 'id' => 'txt-genero-representante']) !!}
			</div>
		</div>
		<div class="col-md-6" id="div-fecha-nac-representante">
			<div class="form-group">
				<label for="" class="control_label">Fecha de Nacimiento</label>
				<div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="fecha_nac" value="{{ $persona->fecha_normal }}" id="txt-fecha-nac" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                </div>
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-grado-representante">
				<label for="" class="control_label">Grado de Instrucción</label>
				{!! Form::text('grado_instruccion', null, ['class' => 'form-control', 'placeholder' => 'Escribe el grado de instrucción', 'id' => 'txt-grado-representante', 'maxlength' => 15]) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-profesion-representante">
				<label for="" class="control_label">Profesión u oficio</label>
				{!! Form::text('profesion', null, ['class' => 'form-control', 'placeholder' => 'Escribe la profesión u oficio', 'id' => 'txt-profesion-representante', 'maxlength' => 40]) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-telefono-representante">
				<label for="" class="control_label">Teléfono</label>
				{!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Escribe el telefono', 'id' => 'txt-telefono-representante', 'maxlength' => 20]) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Correo electrónico</label>
				{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Escribe el correo electrónico', 'maxlength' => 80]) !!}
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group" id="div-direccion-representante">
				<label for="" class="control_label">Dirección</label>
				{!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Escribe la dirección', 'id' => 'txt-direccion-representante', 'maxlength' => 100]) !!}
			</div>
		</div>		
	</div>

	<div class="box-footer">
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Cambios</button>
			<a href="{{ URL::previous() }}" class="btn btn-danger">Cancelar</a>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$("#txt-fecha-nac").inputmask("dd/mm/yyyy", {"placeholder": "DD/MM/AAAA"});
</script>
@endsection