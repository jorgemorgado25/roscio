<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;

use Roscio\Http\Requests;
use Roscio\Http\Requests\UpdateEstudianteRequest;
use Roscio\Http\Controllers\Controller;
use Roscio\Estados;
use Roscio\Estudiante;
use Roscio\Representante;
use Roscio\Persona;
use Roscio\Madre;
use Roscio\Padre;
use Roscio\Inscripcion;
use Session;
use Redirect;
use Auth;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        
        /*$estudiantes = Estudiante::where('nombre', 'LIKE', '%jorge%')
            ->orWhere('apellido', 'LIKE', '%jorge%')
            ->first();
        
        dd($estudiantes->madre);*/
        $estudiantes = Estudiante::Cedula($request->get('cedula'))
            ->Nombre($request->get('nombre'))
            ->paginate();
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function inscripciones($estudiante_id)
    {
        $estudiante = Estudiante::find($estudiante_id);
        return view("estudiantes.inscripciones", compact('estudiante'));
    }

    public function ficha_inscripcion($inscripcion_id)
    {
        $inscripcion = Inscripcion::find($inscripcion_id);
        //return view('estudiantes.ficha-inscripcion', compact('inscripcion'));
        
        $view =  \View::make('estudiantes.ficha-inscripcion', (['inscripcion' => $inscripcion]))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('letter');
        //$pdf->loadHTML($view)->setPaper('a4')->setOrientation('landscape');
        return $pdf->stream('Ficha de Inscripcion');        
    }

    public function get_modificar_representante()
    {
        return view('estudiantes.modificar-representante');
    }

    public function post_modificar_representante()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function buscar_persona_ci($cedula, Request $request)
    {
        $persona = Persona::where('cedula', $cedula)->first();
        $created = $persona ? true : false;
        if($request->ajax())
        {
            if($created)
            {
                return response()->json([
                    'created' => $created,
                    'persona' => $persona
                ]);
            }else
            {
                return response()->json([
                    'created' => $created
                ]);
            }            
        }
    }

    public function buscar_persona_id($id, Request $request)
    {
        $persona = Persona::where('id', $id)->first();
        $created = $persona ? true : false;
        if($request->ajax())
        {
            if($created)
            {
                return response()->json([
                    'created' => $created,
                    'persona' => $persona
                ]);
            }else
            {
                return response()->json([
                    'created' => $created
                ]);
            }            
        }
    }    

    public function buscar_estudiante_ci($cedula, Request $request)
    {
        //abort(404, 'Mi error');
        $estudiante = Estudiante::where('cedula', $cedula)->first();
        $created = $estudiante ? true : false;
        if($request->ajax())
        {
            if($created)
            {
                //INVIERTO LOS REPRESENTANTES
                $representante = $estudiante->representantes->reverse();
                return response()->json([
                    'created' => $created,
                    'estudiante' => $estudiante,
                    //ENVÍO SOLO EL ID DE LA PERSONA QUE ES REPRESENTANTE
                    'persona_id' => $representante[0]->persona_id
                ]);
            }else
            {
                return response()->json([
                    'created' => $created
                ]);
            }            
        }
    }

    public function create(Estados $estados)
    {
        
        return view('estudiantes.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $padre = Padre::where('cedula', $request->input('cedula_padre'))->first();
        if( ! $padre)
        {
            #No está registrada
            $padre = new Padre();
            $padre->nac = $request->input('nac_padre');
            $padre->cedula = $request->input('cedula_padre');
            $padre->nombre = $request->input('nombre_padre');     
            $padre->apellido = $request->input('apellido_padre');        
            $padre->genero = 'm';
            $padre->fecha_nac = $request->input('fecha_nac_padre');
            $padre->telefono = $request->input('telefono_padre');
            
            if ( trim($request->input('email_padre')) == '')
            {
                $padre->email = NULL;
            }else
            {
                $padre->email = $request->input('email_padre');
            }
            
            $padre->profesion = $request->input('profesion_padre');
            $padre->grado_instruccion = $request->input('grado_instruccion_padre');
            $padre->direccion = $request->input('direccion_padre');
            $padre->difunto = $request->input('padre_difunto');
            $padre->save();
        }

        $madre = Madre::where('cedula', $request->input('cedula_madre'))->first();
        if( ! $madre)
        {
            #No está registrada
            $madre = new Madre();
            $madre->nac = $request->input('nac_madre');
            $madre->cedula = $request->input('cedula_madre');
            $madre->nombre = $request->input('nombre_madre');     
            $madre->apellido = $request->input('apellido_madre');        
            $madre->genero = 'f';
            $madre->fecha_nac = $request->input('fecha_nac_madre');
            $madre->telefono = $request->input('telefono_madre');
            if ( trim($request->input('email_madre')) == '')
            {
                $madre->email = NULL;
            }else
            {
                $madre->email = $request->input('email_madre');
            }
            $madre->profesion = $request->input('profesion_madre');
            $madre->grado_instruccion = $request->input('grado_instruccion_madre');
            $madre->direccion = $request->input('direccion_madre');
            $madre->difunto = $request->input('madre_difunta');
            $madre->save();
        }

        #EL REPRESENTANTE ES OTRA PERSONA
        if ($request->input('radio_representante') == 3)
        {
            $persona = Persona::where('cedula', $request->input('cedula_representante'))->first();
            if(! $persona)
            {
                #NO ESTA REGISTRADO => SE REGISTRA REGISTRO
                $persona = new Persona();
                $persona->nac = $request->input('nac_representante');
                $persona->cedula = $request->input('cedula_representante');
                $persona->nombre = $request->input('nombre_representante');     
                $persona->apellido = $request->input('apellido_representante');        
                $persona->genero = $request->input('genero_representante');
                $persona->fecha_nac = $request->input('fecha_nac_representante');
                $persona->telefono = $request->input('telefono_representante');
                if ( trim($request->input('email_representante')) == '')
                {
                    $persona->email = NULL;
                }else
                {
                    $persona->email = $request->input('email_representante');
                }
                $persona->profesion = $request->input('profesion_representante');
                $persona->grado_instruccion = $request->input('grado_instruccion_representante');
                $persona->direccion = $request->input('direccion_representante');
                $persona->difunto = 0;
                $persona->save();    
            } #if persona
        } #if representante == 3

        $estudiante = new Estudiante();
        $estudiante->representante = $request->input('radio_representante');
        $estudiante->madre_id = $madre->id;
        $estudiante->padre_id = $padre->id;
        $estudiante->nac = $request->input('nacionalidad');
        $estudiante->cedula = $request->input('cedula');
        $estudiante->nombre = $request->input('nombre');
        $estudiante->apellido = $request->input('apellido');
        $estudiante->genero = $request->input('genero');
        $estudiante->fecha_nac = $request->input('fecha_nac');
        $estudiante->estado_nac = $request->input('estado_nac');
        $estudiante->lugar_nac = $request->input('lugar_nac');
        $estudiante->talla = $request->input('talla');
        $estudiante->peso = $request->input('peso');
        $estudiante->direccion = $request->input('direccion');
        $estudiante->grupo_sanguineo = $request->input('grupo_sanguineo');
        $estudiante->enf_aler = $request->input('enf_aler');

        $estudiante->vive_con_madre = $request->input('vive_con_madre');
        $estudiante->vive_con_padre = $request->input('vive_con_padre');
        $estudiante->save();

        $representante = new Representante();
        $representante->estudiante_id = $estudiante->id;

        switch ($request->input('radio_representante'))
        {
            case 1:
                #MADRE
                $representante->parentesco = 'MADRE';
                $representante->persona_id = $madre->id;
            break;
            case 2:
                #PADRE
                $representante->parentesco = 'PADRE';
                $representante->persona_id = $padre->id;
            break;
            case 3:
                #OTRO
                $representante->parentesco = $request->input('parentesco');
                $representante->autorizacion = $request->input('autorizacion');
                $representante->persona_id = $persona->id;
            break;
        } #end siwtch
        $representante->save();
        Session::flash('success-message', 'Estudiante registrado exitosamente.');
        return Redirect::route('estudiantes.show', $estudiante);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $representante = Representante::where('estudiante_id', $estudiante->id)
            ->IdDesc()
            ->first();
        //dd($representante);
        return view('estudiantes.view', compact('estudiante', 'representante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estados = new Estados();
        $estudiante = Estudiante::findOrFail($id);
        return view('estudiantes.edit', compact('estudiante', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEstudianteRequest $request, $id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->fill($request->all());        
        $estudiante->save();
        Session::flash('success-message', 'El estudiante fue editado exitosamente.');
        return Redirect::route('estudiantes.show', $estudiante);
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
