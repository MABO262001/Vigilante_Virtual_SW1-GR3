<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReconocimientoFacialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Roles;
use App\Http\Controllers\Permisos;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\GrupoMateriaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\GestionController;
// use App\Http\Controllers\InscripcionController;
// use App\Http\Controllers\AnomaliaController;

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

    // Routes Permisos y Roles
    Route::resource('Permisos', Permisos::class);
    Route::resource('Roles', Roles::class);

    // Routes DE IA
    Route::get('/reconocimiento-facial', [ReconocimientoFacialController::class, 'index'])->name('Reconocimiento-Facial.index');
    Route::post('/reconocimiento-facial/guardar_anomalia', [ReconocimientoFacialController::class, 'guardarAnomalia'])->name('guardar_anomalia');

    // Routes De Servicios
    Route::get('/servicios', [ServicioController::class, 'index'])->name('Servicio.index');
    Route::post('/servicios/store', [ServicioController::class, 'store'])->name('Servicio.store');
    Route::get('/servicios/create', [ServicioController::class, 'create'])->name('Servicio.create');
    Route::get('/servicios/{id}', [ServicioController::class, 'show'])->name('Servicio.show');
    Route::get('/servicios/{id}/edit', [ServicioController::class, 'edit'])->name('Servicio.edit');
    Route::put('/servicios/{id}', [ServicioController::class, 'update'])->name('Servicio.update');
    Route::delete('/servicios/{id}', [ServicioController::class, 'destroy'])->name('Servicio.destroy');



    // Falta hacer

    //GRUPO MATERIA
    Route::get('/grupo-materia', [GrupoMateriaController::class, 'index'])->name('GrupoMateria.index');
    Route::post('/grupo-materia/store', [GrupoMateriaController::class, 'store'])->name('GrupoMateria.store');
    Route::get('/grupo-materia/create', [GrupoMateriaController::class, 'create'])->name('GrupoMateria.create');
    Route::get('/grupo-materia/{id}', [GrupoMateriaController::class, 'show'])->name('GrupoMateria.show');
    Route::get('/grupo-materia/{id}/edit', [GrupoMateriaController::class, 'edit'])->name('GrupoMateria.edit');
    Route::put('/grupo-materia/{id}', [GrupoMateriaController::class, 'update'])->name('GrupoMateria.update');
    Route::delete('/grupo-materia/{id}', [GrupoMateriaController::class, 'destroy'])->name('GrupoMateria.destroy');


    // Routes De Grupos
    Route::get('/grupos', [GrupoController::class, 'index'])->name('Grupo.index');
    Route::post('/grupos/store', [GrupoController::class, 'store'])->name('Grupo.store');
    Route::get('/grupos/create', [GrupoController::class, 'create'])->name('Grupo.create');
    Route::get('/grupos/{id}', [GrupoController::class, 'show'])->name('Grupo.show');
    Route::get('/grupos/{id}/edit', [GrupoController::class, 'edit'])->name('Grupo.edit');
    Route::put('/grupos/{id}', [GrupoController::class, 'update'])->name('Grupo.update');
    Route::delete('/grupos/{id}', [GrupoController::class, 'destroy'])->name('Grupo.destroy');

    // Routes de Materias
    Route::get('/materias', [MateriaController::class, 'index'])->name('Materia.index');
    Route::post('/materias/store', [MateriaController::class, 'store'])->name('Materia.store');
    Route::get('/materias/create', [MateriaController::class, 'create'])->name('Materia.create');
    Route::get('/materias/{id}', [MateriaController::class, 'show'])->name('Materia.show');
    Route::get('/materias/{id}/edit', [MateriaController::class, 'edit'])->name('Materia.edit');
    Route::put('/materias/{id}', [MateriaController::class, 'update'])->name('Materia.update');
    Route::delete('/materias/{id}', [MateriaController::class, 'destroy'])->name('Materia.destroy');

    // Routes Gestion
    Route::get('/gestion', [GestionController::class, 'index'])->name('Gestion.index');
    Route::post('/gestion/store', [GestionController::class, 'store'])->name('Gestion.store');
    Route::get('/gestion/create', [GestionController::class, 'create'])->name('Gestion.create');
    Route::get('/gestion/{id}', [GestionController::class, 'show'])->name('Gestion.show');
    Route::get('/gestion/{id}/edit', [GestionController::class, 'edit'])->name('Gestion.edit');
    Route::put('/gestion/{id}', [GestionController::class, 'update'])->name('Gestion.update');
    Route::delete('/gestion/{id}', [GestionController::class, 'destroy'])->name('Gestion.destroy');

    // Routes Inscripcion
    // Route::get('/inscripcion', [InscripcionController::class, 'index'])->name('Inscripcion.index');
    // Route::post('/inscripcion/store', [InscripcionController::class, 'store'])->name('Inscripcion.store');
    // Route::get('/inscripcion/create', [InscripcionController::class, 'create'])->name('Inscripcion.create');
    // Route::get('/inscripcion/{id}', [InscripcionController::class, 'show'])->name('Inscripcion.show');
    // Route::get('/inscripcion/{id}/edit', [InscripcionController::class, 'edit'])->name('Inscripcion.edit');
    // Route::put('/inscripcion/{id}', [InscripcionController::class, 'update'])->name('Inscripcion.update');
    // Route::delete('/inscripcion/{id}', [InscripcionController::class, 'destroy'])->name('Inscripcion.destroy');


    // Routes de Anomalias
    // Route::get('/anomalias', [AnomaliaController::class, 'index'])->name('Anomalia.index');
    // Route::post('/anomalias/store', [AnomaliaController::class, 'store'])->name('Anomalia.store');
    // Route::get('/anomalias/create', [AnomaliaController::class, 'create'])->name('Anomalia.create');
    // Route::get('/anomalias/{id}', [AnomaliaController::class, 'show'])->name('Anomalia.show');
    // Route::get('/anomalias/{id}/edit', [AnomaliaController::class, 'edit'])->name('Anomalia.edit');
    // Route::put('/anomalias/{id}', [AnomaliaController::class, 'update'])->name('Anomalia.update');
    // Route::delete('/anomalias/{id}', [AnomaliaController::class, 'destroy'])->name('Anomalia.destroy');

});
