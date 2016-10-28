@extends('app')
@section('title')
	Listado de Inscripciones
@endsection
@section('main-content')
<h3>Listado de Inscripciones del Estudiante</h3><br>
<div class="box box-primary">
	<div class="box-header with-border">
		Datos del Estudiante
	</div>
	<div class="box-body">
		<p>
			<label for="">Cédula: </label> {{ $estudiante->cedula }}
		</p>
		<p>
			<label for="">Nombre y Apellido: </label> {{ $estudiante->full_name }}			
		</p>
		@if (count($estudiante->inscripciones) > 0)
		<table class="table table-bordered" id="table">
			<thead>
			<tr>
				<th>Representante</th>
				<th>Escolaridad</th>
				<th>Mención</th>
				<th>Año</th>
				<th>Sección</th>
				<th>Acciones</th>
			</tr>
			</thead>
			<tbody>			
			@foreach($estudiante->inscripciones->reverse() as $inscripcion)
				<tr>
					<td>{{ $inscripcion->representante->persona->full_name }}</td>
					<td>{{ $inscripcion->escolaridad->escolaridad }}</td>					
					<td>{{ $inscripcion->mencion->mencion }}</td> 
					<td>{{ $inscripcion->ano->ano }}</td>
					<td>{{ $inscripcion->seccion->seccion }}</td>
					<td>
						<a target="_blank" title="Imprimir Ficha de Inscripción" class="btn btn-default btn-sm" href="{{ route('estudiantes.ficha_inscripcion', $inscripcion->id) }}"><span class="glyphicon glyphicon-print"></span></a>
						<a title="Carnet del Estudiante" href="#" class="btn btn-default btn-sm">
							<span class="glyphicon glyphicon-credit-card"></span>
						</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		@else
		<div class="alert bg-active btn-primary text-center">
			El alumno no posee inscripciones
		</div>
		@endif
	</div>
</div>	
@endsection