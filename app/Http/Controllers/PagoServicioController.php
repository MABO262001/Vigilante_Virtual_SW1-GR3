<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use App\Models\ServicioComprobante;
use Carbon\Carbon;
use Illuminate\Http\Request;


class PagoServicioController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        $date = $request->get('date');

        $comprobantes = Comprobante::query()
            ->with('servicioComprobantes')
            ->whereHas('userEstudiante', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->whereHas('userAdministrativo', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })

            ->when($date, function ($query, $date) {
                $date = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
                $query->whereDate('fecha', $date);
            })
            ->get();

        $totalComprobantes = $comprobantes->count();
        $totalServiciosSinUtilizar = ServicioComprobante::where('usado', false)->count();
        $totalComprobantesDelDia = Comprobante::whereDate('created_at', now()->today())->count();

        return view('VistaPago.index', compact('comprobantes', 'totalComprobantes', 'totalServiciosSinUtilizar', 'totalComprobantesDelDia'));
    }

    public function buscarComprobantes(Request $request)
    {
        $search = $request->get('search');
        $date = $request->get('date');

        $comprobantes = Comprobante::query()
            ->with('servicioComprobantes')
            ->whereHas('userEstudiante', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->whereHas('userAdministrativo', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })

            ->when($date, function ($query, $date) {
                $date = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
                $query->whereDate('fecha', $date);
            })
            ->get();

        $totalComprobantes = $comprobantes->count();
        $totalServiciosSinUtilizar = ServicioComprobante::where('usado', false)->count();
        $totalComprobantesDelDia = Comprobante::whereDate('created_at', now()->today())->count();

        return view('VistaPago.table', compact('comprobantes', 'totalComprobantes', 'totalServiciosSinUtilizar', 'totalComprobantesDelDia'));
    }


    public function create()
    {
        return view('VistaPago.create');
    }

    public function store(Request $request)
    {

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
