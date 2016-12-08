@extends('app')
@section('html_title')
    Docentes
@endsection 
@section('main-content')

<div class="col-md-8 col-md-offset-2">
	<h2 class="text-center">Acceso a Comedor</h2><br>

	<h4>Tipo de Ingreso: @{{ tipoIngreso }}</h4><br>


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
				<input type="text" v-model='cedula.val' class="form-control text-center input-lg" id="txt-cedula" autocomplete="off" autofocus >
				<br>

				<button type="submit" class="btn btn-primary">Ingresar</button>
			</div>			
			</form>
			<p class="text-center" v-if="buscandoCedula">
				<i class=" text-center fa fa-spinner fa-spin fa-4x"></i>
			</p>
		</div>
		<!-- /.tab-pane -->
		<div class="tab-pane" id="tab_2">
			<form id="form-cedula" action="" @submit.prevent="ingresarCodigo"autocomplete="off">
			<div class="form-group">
				<label for="">Código de Barras: </label>
				<input type="text" v-model='codigo' class="form-control text-center input-lg" id="txt-codigo" autocomplete="off" :disabled="!HayMenu()">
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
				<hr>
				<h4>Totales</h4>
				<div class="row">
					<div class="col-md-4">
						<p><b>Platos para hoy: </b> @{{ cantidad_platos }}</p>
					</div>
					<div class="col-md-4">
						<p><b>Entradas Registradas: </b> @{{ total_entradas }}</p>
					</div>
					<div class="col-md-4">
						<p>
						<b>Platos disponibles: </b>
						<span :style="calcularEstilos()">@{{ cantidad_platos - total_entradas }}</span>
						</p>
					</div>
				</div>
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
				<hr>
				<h4>Totales</h4>
				<div class="row">
					<div class="col-md-4">
						<p><b>Platos para hoy: </b> @{{ cantidad_platos }}</p>
					</div>
					<div class="col-md-4">
						<p><b>Entradas Registradas: </b> @{{ total_entradas }}</p>
					</div>
					<div class="col-md-4">
						<p>
						<b>Platos disponibles: </b>
						<span :style="calcularEstilos()">@{{ cantidad_platos - total_entradas }}</span>
						</p>
					</div>
				</div>
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
			cantidad_platos: '',
			total_entradas: '',
			tipo_ingreso: '',
			fecha: '',
			buscando: true,
			buscandoMenu: true,			
			desayunoPlato: {},
			almuerzoPlato: {},
			res_desayuno: [],
			res_almuerzo: [],
			varHayMenu: false,
			buscandoCedula: false
		},
		computed: {
			tipoIngreso: function(){
				this.tipo_ingreso == 1 ? t = 'Desayuno' : t = 'Almuerzo';
				return t;
			}
		},
		ready: function() {
			var d = new Date();
			var hora = d.getHours();
			var mes = d.getMonth() + 1
			this.fecha = d.getFullYear() + '-' + mes + '-' + d.getDate();
			hora <= 10 ? this.tipo_ingreso = 1 : this.tipo_ingreso = 2;
			this.buscarMenu();
			this.cantidadPlatos();
			this.entradasRegistradas();
		},
		methods: {
			calcularEstilos: function(){
				if(this.cantidad_platos - this.total_entradas > 51){
					'font-color:green'
				}
			},
			HayMenu: function()
			{				
				var hay = false
				if (this.tipo_ingreso == 1 && this.res_desayuno.length > 0)
				{
					hay = true;
				}

				if (this.tipo_ingreso == 2 && this.res_almuerzo.length > 0)
				{
					hay = true;
				}
				return hay;
			},
			buscarMenu: function()
			{				
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
					this.cedulaFocus();
					parent.document.getElementById('txt-cedula').focus();
				});
			},

			entradasRegistradas: function()
			{
				this.$http.get('/comedor/getEntradasRegistradas/' + this.fecha +'/'+ this.tipo_ingreso).then(function(response)
				{
					this.total_entradas = response.data.total;
				});
			},

			cantidadPlatos: function()
			{
				this.$http.get('/menu/getCantidadPlatos/' + this.fecha +'/'+ this.tipo_ingreso).then(function(response)
				{
					this.cantidad_platos = response.data.cantidad;
				});
			},
			
			ingresarCedula: function()
			{				
				this.cedula.error.message = '';
				this.cedulaFocus();
				this.cedula.ha_ingresado = false;
				
				//text cedula not empty
				if (this.cedula.val)
				{
					if(!this.HayMenu()){
						return false;
					}
					this.buscandoCedula = true;
					this.buscarEstudiante().then(function(response)
					{
						//Cédula registrada
						if (response.data.created)
						{
							//Intenta registrar ingreso
							data = {
								student_id: response.data.student.id, 
								tipo_ingreso: this.tipo_ingreso
							}
							this.$http.post('/comedor/postRegistrarEntrada', data)
							.then(function(response)
							{
								if (response.data.error)
								{
									//hubo error
									this.cedula.error.message = response.data.message;
								}else
								{
									this.cedula.ha_ingresado = true;
								}
								this.entradasRegistradas();
								this.buscando = false;
								this.buscandoCedula = false;
							});
						}else
						{
							//Cédula no está registrada
							this.cedula.error.error = true;
							this.cedula.error.message = 'La cédula no está registrada';
							this.buscando = false;
							this.buscandoCedula = false;
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
				return this.$http.get('/student/buscar_ci/' + this.cedula.val)
				.then(function(response)
				{
					return Promise.resolve(response);
				});
			},
			registrarEntrada: function (student_id)
			{
				return this.$http.post('/comedor/postRegistrarEntrada', {'student_id': student_id})
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