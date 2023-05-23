<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TipoFuncion;
use App\Models\FuncionSustantiva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use FPDF;
 
class AuditorController extends Controller
{
    public function misDocentesView(){
        $has_np = 0;
        $docentes = User::where('auditor_id', auth::user()->id)->withCount('funcionsustantiva')->simplePaginate(8);
        foreach($docentes as $doc){
            foreach($doc->funcionsustantiva as $func){
                if(Carbon::createFromFormat('Y-m-d', $func->fecha) < Carbon::now()->format('Y-m-d') && $func->estado_id == 1){
                    $func->estado_id = 5;
                    $func->save();
                    $has_np = 1;
                }
            }
        }

        if($has_np){
            return redirect()->route('auditor-misdocentes');
        }

        return view('Auditor/misdocentes')->with(compact('docentes'));
    }

    public function gestionarDocenteView(int $id){
        $docente = User::where('id', $id)->first();
        $funciones = FuncionSustantiva::with('TipoFuncion')->with('estado')->where('usuario_id', $id)->simplePaginate(8);
        $tipofuncion = TipoFuncion::where('is_drop', 0)->get();
        $has_np = 0;

        foreach($funciones as $funcion) {
            $startTime = $funcion->hora_inicio;
            $endTime = $funcion->hora_final;
        
            $startDateTime = Carbon::createFromFormat('H:i:s', $startTime);
            $endDateTime = Carbon::createFromFormat('H:i:s', $endTime);
        
            $minutesDifference = $endDateTime->diffInMinutes($startDateTime);
            $hoursDifference = floor($minutesDifference / 60);
            $decimalMinutes = $minutesDifference % 60;

            $funcion->time_difference = $hoursDifference . '.' . $decimalMinutes;
            if(Carbon::createFromFormat('Y-m-d', $funcion->fecha) < Carbon::now()->format('Y-m-d') && $funcion->estado_id == 1){
                $funcion->estado_id = 5;
                $funcion->save();
                $has_np = 1;
            }
        }

        if($has_np){
            return redirect()->route('auditor-gestionar-docente', $docente->id);
        }
        
        return view('Auditor/gestionardocente')->with(compact('docente', 'funciones', 'tipofuncion'));
    }

    public function detalleReporteView(int $id){
        $funcion = FuncionSustantiva::with('TipoFuncion', 'estado', 'evidencia', 'user')->find($id);
        $funcion->hora_inicio = Carbon::createFromFormat('H:i:s', $funcion->hora_inicio)->format('h:i A');
        $funcion->hora_final = Carbon::createFromFormat('H:i:s', $funcion->hora_final)->format('h:i A');
        return view('Auditor/detallereporte')->with(compact('funcion'));
    }

    public function informesView(){
        $users = User::select('nombres', 'apellidos', 'id')->where('auditor_id', auth()->user()->id)->get();
        return view('Auditor/informes')->with(compact('users'));
    }

    public function ajustesView(){
        return view('Auditor/ajustes');
    }

