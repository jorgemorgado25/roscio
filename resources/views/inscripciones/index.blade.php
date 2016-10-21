@extends('app')
@section('title')
	Listado de Inscripciones
@endsection
@section('main-content')
<div class="col-md-12">
	<h3>Listado de Inscripciones</h3><br>
	@include('partials.error-message')
	<div class="box box-primary">
		
		<div class="box-header with-border">
			<div class="row">
				<di class="col-xs-3">
					<div class="form-group">
						<label for="">Escolaridad</label>
						{!! Form::select('escolaridad_id', $escolaridades, NULL, ['class' => 'form-control']) !!}
					</div>				
				</di>
				<di class="col-xs-3">
					<div class="form-group">
						<label for="">Mención</label>
						{!! Form::select('mencion_id', $menciones, NULL, ['class' => 'form-control', 'placeholder' => '', 'required' => 'required', 'id' => 'sel-mencion']) !!}
					</div>				
				</di>
				<di class="col-xs-3">
					<div class="form-group">
						<label for="">Año</label>
						<select name="ano_id" id="sel_ano" class="form-control" required></select>
					</div>				
				</di>
				<div class="col-xs-2">
					<div class="form-group">
						<label for="">Sección</label>
						<select name="seccion_id" id="sel_seccion" class="form-control" placeholder="Selccione una seccion" required></select>
					</div>
				</div>
				<div class="col-xs-1">
					<button style="margin-top:2.2em" class="btn btn-sm btn-primary">
						<span class="glyphicon glyphicon-search"></span>
					</button>				
				</div>
			</div>		
		</div>
		<div class="box-body">
			<table class="table">
				<tr>
					<th>Cédula</th>
					<th>Nombre y Apellido</th>
					<th width="150px">Acciones</th>
				</tr>
				<tbody id="table-data">
					
				</tbody>
			</table>
			<div class="alert alert-danger text-center" id="alert">
				No se encontraron resultados
			</div>
		</div>
	</div>	
</div>
@endsection

@section('scripts')	
	<script src="{{ asset('/js/buscar-anos.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/buscar-secciones.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/mencion-ano-seccion.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/mencion-ano-seccion.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/inscripciones-index.js') }}" type="text/javascript"></script>
@endsection