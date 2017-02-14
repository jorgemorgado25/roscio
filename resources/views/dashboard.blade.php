<style>
	.option
	{
		border:1px solid #ccc;
		display: inline;
		padding: 15px;
		border-radius: 5px;		
	}
</style>
@extends('app')
@section('html_title')
    Panel de Administración
@endsection
@section('main-content')
<div class="col-md-8 col-md-offset-2">
	<h3>Panel de Administración</h3><br>
	<div class="box box-primary">
		@if(Auth::user()->hasRole('comedor'))
			<div class="box-header with-border">
				<h4 class="text-primary">Comedor</h4>
			</div>
			<div class="box-body">
				<a class="btn btn-app" href="{{ route('comedor.acceso') }}">
					<i class="glyphicon glyphicon-log-in"></i> Acceso
				</a>
				<a class="btn btn-app" href="{{ route('menu.index') }}">
					<i class="glyphicon glyphicon-calendar"></i> Menú del día
				</a>
				<a class="btn btn-app" href="{{ route('platos.index') }}">
					<i class="glyphicon glyphicon-piggy-bank"></i> Platos
				</a>
				<a class="btn btn-app" href="{{ route('rubros.index') }}">
					<i class="glyphicon glyphicon-grain"></i> Rubros
				</a>
			</div>
		@endif
		@if(Auth::user()->hasRole('inscripciones'))

			<div class="box-header with-border">
				<h4 class="text-primary">Matrícula</h4>
			</div>
			<div class="box-body">
				<a class="btn btn-app" href="{{ route('students.index') }}">
					<i class="fa fa-child"></i> Estudiantes
				</a>

				<a class="btn btn-app" href="{{ route('persons.index') }}">
					<i class="fa fa-child"></i> Personas
				</a>

				<a class="btn btn-app" href="{{ route('matricula.index') }}">
					<i class="glyphicon glyphicon-th"></i> Matrícula
				</a>
			</div>

			<div class="box-header with-border">
				<h4 class="text-primary">Inscripciones</h4>
			</div>
			<div class="box-body">
				<a class="btn btn-app" href="{{ route('estudiantes.index') }}">
					<i class="fa fa-child"></i> Estudiantes
				</a>
				
				<a class="btn btn-app" href="{{ route('inscripciones.index') }}">
					<i class="glyphicon glyphicon-list"></i> Inscripciones
				</a>
				<a class="btn btn-app" href="{{ route('inscripciones.create') }}">
					<i class="glyphicon glyphicon-star"></i> Inscribir
				</a>
				
			</div>
		@endif
		<div class="box-header with-border">
			<h4 class="text-primary">Reportes</h4>
		</div>
		<div class="box-body">
			<a class="btn btn-app" href="{{ route('reportes.reporteDiario') }}">
				<i class="fa fa-child"></i> Ingresos del Día
			</a>

			<a class="btn btn-app" href="{{ route('reportes.entradasMes') }}">
				<i class="fa fa-pie-chart"></i> Ingresos Mensuales
			</a>
		</div>
		@if(Auth::user()->isAdmin)
			<div class="box-header with-border">
				<h4 class="text-primary">Administración del Sistema</h4>
			</div>
			<div class="box-body">
				<a class="btn btn-app" href="{{ route('escolaridades.index') }}">
					<i class="glyphicon glyphicon-flag"></i> Escolaridades
				</a>
				<a class="btn btn-app" href="{{ route('users.index') }}">
					<i class="fa fa-users"></i> Usuarios
				</a>
				<a class="btn btn-app" href="{{ route('auditoria.index') }}">
					<i class="glyphicon glyphicon-map-marker"></i> Bitácora del Sistema
				</a>
				<a class="btn btn-app" href="http://localhost/respaldar" target="_blank">
					<i class="glyphicon glyphicon-save-file"></i> Respaldar DB
				</a>
			</div>
		@endif
	<!-- /.box-body -->
	</div>
</div>
@endsection