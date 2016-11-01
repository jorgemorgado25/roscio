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
		width: 390px;
		height: 240px;
		border-radius: 10px;
		padding: 15px;
		border:2px #000 solid;
	}
	#codigo
	{
		position: absolute;
		margin-top: 200px;
	}
	#logo
	{
		position: absolute;
		width: 80px;
	}
	#p-rep{
		position: absolute;
		font-size: 8px;
		text-align: center;
		margin-left: 120px;
	}
	#h1-carnet{
		margin: 70px 0 0 140px;
		position: absolute;
		font-size: 16px;
	}
	#h3-cedula{
		position: absolute;
		margin: 120px 0 0 0px;
		font-size: 12px;
	}
	#h3-escolaridad{
		position: absolute;
		margin: 120px 0 0 280px;
		font-size: 12px;
	}
	#h3-apellidos{
		position: absolute;
		margin: 140px 0 0 0;
		font-size: 12px;		
	}
	#h3-grado{
		position: absolute;
		margin: 140px 0 0 280px;
		font-size: 12px;		
	}
	#h3-nombres{
		position: absolute;
		margin: 160px 0 0 0;
		font-size: 12px;		
	}
	#h3-seccion{
		position: absolute;
		margin: 160px 0 0 280px;
		font-size: 12px;		
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
	<p id="p-rep">
		REPÚBLICA BOLIVARIANA DE VENEZUELA <br>
		MINISTERIO DEL PODER POPULAR PARA LA EDUCACION <br>
		LICEO NACIONAL "JUAN GERMAN ROSCIO" <br>
		SAN JUAN DE LOS MORROS-ESTADO GUARICO
	</p>

	<h1 id="h1-carnet">CARNET ESTUDIANTIL</h1>

	<h3 id="h3-cedula">
		CEDULA: {{ $inscripcion->estudiante->cedula }}
	</h3>
	<h3 id="h3-apellidos">
		APELLIDOS: {{ $inscripcion->estudiante->apellido }}
	</h3>
	<h3 id="h3-nombres"
		>NOMBRES:  {{ $inscripcion->estudiante->nombre }}
	</h3>


	<h3 id="h3-escolaridad">
		{{ $inscripcion->escolaridad->escolaridad }}</h3>
	<h3 id="h3-grado">
		AÑO: {{ $inscripcion->ano->ano }}</h3>
	<h3 id="h3-seccion">
		SECCION: {{ $inscripcion->seccion->seccion }}</h3>

	<img id="logo" src="img/logo.png">
	<img id="bg-carnet" src="img/bg-carnet.png">
	<span id="codigo">
		<?php
			echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($inscripcion->estudiante->cedula, "C39E", 1, 40) . '" alt="barcode"   />';
		?>
	</span>
</div>
</body>
</html>
