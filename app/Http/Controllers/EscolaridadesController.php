<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;

use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;
use Roscio\Escolaridad;
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
