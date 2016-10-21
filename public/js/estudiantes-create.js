$(document).ready(function()
{
	/* -------- OCULTAR DIV --------- */
	//$("#div-estudiante").hide();
	$("#div-madre").hide();
	$("#div-padre").hide();
	$("#div-representante").hide();
	$("#div-datos-representante").hide();
	$(".alert").hide();
	

	/* -------- ALPHANUM --------- */
	$("#txt-nombre, #txt-nombre-madre, #txt-nombre-padre, #txt-nombre-representante, #txt-apellido, #txt-apellido-madre, #txt-apellido-padre, #txt-apellido-representante, #txt-lugar_nac, #txt-parentesco").alpha();

	/* -------- ALPHANUM INTEGER --------- */
	$('#txt-cedula, #txt-cedula-madre, #txt-cedula-padre, #txt-cedula-representante').numeric({
    	allowMinus   : false,
    	allowThouSep : false,
    	allowDecSep: false
    });

	/* -------- ALPHANUM TELEFONO--------- */
	$("#txt-telefono-madre, #txt-telefono-padre, #txt-telefono-representante").alpha({
			allowNumeric : 'true',
			disallow: 'qwertyuiopasdfghjklzxcvbnmñQWERTYUIOPASDFGHJKLZXCVBNMÑ',
			allow: '()-'
		});	

	/* -------- ALPHANUM FLOAT --------- */
    $("#txt-peso, #txt-talla").numeric({
			allowMinus   : false,
	    	allowThouSep : false,
	    	allowDecSep: true,
	    	allow: '.'
		});

    /* -------- MINIMAL --------- */
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass: 'iradio_minimal-blue'
	});

	/* -------- MASK --------- */
	$("#txt-fecha_nac").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
	$("#txt-fecha-nac-madre").inputmask("dd/mm/yyyy", {"placeholder": "DD/MM/AAAA"});
	$("#txt-fecha-nac-padre").inputmask("dd/mm/yyyy", {"placeholder": "DD/MM/AAAA"});
	$("#txt-fecha-nac-representante").inputmask("dd/mm/yyyy", {"placeholder": "DD/MM/AAAA"});

	
	/* -------- RADIO REPRESENTANTE ------- */
	$('input:radio[name=radio_representante]').change(function()
	{
        if (this.value == '3')
        {
            $("#div-datos-representante").fadeIn(800);
        }else
        {
            $("#div-datos-representante").fadeOut();
        }
    });
});

/*------- VALIDAR CAMPOS ---------*/
function campos_estudiante()
{
	var a = [
		"cedula", 
		"nombre",
		"apellido",
		"genero",
		"fecha_nac",
		"estado_nac",
		"lugar_nac",
		"direccion",
		"peso",
		"talla",
		"grupo_sanguineo"
	];
	var enviar = true;
	for (index = 0, len = a.length; index < len; ++index)
	{
		$('#div-' + a[index]).removeClass('has-error');			
		if($('#txt-' + a[index]).val() == "")
		{
			enviar = false;
			$('#div-' + a[index]).addClass('has-error');	
		}
	}
	if (enviar)
	{
		$(".progress-bar").css('width','50%');
		$("#div-estudiante").hide();
		$("#div-madre").show(800);
	}	
}

/*------- VALIDAR CAMPOS ---------*/
function campos_madre()
{
	var a = [
		"cedula-madre", 
		"nombre-madre",
		"apellido-madre",
		"fecha-nac-madre",
	];
	var enviar = true;
	for (index = 0, len = a.length; index < len; ++index)
	{
		$('#div-' + a[index]).removeClass('has-error');			
		if ($('#txt-' + a[index]).val() == "")
		{
			var enviar = false;
			$('#div-' + a[index]).addClass('has-error');	
		}
	}
	if (enviar)
	{
		$(".progress-bar").css('width','75%');
		$("#div-madre").hide();
		$("#div-padre").show(800);
	}	
}

/*------- VALIDAR CAMPOS ---------*/
function campos_padre()
{
	var a = [
		"cedula-padre", 
		"nombre-padre",
		"apellido-padre",
		"fecha-nac-padre",
	];
	var enviar = true;
	for (index = 0, len = a.length; index < len; ++index)
	{
		$('#div-' + a[index]).removeClass('has-error');			
		if($('#txt-' + a[index]).val() == "")
		{
			var enviar = false;
			$('#div-' + a[index]).addClass('has-error');	
		}
	}
	if (enviar)
	{
		$(".progress-bar").css('width','100%');
		$("#div-padre").hide();
		$("#div-representante").show(800);
	}	
}

