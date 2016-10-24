<div class="box box-primary" id="div-estudiante">
	<div class="box-header with-border">
		<h3 class="box-title">Datos del Estudiante</h3>
	</div>
	<div class="box-body">
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Nacionalidad</label>
				{!! Form::select('nacionalidad', ['V' => 'V', 'E' => 'E'], null, ['class' => 'form-control']) !!}
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-cedula">
				<label>Cédula</label>
				{!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Escribe la cédula', 'id' => 'txt-cedula', 'maxlength' => 8]) !!}		
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-nombre">
				<label>Nombres</label>
				{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Escribe el nombre', 'id' => 'txt-nombre', 'maxlength' => 80]) !!}
			</div>		
		</div>	
		<div class="col-md-6">
			<div class="form-group" id="div-apellido">
				<label for="" class="control_label">Apellidos</label>
				{!! Form::text('apellido', null, ['class' => 'form-control', 'placeholder' => 'Escribe el apellido', 'id' => 'txt-apellido', 'maxlength' => 80]) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-genero">
				<label for="" class="control_label">Género</label>
				{!! Form::select('genero', ['' => '', 'm' => 'Masculino', 'f' => 'Femenino'], null, ['class' => 'form-control', 'id' => 'txt-genero']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-fecha_nac">
				<label for="" class="control_label">Fecha de Nacimiento</label>
				<div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="fecha_nac" id="txt-fecha_nac" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                </div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group" id="div-estado_nac">
				<label for="" class="control_label">Estado de Nacimiento</label>
				{!! Form::select('estado_nac', $estados->estados, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un estado', 'id' => 'txt-estado_nac']) !!}
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group" id="div-lugar_nac">
				<label for="" class="control_label">Lugar de Nacimiento</label>
				{!! Form::text('lugar_nac', null, ['class' => 'form-control', 'placeholder' => 'Escriba el lugar de nacimiento', 'id' => 'txt-lugar_nac', 'maxlength' => 80]) !!}
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group" id="div-direccion">
				<label for="" class="control_label">Dirección de Habitación</label>
				{!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Escriba la dirección', 'id' => 'txt-direccion', 'maxlength' => 80]) !!}
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="" class="control_label">Vive con la Madre</label>
				<br>
				<input type="hidden" name="vive_con_madre" value=0>
				<input type="checkbox" class="" name="vive_con_madre" value=1>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="" class="control_label">Vive con el Padre</label>
				<br>
				<input type="hidden" name="vive_con_padre" value=0>
				<input type="checkbox" class="" name="vive_con_padre" value=1>
			</div>
		</div>
	</div>

	<div class="box-header with-border">
		<h3 class="box-title">Información Médica</h3>
	</div>

	<div class="box-body">
		<div class="col-md-6">
			<div class="form-group" id="div-peso">
				<label for="" class="control_label">Peso</label>
				{!! Form::text('peso', null, ['class' => 'form-control', 'placeholder' => 'Escribe el paso en kilos', 'id' => 'txt-peso', 'maxlength' => 6]) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-talla">
				<label for="" class="control_label">Talla</label>
				{!! Form::text('talla', null, ['class' => 'form-control', 'placeholder' => 'Escribe la talla', 'id' => 'txt-talla', 'maxlength' => 4]) !!}
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group" id="div-grupo_sanguineo">
				<label for="" class="control_label">Grupo Sanguíneo</label>
				{!! Form::select('grupo_sanguineo', ['A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'O+' => 'O+', 'O-' => 'O-'], null, ['class' => 'form-control', 'placeholder' => 'Selecciona el grupo sanguineo', 'id' => 'txt-grupo_sanguineo']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Enfermedades o alérgias</label>
				{!! Form::text('enf_aler', null, ['class' => 'form-control', 'placeholder' => 'Escribe enfermedades o alérgias', 'maxlength' => 80]) !!}
			</div>
		</div>
	</div>	

	<div class="box-footer">
		<div class="col-md-12">
			<button type="button" id="btn-siguiente-estudiante" class="btn btn-primary pull-right" onclick="campos_estudiante()">Siguiente <span class="glyphicon glyphicon-chevron-right"></span></button>
		</div>
	</div>
</div>