@extends('app')
@section('html_title')
    Bitácora del Sistema
@endsection



@section('main-content')
<h3>Bitácora del Sistema</h3><br>
<div class="box box-primary">
	<div class="box-header with-border">
		Acciones realizadas		
	</div>
	<div class="box-body">
		@if( count($auditorias) > 0)
		<table class="table table-bordered" id="table">
			<thead>
			<tr>
				<th>Nombre y Apellido</th>
				<th>Login</th>
				<th>Descripcion</th>
				<th>Fecha - Hora</th>
			</tr>
			</thead>
			<tbody>
			@foreach($auditorias as $auditoria)
				<tr>
					<td>{{ $auditoria->user->full_name }}</td>
					<td>{{ $auditoria->user->login }}</td>
					<td>{{ $auditoria->description }}</td>
					<td>{{ $auditoria->fecha }}</td>
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
			{!! $auditorias->render() !!}
		</div>
	</div>
</div>	
@endsection