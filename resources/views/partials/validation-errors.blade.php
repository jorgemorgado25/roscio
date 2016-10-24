@if($errors->any())
	<div class="alert alert-danger alert-dismissible" role="alert">
		<p>Por favor, corrige los errores:</p>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif