@extends('app')
@section('title')
	Crear Rubro
@endsection
@section('main-content')
<h3>Registrar Rubro</h3><br>
<div class="box box-primary">
	<form action="{{ route('rubros.store') }}" method="POST" id="form-create">
	<div class="box-header with-border">
	
		<div class="row">
		<div class="col-md-6">
				<div class="form-group">
					<label for="">Nombre del rubro</label>
					<input name="rubro" type="text" class="form-control" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Categoría</label>
					{!! Form::select('categoria_rubro_id', $categoria, null, ['class' => 'form-control', 'placeholder' => 'Seleccione', 'required' => 'required']) !!}
				</div>
			</div>			
		</div>
	</div>
	<div class="box-body">
		{{ csrf_field() }}
		<button class="btn btn-primary" type="submit" id="btn-submit"><span class="glyphicon glyphicon-floppy-disk"></span> Registrar</button>
	</div>
	</form>
</div>	
@endsection