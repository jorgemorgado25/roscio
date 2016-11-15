<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Carbon\Carbon;
use Roscio\Escolaridad;
use Roscio\Mencion;
use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;

class MatriculaController extends Controller
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
        return view('matricula.index', compact('escolaridades', 'menciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**
        1 => Nombre
        2 => Cédula
        4 => lugar de Nacimiento
        5 => Fecha de Nacimiento
        6 => Género
        10 => Cédula del Representante
        11 => Nombre del Representante
        12 => Teléfono del Representante
        13 => Dirección del Representante
        **/
        Excel::load('1-A.xlsx', function($reader)
        {            
            $results = $reader->get();
            //dd($results);

            foreach($results as $result)
            {
                echo intval($result[2]) . ' ' . 
                $result[1] . ' ' . 
                $result[5]->format('Y-m-d') . ' ' .
                $result[4] . ' ' .
                $result[6] . ' ' . 
                '<br/>';
            }
        });
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
