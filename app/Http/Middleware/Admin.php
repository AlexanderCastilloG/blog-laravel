<?php

namespace App\Http\Middleware;

use Closure;
use Auth; //importar la clase autenticación
use Session; //importar la sesión

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::user()->admin){

            // Session::flash('info', 'You do not have permissions to perfom this action');

            return redirect()->route('home');

        }
        return $next($request);
    }
}
