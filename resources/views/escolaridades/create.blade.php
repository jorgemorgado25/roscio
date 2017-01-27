@extends('app')
@section('title')
	Nueva Escolaridad
@endsection
@section('main-content')
<div class="row">
<div class="col-md-12">
	<h3>Nueva Escolaridad</h3><br>
	@include('partials.error-message')
	@include('partials.validation-errors')
	<div class="box box-primary">
		<div class="box-header with-border">
			Datos de la Escolaridad
		</div>
		<form action="{{ route('escolaridades.store') }}" method="POST" id="form-create"  >
		<div class="box-body with-border">
			
				<div class="form-group">
					<label for="">Escolaridad</label>
					<input type="text" name="escolaridad" class="form-control" required placeholder="Escriba la escolaridad" maxlength="9">
				</div>
			
		</div>
		<div class="box-footer">
			<button class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Registrar</button>
		</div>		
		{{ csrf_field() }}
		</form>
	</div>
	</div>
</div>
@endsection