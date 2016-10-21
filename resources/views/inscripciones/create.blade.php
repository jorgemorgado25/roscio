@extends('app')
@section('title')
	Realizar Inscripción
@endsection
@section('main-content')
<div class="col-md-6 col-md-offset-3">
<h3 class="text-center">Realizar Inscripción</h3><br>
@include('partials.error-message')
<div class="box box-primary" id="app">
	<form method="POST" id="form-create" action="{{ route('inscripciones.store') }}">
	<div class="box-header with-border">
		<h3 class="box-title">Datos del Estudiante</h3>
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Cédula del Estudiante</label>
					<input value="{{ $cedula }}" 
					id="txt-cedula-estudiante" 
					name="cedula" 
					type="text" 
					v-model="estudiante.cedula" 
					@focusout="buscarEst()"
					class="form-control text-center input-lg">
				</div>
			</div>
		</div>

		<div v-if="error" class="text-center alert alert-danger" id="div-alert">
			<p>@{{ error }}</p>
		</div>

			<div v-if="buscando" id="div-spinner" class="panel text-center">
				<i class="fa fa-spinner fa-spin"></i> Buscando
			</div>

		<div class="row" v-if="estudiante.nombre">
			<div class="col-md-6" id="div-nombre-estudiante">
				<div class="box box-success">
					<div class="box-body">
						<label for="">Nombre y Apellido</label>
						<p id="p-nombre-estudiante">@{{ estudiante.nombre }} @{{ estudiante.apellido }}</p>
					</div>
				</div>				
			</div>

			<div class="col-md-6" id="div-nombre-representante">
				<div class="box box-danger">
					<div class="box-body">
					<a href="#" title="Actualizar Representante" class="btn btn-sm btn-default pull-right"><span class="glyphicon glyphicon-refresh"></span></a>
						<label for="">Representante </label>
						<p id="p-nombre-representante">@{{ representante.nombre }} @{{ representante.apellido }}</p>

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
					{!! Form::select('mencion_id', $menciones, NULL, [
					'class' => 'form-control', 
					'placeholder' => '', 
					'required' => 'required', 
					'id' => 'sel-mencion', 
					'v-model' => 'mencion_id', 
					'@change' => 'buscarAno()']
					) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Ano</label>
					<select name="ano_id" id="sel_ano" class="form-control" v-model="ano_id" @change='buscarSeccion()'>
						<option 
							v-for = "(key, value) in anos" 
							value = "@{{key}}">
							@{{ value }}
						</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Sección</label>
					<select name="seccion_id" 
						id="sel_seccion" 
						class="form-control" 
						placeholder="Selccione una seccion" 
						v-model="seccion_id"
						>
						<option 
							v-for = "(key, value) in secciones" 
							value = "@{{key}}">
							@{{ value }}
						</option>
					</select>
				</div>
			</div>
		</div>
	</div>

	<div class="box-footer clearfix">
		{{ csrf_field() }}
		<button type="submit" :disabled="formValid()" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> &nbsp;Inscribir Estudiante</button>
	</div>
	</form>
</div>	
</div>
@endsection

@section('scripts')

<script src="{{ asset('/js/vue-functions.js') }}"></script>
<script>
	vm = new Funciones({
		el: 'body',
		data: {
			mencion_id: '',
			ano_id: '',
			seccion_id: '',
			anos: {},
			secciones: {},
			buscando: false,
			error: '',
			estudiante: { 'cedula': '', nombre: '', apellido: '' },
			representante: {'nombre': '', apellido: ''}
		},
		methods: {
			buscarAno: function ()
			{
				this.ano_id = '';
				this.seccion_id = '';
				this.secciones = {};
				this.buscarAnos(this.mencion_id).then(function(response)
				{
					console.log(response.data);
					this.anos = response.data.anos;
				});
			},
			buscarSeccion: function ()
			{
				this.buscarSecciones(this.ano_id).then(function(response)
				{
					console.log(response.data.secciones);
					this.secciones = response.data.secciones;
				});
			},
			registrarInscripcion: function()
			{
				console.log('hola');
			},
			buscarEst: function ()
			{
				this.buscarEstudianteCedula(this.estudiante.cedula).then(function(response)
				{
					if(response.data.created){
						console.log(response.data.estudiante);
						this.estudiante.nombre = response.data.estudiante.nombre;
						this.estudiante.apellido = response.data.estudiante.apellido;
						this.error = '';
						this.buscarPersonaId(response.data.persona_id)
						.then(function(response){
							console.log(response.data.persona);
							this.representante.nombre = response.data.persona.nombre;
							this.representante.apellido = response.data.persona.apellido;
						});
					}else
					{
						this.error = 'La Cédula no está registrada';
						this.estudiante.nombre = '';
						this.estudiante.apellido = '';
					}					
				});
			},
			formValid: function()
			{
				if (this.estudiante.nombre && this.seccion_id)
				{
					return false;
				}else
				{
					return true;
				}
			}
		}
	});
</script>
@endsection