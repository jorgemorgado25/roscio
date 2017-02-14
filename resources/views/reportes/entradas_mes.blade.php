@extends('app')
@section('title')
	Consultar por Mes
@endsection

@section('assets')
	
@endsection

@section('main-content')
	<h3>Total Ingresos por Mes</h3><br>	
	<div class="box box-primary">		
		<div class="box-header with-border">
			Consulta por Mes
		</div>
		<div class="box-body">
			<div class="row">
				<form @submit.prevent='consultar_mes'>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Mes</label>
							{!! Form::select('mes', $meses, NULL, [
								'class' => 'form-control',
								'required' => 'required',
								'v-model' => 'mes'] 
							) !!}
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Año</label>
							<input type="text" class="form-control" v-model="ano" name="ano" maxlength="4" required>
						</div>
					</div>
					<div class="col-md-12">
						<button class="btn btn-primary" type="submit" @click="consultar_mes">Consultar</button>
					</div>
				</form>			
			</div>
		</div>
	</div>
	<br>
	<div class="box box-primary">
		<div class="box-header with-border">
			Consulta por Rango de Fecha
		</div>
		<div class="row">
			<div class="box-body">
				<form @submit.prevent="consultar_rango">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Fecha</label>
							<input 
								type="text" 
								v-model="fecha1" 
								class="form-control" 
								id="datepicker-1" 
								name="date1"
								readonly='true'>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Fecha</label>
							<input 
								type="text" 
								v-model="fecha2" 
								class="form-control" 
								id="datepicker-2" 
								name="date2"
								readonly='true'>
						</div>
					</div>

					<div class="col-md-12">
						<div class="alert alert-danger text-center" v-if="error2">
							@{{ error2 }}
						</div>
					</div>

					<div class="col-md-12">
						<button class="btn btn-primary" type="submit">Consultar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
	$('#datepicker-1').datepicker({
		format: 'dd-mm-yyyy',
		language: 'es',
		todayHighlight: true,
		autoclose: true, 
		daysOfWeekDisabled: "0,6",
	});
	$('#datepicker-2').datepicker({
		format: 'dd-mm-yyyy',
		language: 'es',
		todayHighlight: true,
		autoclose: true, 
		daysOfWeekDisabled: "0,6",
	});	
	vm = new Vue({
		el: 'body',
		data: {
			fecha1: '', 
			fecha2: '', 
			mes: '',
			ano: '',
			buscando: false,
			error2: '',
		},
		methods: {
			consultar_rango: function()
			{
				this.error2 = '';
				if (!this.fecha1)
				{
					this.error2 = "Seleccione la Fecha de Inicio";
					return false;
				}
				if (!this.fecha2)
				{
					this.error2 = "Seleccione la Fecha Final";
					return false;
				}
				if (this.fecha1 >= this.fecha2)
				{
					this.error2 = "La Fecha de Inicio debe ser menor";
					return false;
				}
				window.location = "/reportes/rsRangoFecha/" + this.fecha1 + '/' + this.fecha2;
			},
			consultar_mes: function()
			{
				window.location = "/reportes/rsEntradasMes/" + this.mes + '/' + this.ano;
			}
		}
	});
	</script>
@endsection