    public function generarInforme(Request $request){

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'fecha_inicial' => 'required|date|before_or_equal:'.Carbon::now()->subWeek()->format('Y-m-d'),
            'fecha_final' => 'required|date|after:fecha_inicial|before_or_equal:'.now()->format('Y-m-d'),
        ]);

        $funciones = FuncionSustantiva::where('usuario_id', $request->user_id)
        ->whereBetween('fecha', [$request->fecha_inicial, $request->fecha_final])
        ->with('TipoFuncion')
        ->get();

        $docente = User::find($request->user_id);

        $grouped = $funciones->groupBy('tipo_funcion_id')->all();

        // dd($grouped);
        // exit;

        $pdf = new FPDF();        
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 22);
        $pdf->SetTextColor(6, 40, 61);        
        $pdf->Cell(40, 10, "Reporte de funciones sustantivas");
        $pdf->Ln(12);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(100, 10, "Docente");
        $pdf->SetFont('Arial', '', 14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(100, 10, $this->em($docente->nombres) . " " . $this->em($docente->apellidos));
        $pdf->Ln(8);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(6, 40, 61);  
        $pdf->Cell(100, 10, "Documento");
        $pdf->SetFont('Arial', '', 14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(100, 10, $docente->documento);
        $pdf->Ln(8);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(6, 40, 61);  
        $pdf->Cell(100, 10, "Rango de fechas");
        $pdf->SetFont('Arial', '', 14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(100, 10, $request->fecha_inicial . " - " . $request->fecha_final);
        $pdf->Ln(8);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(6, 40, 61);
        $pdf->Cell(100, 10, "Fecha de informe:");
        $pdf->SetFont('Arial', '', 14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(100, 10, now()->format('Y-m-d'));
        $pdf->Ln(8);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(6, 40, 61); 
        $pdf->Cell(100, 10, "Generado por");
        $pdf->SetFont('Arial', '', 14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(100, 10, $this->em(auth()->user()->nombres) . " " . $this->em(auth()->user()->apellidos));
        $pdf->Ln(12);

        $pdf->Cell(190, 0.5, '', 'bottom', 0, 'C', true);
        $pdf->Ln(4);

        $tot_approbed = 0;
        $tot_rejected = 0;
        $tot_np = 0;
        foreach($grouped as $funcs){
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetTextColor(6, 40, 61); 
            $pdf->Cell(40, 10, $this->em('Tipo de función: ') . $this->em($funcs[0]->tipofuncion->nombre));
            $pdf->Ln();

            $approbed = 0;
            $rejected = 0;
            $np = 0;
            foreach($funcs as $func){
                switch($func->estado_id){
                    case 3:
                        $approbed += $this->totalHours($func->hora_inicio, $func->hora_final);
                        break;
                    case 4:
                        $rejected += $this->totalHours($func->hora_inicio, $func->hora_final);
                        break;
                    case 5:
                        $np += $this->totalHours($func->hora_inicio, $func->hora_final);
                        break;
                }
            }
            $tot_approbed += $approbed;
            $tot_rejected += $rejected;
            $tot_np += $np;

            $pdf->SetFont('Arial', '', 14);
            $pdf->SetTextColor(6, 40, 61); 
            $pdf->Cell(100, 10, "Total horas aprobadas");
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 10, $approbed);
            $pdf->Ln();

            $pdf->SetTextColor(6, 40, 61); 
            $pdf->Cell(100, 10, "Total horas rechazadas");
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 10, $rejected);
            $pdf->Ln();

            $pdf->SetTextColor(6, 40, 61); 
            $pdf->Cell(100, 10, "Total horas no presentadas");
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 10, $np);
            $pdf->Ln(12);
            
            $pdf->SetDrawColor(193, 198, 201);
            $pdf->Cell(190, 0.5, '', 'bottom', 0, 'C', true);
            $pdf->Ln(6);
        }

        if($grouped){
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetTextColor(6, 40, 61); 
            $pdf->Cell(40, 10, $this->em('Total general para el rango de fechas dado'));
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 14);
            $pdf->SetTextColor(34, 173, 132);
            $pdf->Cell(100, 10, "Total horas aprobadas");
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 10, $tot_approbed);
            $pdf->Ln();

            $pdf->SetTextColor(248, 120, 112);
            $pdf->Cell(100, 10, "Total horas rechazadas");
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 10, $tot_rejected);
            $pdf->Ln();

            $pdf->SetTextColor(6, 40, 61);
            $pdf->Cell(100, 10, "Total horas no presentadas");
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 10, $tot_np);
            $pdf->Ln(16);
        }else{
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetTextColor(6, 40, 61); 
            $pdf->Cell(40, 10, $this->em('No se encontraron funciones para el rango proporcionado'));
            $pdf->Ln();
        }
        
        $pdf->Output('reporte.pdf', 'D');
    
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

    public function ajustesCambiarPassword(Request $request){
        $user = User::find(auth()->user()->id);
        $validated = $request->validate([
            'password' => 'required|confirmed|min:8',
            'password_actual' => 'required',
        ]);

        if(!Hash::check($request->password_actual, $user->password)){
            throw ValidationException::withMessages(['contraseña actual' => 'La contraseña actual no coincide con nuestros registros']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('auditor-ajustes')->with('message', 'Se ha cambiado la contraseña.');
    
    }
    function em($word) {

        $word = str_replace("@","%40",$word);
        $word = str_replace("`","%60",$word);
        $word = str_replace("¢","%A2",$word);
        $word = str_replace("£","%A3",$word);
        $word = str_replace("¥","%A5",$word);
        $word = str_replace("|","%A6",$word);
        $word = str_replace("«","%AB",$word);
        $word = str_replace("¬","%AC",$word);
        $word = str_replace("¯","%AD",$word);
        $word = str_replace("º","%B0",$word);
        $word = str_replace("±","%B1",$word);
        $word = str_replace("ª","%B2",$word);
        $word = str_replace("µ","%B5",$word);
        $word = str_replace("»","%BB",$word);
        $word = str_replace("¼","%BC",$word);
        $word = str_replace("½","%BD",$word);
        $word = str_replace("¿","%BF",$word);
        $word = str_replace("À","%C0",$word);
        $word = str_replace("Á","%C1",$word);
        $word = str_replace("Â","%C2",$word);
        $word = str_replace("Ã","%C3",$word);
        $word = str_replace("Ä","%C4",$word);
        $word = str_replace("Å","%C5",$word);
        $word = str_replace("Æ","%C6",$word);
        $word = str_replace("Ç","%C7",$word);
        $word = str_replace("È","%C8",$word);
        $word = str_replace("É","%C9",$word);
        $word = str_replace("Ê","%CA",$word);
        $word = str_replace("Ë","%CB",$word);
        $word = str_replace("Ì","%CC",$word);
        $word = str_replace("Í","%CD",$word);
        $word = str_replace("Î","%CE",$word);
        $word = str_replace("Ï","%CF",$word);
        $word = str_replace("Ð","%D0",$word);
        $word = str_replace("Ñ","%D1",$word);
        $word = str_replace("Ò","%D2",$word);
        $word = str_replace("Ó","%D3",$word);
        $word = str_replace("Ô","%D4",$word);
        $word = str_replace("Õ","%D5",$word);
        $word = str_replace("Ö","%D6",$word);
        $word = str_replace("Ø","%D8",$word);
        $word = str_replace("Ù","%D9",$word);
        $word = str_replace("Ú","%DA",$word);
        $word = str_replace("Û","%DB",$word);
        $word = str_replace("Ü","%DC",$word);
        $word = str_replace("Ý","%DD",$word);
        $word = str_replace("Þ","%DE",$word);
        $word = str_replace("ß","%DF",$word);
        $word = str_replace("à","%E0",$word);
        $word = str_replace("á","%E1",$word);
        $word = str_replace("â","%E2",$word);
        $word = str_replace("ã","%E3",$word);
        $word = str_replace("ä","%E4",$word);
        $word = str_replace("å","%E5",$word);
        $word = str_replace("æ","%E6",$word);
        $word = str_replace("ç","%E7",$word);
        $word = str_replace("è","%E8",$word);
        $word = str_replace("é","%E9",$word);
        $word = str_replace("ê","%EA",$word);
        $word = str_replace("ë","%EB",$word);
        $word = str_replace("ì","%EC",$word);
        $word = str_replace("í","%ED",$word);
        $word = str_replace("î","%EE",$word);
        $word = str_replace("ï","%EF",$word);
        $word = str_replace("ð","%F0",$word);
        $word = str_replace("ñ","%F1",$word);
        $word = str_replace("ò","%F2",$word);
        $word = str_replace("ó","%F3",$word);
        $word = str_replace("ô","%F4",$word);
        $word = str_replace("õ","%F5",$word);
        $word = str_replace("ö","%F6",$word);
        $word = str_replace("÷","%F7",$word);
        $word = str_replace("ø","%F8",$word);
        $word = str_replace("ù","%F9",$word);
        $word = str_replace("ú","%FA",$word);
        $word = str_replace("û","%FB",$word);
        $word = str_replace("ü","%FC",$word);
        $word = str_replace("ý","%FD",$word);
        $word = str_replace("þ","%FE",$word);
        $word = str_replace("ÿ","%FF",$word);
        return urldecode($word);
    }

    private function totalHours( $startTime,  $endTime) {
        $startDateTime = Carbon::createFromFormat('H:i:s', $startTime);
        $endDateTime = Carbon::createFromFormat('H:i:s', $endTime);

        $minutesDifference = $endDateTime->diffInMinutes($startDateTime);
        $hoursDifference = floor($minutesDifference / 60);
        $decimalMinutes = $minutesDifference % 60;
        
        $total = $hoursDifference . '.' . $decimalMinutes;

        return (float)$total;
    }
}
