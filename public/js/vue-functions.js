var Funciones = Vue.extend({
	methods: {
		saludar: function() {
			console.log('hola');
		},
		buscarAnos: function(mencion_id)
		{
			return this.$http.get('/buscar_anos/' + mencion_id)
			.then(function(response){
				return Promise.resolve(response);
			});
		},
		buscarSecciones: function(ano_id)
		{
			return this.$http.get('/buscar_secciones/' + ano_id)
			.then(function(response){
				return Promise.resolve(response);
			});
		},
		buscarEstudianteCedula: function (cedula)
		{
			return this.$http.get('/buscar_estudiante_ci/' + cedula)
			.then(function(response)
			{
				return Promise.resolve(response);
			});
		},
		buscarPersonaId: function (id)
		{
			return this.$http.get('/buscar_persona_id/' + id)
			.then(function(response)
			{
				return Promise.resolve(response);
			});
		}
	}
});