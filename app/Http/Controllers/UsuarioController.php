<?php

namespace App\Http\Controllers;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::with('roles')->get();

        $usuariosSinMaster = $usuarios->reject(function ($usuario) {
            return $usuario->roles->contains('name', 'Master');
        });

        $totalUsuarios = $usuariosSinMaster->count();

        $totalDocentes = $usuarios->filter(function($usuario) {
            return $usuario->roles->contains('name', 'Docente');
        })->count();

        $totalEstudiantes = $usuarios->filter(function($usuario) {
            return $usuario->roles->contains('name', 'Estudiante');
        })->count();

        $roles = Role::all();

        return view('VistaUsuario.index', compact('usuarios', 'totalUsuarios', 'totalDocentes', 'totalEstudiantes'));
    }

    public function buscar(Request $request)
    {
        $query = $request->input('query');

        $usuarios = User::where('name', 'like', '%' . $query . '%')
                        ->orWhere('email', 'like', '%' . $query . '%')
                        ->with('roles')
                        ->get();

        if ($request->has('rol')) {
            if ($request->input('rol') == 'TodosMenosMaster') {
                $usuarios = $usuarios->reject(function ($usuario) {
                    return $usuario->roles->contains('name', 'Master');
                });
            } elseif ($request->input('rol') != 'Todos') {
                $usuarios = $usuarios->filter(function ($usuario) use ($request) {
                    return $usuario->roles->contains('name', $request->input('rol'));
                });
            }
        } elseif (auth()->check() && !auth()->user()->hasRole('Master')) {
            $usuarios = $usuarios->reject(function ($usuario) {
                return $usuario->roles->contains('name', 'Master');
            });
        }

        $totalUsuarios = $usuarios->count();

        $totalDocentes = $usuarios->filter(function ($usuario) {
            return $usuario->roles->contains('name', 'Docente');
        })->count();

        $totalEstudiantes = $usuarios->filter(function ($usuario) {
            return $usuario->roles->contains('name', 'Estudiante');
        })->count();

        $roles = Role::all();

        return view('VistaUsuario.index', compact('usuarios', 'totalUsuarios', 'totalDocentes', 'totalEstudiantes', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('VistaUsuario.create', compact('roles'));
    }



    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
