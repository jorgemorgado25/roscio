@extends('app')
@section('title')
	Listado de Platos
@endsection
@section('main-content')
<h3>	
	<a class="btn btn-primary pull-right btn-sm" href="{{route('menu.create')}}">
		<span class="glyphicon glyphicon-plus"></span>
		Nuevo</a>
	Menú del Día</h3><br>	

<div class="box box-primary">
	<div class="box-header with-border">
		
	</div>

	<div class="box-body">

		
		
	</div>
	
</div>	
@endsection
	
@section('scripts')
<script src="{{ asset('/js/vue-functions.js') }}"></script>
<script>

</script>
@endsection