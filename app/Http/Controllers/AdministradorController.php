<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\TipoFuncion;

class AdministradorController extends Controller
{
    public function usuariosView(){
        $users = User::orderBy('id', 'desc')->simplePaginate(6);
        return view('Administrador/usuarios')->with(compact('users'));
    }
    
    public function nuevoUsuarioView(){
        return view('Administrador/nuevousuario');
    }
    
    public function editarUsuarioView(int $id){
        $user = User::with('rol')->where('id', $id)->first();
        return view('Administrador/editarusuario')->with(compact('user'));
    }
    
    public function asociarDocenteView(int $id){
        $auditor = User::where('id', $id)->first();
        $docentes = User::where('auditor_id', $id)->get();
        return view('Administrador/asociardocentes')->with(compact('auditor','docentes'));
    }
    
    public function usuarioInhabilitar(int $id){
        $usuario = User::find($id);
        $usuario->is_drop = 1;
        $usuario->save();
        return redirect()->route('administrador-usuarios')->with('message', 'Se ha inhabilitado el usuario');
    }
    
    public function usuarioHabilitar(int $id){
        $usuario = User::find($id);
        $usuario->is_drop = 0;
        $usuario->save();
        return redirect()->route('administrador-usuarios')->with('message', 'Se ha habilitado el usuario');
    }
    
    public function funcionesSustantivasEliminar(int $id){
        $tfuncion = TipoFuncion::find($id);
        $tfuncion->is_drop = 1;
        $tfuncion->save();
        return redirect()->back()->with('message', 'Se ha eliminado el tipo de función.');
    }

    public function funcionesSustantivasView(){
        $funciones = TipoFuncion::orderBy('id', 'desc')->where('is_drop', 0)->paginate(10);
        return view('Administrador/tiposdefuncion')->with(compact('funciones'));
    }

    public function nuevoUsuario(Request $request){
        $validated = $request->validate([
            'documento' => 'required|integer|digits_between:5,15|unique:users',
            'nombres' => 'required|string|max:50|min:3',
            'apellidos' => 'required|string|max:50|min:3',
            'celular' => 'required|integer|digits_between:10,10',
            'select_rol' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $usuario = new User();
        $usuario->documento = $request->documento;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->celular = $request->celular;
        switch($request->select_rol){
            case 'Administrador':
                $usuario->rol_id = 1;
                break;
              case 'Auditor':   
                $usuario->rol_id = 2;
                break;
              case 'Docente':
                $usuario->rol_id = 3;
                break;
        }
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        if($request->select_programa == 3){
            $usuario->programa_id = $request->select_programa;
        }
        
        $usuario->save();

        return redirect()->back()->with('message', 'Se ha agregado el usuario correctamente.');

    }

    public function editarUsuario(Request $request){
        $validated = $request->validate([
            'celular' => 'required|max:10|min:10',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $usuario = User::where('id', $request->id)->first();
        $usuario->celular = $request->celular;
        if(isset($request->password)){
            $usuario->password = Hash::make($request->password);
        }
                
        $usuario->save();

        return redirect()->back()->with('message', "Se ha modificado el usuario correctamente.");
    }
        
    public function asociarDocente(Request $request){
        $validated = $request->validate([
            'email_docente' => 'required|email|exists:users,email',
        ]);
        
        $docente = User::where('email', $request->email_docente)->first();

        if($docente->rol_id != '3'){
            return back()->withErrors('El email proporcionado no corresponde a un docente');
        }

        if ($docente->auditor_id != null) {
            return back()->withErrors('El email proporcionado ya se encuentra asociado a otro auditor.');
        }

        $docente->auditor_id = (int)$request->auditor_id;
        $docente->save();

        return redirect()->back()->with('message', 'Se ha asociado el usuario al auditor correctamente.');

    }
    
    public function nuevaFuncionSustantiva(Request $request){
        $validated = $request->validate([
            'nombre_funcion' => 'required|string|max:50|min:3|unique:tipo_funcion,nombre',
        ]);

        $funcion = new TipoFuncion();
        $funcion->nombre = $request->nombre_funcion;

        $funcion->save();

        return redirect()->back()->with('message', 'Se ha agregado la nueva función correctamente.');

    }

}
