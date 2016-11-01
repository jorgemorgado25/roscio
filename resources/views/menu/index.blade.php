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
		dfg
	</div>

	<div class="box-body">
		<div class="row">
			<div class="col-md-4">
				<div class="input-group date">
	                  <div class="input-group-addon">
	                    <i class="fa fa-calendar"></i>
	                  </div>
	                  <input type="text" class="form-control pull-right" id="datepicker">
	                </div>
			</div>
			<div class="col-md-8">

				<div class="alert alert-info text-center" role="alert">Seleccione una Fecha</div>
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">Desayuno</div>
							<div class="panel-body">
								<p><b>Plato Principal: </b> </p>
								<p><b>Jugo: </b></p>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">Almuerzo</div>
							<div class="panel-body">
								<p><b>Sopa: </b></p>
								<p><b>Plato Principal: </b></p>
								<p><b>Ensalada: </b></p>
								<p><b>Jugo: </b> </p>
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
	vm = new Funciones({
		el: 'body',
		data: {
			buscando: false,
		}
	});
</script>
@endsection
