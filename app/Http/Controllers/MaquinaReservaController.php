<?php

namespace App\Http\Controllers;

use App\Models\MaquinaReserva;
use App\Models\OrdenTrabajo;
use Illuminate\Http\Request;

class MaquinaReservaController extends Controller
{
    public function index()
    {
        $reservas = MaquinaReserva::all();
        return view('maquina_reservas.index', compact('reservas'));
    }

    public function create()
    {
        $ordenes = OrdenTrabajo::all();
        return view('maquina_reservas.create', compact('ordenes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'maquina_tipo' => 'required|string',
            'maquina_nombre' => 'required|string',
            'fecha_reserva' => 'required|date',
            'orden_trabajo_id' => 'required|integer|exists:orden_trabajo,id',
        ]);

        MaquinaReserva::create($data);

        return redirect()->route('maquina_reservas.index')->with('success', 'Reserva creada exitosamente.');
    }

    public function show(MaquinaReserva $maquinaReserva)
    {
        return view('maquina_reservas.show', compact('maquinaReserva'));
    }

    public function edit(MaquinaReserva $maquinaReserva)
    {
        $ordenes = OrdenTrabajo::all();
        return view('maquina_reservas.edit', compact('maquinaReserva', 'ordenes'));
    }

    public function update(Request $request, MaquinaReserva $maquinaReserva)
    {
        $data = $request->validate([
            'maquina_tipo' => 'required|string',
            'maquina_nombre' => 'required|string',
            'fecha_reserva' => 'required|date',
            'orden_trabajo_id' => 'required|integer|exists:orden_trabajo,id',
        ]);

        $maquinaReserva->update($data);

        return redirect()->route('maquina_reservas.index')->with('success', 'Reserva actualizada exitosamente.');
    }

    public function destroy(MaquinaReserva $maquinaReserva)
    {
        $maquinaReserva->delete();
        return redirect()->route('maquina_reservas.index')->with('success', 'Reserva eliminada exitosamente.');
    }
}
