<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonsController;
use App\Http\Controllers\PersonsEventController;
use App\Http\Controllers\YoungController;
use App\Http\Controllers\MenController;
use App\Http\Controllers\WomanController;

Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'authLogin']);
Route::get('/logout', [AuthController::class, 'authLogout']);



Route::middleware('auth')->group(function() {


    #Rutas Administrador
    Route::get('/dashboard/usuarios', [AdminController::class, 'index']);
    Route::post('/dashboard/usuarios', [AdminController::class, 'create']);
    Route::put('/dashboard/usuarios/{id}', [AdminController::class, 'update'])->name('usersys.update');
    Route::delete('/dashboard/usuarios/{id}', [AdminController::class, 'destroy'])->name('usersys.destroy');


    #Perfil del usuario Autentificado
    Route::get('/dashboard/perfil', [DashboardController::class, 'showprofile']);
    Route::put('/updateprofile', [DashboardController::class, 'updateMyInfo']);
    Route::get('/dashboard', [DashboardController::class, 'index']);

    #Paginas de servicio no disponible
    Route::get('/dashboard/503', function(){
        return view('dashboard.503');
    });


    #Personas Globales para todo el Sistema
    Route::get('/dashboard/personas', [PersonsController::class, 'index']);
    Route::post('/dashboard/personas', [PersonsController::class, 'create']);
    Route::put('/dashboard/personas/{id}', [PersonsController::class, 'update'])->name('person.update');
    Route::delete('/dashboard/personas/{id}', [PersonsController::class, 'destroy'])->name('person.destroy');
    Route::get('/dashboard/download-birthdays', [PersonsController::class, 'getBirthdayOfTheMonthPDF']);

    #Ministerio de Jovenes
    Route::get('/dashboard/jovenes', [YoungController::class, 'index']);
    Route::post('/dashboard/jovenes', [YoungController::class, 'create']);
    Route::get('/dashboard/jovenes-reporte', [YoungController::class, 'getInassistance']);
    Route::get('/dashboard/download-report-young', [YoungController::class, 'generatePDF']);

    #Ministerio de Varones
    Route::get('/dashboard/varones', [MenController::class, 'index']);
    Route::post('/dashboard/varones', [MenController::class, 'create']);
    Route::get('/dashboard/varones-reporte', [MenController::class, 'getInassistance']);
    Route::get('/dashboard/download-report-men', [MenController::class, 'generatePDF']);

    #Ministario de Mujeres
    Route::get('/dashboard/mujeres', [WomanController::class, 'index']);
    Route::post('/dashboard/mujeres', [WomanController::class, 'create']);
    Route::get('/dashboard/mujeres-reporte', [WomanController::class, 'getInassistance']);
    Route::get('/dashboard/download-report-woman', [WomanController::class, 'generatePDF']);


    #Seccion de Eventos - Asignacion de Personas y creación  de eventos
    // Route::get('/dashboard/asignarpersona', [PersonsEventController::class, 'index']);
    // Route::post('/dashboard/asignarpersona', [PersonsEventController::class, 'create']);
    // Route::put('/dashboard/asignarpersona/{id}', [PersonsEventController::class, 'update'])->name('asigperson.update');
    // Route::delete('/dashboard/asignarpersona/{id}', [PersonsEventController::class, 'destroy'])->name('asigperson.destroy');

    
});



