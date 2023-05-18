<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuncionSustantiva;
use App\Models\Evidencia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class DocenteController extends Controller
{
    public function misFuncionesView(){
        $funciones = FuncionSustantiva::with('TipoFuncion', 'estado')->where('usuario_id', auth::user()->id)->get();
        return view('Docente/misfunciones')->with(compact('funciones'));
    }

    public function detalleReporteView(int $id){
        $funcion = FuncionSustantiva::with('TipoFuncion', 'estado', 'evidencia')->find($id);
        return view('Docente/detallereporte')->with(compact('funcion'));
    }

    public function reportarFuncionView(int $id){
        $funcion = FuncionSustantiva::with('TipoFuncion')->where('id', $id)->first();
        return view('Docente/reportarfuncion')->with(compact('funcion'));
    }
    
    public function informesView(){
        return view('Docente/informes');
    }

    public function ajustesView(){
        return view('Docente/ajustes');
    }

    public function reportarFuncion(Request $request){
        $validated = $request->validate([
            'funcion_id' => 'required|exists:funcion_sustantiva,id',
            'descripcion_actividad' => 'required|string|max:400|min:20',
            'observaciones' => 'required|string|max:400|min:20',
            'evidencias' => 'required|array',
            'evidencias.*' => 'required|file|mimetypes:txt/pdf/doc/docx/jpg/jpeg',
            'evidencias.*' => 'max:2048',
            'evidencias' => 'max:2048',
        ]);

        $funcion = FuncionSustantiva::find($request->funcion_id);
        $funcion->descripcion_actividad = $request->descripcion_actividad;
        $funcion->observaciones = $request->observaciones;
        if ($request->hasFile('evidencias')) {
            foreach ($request->evidencias as $file) {
                $path = $file->store('uploads', 'public');
                $evidencia = new Evidencia;
                $evidencia->funcion_sustantiva_id = $request->funcion_id;
                $evidencia->nombre_archivo = 'Evidencia';
                $evidencia->url = $path;
                $evidencia->save();
            }            
        }

        $funcion->estado_id = 2;

        $funcion->save();
        return redirect()->route('docente-misfunciones')->with('message', 'Se ha reportado la función correctamente.');
    }
}
