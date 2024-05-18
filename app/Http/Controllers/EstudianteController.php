<?php

namespace App\Http\Controllers;

use App\Models\BoletaInscripcion;
use App\Models\GrupoMateriaBoletaInscripcion;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Materia;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{
    public function index()
    {
        $detalleboletas = [];
        $user = Auth::user();
        $boletas = BoletaInscripcion::where('user_estudiante_id',$user->id)->get();
        foreach ($boletas as $boleta){
            $detalleboleta = $boleta->grupo_materia_boleta_inscripcion();
            $detalleboletas[] = $detalleboleta;
        }
        $materias = [];
        foreach ($detalleboletas as $detalle){
            $materia = $detalle->grupo_materia()->materia();
            $materias[] = $materia;
        }
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

    public function calificaciones(){
        return view('VistaEstudiante.calificaciones');
    }
}
