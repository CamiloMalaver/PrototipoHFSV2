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
        $docentes = User::where('auditor_id', auth::user()->rol_id)->withCount('funcionsustantiva')->simplePaginate(10);
        return view('Auditor/misdocentes')->with(compact('docentes'));
    }

    public function gestionarDocenteView(int $id){
        $docente = User::where('id', $id)->first();
        $funciones = FuncionSustantiva::with('TipoFuncion')->with('estado')->where('usuario_id', $id)->get();
        $tipofuncion = TipoFuncion::all();
        return view('Auditor/gestionardocente')->with(compact('docente', 'funciones', 'tipofuncion'));
    }

    public function asignarFuncion(Request $request){
        $validated = $request->validate([
            'fecha_de_funcion' => 'required|date|after:today',
            'hora_de_inicio' => 'required',
            'hora_final' => 'required|after:hora_de_inicio',
            'select_function' => 'required|exists:tipo_funcion,nombre',
            'docente_id' => 'required|exists:users,id',
        ]);

        $tipofuncion = TipoFuncion::where('nombre', $request->select_function)->first();

        $funcion = new FuncionSustantiva();
        $funcion->usuario_id = $request->docente_id;
        $funcion->fecha = $request->fecha_de_funcion;
        $funcion->hora_inicio = $request->hora_de_inicio;
        $funcion->hora_final = $request->hora_final;
        $funcion->tipo_funcion_id = $tipofuncion->id;
        $funcion->estado_id = 1;

        $funcion->save();

        return redirect()->back()->with('message', 'Se ha asignado la función correctamente.');
    }
}
