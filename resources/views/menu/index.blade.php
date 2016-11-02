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
		<div class="row">
			<div class="col-md-4">
				<div class="input-group date">
	                  <div class="input-group-addon">
	                    <i class="fa fa-calendar"></i>
	                  </div>
	                  <input type="text" v-model="fecha" class="form-control input-lg" id="datepicker">
	                </div>
			</div>
			<div class="col-md-8">

				<div v-if="buscando" class="panel panel-default">
					<div class="panel-body">
						<p class="text-center"><i class="fa fa-spinner fa-spin fa-4x"></i></p>
					</div>
				</div>

				<div v-if="!fecha" class="alert alert-info text-center" role="alert">Seleccione una Fecha</div>

				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">Desayuno</div>
							<div class="panel-body">
								<p><b>Plato Principal: </b>@{{ desayuno[2] }}</p>
								<p><b>Jugo: </b>@{{ desayuno[4] }}</p>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">Almuerzo</div>
							<div class="panel-body">
								<p><b>Sopa: </b> @{{ almuerzo[1] }}</p>
								<p><b>Plato Principal: </b>@{{ almuerzo[2] }}</p>
								<p><b>Ensalada: </b>@{{ almuerzo[3] }}</p>
								<p><b>Jugo: </b> @{{ almuerzo[4] }}</p>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
	
@section('scripts')
<script src="{{ asset('/js/vue-functions.js') }}"></script>
<script>
	$('#datepicker').datepicker({
		format: 'dd-mm-yyyy',
		language: 'es'
	});

	function getItem(id, items)
	{
		//console.log(items);
		for (i in items)
		{
			//console.log(items[i]['plato']);
			if (items[i]['id'] == id)
			{
				return items[i];
			}
		}
		//return false;		
	};

	vm = new Funciones({
		el: 'body',
		data: {
			buscando: false,
			fecha: '',
			categoriaDesayuno: [
				{id: 2, categoria: 'Plato Principal'},
				{id: 4, categoria: 'Jugo'}
			],
			categoriaAlmuerzo: [
				{id: 1, categoria: 'Sopa'},
				{id: 2, categoria: 'Plato Principal'},
				{id: 3, categoria: 'Ensalada'},
				{id: 4, categoria: 'Jugo'}
			],

			desayuno: {2: '-', 4: '-'},
			almuerzo: {1: '-', 2: '-', 3: '-', 4: '-'},
			/*
			desayuno: {'platoPrincipal': '-', 'jugo': '-'},			
			almuerzo: {'sopa': '-', 'platoPrincipal': '-', 'jugo': '-', 'ensalada': '-'}
			*/
		},
		watch: {
			fecha: function() {
				this.buscarMenu();
			}
		},
		methods: {
			buscarMenu: function(){
				this.buscando = true;
				this.desayuno[2] = '-';
				this.desayuno[4] = '-';
				this.almuerzo[1] = '-';
				this.almuerzo[2] = '-';
				this.almuerzo[3] = '-';
				this.almuerzo[4] = '-';
				this.getMenu(this.fecha).then(function(response)
				{
					this.buscando = false;
					var desayuno = response.data.desayuno;
					for (var i = 0; i < desayuno.length; i++)
					{
						var plato = getItem(desayuno[i]['plato_id'], response.data.platos);

						//Establezco el plato
						this.desayuno[plato.categoria_plato_id] = plato.plato;
					}
					var almuerzo = response.data.almuerzo;
					for (var i = 0; i < almuerzo.length; i++)
					{
						var plato = getItem(almuerzo[i]['plato_id'], response.data.platos);

						//Establezco el plato
						this.almuerzo[plato.categoria_plato_id] = plato.plato;
					}
				});
			}
		}
	});
</script>
@endsection
