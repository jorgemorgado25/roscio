<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use Session;
use Register;
use Roscio\Escolaridad;
use Roscio\Menu;

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
}
