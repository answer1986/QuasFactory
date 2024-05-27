<?php

namespace App\Http\Controllers;

use App\Models\Rproduccion;
use Illuminate\Http\Request;



class RproduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reporteria.rproduccion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  
     public function store(Request $request)
{
    \Log::info($request->all());

    $validatedData = $request->validate([
        'startDate.*' => 'required|date',
        'endDate.*' => 'required|date',
        'kilostotales.*' => 'required|integer',
        'kilosscrap.*' => 'required|integer',
        'kilosprogramados.*' => 'required|integer',
        'kiloproducto.*' => 'required|integer',
        'totalkilosxmaquina.*' => 'required|integer',
        'numerocambioxprog.*' => 'required|integer',
        'kilosprodprog.*' => 'required|integer',
        'kilosscrapproce.*' => 'required|integer',
        'kiloproducxmaqperiod.*' => 'required|integer',
        'machine_type.*' => 'required|string',
        'machine_id.*' => 'required|string',
        'orden_produccion.*' => 'nullable|string',
        'kilos_fabricados.*' => 'nullable|integer',
        'kilos_programados.*' => 'nullable|integer',
    ]);

    // Guardar datos generales
    foreach ($request->startDate as $index => $startDate) {
        if (empty($request->kilostotales[$index]) || empty($request->kilosscrap[$index]) || empty($request->kilosprogramados[$index])) {
            return redirect()->back()->withErrors(['error' => 'Todos los campos son obligatorios.']);
        }

        Rproduccion::create([
            'start_date' => $startDate,
            'end_date' => $request->endDate[$index],
            'kilostotales' => $request->kilostotales[$index],
            'kilosscrap' => $request->kilosscrap[$index],
            'kilosprogramados' => $request->kilosprogramados[$index],
            'kiloproducto' => $request->kiloproducto[$index],
            'totalkilosxmaquina' => $request->totalkilosxmaquina[$index],
            'numerocambioxprog' => $request->numerocambioxprog[$index],
            'kilosprodprog' => $request->kilosprodprog[$index],
            'kilosscrapproce' => $request->kilosscrapproce[$index],
            'kiloproducxmaqperiod' => $request->kiloproducxmaqperiod[$index],
            'machine_type' => $request->machine_type[$index],
            'machine_id' => $request->machine_id[$index],
            'orden_produccion' => $request->orden_produccion[$index] ?? null,
            'kilos_fabricados' => $request->kilos_fabricados[$index] ?? null,
            'kilos_programados' => $request->kilos_programados[$index] ?? null,
        ]);
    }

    // Guardar datos específicos de cada máquina
    foreach ($request->machine_id as $index => $machineId) {
        if (!isset($request->orden_produccion[$index]) || !isset($request->kilos_fabricados[$index]) || !isset($request->kilos_programados[$index])) {
            continue;
        }

        Rproduccion::create([
            'machine_type' => $request->machine_type[$index],
            'machine_id' => $request->machine_id[$index],
            'orden_produccion' => $request->orden_produccion[$index] ?? null,
            'kilos_fabricados' => $request->kilos_fabricados[$index] ?? null,
            'kilos_programados' => $request->kilos_programados[$index] ?? null,
            // Agrega otros campos específicos de la máquina si los tienes
        ]);
    }

    return redirect()->back()->with('success', 'Datos guardados exitosamente.');
}

        




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rproduccion  $rproduccion
     * @return \Illuminate\Http\Response
     */
    public function show(Rproduccion $rproduccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rproduccion  $rproduccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Rproduccion $rproduccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rproduccion  $rproduccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rproduccion $rproduccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rproduccion  $rproduccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rproduccion $rproduccion)
    {
        //
    }
}
