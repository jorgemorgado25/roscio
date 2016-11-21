@extends('app')
@section('title')
	Crear Rubro
@endsection
@section('main-content')
<h3>Editar Estudiante</h3><br>
<div class="box box-primary">
	
	<div class="box-header with-border">
		{!! Form::model($student, ['route' => ['students.update', $student->id], 'method' => 'PUT']) !!}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Cédula</label>
					{!! Form::text('ci', null, [
						'class' => 'form-control', 
						'required' => 'required', 
						'id' => 'txt-cedula',
						'maxlength' => 15,
						'placeholder' => 'Escribe la cédula']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Género</label>
					{!! Form::select('gender', ['M' => 'Masculino', 'F' => 'Femenino'], null, ['class' => 'form-control']) !!}
				</div>				
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Nombre</label>
					{!! Form::text('full_name', null, [
						'class' => 'form-control', 
						'required' => 'required', 
						'placeholder' => 'Escribe el nombre']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?php $fecha = $student->FechaNac ?>
					<label for="">Fecha de Nacimiento</label>
					{!! Form::text('birthday', $fecha, [
						'class' => 'form-control', 
						'id' => 'txt-fecha-nac',
						'required' => 'required', 
						'placeholder' => 'Escribe la fecha de Nacimiento']) !!}
				</div>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<button class="btn btn-primary"> <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar </button>
		<a href="{{ route('students.show', $student) }}" class="btn btn-danger">Cancelar</a>
	</div>	
	</form>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function()
	{
		$("#txt-fecha-nac").inputmask("dd-mm-yyyy", {"placeholder": "dd/mm/yyyy"});
		$('#txt-cedula').numeric({
    		allowMinus   : false,
    		allowThouSep : false,
    		allowDecSep: false
    	});
	});
</script>	
@endsection