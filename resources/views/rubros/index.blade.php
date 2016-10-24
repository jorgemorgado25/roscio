@extends('app')
@section('title')
	Listado de Rubros
@endsection
@section('main-content')
<h3>	
	<a class="btn btn-primary pull-right btn-sm" href="{{route('rubros.create')}}">
		<span class="glyphicon glyphicon-plus"></span>
		Nuevo</a>
	Listado de Rubros</h3><br>

	

<div class="box box-primary">
	<div class="box-header with-border">
		<div class="btn-group btn-group-justified" role="group">
			<div class="btn-group" role="group" v-for="(key, value) in categorias">
				<input class="btn btn-default" type="button" value="@{{ value }}" @click="getRubro(key)"/>
			</div>			
		</div>
	</div>

	<div class="box-body">

		<div class="text-center">
			<p><i v-if="cargando" class="fa fa-spinner fa-spin fa-4x"></i></p>				
		</div>

		@include('partials.success-message')

		<p class="alert alert-info text-center" v-if="!categoria_id">
			Seleccione una categoria
		</p>

		<p class="alert alert-danger text-center" v-if="error">
			@{{error}}
		</p>
		<table class="table table-bordered" id="table" v-if="rubros">
			<thead>
			<tr>
				<th>Rubro</th>
				<th width="20%">Categoría</th>
				<th width="150px" class="text-center">Acciones</th>
			</tr>
			</thead>
			<tbody>
				<tr v-for="rubro in rubros">
					<td>@{{ rubro.rubro }}</td>
					<td>@{{ rubro.categoria }}</td>
					<td class="text-center">
						<a href="rubros/@{{ rubro.id }}/edit" class="btn btn-sm btn-default">
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
			categorias: '',
			rubros: '',
			error: '',
			cargando: false
		},
		ready: function(){
			this.getCategorias();
		},
		methods: {
			getCategorias: function()
			{
				this.getCategoriasRubros().then(function(response){
					console.log(response.data);
					this.categorias = response.data
				});
			},
			getRubro: function(categoria_id)
			{
				this.rubros = '';
				this.error = '';
				this.cargando = true;
				this.categoria_id = categoria_id
				
				this.getRubros(this.categoria_id).then(function(response)
				{
					this.cargando = false;
					console.log(response.data.rubros);
					this.rubros = response.data.rubros;
					response.data.rubros ? this.error = '' : this.error = 'No hay rubros en la categoría seleccionada';
				});
			}
		}
	});
</script>
@endsection