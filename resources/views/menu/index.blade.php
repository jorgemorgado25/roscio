@extends('app')
@section('title')
	Listado de Platos
@endsection
@section('main-content')

<h3>
<a class="btn btn-primary pull-right btn-sm" href="{{route('menu.create')}}">
	<span class="glyphicon glyphicon-plus"></span>
	Nuevo</a>
Menú del Día</h3><br>	

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

					<div class="row">
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
									<button class="btn btn-xs btn-default pull-right">
										<span class="glyphicon glyphicon-trash"></span>
									</button>
								</div>
								<div class="panel-body">
									<p><b>Plato Principal: </b>@{{ desayunoPlato[2] }}</p>
									<p><b>Jugo: </b>@{{ desayunoPlato[4] }}</p>
									<p><b>Fruta: </b>@{{ desayunoPlato[5] }}</p>
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
									<button class="btn btn-xs btn-default pull-right">
										<span class="glyphicon glyphicon-trash"></span>
									</button>
								</div>
								<div class="panel-body">
									<p><b>Sopa: </b> @{{ almuerzoPlato[1] }}</p>
									<p><b>Plato Principal: </b>@{{ almuerzoPlato[2] }}</p>
									<p><b>Ensalada: </b>@{{ almuerzoPlato[3] }}</p>
									<p><b>Jugo: </b> @{{ almuerzoPlato[4] }}</p>
									<p><b>Fruta: </b> @{{ almuerzoPlato[5] }}</p>
								</div>
							</div>
						</div>
					</div><!-- row -->
				</div><!-- div if -->
			</div><!-- div col-md-9 -->
		</div>
	</div>
</div>

<div class="box box-primary" v-if="desayuno.adding">
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
					<label for="">Plato Principal</label>
					{!! Form::select('platoPrincipal', $principales, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguno', 
						'v-model' => 'desayuno.platoPrincipal'] 
					) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Jugo</label>
					{!! Form::select('jugo', $jugos, NULL, [
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
				<input type="text" class="form-control" v-model="desayuno.cantidad">
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<span class="pull-right">
			<button class="btn btn-primary" @click="saveDesayuno()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
			<button class="btn btn-danger" @click="showAddDesayuno()"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
		</span>
	</div>
</div>

<div class="box box-primary" v-if="almuerzo.adding">
	<div class="box-header with-border">
		Agregar Almuerzo
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="">Sopa</label>
					{!! Form::select('sopas', $sopas, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguno', 
						'v-model' => 'desayuno.sopa'] 
					) !!}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Plato Principal</label>
					{!! Form::select('platoPrincipal', $principales, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguno', 
						'v-model' => 'desayuno.platoPrincipal'] 
					) !!}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Ensalada</label>
					{!! Form::select('jugo', $ensaladas, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguna',  
						'v-model' => 'desayuno.ensalada'] 
					) !!}
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">Jugo</label>
					{!! Form::select('jugo', $jugos, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguno',  
						'v-model' => 'desayuno.jugo'] 
					) !!}
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">Fruta</label>
					{!! Form::select('jugo', $frutas, NULL, [
						'class' => 'form-control',
						'placeholder' => 'Ninguno',  
						'v-model' => 'desayuno.fruta'] 
					) !!}
				</div>
			</div>

			<div class="col-md-12">
				<hr>
				<form class="form-inline">
				<div class="form-group">
				<label for="exampleInputName2">Cantidad de Platos: &nbsp;</label>
				<input type="text" class="form-control" v-model="almuerzo.cantidad">
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<span class="pull-right">
			<button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
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

	function getItem(id, items)
	{
		for (i in items)
		{
			if (items[i]['id'] == id)
			{
				return items[i];
			}
		}
	};

	vm = new Funciones({
		el: 'body',
		data: {
			buscando: false,
			fecha: '',

			desayuno:
			{
				'adding': false, 
				'platoPrincipal': '', 
				'jugo': '', 
				'fruta': '', 
				cantidad: '',
				error: ''
			},
			almuerzo: {
				'adding': false,
				'sopa': '',
				'platoPrincipal': '', 
				'ensalada': '',
				'jugo': '', 
				'fruta': '', 
				cantidad: '',
				error: ''
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
			buscarMenu: function(){
				this.buscando = true;
				this.desayunoPlato[2] = '-';
				this.desayunoPlato[4] = '-';
				this.desayunoPlato[5] = '-';
				this.almuerzoPlato[1] = '-';
				this.almuerzoPlato[2] = '-';
				this.almuerzoPlato[3] = '-';
				this.almuerzoPlato[4] = '-';
				this.almuerzoPlato[5] = '-';
				res_desayuno = [];
				res_almuerzo = [];

				this.desayuno.adding = false;
				this.almuerzo.adding = false;

				this.getMenu(this.fecha).then(function(response)
				{
					this.buscando = false;
					var desayuno = response.data.desayuno;
					this.res_desayuno = desayuno;

					console.log(this.res_desayuno.length);
					for (var i = 0; i < desayuno.length; i++)
					{
						var plato = getItem(desayuno[i]['plato_id'], response.data.platos);
						this.desayunoPlato[plato.categoria_plato_id] = plato.plato;
					}

					var almuerzo = response.data.almuerzo;
					this.res_almuerzo = response.data.almuerzo;
					for (var i = 0; i < almuerzo.length; i++)
					{
						var plato = getItem(almuerzo[i]['plato_id'], response.data.platos);
						this.almuerzoPlato[plato.categoria_plato_id] = plato.plato;
					}
				});
			},
			hayDesayuno: function()
			{
				if (this.res_desayuno.length > 0)
				{
					return true;
				}else{
					return false;
				}
			},
			hayAlmuerzo: function()
			{
				if (this.res_almuerzo.length > 0)
				{
					return true;
				}else{
					return false;
				}
			},
			showAddDesayuno: function()
			{
				this.desayuno.adding = !this.desayuno.adding;
				this.desayuno.platoPrincipal = '';
				this.desayuno.jugo = '';
				this.desayuno.fruta = '';
				this.desayuno.cantidad = '';
			},
			showAddAlmuerzo: function()
			{
				this.almuerzo.adding = !this.almuerzo.adding;
				this.almuerzo.sopa = '';
				this.almuerzo.platoPrincipal = '';
				this.almuerzo.ensalada = '';
				this.almuerzo.jugo = '';
				this.almuerzo.fruta = '';
				this.almuerzo.cantidad = '';
			},
			activarBotonesAdd: function()
			{
				if(this.desayuno.adding || this.almuerzo.adding){
					return true;
				}else{
					return false;
				}
			},
			saveDesayuno: function()
			{
				this.desayuno.error = '';
				if (!this.desayuno.platoPrincipal)
				{
					this.desayuno.error = 'Seleccione un plato principal';
					return false;
				}
				if (!this.desayuno.cantidad)
				{
					this.desayuno.error = 'Escriba la cantidad de platos';
					return false;
				}
			},
			saveAlmuerzo: function()
			{
				this.almuerzo.error = '';
				if (!this.almuerzo.platoPrincipal)
				{
					this.almuerzo.error = 'Seleccione un plato principal';
					return false;
				}
				if (!this.almuerzo.cantidad)
				{
					this.almuerzo.error = 'Escriba la cantidad de platos';
					return false;
				}
			}
		}
	});
</script>
@endsection
