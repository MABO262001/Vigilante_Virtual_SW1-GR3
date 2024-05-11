<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\GrupoMateria;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GrupoMateriaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $grupoMaterias = GrupoMateria::query()
            ->join('grupos', 'grupo_materias.grupo_id', '=', 'grupos.id')
            ->join('materias', 'grupo_materias.materia_id', '=', 'materias.id')
            ->where(function ($query) use ($search) {
                $query->where('grupos.nombre', 'LIKE', "%{$search}%")
                    ->orWhere('materias.nombre', 'LIKE', "%{$search}%");
            })
            ->select('grupo_materias.*')
            ->get();

        if ($request->ajax()) {
            return view('VistaGrupoMateria.table', compact('grupoMaterias'));
        }

        $totalGrupoMaterias = $grupoMaterias->count();
        $totalGrupos = Grupo::count();
        $totalMaterias = Materia::count();

        return view('VistaGrupoMateria.index', compact('grupoMaterias', 'totalGrupoMaterias', 'totalGrupos', 'totalMaterias'));
    }

    public function create()
    {
        $grupos = Grupo::all();
        $materias = Materia::all();
        return view('VistaGrupoMateria.create', compact('grupos', 'materias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'materia_id' => 'required|exists:materias,id',
            'contraseña' => 'required|string',
            'cantidad_estudiantes' => 'required|integer|min:0',
            'cantidad_estudiantes_inscritos' => 'required|integer|min:0',
        ]);

        if (GrupoMateria::where('grupo_id', $request->input('grupo_id'))->where('materia_id', $request->input('materia_id'))->exists()) {
            return redirect()->route('GrupoMateria.create')->with('error', 'Seleccione otro grupo, ya existe esa materia con ese grupo.');
        }

        $grupoMateria = new GrupoMateria;
        $grupoMateria->grupo_id = $request->input('grupo_id');
        $grupoMateria->materia_id = $request->input('materia_id');
        $grupoMateria->contraseña = $request->input('contraseña');
        $grupoMateria->cantidad_estudiantes = $request->input('cantidad_estudiantes');
        $grupoMateria->cantidad_estudiantes_inscritos = $request->input('cantidad_estudiantes_inscritos');

        $grupoMateria->save();

        return redirect()->route('GrupoMateria.index')->with('success', 'GrupoMateria creado exitosamente.');
    }

    public function show($id)
    {
        $grupoMateria = GrupoMateria::findOrFail($id);

        return view('VistaGrupoMateria.show', compact('grupoMateria'));
    }

    public function edit($id)
    {
        $grupoMateria = GrupoMateria::findOrFail($id);
        $grupos = Grupo::all();
        $materias = Materia::all();
        return view('VistaGrupoMateria.edit', compact('grupoMateria', 'grupos', 'materias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'materia_id' => 'required|exists:materias,id',
            'contraseña' => 'nullable|string',
            'cantidad_estudiantes' => 'required|integer|min:0',
            'cantidad_estudiantes_inscritos' => 'required|integer|min:0',
        ]);

        $grupoMateria = GrupoMateria::findOrFail($id);
        $grupoMateria->grupo_id = $request->input('grupo_id');
        $grupoMateria->materia_id = $request->input('materia_id');
        $grupoMateria->contraseña = $request->input('contraseña');
        $grupoMateria->cantidad_estudiantes = $request->input('cantidad_estudiantes');
        $grupoMateria->cantidad_estudiantes_inscritos = $request->input('cantidad_estudiantes_inscritos');

        $grupoMateria->save();

        return redirect()->route('GrupoMateria.index')->with('success', 'GrupoMateria actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $grupoMateria = GrupoMateria::findOrFail($id);
        $grupoMateria->delete();

        return redirect()->route('GrupoMateria.index')->with('success', 'GrupoMateria eliminado exitosamente.');
    }

    public function listaestudiantes()
    {
        return view('VistaGrupoMateria.listadoestudiantes');

    }
}
