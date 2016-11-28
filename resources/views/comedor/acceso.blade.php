@extends('app')
@section('html_title')
    Docentes
@endsection 
@section('main-content')

<div class="col-md-8 col-md-offset-2">
	<h2 class="text-center">Acceso a Comedor</h2><br>

	<h3>Tipo de Ingreso: @{{ tipoIngreso }}</h3><br>


	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_1" data-toggle="tab"><i class="glyphicon glyphicon-log-in"></i> &nbsp;Cédula</a></li>
			<li><a href="#tab_2" data-toggle="tab"><i class="fa fa-barcode"></i> &nbsp;Código de Barras</a></li>
		</ul>
		<div class="tab-content">
		<div class="tab-pane active" id="tab_1">
			<form id="form-codigo" action="" @submit.prevent="ingresarCedula" autocomplete="off">
			<div class="form-group">

				<p class="alert alert-success text-center" v-if="cedula.ha_ingresado">
					Registro generado satisfactoriamente
				</p>
				
				<p class="alert alert-danger text-center" v-if="!cedula.val && cedula.buscando">	Ingresa la cédula
				</p>

				<p class="alert alert-danger text-center" v-if="cedula.error.message">
					@{{ cedula.error.message }}
				</p>

				<label for="">Cédula: </label>
				<input type="text" v-model='cedula.val' class="form-control text-center input-lg" id="txt-cedula" autocomplete="off" autofocus>
				<br>
				<button type="submit" class="btn btn-primary">Ingresar</button>
			</div>
			</form>
		</div>
		<!-- /.tab-pane -->
		<div class="tab-pane" id="tab_2">
			<form id="form-cedula" action="" @submit.prevent="ingresarCodigo"autocomplete="off">
			<div class="form-group">
				<label for="">Código de Barras: </label>
				<input type="text" v-model='codigo' class="form-control text-center input-lg" id="txt-codigo" autocomplete="off">
				<button class="hidden" type="submit">Enviar</button>
			</div>
			</form>
			
		</div>
		<!-- /.tab-pane -->
		</div>
		<!-- /.tab-content -->
	</div>
	<!-- nav-tabs-custom -->

	<div v-if="!buscandoMenu">
		<h4>Menú del día</h4>	
		<div v-if="tipo_ingreso == 1 && hayDesayuno()" class="panel panel-default">
			<div class="panel-body">
				<p><b>Desayuno: </b>@{{ desayunoPlato[1] }}</p>
				<p><b>Bebida: </b>@{{ desayunoPlato[5] }}</p>
				<p><b>Fruta: </b>@{{ desayunoPlato[6] }}</p>
			</div>
		</div>

		<div v-if="tipo_ingreso == 1 && !hayDesayuno()" class="alert alert-danger text-center">
			No hay desayuno registrado
		</div>

		<div v-if="tipo_ingreso==2 && hayAlmuerzo()" class="panel panel-default">
			<div class="panel-body">
				<p><b>Sopa: </b> @{{ almuerzoPlato[2] }}</p>
				<p><b>Plato Principal: </b>@{{ almuerzoPlato[3] }}</p>
				<p><b>Ensalada: </b>@{{ almuerzoPlato[4] }}</p>
				<p><b>Bebida: </b> @{{ almuerzoPlato[5] }}</p>
				<p><b>Fruta: </b> @{{ almuerzoPlato[6] }}</p>
			</div>
		</div>
		<div v-if="tipo_ingreso == 2 && !hayAlmuerzo()" class="alert alert-danger text-center">
			No hay almuerzo registrado
		</div>
	</div>		

</div>

@endsection

@section('scripts')
<script src="{{ asset('/js/find-estudiante.vue') }}"></script>
<script src="{{ asset('/js/vue-functions.js') }}"></script>
<script>
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e){
		$("input:text" ).focus();
	});

	Vue.directive('focus', {
		bind: function () {
			this.el.focus();
		}
	});
	vm = new Funciones ({
		el: "body",
		data: {
			cedula: {
				val: '',
				buscando: false,
				ha_ingresado: false,
				error: {
					message: ''
				}
			},
			tipo_ingreso: 1,
			fecha: '2016-11-28',
			buscando: true,
			buscandoMenu: true,			
			desayunoPlato: {},
			almuerzoPlato: {},
			res_desayuno: [],
			res_almuerzo: [],
		},
		computed:
		{
			tipoIngreso: function()
			{
				if (this.tipo_ingreso == 1)
				{
					return 'Desayuno';
				}else
				{
					return 'Almuerzo';
				}				
			}
		},
		ready: function(){
			console.log('hola');
			this.buscarMenu();
		},
		methods: {
			buscarMenu: function(){
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

				this.getMenu(this.fecha).then(function(response)
				{
					var desayuno = response.data.desayuno;
					this.res_desayuno = desayuno;
					for (var i = 0; i < desayuno.length; i++)
					{
						var plato = this.getItem(desayuno[i]['plato_id'], response.data.platos);
						console.log(plato.plato);
						this.desayunoPlato[plato.categoria_plato_id] = plato.plato;
					}

					var almuerzo = response.data.almuerzo;
					this.res_almuerzo = response.data.almuerzo;
					for (var i = 0; i < almuerzo.length; i++)
					{
						var plato = this.getItem(almuerzo[i]['plato_id'], response.data.platos);
						this.almuerzoPlato[plato.categoria_plato_id] = plato.plato;
					}
					this.buscandoMenu = false;
				});
			},
			
			ingresarCedula: function()
			{
				
				this.cedula.buscando = true;
				this.cedula.error.message = '';
				this.cedulaFocus();
				this.cedula.ha_ingresado = false;
				//text cedula not empty
				if (this.cedula.val)
				{
					this.buscando = true;
					this.cedula.buscando = false;					
					this.buscarEstudiante().then(function(response)
					{
						//Cédula registrada
						if (response.data.created)
						{
							//Intenta registrar ingreso
							this.registrarIngreso(response.data.estudiante.id)
							.then(function(response)
							{
								console.log(response.data);
								if(response.data.error)
								{
									//hubo error
									this.cedula.error.message = response.data.message;
								}else
								{
									this.cedula.ha_ingresado = true;
								}
								this.buscando = false;
								parent.document.getElementById("txt-cedula").focus();
							});
						}else
						{
							//Cédula no está registrada
							this.cedula.error.error = true;
							this.cedula.error.message = 'La cédula no está registrada.';
							this.buscando = false;
						}
						this.cedula.val = '';						
					});
					vm.cedulaFocus();
				}
			},
			ingresarCodigo: function ()
			{
				//this.codigo = '';
			},
			buscarEstudiante: function ()
			{
				return this.$http.get('/buscar_estudiante_ci/' + this.cedula.val)
				.then(function(response)
				{
					return Promise.resolve(response);
				});
			},
			registrarIngreso: function (id)
			{
				return this.$http.post('/comedor/postRegistrarIngreso', {'id': id})
				.then(function(response)
				{
					return Promise.resolve(response);
				});
			},
			cedulaFocus: function(){
				document.getElementById('txt-cedula').focus();
			}
		}
	})
</script>
@endsection