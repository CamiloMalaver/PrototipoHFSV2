<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TipoFuncion;
use App\Models\FuncionSustantiva;
use Illuminate\Support\Facades\Auth;

class AuditorController extends Controller
{
    public function misDocentesView(){
        $docentes = User::where('auditor_id', auth::user()->rol_id)->simplePaginate(10);
        return view('Auditor/misdocentes')->with(compact('docentes'));
    }

    public function gestionarDocenteView(int $id){
        $docente = User::where('id', $id)->first();
        $funciones = FuncionSustantiva::where('id_')
        return view('Auditor/gestionardocente')->with(compact('docente'));
    }
}
