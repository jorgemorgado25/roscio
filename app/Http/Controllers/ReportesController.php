<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use Session;
use Register;
use Roscio\Escolaridad;
use Roscio\Menu;
use Roscio\MenuDia; #Clase personalizada
use Roscio\Ano;
use Roscio\Entrada;
use DB;
use Carbon\Carbon;

use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->escolaridades = Escolaridad::lists('escolaridad', 'id');
    }

    public function reporteDiario()
    {
        return view('reportes.reporte_diario', ['escolaridades' => $this->escolaridades]);
    }

    public function getEntradasDiarias($fecha, $tipo_entrada, Request $request)
    {
        $date = Carbon::parse($fecha);
        $date->format('Y-m-d');

        $hayEntradas = Entrada::whereDate('created_at', '=', $date)
            ->where('tipo_ingreso_id', $tipo_entrada)
            ->first();

        if($hayEntradas)
        {
            $hayEntradas = true;
            $totales = $this->totalesDiarios($date, $tipo_entrada);
            
            $menu = new MenuDia();

            $menu->getMenu($fecha);
            $tipo_entrada == 1 ? $platos = $menu->desayuno : $platos = $menu->almuerzo;

            //dd($menu);
            
            return view('reportes.getEntradasDiarias', compact(
                'hayEntradas', 
                'fecha',
                'tipo_entrada',
                'platos',
                'totales'));
            
        }else
        {
            $hayEntradas = false;
            return view('reportes.getEntradasDiarias', compact('hayEntradas', 'fecha', 'tipo_entrada'));  
        }     
    }

    public function pdfEntradasDiarias($fecha, $tipo_entrada)
    {
        $date = Carbon::parse($fecha);
        $date->format('Y-m-d');
        $totales = $this->totalesDiarios($date, $tipo_entrada);
        $menu = new MenuDia();
        $menu->getMenu($fecha);
        $tipo_entrada == 1 ? $platos = $menu->desayuno : $platos = $menu->almuerzo;

        //dd($totales);
        $view =  \View::make('reportes.pdfEntradasDiarias', compact(
            'fecha', 'tipo_entrada', 'totales', 'platos'
            ))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('letter');
        //$pdf->loadHTML($view)->setPaper('a4')->setOrientation('landscape');
        return $pdf->stream('Reporte Entradas Diarias');
    }

    public function totalesDiarios($fecha, $tipo_entrada)
    {
        $primero = Ano::where('ano', '1ro')
            ->lists('id');
        $segundo = Ano::where('ano', '2do')
            ->lists('id');
        $tercero = Ano::where('ano', '3ro')
            ->lists('id');
        $cuarto = Ano::where('ano', '4to')
            ->lists('id');
        $quinto = Ano::where('ano', '5to')
            ->lists('id');

        $entradas_primero = $this->rsEntradas($fecha, $primero, $tipo_entrada);
        $entradas_segundo = $this->rsEntradas($fecha, $segundo, $tipo_entrada);
        $entradas_tercero = $this->rsEntradas($fecha, $tercero, $tipo_entrada);
        $entradas_cuarto = $this->rsEntradas($fecha, $cuarto, $tipo_entrada);
        $entradas_quinto = $this->rsEntradas($fecha, $quinto, $tipo_entrada);

        $m_primero = 0;
        $f_primero = 0;
        $m_segundo = 0;
        $f_segundo = 0;
        $m_tercero = 0;
        $f_tercero = 0;
        $m_cuarto = 0;
        $f_cuarto = 0;
        $m_quinto = 0;
        $f_quinto = 0;
        
        foreach ($entradas_primero as $entrada)
        {
            if ($entrada->student->gender == 'M')
            {
                $m_primero = $m_primero + 1;
            }else
            {
                $f_primero = $f_primero + 1;
            }
        }
        foreach ($entradas_segundo as $entrada)
        {
            if ($entrada->student->gender == 'M')
            {
                $m_segundo = $m_segundo + 1;
            }else
            {
                $f_segundo = $f_segundo + 1;
            }
        }
        foreach ($entradas_tercero as $entrada)
        {
            if ($entrada->student->gender == 'M')
            {
                $m_tercero = $m_tercero + 1;
            }else
            {
                $f_tercero = $f_tercero + 1;
            }
        }
        foreach ($entradas_cuarto as $entrada)
        {
            if ($entrada->student->gender == 'M')
            {
                $m_cuarto = $m_cuarto + 1;
            }else
            {
                $f_cuarto = $f_cuarto + 1;
            }
        }
        foreach ($entradas_quinto as $entrada)
        {
            if ($entrada->student->gender == 'M')
            {
                $m_quinto = $m_quinto + 1;
            }else
            {
                $f_quinto = $f_quinto + 1;
            }
        }

        $totales = array(
            'primero' => array('M' => $m_primero, 'F' => $f_primero),
            'segundo' => array('M' => $m_segundo, 'F' => $f_segundo),
            'tercero' => array('M' => $m_tercero, 'F' => $f_tercero),
            'cuarto' => array('M' => $m_cuarto, 'F' => $f_cuarto),
            'quinto' => array('M' => $m_quinto, 'F' => $f_quinto)
        );
        return $totales;
    }

    public function rsEntradas($fecha, $ano, $tipo_entrada)
    {
        $entradas = Entrada::whereIn('ano_id', $ano)
            ->whereDate('created_at', '=', $fecha)
            ->where('tipo_ingreso_id', $tipo_entrada)
            ->get();
        return $entradas;
    }
}
