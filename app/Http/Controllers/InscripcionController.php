<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BoletaInscripcion;
use App\Models\GrupoMateria;
use App\Models\GrupoMateriaBoletaInscripcion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


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

    public function create(Request $request)
    {
        $search = $request->get('search');

        $grupomaterias = GrupoMateria::query()
            ->whereHas('materia', function ($query) use ($search) {
                $query->where('nombre', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('grupo', function ($query) use ($search) {
                $query->where('nombre', 'LIKE', "%{$search}%");
            })
            ->get();

        if ($grupomaterias->isEmpty()) {
            return redirect()->back()->with('error', 'No se encontraron resultados');
        }

        if ($request->ajax()) {
            return view('VistaInscripcion.tablacreate', compact('grupomaterias'));
        }
        return view('VistaInscripcion.create', compact('grupomaterias'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'carnet_identidad' => 'required',
            'grupomaterias' => 'required|array',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $error = '';

            if ($errors->has('carnet_identidad')) {
                $error = 'Carnet no encontrado';
            }

            return redirect()->back()->withErrors($error)->withInput();
        }

        $carnet_identidad = $request->carnet_identidad;

        $estudiante = User::where('carnet_identidad', $request->carnet_identidad)->first();

        if (!$estudiante) {
            return redirect()->back()->with('error', 'Estudiante no encontrado');
        }

        $grupomaterias = $request->grupomaterias;

        $boleta_inscripcion = BoletaInscripcion::create([
            'user_estudiante_id' => $estudiante->id,
            'user_administrativo_id' => auth()->user()->id,
            'hora' => now()->timezone('America/La_Paz')->format('H:i:s'),
            'fecha' => now()->timezone('America/La_Paz')->format('Y-m-d'),
            'cantidad_materias_inscritas' => count($grupomaterias),
        ]);

        foreach ($grupomaterias as $grupomateria) {
            $grupo_materia = GrupoMateria::find($grupomateria);

            $boleta_inscripcion->grupo_materia_boleta_inscripcion()->create([
                'boleta_inscripcion_id' => $boleta_inscripcion->id,
                'grupo_materia_id' => $grupo_materia->id,
            ]);
        }

        return redirect()->route('Inscripcion.index')->with('success', 'Inscripción realizada con éxito');
    }

    public function show(string $id)
    {

    }

    public function edit(string $id,Request $request )
    {
        $boleta_inscripcion = BoletaInscripcion::find($id);
        $user_estudiante = User::find($boleta_inscripcion->user_estudiante_id);
        $total_materias_inscritas = GrupoMateriaBoletaInscripcion::where('boleta_inscripcion_id', $id)->count();


        $search = $request->get('search');

        $grupomaterias = GrupoMateria::query()
            ->whereHas('materia', function ($query) use ($search) {
                $query->where('nombre', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('grupo', function ($query) use ($search) {
                $query->where('nombre', 'LIKE', "%{$search}%");
            })
            ->get();

        if ($grupomaterias->isEmpty()) {
            return redirect()->back()->with('error', 'No se encontraron resultados');
        }

        if ($request->ajax()) {
            return view('VistaInscripcion.tablacreate', compact('grupomaterias'));
        }
        return view('VistaInscripcion.edit', compact('grupomaterias', 'boleta_inscripcion', 'user_estudiante', 'total_materias_inscritas'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'carnet_identidad' => 'required',
            'grupomaterias' => 'required|array',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $error = '';

            if ($errors->has('carnet_identidad')) {
                $error = 'Carnet no encontrado';
            }

            return redirect()->back()->withErrors($error)->withInput();
        }

        $carnet_identidad = $request->carnet_identidad;

        $estudiante = User::where('carnet_identidad', $request->carnet_identidad)->first();

        if (!$estudiante) {
            return redirect()->back()->with('error', 'Estudiante no encontrado');
        }

        $grupomaterias = $request->grupomaterias;

        $boleta_inscripcion = BoletaInscripcion::find($id);

        if (!$boleta_inscripcion) {
            return redirect()->back()->with('error', 'Boleta de inscripción no encontrada');
        }

        $boleta_inscripcion->update([
            'user_estudiante_id' => $estudiante->id,
            'user_administrativo_id' => auth()->user()->id,
            'hora' => now()->timezone('America/La_Paz')->format('H:i:s'),
            'fecha' => now()->timezone('America/La_Paz')->format('Y-m-d'),
            'cantidad_materias_inscritas' => count($grupomaterias),
        ]);

        foreach ($grupomaterias as $grupomateria) {
            $grupo_materia = GrupoMateria::find($grupomateria);

            $boleta_inscripcion->grupo_materia_boleta_inscripcion()->updateOrCreate([
                'boleta_inscripcion_id' => $boleta_inscripcion->id,
                'grupo_materia_id' => $grupo_materia->id,
            ]);
        }

        return redirect()->route('Inscripcion.index')->with('success', 'Inscripción actualizada con éxito');
    }

    public function destroy(string $id)
    {
        $inscripcion = BoletaInscripcion::find($id);

        if (!$inscripcion) {
            return redirect()->back()->with('error', 'Inscripción no encontrada');
        }

        $inscripcion->delete();

        return redirect()->route('Inscripcion.index')->with('success', 'Inscripción eliminada con éxito');
    }
}
