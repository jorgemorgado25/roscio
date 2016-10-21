<div id="div-madre" class="box box-danger">
	<div class="box-header with-border">
		<h3 class="box-title">Datos de la Madre</h3>
	</div>
	<div class="box-body">
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Nacionalidad</label>
				{!! Form::select('nac_madre', ['V' => 'V', 'E' => 'E'], null, ['class' => 'form-control']) !!}
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-cedula-madre">
				<label for="" class="control_label">Cédula</label>
				{!! Form::text('cedula_madre', null, ['class' => 'form-control', 'placeholder' => 'Escribe la cédula', 'id' => 'txt-cedula-madre', 'maxlength' => 8]) !!}
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-nombre-madre">
				<label for="" class="control_label">Nombres</label>
				{!! Form::text('nombre_madre', null, ['class' => 'form-control', 'placeholder' => 'Escribe el nombre', 'id' => 'txt-nombre-madre', 'maxlength' => 80]) !!}
			</div>		
		</div>	
		<div class="col-md-6">
			<div class="form-group" id="div-apellido-madre">
				<label for="" class="control_label">Apellidos</label>
				{!! Form::text('apellido_madre', null, ['class' => 'form-control', 'placeholder' => 'Escribe el apellido', 'id' => 'txt-apellido-madre', 'maxlength' => 80]) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-fecha-nac-madre">
				<label for="" class="control_label">Fecha de Nacimiento</label>
				<div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="fecha_nac_madre" id="txt-fecha-nac-madre" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                </div>
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-grado-madre">
				<label for="" class="control_label">Grado de Instrucción</label>
				{!! Form::text('grado_instruccion_madre', null, ['class' => 'form-control', 'placeholder' => 'Escribe el grado de instrucción', 'id' => 'txt-grado-madre', 'maxlength' => 15]) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Profesión u oficio</label>
				{!! Form::text('profesion_madre', null, ['class' => 'form-control', 'placeholder' => 'Escribe la profesión u oficio', 'id' => 'txt-profesion-madre', 'maxlength' => 40]) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Teléfono</label>
				{!! Form::text('telefono_madre', null, ['class' => 'form-control', 'placeholder' => 'Escribe el telefono', 'maxlength' => 20, 'id' => 'txt-telefono-madre']) !!}
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="control_label">Dirección</label>
				{!! Form::text('direccion_madre', null, ['class' => 'form-control', 'placeholder' => 'Escribe la dirección', 'maxlength' => 100, 'id' => 'txt-direccion-madre']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Correo electrónico</label>
				{!! Form::text('email_madre', null, ['class' => 'form-control', 'placeholder' => 'Escribe el correo electrónico', 'maxlength' => 80, 'id' => 'txt-email-madre']) !!}
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				<label for="" class="control_label">Difunta</label>
				<br>
				<input type="hidden" name="madre_difunta" value=0>
				<input type="checkbox" class="" name="madre_difunta" value=1 id="chk-difunto-madre">
			</div>
		</div>
	</div>

	<input type="hidden" name="genero_madre" value="f">

	<div class="box-footer">
		<div class="col-md-12">
			<a href="#" class="btn btn-primary" onclick="regresar_a_estudiante()"><span class="glyphicon glyphicon-chevron-left"></span> Anterior</a>

			<a href="#" class="btn btn-primary pull-right" onclick="campos_madre()">Siguiente <span class="glyphicon glyphicon-chevron-right"></span></a>
		</div>
	</div>
</div>