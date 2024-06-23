<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BoletaInscripcion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $rol = $request->input('rol') ? decrypt($request->input('rol')) : '';

        $usuarios = User::with('roles')
            ->where(function ($query) use ($search, $rol) {
                if ($rol) {
                    if ($rol == 'TodosMenosMaster') {
                        $query->whereDoesntHave('roles', function ($query) {
                            $query->where('name', 'Master');
                        });
                    } else {
                        $query->whereHas('roles', function ($query) use ($rol) {
                            $query->where('name', $rol);
                        });
                    }
                }
                if ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                }
            })
            ->get();

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

        if ($request->ajax()) {
            return view('VistaUsuario.table', compact('usuarios'));
        }

        return view('VistaUsuario.index', compact('usuarios', 'totalUsuarios', 'totalDocentes', 'totalEstudiantes', 'usuarios_creables', 'roles'));
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

    public function show($id)
    {
        $user = User::findOrFail($id);

        $inscripciones = BoletaInscripcion::where('user_estudiante_id', $id)
            ->with([
                'grupo_materia_boleta_inscripcions.grupo_materia.materia',
                'grupo_materia_boleta_inscripcions.grupo_materia.grupo',
                'grupo_materia_boleta_inscripcions.grupo_materia.userDocente'
            ])
            ->get();

        $materiasConGrupos = [];

        foreach ($inscripciones as $inscripcion) {
            foreach ($inscripcion->grupo_materia_boleta_inscripcions as $gmbi) {
                $grupoMateria = $gmbi->grupo_materia;

                if ($grupoMateria) {
                    $materia = $grupoMateria->materia;
                    $grupo = $grupoMateria->grupo;
                    $docente = $grupoMateria->userDocente;

                    $infoGrupoMateria = [
                        'grupo' => $grupo ? $grupo->nombre : 'N/A',
                        'materia' => $materia ? $materia->nombre : 'N/A',
                        'docente' => $docente ? $docente->name : 'N/A',
                    ];

                    $materiasConGrupos[] = $infoGrupoMateria;
                }
            }
        }

        return view('VistaUsuario.show', compact('user', 'materiasConGrupos'));
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::all();
        return view('VistaUsuario.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $authUser = Auth::user();

        $allowedFields = ['name', 'email', 'cantidad_usuarios'];
        if (!$authUser->hasRole('Estudiante')) {
            $allowedFields = array_merge($allowedFields, ['password', 'role', 'profile_photo_path']);
        }

        $rules = array_intersect_key([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|max:255',
            'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cantidad_usuarios' => 'nullable|integer',
        ], array_flip($allowedFields));
        $validatedData = $request->validate($rules);

        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if (!$authUser->hasRole('Estudiante')) {
            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }

            if ($request->hasFile('profile_photo_path')) {
                if ($user->profile_photo_path && file_exists(public_path($user->profile_photo_path))) {
                    unlink(public_path($user->profile_photo_path));
                }

                $imageName = $user->id . '_' . time() . '.' . $request->profile_photo_path->extension();
                $request->profile_photo_path->move(public_path('images/user'), $imageName);
                $user->profile_photo_path = 'images/user/' . $imageName;
            }

            $user->syncRoles($validatedData['role']);

            if (isset($validatedData['cantidad_usuarios'])) {
                $user->usuarios_creables = $validatedData['cantidad_usuarios'];
            }
        }

        $user->save();

        return redirect()->route('Usuario.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id)
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
