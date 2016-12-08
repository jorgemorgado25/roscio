@extends('app')
@section('title')
	Listado de Inscripciones
@endsection
@section('main-content')
<div class="row">
<div class="col-md-12">
	<h3>Listado de Inscripciones</h3><br>
	@include('partials.error-message')
	<div class="box box-primary">
		<div class="box-header with-border">
			<div class="row">
				<div class="col-xs-3">
					<div class="form-group">
						<label for="">Escolaridad</label>
						{!! Form::select('escolaridad_id', $escolaridades, NULL, [
						'class' => 'form-control', 
						'v-model' => 'escolaridad_id']) !!}	
					</div>				
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="">Mención</label>
						{!! Form::select('mencion_id', $menciones, NULL, [
							'class' => 'form-control', 
							'id' => 'sel-mencion', 
							'v-model' => 'mencion_id', 
							'@change' => 'buscarAno()']
							) !!}
					</div>				
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="">Año</label>
						<select name="ano_id" id="sel_ano" class="form-control" v-model="ano_id" @change='buscarSeccion()'>
							<option 
							v-for = "(key, value) in anos" 
							value = "@{{key}}">
							@{{ value }}
						</option>
						</select>
					</div>
				</div>
				<div class="col-xs-2">
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
				<div class="col-xs-1">
					<button :disabled="formValid()" style="margin-top:2.2em" class="btn btn-sm btn-primary" @click="buscarInscripcion()">
						<span class="glyphicon glyphicon-search"></span>
					</button>				
				</div>
			</div>		
		</div>
		<div class="box-body with-border">
			<p v-if="error" class="alert alert-danger text-center">@{{ error }}</p>
			<p class="text-center" v-if="buscando">
				<i class=" text-center fa fa-spinner fa-spin fa-4x"></i>
			</p>
			<div v-if="estudiantes" v-if="estudiantes.length > 1">		
				<h4>Estudiantes Inscritos</h4>		
				<table class="table table-striped" id="table">
					<thead>
					<tr>
						<th>Cédula</th>
						<th>Nombre y Apellido</th>
						<th class="text-center" width="120px">Acciones</th>
					</tr>
					</thead>
					<tbody>
					<tr v-for="estudiante in estudiantes">
						<td>@{{ estudiante.cedula }}</td>
						<td>@{{ estudiante.nombre }} @{{ estudiante.apellido }}</td>
						<td class="text-center">
							<a title="Ver Estudiante" class="btn btn-default btn-sm"
							 href="{{route('estudiantes.index')}}/@{{ estudiante.id }}">
								<span class="glyphicon glyphicon-search"></span>
							</a>
							<a title="Carnet del Estudiante" href="#" class="btn btn-default btn-sm">
								<span class="glyphicon glyphicon-credit-card"></span>
							</a>
						</td>							
					</tr>
					</tbody>
				</table>
				<span class="pull-right">
					<button class="btn btn-primary">
						<span class="glyphicon glyphicon-print"></span>
						Imprimir
					</button>
					<button class="btn btn-primary">
						<span class="glyphicon glyphicon-credit-card"></span>
						Listado de Carnets
					</button>	
				</span>
				
			</div>

		</div>
	</div>	
</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('/js/vue-functions.js') }}"></script>
<script src="{{ asset('/js/set-datatable.js') }}"></script>
<script>
	vm = new Funciones({
		el: 'body',
		data: {
			escolaridad_id: '',
			mencion_id: '',
			ano_id: '',
			seccion_id: '',
			anos: {},
			secciones: {},
			buscando: false,
			error: '',
			/*estudiantes: [
				{cedula: '15392404', nombre: 'Jorge', apellido: 'Morgado', id: '1'},
				{cedula: '15392404', nombre: 'Jorge', apellido: 'Morgado', id: '1'}
			]*/
			estudiantes: ''
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
				this.seccion_id = '';
				this.secciones = {};
				this.buscarSecciones(this.ano_id).then(function(response)
				{
					console.log(response.data.secciones);
					this.secciones = response.data.secciones;
				});
			},
			buscarInscripcion: function()
			{
				this.error = '';
				this.estudiantes = '';
				this.buscando = true;
				this.buscarInscripcionesSeccion(this.mencion_id, this.seccion_id)
				.then(function(response)
				{
					this.buscando = false;
					console.log(response.data.estudiantes);
					this.estudiantes = response.data.estudiantes;
					response.data.estudiantes ? this.error = '' : this.error = 'No hay estudiantes inscritos'
				});
			},
			formValid: function(){
				if (this.seccion_id && this.escolaridad_id) { return false } else { return true};
			},
			clearEstudiantes: function(){
				this.estudiantes = '';
			}
		}
	});
</script>
@endsection