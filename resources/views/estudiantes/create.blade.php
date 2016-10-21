@extends('app')
@section('css')
	<style type="text/css">
		input
		{
			text-transform: uppercase;
		}
	</style>
@endsection
@section('title')
	Registrar Estudiante
@endsection
@section('main-content')
	<h3>Registrar Estudiante</h3>	
	<div class="progress progress-sm active">
		<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
		</div>
	</div>

	@include('partials.validation-errors')
	<div class="alert alert-danger text-center"></div>
	<form action="{{ route('estudiantes.store') }}" method="POST" id="form-create">
		@include('estudiantes.partials.datos-estudiante-create')
		@include('estudiantes.partials.datos-madre-create')
		@include('estudiantes.partials.datos-padre-create')
		@include('estudiantes.partials.datos-representante-create')
		{{ csrf_field() }}
	</form>
@endsection
@section('scripts')
	<script src="{{ asset('/js/estudiantes-create.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/buscar-estudiante-ci.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/buscar-persona-ci.js') }}" type="text/javascript"></script>
@endsection