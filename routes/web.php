<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Roles;
use App\Http\Controllers\Permisos;
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
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard');

    //  Routes pertenecientes a los usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('Usuario.index');
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('Usuario.create');
    Route::get('/usuarios/edit/{id}', [UsuarioController::class, 'edit'])->name('Usuario.edit');
    Route::get('/usuarios/show', [UsuarioController::class, 'show'])->name('Usuario.show');
    Route::get('/usuarios/destroy', [UsuarioController::class, 'destroy'])->name('Usuario.destroy');
    Route::get('/usuarios/buscar', [UsuarioController::class, 'buscar'])->name('Usuario.buscar');

    Route::resource('Permisos', Permisos::class);
    Route::resource('Roles', Roles::class);

});
