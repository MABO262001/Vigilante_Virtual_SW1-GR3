<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Materia;
use Illuminate\Support\Facades\Auth;

class DocenteController extends Controller
{
    //
    public function index()
    {
        $materias = Materia::all();
        return view('VistaDocente.index', compact('materias'));
    }


    public function materia(Request $request){
        $materia = Materia::where('sigla',$request->id)->first();
        return view('VistaDocente.materia', compact('materia'));
    }
}