/*------- VALIDAR CAMPOS ---------*/
function campos_representante()
{
	if ($('[name="radio_representante"]').is(':checked'))
	{
		var enviar = true;
		$(".alert").hide();
		if ($('#rd-otro').is(':checked'))
		{
			var a = [
				"cedula-representante", 
				"nombre-representante",
				"apellido-representante",
				"fecha-nac-representante",
				"genero-representante",
				"direccion-representante",
				"parentesco"
			];
			
			for (index = 0, len = a.length; index < len; ++index)
			{
				$('#div-' + a[index]).removeClass('has-error');			
				if ($('#txt-' + a[index]).val() == "")
				{
					enviar = false;
					$('#div-' + a[index]).addClass('has-error');	
				}
			}
		}
		if (enviar)
		{
			$("#form-create").submit();
		}		
	}else
	{
		$(".alert").show();
		$(".alert").html("Seleccione una opción");
	}
}

/*------- REGRESAR ---------*/
function regresar_a_estudiante()
{
	$(".progress-bar").css('width','25%');
	$("#div-madre").hide(800);
	$("#div-estudiante").show(800);
}
/*------- REGRESAR ---------*/
function regresar_a_madre()
{
	$(".progress-bar").css('width','50%');
	$("#div-padre").hide(800);
	$("#div-madre").show(800);
}
/*------- REGRESAR ---------*/
function regresar_a_padre()
{
	$(".progress-bar").css('width','75%');
	$("#div-representante").hide(800);
	$("#div-padre").show(800);
}

/* ######################   VALIDACIONES AJAX   ################## */

/* FOCUSOUT DE TXT-CEDULA */
$("#txt-cedula").focusout(function()
{
	var cedula = $("#txt-cedula").val();
	if(cedula.trim() != '')
	{
		$.when(buscar_estudiante_ci(cedula))
		.done(function(response)
		{
			if(response.created)
			{
				$("#btn-siguiente-estudiante").prop('disabled', true);
				$("#div-cedula").removeClass('has-success').addClass('has-error');
				$(".alert").html('La cédula está registrada');
				$(".alert").show();
			}else
			{
				$("#btn-siguiente-estudiante").prop('disabled', false);
				$("#div-cedula").removeClass('has-error').addClass('has-success');
				$(".alert").hide();
			}
		});
	}
});

/* BUSCAR PERSONA */
$("#txt-cedula-madre").focusout(function()
{
	var cedula = $("#txt-cedula-madre").val();
	if(cedula.trim() != '')
	{
		$.when(buscar_persona_ci(cedula))
		.done(function(response)
		{
			if(response.created)
			{
				mostrar_datos('madre', response);
			}else
			{

			}
		});
	}
});

$("#txt-cedula-padre").focusout(function()
{
	var cedula = $("#txt-cedula-padre").val();
	if(cedula.trim() != '')
	{
		$.when(buscar_persona_ci(cedula))
		.done(function(response)
		{
			if(response.created)
			{
				mostrar_datos('padre', response);
			}else
			{

			}
		});
	}
});

function mostrar_datos(persona, data)
{
	$("#txt-nombre-" + persona).val(data.persona.nombre);
	$("#txt-apellido-" + persona).val(data.persona.apellido);
	$("#txt-grado-" + persona).val(data.persona.grado_instruccion);
	$("#txt-telefono-" + persona).val(data.persona.telefono);
	$("#txt-profesion-" + persona).val(data.persona.profesion);
	$("#txt-direccion-" + persona).val(data.persona.direccion);
	$("#txt-email-" + persona).val(data.persona.email);

	var ano = data.persona.fecha_nac.substring(0, 4);
	var mes = data.persona.fecha_nac.substring(5, 7);
	var dia = data.persona.fecha_nac.substring(8, 10);

	$("#txt-fecha-nac-" + persona).val(dia + '/' + mes + '/' + ano);
	console.log(data.persona.difunto);
	if (data.persona.difunto == '1')
	{
		$("#chk-difunto-" + persona).prop("checked", true);
	}
	
}
