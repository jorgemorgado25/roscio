$("#sel-mencion").change(function()
{
	mencion_id = $("#sel-mencion").val();
	$.when(buscar_grados(mencion_id))
	.done(function(response)
	{
		$("#sel_ano").empty();
		$("#sel_seccion").empty();
		$("#sel_ano").append("<option value=''></option>");
		jQuery.each(response.anos, function(i, val) {
  			$("#sel_ano").append("<option value=" + i + "> " + val + "</option>");
		});
	});
});

$("#sel_ano").change(function()
{
	ano_id = $("#sel_ano").val();
	$.when(buscar_secciones(ano_id))
	.done(function(response)
	{
		$("#sel_seccion").empty();
		$("#sel_seccion").append("<option value=''></option>");
		jQuery.each(response.secciones, function(i, val) {
  			$("#sel_seccion").append("<option value=" + i + "> " + val + "</option>");
		});
	});
});