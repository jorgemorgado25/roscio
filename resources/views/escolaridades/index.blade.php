@extends('app')
@section('title')
	Listado de Escolaridades
@endsection

@section('main-content')
<h3>
	<a href="{{ route('escolaridades.create') }}" class="btn pull-right btn-primary">
		<span class="glyphicon glyphicon-plus"></span>
		Nueva</a>
	Listado de Escolaridades</h3><br>

@include('partials.success-message')


<div class="alert alert-success alert-dismissible" v-show="escolaridad">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p class="text-center">La escolaridad @{{ escolaridad }} ahora está activa</p>
</div>

<div class="box box-primary">
	<div class="box-header with-border">
		Hay {{ $escolaridades->total() }} escolaridades registradas
		
	</div>
	<div class="box-body">
		@if( count($escolaridades) > 0)
		<table class="table table-bordered" id="table">
			<thead>
			<tr>
				<th>Escolaridad</th>
				<th>Activa</th>
				<th width="200px">Acciones</th>
			</tr>
			</thead>
			<tbody>
			@foreach($escolaridades as $escolaridad)
				<tr>
					<td>{{ $escolaridad->escolaridad }}</td>
					<td><input 
						type="radio" 
						name="activa" 
						value={{ $escolaridad->id }} 
						{{ $escolaridad->active ? 'checked = checked' : ''}} 
						@change="activar({{ $escolaridad->id }})"
					</td>
					<td>
						<a title="Editar" class="btn btn-default btn-sm" href="{{ route('escolaridades.edit', $escolaridad) }}"><span class="glyphicon glyphicon-pencil"></span></a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		@else
			<div class="alert bg-active btn-primary text-center">
				No se encontraron resultados
			</div>
		@endif
	</div>
	
</div>
@endsection

@section('scripts')

	<style>
		.fade-transition {
			transition: all 1s ease;
			opacity: 100;
		}
		.fade-enter, .fade-leave{
			opacity: 0;
		}
	</style>
	<script>
	vm = new Vue({
		el: 'body',
		data: {
			escolaridad: ''
		},
		methods: {
			activar: function (id)
			{
				this.escolaridad = '';
				this.$http.post('/escolaridades/activar', {'id': id} ).then(function (response)
				{
					vm.escolaridad = response.data.escolaridad;
				}).catch(function (response)
				{
					console.log(response.data);
				});
			}
		}
	});
	</script>
@endsection