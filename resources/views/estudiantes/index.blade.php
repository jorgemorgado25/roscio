@extends('app')
@section('title')
	Listado de Estudiantes
@endsection
@section('main-content')

<h3>
	<a href="/estudiantes/create" class="btn btn-primary btn-sm pull-right">Nuevo</a>
	Listado de Estudiantes</h3><br>
<div class="box box-primary">
	<div class="box-header with-border">
		Hay {{ $estudiantes->total() }} estudiantes registrados
		{!! Form::open(['route' => 'estudiantes.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left pull-right', 'role' => 'search']) !!}
			<select name="" id="sel-tipo" class="form-control">
				<option value="cedula">Cédula</option>
				<option value="nombre">Nombre o Apellido</option>
			</select>
			{!! Form::text('nombre', null, ['id' => 'txt-nombre', 'class' => 'form-control', 'placeholder' => 'Nombre o Apellido']) !!}
			{!! Form::text('cedula', null, ['id' => 'txt-cedula', 'class' => 'form-control', 'placeholder' => 'Cédula']) !!}
			<button type="submit" class="btn btn-default">Buscar</button>
		{!! Form::close() !!}
	</div>
	<div class="box-body">
		@if( count($estudiantes) > 0)
		<table class="table table-bordered" id="table">
			<thead>
			<tr>
				<th>Cédula</th>
				<th>Nombre y Apellido</th>
				<th>Representante</th>
				<th width="200px">Acciones</th>
			</tr>
			</thead>
			<tbody>
			@foreach($estudiantes as $estudiante)
				<tr>
					<td>{{ $estudiante->cedula }}</td>
					<td>{{ $estudiante->full_name }}</td>
					<?php $representantes = $estudiante->representantes->reverse(); ?>
					<td>{{ $representantes[0]->persona->full_name }}</td>
					<td>
						<a title="Ver" class="btn btn-default btn-sm" href="{{ route('estudiantes.show', $estudiante) }}"><span class="glyphicon glyphicon-search"></span></a>
						<a title="Listado de Inscripciones" class="btn btn-default btn-sm" href="{{ route('estudiante.inscripciones', $estudiante) }}"><span class="glyphicon glyphicon-list"></span></a>
						
						<a title="Inscribir Estudiante" class="btn btn-default btn-sm" href="{{ route('inscripciones.create', 'cedula=' . $estudiante->cedula) }}"><span class="glyphicon glyphicon-star"></span></a>

						<a title="Editar" class="btn btn-default btn-sm" href="{{ route('estudiantes.edit', $estudiante) }}"><span class="glyphicon glyphicon-pencil"></span></a>
						<a title="Modificar Representante" class="btn btn-default btn-sm" href="{{ route('get_estudiante.modificar_representante', $estudiante) }}"><span class="glyphicon glyphicon-refresh"></span></a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		@else
			<div class="alert bg-active btn-primary text-center">
				No se encontraron resultados
			</div>
		@endif
	</div>
	<div class="box-footer clearfix">
		<div class="pull-right">
			{!! $estudiantes->render() !!}
		</div>
	</div>
</div>	
@endsection

@section('scripts')
	<script src="{{ asset('/js/set-datatable.js') }}"></script>
	<script>
	$(document).ready(function()
	{
		/* -------- ALPHANUM --------- */
	$("#txt-nombre").alpha();

	/* -------- ALPHANUM INTEGER --------- */
	$("#txt-cedula").numeric({
    	allowMinus   : false,
    	allowThouSep : false,
    	allowDecSep: false
    });
		$('#txt-nombre').hide();
		$("#sel-tipo").change(function()
		{
			$('#txt-nombre').val('');
			$('#txt-cedula').val('');
			if ($("#sel-tipo").val() == 'nombre')
			{
				$('#txt-nombre').show();
				$('#txt-nombre').focus();
				$('#txt-cedula').hide();
			}else
			{
				$('#txt-nombre').hide();
				$('#txt-cedula').show();
				$('#txt-cedula').focus();
			}
		})
	});
	</script>
@endsection