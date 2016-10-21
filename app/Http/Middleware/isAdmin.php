<?php

namespace Roscio\Http\Middleware;
#Incluyo la clase para usar el auth
use Illuminate\Contracts\Auth\Guard;
use Closure;

#Incluyo el session
use Session;

class isAdmin
{
    #Creo el constructor
    public function __construct(Guard $auth)
    {
        # Establezco la propiedad
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd($this->auth->user());
        #Lo obtengo por el Modelo User
        if (!$this->auth->user()->isAdmin)
        {
            if($request->ajax())
            {
                return response('No tiene privilegios', 401);
            }else
            {
                abort('401');
                /*
                Session::flash('error-message', 'Usted no tiene privilegios para ingresar al área solicitada.');
                return redirect()->route('prueba.index');
                */
            }
        }
        return $next($request);
    }
}
