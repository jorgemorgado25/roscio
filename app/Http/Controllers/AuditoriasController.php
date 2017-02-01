<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;
use Roscio\Auditoria;

class AuditoriasController extends Controller
{
    public function index()
    {
    	$auditorias = Auditoria::OrderBy('id', 'desc')->paginate(20);
    	return view('auditorias.index', compact('auditorias'));
    }
}
