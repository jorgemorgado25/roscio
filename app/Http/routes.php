<?php

use Carbon\Carbon;

#Impido el acceso a estas rutas si esta logueado
Route::group(['middleware' => 'guest'], function()
{
	Route::get('/', [
		'uses' => 'PruebaController@login',
		'as'   => 'login'
	]);

	Route::get('login', [
		'uses' => 'PruebaController@login',
		'as'   => 'login'
	]);
});

Route::get('fecha', function(){
	echo Carbon::today()->format('Y-m-d');
});

#Inicio de sesion
Route::post('login',[
	'uses' => 'PruebaController@store',
	'as'   => 'login'
]);

Route::get('logout',[
	'uses' => 'PruebaController@logout',
	'as'   => 'logout'
]);

Route::group(['middleware' => 'auth'], function()
{
	Route::get('dashboard',[
		'uses' => 'PruebaController@index',
		'as'   => 'prueba.index'
	]);

	# Change password
	Route::get('change-password', [
		'uses' => 'UsersController@getChangePassword',
		'as'   => 'user.change_password'
	]);

	# Change password
	Route::post('change_password', [
		'uses' => 'UsersController@postChangePassword',
		'as'   => 'user.post.change_password'
	]);

	# Reportes
	Route::group(['prefix' => 'reportes'], function()
	{
		Route::get('reporteDiario', [
			'uses' => 'ReportesController@reporteDiario',
			'as' => 'reportes.reporteDiario'
		]);
	});	
});

#RUTAS CON MIDDLEWARE IS_ADMIN
Route::group(['middleware' => ['auth', 'is_admin'] ], function()
{
	#--------- USERS -----------
	Route::resource('users', 'UsersController');

	#--------  AÑOS ------------
	Route::resource('anos', 'AnosController');

	# ELIMINAR USUARIOS AJAX
	Route::get('users/eliminar/{users}', 'UsersController@eliminar');
	#PDF
	Route::get('user/pdf/{users}', [
		'uses' => 'UsersController@pdf',
		'as'   => 'user.pdf'
		]
	);
	#Find Email validate
	Route::get('users/login_created/{login}', 'UsersController@login_created');	
});

#RUTAS CON CHECK ROLE 'Comedor'
Route::group(['middleware' => ['auth', 'check_role'], 'roles' => 'Comedor'], function()
{
	Route::get('comedor/acceso', [
		'uses' => 'ComedorController@getAcceso',
		'as'   => 'comedor.acceso'
	]);
	Route::resource('rubros', 'RubrosController');
	Route::resource('platos', 'PlatosController');
	Route::resource('menu', 'MenuController');
});

#RUTAS CON CHECK ROLE 'Inscripciones'
Route::group(['middleware' => ['auth', 'check_role'], 'roles' => 'Inscripciones'], function()
{
	/* INSCRIPCIONES */
	Route::resource('inscripciones', 'InscripcionesController');
	Route::resource('escolaridades', 'EscolaridadesController');
	Route::resource('persons', 'PersonsController');

	/* MATRICULA */
	Route::resource('matricula', 'MatriculaController');
	Route::get('matricula/carnet/{register_id}', [
			'uses' => 'MatriculaController@carnet',
			'as' => 'matricula.carnet'
		]);
	Route::get('matricula/cargar/{escolaridad_id}/{mencion_id}/{ano_id}/{seccion_id}', 'MatriculaController@cargar');

	/* ESTUDIANTES */
	Route::resource('estudiantes', 'EstudiantesController');
	Route::resource('students', 'StudentsController');
	Route::get('estudiante/inscripciones/{estudiante_id}',
	[
		'uses' => 'EstudiantesController@inscripciones',
		'as'   => 'estudiante.inscripciones'
	]);
	Route::get('estudiantes/modificar_representante/{estudiante_id}',
	[
		'uses' => 'EstudiantesController@get_modificar_representante',
		'as'   => 'get_estudiante.modificar_representante'
	]);
	Route::post('estudiantes/modificar_representante',
	[
		'uses' => 'EstudiantesController@post_modificar_representante',
		'as'   => 'post_estudiante.modificar_representante'
	]);
	Route::get('estudiantes/ficha_inscripcion/{inscripcion_id}', [
		'uses' => 'EstudiantesController@ficha_inscripcion',
		'as'   => 'estudiantes.ficha_inscripcion'
		]
	);
	Route::get('estudiantes/carnet/{inscripcion_id}',
	[
		'uses' => 'EstudiantesController@carnet',
		'as'   => 'estudiantes.carnet'
	]);
	Route::resource('personas', 'PersonasController');
});


/* RUTAS PARA PETICIONES AJAX */
	Route::get('buscar_persona_ci/{cedula}', 'EstudiantesController@buscar_persona_ci');

	Route::get('buscar_persona_id/{id}', 'EstudiantesController@buscar_persona_id');

	Route::get('buscar_estudiante_ci/{cedula}', 'EstudiantesController@buscar_estudiante_ci');

	Route::get('buscar_anos/{mencion_id}', 'AnosController@buscar_anos');

	Route::get('buscar_secciones/{ano_id}', 'AnosController@buscar_secciones');
	
	Route::get('buscar_inscripciones_seccion/{escolaridad_id}/{seccion_id}', 'InscripcionesController@buscar_inscripciones_seccion');

	Route::get('student/buscar_ci/{cedula}', 'StudentsController@buscar_ci');

	Route::get('getCategoriasRubros', 'RubrosController@getCategoriasRubros');
	Route::get('getCategoriasPlatos', 'PlatosController@getCategoriasPlatos');
	Route::get('getRubros/{categoria_id}', 'RubrosController@getRubros');
	Route::get('getPlatos/{categoria_id}', 'PlatosController@getPlatos');
	Route::get('getPlato/{id}', 'PlatosController@getPlato');
	
	Route::get('comedor/getEntradasRegistradas/{fecha}/{tipo_ingreso}', 'ComedorController@getEntradasRegistradas');

	Route::get('menu/getCantidadPlatos/{fecha}/{tipo_ingreso}', 'MenuController@getCantidadPlatos');
	Route::get('menu/getMenu/{fecha}', 'MenuController@getMenu');

	Route::post('platos/updatePlato', 'PlatosController@update'); // update Plato
	Route::post('escolaridades/activar', 'EscolaridadesController@activar');
	Route::post('comedor/postRegistrarIngreso', 'ComedorController@postRegistrarIngreso');

	Route::post('comedor/postRegistrarEntrada', 'ComedorController@postRegistrarEntrada');

	Route::post('platos/postCreatePlato', 'PlatosController@store');

	Route::post('menu/saveDesayuno', 'MenuController@saveDesayuno');
	Route::post('menu/saveAlmuerzo', 'MenuController@saveAlmuerzo');
	Route::post('menu/postEliminar', 'MenuController@postEliminar');

	Route::get('matricula/getMatriculaSeccion/{escolaridad_id}/{seccion_id}', 'MatriculaController@getMatriculaSeccion');

	Route::post('matricula/postEliminar', 'MatriculaController@postEliminar');

	Route::post('matricula/postEliminarRegistro', 'MatriculaController@postEliminarRegistro');


	Route::get('reportes/getEntradasDiarias/{fecha}/{tipo_entrada}', 'ReportesController@getEntradasDiarias');
	
	Route::get('reportes/pdfEntradasDiarias/{fecha}/{tipo_entrada}', [
		'uses' => 'ReportesController@pdfEntradasDiarias',
		'as'   => 'pdfEntradasDiarias'
	]);