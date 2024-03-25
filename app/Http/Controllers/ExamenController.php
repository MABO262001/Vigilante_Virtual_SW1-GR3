<?php

namespace App\Http\Controllers;

use App\Models\Ejecucion;
use App\Models\Examen;
use App\Models\Pregunta;
use App\Models\Respuesta;
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
                $ejecutados += count($examen->ejecuciones()->where('estado_ejecucion_id', 1)->get());
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
        $user = Auth::user();
        
        //Colocar filtro de profesor
        if($user){

            $request->validate([
                'tema' => 'required|string|max:100',
                'descripcion' => 'required|string|max:255',
            ]);

            $examen = Examen::create([
                'tema'          =>  $request->tema,
                'descripcion'   =>  $request->descripcion,
                'user_id'       =>  $user->id
            ]);

            $preguntas = $request->preguntas;

            foreach($preguntas as $item_pregunta){

                $pregunta = Pregunta::create([
                    'descripcion'       =>  $item_pregunta['descripcion_pregunta'],
                    'ponderacion'       =>  $item_pregunta['ponderacion_pregunta'],
                    'comentario'        =>  $item_pregunta['comentario_pregunta'],
                    'tipo_pregunta_id'  =>  $item_pregunta['tipo_pregunta'],
                    'examen_id'         =>  $examen->id,
                ]);

                $respuestas = $item_pregunta['respuestas'];
                foreach($respuestas as $item_respuesta){
                    $respuesta = Respuesta::create([
                        'descripcion' => $item_respuesta['descripcion'],
                        'es_correcta' => $item_respuesta['es_correcta'],
                        'pregunta_id' => $pregunta->id,
                    ]);
                }
            }

            if ($request->ejecucion) {

                $ejecucion = Ejecucion::create([
                    'fecha'                 =>  $request->fecha,
                    'hora_inicio'           =>  $request->hora_inicio,
                    'hora_final'            =>  $request->hora_final,
                    'ponderacion'           =>  $request->ponderacion,
                    'contrasena'            =>  $request->contrasena,
                    'examen_id'             =>  $examen->id,
                    'estado_ejecucion_id'   =>  3
                ]);

                toastr('Ejecucion de examen programada correctamete', 'success','Ejecucion de examen');
            }
            toastr('Examen creado correctamente', 'success','Examen');
            
            return array('msg' => 'ok');
        }
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
