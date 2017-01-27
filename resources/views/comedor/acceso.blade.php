@extends('app')
@section('html_title')
    Docentes
@endsection 
@section('main-content')

<div class="row">
<h2 class="text-center">Acceso a Comedor</h2><br>
<div class="col-md-6 col-md-offset-1">	

	<h4>Tipo de Ingreso: @{{ tipoIngreso }}</h4><br>

	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_1" data-toggle="tab"><i class="glyphicon glyphicon-log-in"></i> &nbsp;Cédula</a></li>
			
		</ul>
		<div class="tab-content">

		<div class="tab-pane active" id="tab_1">
			<form id="form-codigo" action="" @submit.prevent="ingresarCedula" autocomplete="off">
			<div class="form-group">
				<p v-cloak class="alert alert-success text-center" v-if="cedula.ha_ingresado">
					Registro generado satisfactoriamente
				</p>
				
				<p v-cloak class="alert alert-danger text-center" v-if="!cedula.val && cedula.buscando">	Ingresa la cédula
				</p>

				<p v-cloak class="alert alert-danger text-center" v-if="cedula.error.message">
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
		</div>
		<!-- /.tab-content -->
	</div>
	<!-- nav-tabs-custom -->

	<div v-if="!buscandoMenu" v-cloak>
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
						<span :style="calcularEstilos()">@{{ platosDisponibles }}</span>
						</p>
					</div>
				</div>
			</div>
		</div>

		<div v-cloak v-if="tipo_ingreso == 1 && !hayDesayuno()">
			<div class="alert alert-danger text-center">No hay desayuno registrado</div>
			<a href="{{ route('menu.index') }}" class="btn btn-default">Cargar Menú</a>			
		</div>

		<div v-cloak v-if="tipo_ingreso==2 && hayAlmuerzo()" class="panel panel-default">
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
						<span :style="calcularEstilos()">@{{ platosDisponibles }}</span>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div v-cloak v-if="tipo_ingreso == 2 && !hayAlmuerzo()">
			<div class="alert alert-danger text-center">No hay almuerzo registrado</div>
			<a href="{{ route('menu.index') }}" class="btn btn-default">Cargar Menú</a>		
		</div>
	</div>		

</div>

	<div class="col-md-4">
		<h4>WebCam</h4>
		<br>
		<div class="panel">
			<canvas></canvas>
		</div>		
	</div>
</div>

@endsection

@section('scripts')

<script src="{{ asset('/js/find-estudiante.vue') }}"></script>
<script src="{{ asset('/js/vue-functions.js') }}"></script>
<script src="{{ asset('/js/webcodecamjs/js/qrcodelib.js') }}"></script>
<script src="{{ asset('/js/webcodecamjs/js/webcodecamjs.js') }}"></script>

<script type="text/javascript">

	var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
	var arg = {
		resultFunction: function(result)
		{
			console.log(result.code);
			document.getElementById("txt-cedula").value=result.code;
			document.getElementById("txt-cedula").focus();
			beep();
		}
	};

	$('#txt-cedula').numeric({
    	allowMinus   : false,
    	allowThouSep : false,
    	allowDecSep: false
    });
    
	new WebCodeCamJS("canvas").init(arg).play();

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
		computed:
		{
			tipoIngreso: function()
			{
				this.tipo_ingreso == 1 ? t = 'Desayuno' : t = 'Almuerzo';
				return t;
			},

			platosDisponibles: function()
			{
				if(this.cantidad_platos - this.total_entradas < 0)
				{
					return 0;
				}else
				{
					return vm.cantidad_platos - vm.total_entradas;
				}
			}
		},
		ready: function()
		{
			var d = new Date();
			var hora = d.getHours();
			var mes = d.getMonth() + 1
			this.fecha = d.getFullYear() + '-' + mes + '-' + d.getDate();
			hora <= 10 ? this.tipo_ingreso = 1 : this.tipo_ingreso = 2;
			this.buscarMenu();
			this.cantidadPlatos();
			this.entradasRegistradas();
		},
		methods:
		{
			calcularEstilos: function()
			{
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

					/*Esta función está declarada en este mismo archivo*/
					this.buscarEstudiante()
					.then(function(response)
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

	function beep()
	{
    	var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");  
    	snd.play();
	}
</script>
@endsection