<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grupo;
use App\Models\Materia;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{
    public function index()
    {
        $materias = Materia::all();
        return view('VistaEstudiante.index', compact('materias'));
    }

    public function unirseCurso()
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

    public function listaEstudiantes ()
    {
        return view('VistaEstudiante.listaestudiante');
    }
}
