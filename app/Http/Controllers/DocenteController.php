<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuncionSustantiva;
use Illuminate\Support\Facades\Auth;

class DocenteController extends Controller
{
    public function misFuncionesView(){
        $funciones = FuncionSustantiva::with('TipoFuncion', 'estado')->where('usuario_id', auth::user()->id)->get();
        return view('Docente/misfunciones')->with(compact('funciones'));
    }

    public function informesView(){
        return view('Docente/informes');
    }
    public function ajustesView(){
        return view('Docente/ajustes');
    }
}
