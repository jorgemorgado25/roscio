@extends('app')
@section('title')
	Entradas Diarias
@endsection
@section('main-content')
	<h3>Total de Ingresos al Día</h3><br>	
	<div class="box box-primary">
		<div class="row">
			<div class="box-header with-border">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Fecha</label>
						<p>{{ $fecha }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Tipo de Ingreso</label>
						<p>{{ $tipo_entrada == 1 ? 'Desayuno' : 'Almuerzo'}}</p>
					</div>
				</div>
				<div class="col-md-12">
					@if(!$hayEntradas)
						<div class="alert alert-danger text-center">No hay registros</div>
					@else
						<table class="table table-bordered table-striped text-center">
							<tr>
								<th width="80px">Año</th>
								<th>Masculino</th>
								<th>Femenino</th>
								<th>Total</th>
							</tr>
							<tr>
								<td><b>1ro</b></td>
								<td>{{ $totales['primero']['M'] }}</td>
								<td>{{ $totales['primero']['F'] }}</td>
								<td>{{ $totales['primero']['M'] + $totales['primero']['F'] }}</td>
							</tr>
							<tr>
								<td><b>2do</b></td>
								<td>{{ $totales['segundo']['M'] }}</td>
								<td>{{ $totales['segundo']['F'] }}</td>
								<td>{{ $totales['segundo']['M'] + $totales['segundo']['F'] }}</td>
							</tr>
							<tr>
								<td><b>3ro</b></td>
								<td>{{ $totales['tercero']['M'] }}</td>
								<td>{{ $totales['tercero']['F'] }}</td>
								<td>{{ $totales['tercero']['M'] + $totales['tercero']['F'] }}</td>
							</tr>
							<tr>
								<td><b>4to</b></td>
								<td>{{ $totales['cuarto']['M'] }}</td>
								<td>{{ $totales['cuarto']['F'] }}</td>
								<td>{{ $totales['cuarto']['M'] + $totales['cuarto']['F'] }}</td>
							</tr>
							<tr>
								<td><b>5to</b></td>
								<td>{{ $totales['quinto']['M'] }}</td>
								<td>{{ $totales['quinto']['F'] }}</td>
								<td>{{ $totales['quinto']['M'] + $totales['quinto']['F'] }}</td>
							</tr>
							<tr>
								<td><b>Total</b></td>
								<td><b>
									{{ $tm = $totales['primero']['M'] + $totales['segundo']['M'] + $totales['tercero']['M'] + $totales['cuarto']['M'] + $totales['quinto']['M'] }}
								</b></td>
								<td><b>
									{{ $tf = $totales['primero']['F'] + $totales['segundo']['F'] + $totales['tercero']['F'] + $totales['cuarto']['F'] + $totales['quinto']['F'] }}
								</b></td>
								<td><b>{{ $total = $tm + $tf }}</b></td>
							</tr>
						</table>
						<hr>
						<h4>Menú del Día</h4><br>

						@foreach($platos as $p)

							<div class="panel panel-default">
								<div class="panel-heading">
									<strong>{{ $p['plato'] }}</strong> &nbsp;
									<span class="muted">{{ $p['categoria'] }}</span>
								</div>		
								<table class="table table-striped">
									<tr>
										<th>Rubro</th>
										<th>Medida</th>
										<th>Cantidad</th>
										<th>Gasto</th>
									</tr>
									@foreach($p['rubros'] as $rubro)
										<tr>
											<td>{{ $rubro['rubro'] }}</td>
											<td>
												@if($rubro['medida'] == 'gramos')
													{{ $rubro['medida'] }} x 10 personas
												@else
													{{ $rubro['medida'] }} x persona
												@endif
											</td>
											<?php //$total = 15 ?>
											<td>{{ $rubro['cantidad'] }}</td>
											<td>
												@if($rubro['medida'] == 'gramos')
													{{ ($rubro['cantidad'] * $total) / 10000 }} Kg
												@else
													{{ $rubro['cantidad'] * $total }} Unidad
												@endif
											</td>
										</tr>
									@endforeach
								</table>
							</div>
						@endforeach
						<a target="_blank" href="{{ route('pdfEntradasDiarias', [$fecha, $tipo_entrada]) }}" class="btn btn-primary">
							<span class="glyphicon glyphicon-print"></span>
							&nbsp;Imprimir Reporte
						</a>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection