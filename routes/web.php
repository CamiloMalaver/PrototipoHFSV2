<?php

use App\Http\Controllers\DocenteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
}); 

Route::get('docente/misfunciones', [DocenteController::class, 'misFuncionesView'])->name('docente-misfunciones');
Route::get('docente/informes', [DocenteController::class, 'informesView'])->name('docente-informes');
Route::get('docente/ajustes', [DocenteController::class, 'ajustesView'])->name('docente-ajustes');
