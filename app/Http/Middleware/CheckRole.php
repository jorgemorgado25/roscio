<?php

namespace Roscio\Http\Middleware;
#Incluyo la clase para usar el auth
use Illuminate\Contracts\Auth\Guard;
use Closure;

class CheckRole
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
        $actions = $request->route()->getAction();
        $roles = $actions['roles'];
        if($this->auth->user()->hasAnyRole($roles))
        {
            return $next($request);
        }else
        {
            abort('401');
        }
    }
}
