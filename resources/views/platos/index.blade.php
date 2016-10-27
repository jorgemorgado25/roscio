@extends('app')
@section('title')
	Listado de Platos
@endsection
@section('main-content')
<h3>	
	<a class="btn btn-primary pull-right btn-sm" href="{{route('platos.create')}}">
		<span class="glyphicon glyphicon-plus"></span>
		Nuevo</a>
	Listado de Platos</h3><br>	

<div class="box box-primary">
	<div class="box-header with-border">
		<div class="btn-group btn-group-justified" role="group">
			<div class="btn-group" role="group" v-for="(key, value) in categorias">
				<input class="btn btn-default" type="button" value="@{{ value }}" @click="getPlato(key)"/>
			</div>
		</div>
	</div>

	<div class="box-body">

		<div class="text-center">
			<p><i v-if="cargando" class="fa fa-spinner fa-spin fa-4x"></i></p>				
		</div>
		<p class="alert alert-info text-center" v-if="!categoria_id">
			Seleccione una categoria
		</p>

		<p class="alert alert-danger text-center" v-if="error">
			@{{error}}
		</p>
		<table class="table table-bordered" id="table" v-if="platos">
			<thead>
			<tr>
				<th>Plato</th>
				<th width="20%">Categoría</th>
				<th width="150px" class="text-center">Acciones</th>
			</tr>
			</thead>
			<tbody>
				<tr v-for="plato in platos">
					<td>@{{ plato.plato }}</td>
					<td>@{{ plato.categoria }}</td>
					<td class="text-center">
						<a title="Ver" href="platos/@{{ plato.id }}" class="btn btn-sm btn-default">
							<span class="glyphicon glyphicon-search"></span>
						</a>
						<a title="Editar" href="platos/@{{ plato.id }}/edit" class="btn btn-sm btn-default">
							<span class="glyphicon glyphicon-pencil"></span>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	
</div>	
@endsection
	
@section('scripts')
<script src="{{ asset('/js/vue-functions.js') }}"></script>
<script>

	$(document).ready(function()
	{
	    $('#table').dataTable(
	    {
	        "language": {
	            "url": '/plugins/datatables/spanish.json'
	        },
		    "bInfo": false
	    });
	});

	vm = new Funciones({
		el: 'body',
		data: {
			categoria_id: '',
			platos: '',
			error: '',
			cargando: false,
			categorias: ''
		},
		ready: function(){
			this.getCategorias();
		},
		methods: {
			getPlato: function(categoria_id)
			{
				this.platos = '';
				this.error = '';
				this.cargando = true;
				this.categoria_id = categoria_id
				
				this.getPlatos(this.categoria_id).then(function(response)
				{
					this.cargando = false;
					console.log(response.data.platos);
					this.platos = response.data.platos;
					response.data.platos ? this.error = '' : this.error = 'No hay platos en la categoría seleccionada';
				});
			},
			getCategorias: function()
			{
				this.getCategoriasPlatos().then(function(response){
					console.log(response.data);
					this.categorias = response.data
				});
			}
		}
	});
</script>
@endsection