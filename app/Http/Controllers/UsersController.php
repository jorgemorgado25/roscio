<?php

namespace Roscio\Http\Controllers;


use Illuminate\Http\Request; // comenté esto
//use Request; //Estoy colocando esto para ver el dd(request::all())
use Illuminate\Routing\Route;

use Roscio\Http\Requests;
use Roscio\Http\Requests\CreateUserRequest;
use Roscio\Http\Requests\EditUserRequest;
use Roscio\Http\Requests\UserChangePasswordRequest;
use Roscio\Http\Controllers\Controller;
use Roscio\User;
use Roscio\Role;
use Redirect;
use Session;
use Auth;
use Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        #antes de renderizar cualquier página del only, 
        #llama al método Buscar Usuario
        //$this->middleware('auth');
        $this->beforeFilter('@buscarUsuario', ['only' => 
            ['edit', 'update', 'destroy', 'eliminar', 'pdf']]);
    }

    public function getCreateAjax()
    {
        return view('users.crear');
    }
    public function postCreateAjax(Request $request)
    {
        if($request->ajax())
        {
            return response()->json([
                'message' => 'Creado exitosamente'
            ]);
        }   
    }

    public function buscarUsuario(Route $route)
    {
        $this->user = User::findOrFail($route->getParameter('users'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        //dd(Request::all());
        //User::create(Request::all()); # este método acciona el save de una

        //dd($request->all());
        #Esta es otra forma de guardar
        $user = new User($request->all());
        //$user->role = 'admin';
        
        $user->save();

        $this->assign_roles($request, $user);
        Session::flash('success-message', 'El usuario '. $user->full_name  . ' fue creado exitosamente.');
        return Redirect::route('users.index');
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

    public function pdf($id)
    {        
        $view =  \View::make('users.pdf', (['user' => $this->user]))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('letter');
        //$pdf->loadHTML($view)->setPaper('a4')->setOrientation('landscape');
        return $pdf->stream('Datos del Usuario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$user = User::findOrFail($id);
        //return view('users.edit', compact('user'));
        //dd($this->user->roles);
        return view('users.edit')->with('user', $this->user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        $this->user->fill($request->all());        
        $this->user->save();
        $this->assign_roles($request, $this->user);
        Session::flash('success-message', 'El usuario ' . $this->user->full_name . ' fue editado exitosamente.');
        return Redirect::route('users.edit', $this->user);
    }

    public function assign_roles($request, $user)
    {
        $user->roles()->detach();

        if ($request['role_inscripciones'])
        {
            $user->roles()->attach(Role::where('name', 'Inscripciones')->first());
        }
        if ($request['role_comedor'])
        {
            $user->roles()->attach(Role::where('name', 'Comedor')->first());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('success-message', 'El usuario ' . $this->user->full_name . ' fue eliminado exitosamente.');
        return Redirect::route('users.index');
        

        #------------ ESTA PARTE CON AJAX

        //return $id;
        //abort(500);
        /*
        $message = "El usuario " . $this->user->full_name . ' fue eliminado exitosamente";
        if($request->ajax())
        {
            return response()->json([
                'id'      => $id,
                'message' => $message
            ]);
        }*/
    }

    public function eliminar($id, Request $request)
    {
        $this->user->delete();
        $total = User::count();
        $message = "El usuario " . $this->user->full_name . ' fue eliminado exitosamente.';
        if($request->ajax())
        {
            return response()->json([
                'message' => $message,
                'total'   => $total
            ]);
        }        
    }

    public function login_created($login, Request $request)
    {
        $user = User::where('login', $login)->first();
        $created = $user ? true : false;
        if($request->ajax())
        {
            return response()->json([
                'created' => $created
            ]);
        }
    }

    public function getChangePassword()
    {
        return view('users.change_password');
    }

    public function postChangePassword(UserChangePasswordRequest $request)
    {
        $user = User::find(Auth::user()->id);
        if( Hash::check($request['current_password'], $user->password))
        {
            $user->fill($request->all());
            $user->save();
            Session::flash('success-message', 'Su contraseña fue cambiada exitosamente.');
        }else
        {
            Session::flash('error-message', 'La contraseña actual es incorrecta.');
        }
        return Redirect::route('user.change_password');    
    }

}