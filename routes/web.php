<?php

use App\Http\Controllers\DocenteController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\LoginController;
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

Route::view('/', 'login');
Route::post('autenticar', [LoginController::class, 'validarInicio'])->name('validarInicio');
Route::get('salir', [LoginController::class, 'finalizarSesion'])->name('salir');

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/usuarios', [AdministradorController::class, 'usuariosView'])->name('administrador-usuarios');
    Route::get('admin/usuarios/nuevo', [AdministradorController::class, 'nuevoUsuarioView'])->name('administrador-usuarios-nuevo');
    Route::get('admin/usuarios/editar/{id}', [AdministradorController::class, 'editarUsuarioView'])->name('administrador-usuarios-editar');
    Route::get('admin/usuarios/asociardocente/{id}', [AdministradorController::class, 'asociarDocenteView'])->name('administrador-usuarios-asociardocente');
    Route::post('admin/usuarios/asociardocente', [AdministradorController::class, 'asociarDocente'])->name('administrador-usuarios-asociardocente-exec');
    Route::post('admin/usuarios/editar', [AdministradorController::class, 'editarUsuario'])->name('administrador-usuarios-editar-exec');
    Route::post('admin/usuarios/nuevo/agregar', [AdministradorController::class, 'nuevoUsuario'])->name('administrador-usuarios-nuevo-agregar');

    Route::get('admin/usuarios/funcionessustantivas', [AdministradorController::class, 'funcionesSustantivasView'])->name('administrador-funciones');
    Route::post('admin/usuarios/funcionessustantivas/nueva', [AdministradorController::class, 'nuevaFuncionSustantiva'])->name('administrador-funciones-nueva');
});

Route::group(['middleware' => 'audit'], function () {
    Route::get('auditor/docentes', [AuditorController::class, 'misDocentesView'])->name('auditor-misdocentes');
    Route::get('auditor/docentes/gestionar/{id}', [AuditorController::class, 'gestionarDocenteView'])->name('auditor-gestionar-docente');
    Route::post('auditor/docentes/gestionar/nuevafuncion', [AuditorController::class, 'asignarFuncion'])->name('auditor-asignar-funcion');
});

Route::group(['middleware' => 'doc'], function () {
    Route::get('docente/misfunciones', [DocenteController::class, 'misFuncionesView'])->name('docente-misfunciones');
    Route::get('docente/misfunciones/detallereporte/{id}', [DocenteController::class, 'detalleReporteView'])->name('docente-detalle-reporte');
    Route::get('docente/misfunciones/reportar/{id}', [DocenteController::class, 'reportarFuncionView'])->name('docente-misfunciones-reportar');
    Route::post('docente/misfunciones/reportar/enviar', [DocenteController::class, 'reportarFuncion'])->name('docente-misfunciones-reportar-enviar');

    Route::get('docente/informes', [DocenteController::class, 'informesView'])->name('docente-informes');
    Route::get('docente/ajustes', [DocenteController::class, 'ajustesView'])->name('docente-ajustes');
});


