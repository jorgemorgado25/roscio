$(".alert").hide();
$("table").hide();


$("button").click(function()
{
	if ($("#sel_seccion").val() == null || $("#sel_seccion").val() == '')
	{
		$(".alert").html("Seleccione una Sección");
		$(".alert").fadeOut(100).fadeIn(100);
	}else
	{
		//Realizar la búsqueda
		$(".alert").hide();
	}
});
