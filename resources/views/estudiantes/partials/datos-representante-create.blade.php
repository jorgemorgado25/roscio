

<div id="div-representante" class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">Seleccione el Representante</h3>
	</div>
	
	<div class="box-body">		
		<div class="col-md-4">
			<input id="rd-madre" type="radio" name="radio_representante" value="1" class=""> &nbsp; Madre
		</div>
		<div class="col-md-4">
			<input id="rd-padre" type="radio" name="radio_representante" value="2" class=""> &nbsp; Padre
		</div>
		<div class="col-md-4">
			<span id="span-otro">
				<input id="rd-otro" type="radio" name="radio_representante" value="3" class=""> &nbsp; Otro
			</span>
		</div>		
	</div>

	<div id="div-datos-representante">
		<div class="box-header with-border">
			<h3 class="box-title">Datos del Representante</h3>
		</div>
		<div class="box-body">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control_label">Nacionalidad</label>
					{!! Form::select('nac_representante', ['V' => 'V', 'E' => 'E'], null, ['class' => 'form-control']) !!}
				</div>	
			</div>
			<div class="col-md-6">
				<div class="form-group" id="div-cedula-representante">
					<label for="" class="control_label">Cédula</label>
					{!! Form::text('cedula_representante', null, ['class' => 'form-control', 'placeholder' => 'Escribe la cédula', 'id' => 'txt-cedula-representante', 'maxlength' => 8]) !!}
				</div>	
			</div>
			<div class="col-md-6">
				<div class="form-group" id="div-nombre-representante">
					<label for="" class="control_label">Nombres</label>
					{!! Form::text('nombre_representante', null, ['class' => 'form-control', 'placeholder' => 'Escribe el nombre', 'id' => 'txt-nombre-representante', 'maxlength' => 80]) !!}
				</div>		
			</div>	
			<div class="col-md-6">
				<div class="form-group" id="div-apellido-representante">
					<label for="" class="control_label">Apellidos</label>
					{!! Form::text('apellido_representante', null, ['class' => 'form-control', 'placeholder' => 'Escribe el apellido', 'id' => 'txt-apellido-representante', 'maxlength' => 80]) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group" id="div-genero-representante">
					<label for="" class="control_label">Género</label>
					{!! Form::select('genero_representante', ['' => '', 'm' => 'Masculino', 'f' => 'Femenino'], null, ['class' => 'form-control', 'id' => 'txt-genero-representante']) !!}
				</div>
			</div>
			<div class="col-md-6" id="div-fecha-nac-representante">
				<div class="form-group">
					<label for="" class="control_label">Fecha de Nacimiento</label>
					<div class="input-group">
	                  <div class="input-group-addon">
	                    <i class="fa fa-calendar"></i>
	                  </div>
	                  <input name="fecha_nac_representante" id="txt-fecha-nac-representante" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
	                </div>
				</div>	
			</div>
			<div class="col-md-6">
				<div class="form-group" id="div-grado-representante">
					<label for="" class="control_label">Grado de Instrucción</label>
					{!! Form::text('grado_instruccion_representante', null, ['class' => 'form-control', 'placeholder' => 'Escribe el grado de instrucción', 'id' => 'txt-grado-representante', 'maxlength' => 15]) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group" id="div-profesion-representante">
					<label for="" class="control_label">Profesión u oficio</label>
					{!! Form::text('profesion_representante', null, ['class' => 'form-control', 'placeholder' => 'Escribe la profesión u oficio', 'id' => 'txt-profesion-representante', 'maxlength' => 40]) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group" id="div-telefono-representante">
					<label for="" class="control_label">Teléfono</label>
					{!! Form::text('telefono_representante', null, ['class' => 'form-control', 'placeholder' => 'Escribe el telefono', 'id' => 'txt-telefono-representante', 'maxlength' => 20]) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control_label">Correo electrónico</label>
					{!! Form::text('email_representante', null, ['class' => 'form-control', 'placeholder' => 'Escribe el correo electrónico', 'maxlength' => 80]) !!}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group" id="div-direccion-representante">
					<label for="" class="control_label">Dirección</label>
					{!! Form::text('direccion_representante', null, ['class' => 'form-control', 'placeholder' => 'Escribe la dirección', 'id' => 'txt-direccion-representante', 'maxlength' => 100]) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group" id="div-parentesco">
					<label for="" class="control_label">Parentesco</label>
					{!! Form::text('parentesco', null, ['class' => 'form-control', 'placeholder' => 'Escribe el parentesco', 'id' => 'txt-parentesco', 'maxlength' => 20]) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control_label">Autorización CMDNNA/CPNNA</label>
					<br>
					<input type="hidden" name="autorizacion" value=0>
					<input type="checkbox" class="minimal" name="autorizacion" value=1>
				</div>
			</div>
		</div>

	</div>

	<div class="box-footer">
		<div class="col-md-12">
			<a href="#" class="btn btn-primary" onclick="regresar_a_padre()"><span class="glyphicon glyphicon-chevron-left"></span> Anterior</a>

			<a href="#" class="btn btn-primary pull-right" onclick="campos_representante()"><span class="glyphicon glyphicon-ok"></span> &nbsp; Finalizar</a>

		</div>
	</div>
</div>