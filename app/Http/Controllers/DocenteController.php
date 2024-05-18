<?php

namespace App\Http\Controllers;

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
        $materias = [];
        foreach($gmaterias as $gmateria)
        {
            $materia = $gmateria->materia();
            $materias[] = $materia;
        }

        return view('VistaDocente.index', compact('materias'));
    }


    public function materia(Request $request){

        $materia = Materia::where('sigla',$request->id)->first();
        $grupomateria = GrupoMateria::where('user_docente_id', Auth::id())
                             ->where('materia_id', $request->id)
                             ->first();
        $estudiantes = [];
        $ingresos = Ingreso::where('grupo_materia_id',$grupomateria->id)->get();
        foreach ($ingresos as $ingreso){
            $estudiante = $ingreso->estudiante();
            $estudiantes[] = $estudiante;
        }
        return view('VistaDocente.materia', compact('materia','grupomateria','estudiantes'));
    }
}
