<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;

use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;
use Roscio\Escolaridad;
use Roscio\Ingreso;
use Roscio\Entrada;
use Roscio\Inscripcion;
use Roscio\Register;
use Carbon\Carbon;
use DB;

class ComedorController extends Controller
{
    public function getAcceso()
    {
    	return view('comedor.acceso');
    }

    public function acceso2()
    {
        
    }

    public function getEntradasRegistradas($fecha, $tipo_ingreso, Request $request)
    {
        $total = Entrada::whereDate('created_at', '=', $fecha)
            ->where('tipo_ingreso_id', $tipo_ingreso)
            ->count();
        return response()->json(['total' => $total]);
    }

    public function postRegistrarIngreso(Request $request)
    {
    	//Debo verificar si el estudiante está insrito y en la escolaridad activa
        $escolaridad = Escolaridad::where('active', 1)->first();
        $inscripcion = Inscripcion::where('estudiante_id', $request->id)
            ->where('escolaridad_id', $escolaridad->id)
            ->first();
    	if ($request->ajax())
    	{
            //Está inscrito
            if($inscripcion)
            {
                //registro el ingreso
                $ingreso = new Ingreso;
                $ingreso->escolaridad_id = $escolaridad->id;
                $ingreso->estudiante_id = $request->id;
                $ingreso->mencion_id = $inscripcion->id;
                $ingreso->escolaridad_id = $escolaridad->id;                
                $ingreso->ano_id = $inscripcion->ano_id;                
                $ingreso->seccion_id = $inscripcion->seccion_id;                
                $ingreso->save();
                return response()->json([
                    'error' => false
                ]);
            }else
            {
                return response()->json([
                    'error' => true,
                    'message' => 'El estudiante no está inscrito',
                ]);
            }
    	}
    }

    public function postRegistrarEntrada(Request $request)
    {
        //Debo verificar si el estudiante está insrito y en la escolaridad activa
        $escolaridad = Escolaridad::where('active', 1)->first();
        $register = Register::where('student_id', $request->student_id)
            ->where('escolaridad_id', $escolaridad->id)
            ->first();
        if ($request->ajax())
        {
            //Está inscrito
            if($register)
            {                
                #Verifico que no ha entrado al comedor
                $entrada = Entrada::where('tipo_ingreso_id', $request->tipo_ingreso)
                    ->where(DB::raw('date(created_at)'), Carbon::today())
                    ->where('student_id', $request->student_id)
                    ->first();
                if($entrada)
                {
                    return response()->json([
                        'error' => true,
                        'message' => 'El estudiante ya ha ingresado a comedor',
                    ]);
                }else
                {
                    #registro el ingreso
                    $entrada = new Entrada;
                    $entrada->escolaridad_id = $escolaridad->id;
                    $entrada->student_id = $request->student_id;
                    $entrada->mencion_id = $register->id;
                    $entrada->tipo_ingreso_id = $request->tipo_ingreso;
                    $entrada->ano_id = $register->ano_id;                
                    $entrada->seccion_id = $register->seccion_id;                
                    $entrada->save();
                    return response()->json([
                        'error' => false
                    ]);
                }                
            }else
            {
                return response()->json([
                    'error' => true,
                    'message' => 'El estudiante no está inscrito',
                ]);
            }
        }
    }
}
