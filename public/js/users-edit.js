$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      		checkboxClass: 'icheckbox_minimal-blue'
    });

$(document).ready(function()
{
	$("#btn-eliminar").click(function()
	{
		bootbox.dialog({
		message: "¿Realmente desea eliminar el usuario?",
		title: "<span class='text-danger'><b>Eliminar Usuario</b></span>",
		buttons: {
		danger: {
		label: "Aceptar",
		className: "btn-default",
		callback: function()
		{
			console.log("enviar");
			$("#frm-enviar").submit();
		}
		},
		main: {
		label: "Cancelar",
		className: "btn-primary",
		callback: function() {

		}
		}
		}
		});
	});
});