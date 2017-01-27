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
use Session;
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

    }

    public function cargar($escolaridad_id, $mencion_id, $ano_id, $seccion_id, Request $request)
    {
        $escolaridad = Escolaridad::find($escolaridad_id);
        $mencion = Mencion::find($mencion_id);
        $ano = Ano::find($ano_id);
        $seccion = Seccion::find($seccion_id);
        return view('matricula.create', compact('escolaridad', 'mencion', 'ano', 'seccion'));
    }

    public function getMatriculaSeccion($escolaridad_id, $seccion_id, Request $request)
    {
        $matriculas = Register::where('escolaridad_id', $escolaridad_id)
            ->where('seccion_id', $seccion_id)
            ->get();

        $result = '';
        $n = 1;
        foreach ($matriculas as $m)
        {
            $result [] = array(
                'id' => $m->id,
                'n' => $n,
                'estudiante_id' => $m->student->id,
                'cedula' => $m->student->ci,
                'nombre' => $m->student->full_name,
                'representante' => $m->person->full_name
            );
            $n++;
        }
        if ($request->ajax())
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

    public function getFile($file)
    {
        return Excel::load($file, function($reader)
        {
            
        })->get();
    }

    public function store(Request $request)
    {
        $file = $request->file('excel');
        $results = $this->getFile($file);
        
        $i = 1;

        #Verifico la nómina
        foreach($results as $result)
        {
            $verify[] = $result[0] . ' ' . 
            $result[1] . ' ' . 
            $result[2] . ' ' .
            $result[3] . ' ' .
            $result[4] . ' ' .
            //representante
            $result[7] . ' ' .
            $result[8] . ' ' .
            $result[9] . ' ' ;
            $i++;
        }
        
        //dd($verify);
        
        /*
        0  ( A ) => Cédula del estudiante
        1  ( B ) => Nombre del estudiante
        2  ( C ) => lugar de Nacimiento
        3  ( D ) => Fecha de Nacimiento
        4  ( E ) => Género
        
        7 ( H ) => Nombre del Representante
        8 ( I ) => Cédula del Representante
        9 ( J ) => Dirección del Representante
        **/

        # Verifico si existen los estudiantes y los representante
        # Los registro si no existen

        $estudiante_id = '';
        $representante_id = '';

        foreach ($results as $result)
        {            
            $estudiante = Student::where('ci', $result[0])->first();
            if (!$estudiante)
            {
                $student = new Student();
                $student->ci = $result[0];
                $student->full_name = $result[1];
                $student->birth_place = $result[2];

                $birthday = Carbon::parse($result[3]);
                $birthday = $birthday->format('d-m-Y');

                $student->birthday = $birthday;
                $student->gender = $result[4];
                $student->save();
                $estudiante_id = $student->id;
            }else
            {
                $estudiante_id = $estudiante->id;
            }
            $representante = Person::where('ci', $result[8])->first();
            if (!$representante)
            {
                $person = new Person;
                $person->ci = $result[8];
                $person->full_name = $result[7];
                //$person->phone = $result[7];
                $person->address = $result[9];
                $person->save();
                $representante_id = $person->id;
            }else
            {
                $representante_id = $representante->id;
            }

            # Registro la inscripción
            
            $inscripcion = Register::where('student_id', $estudiante_id)
                ->where('escolaridad_id', $request->escolaridad_id)
                ->first();

            if (! $inscripcion)
            {
                $inscripcion = new Register;
                $inscripcion->student_id = $estudiante_id;
                $inscripcion->person_id = $representante_id;
                $inscripcion->escolaridad_id = $request->escolaridad_id;
                $inscripcion->mencion_id = $request->mencion_id;
                $inscripcion->ano_id = $request->ano_id;
                $inscripcion->seccion_id = $request->seccion_id;
                $inscripcion->save();
            }            
        }

        $escolaridad = Escolaridad::find($request->escolaridad_id);
        $mencion = Mencion::find($request->mencion_id);
        $ano = Ano::find($request->ano_id);
        $seccion = Seccion::find($request->seccion_id);

        Session::flash('success-message', 'La matrícula: ' . $escolaridad->escolaridad . 
            ',  Mención:  ' . $mencion->mencion . 
            ', Año: ' . $ano->ano . 
            ', Sección: ' . $seccion->seccion . 
            ', se cargó exitosamente');
        return Redirect::route('matricula.index');        
    }

    public function carnet($register_id)
    {
        $register = Register::find($register_id);

        $view =  \View::make('matricula.carnet', (['register' => $register]))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('letter');
        //$pdf->loadHTML($view)->setPaper('a4')->setOrientation('landscape');
        return $pdf->stream('Carnet');

        //return view('matricula.carnet', ['register' => $register]);
    }

    public function postEliminar(Request $request)
    {
        Register::where('escolaridad_id', $request->escolaridad_id)
            ->where('seccion_id', $request->seccion_id)
            ->delete();
        return response()->json(['deleted' => true ]);
    }

    public function postEliminarRegistro(Request $request)
    {
        Register::where('id', $request->register_id)->delete();
        return response()->json(['deleted' => true, 'register_id' => $request->register_id]);
    }   

}
