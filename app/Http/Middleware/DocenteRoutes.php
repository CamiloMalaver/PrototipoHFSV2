<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class DocenteRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth()->check() && auth::user()->rol_id == 3){
            return $next($request);
        }
        
        if(isset(auth()->user()->rol_id)){
            switch(auth()->user()->rol_id){
                case 1:
                    return redirect()->route('administrador-usuarios');
                    break;
                case 2:
                    return redirect()->route('auditor-misdocentes');
                    break;
                case 3:
                    return redirect()->route('docente-misfunciones');
                    break;
            }
        }else{
            return redirect()->route('login');
        }
    }
}
