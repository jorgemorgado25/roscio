<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;
use Roscio\CategoriaPlato;
use Roscio\CategoriaRubro;
use Roscio\Plato;
use Redirect;
use Session;
use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;

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
        //
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
