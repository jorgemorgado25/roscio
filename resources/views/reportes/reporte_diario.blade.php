@extends('app')
@section('title')
	Listado de Escolaridades
@endsection
@section('main-content')
	<h3>Reporte Ingresos de Día</h3><br>	
	<div class="box box-primary">
		<div class="row">
			<div class="box-header with-border">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Fecha</label>
						<input type="text" v-model="fecha" class="form-control" id="datepicker" readonly='true'>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Tipo de Ingreso</label>
						{!! Form::select('tipo_ingreso', ['1' => 'Desayuno', '2' => 'Almuerzo'], NULL, [
							'class' => 'form-control',
							'v-model' => 'tipo_ingreso'] 
						) !!}
					</div>
				</div>
				<div class="col-md-12">
					<button class="btn btn-primary" :disabled="!fecha || !tipo_ingreso" @click="consultar()">Consultar</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
	$('#datepicker').datepicker({
		format: 'dd-mm-yyyy',
		language: 'es',
		todayHighlight: true,
		autoclose: true, 
		daysOfWeekDisabled: "0,6",
	});	
	vm = new Vue({
		el: 'body',
		data: {
			fecha: '', 
			tipo_ingreso: '',
			buscando: false
		},
		methods: {
			consultar: function()
			{
				window.location = "/reportes/getEntradasDiarias/" + this.fecha + '/' + this.tipo_ingreso;
			}
		}
	});
	</script>
@endsection