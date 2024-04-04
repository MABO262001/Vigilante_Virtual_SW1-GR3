<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReconocimientoFacialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Roles;
use App\Http\Controllers\Permisos;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard');

    //  Routes pertenecientes a los usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('Usuario.index');
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('Usuario.create');
    Route::get('/usuarios/edit/{id}', [UsuarioController::class, 'edit'])->name('Usuario.edit');
    Route::post('/usuarios/store', [UsuarioController::class, 'store'])->name('Usuario.store');
    Route::post('/usuarios/update', [UsuarioController::class, 'update'])->name('Usuario.update');
    Route::get('/usuarios/show', [UsuarioController::class, 'show'])->name('Usuario.show');
    Route::get('/usuarios/destroy', [UsuarioController::class, 'destroy'])->name('Usuario.destroy');
    Route::get('/usuarios/buscar', [UsuarioController::class, 'buscar'])->name('Usuario.buscar');

    Route::resource('Permisos', Permisos::class);
    Route::resource('Roles', Roles::class);


    Route::get('/reconocimiento-facial', [ReconocimientoFacialController::class, 'index'])->name('Reconocimiento-Facial.index');
    Route::post('/reconocimiento-facial/guardar_anomalia', [ReconocimientoFacialController::class, 'guardarAnomalia'])->name('guardar_anomalia');
});
