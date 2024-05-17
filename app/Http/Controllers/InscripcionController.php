<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comprobante;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InscripcionController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        $fecha = $request->get('fecha');

        $comprobantes = Comprobante::query()
            ->where(function ($query) use ($search) {
                $query->whereHas('userEstudiante', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('carnet_identidad', 'LIKE', "%{$search}%");
                })
                    ->orWhereHas('userAdministrativo', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('carnet_identidad', 'LIKE', "%{$search}%");
                    });
            })
            ->where(function ($query) use ($fecha) {
                if ($fecha) {
                    $query->whereDate('fecha', Carbon::parse($fecha)->format('Y-m-d'));
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();
        if ($request->ajax()) {
            return view('VistaInscripcion.table', compact('comprobantes'));
        }

        // Obtener todos los estudiantes
        $estudiantes = User::role('Estudiante')->get();

        $totalMatriculados = 0;
        $totalEstudiantesAusentes = 0;

        foreach ($estudiantes as $estudiante) {
            $matriculado = DB::table('grupo_materia_comprobantes')
                ->where('comprobante_id', $estudiante->id)
                ->exists();

            if ($matriculado) {
                $totalMatriculados++;
            } else {
                $totalEstudiantesAusentes++;
            }
        }

        return view('VistaInscripcion.index', compact('comprobantes', 'totalMatriculados', 'totalEstudiantesAusentes'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {

    }
}
