<?php

namespace App\Http\Controllers;

use App\Models\Rcontabilidad;
use Illuminate\Http\Request;

class RcontabilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reporteria.rcontabilidad');
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
        // Validar y almacenar los datos del formulario
        $data = $request->validate([
            'startDate' => 'required|array',
            'startDate.*' => 'required|date',
            'endDate' => 'required|array',
            'endDate.*' => 'required|date',
            'conciliacion_bancaria' => 'required|array',
            'conciliacion_bancaria.*' => 'required|numeric',
            'liquidez_corriente' => 'required|array',
            'liquidez_corriente.*' => 'required|numeric',
            'ventas_netas' => 'required|array',
            'ventas_netas.*' => 'required|numeric',
            'ventas_netas_tasa' => 'required|array',
            'ventas_netas_tasa.*' => 'required|numeric',
            'rotacion_cuentas' => 'required|array',
            'rotacion_cuentas.*' => 'required|numeric',
            'deudas_vencidas' => 'required|array',
            'deudas_vencidas.*' => 'required|numeric',
            'solvencia_largo_plazo' => 'required|array',
            'solvencia_largo_plazo.*' => 'required|numeric',
            'razon_endeudamiento' => 'required|array',
            'razon_endeudamiento.*' => 'required|numeric',
            'liquidez_corto_plazo' => 'required|array',
            'liquidez_corto_plazo.*' => 'required|numeric',
        ]);

        // Redirigir de vuelta a la página con los datos procesados
        return redirect()->route('rcontabilidad.index')->with('data', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rcontabilidad  $rcontabilidad
     * @return \Illuminate\Http\Response
     */
    public function show(Rcontabilidad $rcontabilidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rcontabilidad  $rcontabilidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Rcontabilidad $rcontabilidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rcontabilidad  $rcontabilidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rcontabilidad $rcontabilidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rcontabilidad  $rcontabilidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rcontabilidad $rcontabilidad)
    {
        //
    }
}
