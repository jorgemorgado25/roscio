<?php

use Illuminate\Database\Seeder;
use Roscio\Estudiante;
use Roscio\Madre;
use Roscio\Padre;
use Roscio\Representante;
use Roscio\Persona;

class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::Table('personas')->truncate();
    	DB::Table('estudiantes')->truncate();
    	DB::Table('representantes')->truncate();
    	
		$madre = new Madre();
		$madre->nac = 'v';
		$madre->cedula = '5598427';
		$madre->nombre = 'MARGARITA JOSEFINA';        
		$madre->apellido = 'ABREU CUMARIN';        
		$madre->genero = 'f';
		$madre->fecha_nac = '27-11-1960';
		$madre->telefono = '04147563486';
		//$madre->email = '';
		//$madre->email = 'margaritabreu3@yahoo.com';
		$madre->profesion = 'DOCENTE';
		$madre->grado_instruccion = 'LICENCIADA';
		$madre->direccion = 'LA MORERA';
		$madre->difunto = 0;
		$madre->save();

		$padre = new Padre();
		$padre->nac = 'v';
		$padre->cedula = '2521505';
		$padre->nombre = 'JOSE LUIS';        
		$padre->apellido = 'MORGADO REINA';        
		$padre->genero = 'm';
		$padre->fecha_nac = '14-08-1954';
		$padre->telefono = '04143434486';
		//$padre->email = '';
		//$padre->email = 'joseluismorgado54@hotmail.com';
		$padre->profesion = 'COMERCIANTE';
		$padre->grado_instruccion = 'SECUNDARIA';
		$padre->direccion = 'FLORES';
		$padre->difunto = 0;
		$padre->save();

		$estudiante = new Estudiante();
		$estudiante->nac = 'v';
		$estudiante->cedula = '15392404';
		$estudiante->nombre = 'JORGE LUIS';        
		$estudiante->apellido = 'MORGADO ABREU';        
		$estudiante->genero = 'm';
		$estudiante->fecha_nac = '11-02-1983';
		$estudiante->estado_nac = 'GUARICO';
		$estudiante->lugar_nac = 'SAN JUAN DE LOS MORROS';
		$estudiante->direccion = 'LA MORERA';
		$estudiante->talla = '1.65';
		$estudiante->peso = '70.5';
		$estudiante->grupo_sanguineo = 'O+';
		$estudiante->enf_aler = '';
		$estudiante->vive_con_madre = 0;
		$estudiante->vive_con_padre = 0;
		$estudiante->representante = '1';

		$estudiante->madre_id = $madre->id;
		$estudiante->padre_id = $padre->id;

		$estudiante->save();


		$persona = new Persona();
		$persona->nac = 'v';
		$persona->cedula = '9865348';
		$persona->nombre = 'LAURA MARIA';        
		$persona->apellido = 'PEREZ COLMENARES';        
		$persona->genero = 'f';
		$persona->fecha_nac = '13-05-1970';
		$persona->telefono = '04147563486';
		$persona->email = 'laura3@yahoo.com';
		$persona->profesion = 'DOCENTE';
		$persona->grado_instruccion = 'LICENCIADA';
		$persona->direccion = 'CENTRO';
		$padre->difunto = 0;
		$persona->save();

		$representante = new Representante();
		$representante->estudiante_id = $estudiante->id;
		$representante->persona_id = $madre->id;
		$representante->parentesco = 'MADRE';
		$representante->save();
    }
}