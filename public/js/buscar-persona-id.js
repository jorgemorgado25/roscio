/*BUSCAR PERSONA POR ID*/
function buscar_persona_id(id)
{
	var deferred = $.Deferred();
	var route = path + "buscar_persona_id/" + id;
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