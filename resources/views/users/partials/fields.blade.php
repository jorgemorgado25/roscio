<div class="col-md-6">
	<div class="form-group">
		<label for="first_name" class="control_label">@lang('validation.attributes.first_name')</label>

		{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Escribe el nombre']) !!}
	</div>	
</div>
<div class="col-md-6">
	<div class="form-group">
		<label for="last_name" class="control_label">@lang('validation.attributes.last_name')</label>
		{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Escribe el apellido']) !!}
	</div>		
</div>

<div class="col-md-6">
	<div class="form-group" id="div-login">
		{!! Form::label('login', 'Login de usuario', ['id' => 'label-login']) !!}
		&nbsp;&nbsp;<span id="span-find"></span>
		{!! Form::text('login', null, ['class' => 'form-control', 'placeholder' => 'Escribe login de usuario', 'id' => 'txt-login', 'required' => 'required']) !!}
		
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label('role', 'Tipo de Usuario') !!}
		{!! Form::select('role', ['' => '', 'user' => 'Usuario', 'admin' => 'Administrador'], null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label('password', 'Contraseña') !!}
		{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Escribe la contraseña']) !!}
	</div>	
</div>
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label('confirm_password', 'Confirmar contraseña') !!}
		{!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Confirma la contraseña']) !!}
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		<label for="">Cargo o Descripción</label>
		{!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Cargo o descripción']) !!}
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		<input type="hidden" name="active" value=0>
		<label for="">Activo</label><br>
		<input type="checkbox" class="minimal" name="active" checked value=1>
	</div>	
</div>

<div class="col-md-12">
	<p><b>Acceso a modulos: </b></p>
</div>
			
<div class="col-md-12">
	<input name="role_inscripciones" class="minimal" type="checkbox"> &nbsp; Inscripciones 
</div>
<div class="col-md-12">
	<input name="role_comedor" class="minimal" type="checkbox"> &nbsp; Comedor
</div>

@section('scripts')

<script>
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass: 'iradio_minimal-blue'
});
</script>
<script src="{{ asset('/js/users-create.js') }}"></script>
@endsection