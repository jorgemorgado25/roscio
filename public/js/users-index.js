
function eliminar(id)
{
	var nombre = $("#td-name-" + id).html(); 
	bootbox.dialog({
		message: "¿Realmente desea eliminar el usuario " + nombre + "?",
		title: "<span class='text-danger'><b>Eliminar Usuario</b></span>",
		buttons: {
		danger: {
		label: "Aceptar",
		className: "btn-default",
		callback: function()
		{
			var route = path + "users/eliminar/" + id;
			var token = $("#token").val();
			$.ajax({
				url : route,
				headers : {'X-CSRF-TOKEN': token},
				type : 'GET',
				dataType : 'json',
				success: function(response)
				{
					$("#total-users").html(response.total);
					var td = $("#td-" + id);
					td.hide();
					$.toast({
		                heading: 'Eliminar',
		                text: response.message,
		                icon: 'success',
		                loader: false,
		                position: 'bottom-right'
		            })
				}
			});
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
}
