<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Datos del Usuario</title>
	</head>
	<style>
body
{
	padding: 40px 60px 40px 60px;
	font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
}
.logo
{
	position: absolute;
	top:40px;
	left:20px;
	width: 100px;
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
		
		<center><b>DATOS DEL USUARIO</b></center>
		<br><br>
		<table>
			<tr>
				<td><b>Nombre y Apellido</b></td>
				<td><b>Cargo o descripción</b></td>
			</tr>
			<tr>
				<td>{{ $user->full_name }}</td>
				<td>{{ $user->description }}</td>
			</tr>
			<tr>
				<td><b>Login</b></td>
				<td><b>Activo</b></td>
			</tr>
			<tr>
				<td>{{ $user->login }}</td>
				<td>{{ $user->isActive }}</td>
			</tr>
			<tr>
				<td colspan = 2><b>Coordinaciones asignadas:</b></td>
			</tr>
			<tr>
				<td colspan = 2>
					<ul>
						@if (count($user->roles) > 0)
							@foreach($user->roles as $role)
								<li>{{ $role->name }}</li>
							@endforeach
						@else
							Ninguna
						@endif
					</ul>
				</td>
			</tr>
		</table>
	</body>
</html>
