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

Route::view('/', 'login')->name('login');
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
    Route::get('admin/usuarios/inhabilitar/{id}', [AdministradorController::class, 'usuarioInhabilitar'])->name('administrador-usuarios-inhabilitar');
    Route::get('admin/usuarios/habilitar/{id}', [AdministradorController::class, 'usuarioHabilitar'])->name('administrador-usuarios-habilitar');
    
    Route::get('admin/funcionessustantivas', [AdministradorController::class, 'funcionesSustantivasView'])->name('administrador-funciones');
    Route::get('admin/funcionessustantivas/eliminar/{id}', [AdministradorController::class, 'funcionesSustantivasEliminar'])->name('administrador-funciones-eliminar');
    Route::post('admin/funcionessustantivas/nueva', [AdministradorController::class, 'nuevaFuncionSustantiva'])->name('administrador-funciones-nueva');
});

Route::group(['middleware' => 'audit'], function () {
    Route::get('auditor/docentes', [AuditorController::class, 'misDocentesView'])->name('auditor-misdocentes');
    Route::get('auditor/docentes/gestionar/{id}', [AuditorController::class, 'gestionarDocenteView'])->name('auditor-gestionar-docente');
    Route::get('auditor/docentes/gestonar/detallereporte/{id}', [AuditorController::class, 'detalleReporteView'])->name('auditor-detalle-reporte');
    Route::post('auditor/docentes/gestionar/nuevafuncion', [AuditorController::class, 'asignarFuncion'])->name('auditor-asignar-funcion');
    Route::post('auditor/docentes/gestionar/estadofinal', [AuditorController::class, 'asignarEstadoFinal'])->name('auditor-asignar-estado-final');
    
    Route::get('auditor/informes', [AuditorController::class, 'informesView'])->name('auditor-informes');
    Route::post('auditor/informes/generar', [AuditorController::class, 'generarInforme'])->name('auditor-informes-generar');

    Route::get('auditor/ajustes', [AuditorController::class, 'ajustesView'])->name('auditor-ajustes');
    Route::post('auditor/ajustes/password', [AuditorController::class, 'ajustesCambiarPassword'])->name('auditor-ajustes-password');
});

Route::group(['middleware' => 'doc'], function () {
    Route::get('docente/misfunciones', [DocenteController::class, 'misFuncionesView'])->name('docente-misfunciones');
    Route::get('docente/misfunciones/detallereporte/{id}', [DocenteController::class, 'detalleReporteView'])->name('docente-detalle-reporte');
    Route::get('docente/misfunciones/reportar/{id}', [DocenteController::class, 'reportarFuncionView'])->name('docente-misfunciones-reportar');
    Route::post('docente/misfunciones/reportar/enviar', [DocenteController::class, 'reportarFuncion'])->name('docente-misfunciones-reportar-enviar');
    
    Route::get('docente/informes', [DocenteController::class, 'informesView'])->name('docente-informes');
    Route::post('docente/informes/generar', [DocenteController::class, 'generarInforme'])->name('docente-informes-generar');
    
    Route::get('docente/ajustes', [DocenteController::class, 'ajustesView'])->name('docente-ajustes');
    Route::post('docente/ajustes/password', [DocenteController::class, 'ajustesCambiarPassword'])->name('docente-ajustes-password');
});


