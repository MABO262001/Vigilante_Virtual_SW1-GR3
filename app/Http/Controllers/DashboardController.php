<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Examen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ejecucion;
use DateTime;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('Docente')) {
        $events = [];
        
        $usuarioAutenticado = Auth::user();
        $examenes = Examen::where('user_id', $usuarioAutenticado->id)->get();
        foreach ($examenes as $examen){
            $ejecucion = Ejecucion::where('examen_id', $examen->id)->get()->first();
            $fechaHoraI = $ejecucion->fecha . 'T' . $ejecucion->hora_inicio;
            $fechaHoraF = $ejecucion->fecha . 'T' . $ejecucion->hora_final;
            
            $events[] = [
                'title' => $examen->tema,
                'start' => $fechaHoraI,
                'end' => $fechaHoraF,
            ];
        }

        return view('VistaDashboard.index',compact('events'));
        }
        else{
            $usuarioAutenticado = Auth::user();
            $ejecuciones = $usuarioAutenticado->ejecuciones;
            $events = [];
            foreach ($ejecuciones as $ejecucion){
                $examen = Examen::where('id',$ejecucion->examen_id);
                $fechaHoraI = $ejecucion->fecha . 'T' . $ejecucion->hora_inicio;
                $fechaHoraF = $ejecucion->fecha . 'T' . $ejecucion->hora_final;
                $events[] = [
                    'title' => $examen->tema,
                    'start' => $fechaHoraI,
                    'end' => $fechaHoraF,
                ];
            }
            
            return view('VistaDashboard.index',compact('events'));
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
