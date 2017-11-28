<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class UsuarioAltMiddlware
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
        $user = Auth::user();
        if( $user->sn_senha_atual == 'N' ){
           // echo "Alterar id: ".$user->id;
            return redirect()->route( 'usu.alterar');
        }

        return $next($request);
    }
}
