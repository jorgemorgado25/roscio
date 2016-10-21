@extends('app')
@section('title')
	Listado de Personas
@endsection
@section('main-content')
<h3>Listado de Personas</h3><br>
<div class="box box-primary">
	<div class="box-header with-border">
		Hay <span id="total-users">{{ count($personas) }}</span> personas registradas
	</div>
	<div class="box-body">
		<table class="table table-bordered" id="table">
			<thead>
			<tr>
				<th>Cédula</th>
				<th>Nombre y Apellido</th>
				<th width="150px">Acciones</th>
			</tr>
			</thead>
			<tbody>
			@foreach($personas as $persona)
				<tr>
					<td>{{ $persona->cedula }}</td>
					<td>{{ $persona->full_name }}</td>
					<td>
						<a class="btn btn-default btn-sm" href="{{ route('personas.show', $persona) }}"><span class="glyphicon glyphicon-search"></span></a>
						<a class="btn btn-default btn-sm" href="{{ route('personas.edit', $persona) }}"><span class="glyphicon glyphicon-pencil"></span></a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	<div class="box-footer clearfix">
		<div class="pull-right">
			{!! $personas->render() !!}
		</div>
	</div>
</div>	
@endsection