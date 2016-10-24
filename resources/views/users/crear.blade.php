@extends('app')
@section('main-content')

	<input type="text" name="first_name" id="first_name"/>
	<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
	<button id="btn-guardar">Guardar</button>

@endsection

@section('scripts')
<script>
	$(document).ready(function()
	{
		$("#btn-guardar").click(function()
		{
			var first_name = $("#first_name").val();
			var token = $("#token").val();
			console.log(first_name);
			
			$.post({
				url: path + 'crear',
				//headers: {"X-CSRF-TOKEN" : token},
				dataType: 'json',
				data: {first_name: first_name}
			});
			
		});
	});
</script>
@endsection