<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Reporte Entradas Diarias</title>
	</head>
	<style>
body
{
	padding: 40px 60px 40px 60px;
	font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
	font-size: 12px;
}

#logo
{
	position: absolute;
	width: 50px;
	margin-left: 6px;
	margin-top: 0px;
}
table
{
    border-collapse: collapse;
    border-spacing: 0;
    width:600px;
}
th, td
{
	border: 1px solid #000000;
	padding: 4px;
}
	</style>
	<body>
		<img id="logo" src="img/logo-lti-400.png">
		<center><b>LICEO TURNO INTEGRAL "JUAN GERMAN ROSCIO"</b></center>
		<center><b>CONTROL DE COMEDOR</b></center>
		<center><b>TOTAL DE ENTRADAS DIARIAS</b></center>
		<br><br>
		<b>FECHA: {{ $fecha }} - {{ $tipo_entrada == 1 ? 'DESAYUNO' :  'ALMUERZO' }}</b>
		<br><br>
		<table>
			<tr>
				<th>AÑO</th>
				<th>MASCULINO</th>
				<th>FEMENINO</th>
				<th>TOTAL</th>
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

		<br>
		<center><b>MENÚ DEL DÍA</b></center>

		@foreach($platos as $p)
			<br>
			<strong>{{ $p['plato'] }}</strong> &nbsp;
			<span class="muted">{{ $p['categoria'] }}</span>		
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
		@endforeach
	</body>
</html>