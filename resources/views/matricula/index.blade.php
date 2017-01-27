@extends('app')
@section('title')
	Listado de Matricula
@endsection
@section('main-content')
<div class="row">
<div class="col-md-12">
	<h3>Listado de Matrículas</h3><br>
	@include('partials.error-message')
	@include('partials.success-message')
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
						placeholder="Seleccione una seccion" 
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
					<button :disabled="formValid()" style="margin-top:2.2em" class="btn btn-sm btn-primary" @click="buscarMatricula()">
						<span class="glyphicon glyphicon-search"></span>
					</button>				
				</div>
			</div>		
		</div>
		<div class="box-body with-border">
			<div v-if="error">
				<p  class="alert alert-danger text-center">@{{ error }}</p>
				<span>
					<button @click="createMatricula()" class="btn btn-default pull-right"><span class="glyphicon glyphicon-upload"></span> &nbsp;Cargar Matrícula</button>
				</span>				
			</div>			
			<p class="text-center" v-if="buscando">
				<i class=" text-center fa fa-spinner fa-spin fa-4x"></i>
			</p>
			<div v-if="matriculas" v-if="matriculas.length > 1">
				<button class="btn btn-sm btn-primary">
					<span class="glyphicon glyphicon-plus"></span>
					Agregar Estudiante
				</button>
				<button class="btn btn-sm btn-primary">
					<span class="glyphicon glyphicon-print"></span>
					Imprimir
				</button>
				<span class="pull-right">
					<button class="btn btn-sm btn-danger" onclick="eliminar_nomina()"><span class="glyphicon glyphicon-trash"></span> Eliminar Nómina</button>			
				</span>

				<hr>
				<table class="table table-striped" id="table">
					<thead>
					<tr>
						<th>N.</th>
						<th>Cédula</th>
						<th>Nombre del Estudiante</th>
						<th class="text-center" width="140px">Acciones</th>
					</tr>
					</thead>
					<tbody>
					<tr v-for="matricula in matriculas">
						<td>@{{ matricula.n }}</td>
						<td>@{{ matricula.cedula }}</td>
						<td>@{{ matricula.nombre }}</td>
						<td class="text-center">
							<a title="Ver Estudiante" class="btn btn-default btn-sm"
							 href="{{ route('students.index') }}/@{{ matricula.estudiante_id }}">
								<span class="glyphicon glyphicon-search"></span>
							</a>
							<a target="_blank" title="Carnet Estudiantil" href="/matricula/carnet/@{{ matricula.id }}" class="btn btn-default btn-sm">
								<span class="glyphicon glyphicon-credit-card"></span>
							</a>
							<button 
								class="btn btn-default btn-sm" 
								onclick="eliminar_registro( @{{ matricula.id }} )">
								<span class="glyphicon glyphicon-trash"></span></button>
						</td>							
					</tr>
					</tbody>
				</table>
			</div>
			<div id="div-message">
				<p class="alert alert-info text-center">Seleccione una Sección</p>
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

	function eliminar_registro(id)
	{
		
		bootbox.dialog({
		message: "¿Realmente desea eliminar el alumno de la matrícula?",
		title: "<span class='text-danger'><b>Eliminar Registro</b></span>",
		buttons: {
		danger: {
		label: "Aceptar",
		className: "btn-default",
		callback: function()
		{
			vm.eliminarRegistro(id);
		}
		},
		main: {
		label: "Cancelar",
		className: "btn-primary",
		callback: function() {

		}
		}
		}
		});
	}
	function eliminar_nomina()
	{
		bootbox.dialog({
		message: "¿Realmente desea eliminar la matrícula?",
		title: "<span class='text-danger'><b>Eliminar Matrícula</b></span>",
		buttons: {
		danger: {
		label: "Aceptar",
		className: "btn-default",
		callback: function()
		{
			console.log('eliminar matrícula');
			vm.eliminarMatricula();
		}
		},
		main: {
		label: "Cancelar",
		className: "btn-primary",
		callback: function() {

		}
		}
		}
		});
	}
	var vm = new Funciones({
		el: 'body',
		data: {
			escolaridad_id: '',
			mencion_id: '',
			ano_id: '',
			seccion_id: '',
			matricula_id: '',
			anos: {},
			secciones: {},
			buscando: false,
			error: '',
			matriculas: ''
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
			buscarMatricula: function()
			{
				$("#div-message").hide();
				this.error = '';
				this.matriculas = '';
				this.buscando = true;
				this.getBuscarMatriculaSeccion(this.escolaridad_id, this.seccion_id)
				.then(function(response)
				{
					this.buscando = false;
					console.log(response.data.matricula);					
					if(response.data.matricula)
					{
						this.matriculas = response.data.matricula;
						this.error = '';
						this.matricula_id = response.data.matricula.id;
					}else{
						this.error = 'No se ha cargado la Matrícula';
					}
				});
			},
			formValid: function() {
				if (this.seccion_id && this.escolaridad_id) { return false } else { return true};
			},
			clearEstudiantes: function(){
				this.estudiantes = '';
			},
			createMatricula: function(){
				window.location = '/matricula/cargar/' + this.escolaridad_id +'/'+ this.mencion_id +'/'+ this.ano_id +'/'+ this.seccion_id;
			},
			eliminarMatricula: function()
			{
				data = {escolaridad_id: this.escolaridad_id, seccion_id: this.seccion_id};	
				this.$http.post('/matricula/postEliminar', data)
				.then(function(response)
				{
					this.buscarMatricula();
		        });
			},
			eliminarRegistro: function(id)
			{
				data = {register_id: id}
				this.$http.post('/matricula/postEliminarRegistro', data)
				.then(function(response)
				{
					this.buscarMatricula();
				});
			}
		}
	});

</script>
@endsection
