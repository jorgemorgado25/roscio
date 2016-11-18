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
		},
		buscarInscripcionesSeccion: function (mencion_id, seccion_id)
		{
			return this.$http.get('/buscar_inscripciones_seccion/' + mencion_id + '/' + seccion_id)
			.then(function(response)
			{
				return Promise.resolve(response);
			});
		},
		getCategoriasRubros: function ()
		{
			return this.$http.get('/getCategoriasRubros')
			.then(function(response)
			{
				return Promise.resolve(response);
			});
		},
		getRubros: function (categoria_id)
		{
			return this.$http.get('/getRubros/' + categoria_id)
			.then(function(response)
			{
				return Promise.resolve(response);
			}).catch(function(response){
				return Promise.resolve(response);
			});
		},
		getCategoriasPlatos: function ()
		{
			return this.$http.get('/getCategoriasPlatos')
			.then(function(response)
			{
				return Promise.resolve(response);
			});
		},
		getPlatos: function(categoria_id)
		{
			return this.$http.get('/getPlatos/' + categoria_id)
			.then(function(response)
			{
				return Promise.resolve(response);
			}).catch(function(response){
				return Promise.resolve(response);
			});
		},
		getPlato: function(id)
		{
			return this.$http.get('/getPlato/' + id)
			.then(function(response)
			{
				return Promise.resolve(response);
			}).catch(function(response){
				return Promise.resolve(response);
			});
		},
		getMenu: function(fecha)
		{
			return this.$http.get('/menu/getMenu/' + fecha)
			.then(function(response)
			{
				return Promise.resolve(response);
			}).catch(function(response){
				return Promise.resolve(response);
			});
		},
		//Registers - Matriculas
		getBuscarMatriculaSeccion: function(escolaridad, seccion)
		{
			return this.$http.get('/matricula/getMatriculaSeccion/' + escolaridad +'/'+ seccion)
			.then(function(response)
			{
				return Promise.resolve(response);
			});
		},
		sendExcel: function()
		{
			
		}
	}
});