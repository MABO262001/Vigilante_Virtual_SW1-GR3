<?php

namespace App\Http\Controllers;
use App\Models\TipoAnomalia;
use Illuminate\Routing\Controller;


class ReconocimientoFacialController extends Controller
{
    public function index()
    {
        $tipoAnomalias = TipoAnomalia::all('nombre');
        $nombreUsuario = auth()->user()->name;
        return view('VistaReconocimientoFacial.index', ['tipoAnomalias' => $tipoAnomalias, 'nombreUsuario' => $nombreUsuario]);
    }

}
