/*BUSCAR PERSONA POR CEDULA*/
function buscar_persona_ci(cedula)
{
	var deferred = $.Deferred();
	var route = path + "buscar_persona_ci/" + cedula;
	$.ajax({
		url : route,
		type : 'GET',
		dataType : 'json',
		success: function(response)
		{
			deferred.resolve(response);
		}
	});
	return deferred.promise();
}