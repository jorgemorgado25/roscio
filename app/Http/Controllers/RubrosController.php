<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;
use Roscio\Rubro;
use Roscio\categoriaRubro;
use Redirect;
use Session;
use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;

class RubrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rubros = Rubro::all();
        return view('rubros.index', compact('rubros'));
    }

    public function getCategoriasRubros(Request $request)
    {
        $categorias = categoriaRubro::lists('categoria', 'id');
        if($request->ajax())
        {
            return response()->json($categorias);
        }
    }

    public function getRubros($categoria_id, Request $request)
    {        
        $rubros = Rubro::where('categoria_rubro_id', $categoria_id)->get();
        if ($rubros->toArray())
        {
            return response()->json(['rubros' => $rubros]);
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = categoriaRubro::lists('categoria', 'id');
        return view('rubros.create', compact('categoria'));
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
