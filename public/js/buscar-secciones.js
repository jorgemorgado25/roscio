/*BUSCAR PERSONA POR CEDULA*/
function buscar_secciones(ano_id)
{
	var deferred = $.Deferred();
	var route = path + "buscar_secciones/" + ano_id;
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