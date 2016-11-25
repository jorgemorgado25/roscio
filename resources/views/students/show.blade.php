@extends('app')
@section('title')
	Crear Rubro
@endsection
@section('main-content')
<h3>Mostrar Estudiante</h3><br>
@include('partials.success-message')

<div class="box box-primary">
	<div class="box-header with-border">
		<div class="row">
			<div class="col-md-6">
				<label for="">Cédula</label>
				<p>{{ $estudiante->ci }}</p>
			</div>
			<div class="col-md-6">
				<label for="">Género</label>
				<p>{{ $estudiante->genero }}</p>
			</div>
			<div class="col-md-6">
				<label for="">Nombre</label>
				<p>{{ $estudiante->full_name }}</p>
			</div>
			<div class="col-md-6">
				<label for="">Fecha de Nacimiento</label>
				<p>{{ $estudiante->FechaNac }}</p>
			</div>
		</div>
	</div>
	<div class="box-body">		
		<a href="{{ route('students.edit', $estudiante) }}" class="btn btn-primary" type="submit" id="btn-submit"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
	</div>
</div>

<h4>Listado de Inscripciones</h4>
<br>
<div class="box box-success">
	<div class="box-header with-border">
		<table class="table table-bordered table-stripped">
			<tr>
				<th>Escolaridad</th>
				<th>Año</th>
				<th>Sección</th>
				<th>Representante</th>
				<th>Cédula</th>				
				<th width="120px">Acciones</th>
			</tr>
			@foreach($registers as $reg)
				<tr>
					<td>{{ $reg->escolaridad->escolaridad }}</td>
					<td>{{ $reg->ano->ano }}</td>
					<td>{{ $reg->seccion->seccion }}</td>
					<td>{{ $reg->person->full_name }}</td>
					<td>{{ $reg->person->ci }}</td>					
					<td>
						<a target="_blank" title="Carnet Estudiantil" href="/matricula/carnet/{{ $reg->id }}" class="btn btn-default btn-sm">
							<span class="glyphicon glyphicon-credit-card"></span>
							</a>
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>

@endsection