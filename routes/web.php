<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\GrupoMateriaController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\Permisos;
use App\Http\Controllers\ReconocimientoFacialController;
use App\Http\Controllers\Roles;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard');

    //Rutas pertenecientes a los usuarios
    Route::controller(UsuarioController::class)->group(function () {
        Route::get('/usuarios', 'index')->name('Usuario.index');
        Route::get('/usuarios/create', 'create')->name('Usuario.create');
        Route::get('/usuarios/edit/{id}', 'edit')->name('Usuario.edit');
        Route::post('/usuarios/store', 'store')->name('Usuario.store');
        Route::post('/usuarios/update', 'update')->name('Usuario.update');
        Route::get('/usuarios/show', 'show')->name('Usuario.show');
        Route::get('/usuarios/destroy', 'destroy')->name('Usuario.destroy');
        Route::get('/usuarios/buscar', 'buscar')->name('Usuario.buscar');
    });

    // Routes Permisos y Roles
    Route::resource('Permisos', Permisos::class);
    Route::resource('Roles', Roles::class);

    // Rutas DE IA
    Route::controller(ReconocimientoFacialController::class)->group(function () {
        Route::get('/reconocimiento-facial', 'index')->name('Reconocimiento-Facial.index');
        Route::post('/reconocimiento-facial/guardar_anomalia', 'guardarAnomalia')->name('guardar_anomalia');
    });

    // Rutas De Servicios
    Route::controller(ServicioController::class)->group(function () {
        Route::get('/servicios', 'index')->name('Servicio.index');
        Route::post('/servicios/store', 'store')->name('Servicio.store');
        Route::get('/servicios/create', 'create')->name('Servicio.create');
        Route::get('/servicios/{id}', 'show')->name('Servicio.show');
        Route::get('/servicios/{id}/edit', 'edit')->name('Servicio.edit');
        Route::put('/servicios/{id}', 'update')->name('Servicio.update');
        Route::delete('/servicios/{id}', 'destroy')->name('Servicio.destroy');
    });

    // Falta hacer

    //Rutas De Grupo-Materia
    Route::controller(GrupoMateriaController::class)->group(function () {
        Route::get('/grupo-materia', 'index')->name('GrupoMateria.index');
        Route::post('/grupo-materia/store', 'store')->name('GrupoMateria.store');
        Route::get('/grupo-materia/create', 'create')->name('GrupoMateria.create');
        Route::get('/grupo-materia/{id}', 'show')->name('GrupoMateria.show');
        Route::get('/grupo-materia/{id}/edit', 'edit')->name('GrupoMateria.edit');
        Route::put('/grupo-materia/{id}', 'update')->name('GrupoMateria.update');
        Route::delete('/grupo-materia/{id}', 'destroy')->name('GrupoMateria.destroy');
    });

    // Rutas De Grupos
    Route::controller(GrupoController::class)->group(function () {
        Route::get('/grupos', 'index')->name('Grupo.index');
        Route::post('/grupos/store', 'store')->name('Grupo.store');
        Route::get('/grupos/create', 'create')->name('Grupo.create');
        Route::get('/grupos/{id}', 'show')->name('Grupo.show');
        Route::get('/grupos/{id}/edit', 'edit')->name('Grupo.edit');
        Route::put('/grupos/{id}', 'update')->name('Grupo.update');
        Route::delete('/grupos/{id}', 'destroy')->name('Grupo.destroy');
    });
    // Rutas de Materias
    Route::controller(MateriaController::class)->group(function () {
        Route::get('/materia', 'index')->name('Materia.index');
        Route::post('/materia/store', 'store')->name('Materia.store');
        Route::get('/materia/create', 'create')->name('Materia.create');
        Route::get('/materia/{id}', 'show')->name('Materia.show');
        Route::get('/materia/{id}/edit', 'edit')->name('Materia.edit');
        Route::put('/materia/{id}', 'update')->name('Materia.update');
        Route::delete('/materia/{id}', 'destroy')->name('Materia.destroy');
    });


    // Routes Gestion
    Route::controller(GestionController::class)->group(function () {
        Route::get('/gestion', 'index')->name('Gestion.index');
        Route::post('/gestion/store', 'store')->name('Gestion.store');
        Route::get('/gestion/create', 'create')->name('Gestion.create');
        Route::get('/gestion/{id}', 'show')->name('Gestion.show');
        Route::get('/gestion/{id}/edit', 'edit')->name('Gestion.edit');
        Route::put('/gestion/{id}', 'update')->name('Gestion.update');
        Route::delete('/gestion/{id}', 'destroy')->name('Gestion.destroy');
    });


    // Rutas Inscripcion
    Route::controller(InscripcionController::class)->group(function () {
        Route::get('/inscripcion', 'index')->name('Inscripcion.index');
        Route::post('/inscripcion/store', 'store')->name('Inscripcion.store');
        Route::get('/inscripcion/create', 'create')->name('Inscripcion.create');
        Route::get('/inscripcion/{id}', 'show')->name('Inscripcion.show');
        Route::get('/inscripcion/{id}/edit', 'edit')->name('Inscripcion.edit');
        Route::put('/inscripcion/{id}', 'update')->name('Inscripcion.update');
        Route::delete('/inscripcion/{id}', 'destroy')->name('Inscripcion.destroy');
    });


    //Rutas de Estudiantes
    Route::controller(EstudianteController::class)->group(function () {
        Route::get('/estudiante', 'index')->name('Estudiante.index');
        Route::get('/unirse-curso', 'unirseCurso')->name('Estudiante.unirse_curso');
        Route::get('/historial-examenes', 'examenes')->name('Estudiante.examenes');
    });

});
