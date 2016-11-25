<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;

use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;
use Roscio\Escolaridad;
use Roscio\Ingreso;
use Roscio\Inscripcion;

class ComedorController extends Controller
{
    public function getAcceso()
    {
    	return view('comedor.acceso');
    }

    public function acceso2()
    {
        
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
}
