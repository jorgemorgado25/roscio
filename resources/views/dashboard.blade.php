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
		<div class="box-header">
			<h4 class="text-primary">Acceso a Comedor</h4>
		</div>
		<div class="box-body">
			<a class="btn btn-app" href="{{ route('comedor.acceso') }}">
				<i class="glyphicon glyphicon-log-in"></i> Acceso
			</a>
		</div>
		<div class="box-header">
			<h4 class="text-primary">Inscripciones</h4>
		</div>
		<div class="box-body">
			<a class="btn btn-app" href="{{ route('estudiantes.index') }}">
				<i class="fa fa-child"></i> Estudiantes
			</a>
			<a class="btn btn-app" href="{{ route('inscripciones.create') }}">
				<i class="glyphicon glyphicon-star"></i> Inscribir
			</a>
			<a class="btn btn-app" href="{{ route('inscripciones.index') }}">
				<i class="glyphicon glyphicon-list"></i> Listado
			</a>
		</div>
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
		</div>
	<!-- /.box-body -->
	</div>
</div>
@endsection