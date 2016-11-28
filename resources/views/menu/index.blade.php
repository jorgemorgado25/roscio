@extends('app')
@section('title')
	Listado de Platos
@endsection
@section('main-content')

<h3>Menú del Día</h3><br>	

<div class="box box-primary">
	<div class="box-header with-border">
		Seleccione una Fecha
	</div>

	<div class="box-body">
		<br>
		<div class="row">
			<div class="col-md-3">
				<div class="input-group date">
	                  <div class="input-group-addon">
	                    <i class="fa fa-calendar"></i>
	                  </div>
	                  <input type="text" v-model="fecha" class="form-control input-lg" id="datepicker" readonly='true'>
	                </div>
			</div>
			<div class="col-md-9">

				<div v-if="buscando" class="panel panel-default">
					<div class="panel-body">
						<p class="text-center"><i class="fa fa-spinner fa-spin fa-4x"></i></p>
					</div>
				</div>
				
				<div v-if="!fecha" class="alert alert-info text-center" role="alert">Seleccione una Fecha</div>

				<div v-if="fecha">

					<div class="row" v-if="!buscando">
						<div class="col-md-6">
							<div v-if="!hayDesayuno()">
								<p class="alert alert-danger text-center">No hay desayuno</p>
								<button 
									class="btn btn-xs btn-default pull-right" 
									:disabled="activarBotonesAdd()"
									@click="showAddDesayuno()">
									<span class="glyphicon glyphicon-plus"></span> &nbsp; Agregar
								</button>
							</div>

							<div v-if="hayDesayuno()" class="panel panel-default">
								<div class="panel-heading">
									Desayuno
									<button class="btn btn-xs btn-default pull-right" @click="eliminarMenu(1)">
										<span class="glyphicon glyphicon-trash"></span>
									</button>
								</div>
								<div class="panel-body">
									<p><b>Desayuno: </b>@{{ desayunoPlato[1] }}</p>
									<p><b>Bebida: </b>@{{ desayunoPlato[5] }}</p>
									<p><b>Fruta: </b>@{{ desayunoPlato[6] }}</p>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div v-if="!hayAlmuerzo()">
								<p class="alert alert-danger text-center">No hay almuerzo</p>
								<button 
									class="btn btn-xs btn-default pull-right"
									@click="showAddAlmuerzo()"
									:disabled="activarBotonesAdd()"
									>
									<span class="glyphicon glyphicon-plus"></span> &nbsp; Agregar
								</button>
							</div>

							<div v-if="hayAlmuerzo()" class="panel panel-default">		
								<div class="panel-heading">
									Almuerzo
									<button class="btn btn-xs btn-default pull-right" @click="eliminarMenu(2)">
										<span class="glyphicon glyphicon-trash"></span>
									</button>
								</div>
								<div class="panel-body">
									<p><b>Sopa: </b> @{{ almuerzoPlato[2] }}</p>
									<p><b>Plato Principal: </b>@{{ almuerzoPlato[3] }}</p>
									<p><b>Ensalada: </b>@{{ almuerzoPlato[4] }}</p>
									<p><b>Bebida: </b> @{{ almuerzoPlato[5] }}</p>
									<p><b>Fruta: </b> @{{ almuerzoPlato[6] }}</p>
								</div>
							</div>
						</div>
					</div><!-- row -->
				</div><!-- div if -->
			</div><!-- div col-md-9 -->
		</div>
	</div>
</div>

<div class="box box-primary" v-show="desayuno.adding">
	<div class="box-header with-border">
		Agregar Desayuno
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
				<p v-if="desayuno.error" class="alert alert-danger text-center">@{{ desayuno.error }}</p>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Desayuno</label>
					{!! Form::select('desayuno', $desayunos, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguno', 
						'v-model' => 'desayuno.desayuno'] 
					) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Bebida</label>
					{!! Form::select('jugo', $bebidas, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguno',  
						'v-model' => 'desayuno.jugo'] 
					) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Fruta</label>
					{!! Form::select('jugo', $frutas, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguna',  
						'v-model' => 'desayuno.fruta'] 
					) !!}
				</div>
			</div>
			<div class="col-md-12">
				<hr>
				<form class="form-inline">
				<div class="form-group">
				<label for="exampleInputName2">Cantidad de Platos: &nbsp;</label>
				<input type="text" class="form-control" v-model="desayuno.cantidad" maxlength="4" id="txt-cantidad-1">
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<span class="pull-right">
			<button class="btn btn-primary btn-sm" @click="saveDesayuno()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
			<button class="btn btn-danger btn-sm" @click="showAddDesayuno()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
		</span>
	</div>
</div>

<div class="box box-primary" v-show="almuerzo.adding">
	<div class="box-header with-border">
		Agregar Almuerzo
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
				<p v-if="almuerzo.error" class="alert alert-danger text-center">@{{ almuerzo.error }}</p>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">Sopa</label>
					{!! Form::select('sopas', $sopas, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguno', 
						'v-model' => 'almuerzo.sopa'] 
					) !!}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Plato Principal</label>
					{!! Form::select('platoPrincipal', $principales, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguno', 
						'v-model' => 'almuerzo.platoPrincipal'] 
					) !!}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Ensalada</label>
					{!! Form::select('jugo', $ensaladas, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguna',  
						'v-model' => 'almuerzo.ensalada'] 
					) !!}
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">Bebida</label>
					{!! Form::select('jugo', $bebidas, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguno',  
						'v-model' => 'almuerzo.jugo'] 
					) !!}
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">Fruta</label>
					{!! Form::select('jugo', $frutas, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguno',  
						'v-model' => 'almuerzo.fruta'] 
					) !!}
				</div>
			</div>

			<div class="col-md-12">
				<hr>
				<form class="form-inline">
				<div class="form-group">
				<label for="exampleInputName2">Cantidad de Platos: &nbsp;</label>
				<input type="text" class="form-control" v-model="almuerzo.cantidad" maxlength=4 id="txt-cantidad-2">
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<span class="pull-right">
			<button class="btn btn-primary btn-sm" @click="saveAlmuerzo()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
			<button class="btn btn-danger btn-sm" @click="showAddAlmuerzo()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
		</span>
	</div>
