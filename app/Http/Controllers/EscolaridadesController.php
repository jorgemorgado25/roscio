<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;

use Roscio\Http\Requests;
use Roscio\Http\Requests\CreateEscolaridadRequest;
use Roscio\Http\Requests\UpdateEscolaridadRequest;
use Roscio\Http\Controllers\Controller;
use Roscio\Escolaridad;
use Session;
use Redirect;
class EscolaridadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escolaridades = Escolaridad::orderBy('id', 'desc')->paginate();
        return view('escolaridades.index', compact('escolaridades'));
    }

    public function activar(Request $request)
    {
        //dd($request[0]);
        if($request->ajax())
        {
            Escolaridad::where('id', '!=', $request->id)->update(['active' => 0]);
            Escolaridad::find($request->id)->update(['active' => 1]);
            $esc = Escolaridad::find($request->id);
            return response()->json([
                'id'          => $request->id,
                'escolaridad' => $esc->escolaridad
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('escolaridades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEscolaridadRequest $request)
    {
        $escolaridad = new Escolaridad($request->all());
        $escolaridad->save();
        Session::flash('success-message', 'La Escolaridad ' . $escolaridad->escolaridad. ' fue creada exitosamente');
        return Redirect::route('escolaridades.index');
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
        $escolaridad = Escolaridad::findOrFail($id);
        return view('escolaridades.edit', compact('escolaridad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEscolaridadRequest $request, $id)
    {
        $escolaridad = Escolaridad::find($id);
        $escolaridad->fill($request->all());
        $escolaridad->save();
        Session::flash('success-message', 'Escolaridad actualizada exitosamente.');
        return Redirect::route('escolaridades.index');
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
