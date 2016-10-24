@extends('app')
@section('main-content')
<h3>Registrar Usuario</h3><br>

<div class="box box-primary">	
	<div class="box-body">
			@include('partials.validation-errors')
			<form action="{{ route('users.store') }}" method="POST" id="form-create">
			@include('users.partials.fields')
									
	</div>
	<div class="box-footer">
		<div class="col-md-12">
			{{ csrf_field() }}
			<button class="btn btn-primary" type="submit" id="btn-submit"><span class="glyphicon glyphicon-floppy-disk"></span> Registrar</button>
			</form>
		</div>		
	</div>
</div>
@stop