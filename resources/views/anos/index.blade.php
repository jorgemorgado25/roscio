<h2>Listado de Años Escolares</h2>

@foreach($anos as $ano)
	Año: {{ $ano->ano }} Mención: {{ $ano->mencion->mencion }} Descripción: {{ $ano->mencion->descripcion}}
	<br>
@endforeach

<h2>Listado de Secciones</h2>

@foreach($secciones as $seccion)
	Sección: {{ $seccion->seccion }} Mención: {{ $seccion->ano->ano }}
	<br>
@endforeach