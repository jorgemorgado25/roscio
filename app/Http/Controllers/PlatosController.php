<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;
use Roscio\CategoriaPlato;
use Roscio\CategoriaRubro;
use Roscio\PlatoRubro;
use Redirect;
use Session;
use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;
use Roscio\Plato;

class PlatosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCategoriasPlatos(Request $request)
    {
        $categorias = CategoriaPlato::lists('categoria', 'id');
        if($request->ajax())
        {
            return response()->json($categorias);
        }
    }
    public function getPlatos($categoria_id, Request $request)
    {
        $platos = Plato::where('categoria_plato_id', $categoria_id)->get();
        if ($platos->toArray())
        {
            foreach ($platos as $plato)
            {
                $result [] = [
                    'id' => $plato->id,
                    'plato' => $plato->plato,
                    'categoria' => $plato->categoriaPlato->categoria
                ];
            }
            //dd($result);
            return response()->json(['platos' => $result]);
        }
    }

    public function getPlato($id, Request $request)
    {
        $plato = Plato::find($id);        
        return response()->json(['plato' => $plato, 'categoria_plato' => $plato->categoriaPlato->categoria]);
    }

    public function index()
    {
        $categoria = CategoriaPlato::lists('categoria', 'id');
        return view('platos.index', compact('categoria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catPlatos = CategoriaPlato::lists('categoria', 'id');
        $catRubro = CategoriaRubro::lists('categoria', 'id');
        return view('platos.create', compact('catPlatos', 'catRubro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$plato_id = Plato::insertGetId($request->except('ingredientes'));
        $plato = new Plato($request->except('ingredientes'));
        $plato->save();
        foreach($request->ingredientes as $i)
        {
            PlatoRubro::create([
                'plato_id' => $plato->id, 
                'rubro_id' => $i['rubro_id'], 
                'cantidad' => $i['cantidad'],
                'medida'   => $i['medida']
            ]);
        }
        Session::flash('success-message', 'El plato ha sido registrado exitosamente');
        if($request->ajax())
        {
            return response()->json(['created' => true, 'plato_id' => $plato->id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plato = Plato::findOrFail($id);
        $catPlatos = CategoriaPlato::lists('categoria', 'id');
        return view('platos.show', compact('plato', 'catPlatos'));
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
    public function update(Request $request)
    {
        $plato = Plato::find($request->id);
        $plato->fill($request->except('id'));
        $plato->save();
        return response()->json(['updated' => true, 'plato' => $plato]);
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
