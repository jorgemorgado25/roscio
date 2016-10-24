<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;

use Roscio\Http\Requests;
use Roscio\Http\Requests\LoginRequest;
use Roscio\Http\Controllers\Controller;

use Auth;
use Session;
use Redirect;

class PruebaController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        Session::flash('success-message', 'Ha finalizado sesión exitosamente');
        return Redirect::route('login');
    }

    public function login()
    {
        return view('login');
    }
    
    public function store(LoginRequest $request)
    {
        if(Auth::attempt(['login' => $request['login'] , 'password' => $request['password']]))
        {
            if (Auth::user()->active == 0)
            {
                Auth::logout();
                Session::flash('error-message','Usted no tiene permisos para ingresar.');
                return Redirect::route('login');
            }
            return Redirect::route('prueba.index');
        }
        Session::flash('error-message','Sus credenciales son inválidas');
        return Redirect::route('login');
    }    
}
