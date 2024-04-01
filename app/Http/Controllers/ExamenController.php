<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Ejecucion;
use App\Models\Examen;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\User;
use Carbon\Carbon;
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
            foreach ($examenes as $examen) {
                $ejecutados += count($examen->ejecuciones()->where('estado_ejecucion_id', 2)->get());
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
        if ($user) {

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

            foreach ($preguntas as $item_pregunta) {

                $pregunta = Pregunta::create([
                    'descripcion'       =>  $item_pregunta['descripcion_pregunta'],
                    'ponderacion'       =>  $item_pregunta['ponderacion_pregunta'],
                    'comentario'        =>  $item_pregunta['comentario_pregunta'],
                    'tipo_pregunta_id'  =>  $item_pregunta['tipo_pregunta'],
                    'examen_id'         =>  $examen->id,
                ]);

                $respuestas = $item_pregunta['respuestas'];
                foreach ($respuestas as $item_respuesta) {
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
                    'nro_preguntas'         =>  $request->nro_preguntas,
                    'examen_id'             =>  $examen->id,
                    'estado_ejecucion_id'   =>  3
                ]);

                toastr('Ejecucion de examen programada correctamete', 'success', 'Ejecucion de examen');
            }
            toastr('Examen creado correctamente', 'success', 'Examen');

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

    public function start($id)
    {
        $ejecucion = Ejecucion::findOrFail($id);
        $examen = $ejecucion->examen()->first();

        $user = Auth::user();
        $user = User::findOrFail($user->id);
        $calificacion = $user->ejecuciones()->where('ejecucion_id', $ejecucion->id)->first();

        if (!$calificacion) {
            $calificacion = 0;
        }

        $now = Carbon::now(); // Obtiene la fecha y hora actual
        $fecha = Carbon::parse($ejecucion->fecha);

        switch ($ejecucion->estado_ejecucion_id) {
            case 1:
                $restante = 'El examen termina en: ' . $now->diff($fecha->copy()->setTimeFrom($ejecucion->hora_final))->format('%H:%I:%S');
                break;
            case 2:
                $restante = 'El examen terminó hace: ' . $fecha->copy()->setTimeFrom($ejecucion->hora_final)->diff($now)->format('%H:%I:%S');
                break;
            case 3:
                $restante = 'El examen inicia en: ' . $now->diff($fecha->copy()->setTimeFrom($ejecucion->hora_inicio))->format('%H:%I:%S');
                break;
        }

        $data = compact(
            'examen',
            'ejecucion',
            'calificacion',
            'restante'
        );
        return view('VistaExamen.start', $data);
    }

    public function running($id)
    {

        $ejecucion = Ejecucion::findOrFail($id);
        if ($ejecucion->estado_ejecucion_id == 1) {

            $examen = $ejecucion->examen()->first();
            $preguntas = $examen->preguntas()->get();

            if (count($preguntas) > $ejecucion->nro_preguntas) {

                $total_ponderacion = 0;

                while ($total_ponderacion != 100) {
                    $preguntas = $examen->preguntas()->inRandomOrder()->limit($ejecucion->nro_preguntas)->get();
                    $preguntas_seleccionadas = [];

                    $total_ponderacion = $preguntas->sum('ponderacion');
                    //echo $total_ponderacion;

                    if ($total_ponderacion == 100) {
                        $preguntas_seleccionadas = $preguntas->toArray();
                        break;
                    }
                }
                
            } else {
                $preguntas_seleccionadas = $preguntas;
            }

            foreach($preguntas_seleccionadas as $pregunta){
                $pregunta['respuestas'] = Pregunta::getAllRespuestas($pregunta['id']);
            }

            $fecha = Carbon::parse($ejecucion->fecha);
            $now = Carbon::now();

            $tiempo_restante = $fecha->copy()->setTimeFrom($ejecucion->hora_final)->diff($now)->format('%H:%I:%S');

            $data = compact(
                'preguntas_seleccionadas',
                'tiempo_restante',
                'examen',
                'ejecucion'
            );

            //dd($preguntas_seleccionadas);

            return view('VistaExamen.running', $data);
        }
        
    }
}
