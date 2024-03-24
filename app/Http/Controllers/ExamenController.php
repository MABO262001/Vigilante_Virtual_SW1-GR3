<?php

namespace App\Http\Controllers;

use App\Models\Ejecucion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Actualmente se esta manejando con usuario, luego se tiene que cambiar
         * por docente.
         */

        $id_user = Auth::user()->id; 
        $user = User::find($id_user); //Para poder manipularlo como un objeto User

        if ($user) {

            $examenes = $user->examenes()->get();

            $creados = count($examenes);
            
            $ejecutados = 0;
            foreach($examenes as $examen){
                $ejecutados += count($examen->ejecuciones()->get());
            }

            $data = array(
                'user_id' => $user->id,
                'min' => 1
            );
            $ejecutando = Ejecucion::getExamenesEjecutandose($data)[0];

            $data = compact(
                'examenes',
                'ejecutados',
                'creados',
                'ejecutando'
            );
            return view('VistaExamen.index')->with($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('VistaExamen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
