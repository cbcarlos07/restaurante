<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Session;
use Auth;

class UsuarioMiddlware
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


        if( !Auth::check() ){
            return redirect()->back();
        }

            return $next($request);
    }
}
