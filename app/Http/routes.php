<?php

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
Route::group(['middleware' => ['auth', 'check_role'], 'roles' => 'Inscripciones'], function()
{
	Route::get('comedor/acceso', [
		'uses' => 'ComedorController@getAcceso',
		'as'   => 'comedor.acceso'
	]);
});

#RUTAS CON CHECK ROLE 'Inscripciones'
Route::group(['middleware' => ['auth', 'check_role'], 'roles' => 'Inscripciones'], function()
{
	/* INSCRIPCIONES */
	Route::resource('inscripciones', 'InscripcionesController');
	Route::resource('escolaridades', 'EscolaridadesController');

	/* ESTUDIANTES */
	Route::resource('estudiantes', 'EstudiantesController');
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
	Route::resource('personas', 'PersonasController');
});


/* RUTAS PARA PETICIONES AJAX */
	Route::get('buscar_persona_ci/{cedula}', 'EstudiantesController@buscar_persona_ci');
	Route::get('buscar_persona_id/{cedula}', 'EstudiantesController@buscar_persona_id');
	Route::get('buscar_estudiante_ci/{cedula}', 'EstudiantesController@buscar_estudiante_ci');
	Route::get('buscar_anos/{mencion_id}', 'AnosController@buscar_anos');
	Route::get('buscar_secciones/{ano_id}', 'AnosController@buscar_secciones');
	Route::post('escolaridades/activar', 'EscolaridadesController@activar');
	Route::post('comedor/postRegistrarIngreso', 'ComedorController@postRegistrarIngreso');