<style>
	*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		-moz-box-sizing: border-box;
		-webkit-box-sizing: border-box;
	}	
	#main
	{
		margin: 80px 0 0 80px;
		width: 8.5cm;
		height: 5.5cm;
		border-radius: 10px;
		border:2px #000 solid;
	}
	#p-rep
	{
		position: relative;
		font-size: 8px;
		text-align: center;
		margin-left: 60px;
		margin-top: 15px;
	}
	#codigo
	{
		position: absolute;
		margin-top: 10px;
		margin-left: 15px;
	}
	#logo
	{
		position: absolute;
		width: 60px;
		margin-left: 15px;
		margin-top: 8px;
	}
	
	#h1-carnet
	{
		position: relative;
		margin-top: 15px;
		margin-left: 30px;
		text-align: center;
		font-size: 12px;
	}
	#h3-cedula{
		position: absolute;		
		font-size: 9px;
		margin: 15px 0 0 15px;
	}
	
	#h3-nombre{
		position: absolute;
		margin: 15px 0 0 15px;
		font-size: 9px;
		width: 280px;
	}

	#h3-escolaridad{
		position: relative;
		margin: 40px 0 0 15px;
		font-size: 9px;
	}

	#bg-carnet{
		position: absolute;
		z-index: -1;
		margin: 110px 0 0 230px;
	}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
	<div id="main">
		<img id="logo" src="img/logo.png">
		<p id="p-rep">
			REPÚBLICA BOLIVARIANA DE VENEZUELA <br>
			MINISTERIO DEL PODER POPULAR PARA LA EDUCACION <br>
			LICEO NACIONAL "JUAN GERMAN ROSCIO" <br>
			SAN JUAN DE LOS MORROS-ESTADO GUARICO
		</p>
		<h1 id="h1-carnet">CARNET ESTUDIANTIL</h1>

		<h3 id="h3-cedula">CEDULA: {{ $register->student->ci }}</h3>
		<h3 id="h3-nombre">NOMBRE: {{ $register->student->full_name }}</h3>

		<h3 id="h3-escolaridad">{{ $register->escolaridad->escolaridad }} - AÑO: {{ $register->ano->ano }} - SECCION:  {{ $register->seccion->seccion }}</h3>

		<span id="codigo">
			<?php
				echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($register->student->ci, "C39E", 1, 30) . '" alt="barcode"   />';
			?>
		</span>
	</div>
</body>
</html>
