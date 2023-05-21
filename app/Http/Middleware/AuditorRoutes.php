<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuditorRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth()->check() && auth::user()->rol_id == 2){
            return $next($request);
        }
        
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
    }
}
