@extends('app')
@section('title')
	Listado de Personas
@endsection
@section('main-content')

<h3>Listado de Personas</h3><br>
<div class="box box-primary">
	<div class="box-header with-border">
		Hay {{ $persons->total() }} personas registrados
		{!! Form::open(['route' => 'persons.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left pull-right', 'role' => 'search']) !!}
			<select name="" id="sel-tipo" class="form-control">
				<option value="ci">Cédula</option>
				<option value="name">Nombre</option>
			</select>
			{!! Form::text('name', null, ['id' => 'txt-nombre', 'class' => 'form-control', 'placeholder' => 'Nombre o Apellido']) !!}
			{!! Form::text('ci', null, ['id' => 'txt-cedula', 'class' => 'form-control', 'placeholder' => 'Cédula']) !!}
			<button type="submit" class="btn btn-default">Buscar</button>
		{!! Form::close() !!}
	</div>
	<div class="box-body">
		@if( count($persons) > 0)
		<table class="table table-bordered" id="table">
			<thead>
			<tr>
				<th>Cédula</th>
				<th>Nombre y Apellido</th>
				<th width="100px">Acciones</th>
			</tr>
			</thead>
			<tbody>
			@foreach($persons as $person)
				<tr>
					<td>{{ $person->ci }}</td>
					<td>{{ $person->full_name }}</td>
					<td>
						<a title="Ver" class="btn btn-default btn-sm" href="#"><span class="glyphicon glyphicon-search"></span></a>

						<a title="Editar" class="btn btn-default btn-sm" href="#"><span class="glyphicon glyphicon-pencil"></span></a>
						
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
			{!! $persons->render() !!}
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
			if ($("#sel-tipo").val() == 'name')
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