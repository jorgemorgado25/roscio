<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Ficha de Inscripción</title>
	</head>
<style type="text/css">

	* { padding: 0 }
	* { margin: 0 }

	body
	{		
		font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
		font-size: 10;
	}
	
	body header
	{
		/*margin:50px 0 20px 0;*/
	}
	header p
	{
		font-size: 11px;
		text-align: center;
	}

	body h4
	{
		text-align: center;
		padding: 1px;
		margin: 1px;
		font-size: 15px;
	}
	
	.logo
	{
		position: absolute;
		top:40px;
		left:20px;
		width: 100px;
	}
	.table
	{
		border-collapse: collapse;
		border-spacing: 0;
		width:600px;
	}
	.th, .td
	{
		border: 1px solid #000000;
		padding: 4px;
	}
</style>
	<body style="margin: 50px 80px 50px 80px">

		<img style="position:absolute" width="100px" src="img/logo.png" alt="">

		<header>
			<p>REPUBLICA BOLIVARIANA DE VENEZUELA</p>
			<p>MINISTERIO DEL PODER POPULAR PARA LA EDUCACION</p>
			<p>LICEO NACIONAL "JUAN GERMAN ROSCIO"</p>
			<p>SAN JUAN DE LOS MORROS-ESTADO GUARICO</p>
		</header>
		<br><br>
		<h4 class="text-center">Ficha de Inscripción</h4>
		<h4 class="text-center">Escolaridad {{ $inscripcion->escolaridad->escolaridad }}</h4>
		<h4 class="text-center">
			{{ $inscripcion->ano->ano }} Año de {{ $inscripcion->mencion->descripcion }} Sección: {{ $inscripcion->seccion->seccion }}
		</h4>
		<h4 class="text-center">Mención: {{ $inscripcion->mencion->mencion }}</h4>
		<br><br>
		<p><b>I.- DATOS DEL ESTUDIANTE</b></p>
		<br>
		<table style="width:100%">
			<tr>
				<td width="70px"><b>Apellidos:</b></td>
				<td>{{ $inscripcion->estudiante->apellido }}</td>
				<td width="70px"><b>Nombres:</b></td>
				<td>{{ $inscripcion->estudiante->nombre }}</td>
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="70px"><b>Cédula:</b></td>
				<td width="75px">{{ $inscripcion->estudiante->nac }}-{{ $inscripcion->estudiante->cedula }}</td>
				<td width="140px"><b>Fecha de Nacimiento:</b></td>
				<td>{{ $inscripcion->estudiante->fecha_normal }}</td>
				
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="70px"><b>Género:</b></td>
				<td>{{ $inscripcion->estudiante->genero_normal }}</td>
				<td><b>Peso:</b></td>
				<td>{{ $inscripcion->estudiante->peso }}</td>
				<td><b>Talla:</b></td>
				<td>{{ $inscripcion->estudiante->talla }}</td>
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="120px"><b>Lugar Nacimiento:</b></td>
				<td>{{ $inscripcion->estudiante->lugar_nac }}</td>
				<td width="50px"><b>Estado:</b></td>
				<td>{{ $inscripcion->estudiante->estado_nac }}</td>
			</tr>
		</table>
		
		<table>
			<tr>
				<td width="110px"><b>Tipo sanguíneo:</b></td>
				<td width="30px">{{ $inscripcion->estudiante->grupo_sanguineo }}</td>
				<td width="180px"><b>Enfermedades y/o Alérgias:</b></td>
				<td>{{ $inscripcion->estudiante->enf_aler }}</td>
			</tr>
		</table>
		<br><br>
		<p><b>II.- DATOS DE LA MADRE</b></p>
		<br>
		<table style="width:100%">
			<tr>
				<td width="70px"><b>Apellidos:</b></td>
				<td>{{ $inscripcion->estudiante->madre->apellido }}</td>
				<td width="70px"><b>Nombres:</b></td>				
				<td>{{ $inscripcion->estudiante->madre->nombre }}</td>
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="60px"><b>Cédula:</b></td>
				<td width="75px">{{ $inscripcion->estudiante->madre->nac }}-{{ $inscripcion->estudiante->madre->cedula }}</td>
				<td width="70px"><b>Difunta:</b></td>			
				<td width="30px">{{ $inscripcion->estudiante->madre->es_difunta }}</td>
				<td width="160px"><b>Vive con el estudiante: </b></td>
				<td>{{ $inscripcion->estudiante->vive_con_la_madre }}</td>
				<td width="130px"><b>Fecha Nacimiento: </b></td>
				<td>{{ $inscripcion->estudiante->madre->fecha_normal }}</td>
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="70px"><b>Télefono: </b></td>
				<td width="">{{ $inscripcion->estudiante->madre->telefono }}</td>
				<td width="130px"><b>Correo Electrónico:</b></td>
				<td width="">{{ $inscripcion->estudiante->madre->email }}</td>
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="70px"><b>Dirección: </b></td>
				<td width="">{{ $inscripcion->estudiante->madre->direccion }}</td>
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="70px"><b>Profesión: </b></td>
				<td width="">{{ $inscripcion->estudiante->madre->profesion }}</td>
				<td width="150px"><b>Grado de Insctrucción:</b></td>
				<td width="">{{ $inscripcion->estudiante->madre->grado_instruccion }}</td>
			</tr>
		</table>
		<br><br>
		<p><b>III.- DATOS DEL PADRE</b></p>
		<br>
		<table style="width:100%">
			<tr>
				<td width="70px"><b>Apellidos:</b></td>
				<td>{{ $inscripcion->estudiante->padre->apellido }}</td>
				<td width="70px"><b>Nombres:</b></td>				
				<td>{{ $inscripcion->estudiante->padre->nombre }}</td>
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="60px"><b>Cédula:</b></td>
				<td width="70px">{{ $inscripcion->estudiante->padre->nac }}-{{ $inscripcion->estudiante->padre->cedula }}</td>
				<td width="70px"><b>Difunto:</b></td>			
				<td width="30px">{{ $inscripcion->estudiante->padre->es_difunto }}</td>
				<td width="160px"><b>Vive con el estudiante: </b></td>
				<td>{{ $inscripcion->estudiante->vive_con_el_padre }}</td>
				<td width="130px"><b>Fecha Nacimiento: </b></td>
				<td>{{ $inscripcion->estudiante->padre->fecha_normal }}</td>
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="70px"><b>Télefono: </b></td>
				<td width="">{{ $inscripcion->estudiante->padre->telefono }}</td>
				<td width="130px"><b>Correo Electrónico:</b></td>
				<td width="">{{ $inscripcion->estudiante->padre->email }}</td>
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="70px"><b>Dirección: </b></td>
				<td width="">{{ $inscripcion->estudiante->padre->direccion }}</td>
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="70px"><b>Profesión: </b></td>
				<td width="">{{ $inscripcion->estudiante->padre->profesion }}</td>
				<td width="150px"><b>Grado de Insctrucción:</b></td>
				<td width="">{{ $inscripcion->estudiante->padre->grado_instruccion }}</td>
			</tr>
		</table>

		<br><br>
		<p><b>IV.- DATOS DEL REPRESENTANTE</b></p>
		<br>
		<table style="width:100%">
			<tr>
				<td width="85px"><b>Parentesco: </b></td>
				<td width="">{{ $inscripcion->representante->parentesco }}</td>
				<td width="300px"><b>Presenta Autorización del CMDNNA/CPNNA:</b></td>
				<td>{{ $inscripcion->representante->presenta_autorizacion }}</td>
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="70px"><b>Cédula:</b></td>
				<td width="">{{ $inscripcion->representante->persona->nac }}-{{ $inscripcion->representante->persona->cedula }}</td>
				
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="70px"><b>Apellidos:</b></td>
				<td width="">{{ $inscripcion->representante->persona->apellido }}</td>
				<td width="70px"><b>Nombres:</b></td>
				<td width="">{{ $inscripcion->representante->persona->nombre }}</td>
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="65px"><b>Teléfono:</b></td>
				<td width="">{{ $inscripcion->representante->persona->telefono }}</td>
				<td width="130px"><b>Correo electrónico:</b></td>
				<td width="">{{ $inscripcion->representante->persona->email }}</td>
			</tr>
		</table>
		<table style="width:100%">
			<tr>
				<td width="80px"><b>Dirección:</b></td>
				<td width="">{{ $inscripcion->representante->persona->direccion }}
				</td>				
			</tr>
		</table>
	</body>
</html>
