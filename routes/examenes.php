
<?php


use App\Http\Controllers\ExamenController;
use Illuminate\Support\Facades\Route;


Route::get('/examenes', [ExamenController::class, 'index'])->name('Examen.index');
Route::get('/examenes/create', [ExamenController::class, 'create'])->name('Examen.create');
Route::get('/examenes/store', [ExamenController::class, 'store'])->name('Examen.store');
