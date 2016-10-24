@extends('app')
@section('title')
	Crear Plato
@endsection
@section('main-content')
<div class="col-md-8 col-md-offset-2">

<h3 class="text-center">Registrar Plato</h3><br>
<div class="box box-primary">
	<div class="row">
		<form action="{{ route('rubros.store') }}" method="POST" id="form-create">
		<div class="box-header with-border">	
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Nombre del Plato</label>
					<input name="rubro" type="text" class="form-control" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Categoría</label>
					{!! Form::select('categoria_rubro_id', $catPlatos, null, [
						'class' => 'form-control', 
						'v-model' => 'categoria_plato_id'
					]) !!}
				</div>
			</div>
			<div class="col-md-12">
				<hr>
				<h4>Añadir Ingredientes al Plato:</h4>
				<hr>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Categoría del Rubro</label>
					{!! Form::select('categoria_rubro_id', $catRubro, null, [
						'class' => 'form-control', 
						'v-model' => 'categoria_rubro_id',
						'@change' => 'getRubro()', 
						'required' => 'required']) 
					!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Rubro</label>
					<select name="" id="" class="form-control" v-model="rubro_id">
						<option v-for="rubro in rubros" value="@{{rubro.id}}">@{{rubro.rubro}}</option>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<label for="">Kilos x 10 personas</label>
				<input type="text" class="form-control">
			</div>
			<div class="col-md-12">
				<span class="clearfix">
					<button type="button" class="btn btn-default btn-sm pull-right">
						<span class="glyphicon glyphicon-ok"></span>&nbsp;
						Añadir Ingrediente</button>	
				</span>				
				<hr>
			</div>

			<div class="col-md-12">
				<p class="alert alert-danger text-center">No se han añadido ingredientes</p>

			</div>
		</div>
	</div>	
		<div class="box-body">
			{{ csrf_field() }}
			<button class="btn btn-primary" type="submit" id="btn-submit"><span class="glyphicon glyphicon-floppy-disk"></span> Registrar Plato</button>
		</div>
		</form>
	
</div>	
</div>
@endsection

@section('scripts')
	<script src="{{ asset('/js/vue-functions.js') }}"></script>
	<script>
	vm = new Funciones({
		el: 'body',
		data: {
			categoria_plato_id: '',
			categoria_rubro_id: '',
			rubros: '',
			rubro_id: ''
		},
		methods:
		{
			getRubro: function()
			{
				this.rubros = '';
				this.cargando = true;
				this.rubro_id = '',
				this.getRubros(this.categoria_rubro_id).then(function(response)
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