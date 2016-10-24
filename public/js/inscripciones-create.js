/* OCULTAR DIVS */


$('#div-alert').hide();
$('#div-spinner').hide();

$('#div-nombre-estudiante').hide();
$('#div-nombre-representante').hide();


/* FOCUSOUT DE TXT-CEDULA */
$("#txt-cedula-estudiante").focusout(function()
{
	var cedula = $("#txt-cedula-estudiante").val();
	if(cedula.trim() != '')
	{
		$('#div-alert').hide();
		$('#div-spinner').show();
		$.when(buscar_estudiante_ci(cedula))
		.done(function(response)
		{
			$('#div-spinner').hide();
			if(response.created)
			{
				$('#p-nombre-estudiante').html(response.estudiante.nombre + ' ' + response.estudiante.apellido);
				$('#div-nombre-estudiante').show();
				$('#div-nombre-representante').show();
				$.when(buscar_persona_id(response.persona_id))
				.done(function(response)
				{
					$('#p-nombre-representante').html(response.persona.nombre + ' ' + response.persona.apellido);
				});
			}else
			{				
				$('#div-alert').show();
				$('#div-nombre-estudiante').hide();
				$('#div-nombre-representante').hide();
			}
		});
	}
});