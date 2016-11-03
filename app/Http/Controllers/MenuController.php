<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;

use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;
use Roscio\Menu;
use Roscio\Plato;
use Carbon\Carbon;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getMenu(Request $request, $fecha)
    {
        $fecha = Carbon::parse($fecha);
        $fecha->format('Y-m-d');
        $platos = Plato::all();
        $desayuno = Menu::where('fecha', $fecha)->where('tipo_ingreso_id', 1)->get();
        $almuerzo = Menu::where('fecha', $fecha)->where('tipo_ingreso_id', 2)->get();
        return response()->json(['desayuno' => $desayuno, 'almuerzo' => $almuerzo, 'platos' => $platos]);
    }

    public function index()
    {
        $sopas = Plato::where('categoria_plato_id', 1)->lists('plato', 'id');
        $principales = Plato::where('categoria_plato_id', 2)->lists('plato', 'id');
        $ensaladas = Plato::where('categoria_plato_id', 3)->lists('plato', 'id');
        $jugos = Plato::where('categoria_plato_id', 4)->lists('plato', 'id');
        $frutas = Plato::where('categoria_plato_id', 5)->lists('plato', 'id');
        return view('menu.index', compact('sopas', 'principales', 'ensaladas', 'jugos', 'frutas'));
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
