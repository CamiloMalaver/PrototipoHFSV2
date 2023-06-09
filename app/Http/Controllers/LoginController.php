<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function validarInicio(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if(auth()->user()->is_drop){
                return back()->withErrors([
                    'email' => 'Usuario inhabilitado.',
                ]);
            }

            switch ($user->rol_id) {
                case 1:
                    return redirect('/admin/usuarios');
                    break;
                case 2:
                    return redirect('/auditor/docentes');
                    break;
                case 3:
                    return redirect('/docente/misfunciones');
                    break;
            }
        }
        
        return back()->withErrors([
            'email' => 'Datos inválidos.',
        ]);
    }

    public function finalizarSesion(){
        if(Auth::check()){
            Auth::logout();
        }        
        return redirect('/');
    }
}
