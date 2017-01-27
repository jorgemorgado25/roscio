<style>
	*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		-moz-box-sizing: border-box;
		-webkit-box-sizing: border-box;
		font-family: "Arial, Helvetica";
	}	
	#main
	{
		position: absolute;
		float: left;
		top:100px;
		left:80px;
		height: 8.5cm;
		width: 5.4cm;
		/*border-radius: 10px;*/
		border:1px #000 solid;
		z-index: 10;
	}
	#back
	{
		position: absolute;
		float: left;
		top:100px;
		left:288px;
		height: 8.5cm;
		width: 5.4cm;
		/*border-radius: 10px;*/
		border:1px #000 solid;
	}
	
	#bg-carnet
	{
		position: absolute;
		z-index: -5;
		width: 175px;
		top:23px;
	}

	#bg-logo
	{
		position: absolute;
		z-index: 1;
		width: 78px;
		top:239px;
		left:8px;
	}

	#qr-code
	{
		position: absolute;
		top: 235px;
		left:130px;
	}
	
	#h1-carnet
	{
		position: absolute;
		margin-top: 60px;
		margin-left: 90px;
		text-align: center;
		font-size: 11px;
	}

	#p-republica
	{
		position: relative;		
		font-size: 9px;
		top:5px;
		text-align: center;
		font-weight: bold;
		padding-left: 10px;
	}

	#p-republica #span-jgr
	{
		font-size: 11px;
	}

	#h3-carnet-estudiantil
	{
		position: relative;		
		font-size: 12px;
		top:12px;
		text-align: center;
		font-weight: bold;
		left: 12px;
	}

	#id-div-foto
	{
		position: relative;
		width: 80px;
		height: 90px;
		top:20px;
		left: 70px;
		border: solid 1px #000;
	}

	

	#h3-cedula
	{
		position: absolute;		
		font-size: 10px;
		margin: 85px 0 0 15px;
	}
	
	#div-apellidos-nombres{
		position: relative;
		top: 25px;
		left: 30px;
		font-size: 11px;
		width: 280px;
		font-weight: bold;
		width: 183px;
		
	}
	#div-apellidos-nombres span{
		font-size: 8px;
	}

	#img-sello
	{
		position: relative;
		width: 145px;		
		margin-top: 20px;
		margin-left: 43px;
	}

	#p-ano-seccion
	{
		position: relative;
		top: 25px;
		left: 10px;
		font-size: 10px;
		font-weight: bold;
	}
	#div-decreto
	{
		text-align: justify;
		font-size: 9px;
		position: relative;
		top:40px;
		width: 180px;
		left: 10px;
		font-weight: bold;
	}
	
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
	<div id="main">
		
	<img src="img/fondo.png" id="bg-carnet"/>
	<img src="img/bg-logo.png" id="bg-logo"/>

	<p id="p-republica">
		REPÚBLICA BOLIVARIANA DE VENEZUELA
		<br>
		LICEO TURNO INTEGRAL
		<br>
		<span id="span-jgr">"JUAN GERMÁN ROSCIO"</span>
		<br>
		SAN JUAN DE LOS MORROS - GUÁRICO
	</p>

	<h3 id="h3-carnet-estudiantil">CARNET ESTUDIANTIL</h3>

	<div id="id-div-foto">
		
	</div>

	<div id="div-apellidos-nombres">
		<span>APELLIDOS Y NOMBRES</span><br>
		{{ $register->student->full_name }} <br>
		C.I: {{ $register->student->ci }}
	</div>


		<!-- Código de Barra -->
		<span id="bar-code">
			<?php		
				
				/**
					CODIGOS: C39 - QRCODE
				**/
				//echo DNS1D::getBarcodeHTML($register->student->ci, "C39",1,30);
				//echo DNS2D::getBarcodeHTML($register->student->ci, "QRCODE", 2, 2);
			?>
		</span>
		
		<span id="qr-code">
			<?php
				/*echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($register->student->ci, "C39", 1, 30) . '" alt="barcode"   />';*/
				
				/**
					CODIGOS: C39 - QRCODE
				**/
				//echo DNS1D::getBarcodeHTML($register->student->ci, "C39",1,30);
				

				echo DNS2D::getBarcodeHTML($register->student->ci, "QRCODE", 3.3, 3.3);
			?>
		</span>		
	</div>

	<div id="back">
		<img src="img/sello1.png" id="img-sello">

		<p id="p-ano-seccion">
			AÑO: {{ $register->ano->ano }} <br> 
			SECCIÓN:  {{ $register->seccion->seccion }} <br>
			ESCOLARIDAD <br>
			{{ $register->escolaridad->escolaridad }}
		</p>

		<div id="div-decreto">
			Este Carnet permite el disfrute del Pasaje Preferencial Estudiantil según los Decretos 2.038 y 2.757 del Subsidio Indirecto las 24 horas del día y los 365 días del año en todas las rutas de Transporte Público según lo contemplado en Gaceta Oficial N° 3.488. <br/>
			<br>
			Es personal e intransferible.
		</div>
	</div>
</body>
</html>
