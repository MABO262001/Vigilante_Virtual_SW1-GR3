<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use App\Models\Servicio;
use App\Models\ServicioComprobante;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;


class PagoServicioController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        $date = $request->get('date');

        $comprobantes = Comprobante::query()
            ->with('servicioComprobantes')
            ->whereHas('userEstudiante', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('carnet_identidad', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('userAdministrativo', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('carnet_identidad', 'LIKE', "%{$search}%");
            })
            ->when($date, function ($query, $date) {
                $query->whereDate('fecha', Carbon::parse($date)->toDateString());
            })
            ->get();

        if ($request->ajax()) {
            return view('VistaPago.table', compact('comprobantes'));

        }

        $totalComprobantes = $comprobantes->count();
        $totalServiciosSinUtilizar = ServicioComprobante::where('usado', false)->count();
        $totalComprobantesDelDia = Comprobante::whereDate('created_at', now()->today())->count();

        return view('VistaPago.index', compact('comprobantes', 'totalComprobantes', 'totalServiciosSinUtilizar', 'totalComprobantesDelDia'));
    }



    public function create(Request $request)
    {
        $servicios = Servicio::all();
        $search = $request->get('search');

        $servicios = Servicio::query()
            ->where(function ($query) use ($search) {
                $query->where('nombre', 'LIKE', "%{$search}%")
                    ->orWhere('descripcion', 'LIKE', "%{$search}%");
            })
            ->get();

        if ($request->ajax()) {
            return view('VistaPago.tablacreate', compact('servicios'));
        }
        return view('VistaPago.create', compact('servicios'));
    }

    // public function buscarServicios(Request $request)
    // {
    //     $search = $request->get('search');

    //     $servicios = Servicio::query()
    //         ->where(function ($query) use ($search) {
    //             $query->where('nombre', 'LIKE', "%{$search}%")
    //                 ->orWhere('descripcion', 'LIKE', "%{$search}%");
    //         })
    //         ->get();

    //     if ($request->ajax()) {
    //         return view('VistaServicio.table', compact('servicios'));
    //     }
    //     return view('VistaPago.tableServicios', compact('servicios'));
    // }

    public function store(Request $request)
    {
        $carnet_identidad = $request->carnet_identidad;

        $estudiante = User::where('carnet_identidad', $request->carnet_identidad)->first();

        if (!$estudiante) {
            return response()->json(['error' => 'Estudiante no encontrado'], 404);
        }

        // Crear el comprobante
        $comprobante = Comprobante::create([
            'user_estudiante_id' => $estudiante->id,
            'user_administrativo_id' => auth()->id(),
            'hora' => now()->timezone('America/La_Paz')->format('H:i:s'),
            'fecha' => now()->timezone('America/La_Paz')->format('Y-m-d'),
            'monto_total' => 0,
        ]);
        dd($comprobante);


        // Retornar el comprobante creado
        return response()->json($comprobante, 201);
    }



    public function show(string $id)
    {
        $comprobante = Comprobante::with('servicioComprobantes')->findOrFail($id);
        return view('VistaPago.show', compact('comprobante'));
    }

    public function edit(string $id)
    {
        $comprobante = Comprobante::findOrFail($id);
        return view('VistaPago.edit', compact('comprobante'));
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
        $comprobante = Comprobante::findOrFail($id);
        $comprobante->delete();
        return redirect()->route('PagoServicio.index')->with('success', 'Comprobante eliminado exitosamente.');
    }
}