</div>
@endsection
	
@section('scripts')
<script src="{{ asset('/js/vue-functions.js') }}"></script>
<script>

	$('#datepicker').datepicker({
		format: 'dd-mm-yyyy',
		language: 'es',
		todayHighlight: true,
		daysOfWeekDisabled: "0,6",
	});	
		
	$('#txt-cantidad-1, #txt-cantidad-2').numeric({
    	allowMinus   : false,
    	allowThouSep : false,
    	allowDecSep: false
    });	

	vm = new Funciones({
		el: 'body',
		data: {
			buscando: false,
			fecha: '',

			desayuno:
			{
				adding: false, 
				desayuno: '', 
				jugo: '', 
				fruta: '', 
				cantidad: '',
				error: '',
				tipo_ingreso_id: 1,
				fecha: ''
			},
			almuerzo: {
				adding: false,
				sopa: '',
				platoPrincipal: '', 
				ensalada: '',
				jugo: '', 
				fruta: '', 
				cantidad: '',
				error: '',
				tipo_ingreso_id: 1,
				fecha: ''
			},
			desayunoPlato: {},
			almuerzoPlato: {},
			res_desayuno: [],
			res_almuerzo: [],
		},
		watch: {
			fecha: function() {
				this.buscarMenu();
			}
		},
		methods: {
			buscarMenu: function()
			{
				this.buscando = true;
				this.desayunoPlato[1] = '-';
				this.desayunoPlato[5] = '-';
				this.desayunoPlato[6] = '-';

				this.almuerzoPlato[2] = '-';
				this.almuerzoPlato[3] = '-';
				this.almuerzoPlato[4] = '-';
				this.almuerzoPlato[5] = '-';
				this.almuerzoPlato[6] = '-';

				res_desayuno = [];
				res_almuerzo = [];

				this.limpiarSelects();

				this.desayuno.adding = false;
				this.almuerzo.adding = false;

				this.getMenu(this.fecha).then(function(response)
				{
					this.buscando = false;
					var desayuno = response.data.desayuno;
					this.res_desayuno = desayuno;

					for (var i = 0; i < desayuno.length; i++)
					{
						var plato = this.getItem(desayuno[i]['plato_id'], response.data.platos);
						this.desayunoPlato[plato.categoria_plato_id] = plato.plato;
					}

					var almuerzo = response.data.almuerzo;
					this.res_almuerzo = response.data.almuerzo;
					for (var i = 0; i < almuerzo.length; i++)
					{
						var plato = this.getItem(almuerzo[i]['plato_id'], response.data.platos);
						this.almuerzoPlato[plato.categoria_plato_id] = plato.plato;
					}
				});
			},
			
			showAddDesayuno: function()
			{
				this.desayuno.adding = !this.desayuno.adding;
				this.limpiarSelects();
				
			},
			showAddAlmuerzo: function()
			{
				this.almuerzo.adding = !this.almuerzo.adding;
				this.limpiarSelects();
			},

			limpiarSelects: function()
			{
				this.desayuno.desayuno = '';
				this.desayuno.jugo = '';
				this.desayuno.fruta = '';
				this.desayuno.cantidad = '';

				this.almuerzo.sopa = '';
				this.almuerzo.platoPrincipal = '';
				this.almuerzo.ensalada = '';
				this.almuerzo.jugo = '';
				this.almuerzo.fruta = '';
				this.almuerzo.cantidad = '';
			},

			activarBotonesAdd: function()
			{
				if (this.desayuno.adding || this.almuerzo.adding){
					return true;
				}else{
					return false;
				}
			},
			saveDesayuno: function()
			{
				this.desayuno.error = '';
				this.desayuno.fecha = this.fecha;
				if (! this.desayuno.desayuno)
				{
					this.desayuno.error = 'Seleccione un plato para el desayuno';
					return false;
				}
				if (! this.desayuno.cantidad)
				{
					this.desayuno.error = 'Escriba la cantidad de platos';
					return false;
				}
				data = this.desayuno;

				this.$http.post('/menu/saveDesayuno/', data)
				.then(function(response)
				{
					//console.log(response.data.desayuno['cantidad'])
					this.buscarMenu();
		        });
		        
			},
			saveAlmuerzo: function()
			{
				this.almuerzo.error = '';
				this.almuerzo.fecha = this.fecha;
				if (! this.almuerzo.platoPrincipal)
				{
					this.almuerzo.error = 'Seleccione un plato principal para el almuerzo';
					return false;
				}
				if (! this.almuerzo.cantidad)
				{
					this.almuerzo.error = 'Escriba la cantidad de platos';
					return false;
				}
				data = this.almuerzo;
				this.$http.post('/menu/saveAlmuerzo/', data)
				.then(function(response)
				{
					this.buscarMenu();
		        });
			},
			deleteDesayuno: function()
			{

			},
			eliminarMenu: function(tipo_ingreso_id)
			{
				data = {fecha: this.fecha, tipo_ingreso_id: tipo_ingreso_id};
				console.log(data);
				this.$http.post('/menu/postEliminar', data)
				.then(function(response)
				{
					this.buscarMenu();
		        });
			}
		}
	});
</script>
@endsection