@extends('app')
@section('title')
	Listado de Matricula
@endsection
@section('main-content')
<div class="col-md-12">
	<h3>Cargar Matrícula</h3><br>
	@include('partials.error-message')
	<div class="box box-primary">
		<div class="box-header with-border">
			Seleccione un archivo
		</div>
		<form action="{{ route('matricula.store') }}" method="POST" id="form-create"  enctype="multipart/form-data">
		<div class="box-body with-border">
			<div class="row">
				<div class="col-md-3">
					<p class="">
						<b>Escolaridad: </b> {{ $escolaridad->escolaridad }}
					</p>					
				</div>
				<div class="col-md-3">
					<b>Mención: </b> {{ $mencion->mencion }}
				</div>
				<div class="col-md-3">
					<b>Año: </b> {{ $ano->ano }}
				</div>
				<div class="col-md-3">
					<b>Sección: </b> {{ $seccion->seccion }}
				</div>		
				<br><br>
				<div class="col-md-12">
					<input type="file" name="excel" id="excel" @change="inputFileChange">
				</div>		
			</div>			
		</div>
		<div class="box-footer">
			<button class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Matrícula</button>
		</div>
		<input type="hidden" value="{{ $escolaridad->id }}" name="escolaridad_id">
		<input type="hidden" value="{{ $mencion->id }}" name="mencion_id">
		<input type="hidden" value="{{ $ano->id }}" name="ano_id">
		<input type="hidden" value="{{ $seccion->id }}" name="seccion_id">
		{{ csrf_field() }}
		</form>
	</div>	
</div>
@endsection