<?php

namespace Roscio\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Redirect;
use Session;
class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
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
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                //return redirect()->guest('auth/login');
                Session::flash('error-message','Por favor, inicie sesión.');
                return Redirect::route('login');
            }
        }

        return $next($request);
    }
}
