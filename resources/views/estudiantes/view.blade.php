@extends('app')
@section('title')
	Ver Estudiante
@endsection
@section('main-content')

<h3>
<div class="pull-right">
			<a title="Inscribir Estudiante" class="btn btn-primary" href="{{ route('inscripciones.create', 'cedula=' . $estudiante->cedula) }}"><span class="glyphicon glyphicon-star"></span> Inscribir Estudiante</a>
		</div>
Ver Estudiante</h3><br>
@include('partials.success-message')
<div class="box box-primary">
	<div class="box-header with-border">
			
		<h3 class="box-title">Datos del Estudiante</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>

	<div class="box-body">
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Nacionalidad</label>
				<p>{{ $estudiante->nac }}<p/>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Cédula</label>
				<p>{{ $estudiante->cedula }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Nombres</label>
				<p>{{ $estudiante->nombre }}<p/>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Apellidos</label>
				<p>{{ $estudiante->apellido }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Género</label>
				<p>{{ $estudiante->genero_normal }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Fecha Nacimiento</label>
				<p>{{ $estudiante->fecha_normal }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Estado Nacimiento</label>
				<p>{{ $estudiante->estado_nac }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Lugar de Nacimiento</label>
				<p>{{ $estudiante->lugar_nac }}</p>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="">Dirección de Habitación</label>
				<p>{{ $estudiante->direccion }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Vive con Madre</label>
				<p>{{ $estudiante->vive_con_la_madre }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Vive con Padre</label>
				<p>{{ $estudiante->vive_con_el_padre }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Talla</label>
				<p>{{ $estudiante->talla }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Peso</label>
				<p>{{ $estudiante->peso }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Grupo Sanguíneo</label>
				<p>{{ $estudiante->grupo_sanguineo }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Enfermedades o Alérgias</label>
				<p>{{ $estudiante->enf_al }}</p>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-primary  pull-right"><span class="glyphicon glyphicon-pencil"></span> &nbsp;Editar</a>
	</div>
</div>

<!-- DATOS DEL REPRESENTANTE -->

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">Datos del Representante</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body">
		<div class="col-md-12">
			<div class="form-group">
				<label for="">Parentesco</label>
				<p>{{ $representante->parentesco }}<p/>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Nacionalidad</label>
				<p>{{ $representante->persona->nac }}<p/>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Cédula</label>
				<p>{{ $representante->persona->cedula }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Nombres</label>
				<p>{{ $representante->persona->nombre }}<p/>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Apellidos</label>
				<p>{{ $representante->persona->apellido }}</p>
			</div>
		</div>
		@if($estudiante->representante == '3')
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Autorización</label>
				<p>{{ $representante->presenta_autorizacion }}<p/>
			</div>
		</div>
		@endif
	</div>
	<div class="box-footer">
		<div class="pull-right">
			<a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> &nbsp;Modificar Representante</a>
			<a href="{{ route('personas.edit', $representante) }}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> &nbsp;Editar</a>
		</div>
	</div>
</div>

<!-- DATOS DE LA MADRE -->

<div class="box box-danger collapsed-box">
	<div class="box-header with-border">
		<h3 class="box-title">Datos de la Madre</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
		</div>
	</div>
	<div class="box-body">
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Nacionalidad</label>
				<p>{{ $estudiante->madre->nac }}<p/>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Cédula</label>
				<p>{{ $estudiante->madre->cedula }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Nombres</label>
				<p>{{ $estudiante->madre->nombre }}<p/>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Apellidos</label>
				<p>{{ $estudiante->madre->apellido }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Fecha de Nacimiento</label>
				<p>{{ $estudiante->madre->fecha_normal }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Correo Electrónico</label>
				<p> {{ $estudiante->madre->email }} &nbsp;</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Profesión</label>
				<p>{{ $estudiante->madre->profesion }} &nbsp;</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Grado de Instrucción</label>
				<p>{{ $estudiante->madre->grado_instruccion }} &nbsp;</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Teléfono</label>
				<p>{{ $estudiante->madre->telefono }} &nbsp;</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Dirección</label>
				<p>{{ $estudiante->madre->direccion }} &nbsp;</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Difunta</label>
				<p>{{ $estudiante->madre->es_difunta }} &nbsp;</p>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<a href="{{ route('personas.edit', $estudiante->madre->id) }}" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-pencil"></span> &nbsp;Editar</a>
	</div>
</div>

<!-- DATOS DEL PADRE -->

<div class="box box-info collapsed-box">
	<div class="box-header with-border">
		<h3 class="box-title">Datos del  Padre</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
		</div>
	</div>
	<div class="box-body">
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Nacionalidad</label>
				<p>{{ $estudiante->padre->nac }}<p/>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Cédula</label>
				<p>{{ $estudiante->padre->cedula }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Nombres</label>
				<p>{{ $estudiante->padre->nombre }}<p/>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Apellidos</label>
				<p>{{ $estudiante->padre->apellido }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Fecha de Nacimiento</label>
				<p>{{ $estudiante->padre->fecha_normal }}</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Correo Electrónico</label>
				<p> {{ $estudiante->padre->email }} &nbsp;</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Profesión</label>
				<p>{{ $estudiante->padre->profesion }} &nbsp;</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Grado de Instrucción</label>
				<p>{{ $estudiante->padre->grado_instruccion }} &nbsp;</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Teléfono</label>
				<p>{{ $estudiante->padre->telefono }} &nbsp;</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Dirección</label>
				<p>{{ $estudiante->padre->direccion }} &nbsp;</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Difunto</label>
				<p>{{ $estudiante->padre->es_difunto }} &nbsp;</p>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<a href="{{ route('personas.edit', $estudiante->padre->id) }}" class="btn btn-primary  pull-right"><span class="glyphicon glyphicon-pencil"></span> &nbsp;Editar</a>
	</div>
</div>

@endsection