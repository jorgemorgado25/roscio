<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;

use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;
use Roscio\Escolaridad;
use Roscio\Estudiante;
use Roscio\Mencion;
use Roscio\Inscripcion;
use Roscio\Representante;
use Session;
use Redirect;

class InscripcionesController extends Controller
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
        return view('inscripciones.index', compact('escolaridades', 'menciones'));
    }

    public function buscar_inscripciones_seccion($seccion_id, Request $request)
    {
        $inscripciones = Inscripcion::where('seccion_id', $seccion_id)->get();
        $estudiantes = [];
        foreach($inscripciones as $inscripcion)
        {
            $estudiantes = array([
                'id' => $inscripcion->estudiante->id,
                'cedula' => $inscripcion->estudiante->cedula,
                'nombre' => $inscripcion->estudiante->nombre,
                'apellido'=> $inscripcion->estudiante->apellido
            ]);
        }
        if($request->ajax())
        {
            return response()->json(['estudiantes' => $estudiantes]);
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cedula = $request->get('cedula');
        $escolaridad = Escolaridad::OrderIdDesc()->lists('escolaridad', 'id');
        $menciones = Mencion::lists('mencion', 'id');
        return view('inscripciones.create', compact('escolaridad', 'menciones', 'cedula'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $estudiante = Estudiante::where('cedula', $request->input('cedula'))->first();
        if(! $estudiante)
        {
            return redirect::route('inscripciones.create')
            ->with('error-message', 'El estudiante no está registrado');
        }

        $inscrito = Inscripcion::where('estudiante_id', $estudiante->id)
            ->where('escolaridad_id', $request->input('escolaridad_id'))
            ->first();

        if($inscrito)
        {
            return redirect::route('inscripciones.create')
            ->with('error-message', 'El Estudiante se encuentra inscrito en la escolaridad actual');
        }

        //OBTENGO E INVIERTO EL REPRESENTANTE
        $representante = $estudiante->representantes->reverse();
        $request['estudiante_id'] = $estudiante->id;
        //dd($representante[0]->id);
        $request['representante_id'] = $representante[0]->id;
        $inscripcion = new Inscripcion($request->all());
        $inscripcion->save();
        return redirect::route('estudiante.inscripciones', $estudiante->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
