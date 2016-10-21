<div id="div-padre" class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Datos del Padre</h3>
	</div>
	<div class="box-body">
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Nacionalidad</label>
				{!! Form::select('nac_padre', ['V' => 'V', 'E' => 'E'], null, ['class' => 'form-control']) !!}
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-cedula-padre">
				<label for="" class="control_label">Cédula</label>
				{!! Form::text('cedula_padre', null, ['class' => 'form-control', 'placeholder' => 'Escribe la cédula', 'id' => 'txt-cedula-padre', 'maxlength' => 8]) !!}
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-nombre-padre">
				<label for="" class="control_label">Nombres</label>
				{!! Form::text('nombre_padre', null, ['class' => 'form-control', 'placeholder' => 'Escribe el nombre', 'maxlength' => 80, 'id' =>'txt-nombre-padre']) !!}
			</div>		
		</div>	
		<div class="col-md-6">
			<div class="form-group" id="div-apellido-padre">
				<label for="" class="control_label">Apellidos</label>
				{!! Form::text('apellido_padre', null, ['class' => 'form-control', 'placeholder' => 'Escribe el apellido', 'maxlength' => 80, 'id' => 'txt-apellido-padre']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group" id="div-fecha-nac-padre">
				<label for="" class="control_label">Fecha de Nacimiento</label>
				<div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="fecha_nac_padre" id="txt-fecha-nac-padre" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                </div>
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Grado de Instrucción</label>
				{!! Form::text('grado_instruccion_padre', null, ['class' => 'form-control', 'placeholder' => 'Escribe el grado de instrucción', 'maxlength' => 15, 'id' => 'txt-grado-padre']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Profesión u oficio</label>
				{!! Form::text('profesion_padre', null, ['class' => 'form-control', 'placeholder' => 'Escribe la profesión u oficio', 'maxlength' => 40, 'id' => 'txt-profesion-padre']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Teléfono</label>
				{!! Form::text('telefono_padre', null, ['class' => 'form-control', 'placeholder' => 'Escribe el telefono', 'maxlength' => 20, 'id' => 'txt-telefono-padre']) !!}
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="control_label">Dirección</label>
				{!! Form::text('direccion_padre', null, ['class' => 'form-control', 'placeholder' => 'Escribe la dirección', 'maxlength' => 100,'id' => 'txt-direccion-padre']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control_label">Correo electrónico</label>
				{!! Form::text('email_padre', null, ['class' => 'form-control', 'placeholder' => 'Escribe el correo electrónico', 'maxlength' => 80, 'id' => 'txt-email-padre']) !!}
			</div>
		</div>
		

		<div class="col-md-3">
			<div class="form-group">
				<label for="" class="control_label">Difunto</label>
				<br>
				<input type="hidden" name="padre_difunto" value=0>
				<input type="checkbox" class="" name="padre_difunto" value=1 id="chk-difunto-padre">
			</div>
		</div>
	</div>

	<input type="hidden" name="genero_padre" value="m">

	<div class="box-footer">
		<div class="col-md-12">
			<a href="#" class="btn btn-primary" onclick="regresar_a_madre()"><span class="glyphicon glyphicon-chevron-left"></span> Anterior</a>

			<a href="#" class="btn btn-primary pull-right" onclick="campos_padre()">Siguiente <span class="glyphicon glyphicon-chevron-right"></span></a>
		</div>
	</div>
</div>