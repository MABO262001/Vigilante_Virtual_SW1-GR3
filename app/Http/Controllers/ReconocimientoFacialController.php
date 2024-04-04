<?php

namespace App\Http\Controllers;
use App\Models\Anomalia;
use App\Models\TipoAnomalia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;

class ReconocimientoFacialController extends Controller
{
    public function index()
    {
        $tipoAnomalias = TipoAnomalia::all('nombre');
        $nombreUsuario = auth()->user()->name;
        return view('VistaReconocimientoFacial.index', ['tipoAnomalias' => $tipoAnomalias, 'nombreUsuario' => $nombreUsuario]);
    }

    // public function guardarAnomalia(Request $request)
    // {
    //     $idUsuario = Auth::id();
    //     $datosAnomalia = $request->input('datos_anomalia');
    //     $tipoAnomalia = $request->input('tipo_anomalia');

    //     $datosImagen = base64_decode(explode(',', $datosAnomalia)[1]);

    //     $nombreArchivo = 'anomalia' . uniqid() . '.png';

    //     Storage::disk('public')->put('images/anomalia/' . $nombreArchivo, $datosImagen);

    //     Anomalia::create([
    //         'user_id' => $idUsuario,
    //         'url_imagen' => asset('images/anomalia/' . $nombreArchivo),
    //         'tipo_anomalia_id' => $tipoAnomalia,
    //         'hora' => now()->toTimeString(),
    //         'fecha' => now()->toDateString(),
    //     ]);

    //     return response()->json(['success' => true, 'message' => 'Imagen de anomalía guardada con éxito.', 'ruta' => asset('storage/images/anomalia/' . $nombreArchivo)]);
    // }

}
