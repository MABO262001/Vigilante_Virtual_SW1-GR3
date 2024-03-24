<?php

namespace App\Http\Controllers;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        if ($request->has('rol') && $request->input('rol') != '') {
            $rol = decrypt($request->input('rol'));
            if ($rol == 'TodosMenosMaster') {
                $usuarios = $usuarios->reject(function ($usuario) {
                    return $usuario->roles->contains('name', 'Master');
                });
            } elseif ($rol != 'Todos') {
                $usuarios = $usuarios->filter(function ($usuario) use ($rol) {
                    return $usuario->roles->contains('name', $rol);
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

        if (auth()->check() && !auth()->user()->hasRole('Master')) {
            $roles = $roles->reject(function ($role) {
                return $role->name == 'Master' || $role->name == 'Administrativo Premium' ||
                        $role->name == 'Docente Premium' || $role->name == 'Administrativo';
            });
        }

        return view('VistaUsuario.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|max:255',
            'profile_photo_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($request->hasFile('profile_photo_path')) {
            $imageName = $request->name.'.'.$request->profile_photo_path->extension();
            $request->profile_photo_path->move(public_path('images/user'), $imageName);
            $user->profile_photo_path = '/images/user/'.$imageName;
        }

        $user->save();

        $user->assignRole($request->role);
        return redirect()->route('Usuario.index')->with('success','Usuario creado exitosamente.');
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
        User::destroy($id);
        return redirect()->route('Usuario.index')->with('success', 'Usuario eliminado con éxito');
    }
}
