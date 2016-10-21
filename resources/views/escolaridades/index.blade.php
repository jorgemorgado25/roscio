@extends('app')
@section('title')
	Listado de Escolaridades
@endsection
@section('main-content')

<h3>Listado de Escolaridades</h3><br>

<p class="alert alert-success text-center" 
	:transition="fade" 
	v-show="escolaridad">
	La escolaridad @{{ escolaridad }} ahora está activa</p>

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
	<div class="box-footer clearfix">
		<div class="pull-right">
			{!! $escolaridades->render() !!}
		</div>
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