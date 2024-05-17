<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BoletaInscripcion;
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

        $boleta_inscripcion = BoletaInscripcion::query()
            ->where(function ($query) use ($search) {
                $query->whereHas('user_estudiante', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('carnet_identidad', 'LIKE', "%{$search}%");
                })
                    ->orWhereHas('user_administrativo', function ($query) use ($search) {
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
            ->withCount('grupo_materia_boleta_inscripcion')
            ->get();

        foreach ($boleta_inscripcion as $inscripcion) {
            $inscripcion->materias_inscritas = $inscripcion->grupo_materia_boleta_inscripcion->count();
        }

        if ($request->ajax()) {
            return view('VistaInscripcion.table', compact('boleta_inscripcion'));
        }

        $estudiantes = User::role('Estudiante')->get();

        $totalMatriculados = 0;
        $totalEstudiantesAusentes = 0;

        foreach ($estudiantes as $estudiante) {
            $matriculado = DB::table('grupo_materia_boleta_inscripcions')
                ->where('boleta_inscripcion_id', $estudiante->id)
                ->exists();

            if ($matriculado) {
                $totalMatriculados++;
            } else {
                $totalEstudiantesAusentes++;
            }
        }

        return view('VistaInscripcion.index', compact('boleta_inscripcion', 'totalMatriculados', 'totalEstudiantesAusentes'));
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
