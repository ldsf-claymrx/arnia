<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonsController;
use App\Http\Controllers\PersonsEventController;

Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'authLogin']);
Route::get('/logout', [AuthController::class, 'authLogout']);



Route::middleware('auth')->group(function() {


    #Rutas Administrador
    Route::get('/dashboard/usuariosarnia', [AdminController::class, 'index']);
    Route::post('/dashboard/usuariosarnia', [AdminController::class, 'create']);
    Route::put('/dashboard/usuariosarnia/{id}', [AdminController::class, 'update'])->name('userarnia.update');
    Route::delete('/dashboard/usuariosarnia/{id}', [AdminController::class, 'destroy'])->name('userarnia.destroy');


    #Perfil del usuario Autentificado
    Route::get('/dashboard/perfil', [DashboardController::class, 'showprofile']);
    Route::put('/updateprofile', [DashboardController::class, 'updateMyInfo']);
    Route::get('/dashboard', [DashboardController::class, 'index']);


    #Personas Globales para todo el Sistema
    Route::get('/dashboard/personas', [PersonsController::class, 'index']);
    Route::post('/dashboard/personas', [PersonsController::class, 'create']);
    Route::put('/dashboard/personas/{id}', [PersonsController::class, 'update'])->name('person.update');
    Route::delete('/dashboard/personas/{id}', [PersonsController::class, 'destroy'])->name('person.destroy');


    #Seccion de Eventos - Asignacion de Personas y creación  de eventos
    Route::get('/dashboard/asignarpersona', [PersonsEventController::class, 'index']);
    Route::post('/dashboard/asignarpersona', [PersonsEventController::class, 'create']);
    Route::put('/dashboard/asignarpersona/{id}', [PersonsEventController::class, 'update'])->name('asigperson.update');
    Route::delete('/dashboard/asignarpersona/{id}', [PersonsEventController::class, 'destroy'])->name('asigperson.destroy');

    
});



