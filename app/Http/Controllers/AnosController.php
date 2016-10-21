<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;

use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;
use Roscio\Ano;
use Roscio\Seccion;
class AnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anos = Ano::all();
        $secciones = Seccion::all();
        return view('anos.index', compact('anos', 'secciones'));
    }

    public function buscar_anos($mencion_id, Request $request)
    {
        $anos = Ano::where('mencion_id', $mencion_id)->lists('ano', 'id');
        if($request->ajax())
        {            
            return response()->json(['anos' => $anos]);
        }            
    }

    public function buscar_secciones($ano_id, Request $request)
    {
        $anos = Seccion::where('ano_id', $ano_id)->lists('seccion', 'id');
        if($request->ajax())
        {            
            return response()->json(['secciones' => $anos]);
        }            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
