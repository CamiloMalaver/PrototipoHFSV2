<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TipoFuncion;
use App\Models\FuncionSustantiva;
use Illuminate\Support\Facades\Auth;

class AuditorController extends Controller
{
    public function misDocentesView(){
        $docentes = User::where('auditor_id', auth::user()->rol_id)->withCount('funcionsustantiva')->simplePaginate(8);
        return view('Auditor/misdocentes')->with(compact('docentes'));
    }

    public function gestionarDocenteView(int $id){
        $docente = User::where('id', $id)->first();
        $funciones = FuncionSustantiva::with('TipoFuncion')->with('estado')->where('usuario_id', $id)->simplePaginate(8);
        $tipofuncion = TipoFuncion::all();
        foreach($funciones as $funcion) {
            $startTime = $funcion->hora_inicio;
            $endTime = $funcion->hora_final;
        
            $startDateTime = Carbon::createFromFormat('H:i:s', $startTime);
            $endDateTime = Carbon::createFromFormat('H:i:s', $endTime);
        
            $minutesDifference = $endDateTime->diffInMinutes($startDateTime);
            $hoursDifference = floor($minutesDifference / 60);
            $decimalMinutes = $minutesDifference % 60;

            $funcion->time_difference = $hoursDifference . '.' . $decimalMinutes;
        }
        return view('Auditor/gestionardocente')->with(compact('docente', 'funciones', 'tipofuncion'));
    }

    public function detalleReporteView(int $id){
        $funcion = FuncionSustantiva::with('TipoFuncion', 'estado', 'evidencia', 'user')->find($id);
        $funcion->hora_inicio = Carbon::createFromFormat('H:i:s', $funcion->hora_inicio)->format('h:i A');
        $funcion->hora_final = Carbon::createFromFormat('H:i:s', $funcion->hora_final)->format('h:i A');
        return view('Auditor/detallereporte')->with(compact('funcion'));
    }

    public function asignarFuncion(Request $request){
        $validated = $request->validate([
            'fecha_de_funcion' => 'required|date|after:today',
            'hora_de_inicio' => 'required',
            'hora_final' => 'required|after:hora_de_inicio',
            'lugar' => 'required|string|max:80',
            'select_function' => 'required|exists:tipo_funcion,nombre',
            'docente_id' => 'required|exists:users,id',
        ]);

        $tipofuncion = TipoFuncion::where('nombre', $request->select_function)->first();

        $funcion = new FuncionSustantiva();
        $funcion->usuario_id = $request->docente_id;
        $funcion->fecha = $request->fecha_de_funcion;
        $funcion->hora_inicio = $request->hora_de_inicio;
        $funcion->hora_final = $request->hora_final;
        $funcion->lugar = $request->lugar;
        $funcion->tipo_funcion_id = $tipofuncion->id;
        $funcion->estado_id = 1;

        $funcion->save();

        return redirect()->back()->with('message', 'Se ha asignado la función correctamente.');
    }

    public function asignarEstadoFinal(Request $request){
        $validated = $request->validate([
            'funcion_id' => 'required|exists:funcion_sustantiva,id',
            'estado' => 'required|exists:estado,id',
            'observaciones' => 'nullable|min:10|max:490',
        ]);

        $funcion = FuncionSustantiva::find((int) $request->funcion_id);
        $funcion->estado_id = (int) $request->estado;
        if(!is_null($request->observaciones)){
            $funcion->observaciones_auditor = $request->observaciones;
        }

        $funcion->save();

        return redirect()->route('auditor-gestionar-docente', $funcion->usuario_id)->with('message', 'Se ha asignado el nuevo estado a la función.');
    }
}
