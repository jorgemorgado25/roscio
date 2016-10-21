@extends('app')
@section('title')
	Realizar Inscripción
@endsection
@section('main-content')
<div class="col-md-6 col-md-offset-3">
<h3 class="text-center">Realizar Inscripción</h3><br>
@include('partials.error-message')
<div class="box box-primary">
	<form action="{{ route('inscripciones.store') }}" method="POST" id="form-create">

	<div class="box-header with-border">
		<h3 class="box-title">Datos del Estudiante</h3>
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Cédula del Estudiante</label>
					<input value="{{ $cedula }}" id="txt-cedula-estudiante" name="cedula" type="text" class="form-control text-center input-lg" required>
				</div>
			</div>
		</div>

		<div class="text-center alert alert-danger" id="div-alert">
			<p>Estudiante no registrado</p>
		</div>

			<div id="div-spinner" class="panel text-center">
				<i class="fa fa-spinner fa-spin"></i> Buscando
			</div>

		<div class="row">

			<div class="col-md-6" id="div-nombre-estudiante">
				<div class="box box-success">
					<div class="box-body">
						<label for="">Nombre y Apellido</label>
						<p id="p-nombre-estudiante"></p>
					</div>
				</div>				
			</div>

			<div class="col-md-6" id="div-nombre-representante">
				<div class="box box-danger">
					<div class="box-body">
					<a href="#" title="Actualizar Representante" class="btn btn-sm btn-default pull-right"><span class="glyphicon glyphicon-refresh"></span></a>
						<label for="">Representante </label>
						<p id="p-nombre-representante"></p>

					</div>					
				</div>
			</div>
		</div>
	</div>

	<div class="box-header with-border" style="margin-top:-15px">	
		<h3 class="box-title">Datos Académicos</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Escolaridad</label>
					{!! Form::select('escolaridad_id', $escolaridad, NULL, ['class' => 'form-control']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Mención</label>
					{!! Form::select('mencion_id', $menciones, NULL, ['class' => 'form-control', 'placeholder' => '', 'required' => 'required', 'id' => 'sel-mencion']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Ano</label>
					<select name="ano_id" id="sel_ano" class="form-control" required></select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Sección</label>
					<select name="seccion_id" id="sel_seccion" class="form-control" placeholder="Selccione una seccion" required></select>
				</div>
			</div>
		</div>
	</div>

	<div class="box-footer clearfix">
		{{ csrf_field() }}
		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> &nbsp;Inscribir Estudiante</button>
	</div>
	</form>
</div>	
</div>
@endsection

@section('scripts')
	<script src="{{ asset('/js/inscripciones-create.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/buscar-estudiante-ci.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/buscar-persona-ci.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/buscar-persona-id.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/buscar-anos.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/buscar-secciones.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/mencion-ano-seccion.js') }}" type="text/javascript"></script>
@endsection