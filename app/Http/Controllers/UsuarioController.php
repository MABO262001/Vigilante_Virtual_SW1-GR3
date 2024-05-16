<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::with('roles')->get();

        $usuariosSinMaster = $usuarios->reject(function ($usuario) {
            return $usuario->roles->contains('name', 'Master');
        });

        $totalUsuarios = $usuariosSinMaster->count();

        $totalDocentes = $usuarios->filter(function ($usuario) {
            return $usuario->roles->contains('name', 'Docente');
        })->count();

        $totalEstudiantes = $usuarios->filter(function ($usuario) {
            return $usuario->roles->contains('name', 'Estudiante');
        })->count();

        $roles = Role::all();
        $usuarios_creables = null;
        $user = Auth::user();
        if ($user->hasRole('Administrativo') || $user->hasRole('Administrativo Premium')) {
            $usuarios_creables = $user->usuarios_creables;
        }
        return view('VistaUsuario.index', compact('usuarios', 'totalUsuarios', 'totalDocentes', 'totalEstudiantes', 'usuarios_creables'));
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
        $user = Auth::user();

        if (auth()->check() && !auth()->user()->hasRole('Master')) {
            $roles = $roles->reject(function ($role) {
                return $role->name == 'Master' || $role->name == 'Administrativo Premium' ||
                    $role->name == 'Docente Premium' || $role->name == 'Administrativo';
            });
        }

        if ($user->hasRole('Administrativo') || $user->hasRole('Administrativo Premium')) {
            if ($user->usuarios_creables > 0) {
                return view('VistaUsuario.create', compact('roles'));
            } else {
                return redirect()->route('Usuario.index')->with('error', 'Usuario sin usuarios creables.');
            }
        }
        if ($user->hasRole('Master')) {
            return view('VistaUsuario.create', compact('roles'));
        }
    }

    public function store(Request $request)
    {


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($request->hasFile('profile_photo_path')) {
            $imageName = $request->name . '.' . $request->profile_photo_path->extension();
            $request->profile_photo_path->move(public_path('images/user'), $imageName);
            $user->profile_photo_path = '/images/user/' . $imageName;
        }
        $user->usuarios_creables = $request->cantidad_usuarios;
        $user->save();

        $user->assignRole($request->role);

        $userauth  = Auth::user();
        if ($userauth->hasRole('Administrativo') || $userauth->hasRole('Administrativo Premium')) {
            $userauth->usuarios_creables = $userauth->usuarios_creables - 1;
            $userauth->save();
        }

        return redirect()->route('Usuario.index')->with('success', 'Usuario creado exitosamente.');
    }


    public function show()
    {
        //
        $user = Auth::user();
        return view('VistaUsuario.show', compact('user'));
    }


    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::all();
        return view('VistaUsuario.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|max:255',
            'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_photo_path')) {
            $imageName = $request->name . '.' . $request->profile_photo_path->extension();
            $request->profile_photo_path->move(public_path('images/user'), $imageName);
            $user->profile_photo_path = '/images/user/' . $imageName;
        }

        $user->save();

        $user->syncRoles($request->role);
        return redirect()->route('Usuario.index')->with('success', 'Usuario actualizado exitosamente.');
    }


    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->route('Usuario.index')->with('success', 'Usuario eliminado con éxito');
    }

    public function obtenerCarnet($carnet_identidad)
    {
        $usuario = User::where('carnet_identidad', $carnet_identidad)->first();
        return response()->json($usuario);
    }
}
