@extends('app')
@section('title')
	Ver Persona
@endsection
@section('main-content')
<h3>Ver Persona</h3><br>
@include('partials.success-message')
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Datos de la Persona</h3>
	</div>
	<div class="box-body">
		
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Nacionalidad</label>
				<p>{{ $persona->nac }}<p/>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Cédula</label>
				<p>{{ $persona->cedula }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Nombres</label>
				<p>{{ $persona->nombre }}<p/>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Apellidos</label>
				<p>{{ $persona->apellido }}</p>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<div class="pull-right">
			<a href="{{ route('personas.edit', $persona) }}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> &nbsp;Editar</a>
		</div>
	</div>
</div>
@endsection