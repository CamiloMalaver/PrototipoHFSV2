<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function misFuncionesView(){
        return view('Docente/misfunciones');
    }

    public function informesView(){
        return view('Docente/informes');
    }
    public function ajustesView(){
        return view('Docente/ajustes');
    }
}
