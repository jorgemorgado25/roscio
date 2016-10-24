@extends('app')
@section('title')
	Modificar Representante
@endsection
@section('main-content')
<div class="col-md-6 col-md-offset-3">
<h3 class="text-center">Modificar Representante</h3><br>
@include('partials.error-message')
<div class="box box-primary">
	<form action="{{ route('inscripciones.store') }}" method="POST" id="form-create">

	<div class="box-header with-border">
		<h3 class="box-title">Datos del Estudiante</h3>		
	</div>
	<div class="box-body">
		
	</div>

	<div class="box-footer clearfix">
		{{ csrf_field() }}
		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> &nbsp;Inscribir Estudiante</button>
	</div>
	</form>
</div>	
</div>
@endsection

@section('scripts')
	
@endsection