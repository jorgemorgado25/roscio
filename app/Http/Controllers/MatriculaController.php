<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Carbon\Carbon;
use Roscio\Escolaridad;
use Roscio\Mencion;
use Roscio\Student;
use Roscio\Person;
use Roscio\Register;
use Roscio\Grado;
use Roscio\Ano;
use Roscio\Seccion;
use Roscio\Http\Requests;
use Redirect;
use Roscio\Http\Controllers\Controller;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escolaridades = Escolaridad::OrderIdDesc()->lists('escolaridad', 'id');
        $menciones = Mencion::lists('mencion', 'id');
        return view('matricula.index', compact('escolaridades', 'menciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('matricula.create');
    }

    public function cargar($escolaridad_id, $mencion_id, $ano_id, $seccion_id, Request $request)
    {
        $escolaridad = Escolaridad::find($escolaridad_id);
        $mencion = Mencion::find($mencion_id);
        $ano = Ano::find($ano_id);
        $seccion = Seccion::find($seccion_id);
        return view('matricula.create', compact('escolaridad', 'mencion', 'ano', 'seccion'));
    }

    public function postSendExcel(Request $request)
    {
        Excel::load($request->file('excel'), function($reader)
        {         
            $results = $reader->get();
            return $results;
            //dd($results);
            
            /*foreach($results as $result)
            {
                echo intval($result[2]) . ' ' . 
                $result[1] . ' ' . 
                $result[5]->format('Y-m-d') . ' ' .
                $result[4] . ' ' .
                $result[6] . ' ' . 
                '<br/>';
            }
            */
        });
    }

    public function getMatriculaSeccion($escolaridad_id, $seccion_id, Request $request)
    {
        $matriculas = Register::where('escolaridad_id', $escolaridad_id)
            ->where('seccion_id', $seccion_id)
            ->get();

        $result = '';
        foreach($matriculas as $m)
        {
            $result = array([
                'id' => $m->id,
                'estudiante_id' => $m->student->id,
                'cedula' => $m->student->ci,
                'nombre' => $m->student->full_name,
                'representante' => $m->person->full_name
            ]);
        }
        if($request->ajax())
        {
            return response()->json(['matricula' => $result]);
        }  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('excel');
        Excel::load($file, function($reader)
        {
            $results = $reader->get();
            $i = 1;
            /**
            Verifico la nómina
            **/
            foreach($results as $result)
            {
                $verify = $i . ' ' . intval($result[2]) . ' ' . 
                $result[1] . ' ' . 
                $result[5]->format('Y-m-d') . ' ' .
                $result[4] . ' ' .
                $result[6] . ' ' .
                //representante
                $result[10] . ' ' .
                $result[11] . ' ' .
                $result[12] . ' ' .
                $result[13] . ' ' ;
                $i++;
            }
            /**
            1 => Nombre del estudiante
            2 => Cédula del estudiante
            4 => lugar de Nacimiento
            5 => Fecha de Nacimiento
            6 => Género
            10 => Cédula del Representante
            11 => Nombre del Representante
            12 => Teléfono del Representante
            13 => Dirección del Representante
            **/

            // Verifico si existen los estudiantes y los representante
            // Los registro si no existen
            foreach ($results as $result)
            {
                $estudiante_id = '';
                $representante_id = '';
                $estudiante = Student::where('ci', $result[2])->first();
                if (!$estudiante)
                {
                    $student = new Student;
                    $student->ci = $result[2];
                    $student->full_name = $result[1];
                    $student->birth_place = $result[4];
                    $student->birthday = $result[5];
                    $student->gender = $result[6];
                    $student->save();
                    $estudiante_id = $student->id;
                }else
                {
                    $estudiante_id = $estudiante->id;
                }
                $representante = Person::where('ci', $result[10])->first();
                if (!$representante)
                {
                    $person = new Person;
                    $person->ci = $result[10];
                    $person->full_name = $result[11];
                    $person->phone = $result[12];
                    $person->address = $result[13];
                    $person->save();
                    $representante_id = $person->id;
                }else
                {
                    $representante_id = $representante->id;
                }
                //Registro la inscripción
                $inscripcion = Register::where('student_id', $estudiante_id);
                if (!$inscripcion)
                {
                    $inscripcion = new Register;
                    $inscripcion->student_id = $estudiante_id;
                    $inscripcion->person_id = $representante_id;
                    $inscripcion->save();
                }                
            }

        });
        return Redirect::route('matricula.index');        
    }

    public function comprobar()
    {
        //return view('matricula.comprobar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //dd($results);
        //return view('matricula.comprobar', compact('results'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
