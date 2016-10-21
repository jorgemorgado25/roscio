var $form = $('#form-create');
$("#txt-login").focusout(function()
{
	var login = $("#txt-login").val();
	if(login.trim() != '')
	{
		$("#span-find").html("<i class='fa fa-spinner fa-spin'></i>");
		$.when(findLogin(login))
		.done(function (created)
		{
			$("#span-find").html("");
			if (created)
			{
				$("#div-login").removeClass('has-success').addClass('has-error');
				$("#label-login").html('<small"><i class="fa fa-times-circle-o"></i>&nbsp; Login registrado</small>');
			}else
			{
				$("#div-login").removeClass('has-error').addClass('has-success');
				$("#label-login").html('<i class="glyphicon glyphicon-ok"></i>&nbsp; Login disponible');
			}
		});
	}
});

$form.submit(function(event)
{
	QuieroEnviar();
	return false;
});

function QuieroEnviar()
{
	$("#btn-submit").prop('disabled', true);
	$.when(findLogin($("#txt-login").val()))
	.done(function (created)
	{
		$("#span-find").html("");
		if (created)
		{
			$("#div-login").removeClass('has-success').addClass('has-error');
			$("#label-login").html('<small"><i class="fa fa-times-circle-o"></i>&nbsp; Login registrado</small>');
			$("#btn-submit").prop('disabled', false);
		}else
		{
			$form.get(0).submit();
		}
	});	
}

function findLogin(login)
{
	var deferred = $.Deferred();
	var route = path + "users/login_created/" + login;
	var token = $("input[name='_token']" ).val();
	$.ajax({
		url : route,
		headers : {'X-CSRF-TOKEN': token},
		type : 'GET',
		dataType : 'json',
		success: function(response)
		{
			deferred.resolve(response.created);
		}
	});
	return deferred.promise();
}