
<?php


use App\Http\Controllers\ExamenController;
use Illuminate\Support\Facades\Route;


Route::get('', [ExamenController::class, 'index'])->name('Examen.index');
Route::get('/create', [ExamenController::class, 'create'])->name('Examen.create');
Route::post('/store', [ExamenController::class, 'store'])->name('Examen.store');

Route::get('/start/{ejecucion}', [ExamenController::class, 'start'])->name('Examen.start');
Route::get('/running/{examen}', [ExamenController::class, 'running'])->name('Examen.running');
