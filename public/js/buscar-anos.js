/*BUSCAR PERSONA POR CEDULA*/
function buscar_grados(mencion_id)
{
	var deferred = $.Deferred();
	var route = path + "buscar_anos/" + mencion_id;
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