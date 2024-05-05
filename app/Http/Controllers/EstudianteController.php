<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Ejecucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{
    public function index()
    {
        $materias = Materia::all();
        return view('VistaEstudiante.index', compact('materias'));
    }

    public function unirse_curso()
    {
        $grupos = Grupo::all();
        $materias = Materia::all();
        return view('VistaEstudiante.UnirseCurso', compact('grupos', 'materias'));
    }

    public function examenes()
    {
        $id_estudiante = Auth::user()->id;
        $user = User::findOrFail($id_estudiante);
        $ejecuciones = $user->ejecuciones;
        $examenes_dados = [];
        foreach ($ejecuciones as $ejecucion) {
            $examen = $ejecucion->examen;
            $datos_examen = [
                'tema' => $examen->tema,
                'descripcion' => $examen->descripcion,
                'fecha_ejecucion' => $ejecucion->fecha,
                'estado' => $ejecucion->estado_ejecucion_id,
            ];
            $examenes_dados[] = $datos_examen;
        }
        return view('VistaEstudiante.historialexamen', ['examenes_dados' => $examenes_dados]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
