@extends('app')
@section('html_title')
    Docentes
@endsection 
@section('main-content')

<div class="col-md-8 col-md-offset-2">
	<h2 class="text-center">Acceso a Comedor</h2><br>

	<h3>Tipo de Ingreso:</h3><br>


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

	<h4>Menú del día</h4>
	<div class="panel panel-default">
		<div class="panel-body">
			<p><b>Desayuno: </b></p>
			<p><b>Bebida: </b></p>
			<p><b>Fruta: </b></p>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
			<p><b>Sopa: </b></p>
			<p><b>Plato Principal: </b></p>
			<p><b>Ensalada: </b></p>
			<p><b>Bebida: </b></p>
			<p><b>Fruta: </b></p>
		</div>
	</div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('/js/find-estudiante.vue') }}"></script>
<script>
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e){
		$("input:text" ).focus();
	});

	Vue.directive('focus', {
		bind: function () {
			this.el.focus();
		}
	});
	vm = new Vue ({
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
			buscando: false,
			tipo_ingreso: 2
		},
		computed: {
			tipo_ingreso: function(){
				if (this.tipo_ingreso == 1)
				{
					return 'Desayuno';
				}else{
					return 'Almuerzo'
				}
			}
		},
		methods: {
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
						if(response.data.created)
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