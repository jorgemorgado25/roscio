<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;

use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;
use Roscio\Menu;
use Roscio\Plato;
use Carbon\Carbon;
use Roscio\MenuDia;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getMenu(Request $request, $fecha = null)
    {
        if ($fecha == null)
        {
            $fecha = new Carbon('Y-m-d');
        }else{
            $fecha = Carbon::parse($fecha);
            $fecha->format('Y-m-d');
        }
        
        $platos = Plato::all();
        $desayuno = Menu::where('fecha', $fecha)->where('tipo_ingreso_id', 1)->get();
        $almuerzo = Menu::where('fecha', $fecha)->where('tipo_ingreso_id', 2)->get();
        return response()->json([
            'desayuno' => $desayuno, 
            'almuerzo' => $almuerzo, 
            'platos' => $platos]);
    }

    public function getCantidadPlatos($fecha, $tipo_ingreso, Request $request)
    {
        $cantidad = Menu::where('fecha', $fecha)
            ->where('tipo_ingreso_id', $tipo_ingreso)
            ->first();
        if($cantidad){
            return response()->json(['cantidad' => $cantidad->cantidad, 'error' => false]);
        }else{
            return response()->json(['error' => true]);
        }
        
    }

    public function index()
    {
        $desayunos = Plato::where('categoria_plato_id', 1)->lists('plato', 'id');
        $sopas = Plato::where('categoria_plato_id', 2)->lists('plato', 'id');
        $principales = Plato::where('categoria_plato_id', 3)->lists('plato', 'id');
        $ensaladas = Plato::where('categoria_plato_id', 4   )->lists('plato', 'id');
        $bebidas = Plato::where('categoria_plato_id', 5)->lists('plato', 'id');
        $frutas = Plato::where('categoria_plato_id', 6)->lists('plato', 'id');
        return view('menu.index', compact('desayunos', 'sopas', 'principales', 'ensaladas', 'bebidas', 'frutas'));
    }

    public function saveDesayuno(Request $request)
    {
        $fecha = Carbon::parse($request['fecha']);
        $fecha->format('Y-m-d');
        if ($request['desayuno'] != '')
        {
            $menu = new Menu();
            $menu->plato_id = $request['desayuno'];
            $menu->tipo_ingreso_id = 1;
            $menu->cantidad = $request['cantidad'];
            $menu->fecha = $fecha;
            $menu->save();
        }

        if ($request['jugo'] != '')
        {
            $menu = new Menu();
            $menu->plato_id = $request['jugo'];
            $menu->tipo_ingreso_id = 1;
            $menu->cantidad = $request['cantidad'];
            $menu->fecha = $fecha;
            $menu->save();
        }
        if ($request['fruta'] != '')
        {
            $menu = new Menu();
            $menu->plato_id = $request['fruta'];
            $menu->tipo_ingreso_id = 1;
            $menu->cantidad = $request['cantidad'];
            $menu->fecha = $fecha;
            $menu->save();
        }
        return response()->json(['created' => true, 'desayuno' => $request->all()]);
    }

    public function saveAlmuerzo(Request $request)
    {
        $fecha = Carbon::parse($request['fecha']);
        $fecha->format('Y-m-d');
        if ($request['platoPrincipal'] != '')
        {
            $menu = new Menu();
            $menu->plato_id = $request['platoPrincipal'];
            $menu->tipo_ingreso_id = 2;
            $menu->cantidad = $request['cantidad'];
            $menu->fecha = $fecha;
            $menu->save();
        }
        if ($request['ensalada'] != '')
        {
            $menu = new Menu();
            $menu->plato_id = $request['ensalada'];
            $menu->tipo_ingreso_id = 2;
            $menu->cantidad = $request['cantidad'];
            $menu->fecha = $fecha;
            $menu->save();
        }
        if ($request['sopa'] != '')
        {
            $menu = new Menu();
            $menu->plato_id = $request['sopa'];
            $menu->tipo_ingreso_id = 2;
            $menu->cantidad = $request['cantidad'];
            $menu->fecha = $fecha;
            $menu->save();
        }
        if ($request['jugo'] != '')
        {
            $menu = new Menu();
            $menu->plato_id = $request['jugo'];
            $menu->tipo_ingreso_id = 2;
            $menu->cantidad = $request['cantidad'];
            $menu->fecha = $fecha;
            $menu->save();
        }
        if ($request['fruta'] != '')
        {
            $menu = new Menu();
            $menu->plato_id = $request['fruta'];
            $menu->tipo_ingreso_id = 2;
            $menu->cantidad = $request['cantidad'];
            $menu->fecha = $fecha;
            $menu->save();
        }
        
        return response()->json(['created' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function postEliminar(Request $request)
    {
        $fecha = Carbon::parse($request['fecha']);
        $fecha->format('Y-m-d');
        Menu::where('fecha', $fecha)
            ->where('tipo_ingreso_id', $request->tipo_ingreso_id)
            ->delete();
        return response()->json(['deleted' => true ]);

    }
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
        
    }
}
