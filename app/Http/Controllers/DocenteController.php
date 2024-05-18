<?php

namespace App\Http\Controllers;

use App\Models\BoletaInscripcion;
use App\Models\GrupoMateriaBoletaInscripcion;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Materia;
use Illuminate\Support\Facades\Auth;
use App\Models\GrupoMateria;
use App\Models\Ingreso;
class DocenteController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $gmaterias = GrupoMateria::where('user_docente_id',$user->id)->get();
        $grupomaterias = [];
        foreach ($gmaterias as $gmateria) {
            $materia = Materia::find($gmateria->materia_id);
            $grupo = Grupo::find($gmateria->grupo_id);
            $grupomaterias[] = [
                'gp' => $gmateria,
                'materia' => $materia,
                'grupo' => $grupo,
            ];
        }
        

        return view('VistaDocente.index', compact('grupomaterias'));
    }


    public function materia(Request $request){
        $user = Auth::user();

        $gp = GrupoMateria::find($request->id);
        $materia = Materia::find($gp->materia_id);
        $grupo = Grupo::find($gp->grupo_id);
        $estudiantes = [];
        $detalles = GrupoMateriaBoletaInscripcion::where('grupo_materia_id',$request->id)->get();
        foreach ($detalles as $detalle){
            $boleta = BoletaInscripcion::where('id',$detalle->boleta_inscripcion_id);
            $alumno = User::where('id',$boleta->user_estudiante_id);
            $estudiantes[] = $alumno;
        }
        return view('VistaDocente.materia', compact('materia','gp','estudiantes','grupo'));
    }
}
